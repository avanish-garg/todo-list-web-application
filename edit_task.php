<?php
include('db_connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch task details from the database
    $query = "SELECT * FROM tasks WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $task = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = mysqli_real_escape_string($conn, $_POST['task']);

    // Update task in the database
    $update_query = "UPDATE tasks SET task = '$task' WHERE id = $id";
    mysqli_query($conn, $update_query);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>
    <form method="POST" action="edit_task.php?id=<?php echo $task['id']; ?>">
        <input type="text" name="task" value="<?php echo htmlspecialchars($task['task']); ?>" required>
        <button type="submit">Update Task</button>
    </form>
    <a href="index.php">Go Back</a>
</body>
</html>
