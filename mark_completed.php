<?php
include('db_connect.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "UPDATE tasks SET status = 1 WHERE id = $id";
    mysqli_query($conn, $query);
    header('Location: index.php');
    exit();
}
?>
