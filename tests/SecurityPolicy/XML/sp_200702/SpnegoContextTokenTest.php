<?php

declare(strict_types=1);

namespace SimpleSAML\Test\WebServices\SecurityPolicy\XML\sp_200702;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use SimpleSAML\Test\WebServices\SecurityPolicy\Constants as C;
use SimpleSAML\WebServices\SecurityPolicy\Utils\XPath;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\AbstractSpElement;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\AbstractSpnegoContextTokenType;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\IncludeToken;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\IssuerName;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\SpnegoContextToken;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\Type\IncludeTokenValue;
use SimpleSAML\XML\Attribute as XMLAttribute;
use SimpleSAML\XML\Chunk;
use SimpleSAML\XML\DOMDocumentFactory;
use SimpleSAML\XML\TestUtils\SchemaValidationTestTrait;
use SimpleSAML\XML\TestUtils\SerializableElementTestTrait;
use SimpleSAML\XMLSchema\Type\StringValue;

use function dirname;

/**
 * Class \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\SpnegoContextTokenTest
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
#[Group('sp')]
#[CoversClass(SpnegoContextToken::class)]
#[CoversClass(AbstractSpnegoContextTokenType::class)]
#[CoversClass(AbstractSpElement::class)]
final class SpnegoContextTokenTest extends TestCase
{
    use SchemaValidationTestTrait;
    use SerializableElementTestTrait;


    /**
     */
    public static function setUpBeforeClass(): void
    {
        self::$testedClass = SpnegoContextToken::class;

        self::$xmlRepresentation = DOMDocumentFactory::fromFile(
            dirname(__FILE__, 4) . '/resources/xml/sp/200702/SpnegoContextToken.xml',
        );
    }


    /**
     */
    public function testMarshallingElementOrdering(): void
    {
        $issuer = IssuerName::fromString('urn:x-simplesamlphp:issuer');
        $attr = new XMLAttribute(C::NAMESPACE, 'ssp', 'attr1', StringValue::fromString('value1'));
        $includeToken = IncludeTokenValue::fromEnum(IncludeToken::Always);
        $chunk = new Chunk(DOMDocumentFactory::fromString(
            '<ssp:Chunk xmlns:ssp="urn:x-simplesamlphp:namespace">some</ssp:Chunk>',
        )->documentElement);

        $spnegoContextToken = new SpnegoContextToken($issuer, [$chunk], [$includeToken->toAttribute(), $attr]);
        $spnegoContextTokenElement = $spnegoContextToken->toXML();

        // Test for a IssuerName
        $xpCache = XPath::getXPath($spnegoContextTokenElement);
        $spnegoContextTokenElements = XPath::xpQuery($spnegoContextTokenElement, './sp:IssuerName', $xpCache);
        $this->assertCount(1, $spnegoContextTokenElements);

        // Test ordering of SpnegoContextToken contents
        /** @var \DOMElement[] $spnegoContextTokenElements */
        $spnegoContextTokenElements = XPath::xpQuery(
            $spnegoContextTokenElement,
            './sp:IssuerName/following-sibling::*',
            $xpCache,
        );

        $this->assertCount(1, $spnegoContextTokenElements);
        $this->assertEquals('ssp:Chunk', $spnegoContextTokenElements[0]->tagName);
    }


    // test marshalling


    /**
     * Test that creating a SpnegoContextToken from scratch works.
     */
    public function testMarshalling(): void
    {
        $attr = new XMLAttribute(C::NAMESPACE, 'ssp', 'attr1', StringValue::fromString('value1'));
        $includeToken = IncludeTokenValue::fromEnum(IncludeToken::Always);
        $chunk = new Chunk(DOMDocumentFactory::fromString(
            '<ssp:Chunk xmlns:ssp="urn:x-simplesamlphp:namespace">some</ssp:Chunk>',
        )->documentElement);

        $issuer = IssuerName::fromString('urn:x-simplesamlphp:issuer');

        $spnegoContextToken = new SpnegoContextToken($issuer, [$chunk], [$includeToken->toAttribute(), $attr]);
        $this->assertEquals(
            self::$xmlRepresentation->saveXML(self::$xmlRepresentation->documentElement),
            strval($spnegoContextToken),
        );
    }
}
