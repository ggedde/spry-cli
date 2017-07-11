<?php

$config_file = '';
$cli_vendor_autoload_file = '';

if(!empty($_SERVER['argv']))
{
    $args = $_SERVER['argv'];
    $key = array_search('--config', $args);
    if($key !== false && isset($args[($key + 1)]))
    {
        $config_file = $args[($key + 1)];
    }

    if($config_file && !file_exists($config_file))
    {
        die("\e[91mERROR:\e[0m No Config File Found. Path (".$config_file.") does not exist. Check to make sure that the path exists for --config");
    }
}

if(!$config_file)
{
    $files = [
        'config.php',
        'spry/config.php'
    ];

    foreach($files as $file)
    {
        if(file_exists($file))
        {
            $config_file = $file;
            break;
        }
    }
}

if(!$config_file || ($config_file && !file_exists($config_file)))
{
    die("\e[91mERROR:\e[0m No Config File Found. Run SpryCli from the same folder that contains your 'config.php' file or 'spry/config.php' or specify the config file path with --config");
}

$config = new stdClass();
$config->hooks = new stdClass();
$config->db = new stdClass();
require_once($config_file);

if(!empty($config->cli_vendor_path))
{
    $cli_vendor_autoload_file = rtrim($config->cli_vendor_path, '/').'/autoload.php';
    if(!file_exists($cli_vendor_autoload_file))
    {
        die("\e[91mERROR:\e[0m \$config->cli_vendor_path specified in config.php (".$config->cli_vendor_path."), but ".$cli_vendor_autoload_file." file does not exist. Make sure the 'autoload.php' file exists in the folder of \$config->cli_vendor_path");
    }
}
else
{
    $files = [
        getcwd().'/vendor/autoload.php',
        dirname(getcwd()).'/vendor/autoload.php'
    ];

    foreach($files as $file)
    {
        if(file_exists($file))
        {
            $cli_vendor_autoload_file = $file;
            break;
        }
    }
}

if(!$cli_vendor_autoload_file)
{
    die("\e[91mERROR:\e[0m No vendor/autoload.php file found. If your composer vendor folder is global or in another location you will need to specify the vendor path in your 'config.php' file with \$config->cli_vendor_path");
}

require_once $cli_vendor_autoload_file;
Spry\SpryConnector\SpryCliConnector::run();
