
<?php
include 'Konek.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $sql = "INSERT INTO items (name, description) VALUES ('$name', '$description')";
    $conn->query($sql);
    header("Location: Sammyboy.php");
}
?>