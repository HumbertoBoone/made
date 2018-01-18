<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item[]|\Cake\Collection\CollectionInterface $items
 *  <?= $this->Html->image('items/'.$item['images']['0']['src'],['width'=>'100%']) ?>
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Orders Details'), ['controller' => 'OrdersDetails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Orders Detail'), ['controller' => 'OrdersDetails', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Images'), ['controller' => 'Images', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Image'), ['controller' => 'Images', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
    </ul>
</nav>

<?php //print("<pre>".print_r($items,true)."</pre>"); ?>
<div class="items index large-9 medium-8 columns content">
    <h3><?= __('Items') ?></h3>
        <div class="container-fluid">
            
            <?php $iterador = 0; ?>
            <?php foreach ($items as $n => $item): ?>
                <?php if(true): ?>
                    <?php $iterador++; ?>
                    <?php if ($iterador === 1): ?>
                        <div class="row">
                    <?php endif; ?>
                    <?php $path = isset($item['images']['0']['src']) ? 'items/'.$item['images']['0']['src'] : 'default.png'; ?>
                    <div class="col-sm-4">
                        <div class="image" style="background-image:url(img/<?php echo $path; ?>)">
                            <div class="price"><?= $this->Number->format($item->price, ['before' => '$ ','places' => 2, 'after' => ' MXN']) ?></div>
                        </div>
                        <div><?= h($item->sku) ?></div>
                        <?= $this->Form->create(null,['type' => 'post','url' => '/items/add-cart']) ?>
                        <?= $this->Form->hidden('item_id',['value' => $item->id]) ?>
                        <div><?= $this->Form->number('amount',['min' => 1, 'value' => 1, 'style' => 'width: 40%; display: inline-block;']) ?>
                        <?= $this->Form->button('Añadir') ?></div>
                        <?= $this->Form->end() ?>
                    </div>

                    <?php if ($iterador === 3): ?>
                        </div>
                        <?php $iterador = 0;?>
                    <?php endif; ?>
                <?php endif;?>
            <?php endforeach; ?>              

            </div>
        </div>
    
</div>
<div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primero')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('ultimo') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
