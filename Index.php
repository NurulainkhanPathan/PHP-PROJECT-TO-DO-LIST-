<?php

$conn = new mysqli("127.0.0.1:3307","root","","todolist");
if ($conn->connect_error) {
    die("Not Connect To Database " . $conn->connect_error);
}
// else{
//     echo "Connect To Database";
// }

if(isset($_POST["addtask"])){
    $task = $_POST["task"];
    $conn->query("INSERT INTO tasks (task) VALUES ('$task')");
    header("Location: Index.php");
}

$result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");

if(isset($_GET["delete"])){
    $id = $_GET["delete"];
    $conn->query("DELETE FROM tasks WHERE Id='$id'");
    header("Location: Index.php");
}

if(isset($_GET["complete"])){
    $id = $_GET["complete"];
    $conn->query("UPDATE tasks SET status='completed' WHERE Id = '$id'");
    header("Location: Index.php");
}


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
   
   <div class="Container">
    <form action="Index.php" method="post">
 <h1>To-Do List</h1>


    <input type="text" name="task" placeholder="Enter New Tasks">
    <button  type="submit" name="addtask">Add Task</button>
</form>
<ul>
<?php while($row = $result->fetch_assoc()): ?>
<li class="<?php echo $row["status"]; ?>"> 
    <strong><?php echo $row["task"]; ?></strong>
    <div class="actions">
    <a href="Index.php?complete=<?php echo $row['id']; ?>">Complete</a>
    <a href="Index.php?delete=<?php echo $row['id']; ?>">Delete</a>

    </div>        
</li>

<?php endwhile ?> 
</ul>
</div>


</body>
</html>