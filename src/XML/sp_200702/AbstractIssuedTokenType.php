<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702;

use DOMElement;
use SimpleSAML\WebServices\SecurityPolicy\Assert\Assert;
use SimpleSAML\XML\ExtendableAttributesTrait;
use SimpleSAML\XML\ExtendableElementTrait;
use SimpleSAML\XMLSchema\Exception\InvalidDOMElementException;
use SimpleSAML\XMLSchema\Exception\MissingElementException;
use SimpleSAML\XMLSchema\Exception\TooManyElementsException;
use SimpleSAML\XMLSchema\XML\Constants\NS;

use function array_pop;
use function sprintf;

/**
 * Class representing WS security policy IssuedTokenType.
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
abstract class AbstractIssuedTokenType extends AbstractSpElement
{
    use ExtendableAttributesTrait;
    use ExtendableElementTrait;


    /** The namespace-attribute for the xs:any element */
    public const string XS_ANY_ELT_NAMESPACE = NS::OTHER;

    /** The namespace-attribute for the xs:anyAttribute element */
    public const string XS_ANY_ATTR_NAMESPACE = NS::ANY;


    /**
     * IssuedTokenType constructor.
     *
     * @param (
     *   \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\RequestSecurityTokenTemplate
     * ) $requestSecurityTokenTemplate
     * @param (
     *   \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\Issuer|
     *   \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\IssuerName|
     *   null
     * ) $issuer
     * @param \SimpleSAML\XML\SerializableElementInterface[] $elts
     * @param \SimpleSAML\XML\Attribute[] $namespacedAttributes
     */
    final public function __construct(
        protected RequestSecurityTokenTemplate $requestSecurityTokenTemplate,
        protected Issuer|IssuerName|null $issuer = null,
        array $elts = [],
        array $namespacedAttributes = [],
    ) {
        $this->setElements($elts);
        $this->setAttributesNS($namespacedAttributes);
    }


    /**
     * Collect the value of the Issuer property.
     *
     * @return \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\Issuer|\SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\IssuerName|null
     */
    public function getIssuer(): Issuer|IssuerName|null
    {
        return $this->issuer;
    }


    /**
     * Collect the value of the RequestSecurityTokenTemplate property.
     *
     * @return \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\RequestSecurityTokenTemplate
     */
    public function getRequestSecurityTokenTemplate(): RequestSecurityTokenTemplate
    {
        return $this->requestSecurityTokenTemplate;
    }


    /**
     * Initialize an IssuedTokenType.
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
            sprintf('Unexpected name for IssuedTokenType: %s. Expected: %s.', $xml->localName, $qualifiedName),
            InvalidDOMElementException::class,
        );

        $issuer = Issuer::getChildrenOfClass($xml);
        $issuerName = IssuerName::getChildrenOfClass($xml);
        $issuer = array_merge($issuer, $issuerName);

        $requestSecurityTokenTemplate = RequestSecurityTokenTemplate::getChildrenOfClass($xml);
        Assert::minCount($requestSecurityTokenTemplate, 1, MissingElementException::class);
        Assert::maxCount($requestSecurityTokenTemplate, 1, TooManyElementsException::class);

        return new static(
            $requestSecurityTokenTemplate[0],
            array_pop($issuer),
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

        if ($this->getIssuer() !== null) {
            $this->getIssuer()->toXML($e);
        }

        $this->getRequestSecurityTokenTemplate()->toXML($e);

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
