<?php
// Connection details
 include('database-connection.php');

// Check if subscription is set
if(isset($_REQUEST['subscription_id'])) {
    $subscrid = $_REQUEST['subscription_id'];
    //subscriptions (subscription_id, product_id,start_date,end_date,status)
    $stmt = $connection->prepare("SELECT * FROM subscriptions WHERE subscription_id=?");
    $stmt->bind_param("i", $subscrid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $a = $row['subscription_id'];
        $b = $row['product_id'];
        $c = $row['start_date'];
        $d = $row['end_date'];
        $e = $row['status'];
    } else {
        echo "subscriptions not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of subscriptions</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Update Form of subscriptions form -->
    <h2><u>Update Form of subscriptions</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
      
        <label for="pid">product id:</label>
        <input type="number" name="pid" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="start_date">start date:</label>
        <input type="date" name="start_date" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="end_date">end date:</label>
        <input type="date" name="end_date" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="status">status:</label>
        <input type="text" name="status" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form></center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $prodid = $_POST['pid'];
    $sub_startdate = $_POST['start_date'];
    $sub_enddate = $_POST['end_date'];
    $status = $_POST['status'];
    
    // Update the subscription in the database
    $stmt = $connection->prepare("UPDATE subscriptions SET product_id=?, start_date=?, end_date=?, status=? WHERE subscription_id=?");
    $stmt->bind_param("isssi", $prodid, $sub_startdate, $sub_enddate, $status, $subscrid);
    $stmt->execute();
    
    // Redirect to subscriptions.php
    header('Location: subscriptions.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
