<?php 

    require 'config.php';

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $conn = new mysqli($host, $username, $password, $dbname);

        $sql = "SELECT * FROM books WHERE id = '$id'";

        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
    }

    if (isset($_POST['submit'])) {
        try {
                $sql = "UPDATE books SET archive = 0 WHERE id='$id'";
    
                $result = $conn->query($sql);

                echo($row['title'].' has been deleted');
            }
        
        catch(PDOException $error) 
        {
            echo $sql . "<br>" . $error->getMessage();
        }
    } 


?>


<h1>Are you sure you want to delete the following book from the database?</h1>

<p><?php echo $row['title'] ?></p>
<p>By: <?php echo $row['author'] ?></p>
<p>Catgeory: <?php echo $row['genre'] ?></p>

<form method="POST">
    <input type="submit" name="submit" value="Yes">
</form>

<br/>
<a href="index.php">Return to book list</a>

<?php include "templates/footer.php>"; ?>