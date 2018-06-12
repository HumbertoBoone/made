<?php 
$myTemplates = [];
?>
<?= $this->Html->script('new_item', ['block' => 'scriptBottom']) ?>   
<?= $this->Form->create($item, ['enctype' => 'multipart/form-data', 'onsubmit' => 'deleteUnusedInputs()']) ?>
        <div class="row">
            <div class="col">
                <div class="images_box">
                    <div class="filediv">
                        <input name="images[1][img]" type="file" id="file" class="file">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <?= $this->Form->control('sku',['label' => false,'placeholder' => 'SKU', 'class' => 'form-control']) ?>
                <?= $this->Form->control('name', ['label' => false, 'placeholder' => 'Nombre', 'class' => 'form-control']) ?>
            </div>
            <div class="col">
               <?= $this->Form->control('short_description',['type' => 'textarea','label' => false,'placeholder' => 'Descripción Corta', 'class' => 'form-control', 'style' => 'height: 95px']) ?>
            </div>
        </div>
        <div class="form-row">
                <div class="col">
                    <?= $this->Form->control('price', ['label' => false, 'placeholder' => 'Precio', 'class' => 'form-control']) ?>
                    <?= $this->Form->control('unit', ['label' => false, 'placeholder' => 'Unidad', 'class' => 'form-control']) ?>
                </div>
                <div class="col">
                <?= $this->Form->control('stock', ['label' => false, 'placeholder' => 'Stock', 'class' => 'form-control']) ?>
                    <?= $this->Form->control('brand_id', ['label' => false,'type' => 'select','class' => 'form-control', 'options' => $brands, 'empty' => 'Marca'])?>
                </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <?= $this->Form->control('categories._ids', ['type' => 'select', 'class' => 'form-control', 'multiple' => true, 'options' => $categories,'label' => 'Categorias']) ?>
            </div>
        </div>

        
        <div id="options_wrapper"></div>
        <button type="button"class="btn btn-secondary" id="btnNewGroup">Nuevo Grupo</button><br>
        <?php
        echo $this->Form->button(__('Guardar'), ['class' => 'btn btn-primary']);
    ?>
     <?= $this->Form->end() ?>
<div>
<div>

   
