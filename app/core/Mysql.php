<?php

namespace core;

use core\interfaces\DBInterface;
use PDO;

class Mysql implements DBInterface
{
    /**
     * @var \PDO
     */
    private $pdo;
    private $settings;

    /**
     * DataBase constructor.
     *
     * [
     *    'database' => 'mydb',
     *    'user' => 'root',
     *    'password' => '123321',
     *    'host' => 'localhost',
     *    'port' => 3306,
     * ]
     *
     * @param array $settings
     */
    public function __construct($settings)
    {
        $this->settings = array_merge([
            'database' => null,
            'user' => 'root',
            'password' => null,
            'host' => 'localhost',
            'port' => 3306,
        ], $settings);
    }

    /**
     * @return \PDO
     */
    private function getPDO()
    {
        if (null === $this->pdo) {
            $this->pdo = new PDO(
                "mysql:host={$this->settings['host']};port={$this->settings['port']};dbname={$this->settings['database']}",
                $this->settings['user'],
                $this->settings['password']
            );
        }
        return $this->pdo;
    }

    public function begin()
    {
        return $this->getPDO()->beginTransaction();
    }

    public function commit()
    {
        return $this->getPDO()->commit();
    }

    public function rollback()
    {
        return $this->getPDO()->rollBack();
    }

    /**
     * @param \PDOStatement $stmt
     * @param array $params
     */
    public function setParams(&$stmt, $params = [])
    {
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $stmt->bindParam(":$key", $value[0], $value[1]);
            } else {
                $stmt->bindParam(":$key", $value, PDO::PARAM_STR);
            }
        }
    }

    public function query($string, $params = [])
    {
        $stmt = $this->getPDO()->prepare($string);
        $this->setParams($stmt, $params);
        $stmt->execute();
    }

    public function row($string, $params = [])
    {
        $stmt = $this->getPDO()->prepare($string);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_LAZY);
    }

    public function columnValue($string, $params = [])
    {
        $stmt = $this->getPDO()->prepare($string);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function rows($string, $params = [])
    {
        $stmt = $this->getPDO()->prepare($string);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringing(&$rows)
    {
        foreach ($rows as &$value) {
            if (is_array($value)) {
                $this->bringing($value);
            } else {
                if (is_numeric($value)) {
                    $value = (int)$value;
                }
            }
        }
    }

    public function joining($rows, $key, $joinRows, $joinKey, $arrayKey)
    {
        if (!$joinRows) {
            return $rows;
        }
        $sessions = [];
        foreach ($rows as $row) {
            $sessions[$row[$key]] = $row;
        }
        foreach ($joinRows as $joinRow) {
            $sessionId = $joinRow[$joinKey];
            unset($joinRow[$joinKey]);
            if (!isset($sessions[$sessionId][$arrayKey])) {
                $sessions[$sessionId][$arrayKey] = [];
            }
            $this->bringing($joinRow);
            $sessions[$sessionId][$arrayKey][] = $joinRow;
        }
        return array_values($sessions);
    }
}