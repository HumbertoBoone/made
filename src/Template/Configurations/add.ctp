<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Configuration $configuration
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Configurations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Configuration Groups'), ['controller' => 'ConfigurationGroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Configuration Group'), ['controller' => 'ConfigurationGroups', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="configurations form large-9 medium-8 columns content">
    <?= $this->Form->create($configuration) ?>
    <fieldset>
        <legend><?= __('Add Configuration') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('key');
            echo $this->Form->control('value');
            echo $this->Form->control('description');
            echo $this->Form->control('configuration_group_id', ['options' => $configurationGroups]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
