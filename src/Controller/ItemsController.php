<?php

namespace App\Controller;

class ItemsController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');
        $items = $this->Paginator->paginate($this->Items->find());
        $this->set(compact('items'));
    }
    public function articulos()
    {
        $categorias = $this->request->getParam('pass');

        if ($this->request->is('post')) {

        }
        $articulos = $this->Items->find('cat', [
            'categorias' => $categorias
        ]);
        $this->set(compact('articulos'));
    }
}