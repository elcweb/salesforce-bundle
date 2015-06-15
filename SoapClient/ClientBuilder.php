<?php
/**
 * Created by PhpStorm.
 * User: estheban
 * Date: 15-06-15
 * Time: 4:00 PM
 */

namespace Elcweb\SalesforceBundle\SoapClient;

use Phpforce\SoapClient\ClientBuilder as BaseClientBuilder;
use Phpforce\SoapClient\Soap\SoapClientFactory;
use Phpforce\SoapClient\Plugin\LogPlugin;

class ClientBuilder extends BaseClientBuilder
{
    /**
     * Build the Salesforce SOAP client
     *
     * @return \Elcweb\SalesforceBundle\SoapClient\Client
     */
    public function build()
    {
        $soapClientFactory = new SoapClientFactory();
        $soapClient = $soapClientFactory->factory($this->wsdl, $this->soapOptions);

        $client = new Client($soapClient, $this->username, $this->password, $this->token);

        if ($this->log) {
            $logPlugin = new LogPlugin($this->log);
            $client->getEventDispatcher()->addSubscriber($logPlugin);
        }

        return $client;
    }
}