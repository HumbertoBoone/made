<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class OrdersController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->setLayout('admin');
         $this->loadComponent('Paginator');
        $items = $this->Paginator->paginate($this->Orders->find('all'));
        $this->set(compact('items'));
    }
    public function view($id = null)
    {
        
    }
}