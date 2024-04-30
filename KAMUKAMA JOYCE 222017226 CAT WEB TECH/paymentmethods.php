<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>payment Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;

      background-color: greenyellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; /* Adjust this value as needed */

      padding: 8px;
     
    }
    header{
    background-color:violet;
    padding: 20px;
}
    footer{
    text-align: center;
    padding: 15px;
    background-color:violet;
}
  </style>
    <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  
<header>
   

</head>

<body bgcolor="pink">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./Images/logo.jpg" width="90" height="60" alt="Logo">
 </li>
  <li style="display: inline; margin-right: 10px;"><a href="./HOME.html">HOME</a>
    <li style="display: inline; margin-right: 10px;"><a href="./ABOUT US.html">ABOUT US</a>
      <li style="display: inline; margin-right: 10px;"><a href="./CONTACT US.html">CONTACT US</a>
    <li style="display: inline; margin-right: 10px;"><a href="./customers.php">Customers</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./invoices.php">invoices</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./paymentmethods.php">Paymentmethods</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./products.php">Product</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./subscriptions.php">subscriptions</a>
  </li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color:darkgreen; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Change Acount</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
  </ul>

</header>
<section>
<h1>Paymentmethods Form</h1>

     <form method="post" onsubmit="return confirmInsert();">
        <label for="payment_method_id">payment_method_id:</label>
        <input type="number" id="emp_Id" name="emp_Id"><br><br>

        <label for="type">type:</label>
        <input type="text" id="dpid" name="dpid" required><br><br>

        <label for="customer_id">customer_id:</label>
        <input type="text" id="fnm" name="fnm" required><br><br>

        <label for="card_number">card_number:</label>
        <input type="text" id="lnm" name="lnm" required><br><br>

        <label for="expiration_date">expiration_date:</label>
        <input type="date" id="eml" name="eml" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    // Connection details
     include('database-connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO paymentmethods (payment_method_id, type, customer_id,card_number,expiration_date) VALUES (?,?,?,?,?)");
        $stmt->bind_param("issss", $payment_method_id, $type, $customer_id,$card_number,$expiration_date);

        // Set parameters from POST data with validation (optional)
        $payment_method_id = ($_POST['emp_Id']); // Ensure integer for ID
        $type = ($_POST['dpid']); 
        $customer_id = ($_POST['fnm']); 
        $card_number = ($_POST['lnm']); 
        $expiration_date = ($_POST['eml']); 
        // Execute prepared statement with error handling
        if ($stmt->execute()) {
            echo "New record has been added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $connection->close();
    ?>

<?php
// Connection details
include('database-connection.php');

// SQL query to fetch data from paymentmethod table
$sql = "SELECT * FROM paymentmethods";
$result = $connection->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of paymentmethods</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of paymentmethods</h2></center>
    <table border="5">
        <tr>
            <th>Payment_method_id</th>
            <th>TYPE</th>
            <th>Customer_id</th>
            <th>Card_number</th>
            <th>Expiration_date</th>
            <th>DELETE</th>
            <th>UPDATE</th>
        </tr>
        <?php
        // Define connection parameters
        include('database-connection.php');
        
        // Prepare SQL query to retrieve all paymentmethod
        $sql = "SELECT * FROM paymentmethods";
        $result = $connection->query($sql);

        // Check if there are any paymentmethods
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $emid = $row['payment_method_id']; // Fetch the paymentmethod_id
                echo "<tr>
                    <td>" . $row['payment_method_id'] . "</td>
                    <td>" . $row['type'] . "</td>
                    <td>" . $row['customer_id'] . "</td>
                    <td>" . $row['card_number'] . "</td>
                    <td>" . $row['expiration_date'] . "</td>
                    <td><a style='padding:4px' href='delete_paymentmethods.php?payment_method_id=$emid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_paymentmethods.php?payment_method_id=$emid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
  </body>
    </section>

  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 & reg, Designer by: @Kamukama joyce</h2></b>
  </center>
</footer>
</body>
</html>