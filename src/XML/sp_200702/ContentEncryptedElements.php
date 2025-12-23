<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702;

use SimpleSAML\XML\SchemaValidatableElementInterface;
use SimpleSAML\XML\SchemaValidatableElementTrait;

/**
 * An ContentEncryptedElements element
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
final class ContentEncryptedElements extends AbstractSerElementsType implements SchemaValidatableElementInterface
{
    use SchemaValidatableElementTrait;
}
