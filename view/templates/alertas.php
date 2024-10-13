<?php foreach ($alertas as $key => $mensajes) : ?>
    <?php foreach($mensajes as $mensaje): ?>
        <p class="alert alert-<?php echo $key ?>"><?php echo $mensaje; ?></p>
    <?php endforeach; ?>
<?php endforeach; ?>