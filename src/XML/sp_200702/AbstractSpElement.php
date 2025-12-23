<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702;

use SimpleSAML\WebServices\SecurityPolicy\Constants as C;
use SimpleSAML\XML\AbstractElement;

/**
 * Abstract class to be implemented by all the classes in this namespace
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
abstract class AbstractSpElement extends AbstractElement
{
    public const string NS = C::NS_SEC_POLICY_12;

    public const string NS_PREFIX = 'sp';

    public const string SCHEMA = 'resources/schemas/ws-securitypolicy-1.2.xsd';
}
