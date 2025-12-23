<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507;

use SimpleSAML\XML\SchemaValidatableElementInterface;
use SimpleSAML\XML\SchemaValidatableElementTrait;

/**
 * An SecureConversationToken element
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
final class SecureConversationToken extends AbstractSecureConversationTokenType implements
    SchemaValidatableElementInterface
{
    use SchemaValidatableElementTrait;
}
