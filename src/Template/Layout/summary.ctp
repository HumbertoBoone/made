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

$cakeDescription = 'CakePHP: the rapid development php framework'; 
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
    <script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
   
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <?= $this->Html->script('paypal_button.js') ?>
    
    <?= $this->Html->meta('icon') ?>   
    <?= $this->Html->css('app.css') ?>
    <?= $this->Html->css('css.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    
    <?= $this->element('navigation') ?> 

    <?= $this->Flash->render() ?>
    <main role="main" class="container">
        <?= $this->fetch('content') ?>
    </main>
    
    <?= $this->element('footer') ?>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"    integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <?= $this->fetch('scriptBottom') ?>
    <?= $this->Html->script('js.js') ?>
    <script type="text/javascript" >
    Conekta.setPublicKey('key_KJysdbf6PotS2ut2');

    var conektaSuccessResponseHandler = function(token) {
        var $form = $("#card-form");
        //Inserta el token_id en la forma para que se envíe al servidor
        alert(token.id);
        $form.append($('<input type="hidden" name="conektaTokenId" id="conektaTokenId">').val(token.id));
        $form.get(0).submit(); //Hace submit
    };
    var conektaErrorResponseHandler = function(response) {
        var $form = $("#card-form");
        alert('error');
        $form.find(".card-errors").text(response.message_to_purchaser);
        $form.find("button").prop("disabled", false);
    };

    //jQuery para que genere el token después de dar click en submit
    $(function () {
        alert('entra');
        $("#card-form").submit(function(event) {
        var $form = $(this);
        // Previene hacer submit más de una vez
        $form.find("button").prop("disabled", true);
        Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
        return false;
        });
    });
    </script>
</body>
</html>
