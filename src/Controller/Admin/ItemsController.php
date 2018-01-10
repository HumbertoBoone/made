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
            debug($this->request);
            $item = $this->Items->patchEntity($item,$this->request->getData(),[
                'associated' => ['Categories']
            ]);
            //$item = $this->Items->patchEntity($item, $this->request->getData());
            debug($item);
            debug($this->request->getData());
            if($this->Items->save($item)) {
                //$item1 = $this->Items->get($item->id);
                $category = $this->Items->getCategoryEntity($this->request->getData('category.0'));

                $this->Items->Categories->link($item, [$category]);
                //debug($item);
                $this->Flash->success(__('El articulo ha sido creado'));

                //return $this->redirect(['action' => 'new']);
            }                                            
        }
        $categories = $this->Items->getCategories();
        $this->set(compact('item'));
        $this->set(compact('categories'));
        $this->set('_serialize', ['user']);
    }
}