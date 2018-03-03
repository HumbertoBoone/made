<?= $this->Html->script('new_item', ['block' => 'scriptBottom']) ?>   
<?= $this->Form->create($item, ['enctype' => 'multipart/form-data', 'onsubmit' => 'deleteUnusedInputs()']) ?>
<fieldset>
    <legend><?= __('Nuevo Articulo') ?></legend>
    <?php
        //debug($categories);
        //echo $this->Form->select('category', $categories, ['multiple' => true]);
        ?><!--<button type="button" id="btnMedia">Media</button>-->
        <div class="images_box">
            <div class="filediv">
                <input name="images[1][img]" type="file" id="file" class="file">
            </div>
        </div>
        <?php
        echo $this->Form->control('sku',['label' => 'SKU']);
        echo $this->Form->control('name', ['label' => 'Nombre: ']);
        echo $this->Form->control('short_description',['label' => 'Descripción Corta', 'type' =>'textarea']);
        echo $this->Form->control('description', ['id' => 'summernote', 'label' => 'Descripción']);
        echo $this->Form->control('price',['label' => 'Precio:',  'templates' => [
            'inputContainer' => '<div class="input {{type}}{{required}}">{{content}} <span>MXN</span></div>',
            'input' => '<span>$</span><input type="{{type}}" name="{{name}}"{{attrs}} >',
        ]]);
        echo $this->Form->control('stock');
        echo $this->Form->control('unit', ['label' => 'Unidad']);
        //echo $this->Form->control('brand_id');
        echo $this->Form->control('brand_id', [
            'type' => 'select',
            'options' => $brands,
            'empty' => 'Escoga uno',
            'label' => 'Marca'
        ]);
        echo $this->Form->control('categories._ids', [
            'type' => 'select',
            'multiple' => true,
            'options' => $categories,
            'label' => 'Categorias'
        ]);
        ?>
        <button type="button" id="btnNewGroup">Nuevo Grupo</button>
        <div id="options_wrapper"></div>
        <?php
        echo $this->Form->button(__('Guardar'));
    ?>
     <?= $this->Form->end() ?>
</fieldset>


   
