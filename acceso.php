<?php
session_start();

if ($_POST['usuario'] != "" && $_POST['clave'] != "") {
    // Crear las sesiones
    $_SESSION['usuario'] = $_POST['usuario'];
    $_SESSION['clave'] = $_POST['clave'];

    // Si el checkbox fue marcado
    if (isset($_POST['recordarme']) && $_POST['recordarme'] == '1') {
        setcookie('recordarme', $_POST['recordarme'],0,"/");
        setcookie('c_usuario', $_POST['usuario'], 0, "/");
        setcookie('c_clave', $_POST['clave'], 0, "/");
    } else {
        setcookie('recordarme','',time() - 3600,"/");
        setcookie('c_usuario', '', time() - 3600, "/");
        setcookie('c_clave', '', time() - 3600, "/");
    }

    header("Location: panel.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>
