<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy;

/**
 * Class holding constants relevant for Web Services Security Policy.
 *
 * @package simplesamlphp/xml-ws-security-policy
 */

class Constants extends \SimpleSAML\XML\Constants
{
    /**
     * The namespace for the Microsoft Security Policy protocol.
     */
    public const string NS_MSSP = 'http://schemas.microsoft.com/ws/2005/07/securitypolicy';

    /**
     * The namespace for the Web Service Security Policy protocol v1.1.
     */
    public const string NS_SEC_POLICY_11 = 'http://schemas.xmlsoap.org/ws/2005/07/securitypolicy';

    /**
     * The namespace for the Web Service Security Policy protocol v1.2.
     */
    public const string NS_SEC_POLICY_12 = 'http://docs.oasis-open.org/ws-sx/ws-securitypolicy/200702';
}
