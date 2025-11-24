<?php
include '../conexion.php'; // o 'conexion.php' dependiendo de tu estructura real
?>
<?php

    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $baseDeDatos = "farmaciamia";

    $enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <form action="#" name="farmaciamia" method="post">
        <input type="text" name="nombre" placeholder="nombre">
        <input type="text" name="descripcion" placeholder="descripcion">
        <input type="text" name="precio" placeholder="precio">
        <input type="text" name="stock" placeholder="stock">
        <input type="text" name="estante" placeholder="estante">

        <input type="submit" name="registro">
        <input type="reset" >
    </form>
</body>
</html>


<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $estante = $_POST["estante"];

    $sql = "INSERT INTO Medicamentos (nombre, descripcion, precio, stock, estante)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $stock, $estante);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Medicamento agregado exitosamente.</p>";
    } else {
        echo "<p style='color: red;'>Error al agregar medicamento: " . $conn->error . "</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Medicamento</title>
</head>
<body>
    <h2>Formulario para agregar medicamento</h2>
    <form method="post" action="">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion"></textarea><br><br>

        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio" required><br><br>

        <label>Stock:</label><br>
        <input type="number" name="stock" required><br><br>

        <label>Estante:</label><br>
        <input type="number" step="0.1" name="estante"><br><br>

        <input type="submit" value="Agregar Medicamento">
    </form>
</body>
</html>