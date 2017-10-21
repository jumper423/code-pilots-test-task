<?php

namespace core;

/**
 * Class Controller
 * @package core
 */
class Controller
{
    protected function response($status = false, $payload = [], $message = '')
    {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => $status ? 'ok' : 'error',
            'payload' => $payload,
            'message' => $message,
        ]);
    }
}