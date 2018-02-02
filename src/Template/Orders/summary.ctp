<div id="summary">
    <h1>Resúmen de Pedido</h1>
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

</div>