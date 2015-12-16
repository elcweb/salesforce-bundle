<?php

namespace Elcweb\SalesforceBundle\Config;

/**
 * Class Config
 * @package Elcweb\SalesforceBundle\Config
 */
abstract class Config
{
    /** @var string */
    protected $wsdl;

    /** @var string */
    protected $username;

    /** @var string */
    protected $password;

    /** @var string */
    protected $token;

    /** @var array */
    protected $soapOptions;

    /**
     * @return string
     */
    public function getWsdl()
    {
        return $this->wsdl;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return array
     */
    public function getSoapOptions()
    {
        return $this->soapOptions;
    }
}