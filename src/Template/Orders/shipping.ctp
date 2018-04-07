<div id="addresses">
<?php 
$this->Breadcrumbs->add([
    ['title' => 'Carrito', 'url' => ['controller' => 'items', 'action' => 'cart']],
    ['title' => 'Dirección de Envío'],
    ['title' => 'Resumen', 'url' => ['controller' => 'orders', 'action' => 'summary']],
]); 

?>

    <?php $cont = 0; ?>
    <?= $this->Form->create(null,['type' => 'post', 'url' => '/orders/shipping']) ?>
    
    <?php array_unshift($addresses, $main_address); ?>
    <?php $rows = count($addresses); ?>

    <?php foreach($addresses as $n => $address): ?>
        <?php if($n % 4 == 0): ?>
            <div class="row">
        <?php endif;?>
        <div class="col-3">
            <label for="address<?= $n ?>"> 
            <?= $address['recipient_name'] ?> <br>
            <?= $address['address1'] ?> <br>
            <?= $address['address2'] ?> <br>
            <?= $address['postal_code'] ?> <br>
            <?= $address['state'] ?> <br>
            <?= $address['city'] ?> <br>
            <?= $address['country'] ?></label>
            <input type="radio" name="shipping_address" id="address<?= $n ?>" value="<?php echo !isset($address['id']) ? 'main' : $address['id'] ?>">
        </div>
        <?php if($n % 4 == 3 || $n == ($rows-1) ): ?>
            </div>  
        <?php endif; ?>
    <?php endforeach; ?>
    <br>
    <?= $this->Form->button('Continuar') ?>
    <?= $this->Form->end() ?>
</div>