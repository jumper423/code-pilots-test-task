<?php

namespace core;

/**
 * Class Model
 * @package core
 */
abstract class Model
{
    abstract public static function getTableName(): string;

    /**
     * @param $params
     * @return static|false
     */
    public static function one(array $params)
    {
        $whereString = [];
        $whereParams = [];
        foreach ($params as $name => $param) {
            $whereString[] = "{$name} = :{$name}";
            $whereParams[$name] = [$param, \PDO::PARAM_STR];
        }
        $row = App::i()->getDB()->row('SELECT * FROM `'. static::getTableName().'` WHERE ' . implode($whereString), $whereParams);
        if ($row) {
            return new static((array)$row);
        } else {
            return false;
        }
    }
}