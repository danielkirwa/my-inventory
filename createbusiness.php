
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
    
        $query = "SELECT * FROM tblbusiness LIMIT $start_from, $per_page_record";     
        $rs_result = mysqli_query ($conn, $query);    



?>



<?php 


  // get data to insert
  if(isset($_POST['addbusiness'])){
    $newbusinessname = $_POST['businessname'];
    $newotherphone = $_POST['otherphone'];
    $newotheremail = $_POST['otheremail'];
    $newphone = $_POST['phone'];
    $newemail = $_POST['email'];
    $newregion = $_POST['region'];
    $newtown = $_POST['town'];
    $newaddress = $_POST['address'];
     $newslogan = $_POST['slogan'];
     $newdate =  date("Y-m-d");
        if(!empty($_POST['businessname']) && !empty($_POST['address']) && !empty($_POST['phone']) && !empty($_POST['town'])) {
         $newbusinesssql = "INSERT INTO tblbusiness (Businessname, Email,Otheremail,Phone,Otherphone,Region,Town,Address,Slogan,Status,Createdby,Datecreated)
            VALUES ('{$newbusinessname}','{$newemail}','{$newotheremail}','{$newphone}','{$newotherphone}','{$newregion}','{$newtown}','{$newaddress}','{$newslogan}',1, '{$currentUser}','{$newdate}')";


              if ($conn->query($newbusinesssql) === TRUE) {
                 echo "New Business created successfully";
                  header("Refresh:0; url=createbusiness.php");
              } else {
                echo "Error: " . $newbusinesssql . "<br>" . $conn->messaeg;
              }
       
        
    }else{
       echo "<script>alert('Please Fill in The Business name, Address , Town and Phone number');</script>";
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
	  <a href="dashboard.php">Dashboard</a>
  <div class="subnav">
    <button class="subnavbtn" style=" background:  #0067a0;">My Business <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#company">Add Business</a>
      <a href="createcustomer.php">Add Customer</a>
      <a href="createsupplier.php">Add Supplier</a>
    </div>
  </div> 
  <div class="subnav">
    <button class="subnavbtn">Product <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="createproduct.php">Add Product</a>
      <a href="#deliver">Add Units</a>
    </div>
  </div> 
  <div class="subnav">
    <button class="subnavbtn">Stock <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="createstock">Add Stock</a>
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
  <a href="#contact">Settings</a>
  <a href="saledesk.php">Sale Desk</a>
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
  <form action="createbusiness.php" method="POST" name="" id="submitform">
	 <center><h3 class="my-label">Create  Business</h3></center>

	 <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">Business Name</label><br>
          <input type="text" name="businessname" placeholder="Enter Name" class="my-input">
          </center>
      </div>
   </div>

   <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">Phone Number</label><br>
          <input type="text" name="phone" placeholder="+2557xxxxxxx" class="my-input">
          </center>
      </div>
      <div class="card">
      	<center>
      	<label class="small-label">Other Phone Number</label><br>
          <input type="text" name="otherphone" placeholder="+2557xxxxxxx" class="my-input">
          </center>
      </div>
   </div>

    <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">Email </label><br>
          <input type="text" name="email" placeholder="Enter email" class="my-input">
          </center>
      </div>
      <div class="card">
      	<center>
      	<label class="small-label">Other Email</label><br>
          <input type="text" name="otheremail" placeholder="Enter other email" class="my-input">
          </center>
      </div>
   </div>



     <div class="input-holder">
      <div class="card">
        <center>
          <label class="small-label">Business Address </label><br>
          <input type="text" name="address" placeholder="Enter Business Address" class="my-input">
          </center>
      </div>
   </div>


     <div class="input-holder">
      <div class="card">
        <center>
          <label class="small-label">Location (Region) </label><br>
          <input type="text" name="region" placeholder="Enter Business Region" class="my-input">
          </center>
      </div>
      <div class="card">
        <center>
        <label class="small-label">Location (Town)</label><br>
          <input type="text" name="town" placeholder="Enter Business Town" class="my-input">
          </center>
      </div>
   </div>
 
   

     <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">Business Slogan</label><br>
          </center>
          <textarea name="slogan" rows="4" cols="40" placeholder="Business slogan here ..."></textarea>
      </div>
   </div>


   <div class="input-holder">
      <div class="card">
      	<center>
          <input type="submit" name="addbusiness" value="Save Business" class="my-btn">
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
      <label class="my-label">Available Business  </label>
    </div>
  <table>
    <thead>
      <th>Business name</th>
      <th>Email </th>
      <th>Phone</th>
      <th>Adress</th>
      
    </thead>
    <tbody>   
    <?php     
            while ($row = mysqli_fetch_array($rs_result)) {    
                  // Display each field of the records.    
            ?>     
            <tr>     
             <td><?php echo $row["Businessname"]; ?></td>     
            <td><?php echo $row["Email"]; ?></td>   
            <td><?php echo $row["Phone"]; ?></td>   
            <td><?php echo $row["Address"]; ?></td>                                            
            </tr>     
            <?php     
                };    
            ?>     
          </tbody>
     </table>

<!-- pages -->
<div class="pagination">    
      <?php  
        $query = "SELECT COUNT(*) FROM tblbusiness";     
        $rs_result = mysqli_query($conn, $query);     
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];     
          
    echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2){   
            echo "<a href='createbusiness.php?page=".($page-1)."'>  Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active' href='createbusiness.php?page="  
                                                .$i."'>".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a href='createbusiness.php?page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a href='createbusiness.php?page=".($page+1)."'>  Next </a>";   
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
        window.location.href = 'createbusiness.php?page='+page;   
    }   
  </script>  
</body>
</html>
