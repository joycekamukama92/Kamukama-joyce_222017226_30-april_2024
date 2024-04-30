<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Connection details
    include('database-connection.php');

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'customers' => "SELECT first_name FROM customers WHERE first_name LIKE ?",
        'invoices' => "SELECT invoice_id FROM invoices WHERE invoice_id LIKE ?",
        'paymentmethods' => "SELECT type FROM paymentmethods WHERE type LIKE ?",
        'products' => "SELECT product_name FROM products WHERE product_name LIKE ?",
        'subscriptions' => "SELECT subscription_id FROM subscriptions WHERE subscription_id LIKE ?",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        // Prepare the statement
        $stmt = $connection->prepare($sql);
        if (!$stmt) {
            echo "<p>Error in preparing statement: " . $connection->error . "</p>";
            continue; // Skip to next iteration
        }

        // Bind parameters and execute the statement
        $param = "%" . $searchTerm . "%";
        $stmt->bind_param("s", $param);
        $stmt->execute();

        // Get results
        $result = $stmt->get_result();

        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
