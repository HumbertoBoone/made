<?= $this->Html->script('view_item', ['block' => 'scriptBottom']) ?>   
<div style="width: 750px; display: inline-block; float:left;">
    <div id="item_image" style="width: 100%; height: 300px;">
        <img src="" >
    </div>
    <?php 
    $rows = count($item->images); 
    
    ?>
    <?php foreach($item->images as $c =>$images): ?>
    <?php if($c % 4 == 0): ?>
        <div class="row">
    <?php endif; ?>
        <div class="col-3">
            <div class="item_thumbnail_container" >
                <img class="item_thumbnail" src="/made/img/default.png">
            </div>
        </div>
    <?php if($c % 4 == 3 || $c == ($rows-1) ): ?>
        </div> 
    <?php endif; ?>
<?php endforeach; ?>
</div>
<div style="width: calc(100% - 750px); display: inline-block; float:left;">
    <h2><?= h($item->name) ?></h2>
    <h4><?= $this->Number->currency($item->price, 'MXN') ?></h3>
    <small>SKU: <?= h($item->sku) ?></small>
</div>
