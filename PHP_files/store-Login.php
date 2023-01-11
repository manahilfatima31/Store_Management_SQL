<?php
session_start();
if($_SESSION['Login']!="Active")
{
    header("location:loginPage.php");
}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Management System</title>
<style>
#pass a{
    visibility:hidden;
}
    #pass:hover a{
    visibility:visible;
    }
</style>
<link rel="stylesheet" href="store/styles.css" type="text/css" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-s.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
</head>

<body>

		<section id="body" class="width">
			<aside id="sidebar" class="column-left">

			<header>
				<h1><a href="#">Store Admin</a></h1>

				<h2>Management System</h2>

			</header>
			<nav id="mainnav">
  				<ul>
                            		<li class="selected-item"><a href="store-Login.php">Home</a></li>
																<li><a href="AddTransaction.php">Add Transaction</a></li>
																<li> <a href="AllTransactions.php">View Transactions</a></li>
																<li> <a href="AllStocks.php">View Stock</a></li>
																<li><a href="Depleted_Stock.php">Used Stock</a></li>
																<li> <a href="AddCategory.php">Add Category</a></li>
                            									<li><a href="#">Update Stock</a></li>
                            									<li><a href="#">Add/Update Supplier</a></li>
																<li><a href="#">Order Details</a></li>
																<li><a href="Logout.php">Logout</a></li>
          </ul>
			</nav>



			</aside>

		<section id="content" class="column-right">

	    <article>

		<blockquote><p><b>QUICK TIP:</b> On this page you can add new customers and also view all the current customers that have been registered. Choose different actions from the side menu for more control.</p></blockquote>
		<p>&nbsp;</p>




		<div class="w3-row-padding w3-center w3-margin-top">
<div class="w3-third">
  <div class="w3-card w3-container w3-blue-grey" style="min-height:460px">
  <h3>Effecient</h3><br>
  <i class="fa fa-desktop w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
  <p>Efficient</p>
  <p>Good for small business</p>
  <p>Fits any screen sizes</p>
  <p>Perect to stay on top of your business</p>
  </div>
</div>

<div class="w3-third">
  <div class="w3-card w3-container w3-blue" style="min-height:460px">
  <h3>More People</h3><br>
  <i class="fa fa-eye w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
  <p>More visitors</p>
  <p>Easy to understand</p>
  <p>No need for classes</p>
  <p>No extra hassle</p>
  </div>
</div>

<div class="w3-third">
  <div class="w3-card w3-container w3-red" style="min-height:460px">
  <h3>Results</h3><br>
  <i class="fa fa-users w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
  <p>Creates more profit</p>
  <p>Allows you to relax more</p>
  <p>Good for any retail</p>
  <p>Highly configurable</p>
  </div>
</div>
</div>





		
		<fieldset>
					<legend><strong><h3>ADD CUSTOMER</h3></strong></legend>
					<form action="Addcustomer.php" method="POST">
						<p><label for="name"><strong>Name:</strong></label>
						<input type="text" name="Cname" id="name"  placeholder = "Name" required/><b/></p>

						<p><label for="CustomerID">Customer-ID:</label>
						<input type="text" name="CustomerID" id="CustomerID" placeholder= "Login_ID" required/><br /></p>

						<p><label for="Phone">Phone-No:</label>
						<input type="text" name="Phone" id="Phone" placeholder="Phone No."   required/><br /></p>

						<p><label for="password">Password:</label>
						<input type="password" name="Password" id="password" placeholder="Password" required/><br /></p>

						<p><label for="Address">Address:</label>
						<textarea cols="60" rows="8" name="Address" id="Address" placeholder="House#, Street, City"required></textarea><br /></p>

						<p><input type="submit" name="Add" class="formbutton" value="Add Customer" /></p>
					</form>

		</fieldset>
		<fieldset>
		<legend><strong><h3>All Customers</h3></strong></legend>
		<table>
			<tr>
				<th>Customer ID</th>
				<th>Name</th>
				<th>Address</th>
				<th>Phone</th>
				<th>Password</th>
			</tr>
			<?php
				$conn = mysqli_connect("localhost","root","","store_management");
				$sql = "SELECT * FROM Customer_information";
				$result = mysqli_query($conn,$sql) or die("Error: $sql. ".mysql_error($conn));

				$row = mysqli_fetch_assoc($result);
				do { ?>


			<tr>
				<td><?php echo $row['CustomerID']; ?></td>
				<td><?php echo $row['Name']; ?></td>
				<td><?php echo $row['Address']; ?></td>
				<td><?php echo $row['Phone']; ?></td>
				<td id = "pass"><a><?php echo $row['Password']; ?></a></td>
			</tr>
			<?php } while($row = mysqli_fetch_assoc($result)) ?>
			<tr>
		</table>
	</fieldset>
		</article>




			<footer class="clear">
				<p>© 2022 Store Management by Usman, Manahil & Anas (BS-AI-5A)</p>
			</footer>

		</section>

		<div class="clear"></div>

	</section>


</body>
</html>
