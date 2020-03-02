<?php

/**
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

namespace Spry;

// Set Default Timezone
date_default_timezone_set('America/Los_Angeles');

// Set PHP Error Types
ini_set('error_reporting', E_ALL);

// Salt for Security.  Change this to be Unique for each one of your API's.
// You should use a long and Strong key.
// DO NOT CHANGE IT ONCE YOU HAVE CREATED DATA.  Otherwise things like logins may no longer work.
$config->salt = '';

// Spry Server Endpoint - Used for internal requests
$config->endpoint = 'http://localhost:8000';

// Components Directory
$config->componentsDir = __DIR__.'/components';

// Database
$config->dbProvider = 'Spry\\SpryProvider\\SpryDB';
$config->db = [
    'database_type' => 'mysql',
    'database_name' => 'spry',
    'server' => '127.0.0.1',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
    'port' => 3306,
    'prefix' => 'api_x_', // Should change this to be someting Unique
    'schema' => [
        'tables' => [],
    ],
];

// Logger - Set PHP and API Log file Locations
// Make sure the log files are set in Private Location
// Using a logger may slow down requests so you may want to disable for faster Production
$config->loggerProvider = 'Spry\\SpryProvider\\SpryLogger';
$config->logger = [
    'format' => '%date_time% %ip% %request_id% %path% - %msg%',
    'php_format' => "%date_time% %errstr% %errfile% [Line: %errline%]\n%backtrace%",
    'php_file' => __DIR__.'/logs/php.log',
    'api_file' => __DIR__.'/logs/api.log',
    'max_lines' => 5000,
    'archive' => false,
    'prefix' => [
        'message' => 'Spry: ',
        'warning' => 'Spry Warning: ',
        'error' => 'Spry ERROR: ',
        'stop' => 'Spry STOPPED: ',
        'response' => 'Spry Response: ',
        'request' => 'Spry Request: ',
    ],
];

// WebTools
$config->webtoolsEnabled = false;
$config->webtoolsEndpoint = '/webtools'; // Make sure this is unique and does not clash with your controllers
$config->webtoolsUsername = ''; // Username is required
$config->webtoolsPassword = ''; // Password is required
$config->webtoolsAllowedIps = [
    '127.0.0.1',
    '::1',
];

// Routes
$config->routes = [];

// Response Codes
$config->responseCodes = [];

// Default Response Headers
$config->responseHeaders = [
    'Access-Control-Allow-Origin: *',
    'Access-Control-Allow-Methods: GET, POST, OPTIONS',
    'Access-Control-Allow-Headers: X-Requested-With, content-type',
];

// Tests
$config->tests = [
    'connection' => [
        'label' => 'Connection Test with Empty Parameters',
        'route' => '/testconnection',
        'params' => [],
        'expect' => [
            'code[===]' => '0-511',
        ],
    ],
    'connection2' => [
        'label' => 'Connection Test with Parameters',
        'route' => '/testconnection',
        'params' => ['test' => 123],
        'expect' => [
            'code[>]' => '0-510',
        ],
    ],
];

////////////////////////////////////////////////////////////////////////
// HOOKS & Filters
////////////////////////////////////////////////////////////////////////
Spry::addHook('configure', 'Spry\\SpryProvider\\SpryLogger::initiate');
// Spry::addHook('setPath', 'Spry\\SpryProvider\\SpryWebTools::webTools');
// Spry::addHook('setParams', 'Spry\\SpryComponent\\Auth::set');
