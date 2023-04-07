
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




// select all staff if any 

  $per_page_record = 4;  // Number of entries to show in a page.   
        // Look for a GET variable page if not found default is 1.        
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
          $page=1;    
        }    
    
        $start_from = ($page-1) * $per_page_record;     
    
        $query = "SELECT * FROM tblstock LIMIT $start_from, $per_page_record";     
        $rs_result = mysqli_query ($conn, $query);    



?>



<?php 


  // get data to insert
  if(isset($_POST['addstock'])){
    $newname = $_POST['stockname'];
    $newcode = $_POST['code'];
    $newdescription = $_POST['description'];
    $newunitcount = $_POST['unitcount'];
    $newunitsale = $_POST['unitsale'];
    $newclearby = $_POST['clearby'];
    $newunit;
     $newdate =  date("Y-m-d");
 if(!empty($_POST['unit'])){
        $newtype = $_POST['unit'];
        if(!empty($_POST['stockname']) && !empty($_POST['code']) && !empty($_POST['unitsale'])  && !empty($_POST['unitcount'])) {
         $newstocksql = "INSERT INTO tblstock (Suppliername, Supplierphone,Supplierotherphone,Supplieremal,Supplieraddress,Supplierregion,Supplierdistrict,Suppliertown,Suppliertype,Datecreated,Status,Createdby,Suppliercode)
            VALUES ('{$newname}','{$newphone}','{$newotherphone}','{$newemail}','{$newaddress}','{$newregion}','{$newdistrict}','{$newtown}','{$newtype}','{$newdate}',1 ,'{$currentUser}','$newcode')";


              if ($conn->query($newsuppliersql) === TRUE) {
                 echo "<script>alert('New Supplier added successfully');</script>";
                  header("Refresh:0; url=createsupplier.php");
              } else {
                echo "Error: " . $newsuppliersql . "<br>" . $conn->messaeg;
              }
       
        
    }else{
       echo "<script>alert('Please Fill in The Supplier name, Code and Phone number');</script>";
    }
    } else {
      echo "<script>alert('Please select the Type of the supplier');</script>";
    }
 
  }


 ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Customer</title>

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
    <button class="subnavbtn" style=" background:  #0067a0;">Stock <i class="fa fa-caret-down"></i></button>
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
<!-- end of nav bar -->
<div class="action-div">
  <form action="createstock.php" method="POST" name="" id="submitform">
	 <center><h3 class="my-label">Stock management</h3></center>

	 <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">Stock Name</label><br>
          <input type="text" name="stockname" placeholder="Enter stock name" class="my-input">
          </center>
      </div>
      <div class="card">
        <center>
          <label class="small-label">Stock Code</label><br>
          <input type="text" name="code" placeholder="Enter code eg. S101D" class="my-input">
          </center>
      </div>
   </div>

   <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">Description</label><br>
           </center>
          </textarea>
          <textarea name="description" rows="4" cols="40" placeholder="Describe stock here..."></textarea>
         
      </div>
         </div>

    <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">Unit Measure </label><br>
          <select class="my-input" name="unit">
            <option value="Kg">option one</option>
            <option value="Grams">option two</option>
          </select>
          </center>
      </div>
      <div class="card">
      	<center>
      	<label class="small-label">Unit Count</label><br>
          <input type="text" name="unitcount" placeholder="Unit count" class="my-input">
          </center>
      </div>
   </div>
 
    <div class="input-holder">
            <div class="card">
        <center>
        <label class="small-label">Units to Sale</label><br>
          <input type="text" name="unitsale" placeholder="Units to sale" class="my-input">
          </center>
      </div>
       <div class="card">
        <center>
        <label class="small-label">Clear Date</label><br>
          <input type="date" name="clearby" class="my-input">
          </center>
      </div>


   </div>






   <div class="input-holder">
      <div class="card">
      	<center>
          <input type="submit" name="addstock" value="Save Supplier" class="my-btn">
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
      <label class="my-label">List of Suppliers  </label>
    </div>
  <table>
    <thead>
      <th>Supplier Name</th>
      <th>Email </th>
      <th>Phone</th>
      <th>Location</th>
      <th>Type</th>
      <th>Status</th>
    </thead>
    <tbody>   
    <?php     
            while ($row = mysqli_fetch_array($rs_result)) {    
                  // Display each field of the records.    
            ?>     
            <tr>     
             <td><?php echo $row["Suppliername"]; ?></td>     
            <td><?php echo $row["Supplieremal"]; ?></td>   
            <td><?php echo $row["Supplierphone"]; ?></td>   
            <td><?php echo $row["Suppliertown"]; ?></td>
            <td><?php echo $row["Suppliertype"]; ?></td>   
            <td><?php 
                  if ($row["Status"] == 1) {
                    // code...
                    echo "Active";
                  }else{
                    echo "Dormant";
                  }
             ?></td>                                              
            </tr>     
            <?php     
                };    
            ?>     
          </tbody>
     </table>

<!-- pages -->
<div class="pagination">    
      <?php  
        $query = "SELECT COUNT(*) FROM tblstock";     
        $rs_result = mysqli_query($conn, $query);     
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];     
          
    echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2){   
            echo "<a href='createstock.php?page=".($page-1)."'>  Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active' href='createstock.php?page="  
                                                .$i."'>".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a href='createstock.php?page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a href='createstock.php?page=".($page+1)."'>  Next </a>";   
        }   
  
      ?>    
      </div>  
  
  
      <div class="inline">   
      <input id="page" type="number" min="1" max="<?php echo $total_pages?>"   
      placeholder="<?php echo $page."/".$total_pages; ?>" required>   
      <button onClick="go2Page();">Go</button>   
     </div>    

     <!-- end of pages -->


  </div>
</div>



<br><br><br><br>
<!-- footer starts -->
<div class="footer">
	 <h3></h3>
   Juelga solution &copy;  &nbsp;&nbsp;<a href="https://www.juelgasolutions.co.tz" style="text-decoration: none; color: #ffffff">juelgasolution </a><br>
   <h3></h3>
</div>



  <script>   
    function go2Page()   
    {   
        var page = document.getElementById("page").value;   
        page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
        window.location.href = 'createstock.php?page='+page;   
    }   
  </script>  
</body>
</html>
