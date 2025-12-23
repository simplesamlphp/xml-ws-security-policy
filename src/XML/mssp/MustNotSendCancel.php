<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\mssp;

use SimpleSAML\WebServices\SecurityPolicy\Constants as C;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\AbstractQNameAssertionType;
use SimpleSAML\XML\SchemaValidatableElementInterface;
use SimpleSAML\XML\SchemaValidatableElementTrait;

/**
 * An MustNotSendCancel element
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
final class MustNotSendCancel extends AbstractQNameAssertionType implements SchemaValidatableElementInterface
{
    use SchemaValidatableElementTrait;


    public const string NS = C::NS_MSSP;

    public const string NS_PREFIX = 'mssp';

    public const string SCHEMA = 'resources/schemas/mssp.xsd';
}
