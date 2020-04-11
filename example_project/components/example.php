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
     * Variable to store the Component ID
     *
     * @access private
     */
    private static $id = 1;

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
            '/examples/get' => [
                'label' => 'Get Example',
                'controller' => 'Examples::get',
                'access' => 'public',
                'methods' => 'GET',
                'params' => [
                    'id' => [
                        'int' => true,
                    ],
                    'pagination_page' => [
                        'int' => true,
                    ],
                    'pagination_page_limit' => [
                        'int' => true,
                    ],
                    'pagination_count' => [
                        'int' => true,
                    ],
                    'orderby' => [
                        'oneof' => ['id', 'name', 'updated_at', 'created_at'],
                    ],
                    'order' => [
                        'oneof' => ['ASC', 'DESC'],
                    ],
                    'search',
                ],
            ],
            '/examples/insert' => [
                'label' => 'Insert Example',
                'controller' => 'Examples::insert',
                'access' => 'public',
                'methods' => 'POST',
                'params' => [
                    'name' => [
                        'required' => true,
                        'minlength' => 1,
                    ],
                ],
            ],
            '/examples/update' => [
                'label' => 'Update Example',
                'controller' => 'Examples::update',
                'access' => 'public',
                'methods' => 'POST',
                'params' => [
                    'id' => [
                        'required' => true,
                        'int' => true,
                    ],
                    'name' => [
                        'minlength' => 1,
                    ],
                ],
            ],
            '/examples/delete' => [
                'label' => 'Delete Example',
                'controller' => 'Examples::delete',
                'access' => 'public',
                'methods' => 'POST',
                'params' => [
                    'id' => [
                        'required' => true,
                        'int' => true,
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
            self::$id => [
                '201' => ['en' => 'Successfully Retrieved Example'],
                '401' => ['en' => 'No Example with that ID Found'],
                '501' => ['en' => 'Error: Retrieving Example'],

                '202' => ['en' => 'Successfully Retrieved Examples'],
                '402' => ['en' => 'No Results Found'],
                '502' => ['en' => 'Error: Retrieving Examples'],

                '203' => ['en' => 'Successfully Created Example'],
                '503' => ['en' => 'Error: Creating Example'],

                '204' => ['en' => 'Successfully Updated Example'],
                '404' => ['en' => 'No Example with that ID Found'],
                '504' => ['en' => 'Error: Updating Example'],

                '205' => ['en' => 'Successfully Deleted Example'],
                '505' => ['en' => 'Error: Deleting Example'],
            ],
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
                'route' => '/examples/get',
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
                'route' => '/examples/insert',
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
                'route' => '/examples/get',
                'method' => 'GET',
                'params' => [],
                'expect' => [
                    'status' => 'success',
                ],
            ],
            'examples_get' => [
                'label' => 'Get Example',
                'route' => '/examples/get',
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
                'route' => '/examples/get',
                'method' => 'GET',
                'params' => [
                    'id' => '-1',
                ],
                'expect' => [
                    'status' => 'success',
                ],
            ],
            'examples_update' => [
                'label' => 'Update Example',
                'route' => '/examples/update',
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
                'route' => '/examples/delete',
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
     *
     * @access public
     *
     * @return SpryResponse
     */
    public static function get($params = [])
    {
        $where = SpryUtilities::dbPrepareWhere(
            $params,
            [
                'id',
                'updated_at',
                'created_at',
            ],
            [
                'pagination_page',
                'pagination_page_limit',
                'pagination_count',
            ]
        );

        // Get Single
        if (!empty($where['id'])) {
            return Spry::response(self::$id, 01, Spry::db()->get(self::$table, self::$fields, $where));
        }

        // Get Multiple - Set Default Totals
        $total = $searchTotal = Spry::db()->count(self::$table, 'id', $where);

        // Set Search Parameter and Fields to search on
        if (!empty($params['search'])) {
            $where['OR'] = [
                'id[~]' => $params['search'],
                'name[~]' => $params['search'],
            ];
            $searchTotal = Spry::db()->count(self::$table, 'id', $where);
        }

        $responseMeta = null;
        $pagination = SpryUtilities::dbGetPagination($params, $total, $searchTotal);

        if (!empty($pagination->limit)) {
            $where['LIMIT'] = $pagination->limit;
            $responseMeta = [
                'pagination' => $pagination->meta,
            ];
        }

        return Spry::response(self::$id, 02, Spry::db()->select(self::$table, self::$fields, $where), null, $responseMeta);
    }

    /**
     * Inserts an Example
     *
     * @param array $params
     *
     * @access public
     *
     * @return SpryResponse
     */
    public static function insert($params = [])
    {
        // Additional Conditions and Filtering here

        // Generate Response and return ID on Success or NULL on Failure
        $response = Spry::db()->insert(self::$table, $params) ? ['id' => Spry::db()->id()] : null;

        return Spry::response(self::$id, 03, $response);
    }

    /**
     * Updates an Example
     *
     * @param array $params
     *
     * @access public
     *
     * @return SpryResponse
     */
    public static function update($params = [])
    {
        // Set Where statement
        $where = [
            'id' => $params['id'],
        ];

        // Generate Response and return ID on Success or NULL on Failure
        $response = Spry::db()->update(self::$table, $params, $where) ? ['id' => $params['id']] : null;

        return Spry::response(self::$id, 04, $response);
    }

    /**
     * Deletes an Example
     *
     * @param array $params
     *
     * @access public
     *
     * @return SpryResponse
     */
    public static function delete($params = [])
    {
        $response = Spry::db()->delete(self::$table, $params) ? 1 : null;

        return Spry::response(self::$id, 05, $response);
    }
}
