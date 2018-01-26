<h1>Selecciona tu método de pago preferido</h1>


<?= $this->Form->create(null, ['type' => 'post','url' => '/orders/payment-redirect']) ?>
<?= $this->Form->radio('payment', [
    ['value' => 'paypal','text' => 'Paypal'],
    ['value' => 'card','text' => 'Tarjeta de Crédito/Débito'],
    ['value' => 'oxxo','text' => 'OXXO']
    ]) ?>
<?= $this->Form->submit('Continuar') ?>
<?= $this->Form->end() ?>
<div id="paypal-button-container"></div>