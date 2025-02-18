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
            ['contain' => ['Images']]), $this->paginate);
        $categories = $this->Items->Categories->find()->toArray();
        $this->set(compact('items', 'categories'));
    }
    public function view($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => ['Groups.Options', 'Images']
        ]);

        $this->set('item', $item);
    }
    public function see()
    {
        
        debug($this->request->getData());
    }
    public function addCart(){
        $this->autoRender = false; //es para no mostrar al usuario la informacion
        if ($this->request->is('post')) {  
            $item_request = $this->request->getData();
            $session = $this->request->getSession();
            $item = $this->Items->get($item_request['item_id'], ['contain' => ['Images']]);
            if(!$session->check('order')){
                $session->write('order.items');
            }
            //debug($item_request);
            
            $items = $session->read('order.items');
            //debug($this->Items->getItemForCart($item, $item_request));
            $items[] = $this->Items->getItemForCart($item, $item_request);
            //debug($items);
            $session->write('order.items',$items);
          
            if($session->check('order.items')){
                $this->Flash->success('El articulo ha sido añadido al carrito con exito. ', ['params' => ['link' => 'items/cart'] ]);
                return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error('No se pudo agregar el articulo al carrito, intente mas tarde');
                return $this->redirect(['action' => 'index']);
            }
            //return $this->redirect(['action' => 'index']);
            //$_SESSION['items'][] = $item;
        }
    }
    public function updateCart(){
        $this->autoRender = false;
        if($this->request->is('patch')){
            $item_request = $this->request->getData();  
            $session = $this->request->session();
            $item_price = $session->read('order.items.'.$item_request['item_index'].'.price');
            //$item_price = $item[$item_request['item_index']]['price'];
            $session->write('order.items.'.$item_request['item_index'].'.subtotal' , round($item_request['amount'] * $item_price, 2));
            $session->write('order.items.'.$item_request['item_index'].'.amount' , $item_request['amount']);
            $this->Flash->success('La cantidad ha sido actualizada con exito');
            return $this->redirect(['action' => 'cart']);
        }
    }
    public function deleteCart()
    {
        $this->autoRender = false;
        if($this->request->is('delete')){
            $item_request = $this->request->getData();
            $session = $this->request->session();
            $session->delete('order.items.'.$item_request['item_index']);
            $this->Flash->success('El articulo ha sido eliminado del carrito con exito.');
            return $this->redirect(['action' => 'cart']);
        }
    }
    public function continue()
    {
        $user = $this->request->session()->read('Auth.User');
        if(isset($user)){
            return redirect(['controller' => 'Orders', 'action' => 'method']);
        }else{
            
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
        if($session->check('order.items')){
            $items = $session->read('order.items');
        }else{
            $this->Flash->error('Tu carrito esta vacio, agrega articulos para poder continuar con la compra');
            $this->redirect(['action' => 'index']);
        }
        $total = 0;
        foreach($items as $item){
            $total += $item['subtotal'];
        }
        $this->set(compact('items'));
        $this->set(compact('total'));
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