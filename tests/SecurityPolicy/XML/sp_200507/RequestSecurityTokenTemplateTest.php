<?php

declare(strict_types=1);

namespace SimpleSAML\Test\WebServices\SecurityPolicy\XML\sp_200507;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use SimpleSAML\Test\WebServices\SecurityPolicy\Constants as C;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\AbstractRequestSecurityTokenTemplateType;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\AbstractSpElement;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\RequestSecurityTokenTemplate;
use SimpleSAML\XML\Attribute as XMLAttribute;
use SimpleSAML\XML\Chunk;
use SimpleSAML\XML\DOMDocumentFactory;
use SimpleSAML\XML\TestUtils\SerializableElementTestTrait;
use SimpleSAML\XMLSchema\Type\AnyURIValue;
use SimpleSAML\XMLSchema\Type\StringValue;

use function dirname;

/**
 * Class \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\RequestSecurityTokenTemplateTest
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
#[Group('sp')]
#[CoversClass(RequestSecurityTokenTemplate::class)]
#[CoversClass(AbstractRequestSecurityTokenTemplateType::class)]
#[CoversClass(AbstractSpElement::class)]
final class RequestSecurityTokenTemplateTest extends TestCase
{
    use SerializableElementTestTrait;


    /**
     */
    public static function setUpBeforeClass(): void
    {
        self::$testedClass = RequestSecurityTokenTemplate::class;

        self::$xmlRepresentation = DOMDocumentFactory::fromFile(
            dirname(__FILE__, 4) . '/resources/xml/sp/200507/RequestSecurityTokenTemplate.xml',
        );
    }


    // test marshalling


    /**
     * Test that creating a RequestSecurityTokenTemplate from scratch works.
     */
    public function testMarshalling(): void
    {
        $attr = new XMLAttribute(C::NAMESPACE, 'ssp', 'attr1', StringValue::fromString('value1'));
        $chunk = new Chunk(DOMDocumentFactory::fromString(
            '<ssp:Chunk xmlns:ssp="urn:x-simplesamlphp:namespace">some</ssp:Chunk>',
        )->documentElement);

        $requestSecurityTokenTemplateElements = new RequestSecurityTokenTemplate(
            AnyURIValue::fromString('urn:x-simplesamlphp:version'),
            [$chunk],
            [$attr],
        );

        $this->assertEquals(
            self::$xmlRepresentation->saveXML(self::$xmlRepresentation->documentElement),
            strval($requestSecurityTokenTemplateElements),
        );
    }


    /**
     * Adding an empty RequestSecurityTokenTemplate element should yield an empty element.
     */
    public function testMarshallingEmptyElement(): void
    {
        $spns = C::NS_SEC_POLICY_11;
        $requestSecurityTokenTemplate = new RequestSecurityTokenTemplate();
        $this->assertEquals(
            "<sp:RequestSecurityTokenTemplate xmlns:sp=\"$spns\"/>",
            strval($requestSecurityTokenTemplate),
        );
        $this->assertTrue($requestSecurityTokenTemplate->isEmptyElement());
    }
}
