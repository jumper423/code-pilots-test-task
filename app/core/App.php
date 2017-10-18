<?php

namespace core;

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
     * @return SL
     */
    public function getSL(): SL
    {
        return $this->sl;
    }

    /**
     * @param SL $sl
     */
    public function setSL(SL $sl)
    {
        $this->sl = $sl;
    }

    /**
     * @return DB
     */
    public function getDB(): DB
    {
        return $this->sl->get('db');
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->sl->get('router');
    }

    public function handle()
    {
        return $this->getRouter()->callAction();
    }
}