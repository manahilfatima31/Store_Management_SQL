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
                            		<li><a href="store-Login.php">Home</a></li>
																<li class="selected-item"><a href="Add _Transaction.php">Add Transaction</a></li>
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

		<blockquote><p><b>QUICK TIP:</b> On this page you can add new transactions--------------------------------------------------------------------------------------------------------------------------</p></blockquote>
		<p>&nbsp;</p>

		
		<fieldset>
				<legend><strong>ADD TRANSACTION</strong></legend>
					<form action="Multi_products.php" method="POST">

						<p><label for="CustomerID">Customer ID:</label>
						<input type="text" name="CustomerID" id="CustomerID" Placeholder="CustomerID" required/><br /></p>

            <p><label for="hmany">Quantity:</label>
            <input type="integer" name="Howmany" id="hmany" Placeholder="Quantity of products"  required /><br /></p>

						<p><label for="Tran_Int_Date">Transaction Date:</label>
						<input type = "Date"  name="Trans_Int_Date" id="BalanceAmount" placeholder="BalanceAmount" required></input><br /></p>

						<p><input type="submit" name="send" class="formbutton" value="Add Transaction" /></p>
            <?php $_SESSION['TI'] = "Active";
                    $_SESSION['TotalAmt'] = 0;
                    $_SESSION['PAmt'] = array();
             ?>
      		</form>
    </fieldset>
<br><br><br><br><br><br><br>
		</article>





			<footer class="clear">
				<p>© 2022 Store Management by Usman, Manahil & Anas (BS-AI-5A)</p>
			</footer>

		</section>

		<div class="clear"></div>

	</section>


</body>
</html>
