<?php

$current_dir = getcwd();

if(!file_exists($current_dir.'/vendor/autoload.php') || !file_exists($current_dir.'/spry/init.php'))
{
    echo "Spry Server ERROR: Could not find vendor/autoload.php or spry/init.php<br>
    Make sure you run 'spry up' in your root Project directory that contains both vendor/autoload.php and spry/init.php<br>
    Or run it with your endpoint folder 'spry up {public_dir}' that contains your index.php file.";
    exit;
}

include $current_dir.'/vendor/autoload.php';
include $current_dir.'/spry/init.php';
