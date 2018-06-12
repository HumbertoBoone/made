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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
</head>
<body>
    <?= $this->element('navigation') ?> 
    <?= $this->Flash->render() ?>
    
    <div class="wrapper">

        <nav id="sidebar" style="position: fixed;">
            
            <!-- Sidebar Links -->
            <ul class="list-unstyled components">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#"><span class="sidebar-icon"><i class="fas fa-home fa-fw"></i></span>Inicio</a></li>
                <li><a href="#"><span class="sidebar-icon"><i class="fas fa-file-alt fa-fw"></i></span>Órdenes</a></li>
                <li><!-- Link with dropdown items -->
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"><span class="sidebar-icon"><i class="fas fa-boxes fa-fw"></i></span>Articulos<span class="arrow"><i class="fas fa-angle-right"></i></span></a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li><a href="../items/index">Listado de Articulos</a></li>
                        <li><?= $this->Html->link('Nuevo Articulo',['controller' => 'Items', 'action' => 'new']) ?></li>
                        <li><a href="#">Page</a></li>
                    </ul>

                <li><a href="#"><span class="sidebar-icon"><i class="fas fa-users fa-fw"></i></span>Clientes</a></li>
                <li><a href="#"><span class="sidebar-icon"><i class="fas fa-ticket-alt fa-fw"></i></span>Cupones</a></li>
                <li><a href="#"><span class="sidebar-icon"><i class="fas fa-chart-line fa-fw"></i></span>Estadísticas</a></li>
                <li><a href="#"><span class="sidebar-icon"><i class="fas fa-credit-card fa-fw"></i></span>Contracargos</a></li>
                <li><a href="#"><span class="sidebar-icon"><i class="fas fa-cog fa-fw"></i></span>Configuración</a></li>
            </ul>
        </nav>

    </div>

    <!-- Page Content -->
    <div id="content">
        <!-- We'll fill this with dummy content -->
    </div>

           
    
    <main role="main" class="" id="store">
        <?= $this->fetch('content') ?>
    </main><!-- /.container <span class="text-muted">Corvus. Todos los Derechos Reservados</span>-->
    
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <?= $this->fetch('scriptBottom') ?>
    <?= $this->Html->script('js.js') ?> 
    <?= $this->Html->script('admin.js') ?>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"    integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        $('a[data-toggle="collapse"]').on('click', function () {
        $(this)
            .find('.arrow')
            .find('[data-fa-i2svg]')
            .toggleClass('fa-angle-down')
            .toggleClass('fa-angle-right');
        });
    });
    </script>
</body>
</html>
