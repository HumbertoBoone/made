<div id="summary">
<?php 
$this->Breadcrumbs->add([
    ['title' => 'Carrito', 'url' => ['controller' => 'items', 'action' => 'cart']],
    ['title' => 'Dirección de Envío', 'url' => ['controller' => 'orders', 'action' => 'shipping']],
    ['title' => 'Resumen'],
]); 
?>
    <h1>Resúmen de Pedido</h1>
    <h2>Articulos</h2>
    <div>
        <div class="row">
            <div class="col-2">SKU</div>
            <div class="col-4">Descripción</div>
            <div class="col-2">Precio Unitario</div>
            <div class="col-2">Cantidad</div>
            <div class="col-2">Subtotal</div>
        </div>
        <?php foreach($items as $item): ?>
        <div class="row">
            <div class="col-2"><?= $item['sku'] ?></div>
            <div class="col-4"><?= $item['brand'].' '.$item['description'] ?></div>
            <div class="col-2"><?= $item['price'].'/'.$item['unit'] ?></div>
            <div class="col-2"><?= $item['amount'] ?></div>
            <div class="col-2"><?= $item['subtotal'] ?></div>
        </div>
        <?php endforeach; ?>
    </div>
    <h2>Dirección de Envío</h2>
    <div id="shipping_summary">
        <?= $shipping_address['recipient_name'] ?> <br>
        <?= $shipping_address['address1'] ?> <br>
        <?= $shipping_address['address2'] ?> <br>
        <?= $shipping_address['state'] ?> <br>
        <?= $shipping_address['city'] ?> <br>
        <?= $shipping_address['country'] ?> <br>
        <?= $shipping_address['postal_code'] ?> <br>
    <div>
</div>