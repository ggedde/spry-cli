<?php

/**
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

namespace Spry\SpryComponent;

use Spry\Spry;
use Spry\SpryUtilities;

/**
 * Spry Component
 */
class Examples
{
    /**
     * Variable to store the Component ID
     *
     * @access private
     */
    private static $id = 1;

    /**
     * Variable to store the table name
     *
     * @access private
     */
    private static $table = 'examples';

    /**
     * Fields used to retrieve data from table
     * It is recommended to use array and specify each field rather then using wildcard
     *
     * @access private
     */
    private static $fields = [
        'id',
        'name',
    ];

    /**
     * Return the Id
     *
     * @access public
     *
     * @return string
     */
    public static function getId()
    {
        return self::$id;
    }

    /**
     * Return the Table
     *
     * @access public
     *
     * @return string
     */
    public static function getTable()
    {
        return self::$table;
    }

    /**
     * Return the Fields
     *
     * @access public
     *
     * @return string|array
     */
    public static function getFields()
    {
        return self::$fields;
    }

    /**
     * Schema used to build Tables in the Database
     *
     * @access public
     *
     * @return array
     */
    public static function getSchema()
    {
        return [
            self::$table => [
                'columns' => [
                    'name' => [
                        'type' => 'string',
                    ],
                ],
            ],
        ];
    }

    /**
     * Routes used for the Component
     *
     * @access public
     *
     * @return array
     */
    public static function getRoutes()
    {
        return [
            '/example/get' => [
                'label' => 'Get Example',
                'controller' => 'Examples::get',
                'access' => 'public',
                'methods' => 'GET',
                'params' => [
                    'id' => [
                        'type' => 'int',
                    ],
                    'pagination_page' => [
                        'type' => 'int',
                        'meta' => true,
                    ],
                    'pagination_page_limit' => [
                        'type' => 'int',
                        'meta' => true,
                    ],
                    'pagination_count' => [
                        'type' => 'int',
                        'meta' => true,
                    ],
                    'orderby' => [
                        'type' => 'string',
                        'oneof' => ['id', 'name', 'updated_at', 'created_at'],
                        'meta' => true,
                    ],
                    'order' => [
                        'type' => 'string',
                        'oneof' => ['ASC', 'DESC'],
                        'meta' => true,
                    ],
                    'search' => [
                        'type' => 'string',
                        'meta' => true,
                    ],
                ],
            ],
            '/example/insert' => [
                'label' => 'Insert Example',
                'controller' => 'Examples::insert',
                'access' => 'public',
                'methods' => 'POST',
                'params' => [
                    'name' => [
                        'required' => true,
                        'type' => 'string',
                        'minlength' => 1,
                    ],
                ],
            ],
            '/example/update' => [
                'label' => 'Update Example',
                'controller' => 'Examples::update',
                'access' => 'public',
                'methods' => 'POST',
                'params' => [
                    'id' => [
                        'required' => true,
                        'type' => 'int',
                    ],
                    'name' => [
                        'type' => 'string',
                        'minlength' => 1,
                    ],
                ],
            ],
            '/example/delete' => [
                'label' => 'Delete Example',
                'controller' => 'Examples::delete',
                'access' => 'public',
                'methods' => 'POST',
                'params' => [
                    'id' => [
                        'required' => true,
                        'type' => 'int',
                    ],
                ],
            ],
        ];
    }

    /**
     * Codes used for the Response
     *
     * @access public
     *
     * @return array
     */
    public static function getCodes()
    {
        return [
            // Get Single
            '201' => ['en' => 'Successfully Retrieved Example'],
            '401' => ['en' => 'No Example with that ID Found'],
            '501' => ['en' => 'Error: Retrieving Example'],
            // Get
            '102' => ['en' => 'No Results Found'],
            '202' => ['en' => 'Successfully Retrieved Examples'],
            '502' => ['en' => 'Error: Retrieving Examples'],
            // Insert
            '203' => ['en' => 'Successfully Created Example'],
            '503' => ['en' => 'Error: Creating Example'],
            // Update
            '204' => ['en' => 'Successfully Updated Example'],
            '504' => ['en' => 'Error: Updating Example'],
            // Delete
            '205' => ['en' => 'Successfully Deleted Example'],
            '505' => ['en' => 'Error: Deleting Example'],
        ];
    }

