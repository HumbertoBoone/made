<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ShippingMethodsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ShippingMethodsTable Test Case
 */
class ShippingMethodsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ShippingMethodsTable
     */
    public $ShippingMethods;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.shipping_methods',
        'app.coupons',
        'app.items',
        'app.groups',
        'app.categories',
        'app.images',
        'app.coupons_items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ShippingMethods') ? [] : ['className' => ShippingMethodsTable::class];
        $this->ShippingMethods = TableRegistry::get('ShippingMethods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ShippingMethods);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
