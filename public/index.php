<?php 
    session_start();
    include "templates/header.php"; 
    include 'config.php';
                   
    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
     }
     
     
    $sql = "SELECT * 
             FROM ( SELECT * 
                     FROM books 
                     ORDER BY date_created DESC ) 
             AS recentbooks 
             WHERE archive=1 
             GROUP BY groups";
    
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row['books_id'];

?>

<div class="container">
     <div class="row">
        <?php echo $_SESSION['message'] ?>
    </div>
    <div class="row">
	     <ul>
		        <li><a href="create.php"><strong>Add to Booklist</strong></a> - add a book</li>
	        </ul>
     </div>

    <div class="row">
        <div class="col-3">
            <strong>Title</strong>
            <?php 
              foreach ($conn->query($sql) as $row) {
                echo '<p style="margin-top: 10px; margin-bottom: 16px;">'. $row['title'] . '</p>';
              }
            ?>
        </div>
        <div class="col-3">
            <strong>Author</strong>
            <?php 
              foreach ($conn->query($sql) as $row) {
                echo '<p style="margin-top: 10px; margin-bottom: 16px;">'. $row['author'] . '</p>';
              }
            ?>
        </div>
        <div class="col-6">
            <strong>Action</strong>
            <br />
            <?php 
              foreach ($conn->query($sql) as $row) {
                echo '<a class="btn" style="margin-top: 2px;" href="read.php?id='.$row['books_id'].'">Find out more...</a>';
                echo '<a class="btn" style="margin-top: 2px;" href="update.php?id='.$row['books_id'].'">Update...</a>';
                echo '<button id="del_'.$row['books_id'].'" class="btn btn-danger btn-sm remove delete">Delete</button></br>';
              }
            ?>
        
        </div>
       
    </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
<script type='text/javascript'>
     
     $('.delete').click(function() {
        
        var el = this;
        var id = this.id;
        var splitid = id.split("_");

        // Delete id
        var deleteid = splitid[1];

        if (confirm("DANGER: Are you sure you want to delete this book?"))
            {
                    $.ajax({
                        url: 'delete.php',
                        type: 'POST',
                        data: { id:deleteid },
                        success: function(){
                            window.location = 'index.php'
                            
                        }
                    })    
            }
            else
            {
                    window.location = 'index.php'
            }
     });

</script>



<?php include "templates/footer.php>"; ?>