<?php

    if (isset($_COOKIE['recordarme']) && $_COOKIE['recordarme'] == '1') {
        $usuario = isset($_COOKIE['c_usuario']) ? $_COOKIE['c_usuario'] : ''; 
        $clave = isset($_COOKIE['c_clave']) ? $_COOKIE['c_clave'] : ''; 
    } else {
        $usuario = '';
        $clave = '';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>LOGIN</h1>
    <form action="acceso.php" method="POST">
        <fieldset>  
        Usuario: <br>
        <input type="text" name="usuario" value="<?php echo $usuario; ?>"/>
        <br>
        Clave: <br>
        <input type="password" name="clave" value="<?php echo $clave; ?>"/>
        <br>
        <input type="checkbox" name="recordarme" value="1"/> Recordarme 
        <br>
        <br>
        <input type="submit" name="Enviar" value="Enviar"/>
    </fieldset>
    </form>
    
    
</body>
</html>