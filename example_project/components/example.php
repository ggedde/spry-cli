<?php

namespace Spry\SpryComponent;

use Spry\Spry;

class Example
{
	/**
	 * Variable to store the table name
	 *
	 * @access 'private'
	 */
	private static $table = 'examples_table';



	/**
	 * Returns a Single Item by Account
	 *
 	 * @param string $access_key
 	 * @param int $id
 	 *
 	 * @access 'public'
 	 * @return array
	 */

	public static function get()
	{
		// Required Fields
		$id = Spry::validator()->required()->integer()->min(1)->validate('id');

		$where = [
			'AND' => [
				'account_id' => Spry::auth()->account_id,
				'user_id' => Spry::auth()->user_id,
				'id' => $id
			]
		];

		return Spry::response(000, Spry::db()->get(self::$table, '*', $where));
	}



	/**
	 * Returns all Items by Account
	 *
 	 * @param string $access_key
 	 *
 	 * @access 'public'
 	 * @return array
	 */

	public static function get_all()
	{
		$where = [
			'AND' => [
				'account_id' => Spry::auth()->account_id,
				'user_id' => Spry::auth()->user_id,
			],
			'ORDER' => [
				'id' => 'DESC'
			],
			'GROUP' => 'id'
		];

		return Spry::response(000, Spry::db()->select(self::$table, '*', $where));
	}



	/**
	 * Inserts an Item
	 *
 	 * @param string $access_key
 	 *
 	 * @access 'public'
 	 * @return array
	 */

	public static function insert()
	{
		// Required Fields
		$name = Spry::validator()->required()->minLength(1)->validate('name');

		$data = [
			'account_id' => Spry::auth()->account_id,
			'user_id' => Spry::auth()->user_id,
			'name' => $name
		];

		$response = Spry::db()->insert(self::$table, $data)->rowCount() ? ['id' => Spry::db()->id()] : null;
		return Spry::response(000, $response);
	}



	/**
	 * Updates an Item
	 *
 	 * @param string $access_key
 	 * @param int $id
 	 *
 	 * @access 'public'
 	 * @return array
	 */

	public static function update()
	{
		// Required Fields
		$id = Spry::validator()->required()->integer()->min(1)->validate('id');
		$name = Spry::validator()->required()->minLength(1)->validate('name');

		$data = [
			'name' => $name
		];

		$where = [
			'AND' => [
				'account_id' => Spry::auth()->account_id,
				'user_id' => Spry::auth()->user_id,
				'id' => $id
			]
		];

		$response = Spry::db()->update(self::$table, $data, $where)->rowCount() ? ['id' => $id] : null;
		return Spry::response(000, $response);

	}



	/**
	 * Deletes an Item From Account by id
	 *
 	 * @param int $id
 	 * @param string $access_key
 	 *
 	 * @access 'public'
 	 * @return array
	 */

	public static function delete()
	{
		$id = Spry::validator()->required()->integer()->min(1)->validate('id');

		$where = [
			'AND' => [
				'account_id' => Spry::auth()->account_id,
				'user_id' => Spry::auth()->user_id,
				'id' => $id
			]
		];

		$response = Spry::db()->delete(self::$table, $where)->rowCount() ? 1 : null;
		return Spry::response(000, $response);
	}

}
