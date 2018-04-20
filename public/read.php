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

        $sql = "SELECT * FROM books where id = '$id'";
    }

?>

<?php include "templates/header.php"; ?>

<h1>Find your favourite book by title:</h1>

 <div class="container">
         <div class="row">
             <h3>Book Information</h3>
         </div>
          
         <div>
             <label class="control-label">Title: 
                     <?php   
                        foreach ($conn->query($sql) as $row) {
                            echo $row['title'];
                        }
                    ?>
            </label>
         </div>
         <div>
             <label class="control-label">Author: 
                     <?php   
                        foreach ($conn->query($sql) as $row) {
                            echo $row['author'];
                        }
                    ?>
            </label>
         </div>
         <div>
             <label class="control-label">Genre: 
                     <?php   
                        foreach ($conn->query($sql) as $row) {
                            echo $row['genre'];
                        }
                    ?>
            </label>
         </div>
         <div>
             <label class="control-label">Langauge: 
                     <?php   
                        foreach ($conn->query($sql) as $row) {
                            echo $row['lang'];
                        }
                    ?>
            </label>
         </div>
         <div>
             <label class="control-label">Published in: 
                     <?php   
                        foreach ($conn->query($sql) as $row) {
                            echo $row['published'];
                        }
                    ?>
            </label>
         </div>
             <div class="form-actions">
               <a class="btn" href="index.php">Back</a>
            </div>
     </div>
      
</div>



<?php include "templates/footer.php>"; ?>