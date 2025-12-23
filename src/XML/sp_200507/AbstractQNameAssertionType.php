<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507;

use DOMElement;
use SimpleSAML\WebServices\SecurityPolicy\Assert\Assert;
use SimpleSAML\XML\ExtendableAttributesTrait;
use SimpleSAML\XMLSchema\Exception\InvalidDOMElementException;
use SimpleSAML\XMLSchema\XML\Constants\NS;

use function sprintf;

/**
 * Class representing WS security policy QNameAssertionType.
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
abstract class AbstractQNameAssertionType extends AbstractSpElement
{
    use ExtendableAttributesTrait;


    /** The namespace-attribute for the xs:anyAttribute element */
    public const string XS_ANY_ATTR_NAMESPACE = NS::ANY;


    /**
     * AbstractQNameAssertionType constructor.
     *
     * @param list<\SimpleSAML\XML\Attribute> $namespacedAttributes
     */
    final public function __construct(
        array $namespacedAttributes = [],
    ) {
        $this->setAttributesNS($namespacedAttributes);
    }


    /**
     * Initialize an QNameAssertionType.
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
            sprintf('Unexpected name for QNameAssertion: %s. Expected: %s.', $xml->localName, $qualifiedName),
            InvalidDOMElementException::class,
        );


        return new static(self::getAttributesNSFromXML($xml));
    }


    /**
     * Convert this element to XML.
     */
    public function toXML(?DOMElement $parent = null): DOMElement
    {
        $e = $this->instantiateParentElement($parent);

        foreach ($this->getAttributesNS() as $attr) {
            $attr->toXML($e);
        }

        return $e;
    }
}
