<?= $this->Form->create(null,['type' => 'post', 'url' => '']) ?>

<?php 
foreach($conekta_configurations as $k => $config){
    echo $this->Form->hidden($config->id);
    echo $this->Form->input($config->id, ['label' => $config->title,'value' => $config->value]);
}?>
<?= $this->Form->submit('Guardar') ?>
<?= $this->Form->end() ?>