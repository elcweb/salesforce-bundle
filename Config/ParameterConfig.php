<?php

namespace Elcweb\SalesforceBundle\Config;

/**
 * Class ParameterConfig
 * @package Elcweb\SalesforceBundle\Config
 */
class ParameterConfig extends Config
{
    /**
     * Construct client builder with required parameters
     *
     * @param string $wsdl        Path to your Salesforce WSDL
     * @param string $username    Your Salesforce username
     * @param string $password    Your Salesforce password
     * @param string $token       Your Salesforce security token
     * @param array  $soapOptions Further options to be passed to the SoapClient
     */
    public function __construct($wsdl, $username, $password, $token, array $soapOptions = array())
    {
        $this->wsdl = $wsdl;
        $this->username = $username;
        $this->password = $password;
        $this->token = $token;
        $this->soapOptions = $soapOptions;
    }
}