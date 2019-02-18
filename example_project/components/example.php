<?php

namespace Spry\SpryComponent;

use Spry\Spry;
use Spry\SpryUtilities;

class Example
{
	/**
	 * Variable to store the table name
	 *
	 * @access 'private'
	 */
	private static $table = 'examples_table';


	/**
	 * Fields used to retrieve data from table
	 * It is recommended to use array and specify each field rather then using wildcard
	 *
	 * @access 'private'
	 */
	private static $fields = '*';



	/**
	 * Returns a single Example
	 *
 	 * @param array $params
 	 * @param int $id
 	 *
 	 * @access 'public'
 	 * @return array
	 */

	public static function get($params=[])
	{
		return Spry::response(000, Spry::db()->get(self::$table, self::$fields, $params));
	}



	/**
	 * Returns all Examples
	 *
 	 * @param array $params
 	 *
 	 * @access 'public'
 	 * @return array
	 */

	public static function get_all($params=[])
	{
		// Set Possible Order Columns
		$params['ORDER'] = SpryUtilities::dbGetOrder([
			self::$table.'.id',
			self::$table.'.updated_at',
			self::$table.'.created_at',
		]);

		return Spry::response(000, Spry::db()->select(self::$table, self::$fields, $params));
	}



	/**
	 * Inserts an Example
	 *
 	 * @param array $params
 	 *
 	 * @access 'public'
 	 * @return array
	 */

	public static function insert($params=[])
	{
		// Additional Conditions and Filtering here

		// Generate Response and return ID on Success or NULL on Failure
		$response = Spry::db()->insert(self::$table, $params) ? ['id' => Spry::db()->id()] : null;
		return Spry::response(000, $response);
	}



	/**
	 * Updates an Example
	 *
 	 * @param array $params
 	 *
 	 * @access 'public'
 	 * @return array
	 */

	public static function update($params=[])
	{
		// Set Where statement
		$where = [
			'id' => $params['id']
		];

		// Generate Response and return ID on Success or NULL on Failure
		$response = Spry::db()->update(self::$table, $params, $where) ? ['id' => $params['id']] : null;
		return Spry::response(000, $response);

	}



	/**
	 * Deletes an Example
	 *
 	 * @param array $params
 	 *
 	 * @access 'public'
 	 * @return array
	 */

	public static function delete($params=[])
	{
		$response = Spry::db()->delete(self::$table, $params) ? 1 : null;
		return Spry::response(000, $response);
	}

}
