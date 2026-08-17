<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702;

<<<<<<< HEAD
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\Type\XPathValue;
use SimpleSAML\XML\TypedTextContentTrait;
=======
use SimpleSAML\XML\TypedTextContentTrait;
use SimpleSAML\XMLSchema\Type\Helper\XPathValue;
>>>>>>> release-2.x

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
