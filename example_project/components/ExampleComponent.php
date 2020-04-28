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
class ExampleComponent
{
    /**
     * Return the Id
     *
     * @access public
     *
     * @return string
     */
    public static function getId()
    {
        return 1;
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
        return 'examples';
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
        return [
            'id',
            'name',
        ];
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
            self::getTable() => [
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
                'controller' => 'ExampleComponent::get',
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
                'controller' => 'ExampleComponent::insert',
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
                'controller' => 'ExampleComponent::update',
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
                'controller' => 'ExampleComponent::delete',
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
            0 => [ // Get Single
                'success' => ['en' => 'Successfully Retrieved Example'],
                'warning' => ['en' => 'No Example with that ID Found'],
                'error' => ['en' => 'Error: Retrieving Example'],
            ],
            1 => [ // Select
                'info' => ['en' => 'No Results Found'],
                'success' => ['en' => 'Successfully Retrieved Examples'],
                'error' => ['en' => 'Error: Retrieving Examples'],
            ],
            2 => [ // Insert
                'success' => ['en' => 'Successfully Created Example'],
                'error' => ['en' => 'Error: Creating Example'],
            ],
            3 => [ // Update
                'success' => ['en' => 'Successfully Updated Example'],
                'error' => ['en' => 'Error: Updating Example'],
            ],
            4 => [ // Delete
                'success' => ['en' => 'Successfully Deleted Example'],
                'error' => ['en' => 'Error: Deleting Example'],
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
            return Spry::response(Spry::db()->get(self::getTable(), self::getFields(), ['id' => $params['id']]), 0);
        }

        // Prepare the Select statement and include Pagination and totals if needed
        $prepareSelect = SpryUtilities::dbPrepareSelect(self::getTable(), null, $params, $meta, ['id', 'name']);

        // Select Examples based on Prepared Select
        $response = Spry::db()->select(self::getTable(), self::getFields(), $prepareSelect->where);

        // Return Response and Meta if needed
        return Spry::response($response, null, $prepareSelect->meta, 1);
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
        $response = Spry::db()->insert(self::getTable(), $params) ? ['id' => Spry::db()->id()] : null;

        return Spry::response($response, 2);
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

        $example = self::get($where)->body;

        // Check to make sure requested Example exists
        if (empty($example['id'])) {
            Spry::stop(0);
        }

        // Generate Response and return ID on Success or NULL on Failure
        $response = Spry::db()->update(self::getTable(), $params, $where) ? ['id' => $example['id']] : null;

        return Spry::response($response, 3);
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

        $example = self::get($where)->body;

        // Check to make sure requested Example exists
        if (empty($example['id'])) {
            Spry::stop(0);
        }

        // Delete Item and Return 1 on Success or NULL on Failure
        $response = Spry::db()->delete(self::getTable(), $where) ? 1 : null;

        return Spry::response($response, 4);
    }
}
