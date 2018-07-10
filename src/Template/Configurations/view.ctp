<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Configuration $configuration
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Configuration'), ['action' => 'edit', $configuration->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Configuration'), ['action' => 'delete', $configuration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configuration->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Configurations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuration'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Configuration Groups'), ['controller' => 'ConfigurationGroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuration Group'), ['controller' => 'ConfigurationGroups', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="configurations view large-9 medium-8 columns content">
    <h3><?= h($configuration->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($configuration->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Key') ?></th>
            <td><?= h($configuration->key) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Value') ?></th>
            <td><?= h($configuration->value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($configuration->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Configuration Group') ?></th>
            <td><?= $configuration->has('configuration_group') ? $this->Html->link($configuration->configuration_group->title, ['controller' => 'ConfigurationGroups', 'action' => 'view', $configuration->configuration_group->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($configuration->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($configuration->modified) ?></td>
        </tr>
    </table>
</div>
