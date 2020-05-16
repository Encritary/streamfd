--TEST--
Check if streamfd() values work with php://fd
--SKIPIF--
<?php
!extension_loaded("streamfd") && echo "skip";
--FILE--
<?php
$domain = strtolower(substr(PHP_OS, 0, 3)) === "win" ? STREAM_PF_INET : STREAM_PF_UNIX;
$streams = stream_socket_pair($domain, STREAM_SOCK_STREAM, STREAM_IPPROTO_IP);
if($streams === false or stream_set_blocking($streams[0], false) === false or stream_set_blocking($streams[1], false) === false){
	echo "failed to open stream socket pair";
	exit;
}
$fdstreams = [];
$fdstreams[0] = fopen("php://fd/" . streamfd($streams[0]), "r+");
$fdstreams[1] = fopen("php://fd/" . streamfd($streams[1]), "r+");
if($fdstreams[0] === false or $fdstreams[1] === false or stream_set_blocking($fdstreams[0], false) === false or stream_set_blocking($fdstreams[1], false) === false){
	echo "failed to open fd stream pair";
	exit;
}
fwrite($fdstreams[0], "hello");
fwrite($fdstreams[1], "world");
var_dump(fread($streams[1], 5));
var_dump(fread($streams[0], 5));
--EXPECT--
string(5) "hello"
string(5) "world"