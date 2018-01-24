<?php

namespace App\Controller;

class ItemsController extends AppController
{ 
    public $paginate = [
        'limit' => 6,
        'maxLimit' => 8
    ];
    public function index()
    {
        $this->loadComponent('Paginator');
        $items = $this->Paginator->paginate($this->Items->find('all',
            ['contain' => ['Images']]),$this->paginate);
        $this->set(compact('items'));
    }
    public function addCart(){
        $this->autoRender = false; //es para no mostrar al usuario la informacion
        if ($this->request->is('post')) {  
            $item_request = $this->request->getData();  
            $session = $this->request->session();
            $item = $this->Items->get($item_request['item_id'], ['contain' => ['Images']]);
            if(!$session->check('items')){
                $session->write('items');
            }

            $items = $session->read('items');
            $items[] = $this->Items->getItemForCart($item,$item_request['amount']);;
            $session->write('items',$items);
          
            if($session->check('items')){
                $this->Flash->success('El articulo ha sido añadido al carrito con exito. ', ['params' => ['link' => 'items/cart'] ]);
            }else{
                $this->Flash->error('No se pudo agregar el articulo al carrito, intente mas tarde');
            }
            return $this->redirect(['action' => 'index']);
            //$_SESSION['items'][] = $item;
        }
    }
    public function updateCart(){
        $this->autoRender = false;
        if($this->request->is('post')){
            $item_request = $this->request->getData();  
            $session = $this->request->session();
            $item_price = $session->read('items.'.$item_request['item_index'].'.price');
            //$item_price = $item[$item_request['item_index']]['price'];
            $session->write('items.'.$item_request['item_index'].'.subtotal' , $item_request['amount'] * $item_price);
            $session->write('items.'.$item_request['item_index'].'.amount' , $item_request['amount']);
            $this->Flash->success('La cantidad ha sido actualizada con exito');
            return $this->redirect(['action' => 'cart']);
        }
    }
    public function dS(){
        $this->autoRender = false;
        $session = $this->request->session();
        $session->destroy();
        return $this->redirect(['action' => 'index']);
    }
    public function cart(){
        $session = $this->request->session();
        $items = '';
        if($session->check('items')){
            $items = $session->read('items');
        }
        $this->set(compact('items'));
    }
    public function articulos()
    {
        $categorias = $this->request->getParam('pass');
        if ($categorias === null || count($categorias)){
            return $this->redirect(['action' => 'index']);
        }
        if ($this->request->is('post')) {
            debug('is post');
        }else{
            debug("isn't post");
        }
        $articulos = $this->Items->find('cat', [
            'categorias' => $categorias
        ]);
        $this->set(compact('articulos'));
    }
}