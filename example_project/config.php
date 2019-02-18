<?php

// Salt for Security.  Change this to be Unique for each one of your API's.
// You should use a long and Strong key.
// DO NOT CHANGE IT ONCE YOU HAVE CREATED DATA.  Otherwise things like logins may no longer work.
$config->salt = '';

// Set PHP and API Log file Locations
// THESE SHOULD BE DISABLED IN PRODUCTION (OR AT LEAST SET SOMEWHERE IN A PRIVATE FOLDER)
$config->logger = 'Spry\\SpryProvider\\SpryLog';
$config->log_format = '%date_time% %ip% %path% - %msg%';
$config->log_php_format = "%date_time% %errstr% %errfile% [Line: %errline%]\n%backtrace%";
$config->log_php_file = __DIR__.'/logs/php.log';
$config->log_api_file = __DIR__.'/logs/api.log';
$config->log_prefix = [
	'message' => 'Spry: ',
	'warning' => 'Spry Warning: ',
	'error' => 'Spry ERROR: ',
	'stop' => 'Spry STOPPED: ',
	'response' => 'Spry Response: ',
	'request' => 'Spry Request: '
];

// Set Default Timezone
date_default_timezone_set('America/Los_Angeles');

// Set PHP Error Types
ini_set('error_reporting', E_ALL);

$config->endpoint = 'http://localhost:8000';
$config->components_dir = __DIR__.'/components';

// WebTools
$config->webtools_enabled = false;
$config->webtools_endpoint = '/webtools';  	// Make sure this is unique and does not clash with your controllers
$config->webtools_username = '';			// Username is required
$config->webtools_password = '';			// Password is required
$config->webtools_allowed_ips = [
	'127.0.0.1',
	'::1'
];

// Database
$config->db = [
	'provider' => 'Spry\\SpryProvider\\SpryDB',
	'database_type' => 'mysql',
	'database_name' => '',
	'server' => 'localhost',
	'username' => '',
	'password' => '',
	'charset' => 'utf8',
	'port' => 3306,
	'prefix' => 'api_x_', // Should change this to be someting Unique
	'schema' => [
		'tables' => [
			'users' => [
				'columns' => [
					'name' => [
						'type' => 'string'
					],
					'email' => [
						'type' => 'string'
					],
				]
			]
		]
	]
];

// Routes
$config->routes = [
	// '/example/get' => [
	// 	'label' => 'Get Example',
	// 	'controller' => 'Example::get',
	// 	'public' => true,
	// 	'active' => true,
	// ],
	// '/example/get_all' => [
	// 	'label' => 'Get All Examples',
	// 	'controller' => 'Example::get_all',
	// 	'public' => true,
	// 	'active' => true,
	// ],
	// '/example/insert' => [
	// 	'label' => 'Create Example',
	// 	'controller' => 'Example::insert',
	// 	'public' => true,
	// 	'active' => true,
	// ],
	// '/example/update' => [
	// 	'label' => 'Update Example',
	// 	'controller' => 'Example::update',
	// 	'public' => true,
	// 	'active' => true,
	// ],
	// '/example/delete' => [
	// 	'label' => 'Delete Example',
	// 	'controller' => 'Example::delete',
	// 	'public' => true,
	// 	'active' => true,
	// ],
];

$config->response_codes = [

	/* Auth */
	// 2200 => ['en' => 'Authentication Passed Successfully'],
	// 5200 => ['en' => 'Error: Invalid Username and Password'],
	// 5201 => ['en' => 'Error: Account is Not Valid'],
	//
	// 2201 => ['en' => 'Success'],
	//
	// 2202 => ['en' => 'Successfully Retrieved Available Permissions'],
	// 5202 => ['en' => 'Error: Retrieving Available Permissions'],
	//
	// 2203 => ['en' => 'Successfully Granted Access'],
	// 5203 => ['en' => 'Error: User does not have permission for that resource'],

	/* Example */
	// 2300 => ['en' => 'Successfully Retrieved Example'],
	// 4300 => ['en' => 'No Example with that ID Found'],
	// 5300 => ['en' => 'Error: Retrieving Example'],

	// 2301 => ['en' => 'Successfully Retrieved Examples'],
	// 4301 => ['en' => 'No Results Found'],
	// 5301 => ['en' => 'Error: Retrieving Examples'],

	// 2302 => ['en' => 'Successfully Created Example'],
	// 5302 => ['en' => 'Error: Creating Example'],

	// 2303 => ['en' => 'Successfully Updated Example'],
	// 4303 => ['en' => 'No Example with that ID Found'],
	// 5303 => ['en' => 'Error: Updating Example'],

	// 2304 => ['en' => 'Successfully Deleted Example'],
	// 5304 => ['en' => 'Error: Deleting Example'],

];

// Tests
$config->tests = [
	'connection' => [
		'title' => 'Connection Test',
		'route' => '/testconnection',
		'params' => [],
		'expect' => [
			'code' => 5011,
		]
	],
];

// Response Headers
$config->response_headers = [
	'Access-Control-Allow-Origin: *',
	'Access-Control-Allow-Methods: GET, POST, OPTIONS',
	'Access-Control-Allow-Headers: X-Requested-With, content-type'
];

////////////////////////////////////////////////////////////////////////
// HOOKS - called after various methods
////////////////////////////////////////////////////////////////////////

$config->hooks->configure = [
	'Spry\\SpryProvider\\SpryLog::setup_php_logs',		// Called after the Config has been set.
	'Spry\\SpryProvider\\SpryWebTools::WebTools'		// Display Webtools if configured.
];

$config->hooks->set_params = [
	'Spry\\SpryProvider\\SpryLog::initial_request'		// Called after the Params have been set.
];

// $config->hooks->set_routes = [
// 	'Spry\\SpryProvider\\SpryLog::user_request'
// ];

// $config->hooks->database = []; 						// Called after the Database has been connected.

$config->hooks->stop = [
	'Spry\\SpryProvider\\SpryLog::stop'					// Called after any Stop response.
];

////////////////////////////////////////////////////////////////////////
// FILTERS - called after various methods.  Must return (parameter).
////////////////////////////////////////////////////////////////////////

// $config->filters->configure = []							// Must return $config

$config->filters->build_response = [
	'Spry\\SpryProvider\\SpryLog::build_response_filter'	// Must return $response
];

// $config->filters->response = []; 						// Must return $response
// $config->filters->get_path = [];  						// Must return $path
// $config->filters->get_route = [];  						// Must return $route
// $config->filters->params = [];  							// Must return $params
// $config->filters->output = [];  							// Must return $output
// $config->filters->validate_params = []					// Must return $params
