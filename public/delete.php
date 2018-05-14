<?php 

    require 'config.php';
    $conn = new mysqli($host, $username, $password, $dbname);

     $id = $_POST['id'];
     //Fetch the value for groups unique identifier
     $identifier = $conn->query("SELECT groups FROM books WHERE books_id = '$id'");
     $array = mysqli_fetch_assoc($identifier);
     $key = $array['groups'];


    $sql = "UPDATE books SET archive = 0 WHERE groups='$key'";

    $result = $conn->query($sql);
?>
