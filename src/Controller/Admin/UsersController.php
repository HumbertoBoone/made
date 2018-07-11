<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class UsersController extends AppController
{
    public function login()
    {
        $this->viewBuilder()->setLayout('admin_login');
        
    }
}