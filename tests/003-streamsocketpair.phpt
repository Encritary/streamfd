--TEST--
Check if streamfd() works for stream_socket_pair()
--SKIPIF--
<?php
!extension_loaded("streamfd") && echo "skip";
--FILE--
<?php
$domain = strtolower(substr(PHP_OS, 0, 3)) === "win" ? STREAM_PF_INET : STREAM_PF_UNIX;
$streams = stream_socket_pair($domain, STREAM_SOCK_STREAM, STREAM_IPPROTO_IP);
var_dump(streamfd($streams[0]));
var_dump(streamfd($streams[1]));
--EXPECT--
int(3)
int(4)
