
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
    
        $query = "SELECT * FROM tblproduct LIMIT $start_from, $per_page_record";     
        $rs_result = mysqli_query ($conn, $query);    



?>


<!-- serach stock to create -->
<?php 


  // get data to insert
  if(isset($_POST['searchstock'])){

if($_POST['code'] != ""){
            $newcode = $_POST['code'];
         
            $query = "SELECT  * FROM tblstock WHERE Stockcode ='$newcode' OR Stockname='$newcode'";
                $searchresult = mysqli_query ($conn, $query);    
               } 
        }else{

        }


 ?> 



<?php 


  // get data to insert
  if(isset($_POST['addsupplier'])){
    $newname = $_POST['firstname'];
    $newaddress = $_POST['address'];
    $newphone = $_POST['phone'];
    $newemail = $_POST['email'];
    $newotherphone = $_POST['otherphone'];
    $newregion = $_POST['region'];
    $newdistrict = $_POST['district'];
    $newtown = $_POST['town'];
    $newcode = $_POST['code'];
    $newtype;
     $newdate =  date("Y-m-d");
 if(!empty($_POST['type'])){
        $newtype = $_POST['type'];
        if(!empty($_POST['firstname']) && !empty($_POST['phone']) && !empty($_POST['code'])  && !empty($_POST['town'])) {
         $newsuppliersql = "INSERT INTO tblsupplier (Suppliername, Supplierphone,Supplierotherphone,Supplieremal,Supplieraddress,Supplierregion,Supplierdistrict,Suppliertown,Suppliertype,Datecreated,Status,Createdby)
            VALUES ('{$newname}','{$newphone}','{$newotherphone}','{$newemail}','{$newaddress}','{$newregion}','{$newdistrict}','{$newtown}','{$newtype}','{$newdate}',1 ,'{$currentUser}')";


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
	<title>Product</title>

		<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" type="text/css" href="css/elements.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <button class="subnavbtn" style=" background:  #0067a0;">Product <i class="fa fa-caret-down"></i></button>
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
<!-- end of nav bar -->

<div class="action-div">
  <form action="createproduct.php" method="POST" name="" id="submitform">
   <center><h3 class="my-label">Search Stock to create products</h3></center>

   <div class="input-holder">
      <div class="card">
        <center>
          <label class="small-label">Entet Code/name</label><br>
          <input type="text" name="code" placeholder="Enter stock code or Name" class="my-input">
          </center>
      </div>
      <div class="card">
         <center>
          <br>
          <input type="submit" name="searchstock" value="Search now" class="my-btn">
          </center>

      </div>
   </div>


</form>
</div>

<!-- create product -->
<div class="action-div">
  <form action="createproduct.php" method="POST" name="" id="submitform">
     <?php  
           if(isset($_POST['searchstock'])){

            if ($isTouch = empty($searchresult)) {
              // code...
            }else{
   
            if($row = $searchresult->fetch_assoc()) { 
                  // Display each field of the records.
              
            ?>   
   <center><h3 class="my-label"><?php echo  $row["Stockname"] ?> &nbsp; product creation</h3></center>

   <div class="input-holder">
      <div class="card">
        <center>
          <label class="small-label">Stock Name</label><br>
          <label><?php echo "Full Name :  ".$row["Stockname"]; ?></label>
          </center>
      </div>
      <div class="card">
        <center>
        <label class="small-label">Stock CODE</label><br>
        <input type="hidden" name="stockcode" value="<?php echo $row["Stockcode"]; ?>">
         <label><?php echo "CODE :  ".$row["Stockcode"]; ?></label>
          </center>
      </div>
   </div>

   <div class="input-holder">
      <div class="card">
        <center>
          <label class="small-label">Available Units</label><br>
             
            
               <input type="hidden" name="saleunits" value="<?php echo $row["Saleunits"]; ?>">
                 <label><?php echo "Available Units : ".$row["Saleunits"]; ?></label><br> 
          </center>
      </div>
      <div class="card">
        <center>
        <label class="small-label">Created By</label><br>
        <input type="hidden" name="Createdby" value="<?php echo $row["Createdby"]; ?>">
         <label><?php echo "Author :  ".$row["Createdby"]; ?></label><br>
          </center>
      </div>
   </div>

   <div class="input-holder">
      <div class="card">
        <center>
          <label class="small-label">Buying Price</label><br>
         <input type="text" name="buying" value="" class="my-input">
          </center>
      </div>
      <div class="card">
        <center>
        <label class="small-label">Selling Price </label><br>
        <input type="text" name="selling" value="" class="my-input">
          </center>
      </div>
   </div>


   <div class="input-holder">
      <div class="card">
        <center>
          <input type="submit" name="addaccount" value="Create Account" class="my-btn">
          </center>
      </div>
      <div class="card">
        <center>
         <label><?php echo "Product will created out of   ".$row["Stockname"] . " and should be sold by  " .$row["Cleardate"]; ?></label><br>
          </center>
      </div>
   </div>
             <?php     
                }; 
              };
                };   
            ?> 
</form>
</div>



<!-- table -->
<br><br>

<div class="scroll-table">
  <div class="table-holder">
    <div class="table-caption">
      <label class="my-label">List of products  </label>
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
                    echo "Instock";
                  }else{
                    echo "Out of stock";
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
        $query = "SELECT COUNT(*) FROM tblproduct";     
        $rs_result = mysqli_query($conn, $query);     
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];     
          
    echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2){   
            echo "<a href='createproduct.php?page=".($page-1)."'>  Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active' href='createproduct.php?page="  
                                                .$i."'>".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a href='createproduct.php?page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a href='createproduct.php?page=".($page+1)."'>  Next </a>";   
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
        window.location.href = 'createproduct.php?page='+page;   
    }   
  </script>  
</body>
</html>
