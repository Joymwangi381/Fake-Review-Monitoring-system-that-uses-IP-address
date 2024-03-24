<?php
    session_start(); 

    // Check if 'login' key is set in the $_GET array
    $login = isset($_GET['login']) ? $_GET['login'] : null;

    $pid = $_GET['pid'];
    $username = $_GET['username'];

    // Remove the condition for redirection
    // if($login==0 || $username=="Dummy")
    //     echo "<SCRIPT LANGUAGE='JavaScript'>
    //             window.alert('Login to SHOP!!!')
    //             window.location.href='sign-in.php'
    //             </SCRIPT>";

    include("login_header.php");

    $conn = mysqli_connect("localhost","root","");
    mysqli_select_db($conn,"ita");
    $sql = "SELECT * FROM products where pid = '$pid'"; 
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
    $pname = $row['pname'];
    $price = $row['price'];
    $info = $row['info'];
    $image = $row['image'];

    $sql1 = "SELECT username,email,review FROM reviews where pid = '$pid'";
    $result1 = $conn->query($sql1);
?>



<!DOCTYPE html>
<html>
<head>
	<title>Men's Wear</title>
	<style>
div.box  {
	width: 500px;
	height: auto;
	border-style: solid;
	border-radius: 15px;
	border-color: grey;
	padding: 20px;
	margin: 5px;
	
	background-color: #d6ebd9;
}

div.box img {
	width: 200px;
	height: 200px;
	margin-right: 10px;
	-webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.5s;
    text-align: right;
    align-content: right;
    align-items: right;
}

div.box img:hover {
	transform: scale(1.2);
}

div.box h3 {
	text-align: center;
	font-family: arial;
	padding-top: 20px; 
}
div.box h4 {
	text-align: center;
	font-family: arial;
	padding-top: 20px; 
}

div.box input {
	margin-top: 10px;
	margin-bottom: 10px;
	background-color: #4CAF50;
	-webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
}

div.box input:hover {
	background-color: #367477; 
    color: white;	
}

div.box textarea {
	width: 420px;
}

.gallery {
	width: 200px;
	height: 200px;
	padding: 35px;
}

body {
	background-image: url(images/background1.jpg) ;
	text-align: center;
}

</style>

<style type="text/css">
	
	table,tr,td {
		border-style: solid;
		border-color: grey;
    	border-collapse: collapse;
    	padding: 10px;
    	max-width: 1000px;
    	background-color: #b3f3ef;
    	font-family: Helvetica;
    	font-weight: bold;
	}

	th {
		padding: 30px;
	}

	td input {
		margin-right: 5px;
		margin-left: auto; 
	}

	td p {
		font-family: verdana;
		font-weight: normal;
		color: blue;
	}
	div.box  {
		width: 350px;
		height: 350px;
		border-style: solid;
		border-radius: 15px;
		border-color: grey;
		padding: 25px;
		margin: 5px;
		text-align: center;
		background-color: #d6ebd9;
	}

	div.box img {
		width: 100%;
		height: 100%;
		-webkit-transition-duration: 0.4s; /* Safari */
    	transition-duration: 0.5s;
	}

	div.box img:hover {
		transform: scale(1.5);
	}
	div.box input {
		text-align: center;
		align-content: center;
		float: center;
		background-color: #4CAF50;
		-webkit-transition-duration: 0.4s; /* Safari */
   	 	transition-duration: 0.4s;
	}

	div.box input:hover {
		background-color: #367477; 
   	 	color: black;	
	}

	div.re {
		font-family: verdana;
		font-weight: normal;
		color: black;
	}
</style>
</head>
<body bgcolor="#d6ebd9">
	<br><br> 	
	<!--<div class='page'>-->
		<!--<div class='content'>-->
		<form action="confirm-order.php?action=0" method="get">
			<input type="hidden" name="pid" value="<?php echo $pid ?>">
			<input type="hidden" name="username" value="<?php echo $username ?>">  
			<table align="center">
				<tr>
					<th rowspan="100">
						<?php echo "<div class = 'box'><img src = 'images/men/{$image}' alt = '{$pid}'></div>" ?>
						<h5 align="center">(hover over image to zoom in)</h6>
					</th>
				</tr>
				<tr>
					<td><b>Name</b></td>
					<td><?php echo $pname; ?></td>
				</tr>
				<tr>
					<td><b>Price</b></td>
					<td><b>Ksh.<?php echo $price; ?></td>
				</tr>
				<tr>
					<td><b>Details</b></td>
					<td><?php echo $info; ?></td>
				</tr>
				
				<tr>
					<td>Quantity</td>
					<td>
						<input type="text" name="quantity">
						<input type="submit" class="btn btn-primary" name="submit" value="Place Order">
					</td>
				</tr>
				
				<tr>
					<td>Reviews</td>
					<td>
						<p style="color:red">Verified Reviews</p>

						<?php
						while($row1 = mysqli_fetch_assoc($result1))
						{
							echo "<br>";
							$username = $row1['username'];
							$review = $row1['review'];
							
							echo "<p><b>user: {$username}</b><br><div class='re'>{$review}</div</p><br>";
						}
						?>

					</td>
					<td> <p style="color:red">Unverified Reviews</p>
					<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ita";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query('SELECT * FROM reviews ORDER BY pid DESC');

while ($row = $result->fetch_assoc()) {
    if (!empty($row['comments'])) { // Check if the column is not empty
        echo '<li>' . $row['comments'] . '</li>';
    }
}

$conn->close();
?>



					<td>
				</tr>
			</table>
		</form>
		<br><br>
		
		<div class="main">
<table align="center">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ita";
$conn = new mysqli($servername, $username, $password, $dbname);
	$i=0;
	if ($result = $conn->query($sql))
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$pid = $row['pid'];
			if($i%2==0){
				echo"<tr>";
			}

			$prod = "select * from products where pid='$pid'";
			$res = mysqli_query($conn, $prod);
			$row1 = mysqli_fetch_array($res);

			$category = "";
			if($pid[0]==1)
				$category = "men";
			else if($pid[0]==2)
				$category = "women";
			else if($pid[0]==3)
				$category = "books";
			else if($pid[0]==4)
				$category = "gadgets";
			else if($pid[0]==5)
				$category = "sports";

			$pname = $row['pname'];
			$email = isset($_GET['email']) ? $_GET['email'] : ''; // Sets $email to empty string if email parameter is not set


			echo"<td><div class = 'box'><img src = 'images/{$category}/{$row1[4]}' alt = '{$row['pid']}'><br><br><br>
			<h4><b>{$row['pname']}<b></h4>
			<br>
			<form action = 'process_comment.php?pid=$pid & pname = $pname & email=$email & username=$username' method = 'post'>
			<textarea name='comment' rows='5' cols='40'></textarea><br>
			<input type='submit' class='btn btn-primary' align='center' name='submit' value='Submit Review'></input></form></div></td>";
			if($i%2==1){
				echo"</tr>";
			}
			$i++;
		}
	}
?>
</table>
</div>
<br><br><br><br><br><br><br>
</BODY>
</HTML>
<?php
$i= 0;
	echo "<br><br><br><br><br>"; 
	include("footer.php");
?>