<?php
$host = "127.0.0.1";
$username = "root";
$password = "informatica_1";
$database = "new_schema";
// $port = null;
// $socket = null;

// Create connection
$conn = new mysqli($host, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

<form action="" method="get">
    <input type="text" name="nombre" placeholder="nombre">
    <input type="text" name="apellido" placeholder="apellido">
    <button type="submit">Enviar</button>
</form>

<?php
    if (isset($_GET['nombre']) && isset($_GET["apellido"])) {

        $nombre=$_GET['nombre'];
        $apellido=$_GET["apellido"];
        
        $result = $conn->query("INSERT INTO new_table(Nombre,Apellido) 
                                VALUES ('$nombre','$apellido')");

    }
?>