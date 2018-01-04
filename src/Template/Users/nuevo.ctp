<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<?= $this->Form->create($user) ?>
<fieldset>
    <legend><?= __('Nuevo Usuario') ?></legend>
    <?php
        echo $this->Form->control('email');
        echo $this->Form->control('password');
    ?>
</fieldset>
<?= $this->Form->button(__('Enviar')) ?>
<?= $this->Form->end() ?>

