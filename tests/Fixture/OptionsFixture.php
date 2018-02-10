<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OptionsFixture
 *
 */
class OptionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'group_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_german1_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'value' => ['type' => 'decimal', 'length' => 15, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'available' => ['type' => 'tinyinteger', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'stock' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_groups_options_groups1_idx' => ['type' => 'index', 'columns' => ['group_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_groups_options_groups1' => ['type' => 'foreign', 'columns' => ['group_id'], 'references' => ['groups', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_german1_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'group_id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'value' => 1.5,
            'available' => 1,
            'stock' => 1
        ],
    ];
}
