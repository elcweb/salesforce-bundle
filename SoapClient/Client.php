<?php

namespace Elcweb\SalesforceBundle\SoapClient;

use Phpforce\SoapClient\Client as BaseClient;

class Client extends BaseClient
{
    /**
     * @param string $method
     * @param array  $params
     *
     * @return array|\Traversable
     * @throws \Exception
     * @throws \SoapFault
     */
    public function call($method, array $params = array())
    {
        return parent::call($method, $params);
    }
}