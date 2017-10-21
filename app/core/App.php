<?php

namespace core;
use core\interfaces\DBInterface;
use core\interfaces\RouterInterface;
use core\interfaces\SLInterface;

/**
 * Class App
 * @package core
 */
class App
{
    private static $instance;

    /** @var SL */
    private $sl;

    /**
     * @return self
     */
    public static function i()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     * @return SLInterface
     */
    public function getSL(): SLInterface
    {
        return $this->sl;
    }

    /**
     * @param SLInterface $sl
     */
    public function setSL(SLInterface $sl)
    {
        $this->sl = $sl;
    }

    /**
     * @return DBInterface
     */
    public function getDB(): DBInterface
    {
        return $this->sl->get('db');
    }

    /**
     * @return RouterInterface
     */
    public function getRouter(): RouterInterface
    {
        return $this->sl->get('router');
    }

    public function handle()
    {
        return $this->getRouter()->callAction();
    }
}