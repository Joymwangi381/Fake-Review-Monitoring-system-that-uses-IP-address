<?php
// Include your database connection file
include 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $review = $_POST['review'];
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Validate form data (you can add more validation as per your requirements)

    // Insert review data into the database
    $insertReviewQuery = "INSERT INTO comments (pid, pname,username,email, review) VALUES ('$pid', '$pname', '$username', '$email', '$review')";
    $insertReviewResult = mysqli_query($conn, $insertReviewQuery);

    if ($insertReviewResult) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . $insertReviewQuery . "<br>" . mysqli_error($conn);
    }
} else {
    // If the form is not submitted, redirect back to the previous page or display an error message
    echo "Form submission error!";
}
?>
