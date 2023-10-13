<?php
   $DB_HOST="localhost";
   $DB_USER="root";
   $DB_PASSWORD="";
   $DB_NAME="todo";

   $db = mysqli_connect("$DB_HOST","$DB_USER","$DB_PASSWORD","$DB_NAME");

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>