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
            //$item = $this->Items->find()->contain(['Images'])->where(['id' => $item_request['item_id']])->first();
            //$item = $item['0'];
            $item = $this->Items->get($item_request['item_id'], ['contain' => ['Images']]);
            //array_push($item, $item_request['amount']);
            if(!$session->check('items')){
                $session->write('items');
            }
            $img = !empty($item->images) ? $item->images['0'] : 'default.png';
            //debug($item);
            //debug(var_dump($item->sku));
            //debug(var_dump($item->id));
            $items = $session->read('items');
            $item = [
                'id' => $item->id,
                'sku' => $item->sku,
                'description' => $item->description,
                'price' => $item->price,
                'unit' => $item->unit,
                'brand' => $item->brand,
                'amount' => $item_request['amount'],
                'img' => $img,
                'subtotal' => $item_request['amount'] * $item['price']
            ];
            $items[] = $item;
            $session->write('items',$items);
            /*$session->write(['items' => [
                'id' => $item->id,
                'sku' => $item->sku,
                'description' => $item->description,
                'price' => $item->price,
                'unit' => $item->unit,
                'brand' => $item->brand,
                'amount' => $item_request['amount'],
                'img' => 'o,mg =)',
                'subtotal' => $item_request['amount'] * $item['price']]
                ]);*/
            //$session = $session->read('items');
            //$items = $session->read('items');
            //$items[] = $item;
            //$session->write('items', $items);
           if($session->check('items')){
                $this->Flash->success('El articulo ha sido añadido al carrito con exito');
            }else{
                $this->Flash->error('No se pudo agregar el articulo al carrito, intente mas tarde');
            }
            //debug($item);
            return $this->redirect(['action' => 'index']);
            //$_SESSION['items'][] = $item;
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