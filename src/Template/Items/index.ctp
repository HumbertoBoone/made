<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item[]|\Cake\Collection\CollectionInterface $items
 *  <?= $this->Html->image('items/'.$item['images']['0']['src'],['width'=>'100%']) ?>
 *   <h3><?= __('Items') ?></h3>
 */
?>
<div class="row">
<nav class="col-12 d-none d-md-block bg-light " id="actions-sidebar">
    <ul class="nav nav-categorias">

        <?php foreach($categories as $category): ?>
            <li class="nav-item pt-3 pb-3"><?= $this->Html->link(__($category->category), ['action' => '?cat_id='.$category->id]) ?></li>
        <?php endforeach; ?>
    </ul>

</nav>

<?php //print("<pre>".print_r($items,true)."</pre>"); ?>
<div class="col-12 ml-sm-auto pt-3 px-4">
  
        <div class="container-fluid">
            
            <?php $iterador = 0; ?>
            <?php foreach ($items as $n => $item): ?>
                <?php if(true): ?>
                    <?php $iterador++; ?>
                    <?php if ($iterador === 1): ?>
                        <div class="row">
                    <?php endif; ?>
                    <?php $path = isset($item['images']['0']['src']) ? $item['images']['0']['src'] : 'img/default.png'; ?>
                    <div class="col-sm-4">
                        <div class="image" style="background-image:url(<?php echo '../made/'.$path; ?>)">
                           
                        </div>
                        <div><?php echo isset($item->sku) && $item->sku != '' ? h($item->sku) : "<br>" ?></div>
                        <div class="price"><?= $this->Number->format($item->price, ['before' => '$ ','places' => 2, 'after' => ' MXN']) ?></div>
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
            <div class="row">
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
            </div>
            </div>
        </div>
    
</div>


</div>
