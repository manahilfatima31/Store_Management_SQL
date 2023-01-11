<?php
if(isset($_POST["Login"]))
{
session_start();
$conn = mysqli_connect("localhost","root","","store_management");
echo "Connected to the database...."."<br>";
if (!$conn)
	{
		die("Connection to DB failed: ".mysqli_connect_error());
	}

$loginname = $_POST['id'];
$loginpass = $_POST['pass'];

if ($loginname == "fast" && $loginpass == "123"){
	$_SESSION['Login'] = "Active";
	header("Location:store-Login.php");
}
else {
	$sql = "SELECT * FROM customer_information WHERE CustomerID = '$loginname' and Password = '$loginpass'";

	$result = mysqli_query($conn,$sql);

	if(!$row = mysqli_fetch_assoc($result))
		{
			echo "Your UserName or password is incorrect";
			$_SESSION["pass"] = "False";
			header("Location:LoginPage.php");
		}
	else
		{
			$_SESSION['Login'] = "Active";
			$_SESSION['CID']  = $row['CustomerID'];
			header("Location: CustomerLogin.php");
		}
}

}
?>
