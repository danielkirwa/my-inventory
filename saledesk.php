
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
<?php 
    $query ="SELECT Productname,Currentunitprice FROM tblproduct WHERE Status = 1";
    $result = $conn->query($query);
    if($result->num_rows> 0){
      $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
?>


<!-- serach product to sale -->
<?php 


  if(isset($_POST['selectproduct'])){

if($_POST['productcode'] != ""){
            $newname = $_POST['productcode'];
         
            $query = "SELECT  * FROM tblproduct WHERE Productname ='$newname' OR Code='$newname'";
                $searchresult = mysqli_query ($conn, $query);    
               } 
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
  <link rel="stylesheet" type="text/css" href="css/elements.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div>
    <div class="banner">
    	<div class="vender-logo"><img src="assets/logo/juelgaicon.png"> </div>
    	<div class="shop-name"><center><h3><?php echo $openbusiness; ?></h3></center></div>
    </div>
</div>
<!-- nav -->
<div class="navbar">
	  <a href="dashboard.php">Dashboard</a>
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
  <a href="saledesk.php" style=" background:  #0067a0;">Sale Desk</a>
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
<div class="dashboard">Welcome to <?php echo $currentprivillege; ?> Sale desk
   <div class="general-banner">
    <div class="small-card">
    <center> <label class="my-label">Total Items</label><br>
    <label class="my-label" id="snolabel">0</label>
    </center>
    </div>
      <div class="small-card">
        <center> <label class="my-label">Total Discount</label><br>
    <label class="my-label">0</label>
    </center>
      </div>
       <div class="small-card">
         
           <center> <label class="my-label">Total Amount</label><br>
    <label class="my-label" id="priceholder">0</label>
    </center>
       </div>
    
   </div>


   <!-- end of dashboard -->
<!-- start of select item -->

 
 <div class="general-banner">
    <div class="small-card">
      
       <select name="courseName" class="my-input" id="Itemselected">
   <option>Select Product/Item</option>
  <?php 
  foreach ($options as $option) {
  ?>
    <option value="<?php echo $option['Currentunitprice']; ?>"><?php echo $option['Productname']; ?> </option>
    <?php 
    }
   ?>
</select>

    </div>
   
      <div class="small-card">
     <input type="text" name="productcode" value="" class="my-input"  placeholder="Enter code P-S00-1 or Name">
      </div>
      <div class="small-card">
        <input type="submit" name="selectproduct" value="Select Product/Item" class="my-btn">
      </div>
   
   </div>
   <div class="general-banner">

    <div class="small-card">


      <label id="newselectitem">No item selected</label><br>
      <label id="newselectprice">0.00</label><br>
      <!-- add hidden inputs to hold values  -->
   
    </div>
      <div class="small-card">
     <input type="number" name="itemnumber" value="1" class="my-input" id="itemcounter">
       </div>
      <div class="small-card" >
        <input type="submit" value="Add to Reciept" class="my-btn" id="btnaddtorecipt">
      </div>
   </div>


<!-- end of select item -->
 
   
</div>



<!-- start of sale dashboard -->

<div class="scroll-table">
  <div class="table-holder" id="readyreciept">
    <div class="table-caption">
      <hr>
        <center><h3><?php echo $openbusiness; ?></h3></center>
    <hr>
    </div>
  <table id="reciepttable">
    <thead>
      <th>Item </th>
      <th>Count</th>
      <th>Amount</th>
      <th>Action</th>
    </thead>
    <tbody>       
                 
      </tbody>
     </table>
    <!-- totals and all other data -->
    <hr>
    <br>
    <hr>
     <div class="general-banner">
   
      <div class="small-card">
        <center> <label class="my-label">Totals</label><br>
    </center>

     <table style="min-width: 600px;">
       <thead>
        <th>Payment information</th>
         <th>Total</th>
         <th>Discount</th>
         <th>Grand Total</th>
       </thead>
       <tr>
        <td>
          <label><span>Served by : </span> <?php echo $currentUser; ?></label><br>
    <label><span>Date : </span> <?php 
         echo date("Y-m-d h:i:sa");
  ?></label><br>
    <label><span>Sale type : </span> Cash/Deposit</label><br>
        </td>
         <td id="tblpriceholder">0.00</td>
         <td>0.00</td>
         <td id="tblgrandpriceholder">0.00</td>
       </tr>
     </table>

     </div>

  
   </div>

   <hr>
    <br>
    <hr>
    <!-- end other data -->
   
</div>

</div>

<center> <button class="my-btn" id="printer">Make Sale</button> </center>
<!-- end of sale das -->



<br><br><br><br><br><br>
<!-- footer starts -->
<div class="footer">
	 <h3></h3>
   Juelga solution &copy;  &nbsp;&nbsp;<a href="https://www.juelgasolutions.co.tz" style="text-decoration: none; color: #ffffff">juelgasolution </a><br>
   <h3></h3>
</div>

<script type="text/javascript" src="js/sale.js"></script>
</body>
</html>