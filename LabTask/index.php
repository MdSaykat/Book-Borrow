
<?php
// Database connection details
$host = 'localhost'; // Replace with your database host
$username = 'root'; // Replace with your MySQL username
$password = ''; // Replace with your MySQL password
$dbname = 'book'; // Database name

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from book_info table
$sql = "SELECT book_name, author_name, isbn, price, book_copy FROM book_info";
$result = $conn->query($sql);
?>

<<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />

    <title>Book Borrow</title>
  </head>
  <body>
    <div class="main">
      <div class="left-box"> 
      <h3 style="text-align: center;">Used Tokens</h3>
    <table>
        <thead>
            <tr>
            </tr>
        </thead>
        <tbody>
        <?php
// Path to the useToken.json file
$useTokenFile = 'useToken.json';

// Function to add a token to useToken.json without duplicates
function saveUniqueToken($token, $useTokenFile) {
    // Check if useToken.json exists and load its content
    $usedTokens = [];
    if (file_exists($useTokenFile)) {
        $usedTokens = json_decode(file_get_contents($useTokenFile), true) ?? [];
    }

    // Check if the token is already in the list
    if (!in_array($token, $usedTokens)) {
        // Add the new token to the list
        $usedTokens[] = $token;

        // Save the updated list back to useToken.json
        file_put_contents($useTokenFile, json_encode($usedTokens, JSON_PRETTY_PRINT));
        echo "<p style='color:green;'>Token {$token} saved successfully!</p>";
    } else {
        echo "<p style='color:orange;'>Token {$token} is already in useToken.json.</p>";
    }
}
if (file_exists($useTokenFile)) {
  $usedTokens = json_decode(file_get_contents($useTokenFile), true);

  // Ensure only unique tokens are shown
  $uniqueTokens = array_unique($usedTokens);

  if (!empty($uniqueTokens)) {
      foreach ($uniqueTokens as $token) {
          echo "<tr><td>" . htmlspecialchars($token) . "</td></tr>";
      }
  } else {
      echo "<tr><td>No tokens have been used yet.</td></tr>";
  }
} else {
  echo "<tr><td>useToken.json file not found.</td></tr>";
}
?>
        </tbody>
    </table>
      </div>

      <div div="main-section">
        <div class="top">
          <div class="box1"><h1 style="text-align: center;">Update Book Information</h1>
    <form method="POST" action="update.php">
        <div>
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" placeholder="Enter ISBN" required>
        </div>
        <div>
            <label for="book_name">Book Name:</label>
            <input type="text" id="book_name" name="book_name" required>
        </div>
        <div>
            <label for="author_name">Author Name:</label>
            <input type="text" id="author_name" name="author_name" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" required>
        </div>
        <div>
            <label for="book_copy">Number of Copy:</label>
            <input type="number" id="book_copy" name="book_copy" required>
        </div>
        <button type="submit">Update</button>
    </form>
  </div>
          <div class="box1"><h1>Books Information</h1>
    <table>
        <thead>
            <tr>
                <th>Book Name</th>
                <th>Author Name</th>
                <th>ISBN</th>
                <th>Price</th>
                <th>Number Of Copy</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are rows in the result
            if ($result->num_rows > 0) {
                // Loop through each row and display it in a table row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['book_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['author_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['isbn']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['book_copy']) . "</td>";
                    echo "</tr>";
                }
            } else {
                // If no data, show a message
                echo "<tr><td colspan='5'>No books found in the database.</td></tr>";
            }

            // Close the connection
            $conn->close();
            ?>
        </tbody>
    </table>
          </div>
          <div class="box1">
            <form action="database.php" method="POST">
            <h1>Insert Book Information</h1>
            <label for="book_name">Book Name:</label>
            <input type="text"  name="book_name" placeholder="Data"><br>

            <label for="author_name">Author_Name:</label>
            <input type="text"  name="author_name" placeholder="Data"><br>

            <label for="ISBN">ISBN</label>
            <input type="number" name ="isbn" placeholder="Data"><br>

            <lable for="Price">Price</label>
            <input type="text" name="price" placeholder="Data"><br>

            <label for="book_copy">Number of Copy:</label>
            <input type="text"  name="book_copy" placeholder="Data"><br>
            
            <input type="submit" value="Submit" name="submit">

