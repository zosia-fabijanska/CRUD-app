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

        $sql = $conn->query("SELECT books.*, shops.*, book_shops.quantity 
                                FROM books, shops, book_shops 
                                WHERE books.books_id = book_shops.books_id 
                                AND shops.shops_id = book_shops.shops_id 
                                AND books.books_id = '$id'");
        $result = mysqli_fetch_all($sql, MYSQLI_ASSOC);
       
    }

?>

<?php include "templates/header.php"; ?>


 <div class="container">
         <div class="row">
             <div class="col-4">
                    <h3>Book Information</h3>
              <div>
                  <label class="control-label"><span>Title: </span>
                          <?php echo $result[0]['title']; ?>
                 </label>
              </div>
              <div>
              <label class="control-label"><span>Author: </span>
                          <?php echo $result[0]['author']; ?>
                 </label>
              </div>
              <div>
              <label class="control-label"><span>Genre: </span>
                          <?php echo $result[0]['genre']; ?>
                 </label>
              </div>
              <div>
              <label class="control-label"><span>Language: </span>
                          <?php echo $result[0]['lang']; ?>
                 </label>
              </div>
              <div>
              <label class="control-label"><span>Date Published: </span>
                          <?php echo $result[0]['published']; ?>
                 </label>
              </div>
          </div>
          <div class="col-6">
              <h3>Stock Information</h3>
                <div>
                    <?php 
                    echo '<p><span>Shop: </span>'.$result[0]['shop_location'].'</p>';
                    echo '<p><span>Quantity: </span>'.$result[0]['quantity'].'</p>';
                    echo '<p><span>Email: </span>'.$result[0]['email'].'</p>';
                    echo '<p><span>Phone: </span>'.$result[0]['phone'].'</p>';
                    echo '<p><span>Manager: </span>'.$result[0]['shop_owner'].'</p><br/>';
                    ?>
                </div>
                <div>
                    <?php 
                    echo '<p><span>Shop: </span>'.$result[1]['shop_location'].'</p>';
                    echo '<p><span>Quantity: </span>'.$result[1]['quantity'].'</p>';
                    echo '<p><span>Email: </span>'.$result[1]['email'].'</p>';
                    echo '<p><span>Phone: </span>'.$result[1]['phone'].'</p>';
                    echo '<p><span>Manager: </span>'.$result[1]['shop_owner'].'</p><br/>';
                    ?>
                </div>
                <div>
                    <?php 
                    echo '<p><span>Shop: </span>'.$result[2]['shop_location'].'</p>';
                    echo '<p><span>Quantity: </span>'.$result[2]['quantity'].'</p>';
                    echo '<p><span>Email: </span>'.$result[2]['email'].'</p>';
                    echo '<p><span>Phone: </span>'.$result[2]['phone'].'</p>';
                    echo '<p><span>Manager: </span>'.$result[2]['shop_owner'].'</p><br/>';
                    ?>
                </div>
          </div>
        </div>
         <div class="form-actions">
            <a class="btn" href="index.php">Return to book list</a>
        </div> 
</div>



<?php include "templates/footer.php>"; ?>