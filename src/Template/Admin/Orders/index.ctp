<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item[]|\Cake\Collection\CollectionInterface $items
 */
?>


<div class="">
    <h3><?= __('Ordenes') ?></h3>
    <table class="table table-hover" cellpadding="0" cellspacing="0">
        <thead class="thead-dark">
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id', 'ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id', 'ID CLIENTE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created', 'FECHA') ?></th>
                
                <th scope="col"><?= $this->Paginator->sort('payment_type', 'TIPO DE PAGO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grand_total', 'GRAN TOTAL') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status', 'ESTADO') ?></th>
                <th scope="col" class="actions"><?= __('ACCIONES') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $this->Number->format($order->id) ?></td>
                
                <td><?= $this->Number->format($order->customer_id) ?></td>
                <td><?= $order->created->i18nFormat(null, null, 'es_MX') ?></td>
                <td><?= h($order->payment_type) ?></td>
                <td><?= $this->Number->currency($order->grand_total, null, [ 'pattern' => '$ #,###.00 MXN']) ?></td>
                <td><?= h($order->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $order->id], ['class' => 'btn btn-primary']) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id), 'class' => 'btn btn-danger']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
        <?= $this->Paginator->first( __('Primera')) ?>
            <?= $this->Paginator->prev( __('Anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Siguiente')) ?>
            <?= $this->Paginator->last(__('Última')) ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}, mostrando {{current}} registro(s) de un total de {{count}}')]) ?></p>
    </div>
</div>
