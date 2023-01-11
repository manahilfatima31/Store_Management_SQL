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
                  <li ><a href="store-Login.php">Home</a></li>
                  <li><a href="AddTransaction.php">Add Transaction</a></li>
                  <li> <a href="AllTransactions.php">View Transactions</a></li>
                  <li class="selected-item"> <a href="AllStocks.php">View Stock</a></li>
                  <li><a href="Depleted_Stock.php">Used Stock</a></li>
                  <li> <a href="AddCategory.php">Add Category</a></li>
                  <li><a href="#">Update Stock</a></li>
                  <li><a href="#">Add/Update Supplier</a></li>
                  <li><a href="#">Order Details</a></li>
                  <li><a href="Logout.php">Logout</a></li>
</ul>
          </ul>
			</nav>



			</aside>

		<section id="content" class="column-right">

	    <article>

		<blockquote><p><b>QUICK TIP:</b> On this page you can view how many products are left from each quanityt, simply select the category and click the show products button--------------</p></blockquote>
		<p>&nbsp;</p>

		
<fieldset>
		<legend><h3>Catagories of Products</h3></legend>
		<table>
			<tr>
				<th>Category ID</th>
				<th>Name</th>

			</tr>
			<?php
				$conn = mysqli_connect("localhost","root","","store_management");
				$sql = "SELECT * FROM category";
				$result = mysqli_query($conn,$sql);

				$row = mysqli_fetch_assoc($result);
				do { ?>


			<tr>
				<td><?php echo $row['CategoryID']; ?></td>
				<td><?php echo $row['CategoryName']; ?></td>
			</tr>
			<?php } while($row = mysqli_fetch_assoc($result)) ?>
			<tr>
		</table>
  </fieldset>

<fieldset>
  <legend><h3>Choose Category</h3></legend>
    <form action="AllStocks.php" method="POST">
      <p><label for="ID"><strong>Category ID:</strong></label>
      <input type="text" name="CategoryID" id="ID"  placeholder = "Catagory ID" required/><b/></p>

      <p><input type="submit" name="pshow" class="formbutton" value="Show Products" /></p>
    </form>

</fieldset>

  <?php if(isset($_POST['pshow'])) {
    $catagoryID = $_POST['CategoryID'];
     ?>
    <fieldset>
    		<legend><h3>Products in Category ID <?php echo $catagoryID ?></h3></legend>
    		<table>
    			<tr>
    				<th>CategoryID</th>
            <th>Product</th>
    				<th>ID</th>
            <th>Supplier ID</th>
            <th>Quantity</th>
            <th>Cost Price</th>
            <th>Sell Price</th>
            <th>Re-order Level</th>
    			</tr>
    			<?php
    				$conn1 = mysqli_connect("localhost","root","","store_management");
            $sql1 = "SELECT CategoryID,Pname,product.ProductID AS product,SupplierID,Quantity_in_stock,UnitPrice,USP,ReorderLevel
            FROM product,price_list
            WHERE price_list.ProductID = product.ProductID
            AND CategoryID = '$catagoryID'";
    				$result = mysqli_query($conn1,$sql1);

    				$row1 = mysqli_fetch_assoc($result);
    				do { ?>


    			<tr>
    				<td><?php echo $row1['CategoryID']; ?></td>
    				<td><?php echo $row1['Pname']; ?></td>
            <td><?php echo $row1['product']; ?></td>
            <td><?php echo $row1['SupplierID']; ?></td>
            <td><?php echo $row1['Quantity_in_stock']; ?></td>
            <td><?php echo $row1['UnitPrice']; ?></td>
            <td><?php echo $row1['USP']; ?></td>
            <td><?php echo $row1['ReorderLevel']; ?></td>
    			</tr>
    			<?php } while($row1 = mysqli_fetch_assoc($result)) ?>
    			<tr>
    		</table>
      </fieldset>

      <?php } ?>


<br> <br><br><br><br><br><br><br>

		</article>




			<footer class="clear">
			<p>© 2022 Store Management by Usman, Manahil & Anas (BS-AI-5A)</p>
			</footer>

		</section>

		<div class="clear"></div>

	</section>


</body>
</html>
