<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Customer Page</title>
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

<body bgcolor="greenyellow">
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
<h1>customers Form</h1>

     <form method="post" onsubmit="return confirmInsert();">
        <label for="customer_id">Customer_Id:</label>
        <input type="number" id="Cus_Id" name="Cus_Id"><br><br>

        <label for="first_name">First_Name:</label>
        <input type="text" id="Ft_Nm" name="Ft_Nm" required><br><br>

        <label for="last_name">Last_Name:</label>
        <input type="text" id="Lst_Nm" name="Lst_Nm" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="eml" name="eml" required><br><br>
        
        <label for="phone_number">phone_number:</label>
        <input type="number" id="phn" name="phn" required><br><br>

        <label for="country">Country:</label>
        <input type="text" id="cnty" name="cnty" required><br><br>

        <label for="gender">Gender:</label>
        <select id="Gendr" name="Gendr">
                <option>male</option>
                <option>female</option>
        </select>
            <br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
   include('database-connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO customers (customer_id,first_name, last_name, email, phone_number, country,gender) VALUES (? ,?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $customer_id, $first_name, $last_name, $email, $phone_number, $country,$gender);

        // Set parameters from POST data with validation (optional)
        $customer_id = intval($_POST['Cus_Id']); // Ensure integer for ID
        $first_name = htmlspecialchars($_POST['Ft_Nm']); // Prevent XSS
        $last_name = htmlspecialchars($_POST['Lst_Nm']); // Prevent XSS
        $email = filter_var($_POST['eml'], FILTER_SANITIZE_EMAIL); // Validate email
        $phone_number = filter_var($_POST['phn'], FILTER_SANITIZE_NUMBER_INT); // Sanitize phone number
        $country = htmlspecialchars($_POST['cnty']); 
        $gender = htmlspecialchars($_POST['Gendr']);
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
include('database-connection.php');

// SQL query to fetch data from customer table
$sql = "SELECT * FROM customers";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of customers</title>
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
    <center><h2>Table of customers</h2></center>
    <table border="5">
        <tr>
            <th>customer_id</th>
            <th>first_name</th>
            <th>last_name</th>
            <th>email</th>
            <th>phone_number</th>
            <th>country</th>
            <th>gender</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
     include('database-connection.php');

        // Prepare SQL query to retrieve customer.
        $sql = "SELECT * FROM customers";
        $result = $connection->query($sql);

        // Check if there are any customers
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $cuid = $row['customer_id']; // Fetch the Customer_Id
                echo "<tr>
                    <td>" . $row['customer_id'] . "</td>
                    <td>" . $row['first_name'] . "</td>
                    <td>" . $row['last_name'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['phone_number'] . "</td>
                    <td>" . $row['country'] . "</td>
                    <td>" . $row['gender'] . "</td>
                    <td><a style='padding:4px' href='delete_customer.php?customer_id=$cuid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_customer.php?customer_id=$cuid'>Update</a></td> 
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
    <b><h2>UR CBE BIT &copy, 2024 & reg, Designer by: @kamukama joyce</h2></b>
  </center>
</footer>
</body>
</html>