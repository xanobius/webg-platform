<?php

namespace App;

use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class DashboardWebsocketHandler implements MessageComponentInterface
{
    public function onOpen(ConnectionInterface $connection)
    {
        \Log::info('opened connection');
        return 'Connected';
    }

    public function onClose(ConnectionInterface $conn)
    {
        \Log::info('Closed');
        return 'close';
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        \Log::alert('Error happened');
        return 'Error';
    }

    public function onMessage(ConnectionInterface $conn, MessageInterface $msg)
    {
        \Log::debug('Received message: ' . $msg);
        return "Thanks buddy";
    }
}
