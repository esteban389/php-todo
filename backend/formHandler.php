<?php
    include __DIR__ . '/dbQueries.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $taskText = $_POST["task"];
        insertItem($taskText);
        header("Location: ../index.html");
        exit; 
    } else {
        echo "Form not submitted.";
    }
?>
