<?php
	session_start();
	header("Cache-Control", "no-cache, no-store, must-revalidate");
	$login = $_GET['login'];
	$username = "Dummy";
	if($login==0) 
		include("header.php");
	if($login==1 && isset($_SESSION["user"]))
	{
		$username = $_SESSION["user"];
		include("login_header.php");
	}
	$conn = mysqli_connect("localhost","root","");
	mysqli_select_db($conn,"ita");
	$sql = "select * from orders where username like '$username' order by pid";
	if ($result = $conn->query($sql))
	{
		
	}
	else
	{
		echo '<br><font face="verdana" color="blue" size="6"><b>You have not purchased any products to write a review!!<b></font>';
		echo '<br><br><img src="images/sad.jpg" height="200px" width="200px" align="center"/><br><br>';
		echo '<h2><a href="sign-out.php"><font face="helvetica" color="red">LOGOUT</font></a></h2>';
	}

?>
<HTML>
<HEAD>
<TITLE>Review Product</TITLE>
<!--<link href="imageStyles.css" rel="stylesheet" type="text/css" />-->
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

</HEAD>
<body>
<br><br>

<div class="main">
<table align="center">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ita";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM comments ORDER BY id DESC";

$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $pid = $row['pid'];
        $pname = $row['pname']; // Retrieve pname from the comments table

        if ($i % 2 == 0) {
            echo "<tr>";
        }

        $prod = "SELECT * FROM products WHERE pid='$pid'";
        $res = mysqli_query($conn, $prod);
        $row1 = mysqli_fetch_array($res);

        $category = "";
        if ($pid[0] == 1)
            $category = "men";
        else if ($pid[0] == 2)
            $category = "women";
        else if ($pid[0] == 3)
            $category = "books";
        else if ($pid[0] == 4)
            $category = "gadgets";
        else if ($pid[0] == 5)
            $category = "sports";

        $email = isset($_GET['email']) ? $_GET['email'] : ''; // Sets $email to empty string if email parameter is not set

        echo "<td><div class='box'><img src='images/{$category}/{$row1[4]}' alt='{$row['pid']}'><br><br><br>
        <h4><b>{$pname}</b></h4>
        <br>
        <form action='process_comment.php?pid={$pid}&pname={$pname}&email={$email}&username={$username}' method='post'>
        <textarea name='comment' rows='5' cols='40'></textarea><br>
        <input type='submit' class='btn btn-primary' align='center' name='submit' value='Submit Review'></input></form></div></td>";

        if ($i % 2 == 1) {
            echo "</tr>";
        }
        $i++;
    }
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>

</table>
</div>
<br><br><br><br><br><br><br>
</BODY>
</HTML>
<?php
	echo "<br>"; 
	include("footer.php");
?>
