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
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

    <!-- oxxo styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('app.css') ?>
    <?= $this->Html->css('admin.css') ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?= $this->element('navigation') ?> 
    <?= $this->Flash->render() ?>
    <div class="wrapper">

    <nav id="sidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <h3>Collapsible Sidebar</div>
        </div>

        <!-- Sidebar Links -->
        <ul class="list-unstyled components">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">About</a></li>

            <li><!-- Link with dropdown items -->
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                </ul>

            <li><a href="#">Portfolio</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

</div>
    <main role="main" class="container" id="store">
        <?= $this->fetch('content') ?>
    </main><!-- /.container <span class="text-muted">Corvus. Todos los Derechos Reservados</span>-->
    
    <?= $this->element('footer') ?>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <?= $this->fetch('scriptBottom') ?>
    <?= $this->Html->script('js.js') ?>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"    integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</body>
</html>
