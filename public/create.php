<?php include "templates/header.php"; ?>
<h1>Add a book</h1>

<form>
    <label for="title">Book Title</label>
	<input type="text" name="title" id="title">
    <label for="author">Author</label>
	<input type="text" name="author" id="author">
    <label for="genre">Genre</label>
	<input type="text" name="genre" id="genre">
    <label for="language">Langauge</label>
	<input type="text" name="langauge" id="language">
    <label for="published">Published</label>
	<input type="text" name="published" id="published">
    <input type="submit" name="submit" value="Add Book">
</form>

<a href="index.php">Return to Wishlist</a>
<?php include "templates/footer.php>"; ?>