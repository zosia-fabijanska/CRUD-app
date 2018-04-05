<?php 
// When the submit button is clicked
if (isset($_POST['submit'])) {

    //try the following
   try {
     
    //require stored mySQL info
    require "config.php";


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

    //Insert input values into database columns
    $sql = "INSERT INTO books (title, author, genre, lang, published)
    VALUES ('$title', '$author', '$genre', '$lang', '$published')";

    //Print result of query at the top of screen
    if ($conn->query($sql) === TRUE) {
        ?>
        <h3><?php echo $_POST['title']; ?> successfully added.</h3>
        <?php
    } else {
        ?>
    <h3><?php echo "Error: " . $sql . "<br>" . $conn->error; ?></h3>
        <?php 
    }

    $conn->close();

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



<h1>Add a book</h1>

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
    <input type="submit" name="submit" value="Add Book">
</form>

<a href="index.php">Return to Wishlist</a>
<?php include "templates/footer.php>"; ?>