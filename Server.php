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

            $request = $this->readFromSocket($this->clientSocket);

            echo "Message from $ipAddr:$port: $request\n\n";

            $currentDate = date('d.m.Y. H:i:s');

            if (str_starts_with($request, 'GET')) {
                $http_response = "HTTP/1.1 200 OK\r\n";
                $http_response .= "Content-Type: text/html\r\n";
                $http_response .= "\r\n";

                $html_body = "<!DOCTYPE html><html><body><h1>$currentDate</h1></body></html>";

                $response = $http_response . $html_body;
            } elseif ($request === 'SIMPLE TIME') {
                $response = $currentDate;
            } else {
                $response = 'Unknown command';
            }

            $this->writeToSocket($this->clientSocket, $response);

            echo "Client $ipAddr:$port disconnected\n\n";

            socket_close($this->clientSocket);
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

$server = new Server('127.0.0.1', 3456);

$server();
