<body class="centrar-contenido">

    <main class="login">
        <div class="login__imagen">
            <img src="/build/images/logo-login.svg" alt="Logotipo">
        </div>
        <div class="login__contenido">
            <h1 class="login__titulo">Login</h1>
            <?php include __DIR__ . '/../templates/alertas.php'; ?>
            <form method="post" class="login__formulario">
                <input type="email" name="usuario[email]" id="email" class="login__input" placeholder="Email" value="<?php echo $usuario->email ?>">
                <input type="password" name="usuario[password]" id="password" class="login__input" placeholder="****">
                <input type="submit" value="Login" class="boton">
            </form>
        </div>
    </main>

</body>