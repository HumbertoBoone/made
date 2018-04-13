<?= $this->Form->create(null,['type' => 'post', 'url' => '/orders/shipping_method']) ?>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Método</th>
            <th scope="col">Precio</th>
            <th scope="col">Selección</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($methods as $method): ?>
    <tr>
        <th scope="row"><?= $method['description'] ?></th>
        <td><?= $method['price'] ?></td>
        <td><input type="radio" name="shipping_method" value="<?= $method['id'] ?>"></td>
    </tr>
    <?php endforeach; ?>
    <tbody>
</table>
<div class="clearfix">
    <?= $this->Form->button('Continuar',['class' => 'btn btn-primary float-right']) ?>
</div>
<?= $this->Form->end() ?>