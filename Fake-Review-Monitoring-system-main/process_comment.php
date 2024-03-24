<?php 
session_start();
include("login_header.php");
$conn = mysqli_connect("localhost", "root", "");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_select_db($conn, "ita");
if (isset($_POST['submit'])) {
    $_SESSION["user"] = $_GET['username'];
    $username = $_GET['username'];
    $pid = $_GET['pid'];

    $prod = "SELECT * FROM products WHERE pid='$pid'";
    $res = mysqli_query($conn, $prod);
    $row1 = mysqli_fetch_array($res);
    $pname = $row1[2];
    
    $email = $_GET['email'];
    $review = htmlspecialchars($_POST['comment']);
    $ip = '';

    // Check if the user has ordered
    $hasOrderedQuery = "SELECT COUNT(*) AS num_orders FROM orders WHERE username='$username'";
    $orderResult = mysqli_query($conn, $hasOrderedQuery);
    $orderRow = mysqli_fetch_assoc($orderResult);
    $numOrders = $orderRow['num_orders'];

    if ($numOrders > 0) {
        // User has ordered, get IP address
        function get_client_ip_env() {
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if (getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if (getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if (getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if (getenv('HTTP_FORWARDED'))
                $ipaddress = getenv('HTTP_FORWARDED');
            else if (getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'UNKNOWN';

            return $ipaddress;
        }

        $ip = get_client_ip_env();
    }

    $sql = "INSERT INTO reviews (pid, pname, username, email, review, ip) VALUES ('$pid', '$pname', '$username', '$email', '$review', '$ip')";
    if (mysqli_query($conn, $sql)) {
        echo "Review submitted";
        $_SESSION["user"] = $_GET['username'];
        echo "<script>window.alert('Review submitted successfully!!')</script>";
        //window.location.href='review-product.php?login=1 & username={$username}'</script>";
    } else {
        $_SESSION["user"] = $_GET['username'];
        echo "<script>window.alert('Could not submit review')
            window.location.href='men_shop.php?login=1 & username={$username}'</script>";
    }
}
?>
