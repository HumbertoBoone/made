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
            <div class="col-2"><?= $item['quantity'] ?></div>
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
    <div id="payment_selection" style="display: inline-block;">
        <form>
            <input type="radio" name="payment_type" value="paypal"> PayPal
            <input type="radio" name="payment_type" value="oxxo"> OXXO
            <input type="radio" name="payment_type" value="card"> Tarjeta de Crédito/Débito 
        </form>
    </div>
    <div class="btn-group" role="group" aria-label="Basic example">
  <button type="button" class="btn btn-outline-secondary"><img src="../img/paypal-logo.png" ></button>
  <button type="button" class="btn btn-secondary"><img src="../img/oxxopay_brand.png" style="height: 26px;"></button>
  <button type="button" class="btn btn-outline-secondary"><img src="../img/cards-logo-tp.png" style="height: 26px;"></button>
</div>
</div>