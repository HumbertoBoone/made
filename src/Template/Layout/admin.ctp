<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 * <?= $this->Html->css('base.css') ?>
 *<?= $this->Html->css('cake.css') ?>
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */ 
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= _('Panel de Administración') ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->css('app.css') ?>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">-->
    <!-- oxxo styles -->
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <?= $this->Html->meta('icon') ?>
    
    <?= $this->Html->css('admin.css') ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?= $this->element('navigation') ?> 
    <?= $this->Flash->render() ?>
    
    <div id="sidebar" class="sidebar">
        <div class="sidebar-scroll" style="position: relative; overflow: hidden: width: 100%: height: 656px;">
            <div class="sidebar-inner scroll" style="overflow: hidden; width: 100%; height: 656px;">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="sidebar-menu-title">ADMINISTRACIÓN</li>
                        <li><a href="#"><i class="fas fa-home fa-fw"></i>Inicio</a></li>
                        <li><a href="#"><i class="fas fa-file-alt fa-fw"></i>Órdenes</a></li>
                        <li class="sidebar-submenu">
                            <a href="#" class="sidebar-subdrop">
                                <i class="fas fa-boxes fa-fw"></i>Articulos<span class="sidebar-menu-arrow"></span>
                            </a>
                            <ul class="list-unstyled" style="display: none">
                                <li><a href="#">Lista Articulos</a></li>
                                <li><a href="#">Nuevo Articulo</a></li>
                                <li><a href="#"></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <main role="main" class="container" id="store">
        <?= $this->fetch('content') ?>
    </main><!-- /.container <span class="text-muted">Corvus. Todos los Derechos Reservados</span>-->
    
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <?= $this->fetch('scriptBottom') ?>
    <?= $this->Html->script('js.js') ?>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"    integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    
</body>
</html>
