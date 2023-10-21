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

The server is communicating with clients by exchanging messages via terminal and browser. The process involves waiting for user input on the client, which is then sent to the server after confirmation. The server receives the request and send response based on client request.

To test sending requests with terminal you need to run `php Server.php` and `php Client.php` in seperate terminals. In client's terminal type 'SIMPLE TIME' to get current time like response from server.
To test sending GET requests with browser you need to run `php Server.php` in terminal. In the browser URL type ip_address:port (127.0.0.1:3456) and click enter. You should get html page with current time like response from server.

