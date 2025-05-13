<?php
session_start();

// Verificar si la cookie "recordarme" NO está presente
$recordarme = isset($_COOKIE["recordarme"]);

// Destruir la sesión actual
$_SESSION = array();
session_destroy();

// Si NO existe la cookie "recordarme", eliminar todas las cookies manualmente
if (!$recordarme) {
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            // Elimina la cookie estableciendo su tiempo de expiración en el pasado
            setcookie($name, '', time() - 3600, '/');
        }
    }
}

// Redirigir al login (index.php)
header("Location: index.php");
exit;
?>
