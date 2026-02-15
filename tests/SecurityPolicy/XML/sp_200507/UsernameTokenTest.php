<?php

declare(strict_types=1);

namespace SimpleSAML\Test\WebServices\SecurityPolicy\XML\sp_200507;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use SimpleSAML\Test\WebServices\SecurityPolicy\Constants as C;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\AbstractSpElement;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\AbstractTokenAssertionType;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\IncludeToken;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\Type\IncludeTokenValue;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\UsernameToken;
use SimpleSAML\XML\Attribute as XMLAttribute;
use SimpleSAML\XML\Chunk;
use SimpleSAML\XML\DOMDocumentFactory;
use SimpleSAML\XML\TestUtils\SchemaValidationTestTrait;
use SimpleSAML\XML\TestUtils\SerializableElementTestTrait;
use SimpleSAML\XMLSchema\Type\StringValue;

use function dirname;

/**
 * Class \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\UsernameTokenTest
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
#[Group('sp')]
#[CoversClass(UsernameToken::class)]
#[CoversClass(AbstractTokenAssertionType::class)]
#[CoversClass(AbstractSpElement::class)]
final class UsernameTokenTest extends TestCase
{
    use SchemaValidationTestTrait;
    use SerializableElementTestTrait;


    /**
     */
    public static function setUpBeforeClass(): void
    {
        self::$testedClass = UsernameToken::class;

        self::$xmlRepresentation = DOMDocumentFactory::fromFile(
            dirname(__FILE__, 4) . '/resources/xml/sp/200507/UsernameToken.xml',
        );
    }


    // test marshalling


    /**
     * Adding an empty UsernameToken element should yield an empty element.
     */
    public function testMarshallingEmptyElement(): void
    {
        $spns = C::NS_SEC_POLICY_11;
        $usernameToken = new UsernameToken();
        $this->assertEquals(
            "<sp:UsernameToken xmlns:sp=\"$spns\"/>",
            strval($usernameToken),
        );
        $this->assertTrue($usernameToken->isEmptyElement());
    }


    /**
     * Test that creating a UsernameToken from scratch works.
     */
    public function testMarshalling(): void
    {
        $attr = new XMLAttribute(C::NAMESPACE, 'ssp', 'attr1', StringValue::fromString('value1'));
        $includeToken = IncludeTokenValue::fromEnum(IncludeToken::Always);
        $chunk = new Chunk(DOMDocumentFactory::fromString(
            '<ssp:Chunk xmlns:ssp="urn:x-simplesamlphp:namespace">some</ssp:Chunk>',
        )->documentElement);

        $usernameToken = new UsernameToken([$chunk], [$includeToken->toAttribute(), $attr]);
        $this->assertEquals(
            self::$xmlRepresentation->saveXML(self::$xmlRepresentation->documentElement),
            strval($usernameToken),
        );
    }
}
