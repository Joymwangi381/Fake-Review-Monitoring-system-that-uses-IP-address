<?php 
	session_start();
	include("login_header.php");
	$conn = mysqli_connect("localhost","root","");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	mysqli_select_db($conn,"ita");
	if(isset($_GET['submit']))
	{
		$_SESSION["user"] = $_GET['username'];
		$username = $_GET['username'];
		$email = $_GET['email'];
		$pid = $_GET['pid'];
		$pname = $_GET["pname"];
		$price = $_GET["price"];
		$quantity = $_GET['quantity'];
		$total = $_GET['total'];
		$address = $_GET['address'];
		$date = date("Y-m-d");
		$ip = "10.100.12.34";

		function get_client_ip_env() 
		{
    		$ipaddress = '';
    		if (getenv('HTTP_CLIENT_IP'))
        		$ipaddress = getenv('HTTP_CLIENT_IP');
    		else if(getenv('HTTP_X_FORWARDED_FOR'))
        		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    		else if(getenv('HTTP_X_FORWARDED'))
        		$ipaddress = getenv('HTTP_X_FORWARDED');
   			else if(getenv('HTTP_FORWARDED_FOR'))
        		$ipaddress = getenv('HTTP_FORWARDED_FOR');
    		else if(getenv('HTTP_FORWARDED'))
        		$ipaddress = getenv('HTTP_FORWARDED');
    		else if(getenv('REMOTE_ADDR'))
        		$ipaddress = getenv('REMOTE_ADDR');
    		else
        		$ipaddress = 'UNKNOWN';

    		return $ipaddress;
		}

		$ip = get_client_ip_env();

		$sql = "insert into orders (username, email, pid, pname, price, quantity, total, address, date, ip) values 
								  	('$username', '$email', '$pid', '$pname', '$price', '$quantity', '$total', '$address', '$date','$ip')";
		if (mysqli_query($conn, $sql))
		{
			$_SESSION["user"] = $_GET['username'];
			echo "<script>window.alert('Order placed successfully!!')
			window.location.href='men.php?login=1 & username={$username}'</script>";
		}
		else
		{
			$_SESSION["user"] = $_GET['username'];
			echo "<script>window.alert('Could not place order')
			windo.location.href='men.php?login=1 & username={$username}'</script>";
		}
	}
?>