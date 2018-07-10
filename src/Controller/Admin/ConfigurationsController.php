<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class ConfigurationsController extends AppController
{
    public function index()
    {
        
    }
    public function conekta()
    {
        $this->viewBuilder()->setLayout('admin');
        $conekta_configurations = $this->Configurations->find()->matching('ConfigurationGroups', function ($q) {
            return $q
                ->where(['ConfigurationGroups.title' => 'conekta']);
        });
        if($this->request->is('post')){ 
            $values = $this->request->getData();
            foreach($values as $k => $value){
                $c = $this->Configurations->get($k);
                $c->value = $value;
                if ($this->Configurations->save($c)) {
            
                }
            }
            return $this->redirect(['action' => 'conekta']);
        }
        $this->set(compact('conekta_configurations'));
    }
}