
<?php
include 'Konek.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM items WHERE id=$id";
    $conn->query($sql);
    header("Location: Sammyboy.php");
}
?>
