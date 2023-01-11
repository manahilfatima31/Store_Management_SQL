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
<link rel="stylesheet" href="store/styles.css" type="text/css" />
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
                            		<li> <a href="store-Login.php">Home</a></li>
																<li> <a href="AddTransaction.php">Add Transaction</a></li>
																<li> <a href="AllTransactions.php">View Transactions</a></li>
																<li> <a href="AllStocks.php">View Stock</a></li>
																<li class="selected-item"><a href="Depleted_Stock.php">Used Stock</a></li>
																<li> <a href="AddCategory.php">Add Category</a></li>
                            									<li> <a href="#">Update Stock</a></li>
                            									<li> <a href="#">Add/Update Supplier</a></li>
																<li><a href="#">Order Details</a></li>
																<li> <a href="Logout.php">Logout</a></li>
          </ul>
			</nav>



			</aside>

		<section id="content" class="column-right">

	    <article>

		<blockquote><p><b>QUICK TIP:</b> On this page you can see the products that have been used already with their information--------------------------------------------------------------------</p></blockquote>
		<p>&nbsp;</p>

		<fieldset>
				<legend><h3>Used Stock</h3></legend>
				<table>
					<tr>
						<th>Product ID</th>
						<th>Quantity</th>

					</tr>
					<?php
						$conn = mysqli_connect("localhost","root","","store_management");
						$sql = "SELECT * FROM Depleted_Product ";

						$result = mysqli_query($conn,$sql);

						$row = mysqli_fetch_assoc($result);
						do { ?>


					<tr>
						<td><?php echo $row['ProductID']; ?></td>
						<td><?php echo $row['Quantity']; ?></td>

					</tr>

					<?php } while($row = mysqli_fetch_assoc($result)) ?>
					<tr>
				</table>
		</fieldset>
				<p>&nbsp;</p>
<br><br><br><br><br>
		</article>


</p>
<br><br><br><br><br><br><br><br>
			<footer class="clear">
				<p>© 2022 Store Management by Usman, Manahil & Anas (BS-AI-5A)</p>
			</footer>

		</section>

		<div class="clear"></div>

	</section>


</body>
</html>
