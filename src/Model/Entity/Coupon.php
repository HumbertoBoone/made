<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Coupon Entity
 *
 * @property int $id
 * @property string $code
 * @property float $min_amount
 * @property \Cake\I18n\FrozenTime $created
 * @property int $count
 * @property string $type
 * @property int $single_use
 * @property \Cake\I18n\FrozenTime $expiration_date
 * @property float $value
 * @property int $active
 * @property int $shipping_method_id
 *
 * @property \App\Model\Entity\ShippingMethod $shipping_method
 * @property \App\Model\Entity\Item[] $items
 */
class Coupon extends Entity
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
        'code' => true,
        'min_amount' => true,
        'created' => true,
        'count' => true,
        'type' => true,
        'single_use' => true,
        'expiration_date' => true,
        'value' => true,
        'active' => true,
        'shipping_method_id' => true,
        'shipping_method' => true,
        'items' => true
    ];
}
