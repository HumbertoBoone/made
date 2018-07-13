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
        $orders = $this->Orders->find('all', [
            'fields' => [
                'Orders.id',
                'Orders.customer_id',
                'Orders.created',
                'Orders.payment_type',
                'Orders.grand_total',
                'Orders.status'
            ]
        ])->contain([
            'Customers' => [
                'fields' => [
                    'Customers.first_name',
                    'Customers.last_name'
                ]
            ]]);
        $this->paginate = [
            'limit' => 10,
            'order' => [
                'Orders.created' => 'desc'
            ]
        ];
        $orders = $this->paginate($orders);
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