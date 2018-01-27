<?php

namespace App\Controller;

use Cake\Http\Client;

class OrdersController extends AppController
{
    private $paypal_user = 'AaSO5HHq-49EqhNwf9omvNiyg0aOXuFYd6IXkXi1YxNCixa13tE72tmncKvqABgrfzjuh9ILLGNAX1x0';
    private $paypal_pass = 'EGC8FV41JVPqylJn7HWDj4CIPjx48RnsqHYxxDVBxscecZF3ST4fqNNKoTS5SHxvM_Dlvl8rjUBAvHXs';
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
    public function paypal()
    {

    }
    public function createPaypalPayment()
    {
       //debug($this->getPaypalToken());
        $http = new Client([
            'headers' => ['Authorization' => 'Bearer ' . $this->getPaypalToken(), 'Content-Type' => 'application/json']
        ]);
        $data = ['intent' => 'sale',
            'payer' => ['payment_method' => 'paypal'],
            'transactions' => [['amount' => ['currency'  => 'MXN','total' => '10.80']]],'redirect_urls' => ['return_url' => 'localhost.com.mx','cancel_url' => 'localhost.com.mx/cancel']];
        $response = $http->post('https://api.sandbox.paypal.com/v1/payments/payment',
            json_encode($data));
        debug($response->json);

    }
    private function getPaypalToken()
    {
        $http = new Client();
        $response = $http->post('https://api.sandbox.paypal.com/v1/oauth2/token',['grant_type' => 'client_credentials'],
        ['auth' => ['username' => $this->paypal_user, 'password' => $this->paypal_pass],['headers' => ['Content-Type'=>'application/x-www-form-urlencoded']]]);
        return $response->json['access_token'];
    }
}