<?php
// Start the session
session_start();

// Database connection parameters
include '../model/connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $name = trim($_POST['name']);
    $feedback = trim($_POST['feedback']);
    
    // Validate input data
    if (empty($name) || empty($feedback)) {
        echo "Please fill in all fields.";
        exit;
    }

    // Assuming user_id is stored in session after login
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Prepare SQL statement to insert feedback into the database
        $stmt = $pdo->prepare("INSERT INTO feedback (feedback_id,user_id, content, time) VALUES :feedback_id,:user_id, :content, NOW())");

        // Bind parameters
        $stmt->bindParam(':feedback_id', $feedback_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':content', $feedback);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Feedback submitted successfully!";
        } else {
            echo "Error submitting feedback. Please try again.";
        }
    } else {
        echo "Người dùng chưa đăng nhập.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$pdo = null;
?>