<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $status
 * @property string $reference
 * @property string $payment_type
 * @property string $recipient_name
 * @property string $address1
 * @property string $address2
 * @property string $postal_code
 * @property string $state
 * @property string $city
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\OrdersDetail[] $orders_details
 */
class Order extends Entity
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
        'customer_id' => true,
        'created' => true,
        'modified' => true,
        'status' => true,
        'reference' => true,
        'payment_type' => true,
        'recipient_name' => true,
        'address1' => true,
        'address2' => true,
        'postal_code' => true,
        'state' => true,
        'city' => true,
        'customer' => true,
        'orders_details' => true
    ];
}
