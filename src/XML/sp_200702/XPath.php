<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702;

use SimpleSAML\XML\TypedTextContentTrait;
use SimpleSAML\XMLSchema\Type\Helper\XPathValue;

/**
 * An XPath element
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
final class XPath extends AbstractSpElement
{
    use TypedTextContentTrait;


    public const string TEXTCONTENT_TYPE = XPathValue::class;
}
