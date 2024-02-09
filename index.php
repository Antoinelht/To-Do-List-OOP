<?php
// Function to autoload classes
function chargeClass($class) {
    // Require the class file
    require $class . '.class.php';
}

// Register the autoloader
spl_autoload_register('chargeClass'); 

// Create a new instance of DataBase
$dataBase = new DataBase();
   
// Create a new instance of TaskManager
$taskManager = new TaskManager();

// If the add button is clicked
if(isset($_POST["add"])){
    // Add the task to the task manager
    $taskManager->addTask($_POST["task"]);
}

// Get all tasks from the task manager
$tasks = $taskManager->getAllTasks();

// If a task is to be deleted
if(isset($_GET['del_task'])) {
    $id = $_GET['del_task'];

    // Delete the task
    $taskManager->delTask($id);

    // Redirect to index.php
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<title>My To Do List</title>
    <!-- Meta tags and stylesheet link -->
</head>
<body>
  <style>
   body {
    font-family: Arial, sans-serif;
    background: linear-gradient(#e66465, #9198e5);
   

   }
  </style>
        <div class="container">
            <!-- Title and logo -->
            <div class="row mt-3">
                <div class="col offset-4">
                <h2>MY TO DO LIST</h2>
            </div>
        </div>
            <br>

            <!-- Form to add a new task -->
            <div class="row mt-3 col offset-4">
                <form action="index.php" method="post">
                    <input class="btn btn-dark" type="text" name="task" id="inputText" class="inputText" placeholder="Enter your text" required>
                    <button type="submit" class="btn btn-primary" id="submit" name="add">ADD</button>
                </form>
            </div>

            <!-- Table to display tasks -->
            <div class="row">
            <div class="row mt-3 col">
                <h3>Tasks :</h3>
            <table class="table table-bordered table-striped table-hover">
                
                    <?php 
                    $i = 0;
                    // Loop through each task
                    foreach($tasks as $name) {
                        $i++;
                    ?>

                <tbody id="task-container">
                    <tr>
                        <!-- Display task number -->
                        <td class="text-center"><?php echo $i ?></td>
                        <!-- Display task name -->
                        <td class="text-center"><?php echo $name["name"] ?></td>
                        <!-- Link to delete task -->
                        <td class="text-center"><input type="checkbox"></td>
                        <td class="text-center">
                            <a href="index.php?del_task=<?php echo $name['id']; ?>">❌</a>
                        </td>
                        <?php } ?>
                    </tr> 
                </tbody>
            </table>
            </div>
        </div>
    </div>
</body>
</html>