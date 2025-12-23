<?php

declare(strict_types=1);

namespace SimpleSAML\Test\WebServices\SecurityPolicy\XML\mssp;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use SimpleSAML\Test\WebServices\SecurityPolicy\Constants as C;
use SimpleSAML\WebServices\SecurityPolicy\XML\mssp\RsaToken;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\AbstractSpElement;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\AbstractTokenAssertionType;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\IncludeToken;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\Type\IncludeTokenValue;
use SimpleSAML\XML\Attribute as XMLAttribute;
use SimpleSAML\XML\Chunk;
use SimpleSAML\XML\DOMDocumentFactory;
use SimpleSAML\XML\TestUtils\SchemaValidationTestTrait;
use SimpleSAML\XML\TestUtils\SerializableElementTestTrait;
use SimpleSAML\XMLSchema\Type\StringValue;

use function dirname;

/**
 * Class \SimpleSAML\WebServices\SecurityPolicy\XML\mssp\RsaTokenTest
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
#[Group('mssp')]
#[CoversClass(RsaToken::class)]
#[CoversClass(AbstractTokenAssertionType::class)]
#[CoversClass(AbstractSpElement::class)]
final class RsaTokenTest extends TestCase
{
    use SchemaValidationTestTrait;
    use SerializableElementTestTrait;


    /**
     */
    public static function setUpBeforeClass(): void
    {
        self::$testedClass = RsaToken::class;

        self::$xmlRepresentation = DOMDocumentFactory::fromFile(
            dirname(__FILE__, 4) . '/resources/xml/mssp/RsaToken.xml',
        );
    }


    // test marshalling


    /**
     * Adding an empty RsaToken element should yield an empty element.
     */
    public function testMarshallingEmptyElement(): void
    {
        $msspns = C::NS_MSSP;
        $rsaToken = new RsaToken();
        $this->assertEquals(
            "<mssp:RsaToken xmlns:mssp=\"$msspns\"/>",
            strval($rsaToken),
        );
        $this->assertTrue($rsaToken->isEmptyElement());
    }


    /**
     * Test that creating a RsaToken from scratch works.
     */
    public function testMarshalling(): void
    {
        $attr = new XMLAttribute(C::NAMESPACE, 'ssp', 'attr1', StringValue::fromString('value1'));
        $includeToken = IncludeTokenValue::fromEnum(IncludeToken::Always);
        $chunk = new Chunk(DOMDocumentFactory::fromString(
            '<ssp:Chunk xmlns:ssp="urn:x-simplesamlphp:namespace">some</ssp:Chunk>',
        )->documentElement);

        $rsaToken = new RsaToken([$chunk], [$includeToken->toAttribute(), $attr]);
        $this->assertEquals(
            self::$xmlRepresentation->saveXML(self::$xmlRepresentation->documentElement),
            strval($rsaToken),
        );
    }
}
