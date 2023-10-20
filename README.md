# TCP Socket programming in PHP

The solution was developed using the PHP (v8.2) programming language, which has built-in functions for working with sockets, and the functions I used are:

`socket_create` https://www.php.net/manual/en/function.socket-create.php

`socket_bind` https://www.php.net/manual/en/function.socket-bind.php

`socket_listen` https://www.php.net/manual/en/function.socket-listen.php

`socket_accept` https://www.php.net/manual/en/function.socket-accept.php

`socket_strerror` https://www.php.net/manual/en/function.socket-strerror.php

`socket_last_error` https://www.php.net/manual/en/function.socket-last-error.php

`socket_read` https://www.php.net/manual/en/function.socket-read.php

`socket_write` https://www.php.net/manual/en/function.socket-write.php

`socket_getpeername` https://www.php.net/manual/en/function.socket-getpeername.php

`socket_close` https://www.php.net/manual/en/function.socket-close.php

The object-oriented source code is written in the following files:

- TcpSocket.php, which contains the main logic for creating and closing sockets, as well as reading and writing to the socket.
- Server.php, which contains methods for TCP server and which will be executed and act as the server.
- Client.php, which contains methods for TCP client and which will be executed and act as the client.

The server and client communicate by exchanging messages entered via the terminal. The process involves waiting for user input on the client, which is then sent to the server after confirmation. The server receives the message and displays it in the terminal, and then it waits for the user's input, which will be sent to the client.

To test this, you need to open one terminal and run the command "php Server.php" and in another terminal, run "php Client.php." This way, you can exchange messages between the server and the client.
