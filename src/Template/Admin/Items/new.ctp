<?= $this->Html->script('new_item', ['block' => 'scriptBottom']) ?>   
<?= $this->Form->create($item, ['enctype' => 'multipart/form-data']) ?>
<fieldset>
    <legend><?= __('Nuevo Articulo') ?></legend>
    <?php
        //debug($categories);
        //echo $this->Form->select('category', $categories, ['multiple' => true]);
        ?><!--<button type="button" id="btnMedia">Media</button>-->
        <div class="images_box">
            <div class="filediv">
                <input name="file[]" type="file" id="file"/>
            </div>
        </div>
        <?php
        
       // echo $this->Form->file('images.1.img');
        echo $this->Form->control('sku');
        echo $this->Form->control('name');
        echo $this->Form->control('description');
        echo $this->Form->control('price');
        echo $this->Form->control('stock');
        echo $this->Form->control('unit');
        echo $this->Form->control('brand');
        /*echo $this->Form->control('categories._ids', [
            'type' => 'select',
            'multiple' => true,
            'options' => $categories,
        ]);*/
        ?>
        <button type="button" id="btnNewGroup">Nuevo Grupo</button>
        <div id="options_wrapper"></div>
        <?php
        echo $this->Form->button(__('Guardar'));
    ?>
     <?= $this->Form->end() ?>
</fieldset>


   
