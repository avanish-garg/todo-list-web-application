<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = mysqli_real_escape_string($conn, $_POST['task']);
    $created_at = date('Y-m-d H:i:s');
    $query = "INSERT INTO tasks (task, created_at) VALUES ('$task', '$created_at')";
    mysqli_query($conn, $query);
    header('Location: index.php');
    exit();
}

?>
