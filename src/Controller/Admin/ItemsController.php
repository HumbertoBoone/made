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
            $item = $this->Items->patchEntity($item,$this->request->getData());
            
            $categories = $this->request->getData('categories');
            if($this->Items->save($item)) {
                // para guardar las diferentes asociaciones muchos
                // a muchos
                foreach ($categories['_ids'] as $category) {
                    if($category !== null && $category > 0){
                        $entity = $this->Items->getCategoryEntity($category);
                        $this->Items->Categories->link($item, [$entity]);
                    }
                }
                $this->Flash->success(__('El articulo ha sido creado'));
            }                                            
        }
        $categories = $this->Items->getCategories();
        $this->set(compact('item'));
        $this->set(compact('categories'));
        $this->set('_serialize', ['user']);
    }
}