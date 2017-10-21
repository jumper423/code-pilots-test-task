<?php

namespace core\interfaces;

/**
 * Interface DBInterface
 * @package core\interfaces
 */
interface DBInterface
{
    public function begin();

    public function commit();

    public function rollback();

    /**
     * @param \PDOStatement $stmt
     * @param array $params
     */
    public function setParams(&$stmt, $params = []);

    public function query($string, $params = []);

    public function row($string, $params = []);

    public function columnValue($string, $params = []);

    public function rows($string, $params = []);

    public function bringing(&$rows);

    public function joining($rows, $key, $joinRows, $joinKey, $arrayKey);
}