<?php

declare(strict_types=1);

namespace SimpleSAML\WebServices\SecurityPolicy\Utils;

use Dom;
use SimpleSAML\WebServices\SecurityPolicy\Constants as C;

/**
 * Compilation of utilities for XPath.
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
class XPath extends \SimpleSAML\XPath\XPath
{
    /*
     * Get a Dom\XPath object that can be used to search for WS Security elements.
     *
     * @param \Dom\Node $node The document to associate to the Dom\XPath object.
     * @param bool $autoregister Whether to auto-register all namespaces used in the document
     *
     * @return \Dom\XPath A Dom\XPath object ready to use in the given document, with several
     *   ws-related namespaces already registered.
     */
    public static function getXPath(Dom\Node $node, bool $autoregister = false): Dom\XPath
    {
        $xp = parent::getXPath($node, $autoregister);

        $xp->registerNamespace('mssp', C::NS_MSSP);
        $xp->registerNamespace('sp11', C::NS_SEC_POLICY_11);
        $xp->registerNamespace('sp12', C::NS_SEC_POLICY_12);

        return $xp;
    }
}
