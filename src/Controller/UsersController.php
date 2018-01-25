<?php

namespace App\Controller;

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        // Add the 'add' action to the allowed actions list.
        //$this->Auth->config('authorize', 'Controller');
        $this->Auth->allow(['logout', 'nuevo']);
        $this->Auth->deny('test'); //le quita acceso publico, y utiliza el callback isAuthorized para autorizar acceso
    }
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Las credenciales de acceso proporcionadas son incorrectas');
        }
    }
    public function logout()
    {
         return $this->redirect($this->Auth->logout());
    }
    public function nuevo()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->customer_id = $this->Users->crearNuevo($this->request->getData('customer'));
            $user->role = 'customer';
            $user->status = 'pending';
            $user->verification_token = hash('sha512', mt_rand().$user->customer_id.time());
            debug($this->request->getData());
            /*if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido creado'));

                return $this->redirect('/pages/registrado');
            }
            $this->Flash->error(__('El usuario no pudo ser creado'));*/
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
    public function verify(){
        if ($this->request->is('get')){
            $params = $this->request->getParam('pass');
            debug($this->request->getQueryParams());
        }
        
    }
    public function test(){

    }
    public function isAuthorized($user = null)
    {
        return false;
    }
}