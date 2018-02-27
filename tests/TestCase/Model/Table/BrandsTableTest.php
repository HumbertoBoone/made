<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BrandsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BrandsTable Test Case
 */
class BrandsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BrandsTable
     */
    public $Brands;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.brands',
        'app.items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Brands') ? [] : ['className' => BrandsTable::class];
        $this->Brands = TableRegistry::get('Brands', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Brands);

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
