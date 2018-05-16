<?php 
    session_start();
    require "config.php";

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    // When the submit button is clicked
    if (isset($_POST['submit'])) {

        //try the following
        try {
            //fields are all required
            $required = array('title', 'author', 'genre', 'lang', 'published', 'bruns', 'melb', 'hawth');

            //loop over each field in the array to check if empty
            $error = false;
            foreach($required as $field) {
                if (empty($_POST[$field])) {
                    $error = true;
                }
            }
       
            if ($error) {
                echo "You need to fill out all the required fields to enter a book";
            }
            else {
       
                // Create connection
                $conn = new mysqli($host, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
       
                //Store form inputs
                $title = $_POST['title'];
                $author = $_POST['author'];
                $genre = $_POST['genre'];
                $lang = $_POST['lang'];
                $published = $_POST['published'];
                $brunswick = $_POST['bruns'];
                $melbourne = $_POST['melb'];
                $hawthorn = $_POST['hawth'];


                $sql = "START TRANSACTION;"; 
                $sql .= "INSERT INTO books (title, author, genre, lang, published, archive, groups) VALUES ('$title', '$author', '$genre', '$lang', '$published', 1, (conv(floor(rand() * 9999999), 20, 36)));";
                $sql .= "INSERT INTO book_shops (books_id, shops_id, quantity) VALUES (LAST_INSERT_ID(), '1', '$brunswick'), (LAST_INSERT_ID(), '2', '$melbourne'), (LAST_INSERT_ID(), '3', '$hawthorn');";
                $sql .="COMMIT;";

                
       
                //Print result of query at the top of screen
                if (mysqli_multi_query($conn,$sql)) {
                    $_SESSION['message'] = $_POST['title'] . " successfully added!";
                    header("Location: index.php");
                      
                } else {
                    ?>
                        <h3>
                            <?php echo "Error: " . $sql . "<br>" . $conn->error; ?>
                        </h3>
                    <?php 
                }
       
                $conn->close();
       
            }
       }
        catch(PDOException $error) 
	    {
		    echo $sql . "<br>" . $error->getMessage();
	    }
    }
?>

<?php 
include "templates/header.php"; 
?>


<div class="container">
    <h3>Add Book</h3>
    <form method="POST">
        <label for="title">Book Title</label>
        <input type="text" name="title" id="title">
        <label for="author">Author</label>
        <input type="text" name="author" id="author">
        <label for="genre">Genre</label>
        <input type="text" name="genre" id="genre">
        <label for="lang">Langauge</label>
        <input type="text" name="lang" id="lang">
        <label for="published">Published</label>
        <input type="text" name="published" id="published">
        <label for="bruns">Brunswick Store Quantity</label>
        <input type="text" name="bruns" id="bruns">
        <label for="melb">Melbourne CBD Store Quantity</label>
        <input type="text" name="melb" id="melb">
        <label for="hawth">Hawthorn Store Quantity</label>
        <input type="text" name="hawth" id="hawth">
        <br/>
        <input type="submit" class="submit" name="submit" value="+ Add Book">
        <!-- Store Location and Quantity
                if Store location is not selected then Quantity defaults as 0-->
    </form>
    
    <a href="index.php">Return to book list</a>
</div>


<?php include "templates/footer.php>"; ?>