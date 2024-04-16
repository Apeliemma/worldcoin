<?php
// Include db connection
include ('db_connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $mpesa_code = $_POST['mpesa_code'];
    $location = $_POST['location'];

    // Check if the information already exists in the database
    $check_query = "SELECT * FROM worldcoin WHERE name = '$name' AND phone = '$phone' AND email = '$email' AND mpesa_code = '$mpesa_code' AND location = '$location'";
    $check_result = $conn->query($check_query);
    if ($check_result->num_rows > 0) {
        echo "You have already submitted the information.";
    } else {
        // Prepare SQL statement to insert data into database
        $sql = "INSERT INTO worldcoin (name, phone, email, mpesa_code, location) VALUES ('$name', '$phone', '$email', '$mpesa_code', '$location')";
        
        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            // Close database connection
            $conn->close();
            
            // Redirect to success page
            header("Location: success.php");
            exit(); // Ensure that subsequent code is not executed after the redirection
        } else {
            echo "Sorry, there was an error processing your request. Please try again later.";
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
