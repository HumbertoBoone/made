<h1>Iniciar Sesión</h1>
<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button('Iniciar Sesion') ?>
<?= $this->Form->end() ?>