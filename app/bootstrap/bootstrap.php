<?php

$sl = new \core\SL();
$sl->set('db', new \core\DB([
    'database' => 'test_task',
    'user' => 'test_task',
    'password' => 'test_task',
    'host' => 'cp_mysql',
    'port' => 3306,
]));
$sl->set('router', new \core\Router('\controllers'));
\core\App::i()->setSL($sl);