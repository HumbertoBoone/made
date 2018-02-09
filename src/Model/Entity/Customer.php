<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property string $company
 * @property string $first_name
 * @property string $last_name
 * @property string $address1
 * @property string $type
 * @property string $address2
 * @property string $tel
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property float $discount
 *
 * @property \App\Model\Entity\Address[] $addresses
 * @property \App\Model\Entity\Order[] $orders
 * @property \App\Model\Entity\User[] $users
 */
class Customer extends Entity
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
        'company' => true,
        'first_name' => true,
        'last_name' => true,
        'address1' => true,
        'type' => true,
        'address2' => true,
        'tel' => true,
        'city' => true,
        'state' => true,
        'postal_code' => true,
        'discount' => true,
        'addresses' => true,
        'orders' => true,
        'users' => true
    ];
}