</form>

          </div>
        </div>
          <div class="middle">
          <div class="box2">
          <img src="Book1.JPG"  width="270" height="250">

          </div>
          <div class="box2"><img src="Book2.JPG"  width="260" height="280"></div>
          <div class="box2"><img src="Book3.JPG"  width="260" height="280"></div>
        </div>
        
        <div class="lower">
          <div class="box3">
          <form action="process.php" method="post">
    <label for="student_name"><h3 style="text-align: center;">Student Full Name:</h3></label>
   <input type="text" style="width: 400px; padding: 7px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" name="student_name" placeholder="Data"><br>

    <label for="student_id"><h3 style="text-align: center;">Student ID:</h3></label>
    <input type="text"style="width: 400px; padding: 7px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" name="student_id" placeholder="Data"><br>

    <label for="Email"><h3 style="text-align: center;">Email:</h3></label>
    <input type="text" style="width: 400px; padding: 7px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" name="email" placeholder="Data"><br>


    <label for="book_title"><h3 style="text-align: center;">Book Title:</h3></label>
    <select id="book_title" style="width: 400px; padding: 7px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" name="book_title">
      <option value="select">select</option>
      <option value="Python for Data Science">Python for Data Science</option>
      <option value="Introduction to Algorithm ">Introduction to Algorithm</option>
      <option value="Introduction to Data Science ">Introduction to Data Science</option>
      <option value="Artificial Intelligence:A Modern Approach">Artificial Intelligence:A Modern Approach</option>
      <option value="The Mythical Man-Month"> The Mythical Man-Month</option>
      <option value="Code Complete">Code Complete</option>
      <option value="Introduction to the theory of Computation "> Introduction to the theory of Computation</option>
      <option value="Coders of work">Coders of Work</option>
      <option value="Clean COde">Clean Code</option>


    </select>
    <label for="borrow_date"><h3 style="text-align: center;">Borrow Date:</h3></label>
    <input type="date" style="width: 400px; padding: 7px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" name="borrow_date" placeholder="Data"><br>

    <label for="token"><h3 style="text-align: center;">Token:</h3></label>
    <input type="text" style="width: 400px; padding: 7px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" name="token" placeholder="Data">

    <label for="return_date"><h3 style="text-align: center;">Return Date:</h3></label>
    <input type="date"  style="width: 400px; padding: 7px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;"name="return_date" placeholder="Data">

    <label for="fees"><h3 style="text-align: center;">Fees:</h3></label>
    <input type="text" style="width: 400px; padding: 7px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" name="fees" placeholder="Data">

    <input type="submit"style=" width: 150px; padding: 8px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" value="Submit">
</form>
          </div>
          <div class="box4">
        <h3 align ="center">TOKEN</h3>
    
        <table>
    <?php
    // Read the JSON file
    $jsonFile = 'token.json';
    if (file_exists($jsonFile)) {
        $data = json_decode(file_get_contents($jsonFile), true);

        if (isset($data['tokens']) && is_array($data['tokens'])) {
            foreach ($data['tokens'] as $token) {
                echo "<tr><td>{$token}</td></tr>";
            }
        } else {
            echo "<tr><td>No tokens found</td></tr>";
        }
    } else {
        echo "<tr><td>JSON file not found</td></tr>";
    }
    ?>
</table>

        </div>
          
      </div>
      </div>
     <div class="right-box">
      <img src="ID.JPG"  width="150" height="100">

     </div>

    </div>
  </body>
</html>
