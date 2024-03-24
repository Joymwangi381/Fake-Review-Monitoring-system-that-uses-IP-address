<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $review = $_POST['review'];

    $sql = "INSERT INTO reviews (reviewz) VALUES ('$review')";

    if ($conn->query($sql) === TRUE) {
        echo "Review added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
