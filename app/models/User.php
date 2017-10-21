<?php

namespace models;

use core\App;
use core\Model;

/**
 * Class User
 * @package models
 */
class User extends Model
{
    private $data;

    public static function getTableName(): string
    {
        return 'Users';
    }

    /**
     * Table constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return (int)$this->data['ID'];
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->data['Email'];
    }
}