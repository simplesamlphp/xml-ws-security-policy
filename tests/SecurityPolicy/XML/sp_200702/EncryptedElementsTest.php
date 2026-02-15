<?php

declare(strict_types=1);

namespace SimpleSAML\Test\WebServices\SecurityPolicy\XML\sp_200702;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use SimpleSAML\Test\WebServices\SecurityPolicy\Constants as C;
use SimpleSAML\WebServices\SecurityPolicy\Utils\XPath as XMLXPath;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\AbstractSerElementsType;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\AbstractSpElement;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\EncryptedElements;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\XPath;
use SimpleSAML\XML\Attribute as XMLAttribute;
use SimpleSAML\XML\Chunk;
use SimpleSAML\XML\DOMDocumentFactory;
use SimpleSAML\XML\TestUtils\SchemaValidationTestTrait;
use SimpleSAML\XML\TestUtils\SerializableElementTestTrait;
use SimpleSAML\XMLSchema\Type\AnyURIValue;
use SimpleSAML\XMLSchema\Type\StringValue;

use function dirname;

/**
 * Class \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\EncryptedElementsTest
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
#[Group('sp')]
#[CoversClass(EncryptedElements::class)]
#[CoversClass(AbstractSerElementsType::class)]
#[CoversClass(AbstractSpElement::class)]
final class EncryptedElementsTest extends TestCase
{
    use SchemaValidationTestTrait;
    use SerializableElementTestTrait;


    /**
     */
    public static function setUpBeforeClass(): void
    {
        self::$testedClass = EncryptedElements::class;

        self::$xmlRepresentation = DOMDocumentFactory::fromFile(
            dirname(__FILE__, 4) . '/resources/xml/sp/200702/EncryptedElements.xml',
        );
    }


    /**
     */
    public function testMarshallingElementOrdering(): void
    {
        $xpath = XPath::fromString('/bookstore/book[price>35.00]/title');
        $attr = new XMLAttribute(C::NAMESPACE, 'ssp', 'attr1', StringValue::fromString('value1'));
        $chunk = new Chunk(DOMDocumentFactory::fromString(
            '<ssp:Chunk xmlns:ssp="urn:x-simplesamlphp:namespace">some</ssp:Chunk>',
        )->documentElement);

        $encryptedElements = new EncryptedElements(
            [$xpath],
            AnyURIValue::fromString('urn:x-simplesamlphp:version'),
            [$chunk],
            [$attr],
        );
        $encryptedElementsElement = $encryptedElements->toXML();

        // Test for an XPath
        $xpCache = XMLXPath::getXPath($encryptedElementsElement);
        $encryptedElementsElements = XMLXPath::xpQuery($encryptedElementsElement, './sp:XPath', $xpCache);
        $this->assertCount(1, $encryptedElementsElements);

        // Test ordering of EncryptedElements contents
        /** @var \DOMElement[] $encryptedElementsElements */
        $encryptedElementsElements = XMLXPath::xpQuery(
            $encryptedElementsElement,
            './sp:XPath/following-sibling::*',
            $xpCache,
        );

        $this->assertCount(1, $encryptedElementsElements);
        $this->assertEquals('ssp:Chunk', $encryptedElementsElements[0]->tagName);
    }


    // test marshalling


    /**
     * Test that creating a EncryptedElements from scratch works.
     */
    public function testMarshalling(): void
    {
        $xpath = XPath::fromString('/bookstore/book[price>35.00]/title');
        $attr = new XMLAttribute(C::NAMESPACE, 'ssp', 'attr1', StringValue::fromString('value1'));
        $chunk = new Chunk(DOMDocumentFactory::fromString(
            '<ssp:Chunk xmlns:ssp="urn:x-simplesamlphp:namespace">some</ssp:Chunk>',
        )->documentElement);

        $encryptedElements = new EncryptedElements(
            [$xpath],
            AnyURIValue::fromString('urn:x-simplesamlphp:version'),
            [$chunk],
            [$attr],
        );
        $this->assertEquals(
            self::$xmlRepresentation->saveXML(self::$xmlRepresentation->documentElement),
            strval($encryptedElements),
        );
    }
}
