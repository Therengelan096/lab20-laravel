<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h3>Prueba de Conexión de Base de Datos:</h3>";

try {
    $host = 'mysql-285db235-therengelan-650.g.aivencloud.com';
    $port = '10083';
    $db   = 'defaultdb';
    $user = 'avnadmin';
    $pass = 'AVNS_Hbnyjo2WBHjI33ah8UW';

    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "<span style='color:green;'>✔ ¡Conexión exitosa a Aiven MySQL desde el contenedor!</span>";
} catch (\PDOException $e) {
    echo "<span style='color:red;'>❌ Error de conexión: </span>" . $e->getMessage();
}