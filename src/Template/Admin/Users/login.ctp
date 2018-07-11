<?php 
	//$this->layout="admin_login";
?>
<div class="d-table h-100 w-100">
	<div class="d-table-cell align-middle texto-blanco">
		<?= $this->Form->create(null,['class'=>'d-block mx-auto', 'id' => 'login'])?>
		<?= $this->Html->image('logoBlanco.png',['class'=>'d-block mx-auto imagen icono','width'=>'150px', 'heigth'=>'150px'])?>
		<?= $this->Form->control('user', ['placeholder'=>'Usuario'])?>
		<?= $this->Form->control('password', ['placeholder'=>'Contraseña'])?>
		<?= $this->Form->button('Entrar', ['class'=>'btn btn-trans d-block mx-auto'])?>
		<?= $this->Form->end()?>
	</div>
</div>