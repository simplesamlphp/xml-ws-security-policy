<?php

declare(strict_types=1);

namespace SimpleSAML\Test\WebServices\SecurityPolicy\XML\sp_200507;

use SimpleSAML\Test\WebServices\SecurityPolicy\Constants as C;
use SimpleSAML\XML\Attribute as XMLAttribute;
use SimpleSAML\XMLSchema\Type\StringValue;

use function strval;

/**
 * Class \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\QNameAssertionTypeTestTrait
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
trait QNameAssertionTypeTestTrait
{
    // test marshalling


    /**
     * Test that creating a QNameAssertionType from scratch works.
     */
    public function testMarshalling(): void
    {
        $attr = new XMLAttribute(C::NAMESPACE, 'ssp', 'attr1', StringValue::fromString('value1'));

        /** @var \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\AbstractQNameAssertionType $qna */
        $qna = new static::$testedClass([$attr]);

        $this->assertEquals(
            static::$xmlRepresentation->saveXML(static::$xmlRepresentation->documentElement),
            strval($qna),
        );
    }


    /**
     * Test that creating a QNameAssertionType from scratch without attributes works.
     */
    public function testMarshallingWithoutNSAttr(): void
    {
        $xmlRepresentation = clone static::$xmlRepresentation;
        $xmlRepresentation->documentElement->removeAttributeNS(C::NAMESPACE, 'attr1');
        $xmlRepresentation->documentElement->removeAttributeNS(C::NAMESPACE, 'ssp');

        /** @var \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\AbstractQNameAssertionType $qna */
        $qna = new static::$testedClass();

        $this->assertEquals(
            $xmlRepresentation->saveXML($xmlRepresentation->documentElement),
            strval($qna),
        );
    }


    // test unmarshalling


    /**
     * Test that creating a QNameAssertionType from XML without attributes succeeds.
     */
    public function testUnmarshallingWithoutNSAttr(): void
    {
        $xmlRepresentation = clone static::$xmlRepresentation;
        $xmlRepresentation->documentElement->removeAttributeNS(C::NAMESPACE, 'attr1');
        $xmlRepresentation->documentElement->removeAttributeNS(C::NAMESPACE, 'ssp');

        /** @var \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\AbstractQNameAssertionType $qna */
        $qna = static::$testedClass::fromXML($xmlRepresentation->documentElement);

        $this->assertEquals(
            $xmlRepresentation->saveXML($xmlRepresentation->documentElement),
            strval($qna),
        );
    }
}
