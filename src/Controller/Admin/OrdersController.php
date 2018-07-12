<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class OrdersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
    public function index()
    {
        $this->viewBuilder()->setLayout('admin');
        $orders = $this->Paginator->paginate($this->Orders->find('all'));
        $this->set(compact('orders'));
    }
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('admin');
        $order = $this->Orders->get($id, [
            'contain' => ['OrderProducts','OrderProductAttributes' ,'Customers' ]
        ]);

        $this->set('order', $order);
    }
}