<?php
include('db_connect.php');

// Fetch tasks with search functionality
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$query = "SELECT * FROM tasks WHERE task LIKE '%$search%' ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>My To-Do List</h1>

        <!-- Search form -->
        <form method="GET" action="index.php" class="search-form">
            <input type="text" name="search" placeholder="Search tasks..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Form to add a new task -->
        <form action="add_task.php" method="POST" class="task-form">
            <input type="text" name="task" placeholder="Enter a new task" required>
            <button type="submit">Add Task</button>
        </form>

        <!-- Task list -->
        <ul class="task-list">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <li class="<?php echo $row['status'] == 1 ? 'completed' : ''; ?>">
                    <?php echo htmlspecialchars($row['task']); ?>

                    <!-- Display Task Date (using created_at timestamp) -->
                    <span class="task-date"><?php echo date('Y-m-d H:i:s', strtotime($row['created_at'])); ?></span>

                    <a href="delete_task.php?id=<?php echo $row['id']; ?>" class="delete">Delete</a>
                    <a href="edit_task.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a>

                    <?php if ($row['status'] == 0) { ?>
                        <a href="mark_completed.php?id=<?php echo $row['id']; ?>" class="mark-completed">Mark as Completed</a>
                    <?php } ?>
                </li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>
