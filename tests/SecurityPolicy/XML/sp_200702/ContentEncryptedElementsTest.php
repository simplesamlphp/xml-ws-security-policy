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
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\ContentEncryptedElements;
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
 * Class \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\ContentEncryptedElementsTest
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
#[Group('sp')]
#[CoversClass(ContentEncryptedElements::class)]
#[CoversClass(AbstractSerElementsType::class)]
#[CoversClass(AbstractSpElement::class)]
final class ContentEncryptedElementsTest extends TestCase
{
    use SchemaValidationTestTrait;
    use SerializableElementTestTrait;


    /**
     */
    public static function setUpBeforeClass(): void
    {
        self::$testedClass = ContentEncryptedElements::class;

        self::$xmlRepresentation = DOMDocumentFactory::fromFile(
            dirname(__FILE__, 4) . '/resources/xml/sp/200702/ContentEncryptedElements.xml',
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

        $contentEncryptedElements = new ContentEncryptedElements(
            [$xpath],
            AnyURIValue::fromString('urn:x-simplesamlphp:version'),
            [$chunk],
            [$attr],
        );
        $contentEncryptedElementsElement = $contentEncryptedElements->toXML();

        // Test for an XPath
        $xpCache = XMLXPath::getXPath($contentEncryptedElementsElement);
        $contentEncryptedElementsElements = XMLXPath::xpQuery(
            $contentEncryptedElementsElement,
            './sp:XPath',
            $xpCache,
        );
        $this->assertCount(1, $contentEncryptedElementsElements);

        // Test ordering of ContentEncryptedElements contents
        /** @var \DOMElement[] $contentEncryptedElementsElements */
        $contentEncryptedElementsElements = XMLXPath::xpQuery(
            $contentEncryptedElementsElement,
            './sp:XPath/following-sibling::*',
            $xpCache,
        );

        $this->assertCount(1, $contentEncryptedElementsElements);
        $this->assertEquals('ssp:Chunk', $contentEncryptedElementsElements[0]->tagName);
    }


    // test marshalling


    /**
     * Test that creating a ContentEncryptedElements from scratch works.
     */
    public function testMarshalling(): void
    {
        $xpath = XPath::fromString('/bookstore/book[price>35.00]/title');
        $attr = new XMLAttribute(C::NAMESPACE, 'ssp', 'attr1', StringValue::fromString('value1'));
        $chunk = new Chunk(DOMDocumentFactory::fromString(
            '<ssp:Chunk xmlns:ssp="urn:x-simplesamlphp:namespace">some</ssp:Chunk>',
        )->documentElement);

        $contentEncryptedElements = new ContentEncryptedElements(
            [$xpath],
            AnyURIValue::fromString('urn:x-simplesamlphp:version'),
            [$chunk],
            [$attr],
        );
        $this->assertEquals(
            self::$xmlRepresentation->saveXML(self::$xmlRepresentation->documentElement),
            strval($contentEncryptedElements),
        );
    }
}
