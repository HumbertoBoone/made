<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item[]|\Cake\Collection\CollectionInterface $items
 */
?>


<div class="">
    <h3><?= __('Articulos') ?></h3>
    <table class="table table-hover" cellpadding="0" cellspacing="0">
        <thead class="thead-dark">
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id', 'ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name', 'NOMBRE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('images', 'IMAGEN') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sku', 'SKU') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price', 'PRECIO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('unit', 'UNIDAD') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stock', 'CANT. EN STOCK') ?></th>
                <th scope="col" class="actions"><?= __('ACCIONES') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?= $this->Number->format($item->id) ?></td>
                <td><?= h($item->name) ?></td>
                <td><?= $this->Html->image($item->images[0]['src'], ['width' => '100px', 'height' => 'auto']) ?></td>
                <td><?= h($item->sku) ?></td>
                <td><?= $this->Number->currency($item->price, null, [ 'pattern' => '$ #,###.00 MXN']) ?></td>
                <td><?= h($item->unit) ?></td>
                <td><?= $this->Number->format($item->stock) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $item->id], ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $item->id], ['class' => 'btn btn-secondary']) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id), 'class' => 'btn btn-danger']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primero')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('ultimo') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
