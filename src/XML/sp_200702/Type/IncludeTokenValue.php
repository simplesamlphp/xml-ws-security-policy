<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\Type;

use SimpleSAML\Assert\Assert;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\AbstractSpElement;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\IncludeToken;
use SimpleSAML\XML\Attribute as XMLAttribute;
use SimpleSAML\XMLSchema\Exception\SchemaViolationException;
use SimpleSAML\XMLSchema\Type\AnyURIValue;

/**
 * @package simplesaml/xml-ws-security-policy
 */
class IncludeTokenValue extends AnyURIValue
{
    /**
     * Validate the value.
     *
     * @throws \SimpleSAML\XMLSchema\Exception\SchemaViolationException on failure
     */
    protected function validateValue(string $value): void
    {
        Assert::oneOf(
            $this->sanitizeValue($value),
            array_column(IncludeToken::cases(), 'value'),
            SchemaViolationException::class,
        );
    }


    /**
     * Convert this value to an attribute
     *
     * @return \SimpleSAML\XML\Attribute
     */
    public function toAttribute(): XMLAttribute
    {
        return new XMLAttribute(AbstractSpElement::NS, AbstractSpElement::NS_PREFIX, 'IncludeToken', $this);
    }


    /**
     * @return \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\IncludeToken $value
     */
    public function toEnum(): IncludeToken
    {
        return IncludeToken::from($this->getValue());
    }


    /**
     * @param \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\IncludeToken $value
     * @return static
     */
    public static function fromEnum(IncludeToken $value): static
    {
        return new static($value->value);
    }
}
