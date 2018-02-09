<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $customer_id
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $status
 * @property string $verification_token
 * @property \Cake\I18n\FrozenTime $verification_token_created
 * @property string $password_reset_token
 * @property \Cake\I18n\FrozenTime $password_reset_token_created
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Customer $customer
 */
class User extends Entity
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
        'email' => true,
        'password' => true,
        'role' => true,
        'status' => true,
        'verification_token' => true,
        'verification_token_created' => true,
        'password_reset_token' => true,
        'password_reset_token_created' => true,
        'created' => true,
        'modified' => true,
        'customer' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'verification_token',
        'password_reset_token'
    ];

    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();
            return $hasher->hash($value);
        }
    }
}
