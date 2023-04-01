<?php 
   require_once('php/connection.php');

 ?>

   <?php 
     // login button 
         session_start();
        if(isset($_POST['logintoaccount'])){
             
            if($_POST['username'] != "" && $_POST['userpassword'] != ""){
            $newUserName = $_POST['username'];
            $NewPassword = md5($_POST['userpassword']);
             echo $NewPassword;
     
            $query = "SELECT Username,Privilege FROM tbluser WHERE Username='$newUserName' AND Password='$NewPassword'"; 
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
              // output data of each row
              if($row = $result->fetch_assoc()) {

                $_SESSION['username'] = $row["Username"];
               $_SESSION['privillege'] = $row['Privilege'];
                
   
                if($_SESSION['privillege'] == "User"){
                header("Refresh:1; url=dashboard.php");

               }

               if($_SESSION['privillege'] == "Admin"){
                header("Location:dashboard.php");

               }
               if($_SESSION['privillege'] == "none"){
                echo '<script>alert ("Your account was Disable")</script>';

               }
              }
            } else {
              echo "<script>alert('Incorrect login details');</script>";
            }


                }else{
           echo "<script>alert('Fill in all you login details');</script>";
        }
 
           

        }
   ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login now</title>
	<link rel = "icon" href = "assets/logo/juelgaicon.png" type = "image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div>
    <div class="banner">
    	<div class="vender-logo"><img src="assets/logo/juelgaicon.png"> </div>
    	<div class="shop-name"><center><h3>Juelga Distributions</h3></center></div>
    </div>
</div>

<!-- login  -->
<div class="dash-holder">
	 <div class="login-form">
	 	<center><h3>Log now</h3></center>
        <div>
        	<form action="index.php" method="POST" name=""><center>
        	<label class="my-label">Username</label><br><br>
        	<input type="" name="username" placeholder="Enter Username" class="my-input"><br><br>
        	<label class="my-label">Password</label><br><br>
        	<input type="password" name="userpassword" placeholder="***********" class="my-input"><br><br>
        	<input type="submit" name="logintoaccount" value="Login Now" class="login-btn"><br><br>
        	</center>
        	</form>
        </div>
	 </div>

</div>

<!-- end of login -->
<div class="footer">
	 <h3></h3>
   Juelga solution &copy;  &nbsp;&nbsp;<a href="https://www.juelgasolutions.co.tz" style="text-decoration: none; color: #ffffff">juelgasolution </a><br>
   <h3></h3>
</div>
</body>
</html>