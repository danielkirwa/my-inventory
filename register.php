
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
<!-- escaping sql injection -->
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

?>



<?php 


  // get data to insert
  if(isset($_POST['addstaff'])){
    $newfirstname = $_POST['firstname'];
    $newothername = $_POST['othername'];
    $newidnumber = $_POST['idnumber'];
    $newphone = $_POST['phone'];
    $newemail = $_POST['email'];
    $newotherphone = $_POST['otherphone'];
    $newdateofbirth = $_POST['dateofbirth'];
     if(!empty($_POST['role'])) {
        $newrole = $_POST['role'];
        echo 'You have chosen: ' . $newrole;
    } else {
        echo 'Please select the value.';
    }
    if(!empty($_POST['gender'])) {
        $newgender = $_POST['gender'];
        echo 'You have chosen: ' . $newgender;
    } else {
        echo 'Please select the value.';
    }
     if(!empty($_POST['station'])) {
        $newstation = $_POST['station'];
        echo 'You have chosen: ' . $newstation;
    } else {
        echo 'Please select the value.';
    }




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
  <form action="register.php" method="POST" name="">
	 <center><h3 class="my-label">Staff management</h3></center>

	 <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">First Name</label><br>
          <input type="text" name="firstname" placeholder="Enter First Name" class="my-input">
          </center>
      </div>
      <div class="card">
      	<center>
      	<label class="small-label">Other Name</label><br>
          <input type="text" name="othername" placeholder="Enter Other Name" class="my-input">
          </center>
      </div>
   </div>

   <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">ID Number</label><br>
          <input type="text" name="idnumber" placeholder="Enter ID Number" class="my-input">
          </center>
      </div>
      <div class="card">
      	<center>
      	<label class="small-label">Phone Number</label><br>
          <input type="text" name="phone" placeholder="+2557xxxxxxx" class="my-input">
          </center>
      </div>
   </div>

    <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">Email </label><br>
          <input type="text" name="email" placeholder="Enter ID Number" class="my-input">
          </center>
      </div>
      <div class="card">
      	<center>
      	<label class="small-label">Other Number</label><br>
          <input type="text" name="otherphone" placeholder="+2557xxxxxxx" class="my-input">
          </center>
      </div>
   </div>
 
    <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">Role</label><br>
           <select class="my-input" name="role">
            <option value="" disabled selected>Choose Role</option>
           	<option value="Role 1">Role one</option>
           	<option value="Role 2">Role one</option>
           	<option value="Role 3">Role one</option>
           </select>
          </center>
      </div>
      <div class="card">
      	<center>
      	<label class="small-label">Gender</label><br>
          <select class="my-input" name="gender">
            <option value="" disabled selected>Choose Gender</option>
           	<option value="Male">Male</option>
           	<option value="Female">Female</option>
           </select>
          </center>
      </div>
   </div>

     <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">Work Station</label><br>
           <select class="my-input" name="station">
            <option value="" disabled selected>Choose Station</option>
           	<option value="Main Station">Main Station</option>
           	<option value="Branch">Branch </option>
           </select>
          </center>
      </div>
      <div class="card">
      	<center>
      		<label class="small-label">Birth Date</label><br>
      		<input type="date" name="dateofbirth" class="my-input">
      	</center>
      </div>
   </div>


   <div class="input-holder">
      <div class="card">
      	<center>
          <input type="submit" name="addstaff" value="Save Staff" class="my-btn">
          </center>
      </div>
      <div class="card">
      
      	
      </div>
   </div>
</form>
</div>


<!-- table -->
<br><br>

<div class="scroll-table">
  <div class="table-holder">
    <div class="table-caption">
      <label class="my-label">List of staff  </label>
    </div>
  <table>
    <thead>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Points</th>
      <th>Points</th>
      <th>Points</th>
      <th>Points</th>
    </thead>
    <tr>
      <td>Jill</td>
      <td>Smith</td>
      <td>50</td>
      <td>50</td>
      <td>50</td>
      <td>50</td>
    </tr>
    </table>
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