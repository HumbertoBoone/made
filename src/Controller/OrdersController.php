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
        $data = ['intent' => 'sale',
            'payer' => ['payment_method' => 'paypal'],
            'transactions' => [['amount' => ['currency'  => 'MXN','total' => '10.80']]],'redirect_urls' => ['return_url' => 'localhost.com.mx','cancel_url' => 'localhost.com.mx/cancel']];
        $response = $http->post('https://api.sandbox.paypal.com/v1/payments/payment',
            json_encode($data));
        //debug($response->json);
        //return $response->json['id'];
        $response = $response->json['id'];
        //$response = ['paymentID' => $response];
        //$response = ['hola' => 'hola otra vez'];
        //return $this->request->withBody(json_encode($response));
        //return $response->json;
        //$this->rev($response);
        //$this->set(compact('response'));
        //$this->set('_serialize', ['response']);
        //$json_data = json_encode($response);
        $response = $this->response->withType('json')->withStringBody(json_encode(['paymentID' => $response]));
        return $response;
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