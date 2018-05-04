<?php include "templates/header.php"; ?>

<div class="container">
     <div class="row">
	     <ul>
		        <li><a href="create.php"><strong>Add to Booklist</strong></a> - add a book</li>
	        </ul>
     </div>

    <div class="row">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
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
                   
                   foreach ($conn->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['title'] . '</td>';
                            echo '<td>'. $row['author'] . '</td>';
                            echo '<td><a class="btn" href="read.php?id='.$row['id'].'">Find out more...</a></td>';
                            echo '<td><a class="btn" href="update.php?id='.$row['id'].'">Update...</a></td>';
                            echo '<td><a class="btn" href="delete.php?id='.$row['id'].'">Delete...</a></td>';
                            echo '</tr>';
                   }
                   
                  ?>
                  </tbody>
            </table>
    </div>
</div>



<?php include "templates/footer.php>"; ?>