
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
    
        $query = "SELECT * FROM tbluser LIMIT $start_from, $per_page_record";     
        $rs_result = mysqli_query ($conn, $query);    



?>



<?php 


  // get data to insert
  if(isset($_POST['searchaccount'])){

if($_POST['email'] != ""){
            $newEmail = $_POST['email'];
         
            $query = "SELECT  * FROM tblregister WHERE Email ='$newEmail' OR Idnumber='$newEmail'"; 
                $result = mysqli_query ($conn, $query);    



       if($result== true){ 
 if ($result->num_rows > 0) {
    $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
 } else {
    echo "No Data Found"; 
 }
}else{
  echo  mysqli_error($db);
}



}

    
          
  }


 ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Accounts</title>

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
      <a href="#register.php">Add Staff</a>
      <a href="#link2">Add Role</a>
      <a href="#">Create Acount</a>
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

<!-- search account to add -->

<div class="action-div">
  <form action="createaccount.php" method="POST" name="" id="submitform">
   <center><h3 class="my-label">Search Staff</h3></center>

   <div class="input-holder">
      <div class="card">
        <center>
          <label class="small-label">Entet ID/Email</label><br>
          <input type="text" name="email" placeholder="Enter ID or Email" class="my-input">
          </center>
      </div>
      <div class="card">
         <center>
          <br>
          <input type="submit" name="searchaccount" value="Search now" class="my-btn">
          </center>

      </div>
   </div>


</form>
</div>

<br>
<!-- add account form -->
<div class="action-div">
  <form action="createaccount.php" method="POST" name="" id="submitform">
	 <center><h3 class="my-label">Account management</h3></center>

	 <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">Holders Name</label><br>
          <label>name</label>
          </center>
      </div>
      <div class="card">
      	<center>
      	<label class="small-label">Holder email</label><br>
         <label>email</label>
          </center>
      </div>
   </div>

   <div class="input-holder">
      <div class="card">
      	<center>
          <label class="small-label">ID/Phone</label><br>
         
                
            <label></label><br>
            <label></label>  

         
          </center>
      </div>
      <div class="card">
      	<center>
      	<label class="small-label">Role/Station</label><br>
         <label>Role</label><br>
         <label>Station</label>
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
      
      	
      </div>
   </div>
</form>
</div>


<!-- table -->
<br><br>

<div class="scroll-table">
  <div class="table-holder">
    <div class="table-caption">
      <label class="my-label">List of Accounts/Roles  </label>
    </div>
  <table>
    <thead>
      <th>Account Name</th>
      <th>Role </th>
      <th>Status</th>
    </thead>
    <tbody>   
    <?php     
            while ($row = mysqli_fetch_array($rs_result)) {    
                  // Display each field of the records.    
            ?>     
            <tr>     
             <td><?php echo $row["Username"]; ?></td>     
            <td><?php echo $row["Privilege"]; ?></td>   
            <td><?php 
            if ($row["Status"] == 1) {
              // code...
              echo "Active";
            }else{
              echo "Closed";
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
        $query = "SELECT COUNT(*) FROM tbluser";     
        $rs_result = mysqli_query($conn, $query);     
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];     
          
    echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2){   
            echo "<a href='createaccount.php?page=".($page-1)."'>  Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active' href='createaccount.php?page="  
                                                .$i."'>".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a href='createaccount.php?page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a href='createaccount.php?page=".($page+1)."'>  Next </a>";   
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
        window.location.href = 'createaccount.php?page='+page;   
    }   
  </script>  
</body>
</html>
