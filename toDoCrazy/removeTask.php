<?php
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];

   foreach ($_SESSION['tasks'] as $key => $task) {
        if ($task['id'] === $id) {
            unset($_SESSION['tasks'][$key]);
            break; 
        }
    }

     $_SESSION['tasks'] = array_values($_SESSION['tasks']);
}

header("Location: insertTask.php");

?>