<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702;

use SimpleSAML\XML\SchemaValidatableElementInterface;
use SimpleSAML\XML\SchemaValidatableElementTrait;

/**
 * An WssKerberosV5ApReqToken11 element
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
final class WssKerberosV5ApReqToken11 extends AbstractQNameAssertionType implements SchemaValidatableElementInterface
{
    use SchemaValidatableElementTrait;
}
