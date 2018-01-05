<?php

namespace App\Controller;

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        // Add the 'add' action to the allowed actions list.
        $this->Auth->allow(['logout', 'nuevo']);
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
    public function nuevo()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->customer_id = $this->Users->crearNuevo($this->request->getData('customer'));
            $user->role = 'customer';
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido creado'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El usuario no pudo ser creado'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
}