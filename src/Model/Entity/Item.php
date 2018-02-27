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
 * @property string $short_description
 * @property float $price
 * @property float $stock
 * @property string $unit
 * @property int $status
 * @property int $category_id
 * @property int $brand_id
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Brand $brand
 * @property \App\Model\Entity\Group[] $groups
 * @property \App\Model\Entity\Image[] $images
 * @property \App\Model\Entity\Coupon[] $coupons
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
        'short_description' => true,
        'price' => true,
        'stock' => true,
        'unit' => true,
        'status' => true,
        'category_id' => true,
        'brand_id' => true,
        'category' => true,
        'brand' => true,
        'groups' => true,
        'images' => true,
        'coupons' => true
    ];
}
