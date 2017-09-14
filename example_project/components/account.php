<?php

namespace Spry\SpryComponent;

use Spry\Spry as Spry;

class Account
{
	private static $table = 'accounts';

	/**
	 * Returns the Account
	 *
 	 * @param string $username
 	 * @param string $password
 	 *
 	 * @access 'public'
 	 * @return array
	 */

	public static function get()
	{
		$where = [
			'AND' => [
				'id' => Spry::auth()->account_id,
				'status' => 'active'
			]
		];

		return Spry::response(400, Spry::db()->get(self::$table, '*', $where));
	}

}
