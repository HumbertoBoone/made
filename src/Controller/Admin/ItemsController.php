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
            $item = $this->Items->patchEntity($item,$this->request->getData(),[
                'associated' => ['Images']
            ]);
            $images = $this->request->getData('images');

            $categories = $this->request->getData('categories');
            $imagesCount = count($images);
            //debug($images[0]['img']['tmp_name']);
            //debug($images[1]['img']['tmp_name']);
            foreach($images as $c=> $image){
             
                $target_path = WWW_ROOT . 'img/items/';
                $file_name = $image['img']['name'];
                //debug($file_name);
                
                $tmp_name = $image['img']['tmp_name'];
                //debug($tmp_name);
                $parts = explode(".", $file_name);
                $fname = $parts[0];
                $new_file_name = $fname . rand() . "." . $parts[1];
                $to_path = $target_path . $new_file_name;
                if($file_name != ""){
                    if(move_uploaded_file($tmp_name, $to_path)){
                        $this->Flash->success(__('La imagen ha sido subida'));
                    }else{
                        $this->Flash->error(__('La imagen no pudo ser subida'));
                    }
                }
            }
            
            debug($this->request->getData());
            if($this->Items->save($item)) {
                // para guardar las diferentes asociaciones muchos
                // a muchos
                if(!empty($categories['_ids'])){
                    foreach ($categories['_ids'] as $category) {
                        
                            $entity = $this->Items->getCategoryEntity($category);
                            $this->Items->Categories->link($item, [$entity]);
                        
                    }
                }
                $this->Flash->success(__('El articulo ha sido creado'));
            }                                            
        }
        $categories = $this->Items->getCategories();
        $images = $this->Items->getImageEntity();
        $this->set(compact('item'));
        $this->set(compact('categories'));
        $this->set(compact('images'));
        $this->set('_serialize', ['user']);
    }
}