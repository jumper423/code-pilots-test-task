<?php

require(__DIR__ . '/vendor/autoload.php');
require __DIR__ . '/bootstrap/bootstrap.php';

\core\App::i()->getDB()->query(file_get_contents(__DIR__ . '/migration.sql'));