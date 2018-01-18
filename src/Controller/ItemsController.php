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
        $this->autoRender = false;
        if ($this->request->is('post')) {  
            $item = $this->request->getData();  
            $session = $this->request->session();
            
            if(!$session->check('items')){
                $session->write('items');
            }
            $items = $session->read('items');
            $items[] = $item;
            $session->write('items', $items);
            if($session->check('items')){
                $this->Flash->success('El articulo ha sido añadido al carrito con exito');
            }else{
                $this->Flash->error('No se pudo agregar el articulo al carrito, intente mas tarde');
            }
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