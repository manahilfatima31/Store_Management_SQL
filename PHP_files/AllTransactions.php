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
																<li class="selected-item"> <a href="AllTransactions.php">View Transactions</a></li>
                                <li> <a href="AllStocks.php">View Stock</a></li>
								<li><a href="Depleted_Stock.php">Used Stock</a></li>
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

		<blockquote><p><b>QUICK TIP:</b> On this page you can view all transactions together or selected from your preffered date----------------------------------------------------------------------</p></blockquote>
		<p>&nbsp;</p>

		
    <fieldset>
      <legend><strong><h3>Enter Dates to view Transactions</h3></strong></legend>
      <form action="AllTransactions.php" method="POST">
        <p><label for="FDate"><strong>From:</strong></label>
        <input type="Date" name="FDate" id="FDate"  placeholder = "Start Date" required/><b/></p>

        <p><label for="TDate">To:</label>
        <input type="Date" name="TDate" id="TDate" placeholder= "Login_ID" required/><br /></p>

        <p><input type="submit" name="Show" class="formbutton" value="View Transactions" /></p>
      </form>

    </fieldset>

    <?php
    if(isset($_POST['Show']))
    {
      $fdate = $_POST['FDate'];
      $tdate = $_POST['TDate'];
    ?>

    <fieldset>
				<legend><h3>Transactions</h3></legend>
				<table>

					<tr>
            <th>Transaction_ID</th>
						<th>Product_ID</th>
						<th>Total_Amount</th>
						<th>Transaction_Date</th>
   				</tr>

					<?php
						$conn = mysqli_connect("localhost","root","","store_management");
						$sql = "SELECT * FROM transaction_detail
						WHERE Trans_Init_Date>='$fdate' AND Trans_Init_Date<='$tdate' ";

						$result = mysqli_query($conn,$sql) or die ("Error in query: $sql. ".mysql_error($conn));

						$row = mysqli_fetch_assoc($result);
						do { ?>


					<tr>
						<td><?php echo $row['TransactionID']; ?></td>
						<td><?php echo $row['ProductID']; ?></td>
						<td><?php echo $row['Total_Amount']; ?></td>
						<td><?php echo $row['Trans_Init_Date']; ?></td>
					</tr>

					<?php } while($row = mysqli_fetch_assoc($result)) ?>

          <?php
              $conn = mysqli_connect("localhost","root","","store_management");
              $sql = "SELECT SUM(Total_Amount) FROM transaction_detail
              WHERE Trans_Init_Date>='$fdate' AND Trans_Init_Date<='$tdate' ";

              $result1 = mysqli_query($conn,$sql) or die ("Error in query: $sql. ".mysql_error($conn));
              $row = mysqli_fetch_assoc($result1);

               ?>
               <p>The Total profit you made from <?php echo $fdate  ?> to <?php echo $tdate ?> is Rs.  <?php echo $row['SUM(Total_Amount)'] ?> </p>
          <?php } ?>




				</table>
		</fieldset>
				<p>&nbsp;</p>

		</article>

<br><br><br><br><br>
</p>
			<footer class="clear">
			<p>© 2022 Store Management by Usman, Manahil & Anas (BS-AI-5A)</p>
			</footer>

		</section>

		<div class="clear"></div>

	</section>


</body>
</html>
