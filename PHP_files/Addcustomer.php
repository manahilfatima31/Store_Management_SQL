<?php


$conn = mysqli_connect("localhost","root","","store_management");
echo "Connected to the database of the host...."."<br>";
if (!$conn)
	{
		die("Connection is failed: ".mysqli_connect_error());
	}


$Cname = $_POST['Cname'];
$customerID   = $_POST['CustomerID'];
$Phone    = $_POST['Phone'];
$password  = $_POST['Password'];
$Address = $_POST['Address'];

echo $Cname."<br>";
echo $customerID."<br>";
echo $Phone."<br>";
echo $password."<br>";
echo $Address."<br>";


$sql = "INSERT INTO Customer_information(CustomerID,Name,Address,Phone,Password)
		VALUES('$customerID','$Cname','$Address','$Phone','$password')";

$result = mysqli_query($conn,$sql) or die("Error: $sql. ".mysql_error($conn));


header("Location:store-Login.php");
?>
