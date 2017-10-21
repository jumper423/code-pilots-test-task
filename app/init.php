<?php

require(__DIR__ . '/vendor/autoload.php');

$sl = new \core\SL();

$sl->set('db', new \core\Mysql([
'database' => 'test_task',
'user' => 'test_task',
'password' => 'test_task',
'host' => 'cp_mysql',
'port' => 3306,
]));

\core\App::i()->setSL($sl);

\core\App::i()->getDB()->query(file_get_contents(__DIR__ . '/migration.sql'));