    /**
     * Tests used for the Component
     *
     * @access public
     *
     * @return array
     */
    public static function getTests()
    {
        return [
            'examples_get_all_empty' => [
                'label' => 'Get All Examples Empty',
                'route' => '/example/get',
                'method' => 'GET',
                'params' => [
                    'name' => '!',
                ],
                'expect' => [
                    'status' => 'success',
                ],
            ],
            'examples_insert' => [
                'label' => 'Insert Example',
                'route' => '/example/insert',
                'method' => 'POST',
                'params' => [
                    'name' => 'TestData',
                ],
                'expect' => [
                    'status' => 'success',
                ],
            ],
            'examples_get_all' => [
                'label' => 'Get All Examples',
                'route' => '/example/get',
                'method' => 'GET',
                'params' => [],
                'expect' => [
                    'status' => 'success',
                ],
            ],
            'examples_get' => [
                'label' => 'Get Example',
                'route' => '/example/get',
                'method' => 'GET',
                'params' => [
                    'id' => '{examples_insert.body.id}',
                ],
                'expect' => [
                    'status' => 'success',
                ],
            ],
            'examples_get_empty' => [
                'label' => 'Get Example Empty',
                'route' => '/example/get',
                'method' => 'GET',
                'params' => [
                    'id' => '-1',
                ],
                'expect' => [
                    'status' => 'error',
                ],
            ],
            'examples_update' => [
                'label' => 'Update Example',
                'route' => '/example/update',
                'method' => 'POST',
                'params' => [
                    'id' => '{examples_insert.body.id}',
                    'name' => 'UpdatedTestData',
                ],
                'expect' => [
                    'status' => 'success',
                ],
            ],
            'examples_delete' => [
                'label' => 'Delete Example',
                'route' => '/example/delete',
                'method' => 'POST',
                'params' => [
                    'id' => '{examples_insert.body.id}',
                ],
                'expect' => [
                    'status' => 'success',
                ],
            ],
        ];
    }

    /**
     * Returns a single Example
     *
     * @param array $params
     * @param array $meta
     *
     * @access public
     *
     * @return SpryResponse
     */
    public static function get($params = [], $meta = [])
    {
        // Get Single
        if (!empty($params['id'])) {
            return Spry::response([self::$id, 1], Spry::db()->get(self::$table, self::$fields, ['id' => $params['id']]));
        }

        // Prepare the Select statement and include Pagination and totals if needed
        $prepareSelect = SpryUtilities::dbPrepareSelect(self::$table, $params, $meta, ['id', 'name']);

        // Select Examples based on Prepared Select
        $response = Spry::db()->select(self::$table, self::$fields, $prepareSelect->where);

        // Return Response and Meta if needed
        return Spry::response([self::$id, 2], $response, null, $prepareSelect->meta);
    }

    /**
     * Inserts an Example
     *
     * @param array $params
     * @param array $meta
     *
     * @access public
     *
     * @return SpryResponse
     */
    public static function insert($params = [], $meta = [])
    {
        // Additional Conditions and Filtering here

        // Generate Response and return ID on Success or NULL on Failure
        $response = Spry::db()->insert(self::$table, $params) ? ['id' => Spry::db()->id()] : null;

        return Spry::response([self::$id, 3], $response);
    }

    /**
     * Updates an Example
     *
     * @param array $params
     * @param array $meta
     *
     * @access public
     *
     * @return SpryResponse
     */
    public static function update($params = [], $meta = [])
    {
        // Set Where statement
        $where = [
            'id' => $params['id'],
        ];

        // Check to make sure requested Example exists
        if (empty(self::get($where)->body['id'])) {
            Spry::stop([self::$id, 401]);
        }

        // Generate Response and return ID on Success or NULL on Failure
        $response = Spry::db()->update(self::$table, $params, $where) ? ['id' => $params['id']] : null;

        return Spry::response([self::$id, 4], $response);
    }

    /**
     * Deletes an Example
     *
     * @param array $params
     * @param array $meta
     *
     * @access public
     *
     * @return SpryResponse
     */
    public static function delete($params = [], $meta = [])
    {
        // Set Where statement
        $where = [
            'id' => $params['id'],
        ];

        // Check to make sure requested Example exists
        if (empty(self::get($where)->body['id'])) {
            Spry::stop([self::$id, 401]);
        }

        // Delete Item and Return 1 on Success or NULL on Failure
        $response = Spry::db()->delete(self::$table, $where) ? 1 : null;

        return Spry::response([self::$id, 5], $response);
    }
}
