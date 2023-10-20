<?php

declare(strict_types=1);

abstract class TcpSocket
{
    private Socket $listeningSocket;

    public function __construct()
    {
        if (!$this->listeningSocket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) {
            $this->echoErrorAndExit();
        }
    }

    public function __destruct()
    {
        socket_close($this->listeningSocket);
    }

    protected function getListeningSocket(): Socket
    {
        return $this->listeningSocket;
    }

    protected function writeToSocket(Socket $socket, string $data): void
    {
        if (!socket_write($socket, $data, strlen($data))) {
            $this->echoErrorAndExit();
        }
    }

    protected function readFromSocket(Socket $socket): string
    {
        if (!$data = socket_read($socket, 1024)) {
            $this->echoErrorAndExit();
        }

        return $data;
    }

    protected function echoErrorAndExit(): void
    {
        echo "Error: " . socket_strerror(socket_last_error($this->listeningSocket)) . "\n";

        exit(1);
    }
}
