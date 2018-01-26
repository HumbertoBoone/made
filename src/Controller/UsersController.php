<?php

namespace App\Controller;

use Cake\Mailer\Email;

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

            $ver_url = 'http://localhost/made/users/verify?token='.$user->verification_code.'?user='.$user->customer_id;
            /*$email = new Email('default');
            $email->from(['admin@localhost' => 'My Site'])
                ->to($user->email)
                ->subject('Verifica tu cuenta')
                ->send($ver_url);*/
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido creado'));

                return $this->redirect('/pages/registrado');
            }
            $this->Flash->error(__('El usuario no pudo ser creado'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
    public function verify()
    {
        $params = $this->request->getQueryParams();
        if ($this->request->is('get') && isset($params['token']) && isset($params['user'])){
            $user = $this->Users->get($params['user']);
            if($user->verification_token == $params['token']){
                $user->status = 'verified';
                $user->verification_token = null;
                if($this->Users->save($user)){
                    $this->Flash->success(__('Su cuenta ha sido verificada'));
                }
                $this->Flash->error(__('Su cuenta no pudo ser verificada'));
            }
            $this->Flash->error(__('El token no corresponde con el registro'));
        }else{
            return $this->redirect(['controller' => 'Items', 'action' => 'index']);
        }
        
    }
    public function test(){

    }
    public function isAuthorized($user = null)
    {
        return false;
    }
}