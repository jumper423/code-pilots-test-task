<?php

namespace models;

use core\App;
use core\Model;

/**
 * Class Table
 * @package models
 */
class Table extends Model
{
    private $data;

    public static function getTableName(): string
    {
        return 'Table';
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
    public function getName()
    {
        return $this->data['Name'];
    }

    /**
     * @return bool
     */
    public function isAccess()
    {
        return (bool)$this->data['Access'];
    }

    /**
     * @param null $id
     * @return array
     */
    public function getDataFromTable($id = null): array
    {
        if (!$this->isAccess()) {
            return [];
        }
        $params = [];
        $sql = "SELECT * FROM {$this->getName()} ";
        if ($id) {
            $params['id'] = [$id, \PDO::PARAM_STR];
            $sql .= ' WHERE ID = :id';
        }
        $rows = App::i()->getDB()->rows($sql, $params);
        App::i()->getDB()->bringing($rows);
        if ($rows) {
            switch ($this->getName()) {
                case 'Session':
                    $ids = array_map(function ($row) {
                        return $row['ID'];
                    }, $rows);
                    $speakers = App::i()->getDB()->rows(
                        "SELECT s.*, sp.SessionID
                        FROM Speaker s
                        JOIN SessionSpeaker sp ON s.ID = sp.SpeakerID
                        WHERE sp.SessionID IN (" . implode(',', $ids) . ")");
                    $rows = App::i()->getDB()->joining($rows, 'ID', $speakers, 'SessionID', 'Speakers');
                    break;
            }
        }
        return $rows;
    }
}