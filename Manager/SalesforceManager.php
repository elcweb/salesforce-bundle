<?php

namespace Elcweb\SalesforceBundle\Manager;

use Phpforce\SoapClient\Client;
use Lsw\MemcacheBundle\Cache\AntiDogPileMemcache as Memcache;

class SalesforceManager
{
    protected $prefix;
    protected $soapClient;
    protected $memcached;
    protected $memcached_ttl;

    public function __construct(Client $soapClient, Memcache $memcached, $memcached_ttl)
    {
        $this->soapClient    = $soapClient;
        $this->memcached     = $memcached;
        $this->memcached_ttl = $memcached_ttl;
    }

    public function get($sObjectType, $id, $refresh = false)
    {
        $fields      = false;
        $object      = false;

        if (!$refresh) {
            $object = $this->memcached->get($this->prefix.'salesforce.object.'.$id);
        }

        if (!$object) {
            // Get fields from memcache
            if (!$refresh) {
                $fields = $this->memcached->get($this->prefix.'salesforce.objectFields.'.$sObjectType);
            }
            
            // If no data, ask Salesforce and save to memcached.
            if (!$fields) {
                $obj = $this->soapClient->call('describeSObject', array('sObjectType' => $sObjectType));

                $fields = array();
                foreach ($obj->getFields() as $field) {
                    $fields[] = $field->getName();
                }

                $fields = $this->memcached->set($this->prefix.'salesforce.objectFields.'.$sObjectType, $fields, $this->memcached_ttl);
            }

            // TODO: Log Salesforce Query and Result
            $object = $this->soapClient->retrieve($fields, array($id), $sObjectType);
            $object = $object[0];
            
            // Set Memcached
            $this->memcached->set($this->prefix.'salesforce.object.'.$id, $object, $this->memcached_ttl);
        }

        return $object;
    }
}
