<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507;

use SimpleSAML\XML\SchemaValidatableElementInterface;
use SimpleSAML\XML\SchemaValidatableElementTrait;

/**
 * An SignedParts element
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
final class SignedParts extends AbstractSePartsType implements SchemaValidatableElementInterface
{
    use SchemaValidatableElementTrait;
}
