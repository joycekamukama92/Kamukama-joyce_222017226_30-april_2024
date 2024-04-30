<?php
// Connection details
 include('database-connection.php');
 
// Check if customer_id is set
if(isset($_REQUEST['customer_id'])) {
    $custid = $_REQUEST['customer_id'];
    //customers (customer_id
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM customers WHERE customer_id=?");
    $stmt->bind_param("i", $custid);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="custid" value="<?php echo $custid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='customers.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "customer Id is not set.";
}

$connection->close();
?>
