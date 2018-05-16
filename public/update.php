<?php 
session_start();
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

if (isset($_POST['submit'])) {
    try { 

            $title = $_POST['title'];
            $author = $_POST['author'];
            $genre = $_POST['genre'];
            $lang = $_POST['lang'];
            $published = $_POST['published'];
            $brunswick = $_POST['bruns'];
            $melbourne = $_POST['melb'];
            $hawthorn = $_POST['hawth'];

            //Fetch the value for groups unique identifier
            $identifier = $conn->query("SELECT groups FROM books WHERE books_id = '$id'");
            $array = mysqli_fetch_assoc($identifier);
            $key = $array['groups'];

            $sql = "START TRANSACTION;"; 
            $sql .= "INSERT INTO books (title, author, genre, lang, published, archive, groups)
                VALUES ('$title', '$author', '$genre', '$lang', '$published', 1, '$key');";
            $sql .= "INSERT INTO book_shops (books_id, shops_id, quantity) 
                VALUES (LAST_INSERT_ID(), '1', '$brunswick'), (LAST_INSERT_ID(), '2', '$melbourne'), (LAST_INSERT_ID(), '3', '$hawthorn');";
            $sql .="COMMIT;";



            mysqli_multi_query($conn,$sql);

                $_SESSION['message'] = $_POST['title'] . " successfully updated!";
                header("Location: index.php");
            
         
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

    <h1>Update a book</h1>
    
    <form method="POST">
        <label for="title">Book Title</label>
        <input type="text" name="title" id="title" 
            value="<?php echo $result[0]['title'] ?>">
        <label for="author">Author</label>
        <input type="text" name="author" id="author" 
            value="<?php echo $result[0]['author']?>">
        <label for="genre">Genre</label>
        <input type="text" name="genre" id="genre" 
            value="<?php echo $result[0]['genre'] ?>">
        <label for="lang">Langauge</label>
        <input type="text" name="lang" id="lang" 
            value="<?php echo $result[0]['lang'] ?>">
        <label for="published">Published</label>
        <input type="text" name="published" id="published" 
            value="<?php echo $result[0]['published'] ?>">
        <label for="bruns">Brunswick Store Quantity</label>
        <input type="text" name="bruns" id="bruns" 
            value="<?php echo $result[0]['quantity'] ?>">
        <label for="melb">Melbourne Store Quantity</label>
        <input type="text" name="melb" id="melb" 
            value="<?php echo $result[1]['quantity'] ?>">
        <label for="hawth">Hawthorn Store Quantity</label>
        <input type="text" name="hawth" id="hawth" 
            value="<?php echo $result[2]['quantity'] ?>">
        <input type="submit" name="submit" value="Update Book">
        <!-- Update Store and Quantity numbers -->
    </form>
    <a href="index.php">Return to book list</a>
</div>


<?php include "templates/footer.php>"; ?>