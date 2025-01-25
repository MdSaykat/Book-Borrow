<?php
// Database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'book'; // Your database name

// Create a connection
$conn = mysqli_connect('localhost', 'root', '', 'book');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(preg_match("/^[0-9]/", $_POST["isbn"])) 
  {
    
  }
  else{
    echo "provide Number"."<br>";
    $error[]="Provide Number";
  
  
  }
  $isbn=$_POST["isbn"];


    if(preg_match("/^[A-Za-z ]*$/", $_POST["book_name"])) 
  {
  }
  else{
  
    echo "Give Character only"."<br>";
    $error[]="give character ";
  }

  $book_name=$_POST["book_name"];

   
  if(preg_match("/^[A-Za-z ]*$/", $_POST["author_name"])) 
  {
  }
  else{
  
    echo "Give Character only"."<br>";
    $error[]="give character ";
  }


  $author_name=$_POST["author_name"];

  
   if(preg_match("/^[0-9]/", $_POST["price"])) 
{
  
}
else{
  echo "provide Number"."<br>";
  $error[]="Provide Number";


}
$price = $_POST['price'];

if(preg_match("/^[0-9]/", $_POST["book_copy"])) 
{
  
}
else{
  echo "provide Number"."<br>";
  $error[]="Provide Number";


}

    $book_copy = $_POST['book_copy'];

    if(empty($error)){


    // Check if the record exists
    $check_sql = "SELECT * FROM book_info WHERE isbn = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $isbn);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the record
        $update_sql = "UPDATE book_info 
                       SET book_name = ?, author_name = ?, price = ?, book_copy = ? 
                       WHERE isbn = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssdis", $book_name, $author_name, $price, $book_copy, $isbn);

        if ($update_stmt->execute()) {
            echo "<p style='text-align: center; color: green;'>Book information updated successfully!</p>";
        } else {
            echo "<p style='text-align: center; color: red;'>Error updating book: " . $update_stmt->error . "</p>";
        }

        $update_stmt->close();
    } else {
        echo "<p style='text-align: center; color: red;'>No book found with ISBN: $isbn.</p>";
    }

    $stmt->close();
}
}


// Close the connection
$conn->close();
?>