<?php

namespace Elcweb\SalesforceBundle\Manager;

use Phpforce\SoapClient\ClientBuilder;
use Lsw\MemcacheBundle\Cache\AntiDogPileMemcache as Memcache;

class SalesforceManager
{
    protected $soapClient;
    protected $memcached;
    protected $memcached_ttl;

    public function __construct(ClientBuilder $soapFactory, Memcache $memcached, $memcached_ttl)
    {
        $this->soapClient    = $soapFactory->build();
        $this->memcached     = $memcached;
        $this->memcached_ttl = $memcached_ttl;
    }

    public function get($sObjectType, $id, $refresh = false)
    {
        $fields = false;
        $object = false;

        if (!$refresh) {
            $object = $this->memcached->get('salesforce.object.'.$id);
        }

        if (!$object) {
            // Get fields from memcache
            if (!$refresh) {
                $fields = $this->memcached->get('salesforce.objectFields.'.$sObjectType);
            }

            try {
                // If no data, ask Salesforce and save to memcached.
                if (!$fields) {
//                    dump($this->soapClient);
//                    dump($sObjectType);
//                    dump($id);
//                    dump($refresh);
                    $obj = $this->soapClient->call('describeSObject', array('sObjectType' => $sObjectType));

                    $fields = array();
                    foreach ($obj->getFields() as $field) {
                        $fields[] = $field->getName();
                    }

                    $this->memcached->set('salesforce.objectFields.'.$sObjectType, $fields, $this->memcached_ttl);
                }

                // TODO: Log Salesforce Query and Result
                $object = $this->soapClient->retrieve($fields, array($id), $sObjectType);
                $object = $object[0];
                
                // Set Memcached
                $this->memcached->set('salesforce.object.'.$id, $object, $this->memcached_ttl);
            } catch (\Exception $e) {
                
            }
        }

        return $object;
    }
}
