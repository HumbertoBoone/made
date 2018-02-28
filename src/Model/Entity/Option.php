<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Option Entity
 *
 * @property int $id
 * @property int $group_id
 * @property string $name
 * @property string $text
 * @property float $value
 * @property int $available
 * @property string $placeholder
 * @property int $stock
 *
 * @property \App\Model\Entity\Group $group
 */
class Option extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'group_id' => true,
        'name' => true,
        'text' => true,
        'value' => true,
        'available' => true,
        'placeholder' => true,
        'stock' => true,
        'group' => true
    ];
}
