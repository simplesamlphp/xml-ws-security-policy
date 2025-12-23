<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507;

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
    protected ?IncludeTokenValue $includeToken;


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
     * @param \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\Type\IncludeTokenValue|null $includeToken
     */
    protected function setIncludeToken(?IncludeTokenValue $includeToken = null): void
    {
        $this->includeToken = $includeToken;
    }
}
