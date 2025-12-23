<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702;

use DOMElement;
use SimpleSAML\WebServices\SecurityPolicy\Assert\Assert;
use SimpleSAML\XMLSchema\Exception\InvalidDOMElementException;

use function sprintf;

/**
 * Class representing WS security policy EmptyType.
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
abstract class AbstractEmptyType extends AbstractSpElement
{
    /**
     * AbstractEmptyType constructor.
     */
    final public function __construct()
    {
    }


    /**
     * Initialize an EmptyType.
     *
     * Note: this method cannot be used when extending this class, if the constructor has a different signature.
     *
     * @throws \SimpleSAML\XMLSchema\Exception\InvalidDOMElementException
     *   if the qualified name of the supplied element is wrong
     */
    public static function fromXML(DOMElement $xml): static
    {
        $qualifiedName = static::getClassName(static::class);
        Assert::eq(
            $xml->localName,
            $qualifiedName,
            sprintf('Unexpected name for EmptyType: %s. Expected: %s.', $xml->localName, $qualifiedName),
            InvalidDOMElementException::class,
        );


        return new static();
    }


    /**
     * Convert this element to XML.
     */
    public function toXML(?DOMElement $parent = null): DOMElement
    {
        return $this->instantiateParentElement($parent);
    }
}
