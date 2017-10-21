<?php

namespace core;

use core\interfaces\SLInterface;

/**
 * Service Locator
 *
 * Class SL
 * @package core
 */
class SL implements SLInterface
{
    /**
     * @var array
     */
    private $services = [];

    /**
     * @param string $serviceName
     * @param $service
     */
    public function set(string $serviceName, $service)
    {
        $this->services[$serviceName] = $service;
    }

    /**
     * @param string $serviceName
     * @return mixed
     */
    public function get(string $serviceName)
    {
        if (isset($this->services[$serviceName])) {
            return $this->services[$serviceName];
        }
        throw new \OutOfRangeException('Service is not found');
    }
}