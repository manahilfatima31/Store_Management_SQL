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
<title>Customer-Login</title>
<link rel="stylesheet" href="store/styles.css" type="text/css" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
</head>

<body>

		<section id="body" class="width">
			<aside id="sidebar" class="column-left">

			<header>
				<h1><a href="#">Customer Info</a></h1>

				<h2>Management System</h2>

			</header>
			<!--THE LEFT SIDE MENU IS DUE TO THE ABOVE CODE...!!-->
			<nav id="mainnav">
  				<ul>
                            		<li class="selected-item"><a href="CustomerLogin.php">Home</a></li>
									              <li><a href="#">Category</a></li>
									              <li><a href="#">Transactions</a></li>
                                <li><a href="Logout.php">Logout</a></li>
          </ul>
			</nav>



			</aside>

		<section id="content" class="column-right">

	    <article>

		<blockquote><p>Customer can view what he has bought recently as well as some interesting stats about their purchases and as well acess history of transactions--------------------------</p></blockquote>
		<p>&nbsp;</p>

		<!--	<a href="#" class="button">Read more</a>
			<a href="#" class="button button-reversed">Comments</a> -->
		<!--IN THIS FIELD WE CAN ADD THE CUSTOMER..-->
    <?php
    $ci = $_SESSION['CID'];

    $conn = mysqli_connect("localhost","root","","store_management");
    $sql = "SELECT Name  FROM customer_information
    WHERE  CustomerID = '$ci' ";
    $result = mysqli_query($conn,$sql);

    $row1 = mysqli_fetch_assoc($result);

 ?>
<fieldset>
		<legend><h3>Welcome <?php echo $row1['Name']; ?>  </h3></legend>
  </fieldset>



  <div class="w3-container">
    <h5>Recent Purchases Stats</h5>
    <p>New Categories</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-green" style="width:25%">+25%</div>
    </div>

    <p>Same Categories</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-orange" style="width:50%">50%</div>
    </div>

    <p>Visit Rate</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-red" style="width:75%">75%</div>
    </div>
  </div>





  <div class="w3-container">
    <h5>Recent Products Bought</h5>
    <ul class="w3-ul w3-card-4 w3-white">
      <li class="w3-padding-16">
        <span class="w3-xlarge">Food</span><br>
      </li>
      <li class="w3-padding-16">
        <span class="w3-xlarge">Pet Items</span><br>
      </li>
      <li class="w3-padding-16">
        <span class="w3-xlarge">Stress Relief</span><br>
      </li>
    </ul>
  </div>







<br><br><br><br><br><br><br><br><br><br><br><br><br><br> <br><br>
		</article>




			<footer class="clear">
			<p>© 2022 Store Management by Usman, Manahil & Anas (BS-AI-5A)</p>
			</footer>

		</section>

		<div class="clear"></div>

	</section>


</body>
</html>
