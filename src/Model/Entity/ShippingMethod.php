<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ShippingMethod Entity
 *
 * @property int $id
 * @property string $description
 * @property float $price
 * @property string $status
 *
 * @property \App\Model\Entity\Coupon[] $coupons
 */
class ShippingMethod extends Entity
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
        'description' => true,
        'price' => true,
        'status' => true,
        'coupons' => true
    ];
}
