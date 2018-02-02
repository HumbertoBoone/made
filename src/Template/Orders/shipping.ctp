<div id="addresses">
    <?php $cont = 0; ?>
    <?= $this->Form->create(null,['type' => 'post', 'url' => '/orders/shipping']) ?>
    <?php foreach($addresses as $n => $address): ?>
        <div class="row">
            <div class="col-4">
                <input type="radio" name="shipping_address" class="address<?= $cont ?>" value="<?= $address['id'] ?>">
                <label for="address<?= $cont ?>"> 
                <?= $address['recipient_name'] ?> <br>
                <?= $address['address1'] ?> <br>
                <?= $address['address2'] ?> <br>
                <?= $address['postal_code'] ?> <br>
                <?= $address['state'] ?> <br>
                <?= $address['city'] ?> <br>
                <?= $address['country'] ?></label>
            </div>
            <?php $cont++; ?>
            <?php if($cont === 2): ?>
                </div>
                <?php $cont = 0; ?>
            <?php endif; ?>
    <?php endforeach; ?>
    <?= $this->Form->button('Continuar') ?>
    <?= $this->Form->end() ?>
</div>