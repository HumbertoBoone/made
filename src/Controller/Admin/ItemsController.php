<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class ItemsController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');
        $items = $this->Paginator->paginate($this->Items->find('all',
            ['contain' => ['Images']]));

        //$items = $this->Items->find('all',
        //    ['contain' => ['Images']]);
        //debug($images);
        //$this->set(compact('images'));
        $this->set(compact('items'));
    }
    public function new1()
    {

        $data = [
            'sku' => 'elefante2',
            'name' => 'blusa',
            'price' => 10,
            'unit' => 'pieza',
            'groups' => [
                ['name' => 'color',
                'required' => 1,
                'type' => 'checkbox',
                'options' => [['name' => 'gris',
                            'value' => 10.2,
                            'available' => 1]]]
            ]
        ];
        $item = $this->Items->newEntity();
        $item = $this->Items->patchEntity($item, $data,[
            'associated' => ['Groups.Options']]);
        //debug($item);}
        //debug($data);
        //debug($this->request->getData());
        /*$item->groups = [];
        $item->groups[] = ['name' => 'color', 'required' => 1, 'type' => 'checkbox'];
        $item->dirty('groups', true);*/
        $this->Items->save($item);
        debug($item);

    }
    public function new()
    {
        $item = $this->Items->newEntity();
        if ($this->request->is('post')) {
           
            $item = $this->Items->patchEntity($item,$this->request->getData(),[
                'associated' => ['Groups.Options']
            ]);
            $images = $this->request->getData('images');
            
            //$categories = $this->request->getData('categories');
            debug($this->request->getData());
            //debug($this->Items->save($item));
            if($this->Items->save($item)) {
                // para guardar las diferentes asociaciones muchos
                // a muchos
                /*if(!empty($categories['_ids'])){
                    foreach ($categories['_ids'] as $category) {
                        
                            $entity = $this->Items->getCategoryEntity($category);
                            $this->Items->Categories->link($item, [$entity]);

                    }
                }*/
                // Not tested yet
                if(isset($images)){
                    foreach($images as $c => $image){
                        if($image['img']['error'] == 0 && ($image['img']['type'] == 'image/jpeg' || $image['img']['type'] == 'image/png')) {
                            $img = $this->Items->getImageEntity();
                            $target_path = WWW_ROOT . 'img/items/';
                            $file_name = $image['img']['name'];
                            $tmp_name = $image['img']['tmp_name'];
                            $extension = explode(".", $file_name);
                            $extension = end($extension);
                            $new_file_name = $item->sku . '_' . $c .'.'. $extension;
                            $to_path = $target_path . $new_file_name;
                            if($file_name != ""){
                                if(move_uploaded_file($tmp_name, $to_path)){
                                    $img->src = 'img/items/' . $new_file_name;
                                    $img->item_id = $item->id;
                                    $this->Items->saveImage($img);
                                    //$this->Flash->success(__('La imagen ha sido subida'));
                                }else{
                                    //$this->Flash->error(__('La imagen no pudo ser subida'));
                                }
                            }
                        }else{
                            // Se descarta mensaje de error, porque en el formulario exite al menos un input sin seleccionar por ser dinamico
                            //$this->Flash->error(__('Ocurrió un error al subir la imagen, verifique que la imagen sea png o jpeg'));
                        }
                    }
                }

                $this->Flash->success(__('El articulo ha sido creado'));
            }            
            debug($this->Items->get($item->id, ['contain' => ['Images','Groups.Options']]));                                
        }
        $categories = $this->Items->getCategories();
        $images = $this->Items->getImageEntity();
        $this->set(compact('item'));
        $this->set(compact('categories'));
        $this->set(compact('images'));
        $this->set('_serialize', ['user']);
    }
}