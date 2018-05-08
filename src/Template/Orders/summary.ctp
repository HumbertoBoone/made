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
    <div id="payment_selection" style="display: none;">
        <form>
            <input type="radio" name="payment_type" value="paypal"> PayPal
            <input type="radio" name="payment_type" value="oxxo"> OXXO
            <input type="radio" name="payment_type" value="card"> Tarjeta de Crédito/Débito 
        </form>
    </div>
    <div class="btn-group" role="group" aria-label="Basic example">
        <button id="paypal_btn" type="button" class="btn btn-outline-secondary btn-pay-sel"><img src="../img/paypal-logo.png" ></button>
        <button id="oxxo_btn" type="button" class="btn btn-secondary btn-pay-sel"><img src="../img/oxxopay_brand.png" style="height: 26px;"></button>
        <button id="card_btn" type="button" class="btn btn-outline-secondary btn-pay-sel"><img src="../img/cards-logo-tp.png" style="height: 26px;"></button>
    </div>

    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-secondary active">
            <input type="radio" name="options" id="option1" autocomplete="off" checked> Active
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="options" id="option2" autocomplete="off"> Radio
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="options" id="option3" autocomplete="off"> Radio
        </label>
    </div>

    <div id="payment_box">
        <div id="paypal_container" style="display: none">
            <div id="paypal-button-container"></div>
        </div>
        <div id="oxxo_container" style="display: none">
            <button type="button" class="btn btn-secondary">Generar recibo de pago</button>
        </div>
        <div id="card_container" style="display: none">
        card
        </div>
    </div>
</div>