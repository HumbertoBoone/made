<?php

namespace App\Controller;

use Cake\Http\Client;

class OrdersController extends AppController
{
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
        //if($this->request->is('post')){
            $http = new Client(['headers' => ['Accept' => 'application/json', 'Accept-Language' => 'en_US'],
            'auth' => ['AaSO5HHq-49EqhNwf9omvNiyg0aOXuFYd6IXkXi1YxNCixa13tE72tmncKvqABgrfzjuh9ILLGNAX1x0' => 'EGC8FV41JVPqylJn7HWDj4CIPjx48RnsqHYxxDVBxscecZF3ST4fqNNKoTS5SHxvM_Dlvl8rjUBAvHXs']]);
            $token = $http->post('https://api.sandbox.paypal.com/v1/oauth2/token',json_encode('grant_type=client_credentials'));
            debug($http);

            /*
            $accessToken = 'access_token$sandbox$npdknh2q6xrbx3xk$08d4dc53c1bcc1451682a11339606758';
            $data = ['intent' => 'sale',
                    'payer' => ['payment_method' => 'paypal'],
                    'transactions' => [['amount' => ['currency'  => 'MXN','total' => '10.80']]]];
            debug(json_encode($data));
            $http = new Client([
                'headers' => ['Authorization' => 'Bearer ' . $accessToken, 'Content-Type' => 'application/json']
            ]);
            $response = $http->post('https://api.sandbox.paypal.com/v1/payments/payment',
            json_encode($data));
            debug($http);*/
       // }
        /*$data = ['intent' => 'sale',
                    'payer' => ['payment_method' => 'paypal'],
                    'transactions' => [['amount' => ['currency'  => 'MXN','total' => '10.80']]]];
            debug(json_encode($data));*/
        
    }
}