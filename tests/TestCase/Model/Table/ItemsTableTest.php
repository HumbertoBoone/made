<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemsTable Test Case
 */
class ItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemsTable
     */
    public $Items;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.items',
        'app.orders_details',
        'app.images',
        'app.categories',
        'app.categories_items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Items') ? [] : ['className' => ItemsTable::class];
        $this->Items = TableRegistry::get('Items', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Items);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getCategories method
     *
     * @return void
     */
    public function testGetCategories()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getCategoryEntity method
     *
     * @return void
     */
    public function testGetCategoryEntity()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getImageEntity method
     *
     * @return void
     */
    public function testGetImageEntity()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test saveImage method
     *
     * @return void
     */
    public function testSaveImage()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getItemImages method
     *
     * @return void
     */
    public function testGetItemImages()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getItemForCart method
     *
     * @return void
     */
    public function testGetItemForCart()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
