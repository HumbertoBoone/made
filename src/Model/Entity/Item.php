<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Item extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}