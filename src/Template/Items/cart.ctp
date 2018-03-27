<div class="items">
<?php
$this->Breadcrumbs->add([
    ['title' => 'Carrito'],
    ['title' => 'Dirección de Envío', 'url' => ['controller' => 'orders', 'action' => 'shipping']],
    ['title' => 'Resumen']
]); 

?>

    <h3><?= __('Carrito') ?></h3>
    <div class="container-fluid carrito">
        <div class="row fondo-oscuro">
            <div class="col-1 text-center texto-claro"><h5>Imagen</h5></div>
            <div class="col-4 texto-claro"><h5>Descripcion</h5></div>
            <div class="col-2 texto-claro"><h5>Precio Unitario</h5></div>
            <div class="col-2 texto-claro"><h5>Cantidad</h5></div>
            <div class="col-2 texto-claro"><h5>Subtotal</h5></div>
            <div class="col-1 text-center texto-claro"><h5><i class="fas fa-trash-alt"></i></h5></div>
        </div>
        <?php if(!empty($items)): ?>
            <?php foreach($items as $n => $item): ?>
        
                <div class="row">
                    <div class="col-1">
                        <div class="image">
                            <div class="dTable">
                                <div class="dTable-cell">
                                    <?= $this->Html->image($item['img'] ,['class' => 's-contain', 'width' => '100%', 'height' => 'auto'] )?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="dTable">
                            <div class="dTable-cell">
                                <h6><?= $item['name'].' '.$item['description'] ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="dTable">
                            <div class="dTable-cell">
                                <h6><?= $this->Number->format($item['price'], [
                                    'places' => 2,
                                    'before' => '$ '
                                ]) ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="dTable">
                            <div class="dTable-cell">
                                <?= $this->Form->create(null,['type' => 'patch','url' => '/items/update-cart']) ?>
                                <?= $this->Form->hidden('item_index',['value' => $n]) ?>
                                <?= $this->Form->control('amount',['type' => 'number', 'value' => $item['quantity'], 'label' => false, 'step' => 0.001]) ?>
                                <?= $item['unit'] ?>
                                <?= $this->Form->button('<i class="fas fa-sync-alt"></i>') ?>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="dTable">
                            <div class="dTable-cell">
                                <h6><?= $this->Number->format($item['subtotal'], [
                                    'places' => 2,
                                    'before' => '$ '
                                ]) ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 text-center ">
                        <div class="dTable">
                            <div class="dTable-cell">
                                <?= $this->Form->create(null,['type' => 'delete','url' => '/items/delete-cart']) ?>
                                <?= $this->Form->hidden('item_index',['value' => $n]) ?>
                                <?= $this->Form->button('<i class="fas fa-times" title="Eliminar"></i>') ?>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>    
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div>
    <h6><?= $this->Number->format($total, [
        'places' => 2,
        'before' => '$ '
    ]) ?></h6>
    </div>
    <?= $this->Form->button('Continuar', ['onclick' => "window.location.href='../orders/registered'"]) ?>
</div>
