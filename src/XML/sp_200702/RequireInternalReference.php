<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702;

use SimpleSAML\XML\SchemaValidatableElementInterface;
use SimpleSAML\XML\SchemaValidatableElementTrait;

/**
 * An RequireInternalReference element
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
final class RequireInternalReference extends AbstractQNameAssertionType implements SchemaValidatableElementInterface
{
    use SchemaValidatableElementTrait;
}
