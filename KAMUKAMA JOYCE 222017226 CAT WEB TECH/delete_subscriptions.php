 <?php
    // Connection details
     $include('database-connection.php');

// Check if subscription_Id is set
if(isset($_REQUEST['subscription_id'])) {
    $subsid = $_REQUEST['subscription_id'];
    //subscriptions (subscription_id
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM subscriptions WHERE subscription_id=?");
    $stmt->bind_param("i", $subsid);
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
            <input type="hidden" name="subsid" value="<?php echo $subsid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='subscriptions.php'>OK</a>";
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
    echo "subscription id is not set.";
}

$connection->close();
?>
