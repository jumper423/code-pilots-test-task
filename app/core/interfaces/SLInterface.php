<?php

namespace core\interfaces;

/**
 * Interface SLInterface
 * @package core\interfaces
 */
interface SLInterface
{
    /**
     * @param string $serviceName
     * @param $service
     */
    public function set(string $serviceName, $service);

    /**
     * @param string $serviceName
     * @return mixed
     */
    public function get(string $serviceName);
}