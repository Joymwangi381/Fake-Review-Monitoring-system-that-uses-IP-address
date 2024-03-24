<?php
session_start();
require_once "db.php"; // Adjust this line to point to your database connection file
mysqli_select_db($conn, "ita");

if (isset($_POST['rev_sub'])) {
    $comment = $_POST['comment'];

    // Check if $comment is not empty
    if (!empty($comment)) {
        // Sanitize and escape the input to prevent SQL injection
        $comment = mysqli_real_escape_string($conn, $comment);

        // Insert the review text into the database
        $sqlInsertReview = "INSERT INTO reviews (reviewz) VALUES ('$comment')";
        $resultInsertReview = $conn->query($sqlInsertReview);

        if ($resultInsertReview) {
            // Success message will be displayed through JavaScript
            echo "success";
        } else {
            echo "Error submitting review: " . mysqli_error($conn);
        }
    } else {
        echo "Review cannot be empty.";
    }
}
?>
