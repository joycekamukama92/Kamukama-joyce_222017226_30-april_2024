    <?php
    // Connection details
     include('database-connection.php');

// Check if invoices Id is set
if(isset($_REQUEST['invoice_id'])) {
    $invid = $_REQUEST['invoice_id'];
    
    $stmt = $connection->prepare("SELECT * FROM invoices WHERE invoice_id=?");
    $stmt->bind_param("i", $invid);
    $stmt->execute();
    $result = $stmt->get_result();
    //invoices (invoice_id, customer_id, payment_method_id,issue_date,total_amount,currency,payment_status)
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $a = $row['invoice_id'];
        $b = $row['customer_id'];
        $c = $row['payment_method_id'];
        $d = $row['issue_date'];
        $e = $row['total_amount'];
        $f = $row['currency'];
        $g = $row['payment_status'];
    } else {
        echo "invoices not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of invoices</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of invoices form -->
    <h2><u>Update Form of Supplier</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        
        <label for="cusid">customer id:</label>
        <input type="number" name="cusid" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="pmid">payment method id:</label>
        <input type="number" name="pmid" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="issdate">issue date:</label>
        <input type="date" name="issdate" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="tAmount">total amount:</label>
        <input type="number" name="tAmount" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="crncy">currency:</label>
        <input type="number" name="crncy" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>

        <label for="status">payment_status:</label>
        <input type="text" name="status" value="<?php echo isset($g) ? $g : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form></center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $custid = $_POST['cusid'];
    $paymethod_id = $_POST['pmid'];
    $issue_date = $_POST['issdate'];
    $totAmount = $_POST['tAmount'];
    $currncy = $_POST['crncy'];
    $payStatus = $_POST['status'];
    
    // Update the invoices in the database
    $stmt = $connection->prepare("UPDATE invoices SET customer_id=?, payment_method_id=?, issue_date=?, total_amount=?, currency=?, payment_status=? WHERE invoice_id=?");
    $stmt->bind_param("iissssi", $custid, $paymethod_id, $issue_date, $totAmount, $currncy, $payStatus, $invid);
    $stmt->execute();
    
    // Redirect to invoices.php
    header('Location: invoices.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
