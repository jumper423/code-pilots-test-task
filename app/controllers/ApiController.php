<?php

namespace controllers;

use core\App;
use core\Controller;
use core\interfaces\RequestInterface;
use models\Table;
use models\User;

/**
 * Class ApiController
 * @package controllers
 */
class ApiController extends Controller
{
    public function tableAction(RequestInterface $request)
    {
        if (!$request->get('table')) {
            $this->response(false, [], 'Не указана таблица');
            return;
        }
        $table = Table::one([
            'Name' => $request->get('table'),
        ]);
        if (!$table || !$table->isAccess()) {
            $this->response(false, [], 'Не верная таблица');
            return;
        }
        $this->response(true, $table->getDataFromTable($request->get('id')));
    }

    public function sessionSubscribeAction(RequestInterface $request)
    {
        $sessionId = $request->get('sessionId');
        $user = User::one(['Email' => $request->get('userEmail')]);
        if (!$user) {
            $this->response(false, [], 'Нет пользователя');
            return;
        }
        App::i()->getDB()->query("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;");
        App::i()->getDB()->begin();
        App::i()->getDB()->query("INSERT INTO SessionSubscribe (SessionID, UserID) VALUES (:sessionId, :userId) ON DUPLICATE KEY UPDATE UserID = :userId", [
            'sessionId' => [$sessionId, \PDO::PARAM_INT],
            'userId' => [$user->getId(), \PDO::PARAM_INT],
        ]);
        if (App::i()->getDB()->columnValue("SELECT COUNT(*) FROM SessionSubscribe WHERE SessionID = :sessionId", [
                'sessionId' => [$sessionId, \PDO::PARAM_INT],
            ]) <= App::i()->getDB()->columnValue("SELECT NumberOfSeats FROM Session WHERE ID = :sessionId", [
                'sessionId' => [$sessionId, \PDO::PARAM_INT],
            ])) {
            App::i()->getDB()->commit();
            $this->response(true, [], "Спасибо, вы успешно записаны!");
        } else {
            App::i()->getDB()->rollback();
            $this->response(true, [], "Извините, все места заняты!");
        }
    }
}