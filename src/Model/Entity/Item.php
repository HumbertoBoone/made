<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property string $sku
 * @property string $name
 * @property string $description
 * @property string $brand
 * @property float $price
 * @property float $stock
 * @property string $unit
 * @property int $status
 * @property int $group_id
 * @property int $category_id
 *
 * @property \App\Model\Entity\OrdersDetail[] $orders_details
 * @property \App\Model\Entity\Image[] $images
 * @property \App\Model\Entity\Category[] $categories
 */
class Item extends Entity
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
        'sku' => true,
        'name' => true,
        'description' => true,
        'brand' => true,
        'price' => true,
        'stock' => true,
        'unit' => true,
        'status' => true,
        'group_id' => true,
        'category_id' => true,
        'orders_details' => true,
        'images' => true,
        'categories' => true
    ];
    protected function _setSku($value)
    {
        if (strlen($value)) {
            return strtoupper($value);
        }
    }
}
