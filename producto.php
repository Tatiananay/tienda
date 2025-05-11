<?php
session_start();
$idioma = isset($_GET["idioma"]) ? $_GET["idioma"] : "es"; // defecto: español

echo "<p>DEBUG: nombre recibido = " . htmlspecialchars($_GET["nombre"] ?? 'Ninguno') . " | idioma = " . $idioma . "</p>";

if (isset($_GET["nombre"])) {
    $nombre_buscado = $_GET["nombre"];
    
    $archivo = ($idioma == "en") ? "categorias_en.txt" : "categorias_es.txt";
 
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $encontrado = false;

    if ($lineas !== false) {
        foreach ($lineas as $linea) {
            $partes = explode("|", $linea);
            if (count($partes) >= 4) {
                $id = $partes[0];
                $nombre = $partes[1];
                $descripcion = $partes[2];
                $precio = $partes[3];
                $imagen = isset($partes[4]) ? $partes[4] : null;

                if ($nombre === $nombre_buscado) {
                    $encontrado = true;
                    break;
                }
            }
        }
    }
} else {
    $encontrado = false;
}

?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($idioma == "en") ? "Product Details" : "Detalles del Producto"; ?></title>
</head>
<body>
    <h1><?php echo ($idioma == "en") ? "Product Details" : "Detalles del Producto"; ?></h1>
    <?php if ($encontrado): ?>
        <p><strong><?php echo ($idioma == "en") ? "Name" : "Nombre"; ?>:</strong> <?php echo $nombre; ?></p>
        <p><strong><?php echo ($idioma == "en") ? "Description" : "Descripción"; ?>:</strong> <?php echo $descripcion; ?></p>
        <p><strong><?php echo ($idioma == "en") ? "Price" : "Precio"; ?>:</strong> $<?php echo $precio; ?></p>
        <?php if ($imagen): ?>
        <p><strong><?php echo ($idioma == "en") ? "Image" : "Imagen"; ?>:</strong></p>
        <img src="imagenes/<?php echo htmlspecialchars($imagen); ?>" alt="<?php echo htmlspecialchars($nombre); ?>" width="200">
        <?php endif; ?>
    <?php else: ?>
        <p><strong><?php echo ($idioma == "en") ? "Product not found." : "Producto no encontrado."; ?></strong></p>
    <?php endif; ?>
    <br>
    <a href="panel.php?idioma=<?php echo $idioma; ?>"><?php echo ($idioma == "en") ? "Back to panel" : "Volver al panel"; ?></a>
</body>
</html>
