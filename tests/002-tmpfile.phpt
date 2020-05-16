--TEST--
Check if streamfd() works for tmpfile()
--SKIPIF--
<?php
!extension_loaded("streamfd") && echo "skip";
--FILE--
<?php
$file = tmpfile();
var_dump(is_int(streamfd($file)));
--EXPECT--
bool(true)