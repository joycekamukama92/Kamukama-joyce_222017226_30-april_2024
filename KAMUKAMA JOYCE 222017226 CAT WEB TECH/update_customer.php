<?php
// Connection details
 include('database-connection.php');

// Check if Customer_Id is set
if(isset($_REQUEST['customer_id'])) {
    $custid = $_REQUEST['customer_id'];
    
    $stmt = $connection->prepare("SELECT * FROM customers WHERE customer_id=?");
    $stmt->bind_param("i", $custid);
    $stmt->execute();
    $result = $stmt->get_result();
    //customers (customer_id,first_name, last_name, email, phone_number, country,gender
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['customer_id'];
        $c = $row['first_name'];
        $d = $row['last_name'];
        $e = $row['email'];
        $f = $row['phone_number'];
        $h = $row['country'];
        $g = $row['gender'];
    } else {
        echo "Customer not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of customer</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of customer form -->
    <h2><u>Update Form of Supplier</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="fname">First Name:</label>
        <input type="text" name="fname" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="lname">Last Name:</label>
        <input type="text" name="lname" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="eml">Email:</label>
        <input type="email" name="eml" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="custphone">Phone Number:</label>
        <input type="number" name="custphone" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>

         <label for="ctry">Country:</label>
        <input type="text" name="ctry" value="<?php echo isset($h) ? $h : ''; ?>">
        <br><br>

        <label for="gend">Gender:</label>
          <select name="gend">
                <option <?php if(isset($g) && $g == 'Male') echo 'selected'; ?>>Male</option>
                <option <?php if(isset($g) && $g == 'Female') echo 'selected'; ?>>Female</option>
          </select>
        
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form></center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $frstname = $_POST['fname'];
    $lstname = $_POST['lname'];
    $email = $_POST['eml'];
    $phoneNmbr = $_POST['custphone'];
    $country = $_POST['ctry'];
    $gender = $_POST['gend'];
    
    // Update the customer in the database
    $stmt = $connection->prepare("UPDATE customers SET first_name=?, last_name=?, email=?, phone_number=?, country=?, gender=? WHERE customer_id=?");
    $stmt->bind_param("ssssssi",$frstname, $lstname, $email, $phoneNmbr, $country, $gender, $custid);
    $stmt->execute();
    
    // Redirect to customers.php
    header('Location: customers.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
