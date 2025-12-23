<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702;

use DOMElement;
use SimpleSAML\WebServices\SecurityPolicy\Assert\Assert;
use SimpleSAML\XML\ExtendableAttributesTrait;
use SimpleSAML\XML\ExtendableElementTrait;
use SimpleSAML\XMLSchema\Exception\InvalidDOMElementException;
use SimpleSAML\XMLSchema\Exception\TooManyElementsException;
use SimpleSAML\XMLSchema\XML\Constants\NS;

use function sprintf;

/**
 * Class representing WS security policy AbstractReqPartsType.
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
abstract class AbstractReqPartsType extends AbstractSpElement
{
    use ExtendableElementTrait;
    use ExtendableAttributesTrait;


    /** The namespace-attribute for the xs:any element */
    public const string XS_ANY_ELT_NAMESPACE = NS::OTHER;

    /** The namespace-attribute for the xs:anyAttribute element */
    public const string XS_ANY_ATTR_NAMESPACE = NS::ANY;


    /**
     * AbstractReqPartsType constructor.
     *
     * @param \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\Header[] $header
     * @param \SimpleSAML\XML\SerializableElementInterface[] $details
     * @param \SimpleSAML\XML\Attribute[] $namespacedAttributes
     */
    final public function __construct(
        protected array $header = [],
        array $details = [],
        array $namespacedAttributes = [],
    ) {
        $this->setElements($details);
        $this->setAttributesNS($namespacedAttributes);
    }


    /**
     * Collect the Header
     *
     * @return \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\Header[]
     */
    public function getHeader(): array
    {
        return $this->header;
    }


    /**
     * Test if an object, at the state it's in, would produce an empty XML-element
     */
    public function isEmptyElement(): bool
    {
        return empty($this->getElements())
            && empty($this->getHeader())
            && empty($this->getAttributesNS());
    }


    /**
     * Initialize an ReqPartsType.
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
            sprintf('Unexpected name for Empty: %s. Expected: %s.', $xml->localName, $qualifiedName),
            InvalidDOMElementException::class,
        );

        $header = Header::getChildrenOfClass($xml);
        Assert::maxCount($header, 1, TooManyElementsException::class);

        $details = [];
        return new static(
            $header,
            self::getChildElementsFromXML($xml),
            self::getAttributesNSFromXML($xml),
        );
    }


    /**
     * Convert this element to XML.
     */
    public function toXML(?DOMElement $parent = null): DOMElement
    {
        $e = $this->instantiateParentElement($parent);

        foreach ($this->getHeader() as $header) {
            $header->toXML($e);
        }

        foreach ($this->getElements() as $elt) {
            if (!$elt->isEmptyElement()) {
                $elt->toXML($e);
            }
        }

        foreach ($this->getAttributesNS() as $attr) {
            $attr->toXML($e);
        }

        return $e;
    }
}
