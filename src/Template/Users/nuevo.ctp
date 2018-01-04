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

<fieldset>
    <legend><?= __('Informacíon de la Empresa') ?></legend>
    <?= $this->Form->control('customer.company') ?>
    <?= $this->Form->control('customer.first_name') ?>
    <?= $this->Form->control('customer.last_name') ?>
    <?= $this->Form->control('customer.address1') ?>
    <?= $this->Form->control('customer.address2') ?>
    <?= $this->Form->control('customer.tel') ?>
    <?= $this->Form->control('customer.city') ?>
    <?= $this->Form->control('customer.state') ?>
    <?= $this->Form->control('customer.postal_code') ?>
    <?= $this->Form->button(__('Enviar')) ?>
    <?= $this->Form->end() ?>
</fieldset>
