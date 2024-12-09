<?php
include('db_connect.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM tasks WHERE id = $id";
    mysqli_query($conn, $query);
    header('Location: index.php');
    exit();
}
?>

