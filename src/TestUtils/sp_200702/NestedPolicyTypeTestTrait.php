<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\TestUtils\sp_200702;

use SimpleSAML\XML\DOMDocumentFactory;

use function sprintf;
use function strval;

/**
 * Class \SimpleSAML\WebServices\SecurityPolicy\TestUtils\sp_200702\NestedPolicyTypeTestTrait
 *
 * @package simplesamlphp/xml-ws-security-policy
 *
 * @phpstan-ignore trait.unused
 */
trait NestedPolicyTypeTestTrait
{
    // test marshalling


    /**
     * Test that creating a NestedPolicyType from scratch works.
     */
    public function testMarshalling(): void
    {
        /** @var \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\AbstractNestedPolicyType $np */
        $np = new static::$testedClass([static::$chunk], [static::$attr]);

        $this->assertEquals(
            static::$xmlRepresentation->saveXML(static::$xmlRepresentation->documentElement),
            strval($np),
        );
    }


    /**
     * Test that creating a NestedPolicyType from scratch without attributes works.
     */
    public function testMarshallingWithoutNSAttr(): void
    {
        $xml = <<<XML
<%s:%s xmlns:%s="%s" xmlns:ssp="urn:x-simplesamlphp:namespace">
  <ssp:Chunk>Some</ssp:Chunk>
</%s:%s>
XML;
        $localName = static::$testedClass::getLocalName();
        $prefix = static::$testedClass::getNamespacePrefix();
        $namespaceURI = static::$testedClass::getNamespaceURI();
        $xml = sprintf($xml, $prefix, $localName, $prefix, $namespaceURI, $prefix, $localName);
        $xmlRepresentation = DOMDocumentFactory::fromString($xml);

        /** @var \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\AbstractNestedPolicyType $np */
        $np = new static::$testedClass([static::$chunk]);

        $this->assertEquals(
            $xmlRepresentation->saveXML($xmlRepresentation->documentElement),
            strval($np),
        );
    }


    /**
     * Test that creating a NestedPolicyType from scratch without children works.
     */
    public function testMarshallingWithoutChildren(): void
    {
        $xml = '<%s:%s xmlns:%s="%s" xmlns:ssp="%s" ssp:attr1="value1"/>';
        $localName = static::$testedClass::getLocalName();
        $prefix = static::$testedClass::getNamespacePrefix();
        $namespaceURI = static::$testedClass::getNamespaceURI();
        $xml = sprintf($xml, $prefix, $localName, $prefix, $namespaceURI, 'urn:x-simplesamlphp:namespace');
        $xmlRepresentation = DOMDocumentFactory::fromString($xml);

        /** @var \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\AbstractNestedPolicyType $qns */
        $qns = new static::$testedClass([], [static::$attr]);

        $this->assertEquals(
            $xmlRepresentation->saveXML($xmlRepresentation->documentElement),
            strval($qns),
        );
    }


    /**
     * Adding an empty NestedPolicyType element should yield an empty element.
     */
    public function testMarshallingEmptyElement(): void
    {
        /** @var \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\AbstractNestedPolicyType $np */
        $np = new static::$testedClass();

        $localName = static::$testedClass::getLocalName();
        $prefix = static::$testedClass::getNamespacePrefix();
        $namespaceURI = static::$testedClass::getNamespaceURI();

        $this->assertEquals(
            sprintf("<%s:%s xmlns:%s=\"%s\"/>", $prefix, $localName, $prefix, $namespaceURI),
            strval($np),
        );
        $this->assertTrue($np->isEmptyElement());
    }


    // test unmarshalling


    /**
     * Test that creating a NestedPolicyType from XML without attributes succeeds.
     */
    public function testUnmarshallingWithoutNSAttr(): void
    {
        $xml = <<<XML
<%s:%s xmlns:%s="%s" xmlns:ssp="urn:x-simplesamlphp:namespace">
  <ssp:Chunk>Some</ssp:Chunk>
</%s:%s>
XML;
        $localName = static::$testedClass::getLocalName();
        $prefix = static::$testedClass::getNamespacePrefix();
        $namespaceURI = static::$testedClass::getNamespaceURI();

        $xml = sprintf($xml, $prefix, $localName, $prefix, $namespaceURI, $prefix, $localName);
        $xmlRepresentation = DOMDocumentFactory::fromString($xml);

        /** @var \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\AbstractNestedPolicyType $np */
        $np = static::$testedClass::fromXML($xmlRepresentation->documentElement);

        $this->assertEquals(
            $xmlRepresentation->saveXML($xmlRepresentation->documentElement),
            strval($np),
        );
    }


    /**
     * Test that creating a NestedPolicyType from XML without children succeeds.
     */
    public function testUnmarshallingWithoutChildren(): void
    {
        $xml = '<%s:%s xmlns:%s="%s" xmlns:ssp="urn:x-simplesamlphp:namespace" ssp:attr1="value1"/>';
        $localName = static::$testedClass::getLocalName();
        $prefix = static::$testedClass::getNamespacePrefix();
        $namespaceURI = static::$testedClass::getNamespaceURI();

        $xml = sprintf($xml, $prefix, $localName, $prefix, $namespaceURI);
        $xmlRepresentation = DOMDocumentFactory::fromString($xml);

        /** @var \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\AbstractNestedPolicyType $np */
        $np = static::$testedClass::fromXML($xmlRepresentation->documentElement);

        $this->assertEquals(
            $xmlRepresentation->saveXML($xmlRepresentation->documentElement),
            strval($np),
        );
    }
}
