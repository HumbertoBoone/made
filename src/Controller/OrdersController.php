<?php

namespace App\Controller;


use Cake\Http\Client;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\I18n\Number;

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
    public function oxxo()
    {
        //$this->autoRender = false;

        \Conekta\Conekta::setApiKey("key_eYvWV7gSDkNYXsmr");
        \Conekta\Conekta::setApiVersion("2.0.0");
        $session = $this->request->getSession();

        $customer = $this->Auth->user();

        $items = $session->read('order.items');

        $arr_items = array();

        $total = 0.0;
        foreach($items as $item)
        {
            $arr_items[] = [
                'name' => $item['sku'].' '.$item['brand'].' ',
                'unit_price' => intval($item['subtotal'] * 100),
                'quantity' => intval($item['quantity'])
            ]; 
            $total += $item['subtotal'] * 100 * $item['quantity'];
        }
        $total += 100;
        try{
            $order = \Conekta\Order::create(
              array(
                "line_items" => $arr_items, //line_items
                "shipping_lines" => array(
                  array(
                    "amount" => 100,
                    "carrier" => "FEDEX"
                  )
                ), //shipping_lines - physical goods only
                "currency" => "MXN",
                "customer_info" => array(
                  "name" => $customer['customer']['first_name'].' '.$customer['customer']['last_name'],
                  "email" => $customer['email'],
                  "phone" => $customer['customer']['tel']
                ), //customer_info
                "shipping_contact" => array(
                  "address" => array(
                    "street1" => $session->read('order.shipping_address.address1').' '.$session->read('order.shipping_address.address2'),
                    "postal_code" => $session->read('order.shipping_address.postal_code'),
                    "country" => "MX"
                  )//address
                ), //shipping_contact - required only for physical goods
                "charges" => array(
                    array(
                        "payment_method" => array(
                          "type" => "oxxo_cash"
                        )//payment_method
                    ) //first charge
                ) //charges
              )//order
            );
            //debug($order);
            $this->Orders->saveOrder($total,$session->read('order'), $customer);
            $this->set(compact('order'));
        } catch (\Conekta\ParameterValidationError $error){
            $this->Flash->error($error->getMessage());
            $this->set('style', 'display: none;');
        } catch (\Conekta\Handler $error){
            $this->Flash->error($error->getMessage());
            $this->set('style', 'display: none;');
        }
    }
    public function addCoupon()
    {
        $this->request->allowMethod(['post']);
        $coupon_code = $this->request->getData('coupon_code');
        if ($coupon_code == "" || $coupon_code == null || empty($coupon_code)) {
            if(!$this->Auth->user()){
                return $this->redirect(['action' => 'registered']);
            }
            return $this->redirect(['action' => 'shipping']);
        }
        $session = $this->request->getSession();
        $items = $session->read('order.items');
        $total = 0.0;
        foreach($items as $item)
        {
            $total += $item['subtotal'] * $item['quantity'];
        }
        $coupon_code = $this->request->getData('coupon_code');
        $coupon_status = $this->Orders->verifyCoupon($coupon_code, $total);
        if($coupon_status['valid'] == TRUE)
        {
            $session->write('order.discount', floatval($coupon_status['discount']));
            $this->Flash->success('El cupon de descuento ha sido aplicado con éxito');
            if(!$this->Auth->user()){
                return $this->redirect(['action' => 'registered']);
            }
            return $this->redirect(['action' => 'shipping']);   
        }else{
            $this->Flash->error($coupon_status['message']);
            return $this->redirect(['controller' => 'Items','action' => 'cart']); 
        }
    }
    public function kk()
    {
        /*$t = Time::now();
        $t = '2014-10-31';
        debug($t->isFuture());*/
        //Number::defaultCurrency('MXN');
        //debug(Number::defaultCurrency());
        debug(Number::currency(1574.28, null, ['after' => ' pesos']));
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
    public function shippingMethod()
    {
        if($this->request->is('post'))
        {
            $session = $this->request->getSession();
            $method_id = $this->request->getData('shipping_method');
            $session->write('order.shipping_method', $this->Orders->getShippingMethod($method_id));
        }
        $this->set('methods', $this->Orders->getShippingMethods());
    }
    public function shipping()
    {
        if(!$this->Auth->user()){
            $this->Flash->error('No has iniciado sesión.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        //debug($this->request->getData());
        $user = $this->request->getSession()->read('Auth.User');
        if($this->request->is('post')){
            $address_id = $this->request->getData('shipping_address');
            debug($this->request->getData());
            if(isset($address_id)){
                if($address_id == 'main'){
                   $address = $this->Orders->getCustomerMainAdress($user['customer_id']);
                }else{
                    $address = $this->Orders->getCustomerAddress($address_id, $user['customer_id']);
                }
                $this->request->getSession()->write('order.shipping_address', $address);
                return $this->redirect(['action' => 'summary']);
            }
            $this->Flash->error(__('Por favor selecciona una dirección de envio.'));
            return $this->redirect(['action' => 'shipping']);
        }
        if($user['status'] == 'verified'){
            $main_address = $this->Orders->getCustomerMainAdress($user['customer_id']);
           // debug($main_address);
            $addresses = $this->Orders->getCustomerAddresses($user['customer_id']);
        }else{
            $this->Flash->error('La cuenta no ha sido verificada');
            return $this->redirect(['controller' => 'Items','action' => 'cart']);
        }
        $this->set(compact('addresses'));
        $this->set(compact('main_address'));

    }
    public function registered()
    {
        if($this->Auth->user()){
            return $this->redirect(['action' => 'shipping']);
        }
        
    }
    public function summary()
    {
        $this->viewBuilder()->setLayout('summary');
        if(!$this->Auth->user()){
            $this->Flash->error('No estas autenticado. Por favor inicia sesión');
            return $this->redirect(['controller' => 'Items', 'action' => 'index']);
        }
        $order = $this->request->getSession()->read('order');
        //debug($order);
        if(!isset($order['items'])){
            $this->Flash->error('Tu carrito esta vacio.');
            return $this->redirect(['controller' => 'Items', 'action' => 'index']);
        }else if(!isset($order['shipping_address'])){
            $this->Flash->error('No has seleccionado dirección de envio');
            return $this->redirect(['action' => 'shipping']);
        }
        $items_total = 0;
        foreach($order['items'] as $item){
            $items_total+= $item['subtotal'];
        }
        //$this->set(compact($order['items'],$order['shipping_address'],'items_total'));
        $this->set('items', $order['items']);
        $this->set('shipping_address', $order['shipping_address']);
        $this->set('items_total', $items_total);
    }
    public function paypal()
    {
        $this->viewBuilder()->setLayout('payment');
        //debug($this->createPaypalPayment());
        //debug($this->data);
    }
    public function executePaypalPayment()
    {
        $this->request->allowMethod(['post']);
        $this->autoRender = false;
        if($this->request->is('post')){
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
    }
    public function ppt(){
        debug($this->getPaypalToken());
    }
    public function createPaypalPayment()
    {
        $this->request->allowMethod(['post']);
        $this->autoRender = false;
        if($this->request->is('post')){
            $http = new Client([
                'headers' => ['Authorization' => 'Bearer ' . $this->getPaypalToken(), 'Content-Type' => 'application/json']
            ]);
            //debug($http);
            $session = $this->request->getSession();
            $items = $session->read('order.items');
            $json_items = [];
            $items_total = 0;
            foreach($items as $item){
                array_push($json_items, ['sku' => $item['sku'],
                    'name' => $item['description'],
                    'quantity' => $item['quantity'],
                    'price' => number_format($item['subtotal'] / $item['quantity'],"2",".",""), // no se puede usar 'price' por que no incluye el precio de las opciones
                    'currency' => 'MXN']);
                $items_total += $item['subtotal'];
            }

            $data = ['intent' => 'sale',
                'payer' => ['payment_method' => 'paypal'],
                'transactions' => [['amount' => ['currency'  => 'MXN','total' => number_format($items_total,"2",".",""), 'details' => ['subtotal' => number_format($items_total,"2",".","")]],
                'description' => '', 'item_list' => ['items' => $json_items]]],'redirect_urls' => ['return_url' => 'localhost.com.mx','cancel_url' => 'localhost.com.mx/cancel']];

            $response = $http->post('https://api.sandbox.paypal.com/v1/payments/payment',
                json_encode($data));
            //debug(json_encode($data, JSON_PRETTY_PRINT));
            //debug($response);
            return $this->response->withType('json')->withStringBody(json_encode(['paymentID' => $response->json['id']])); 
        }
    }

    private function getPaypalToken()
    {
        $http = new Client();
        $response = $http->post('https://api.sandbox.paypal.com/v1/oauth2/token',['grant_type' => 'client_credentials'],
        ['auth' => ['username' => $this->paypal_user, 'password' => $this->paypal_pass],['headers' => ['Content-Type'=>'application/x-www-form-urlencoded']]]);
        return $response->json['access_token'];
    }
}