<div class="items">
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
                                <h6><?= $item['description'] ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="dTable">
                            <div class="dTable-cell">
                                <h6></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="dTable">
                            <div class="dTable-cell">
                                <h6></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="dTable">
                            <div class="dTable-cell">
                                <h6></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 text-center ">
                        <div class="dTable">
                            <div class="dTable-cell">
                                <i class="fas fa-times" title="Eliminar"></i></div>
                            </div>
                        </div>    
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>