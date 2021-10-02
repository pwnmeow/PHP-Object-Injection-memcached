<!DOCTYPE html>
<html lang="en">

<?php

require_once('colours.php');
require_once('logger.php');

$cache =  new \Memcached();
$cache->addServer('localhost', '11211');

if(isset($_POST['fg_colour']) && isset($_POST['bg_colour']))
{
    $col_obj = new \Colours();
    $col_obj->fg_colour = $_POST['fg_colour'];
    $col_obj->bg_colour = $_POST['bg_colour'];
    $cache->set($_SERVER['REMOTE_ADDR'],serialize($col_obj));
}


$col_cache = $cache->get($_SERVER['REMOTE_ADDR']);

if(isset($col_cache) && !empty($col_cache))
{
    $colours = unserialize($col_cache);
    $fg = $colours->fg_colour;
    $bg = $colours->bg_colour;
}



?>


<head>
<style type="text/css">
  body {
     color: <?php echo $fg ?>;
     background-color: <?php echo $bg ?>;
  }
</style>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<form method="post">
<input type="color" id="fg_colour" name="fg_colour">
<label for="fg_colour">Foreground</label>
<input type="color" id="bg_colour" name="bg_colour">
<label for="bg_colour">Background</label>
<button type="submit" >Set</button>
</form>

</body>
</html>
