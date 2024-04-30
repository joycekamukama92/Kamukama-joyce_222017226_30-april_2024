   <?php
    // Connection details
    include('database-connection.php');
    
// Check if product_id is set
if(isset($_REQUEST['product_id'])) {
    $pid = $_REQUEST['product_id'];
    //products (product_id,
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM products WHERE product_id=?");
    $stmt->bind_param("i", $pid);
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
            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='products.php'>OK</a>";
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
    echo "product Id is not set.";
}

$connection->close();
?>
