<?php

namespace Elcweb\SalesforceBundle\Factory;

use Elcweb\SalesforceBundle\Config\Config;
use Elcweb\SalesforceBundle\SoapClient\ClientBuilder;

/**
 * Class SoapClientFactory
 * @package Elcweb\SalesforceBundle\Factory
 */
class SoapClientFactory
{
    /** @var Config  */
    private $config;

    /**
     * SoapClientFactory constructor.
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return ClientBuilder
     */
    public function create()
    {
        return new ClientBuilder(
            $this->config->getWsdl(),
            $this->config->getUsername(),
            $this->config->getPassword(),
            $this->config->getToken()
        );
    }
}
