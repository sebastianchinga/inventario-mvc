<?php
require 'includes/database.php';
$db = conectarDB();

$nombre = 'Ramses';
$email = 'jchingapalacios05@gmail.com';
$password = 'admin';
$passwordHash = password_hash($password, PASSWORD_BCRYPT);

$query = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$passwordHash')";
$resultado = mysqli_query($db, $query);

if ($resultado) {
    header('Location: /almacen/');
}