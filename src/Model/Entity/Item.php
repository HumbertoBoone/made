<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property string $sku
 * @property string $description
 * @property float $price
 * @property float $stock
 * @property string $unit
 * @property string $brand
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
        'id' => true,
        'sku' => true,
        'description' => true,
        'price' => true,
        'stock' => true,
        'unit' => true,
        'brand' => true
    ];
    // se cerciora que el sku se guarde en mayusculas
    protected function _setSku($value)
    {
        if (strlen($value)) {
            return strtoupper($value);
        }
    }
}
