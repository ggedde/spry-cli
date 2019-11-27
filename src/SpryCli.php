<?php

$configFile = '';
$cliVendorAutoloadFile = '';

if (!empty($_SERVER['argv'])) {
    $args = $_SERVER['argv'];
    $key = array_search('--config', $args);
    if (false !== $key && isset($args[($key + 1)])) {
        $configFile = $args[($key + 1)];
    }

    if ($configFile && !file_exists($configFile)) {
        die("\e[91mERROR:\e[0m No Config File Found. Path (".$configFile.") does not exist. Check to make sure that the path exists for --config");
    }
}

if (!$configFile) {
    $files = [
        'config.php',
        'spry/config.php',
    ];

    foreach ($files as $file) {
        if (file_exists($file)) {
            $configFile = $file;
            break;
        }
    }
}

if (!$configFile || ($configFile && !file_exists($configFile))) {
    die("\e[91mERROR:\e[0m No Config File Found. Run SpryCli from the same folder that contains your 'config.php' file or 'spry/config.php' or specify the config file path with --config");
}

$files = [
    getcwd().'/vendor/autoload.php',
    dirname(getcwd()).'/vendor/autoload.php',
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $cliVendorAutoloadFile = $file;
        break;
    }
}

if (!$cliVendorAutoloadFile) {
    die("\e[91mERROR:\e[0m No vendor/autoload.php file found. If your composer vendor folder is global or in another location you will need to specify the vendor path in your 'config.php' file with \$config->cli_vendor_path");
}

// Setup Server Vars for CLI
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';

require_once $cliVendorAutoloadFile;
Spry\SpryConnector\SpryCliConnector::run(dirname(__DIR__));
