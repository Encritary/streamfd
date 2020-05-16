<?php

declare(strict_types=1);

// Windows doesn't support UNIX sockets
$domain = strtolower(substr(PHP_OS, 0, 3)) === "win" ? STREAM_PF_INET : STREAM_PF_UNIX;

// Create a pair of IPC stream sockets
$streams = stream_socket_pair($domain, STREAM_SOCK_STREAM, STREAM_IPPROTO_IP);

if($streams === false or stream_set_blocking($streams[0], false) === false or stream_set_blocking($streams[1], false) === false){
	die("failed to open stream socket pair");
}

// Create a pair of FD streams to access IPC sockets
$fdstreams = [];
$fdstreams[0] = fopen("php://fd/" . streamfd($streams[0]), "r+");
$fdstreams[1] = fopen("php://fd/" . streamfd($streams[1]), "r+");

if($fdstreams[0] === false or $fdstreams[1] === false or stream_set_blocking($fdstreams[0], false) === false or stream_set_blocking($fdstreams[1], false) === false){
	die("failed to open fd stream pair")
}

// Write "hello" to the first and "world" to the second IPC socket
fwrite($fdstreams[0], "hello");
fwrite($fdstreams[1], "world");

// Now read directly from sockets
echo fread($streams[1], 5) . " " . fread($streams[0], 5) . PHP_EOL;
