<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\TestUtils\sp_200507;

use function strval;

/**
 * Class \SimpleSAML\WebServices\SecurityPolicy\TestUtils\sp_200507\NestedPolicyTypeTestTrait
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
        /** @var \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\AbstractNestedPolicyType $np */
        $np = new static::$testedClass([static::$policy, static::$some], [static::$attr]);

        $this->assertEquals(
            static::$xmlRepresentation->saveXML(static::$xmlRepresentation->documentElement),
            strval($np),
        );
    }
}
