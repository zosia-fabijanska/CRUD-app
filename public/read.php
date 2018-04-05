<?php 

$output = NULL;

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

        $search = $conn->real_escape_string($_POST['title']);

        $results = $conn->query("SELECT * FROM books WHERE title LIKE '%$search%'");

        //If there are rows of results greater than 0
        if ($results->num_rows > 0) {

            //Turn Results into an Array
            while ($rows = $results->fetch_assoc()) 
            {
                $title = $rows['title'];
                $author = $rows['author'];

                $output .= "Title: $title <br/> Author: $author <br/><br/>";
            }
        } else {
            $output =  "No Results found, try searching for another title.";
        }
    }

    catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}

?>

<?php include "templates/header.php"; ?>

<h1>Find your favourite book by title:</h1>

<form method="POST">
	<label for="title">Title</label>
	<input type="text" id="title" name="title">
	<input type="submit" name="submit" value="View Results">
</form>

<?php echo $output ?>

<a href="index.php">Back to home</a><br/>


<?php include "templates/footer.php>"; ?>