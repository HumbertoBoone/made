<?php

namespace App\Controller;

class ItemsController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');
        $items = $this->Items->find('all',
            ['contain' => ['Images']]);
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