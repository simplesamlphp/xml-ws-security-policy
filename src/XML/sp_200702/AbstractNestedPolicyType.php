<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702;

use DOMElement;
use SimpleSAML\WebServices\SecurityPolicy\Assert\Assert;
use SimpleSAML\XML\ExtendableAttributesTrait;
use SimpleSAML\XML\ExtendableElementTrait;
use SimpleSAML\XMLSchema\Exception\InvalidDOMElementException;
use SimpleSAML\XMLSchema\XML\Constants\NS;

/**
 * Class representing sp:NestedPolicyType
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
abstract class AbstractNestedPolicyType extends AbstractSpElement
{
    use ExtendableAttributesTrait;
    use ExtendableElementTrait;


    /** The namespace-attribute for the xs:any element */
    public const string XS_ANY_ELT_NAMESPACE = NS::OTHER;

    /** The namespace-attribute for the xs:anyAttribute element */
    public const string XS_ANY_ATTR_NAMESPACE = NS::ANY;


    /**
     * Initialize an AbstractNestedPolicyType.
     *
     * @param \SimpleSAML\XML\SerializableElementInterface[] $elements
     * @param \SimpleSAML\XML\Attribute[] $attributes
     */
    final public function __construct(array $elements = [], array $attributes = [])
    {
        $this->setElements($elements);
        $this->setAttributesNS($attributes);
    }


    /**
     * Test if an object, at the state it's in, would produce an empty XML-element
     */
    public function isEmptyElement(): bool
    {
        return empty($this->getAttributesNS())
            && empty($this->getElements());
    }


    /**
     * Convert XML into a AbstractNestedPolicyType
     *
     * @throws \SimpleSAML\XMLSchema\Exception\InvalidDOMElementException
     *   if the qualified name of the supplied element is wrong
     */
    public static function fromXML(DOMElement $xml): static
    {
        Assert::same($xml->localName, static::getLocalName(), InvalidDOMElementException::class);
        Assert::same($xml->namespaceURI, static::NS, InvalidDOMElementException::class);

        return new static(
            self::getChildElementsFromXML($xml),
            self::getAttributesNSFromXML($xml),
        );
    }


    /**
     * Convert this AbstractNestedPolicyType to XML.
     */
    public function toXML(?DOMElement $parent = null): DOMElement
    {
        $e = $this->instantiateParentElement($parent);

        foreach ($this->getAttributesNS() as $attr) {
            $attr->toXML($e);
        }

        foreach ($this->getElements() as $element) {
            if (!$element->isEmptyElement()) {
                $element->toXML($e);
            }
        }

        return $e;
    }
}
