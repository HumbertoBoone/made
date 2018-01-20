<div class="items index large-9 medium-8 columns content">
    <h3><?= __('Carrito') ?></h3>
    <div class="container-fluid">
        <?php if(!empty($items)): ?>
            <?php foreach($items as $n => $item): ?>
        
                <div class="row">
                    <div class="col-xs-4">
                        <div class="image">
                            <?= $this->Html->image($item['img']) ?>
                        </div>
                    </div>
                    <div class="col-xs-6"><h6><?= $item['description'] ?></h6></div>
                    <div class="col-xs-2"></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>