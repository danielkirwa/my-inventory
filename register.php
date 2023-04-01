
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

}else{
    header("Location:index.php");
}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
		<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" type="text/css" href="css/elements.css">
</head>
<body>
<div>
    <div class="banner">
    	<div class="vender-logo"><img src="assets/logo/juelgaicon.png"> </div>
    	<div class="shop-name"><center><h3>Business name here</h3></center></div>
    </div>
</div>
<!-- nav -->
<div class="navbar">
	  <a href="#home">Dashboard</a>
  <div class="subnav">
    <button class="subnavbtn">My Business <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#company">Add Business</a>
      <a href="#team">Add Customer</a>
      <a href="#careers">Add Supplier</a>
    </div>
  </div> 
  <div class="subnav">
    <button class="subnavbtn">Product <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#bring">Add Product</a>
      <a href="#deliver">Add Units</a>
    </div>
  </div> 
  <div class="subnav">
    <button class="subnavbtn">Stock <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#link1">Add Stock</a>
      <a href="#link2">Adjust Stock</a>
    </div>
  </div>
   <div class="subnav">
    <button class="subnavbtn" style=" background:  #0067a0;">Register <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#link1">Add Staff</a>
      <a href="#link2">Add Role</a>
      <a href="#link3">Create Acount</a>
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
  <a href="#contact">Settings</a>
  <a href="#contact">Sale Desk</a>
  <div class="subnav">
    <button class="subnavbtn"><?php echo $currentUser; ?><i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#link1">Profile</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>
<!-- end of nav bar -->

<div class="action-div">
	 <center><h3 class="my-label">Staff management</h3></center>

	 <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">First Name</label><br>
          <input type="text" name="" placeholder="Enter First Name" class="my-input">
          </center>
      </div>
      <div class="card">
      	<center>
      	<label class="small-label">Other Name</label><br>
          <input type="text" name="" placeholder="Enter Other Name" class="my-input">
          </center>
      </div>
   </div>

   <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">ID Number</label><br>
          <input type="text" name="" placeholder="Enter ID Number" class="my-input">
          </center>
      </div>
      <div class="card">
      	<center>
      	<label class="small-label">Phone Number</label><br>
          <input type="text" name="" placeholder="+2557xxxxxxx" class="my-input">
          </center>
      </div>
   </div>

    <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">Email </label><br>
          <input type="text" name="" placeholder="Enter ID Number" class="my-input">
          </center>
      </div>
      <div class="card">
      	<center>
      	<label class="small-label">Other Number</label><br>
          <input type="text" name="" placeholder="+2557xxxxxxx" class="my-input">
          </center>
      </div>
   </div>
 
    <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">Role</label><br>
           <select class="my-input">
           	<option>Role one</option>
           	<option>Role one</option>
           	<option>Role one</option>
           </select>
          </center>
      </div>
      <div class="card">
      	<center>
      	<label class="small-label">Gender</label><br>
          <select class="my-input">
           	<option>Male</option>
           	<option>Female</option>
           </select>
          </center>
      </div>
   </div>

     <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">Work Station</label><br>
           <select class="my-input">
           	<option>Station one</option>
           	<option>Station one</option>
           	<option>Station one</option>
           </select>
          </center>
      </div>
      <div class="card">
      	<center>
      		<label class="small-label">Birth Date</label><br>
      		<input type="date" name="" class="my-input">
      	</center>
      </div>
   </div>


   <div class="input-holder">
      <div class="card">
      	<center>
          <input type="submit" name="" value="Save Staff" class="my-btn">
          </center>
      </div>
      <div class="card">
      
      	
      </div>
   </div>



</div>
<br><br><br><br>
<!-- footer starts -->
<div class="footer">
	 <h3></h3>
   Juelga solution &copy;  &nbsp;&nbsp;<a href="https://www.juelgasolutions.co.tz" style="text-decoration: none; color: #ffffff">juelgasolution </a><br>
   <h3></h3>
</div>
</body>
</html>