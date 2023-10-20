<?php

declare(strict_types=1);

require 'TcpSocket.php';

final class Client extends TcpSocket
{
    public function __construct()
    {
        parent::__construct();

        $this->connect('127.0.0.1', 1111);
    }

    public function __invoke(): void
    {
        while (true) {
            socket_getpeername($this->getListeningSocket(), $ipAddr, $port);

            do {
                $message = readline('Write message: ');
            } while (!$message);

            $this->writeToSocket($this->getListeningSocket(), $message);

            echo "Message sent to $ipAddr:$port \n\n";

            $response = $this->readFromSocket($this->getListeningSocket());

            echo "Message from $ipAddr:$port: $response\n\n";
        }
    }

    protected function connect(string $ipAddr, int $port): void
    {
        if (!socket_connect($this->getListeningSocket(), $ipAddr, $port)) {
            $this->echoErrorAndExit();
        }
    }
}

$client = new Client();

$client();
