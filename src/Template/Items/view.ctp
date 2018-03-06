<?= $this->Html->script('view_item', ['block' => 'scriptBottom']) ?>   
<div style="width: 750px; display: inline-block; float:left;">
    <div id="item_image" style="width: 100%; height: 300px;">
        <img src="" >
    </div>
    <?php 
    $rows = count($item->images); 
    
    ?>
    <?php foreach($item->images as $c =>$image): ?>
    <?php if($c % 4 == 0): ?>
        <div class="row">
    <?php endif; ?>
        <div class="col-3">
            <div class="item_thumbnail_container" >
                <img class="item_thumbnail" src="/made/<?= $image['src'] ?>">
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
    <p><?= h($item->short_description) ?></p>
    <?= $this->Form->create(null, ['type' => 'POST', 'url' => '/items/add-cart']) ?>
        <?= $this->Form->hidden('item_id',['value' => $item->id]) ?>
        <?php foreach($item->groups as $g => $group): ?>
            <fieldset>
                <legend><?= h($group['name'] ) ?></legend>
                <p><?= h($group['description']) ?></p>
                <?php if($group['type'] == 'checkbox'): ?>
                    <?php foreach($group['options'] as $o => $option):?>
                        <label for="option_<?= $option['name'].'_'.$o ?>"><?= $option['name'].' +'.$this->Number->currency($option['value'], 'MXN') ?></label>
                        <input type="checkbox" id="option_<?= $option['name'].'_'.$o ?>" name="<?= $group['name'] ?>[][<?=$option['name'] ?>]" value="<?=$option['value'] ?>"><br>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if($group['type'] == 'select'): ?>
                    <select <?php $group['required'] == 1 ? 'required' : ""; ?>>
                        <option disabled selected value>-- seleccione una opción --</option>
                        <?php foreach($group['options'] as $o => $option): ?>
                            <option value="<?= $option['name'] ?>"><?= $option['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <?php if($group['type'] == 'radio'): ?>
                    <?php $group['required'] == 1 ? 'required' : ""; ?>
                    <?php foreach($group['options'] as $o => $option):?>
                        <label for="option_<?= $option['name'].'_'.$o ?>"><?= $option['name'].' +'.$this->Number->currency($option['value'], 'MXN') ?></label>
                        <input type="radio" id="option_<?=$option['name'].'_'.$o ?>" name="<?= $group['name'] ?>" value="<?=$option['name'] ?>" <?php $group['required'] == 1 ? ' required' : ""; ?>><br>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if($group['type'] == 'textarea'): ?>
                    <?php foreach($group['options'] as $o => $option):?>
                        <label><?= $option['name'] ?> <?php $option['value'] > 0 ? '(+'.$this->Number->currency($option['value'], 'MXN').')' : ""; ?></label><br>
                        <textarea name="<?= $option['name'] ?>"></textarea>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if($group['type'] == 'custom_text'): ?>
                    <?php foreach($group['options'] as $o => $option):?>
                        <label><?= $option['name'] ?><?php $option['value'] > 0 ? ' (+'.$this->Number->currency($option['value'], 'MXN').')' : ""; ?></label>
                        <input type="text" name="<?= $option['name'] ?>" min="<?= $option['min'] ?>" max="<?= $option['max'] ?>" <?php $group['required'] == 1 ? ' required' : ""; ?>>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if($group['type'] == 'custom_int_num' || $group['type'] == 'custom_dec_num'): ?>
                    <?php foreach($group['options'] as $o => $option):?>
                        <label><?= $option['name'] ?><?php $option['value'] > 0 ? ' (+'.$this->Number->currency($option['value'], 'MXN').')' : ""; ?></label>
                        <input type="number" name="<?= $option['name'] ?>" min="<?= $option['min'] ?>" max="<?= $option['max'] ?>" <?php $group['required'] == 1 ? ' required' : ""; ?>>
                    <?php endforeach; ?>
                <?php endif; ?>
                <pre></pre>
            </fieldset>
        <?php endforeach; ?>
        <?= $this->Form->number('amount',['min' => 1, 'value' => 1, 'style' => 'width: 40%; display: inline-block;']) ?>
        <?= $this->Form->button('Añadir') ?>
    <?= $this->Form->end() ?>
</div>
