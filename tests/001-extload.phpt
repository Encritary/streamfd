--TEST--
Check if streamfd extension is loaded
--SKIPIF--
<?php
!extension_loaded("streamfd") && echo "skip";
--FILE--
<?php
echo "Extension streamfd is loaded";
--EXPECT--
Extension streamfd is loaded
