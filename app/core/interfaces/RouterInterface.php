<?php

namespace core\interfaces;

/**
 * Class RouterInterface
 * @package core\interfaces
 */
interface RouterInterface
{
     public function __construct($namespace);

    /**
     * @return mixed
     * @throws \Exception
     */
    public function callAction();
}