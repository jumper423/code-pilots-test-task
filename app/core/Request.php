<?php

namespace core;

use core\interfaces\RequestInterface;

/**
 * Class Request
 * @package core
 */
class Request implements RequestInterface
{
    private $params = [];

    /**
     * Request constructor.
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    /**
     * @param $name
     * @return string|null
     */
    public function get($name)
    {
        return $this->params[$name] ?? null;
    }
}