<div class="items">
<?php
$this->Breadcrumbs->add([
    ['title' => 'Carrito'],
    ['title' => 'Dirección de Envío', 'url' => ['controller' => 'orders', 'action' => 'shipping']],
    ['title' => 'Resumen']
]); 

?>

    <h3><?= __('Carrito') ?></h3>

    <table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Imagen</th>
            <th scope="col">Descripción</th>
            <th scope="col">Precio Unitario</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Subtotal</th>
            <th scope="col"><i class="fas fa-trash-alt"></i></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($items as $n => $item): ?>
        <tr>
            <th scope="row"><?= $this->Html->image($item['img'] ,['class' => 's-contain', 'width' => '100%', 'height' => 'auto'] )?></th>
            <td><?= $item['name'].' '.$item['description'] ?></td>
            <td><?= $this->Number->format($item['price'], ['places' => 2,'before' => '$ ']) ?></td>
            <td>
                <?= $this->Form->create(null,['type' => 'patch','url' => '/items/update-cart']) ?>
                <?= $this->Form->hidden('item_index',['value' => $n]) ?>
                <?= $this->Form->control('amount',['type' => 'number', 'value' => $item['quantity'], 'label' => false, 'step' => 0.001, 'class' => 'inline quantity form-control']) ?>
                <span class="unit"><?= $item['unit'] ?></span>
                <?= $this->Form->button('<i class="fas fa-sync-alt" title="Actualizar Cantidad"></i>', ['class' => 'inline btn btn-secondary']) ?>
                <?= $this->Form->end() ?>
            </td>
            <td><?= $this->Number->format($item['subtotal'], ['places' => 2,'before' => '$ ']) ?></td>
            <td>
                <?= $this->Form->create(null,['type' => 'delete','url' => '/items/delete-cart']) ?>
                <?= $this->Form->hidden('item_index',['value' => $n]) ?>
                <?= $this->Form->button('<i class="fas fa-times" title="Eliminar"></i>', ['class' => 'btn btn-secondary']) ?>
                <?= $this->Form->end() ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <tbody>
</table>
<div class="clearfix">
    <?= $this->Form->create(null, ['type' => 'post', 'url' => 'order/add-coupon']) ?>
    <?= $this->Form->control('coupon_code', ['type' => 'text']) ?>
    <?= $this->Form->button('Continuar', ['onclick' => "window.location.href='../orders/registered'", 'class' => 'btn btn-primary float-right']) ?>
    <?= $this->Form->end() ?>
</div>
    