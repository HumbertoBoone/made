<?= $order ?>
<div class="row">
    <div class="col">
        Número de Órden: <?= h($order->id) ?>
    </div>
    <div class="col">
        Fecha: <?= h($order->created) ?>
    </div>
</div>
<div class="row">
    <div class="col">
        <?= h($order->status) ?>
    </div>
    <div class="col">
        <?= h($order->payment_type) ?>
    </div>
</div>
<div class="row">
    <div class="col" style="float: right;">
        <?= h($order->reference) ?>
    </div>
</div>
<div class="row">
    <div class="col">
    <h5>Datos del Cliente: </h5>
        <p>
            <span class="bold">Compañia:</span> <?= h($order->customer->company) ?><br>
            <span class="bold">Nombre:</span> <?= h($order->customer->first_name) ?><br>
            <span class="bold">Apellido(s):</span> <?= h($order->customer->last_name) ?><br>
            <span class="bold">Dirección:</span> <?= h($order->customer->address1).' '.h($order->customer->address2) ?><br>
            <span class="bold">Teléfono:</span> <?= h($order->customer->tel) ?><br>
            <span class="bold">Ciudad: </span> <?= h($order->customer->city).', '.h($order->customer->state) ?>
        </p>
    </div>
    
    <div class="col">
        <h5>Datos de Envío</h5>
        <p>
            <span class="bold">Método de Envío: </span> <?= h($order->shipping_method) ?><br>
            <span class="bold">Destinatario: </span> <?= h($order->recipient_name) ?><br>
            <span class="bold">Dirección: </span> <?= h($order->address1).' '.h($order->address2) ?> <br>
            <span class="bold">Ciudad: </span> <?= h($order->city) ?> <br>
            <span class="bold">Estado: </span> <?= h($order->state) ?> <br>
            <span class="bold">Código Postal: </span> <?= h($order->postal_code) ?> <br>
        </p>
    </div>
</div>