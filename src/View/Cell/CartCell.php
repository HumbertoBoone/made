<?php
namespace App\View\Cell;

use Cake\View\Cell;

class CartCell extends Cell
{

    public function display()
    {
        $session = $this->request->session();
        $items = $session->read('items');
        $this->set('items_count', count($items));
    }

}