<?php

namespace Spry\SpryComponent;

use Spry\Spry as Spry;

class Auth
{

	private static $table_users = 'users';
	private static $table_accounts = 'accounts';

	private static $auth_fields = [
		'accounts.id(account_id)',
		'users.id(user_id)',
		'users.permissions(user_permissions)',
		'users.access_key(access_key)'
	];



	/**
	 * Returns the Account ID and Access_key
	 *
 	 * @param string $username
 	 * @param string $password
 	 *
 	 * @access 'public'
 	 * @return array
	 */

	public static function login()
	{
		$username = Spry::validator()->required()->minLength(1)->validate('username');
		$password = Spry::validator()->required()->minLength(1)->validate('password');

		sleep(1); // Reduce Hack attempts

		$where = [
			'AND' => [
				self::$table_users.'.username' => $username,
				self::$table_users.'.password' => Spry::hash($password),
				'accounts.status' => 'active'
			]
		];

		$join = [
			'[>]'.self::$table_users => ["id" => "account_id"]
		];

		$request = Spry::db()->get(self::$table_accounts, $join, self::$auth_fields, $where);

		if(empty($request['user_id']))
		{
			sleep(5); // Reduce Hack attempts
		}

		return Spry::response(200, $request);
	}



	/**
	 * Checks the Account ID and Access_key
	 * Sets the Auth object
	 *
 	 * @param string $username
 	 * @param string $password
 	 *
 	 * @access 'public'
 	 * @return array
	 */

	 public static function set()
 	{
 		// Skip this Check if request is by username and password
 		if(Spry::get_path() === '/auth/login/')
 		{
 			return;
 		}

 		// Run Auth Check
 		$access_key = Spry::validator()->required()->minLength(1)->validate('access_key');

 		$where = [
 			'AND' => [
 				self::$table_users.'.access_key' => $access_key,
 				self::$table_accounts.'.status' => 'active'
 			]
 		];

 		$join = [
 			'[>]'.self::$table_users => ['id' => 'account_id']
 		];

 		$request = Spry::db()->get(self::$table_accounts, $join, self::$auth_fields, $where);

 		if(!empty($request['account_id']))
 		{
 			$auth = (object) $request;
 			if($auth->user_permissions !== '*')
 			{
 				$auth->user_permissions = array_map('trim', json_decode($auth->user_permissions, true));
 			}
 			Spry::set_auth($auth);
 			return true;
 		}

 		sleep(5); // Reduce Hack attempts
 		Spry::stop(5201);
 	}



	/**
	 * Returns the Available Persmissions by Routes for Users
	 *
	 * @access 'public'
	 * @return array
	 */

	public static function get_available_permissions()
	{
		$permissions = [];

		foreach (Spry::get_routes() as $route_path => $route)
		{
			$permissions[] = [
				'label' => $route['label'],
				'route' => $route_path
			];
		}

		return Spry::response(202, $permissions);
	}


	/**
	 * Checks if User has Permissions for the requested route
	 *
	 * @access 'public'
	 * @return boolean
	 */

	public static function has_permission($path='')
	{
		if(!$path)
		{
			$path = Spry::get_path();
		}

		if(!empty(Spry::auth()->user_permissions))
		{
			$permissions = Spry::auth()->user_permissions;
		}

		if(!empty($permissions) && ($permissions === '*' || (is_array($permissions) && in_array(trim($path), $permissions))))
		{
			return true;
		}

		return false;
	}



	public static function guard()
	{
		$path = Spry::get_path();

		// Skip this Check if request is by username and password
		if($path === '/auth/login/')
		{
			return true;
		}

		if(!self::has_permission($path))
		{
			sleep(5); // Reduce Hack attempts
			Spry::stop(5203);
		}
	}

}
