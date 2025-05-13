<?php
session_start();
// Restricción de acceso
if(!isset($_SESSION['nombre']) && !isset($_SESSION['clave'])){
    header("Location:index.php");
}

$usuario = $_SESSION["usuario"];
$archivo = "categorias_es.txt";
$contenido = "";

$idioma = "es"; // Valor por defecto

if (isset($_GET["idioma"])) {
    $idioma = $_GET["idioma"];
    if (isset($_COOKIE["recordarme"])) {
        setcookie("idioma", $idioma, 0, "/");
    }
} elseif (isset($_COOKIE["idioma"])) {
    $idioma = $_COOKIE["idioma"]; // ← Aquí lees el idioma guardado previamente
}


    if ($idioma == "en" ) {      
        $archivo = "categorias_en.txt";
        
    } else{
        $archivo = "categorias_es.txt";        
    }
    
   $contenido ="";
     $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($lineas !== false) {
            $contenido = "<ul>";
            foreach ($lineas as $producto) {
                $partes = explode("|", $producto);
                if(count($partes) >=2){
                $nombre = htmlspecialchars($partes[1]);
                
                $contenido .= "<li><a href=\"producto.php?idioma=".$idioma."&nombre=". urlencode($nombre) . "\">" . $nombre . "</a></li>";
  
                }
            }
            $contenido .= "</ul>";
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Productos</title>
</head>
<body>
    <h3>Bienvenido <?php echo $usuario ?></h3>
    <h1>PANEL DE PRODUCTOS DISPONIBLES</h1>
    <a href="logout.php">Cerrar Sesión</a> 
    <a href="panel.php?idioma=es">ES Español</a>
    <a href="panel.php?idioma=en">EN English</a>
    <h2>Lista de Productos</h2>
    <?php echo $contenido; ?><br>
</body>
</html>