<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702;

use SimpleSAML\XML\SchemaValidatableElementInterface;
use SimpleSAML\XML\SchemaValidatableElementTrait;

/**
 * An UsernameToken element
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
final class UsernameToken extends AbstractTokenAssertionType implements SchemaValidatableElementInterface
{
    use SchemaValidatableElementTrait;
}
