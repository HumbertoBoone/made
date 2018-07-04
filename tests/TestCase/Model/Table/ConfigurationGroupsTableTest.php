<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConfigurationGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConfigurationGroupsTable Test Case
 */
class ConfigurationGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConfigurationGroupsTable
     */
    public $ConfigurationGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.configuration_groups',
        'app.configurations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ConfigurationGroups') ? [] : ['className' => ConfigurationGroupsTable::class];
        $this->ConfigurationGroups = TableRegistry::get('ConfigurationGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ConfigurationGroups);

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
