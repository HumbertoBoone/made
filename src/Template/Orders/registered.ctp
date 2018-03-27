<div class="container">
    <div class="row">
        <div class="col-4 vl-r">    |
            <div class="contenido-centrado">
                <div class="centrado-vertical">
                    <h4>Iniciar Sesión</h4>
                    <p>Si ya tienes una cuenta inicia sesión para continuar</p>
                    <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login','?' => ['redirect'=>'cart']]]) ?>
                    <?= $this->Form->control('email') ?>
                    <?= $this->Form->control('password') ?>
                    <?= $this->Form->button(__('Iniciar Sesión')) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
        <div class="col-4 vl-r">
            <div class="contenido-centrado">
                <div class="centrado-vertical">
                    <h4>Registrate</h4>
                    <p>Si aun no tienes una cuenta y deseas registrarte, has click en el siguiente enlace</p>
                    <?= $this->Form->button('Registrarse!', ['onclick' => "window.location.href='../users/register?redirect=cart'"]) ?>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="contenido-centrado">
                <div class="centrado-vertical">
                    <h4>Comprar como Invitado</h4>
                    <sup>(no recomendado)</sup>
                    <p>Si deseas comprar como invitado, has click en el siguiente enlace</p>
                    <?= $this->Form->button('Comprar como Invitado!', ['onclick' => "window.location.href='../orders/guest'"]) ?>
                </div>
            </div>
        </div>
    </div>
</div>