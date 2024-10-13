<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacen</title>
    <link rel="shortcut icon" href="/build/images/logo.png" type="image/x-icon">
    <!--  -->
    <?php if (strtok($_SERVER['REQUEST_URI'], '?') === '/'): ?>
        <link rel="stylesheet" href="/build/css/app.css">
    <?php else: ?>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="/build/plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/build/dist/css/adminlte.min.css">
    <?php endif; ?>
</head>
<?php echo $contenido; ?>

</html>