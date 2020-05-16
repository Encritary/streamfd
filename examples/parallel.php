<?php

declare(strict_types=1);

// This example shows how you can share sockets between threads using FD.
// The extension used in this example: https://github.com/krakjoe/parallel

if(!extension_loaded("parallel"){
	die("This example requires the Parallel extension");
}

if(socket_create_pair(AF_UNIX, SOCK_STREAM, 0, $pair) === false){
	die("Couldn't create socket pair");
}

// Create a runtime and run the task
$runtime = new parallel\Runtime();
$future = $runtime->run(function(int $fd) : void{
	$socket = socket_import_stream(fopen("php://fd/$fd", "r+"));

	// strlen("hello world") === 11
	echo socket_read($socket, 11) . PHP_EOL;
}, [streamfd(socket_export_stream($pair[0]))]); // Share the first socket of the pair


// Write "hello world" to the second socket of the pair
socket_write($pair[1], "hello world", 11);

// Wait for task to complete
$future->value();
