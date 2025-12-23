<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507;

use SimpleSAML\WebServices\Addressing\XML\wsa_200408\AbstractEndpointReferenceType;
use SimpleSAML\WebServices\SecurityPolicy\Constants as C;

/**
 * An Issuer element
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
final class Issuer extends AbstractEndpointReferenceType
{
    public const string NS = C::NS_SEC_POLICY_11;

    public const string NS_PREFIX = 'sp';

    /** The exclusions for the xs:any element */
    public const array XS_ANY_ELT_EXCLUSIONS = [
        ['http://schemas.xmlsoap.org/ws/2004/08/addressing', 'Address'],
        ['http://schemas.xmlsoap.org/ws/2004/08/addressing', 'Metadata'],
        ['http://schemas.xmlsoap.org/ws/2004/08/addressing', 'ReferenceParameters'],
        ['http://schemas.xmlsoap.org/ws/2004/08/addressing', 'ReferenceProperties'],
        ['http://schemas.xmlsoap.org/ws/2004/08/addressing', 'PortType'],
        ['http://schemas.xmlsoap.org/ws/2004/08/addressing', 'ServiceName'],
    ];
}
