<?php

namespace core\interfaces;

/**
 * Interface RequestInterface
 * @package core\interfaces
 */
interface RequestInterface
{
    /**
     * RequestInterface constructor.
     * @param $params
     */
    public function __construct(array $params);

    /**
     * @param $name
     * @return string|null
     */
    public function get($name);
}