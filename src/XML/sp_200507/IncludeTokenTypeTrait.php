<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507;

use SimpleSAML\WebServices\SecurityPolicy\Constants as C;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\Type\IncludeTokenValue;

/**
 * Trait grouping common functionality for elements that can hold IncludeToken attributes.
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
trait IncludeTokenTypeTrait
{
    /**
     * The included token.
     *
     * @var \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\Type\IncludeTokenValue|null
     */
    protected ?IncludeTokenValue $includeToken = null;


    /**
     * Collect the value of the includeToken-property
     *
     * @return \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\Type\IncludeTokenValue|null
     */
    public function getIncludeToken(): ?IncludeTokenValue
    {
        return $this->includeToken;
    }


    /**
     * Set the value of the includeToken-property
     *
     * @param array<\SimpleSAML\XML\Attribute> $namespacedAttributes
     */
    protected function setIncludeToken(array $namespacedAttributes = []): void
    {
        foreach ($namespacedAttributes as $attr) {
            if ($attr->getNamespaceURI() === C::NS_SEC_POLICY_11 && $attr->getAttrName() === 'IncludeToken') {
                $this->includeToken = IncludeTokenValue::fromString($attr->getAttrValue()->getValue());
                return;
            }
        }
    }
}
