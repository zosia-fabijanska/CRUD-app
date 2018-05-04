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

        $sql = $conn->query("SELECT * FROM books where id = '$id'");
        $result = mysqli_fetch_assoc($sql);
        
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
                     <?php echo $result['title']; ?>
            </label>
         </div>
         <div>
         <label class="control-label">Author: 
                     <?php echo $result['author']; ?>
            </label>
         </div>
         <div>
         <label class="control-label">Genre: 
                     <?php echo $result['genre']; ?>
            </label>
         </div>
         <div>
         <label class="control-label">Language: 
                     <?php echo $result['lang']; ?>
            </label>
         </div>
         <div>
         <label class="control-label">Date Published: 
                     <?php echo $result['published']; ?>
            </label>
         </div>
             <div class="form-actions">
               <a class="btn" href="index.php">Back</a>
            </div>
     </div>
      
</div>



<?php include "templates/footer.php>"; ?>