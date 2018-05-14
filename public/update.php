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

        $sql = "SELECT * FROM books WHERE books_id = '$id'";

        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
    }

if (isset($_POST['submit'])) {
    try {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $genre = $_POST['genre'];
            $lang = $_POST['lang'];
            $published = $_POST['published'];

            //Fetch the value for groups unique identifier
            $identifier = $conn->query("SELECT groups FROM books WHERE books_id = '$id'");
            $array = mysqli_fetch_assoc($identifier);
            $key = $array['groups'];

            $sql = "INSERT INTO books (title, author, genre, lang, published, archive, groups)
            VALUES ('$title', '$author', '$genre', '$lang', '$published', 1, '$key')";

            $result = $conn->query($sql);
            
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
            value="<?php echo $row['title'] ?>">
        <label for="author">Author</label>
        <input type="text" name="author" id="author" 
            value="<?php echo $row['author']?>">
        <label for="genre">Genre</label>
        <input type="text" name="genre" id="genre" 
            value="<?php echo $row['genre'] ?>">
        <label for="lang">Langauge</label>
        <input type="text" name="lang" id="lang" 
            value="<?php echo $row['lang'] ?>">
        <label for="published">Published</label>
        <input type="text" name="published" id="published" 
            value="<?php echo $row['published'] ?>">
        <input type="submit" name="submit" value="Update Book">
        <!-- Update Store and Quantity numbers -->
    </form>
    <a href="index.php">Return to book list</a>
</div>


<?php include "templates/footer.php>"; ?>