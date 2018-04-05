<?php 
     $this->Html->css('oxxo.css', ['block' => true]);
?>
<div class="opps" style="<?php echo isset($style) ? $style : "" ?>">
    <div class="opps-header">
        <div class="opps-reminder">Ficha digital. No es necesario imprimir.</div>
        <div class="opps-info">
            <div class="opps-brand"><img src="../oxxopay_brand.png" alt="OXXOPay"></div>
            <div class="opps-ammount">
                <h3>Monto a pagar</h3>
                <h2><?= $this->Number->currency(intval($order->amount) / 100, 'MXN') ?></h2>
                <p>OXXO cobrará una comisión adicional al momento de realizar el pago.</p>
            </div>
        </div>
        <div class="opps-reference">
            <h3>Referencia</h3>
            <h1><?= preg_replace('/\B(?=(\d{4})+(?!\d))/','-',$order->charges[0]->payment_method->reference) ?></h1>
        </div>
    </div>
    <div class="opps-instructions">
        <h3>Instrucciones</h3>
        <ol>
            <li>Acude a la tienda OXXO más cercana. <a href="https://www.google.com.mx/maps/search/oxxo/" target="_blank">Encuéntrala aquí</a>.</li>
            <li>Indica en caja que quieres realizar un pago de <strong>OXXOPay</strong>.</li>
            <li>Dicta al cajero el número de referencia en esta ficha para que tecleé directamete en la pantalla de venta.</li>
            <li>Realiza el pago correspondiente con dinero en efectivo.</li>
            <li>Al confirmar tu pago, el cajero te entregará un comprobante impreso. <strong>En el podrás verificar que se haya realizado correctamente.</strong> Conserva este comprobante de pago.</li>
        </ol>
        <div class="opps-footnote">Al completar estos pasos recibirás un correo de <strong>Nombre del negocio</strong> confirmando tu pago.</div>
    </div>
</div>	
