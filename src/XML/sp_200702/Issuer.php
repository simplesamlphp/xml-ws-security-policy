<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702;

use SimpleSAML\WebServices\Addressing\XML\wsa_200508\AbstractEndpointReferenceType;
use SimpleSAML\WebServices\SecurityPolicy\Constants as C;

/**
 * An Issuer element
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
final class Issuer extends AbstractEndpointReferenceType
{
    public const string NS = C::NS_SEC_POLICY_12;

    public const string NS_PREFIX = 'sp';

    /** The exclusions for the xs:any element */
    public const array XS_ANY_ELT_EXCLUSIONS = [
        ['http://www.w3.org/2005/08/addressing', 'Address'],
        ['http://www.w3.org/2005/08/addressing', 'Metadata'],
        ['http://www.w3.org/2005/08/addressing', 'ReferenceParameters'],
    ];
}
