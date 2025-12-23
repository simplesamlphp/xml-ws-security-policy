<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507;

use DOMNodeList;
use DOMXPath;
use SimpleSAML\WebServices\SecurityPolicy\Assert\Assert;
use SimpleSAML\XML\DOMDocumentFactory;
use SimpleSAML\XML\TypedTextContentTrait;
use SimpleSAML\XMLSchema\Type\StringValue;

/**
 * An XPath element
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
final class XPath extends AbstractSpElement
{
    use TypedTextContentTrait;


    public const string TEXTCONTENT_TYPE = StringValue::class;


    /**
     * Validate the content of the element.
     *
     * @throws \SimpleSAML\XMLSchema\Exception\SchemaViolationException on failure
     */
    protected function validateContent(string $content): void
    {
        $dom = new DOMXPath(DOMDocumentFactory::create());
        $result = $dom->evaluate($content);
        Assert::isInstanceOf($result, DOMNodeList::class);
    }
}
