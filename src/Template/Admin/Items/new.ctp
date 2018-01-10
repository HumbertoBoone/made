<?= $this->Form->create($item) ?>
<fieldset>
    <legend><?= __('Nuevo Articulo') ?></legend>
    <?php
        //debug($categories);
        //echo $this->Form->select('category', $categories, ['multiple' => true]);
       
        echo $this->Form->control('sku');
        echo $this->Form->control('description');
        echo $this->Form->control('price');
        echo $this->Form->control('stock');
        echo $this->Form->control('unit');
        echo $this->Form->control('brand');
        echo $this->Form->control('categories._ids', [
            'type' => 'select',
            'multiple' => true,
            'options' => $categories,
        ]);
        echo $this->Form->button(__('Guardar'));
    ?>
     <?= $this->Form->end() ?>
</fieldset>


   
