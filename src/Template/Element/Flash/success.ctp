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
<div class="message success" onclick="this.classList.add('hidden')"><?= $message.$link ?></div>
