 <?php
    // Connection details
     include('database-connection.php');

// Check if product_Id is set
if(isset($_REQUEST['product_id'])) {
    $pid = $_REQUEST['product_id'];
    //products (product_id, product_name, description,category,price
    $stmt = $connection->prepare("SELECT * FROM products WHERE product_id=?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $a = $row['product_id'];
        $b = $row['product_name'];
        $c = $row['description'];
        $d = $row['category'];
        $e = $row['price'];
       
    } else {
        echo "Product not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of Product</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of Product form -->
    <h2><u>Update Form of Product</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        
        <label for="prname">Product Name:</label>
        <input type="text" name="prname" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="descrp">Description:</label>
        <input type="text" name="descrp" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="categ">Category:</label>
        <input type="text" name="categ" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="prprice">Price:</label>
        <input type="number" name="prprice" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form></center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $pname = $_POST['prname'];
    $description = $_POST['descrp'];
    $category = $_POST['categ'];
    $pprice = $_POST['prprice'];
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE products SET product_name=?, description=?, category=?, price=? WHERE product_id=?");
    $stmt->bind_param("ssssi", $pname, $description, $category, $pprice, $pid);
    $stmt->execute();
    
    // Redirect to product.php
    header('Location: products.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
