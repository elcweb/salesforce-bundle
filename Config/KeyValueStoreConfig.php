<?php

namespace Elcweb\SalesforceBundle\Config;

use Elcweb\KeyValueStoreBundle\KeyValueStore;

/**
 * Class KeyValueStoreConfig
 * @package Elcweb\SalesforceBundle\Config
 */
class KeyValueStoreConfig extends Config
{
    /**
     * KeyValueStoreConfig constructor.
     *
     * @param KeyValueStore $keyValueStore
     */
    public function __construct(KeyValueStore $keyValueStore)
    {
        $this->wsdl     = $keyValueStore->get('salesforce.wsdl');
        $this->username = $keyValueStore->get('salesforce.username');
        $this->password = $keyValueStore->get('salesforce.password');
        $this->token    = $keyValueStore->get('salesforce.token');
    }
}
