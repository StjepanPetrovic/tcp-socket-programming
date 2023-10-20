<?php

declare(strict_types=1);

require 'TcpSocket.php';

final class Server extends TcpSocket
{
    private Socket $clientSocket;

    public function __construct(string $serverIpAddr, int $serverPort)
    {
        parent::__construct();

        $this->bind($serverIpAddr, $serverPort);

        $this->listen();
    }

    public function __invoke()
    {
        while (true) {
            $this->accept();

            socket_getpeername($this->clientSocket, $ipAddr, $port);

            echo "Client $ipAddr:$port connected\n\n";

            while (true) {
                $response = $this->readFromSocket($this->clientSocket);

                echo "Message from $ipAddr:$port: $response\n\n";

                do {
                    $message = readline('Write message: ');
                } while (!$message);

                $this->writeToSocket($this->clientSocket, $message);

                echo "Message sent to $ipAddr:$port\n\n";
            }
        }
    }

    private function bind(string $serverIpAddr, int $serverPort): void
    {
        if (!socket_bind($this->getListeningSocket(), $serverIpAddr, $serverPort)) {
            $this->echoErrorAndExit();
        }

        echo "Server is listening on $serverIpAddr:$serverPort\n\n";
    }

    private function listen(): void
    {
        if (!socket_listen($this->getListeningSocket(), 5)) {
            $this->echoErrorAndExit();
        }
    }

    private function accept(): void
    {
        if (!$this->clientSocket = socket_accept($this->getListeningSocket())) {
            $this->echoErrorAndExit();
        }
    }
}

$server = new Server('127.0.0.1', 1111);

$server();
