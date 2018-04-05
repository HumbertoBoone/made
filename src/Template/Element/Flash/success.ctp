<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
if (isset($params['link'])) {
    $link = '<a href="'.$params['link'].'">Ver carrito</a>';
}else{
    $link = "";
}
?>
<div  class="alert alert-success alert-dismissible" role="alert">
    <?= $message.$link ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
