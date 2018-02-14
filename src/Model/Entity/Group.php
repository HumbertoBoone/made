<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Group Entity
 *
 * @property int $id
 * @property string $name
 * @property int $required
 * @property string $description
 * @property string $type
 * @property int $order
 * @property int $item_id
 *
 * @property \App\Model\Entity\Item $item
 * @property \App\Model\Entity\Option[] $options
 * @property \App\Model\Entity\OrdersDetail[] $orders_details
 */
class Group extends Entity
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
        'name' => true,
        'required' => true,
        'description' => true,
        'type' => true,
        'order' => true,
        'item_id' => true,
        'item' => true,
        'options' => true,
        'orders_details' => true
    ];
}
