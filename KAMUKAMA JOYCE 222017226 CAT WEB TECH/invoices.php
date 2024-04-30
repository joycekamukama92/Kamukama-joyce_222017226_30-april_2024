<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Invoices Page</title>
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

<body bgcolor="violette">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
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
    <li style="display: inline; margin-right: 10px;"><a href="./paymentmethods.php">paymentmethods</a>
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
<h1>invoices Form</h1>

     <form method="post" onsubmit="return confirmInsert();">
        <label for="invoice_id">invoice_id:</label>
        <input type="number" id="invid" name="invid"><br><br>

        <label for="customer_id">customer_id:</label>
        <input type="number" id="cstid" name="cstid" required><br><br>

        <label for="payment_method_id">payment_method_id:</label>
        <input type="text" id="pym" name="pym" required><br><br>
        
        <label for="issue_date">issue_date:</label>
        <input type="date" id="issd" name="issd" required><br><br>
        
        <label for="total_amount">total_amount:</label>
        <input type="text" id="ttm" name="ttm" required><br><br>
        
        <label for="currency">currency:</label>
        <input type="number" id="frw" name="frw" required><br><br>

        <label for="payment_status">payment_status:</label>
        <input type="text" id="pys" name="pys" required><br><br>
        
        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    // Connection details
    include('database-connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO invoices (invoice_id, customer_id, payment_method_id,issue_date,total_amount,currency,payment_status) VALUES ( ?,?,?,?,?, ?, ?)");
        $stmt->bind_param("issssss", $invoice_id, $customer_id, $payment_method_id,$issue_date,$total_amount,$currency, $payment_status);

        // Set parameters from POST data with validation (optional)
        $invoice_id = ($_POST['invid']); // Ensure integer for ID
        $customer_id = ($_POST['cstid']); 
        $payment_method_id = ($_POST['pym']); 
        $issue_date = ($_POST['issd']); // Ensure integer for ID
        $total_amount = ($_POST['ttm']); 
        $currency = ($_POST['frw']);
        $payment_status = ($_POST['pys']); 
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

// SQL query to fetch data from invoices table
$sql = "SELECT * FROM invoices";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of invoices</title>
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
    <center><h2>Table of invoices</h2></center>
    <table border="5">
        <tr>
            <th>invoice_id</th>
            <th>customer_id</th>
            <th>payment_method_id</th>
            <th>issue_date</th>
            <th>total_amount</th>
            <th>currency</th>
            <th>payment_status</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
        include('database-connection.php');
        
         // Prepare SQL query to retrieve all invoices
        $sql = "SELECT * FROM invoices";
        $result = $connection->query($sql);

        // Check if there are any invoice
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $invid = $row['invoice_id']; // Fetch the invoice_id
                echo "<tr>
                    <td>" . $row['invoice_id'] . "</td>
                    <td>" . $row['customer_id'] . "</td>
                    <td>" . $row['payment_method_id'] . "</td>
                    <td>" . $row['issue_date'] . "</td>
                    <td>" . $row['total_amount'] . "</td>
                    <td>" . $row['currency'] . "</td>
                    <td>" . $row['payment_status'] . "</td>
                    <td><a style='padding:4px' href='delete_invoices.php?invoice_id=$invid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_invoices.php?invoice_id=$invid'>Update</a></td> 
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