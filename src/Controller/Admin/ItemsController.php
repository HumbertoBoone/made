<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class ItemsController extends AppController
{
    public function index()
    {

    }
    public function new()
    {
        $item = $this->Items->newEntity();
        if ($this->request->is('post')) {
            $item = $this->Items->patchEntity($item, $this->request->getData());

            if($this->Items->save($item)) {
                $this->Flash->success(__('El articulo ha sido creado'));

                return $this->redirect(['action' => 'index']);
            }                                            
        }
        $categories = $this->Items->getCategories();
        $this->set(compact('item'));
        $this->set(compact('categories'));
        $this->set('_serialize', ['user']);
    }
}