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
		// Use Params from route as where statemnt
		$where = $params;

		return Spry::response(000, Spry::db()->get(self::$table, '*', $where));
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
		// Use Params from route as where statemnt
		$where = $params;

		// Set Possible Order Columns
		$where['ORDER'] = SpryUtilities::dbGetOrder([
			self::$table.'.id',
			self::$table.'.updated_at',
			self::$table.'.created_at',
		]);

		return Spry::response(000, Spry::db()->select(self::$table, '*', $where));
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
		// Use Params from route as data
		$data = $params;

		// Additional Conditions and Filtering here

		// Generate Response and return ID on Success or NULL on Failure
		$response = Spry::db()->insert(self::$table, $data) ? ['id' => Spry::db()->id()] : null;
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
		// Use Params from route as data
		$data = $params;

		// Set Where statement
		$where = [
			'id' => $params['id']
		];

		// Generate Response and return ID on Success or NULL on Failure
		$response = Spry::db()->update(self::$table, $data, $where) ? ['id' => $params['id']] : null;
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
		// Use Params from route as where statemnt
		$where = $params;

		$response = Spry::db()->delete(self::$table, $where) ? 1 : null;
		return Spry::response(000, $response);
	}

}
