<?php

namespace App\Controller;

use Cake\Http\Client;

class OrdersController extends AppController
{
    private $paypal_user = 'AaSO5HHq-49EqhNwf9omvNiyg0aOXuFYd6IXkXi1YxNCixa13tE72tmncKvqABgrfzjuh9ILLGNAX1x0';
    private $paypal_pass = 'EGC8FV41JVPqylJn7HWDj4CIPjx48RnsqHYxxDVBxscecZF3ST4fqNNKoTS5SHxvM_Dlvl8rjUBAvHXs';

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
    public function method()
    {

    }
    public function paymentRedirect()
    {
        //$this->autoRender = false;
        
        if($this->request->is('post')){
            $payment_type = $this->request->getData('payment');
            switch($payment_type){
                case 'paypal':
                return $this->redirect(['action' => 'paypal']);
                break;
                case 'card':
                return $this->redirect(['action' => 'card']);
                break;
                case 'oxxo':
                return $this->redirect(['action' => 'oxxo']);
                break;
            }
        }
    }
    public function shipping()
    {
        if($this->Auth->user()){
            //$user = $this->Users->Orders->get($this->Auth->user('customer_id'));
            $user = $this->request->getSession()->read('Auth.User');
            if($this->request->is('post')){
                $address_id = $this->request->getData('shipping_address');
                //debug($address_id);
                $address = $this->Orders->getCustomerAddress($address_id, $user['customer_id']);
                $this->request->getSession()->write('shipping_address', $address);
                return $this->redirect(['action' => 'summary']);
            }
            if($user['status'] == 'verified'){
                $addresses = $this->Orders->getCustomerAddresses($user['customer_id']);
            }else{
                $this->Flash->error('La cuenta no ha sido verificada');
                return $this->redirect(['action' => '']);
            }
        }else{
            return $this->redirect(['action' => '']);
        }
        $this->set(compact('addresses'));

    }
    public function summary()
    {
        if(!$this->Auth->user()){
            $this->Flash->error('No estas autenticado. Por favor inicia sesión');
            return $this->redirect(['Controller' => 'Items', 'action' => 'index']);
        }
        $items = $this->request->getSession()->read('items');
        $shipping_address = $this->request->getSession()->read('shipping_address');
        if(!isset($items)){
            $this->Flash->error('Tu carrito esta vacio.');
            return $this->redirect(['Controller' => 'Items', 'action' => 'index']);
        }else if(!isset($shipping_address)){
            $this->Flash->error('No has seleccionado dirección de envio');
            return $this->redirect(['action' => 'shipping']);
        }
        $items_total = 0;
        foreach($items as $item){
            $items_total+= $item['subtotal'];
        }
        $this->set(compact('items','shipping_address','items_total'));
    }
    public function paypal()
    {
        //debug($this->createPaypalPayment());
        //debug($this->data);
    }
    public function executePaypalPayment()
    {
        $this->autoRender = false;
        $payer_id = $this->request->getData('payerID');
        $payment_id = $this->request->getData('paymentID');
        $http = new Client([
            'headers' => ['Authorization' => 'Bearer ' . $this->getPaypalToken(), 'Content-Type' => 'application/json']
        ]);
        $data = ['payer_id' => $payer_id];
        $response = $http->post('https://api.sandbox.paypal.com/v1/payments/payment/'.$payment_id.'/execute',
            json_encode($data));
        $response = $response->json['state'];
        $response = $this->response->withType('json')->withStringBody(json_encode([$response]));
        return $response;
    }
    public function createPaypalPayment()
    {
        $this->autoRender = false;
       //debug($this->getPaypalToken());
        //if($this->request->is('post')){
        $http = new Client([
            'headers' => ['Authorization' => 'Bearer ' . $this->getPaypalToken(), 'Content-Type' => 'application/json']
        ]);
        $session = $this->request->getSession();
        $items = $session->read('items');
        $json_items = [];
        $items_total = 0;
        foreach($items as $item){
            array_push($json_items, ['sku' => $item['sku'],
                'name' => $item['description'],
                'quantity' => $item['amount'],
                'price' => $item['price'],
                'currency' => 'MXN']);
            $items_total += $item['subtotal'];
        }
        $data = ['intent' => 'sale',
            'payer' => ['payment_method' => 'paypal'],
            'transactions' => [['amount' => ['currency'  => 'MXN','total' => $items_total],
            'description' => '', 'item_list' => ['items' => $json_items]]],'redirect_urls' => ['return_url' => 'localhost.com.mx','cancel_url' => 'localhost.com.mx/cancel']];
        $response = $http->post('https://api.sandbox.paypal.com/v1/payments/payment',
            json_encode($data));
        
        $response = $response->json['id'];
        
        $response = $this->response->withType('json')->withStringBody(json_encode(['paymentID' => $response]));
        return $response;
        //debug(json_encode($data));
        //}

    }

    private function getPaypalToken()
    {
        $http = new Client();
        $response = $http->post('https://api.sandbox.paypal.com/v1/oauth2/token',['grant_type' => 'client_credentials'],
        ['auth' => ['username' => $this->paypal_user, 'password' => $this->paypal_pass],['headers' => ['Content-Type'=>'application/x-www-form-urlencoded']]]);
        return $response->json['access_token'];
    }
}