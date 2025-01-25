<?php
//create database
if (isset($_POST["submit"])) {
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
  
  if(preg_match("/^[0-9]/", $_POST["isbn"])) 
  {
    
  }
  else{
    echo "provide Number"."<br>";
    $error[]="Provide Number";
  
  
  }
  $isbn=$_POST["isbn"];

  if(preg_match("/^[0-9]/", $_POST["price"])) 
{
  
}
else{
  echo "provide Number"."<br>";
  $error[]="Provide Number";


}
  $price=$_POST["price"];
  if(preg_match("/^[0-9]/", $_POST["book_copy"])) 
{
  
}
else{
  echo "provide Number"."<br>";
  $error[]="Provide Number";


}
  $book_copy=$_POST["book_copy"];
  if(empty($error)){


                  $conn = mysqli_connect('localhost', 'root', '', 'book');
                  $sql = "INSERT INTO book_info(book_name,author_name,isbn,price,book_copy) VALUES('$book_name','$author_name','$isbn','$price','$book_copy')";
                  if (mysqli_query($conn, $sql)) {  
                    echo"Book information inserted successfully";
                  }
                  else{
                    die("failed");
                  }   }
                }



                

?>