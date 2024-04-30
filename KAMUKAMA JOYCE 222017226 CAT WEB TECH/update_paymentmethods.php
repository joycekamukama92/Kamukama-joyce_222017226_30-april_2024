<?php
    // Connection details
     include('database-connection.php');

// Check if paymentmethod_Id is set
if(isset($_REQUEST['payment_method_id'])) {
    $paymthd_id = $_REQUEST['payment_method_id'];
    
    $stmt = $connection->prepare("SELECT * FROM paymentmethods WHERE payment_method_id=?");
    $stmt->bind_param("i", $paymthd_id);
    $stmt->execute();
    $result = $stmt->get_result();
    //paymentmethods (payment_method_id, type, customer_id,card_number,expiration_date
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['payment_method_id'];
        $c = $row['type'];
        $d = $row['customer_id'];
        $e = $row['card_number'];
        $f = $row['expiration_date'];
       
    } else {
        echo "paymentmethods not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Form of paymentmethods</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of paymentmethods form -->
    <h2><u>Update Form of paymentmethods</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="paytype">type:</label>
        <input type="text" name="paytype" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="cusid">customer id:</label>
        <input type="number" name="cusid" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="cardnumber">card number:</label>
        <input type="number" name="cardnumber" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="expdate">expiration date:</label>
        <input type="date" name="expdate" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>


        <input type="submit" name="up" value="Update">
        
    </form></center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $type = $_POST['paytype'];
    $custid = $_POST['cusid'];
    $cardNmbr = $_POST['cardnumber'];
    $epirDate = $_POST['expdate'];
    
    // Update the paymentmethod in the database
    $stmt = $connection->prepare("UPDATE paymentmethods SET type=?, customer_id=?,card_number=?, expiration_date=? WHERE payment_method_id=?");
    $stmt->bind_param("ssssi",$type, $custid, $cardNmbr, $epirDate, $paymthd_id);
    $stmt->execute();
    
    // Redirect to paymentmethods.php
    header('Location: paymentmethods.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
