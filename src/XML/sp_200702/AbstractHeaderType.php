<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702;

use DOMElement;
use SimpleSAML\WebServices\SecurityPolicy\Assert\Assert;
use SimpleSAML\XML\ExtendableAttributesTrait;
use SimpleSAML\XMLSchema\Exception\InvalidDOMElementException;
use SimpleSAML\XMLSchema\Type\AnyURIValue;
use SimpleSAML\XMLSchema\Type\QNameValue;
use SimpleSAML\XMLSchema\XML\Constants\NS;

use function sprintf;

/**
 * Class representing WS security policy HeaderType.
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
abstract class AbstractHeaderType extends AbstractSpElement
{
    use ExtendableAttributesTrait;


    /** The namespace-attribute for the xs:anyAttribute element */
    public const string XS_ANY_ATTR_NAMESPACE = NS::ANY;

    /** The exclusions for the xs:anyAttribute element */
    public const array XS_ANY_ATTR_EXCLUSIONS = [
        [null, 'Name'],
        [null, 'Namespace'],
    ];


    /**
     * AbstractHeaderType constructor.
     *
     * @param \SimpleSAML\XMLSchema\Type\AnyURIValue $namespace
     * @param \SimpleSAML\XMLSchema\Type\QNameValue|null $name
     * @param \SimpleSAML\XML\Attribute[] $namespacedAttributes
     */
    final public function __construct(
        protected AnyURIValue $namespace,
        protected ?QNameValue $name = null,
        array $namespacedAttributes = [],
    ) {
        $this->setAttributesNS($namespacedAttributes);
    }


    /**
     * Collect the value of the Name property.
     *
     * @return \SimpleSAML\XMLSchema\Type\QNameValue|null
     */
    public function getName(): ?QNameValue
    {
        return $this->name;
    }


    /**
     * Collect the value of the Namespace property.
     *
     * @return \SimpleSAML\XMLSchema\Type\AnyURIValue
     */
    public function getNamespace(): AnyURIValue
    {
        return $this->namespace;
    }


    /**
     * Initialize an HeaderType.
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
            sprintf('Unexpected name for HeaderType: %s. Expected: %s.', $xml->localName, $qualifiedName),
            InvalidDOMElementException::class,
        );

        $namespacedAttributes = self::getAttributesNSFromXML($xml);
        $namespace = self::getAttribute($xml, 'Namespace', AnyURIValue::class);

        return new static(
            $namespace,
            $xml->hasAttribute('Name') ? QNameValue::fromString($xml->getAttribute('Name')) : null,
            $namespacedAttributes,
        );
    }


    /**
     * Convert this element to XML.
     */
    public function toXML(?DOMElement $parent = null): DOMElement
    {
        $e = $this->instantiateParentElement($parent);

        if ($this->getName() !== null) {
            $e->setAttribute('Name', $this->getName()->getValue());
        }

        $e->setAttribute('Namespace', $this->getNamespace()->getValue());

        foreach ($this->getAttributesNS() as $attr) {
            $attr->toXML($e);
        }

        return $e;
    }
}
