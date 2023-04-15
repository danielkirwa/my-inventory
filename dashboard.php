
<?php 
   require_once('application/connection.php');

 ?>
 <?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

if ($_SESSION['username']) {
  // code...
 $currentUser =  $_SESSION['username'];
 $currentprivillege = $_SESSION['privillege'] ;
  $openbusiness =  $_SESSION['businessname'];


}else{
    header("Location:index.php");
}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
  <link rel="stylesheet" type="text/css" href="css/dashboard.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div>
    <div class="banner">
    	<div class="vender-logo"><img src="assets/logo/juelgaicon.png"> </div>
    	<div class="shop-name"><center>
         
        <h3><?php echo $openbusiness; ?></h3>
        
      </center></div>
    </div>
</div>
<!-- nav -->
<div class="navbar">
	  <a href="dashboard.php"  style=" background:  #0067a0;">Dashboard</a>
  <div class="subnav">
    <button class="subnavbtn">My Business <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="createbusiness.php">Add Business</a>
      <a href="createcustomer.php">Add Customer</a>
      <a href="createsupplier.php">Add Supplier</a>
    </div>
  </div> 
  <div class="subnav">
    <button class="subnavbtn">Product <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="createproduct.php">Add Product</a>
      <a href="createunits.php">Add Units</a>
    </div>
  </div> 
  <div class="subnav">
    <button class="subnavbtn">Stock <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="createstock.php">Add Stock</a>
      <a href="adjuststock.php">Adjust Stock</a>
    </div>
  </div>
   <div class="subnav">
    <button class="subnavbtn">Register <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="register.php">Add Staff</a>
      <a href="createrole.php">Add Role</a>
      <a href="createaccount.php">Create Acount</a>
    </div>
  </div>
  <div class="subnav">
    <button class="subnavbtn">Reports <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#link1">Business Report</a>
      <a href="#link2">Salers Report</a>
      <a href="#link3">Orders Report</a>
      <a href="#link4">Sales Report</a>
    </div>
  </div>
  <a href="setting.php">Settings</a>
  <a href="saledesk.php">Sale Desk</a>
  <div class="subnav">
    <button class="subnavbtn"><?php echo $currentUser; ?><i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="profile.php">Profile</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>
<!-- end nav -->

<!-- start of dashboard -->
<br><br>
<div class="dashboard">Welcome to <?php echo $currentprivillege; ?> Dashboard
   <div class="general-banner">

    <div class="card">
      <center><label class="my-label">This Month sale</label><br>
          </center>
          <hr>
          <center><label class="my-label"><span>Ksh. </span>0.00</label><br>
          </center>
        </div>

      <div class="card">
        <center><label class="my-label">Business growth</label><br>
          </center>
          <hr>

          <center><label class="my-label"><span>Up/Down </span>0.00</label><br>
          </center>

      </div>
    
   </div>
   <div class="dashboard-card-holder">
      <div class="card">
        <center><label class="my-label">Up coming Expiries</label><br>
          </center>

          <div class="small-scroll-table">
  <div class="small-table-holder">
  <table>
    <thead>
      <th>Product/Item</th>
      <th>Code </th>
      <th>Date</th>
    </thead>
    <tbody>   
        
          </tbody>
     </table>
  </div>
</div>

          <!-- end of table -->
      </div>
      <div class="card">
        <center><label class="my-label">Expiries</label><br>
          </center>
                <div class="small-scroll-table">
  <div class="small-table-holder">
  <table>
    <thead>
      <th>Product/Item</th>
      <th>Code </th>
      <th>Date</th>
    </thead>
    <tbody>   
        
          </tbody>
     </table>
  </div>
</div>

          <!-- end of table -->

      </div>
      <div class="card">card</div>
      <div class="card">Unpaid loan</div>
      <div class="card">Overdue Load</div>
   </div>
   <div class="dashboard-message">
      <div class="card">Out of stock table</div>
      <div class="card">
          <center><label class="my-label">Oders</label><br>
          </center>
      </div>

   </div>
</div>

<!-- end of dashboard -->
<!-- footer starts -->
<div class="footer">
	 <h3></h3>
   Juelga solution &copy;  &nbsp;&nbsp;<a href="https://www.juelgasolutions.co.tz" style="text-decoration: none; color: #ffffff">juelgasolution </a><br>
   <h3></h3>
</div>
</body>
</html>