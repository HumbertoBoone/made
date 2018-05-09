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

    <form>
        <div id="metodo" class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary active">
                <input type="radio" name="options" id="paypal" id="option1" autocomplete="off"><img src="../img/paypal-logo.png" >
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" id="oxxo" id="option2" autocomplete="off"><img src="../img/oxxopay_brand.png" style="height: 26px;">
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" id="card" id="option3" autocomplete="off"><img src="../img/cards-logo-tp.png" style="height: 26px;">
            </label>
        </div>
    </form>
    <div id="payment_box">
        <div id="paypal_container" class="container_method" style="display: none">
            <div id="paypal-button-container"></div>
        </div>
        <div id="oxxo_container" class="container_method" style="display: none">
            <button type="button" class="btn btn-secondary">Generar recibo de pago</button>
            <a href="oxxo" class="btn btn-secondary">Generar recibo de pago</a>
        </div>
        <div id="card_container" class="container_method" style="display: none">
            <form action="" method="POST" id="card-form">
                <input type="hidden" value="10" name="hd">
                <span class="card-errors"></span>
                <div>
                    <label>
                    <span>Nombre del tarjetahabiente</span>
                    <input type="text" size="20" data-conekta="card[name]">
                    </label>
                </div>
                <div>
                    <label>
                    <span>Número de tarjeta de crédito</span>
                    <input type="text" size="20" data-conekta="card[number]">
                    </label>
                </div>
                <div>
                    <label>
                    <span>CVC</span>
                    <input type="text" size="4" data-conekta="card[cvc]">
                    </label>
                </div>
                <div>
                    <label>
                    <span>Fecha de expiración (MM/AAAA)</span>
                    <input type="text" size="2" data-conekta="card[exp_month]">
                    </label>
                    <span>/</span>
                    <input type="text" size="4" data-conekta="card[exp_year]">
                </div>
                <button type="submit">Crear token</button>
            </form>
        </div>
    </div>
</div>