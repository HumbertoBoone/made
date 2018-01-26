<?php

namespace App\Controller;

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
}