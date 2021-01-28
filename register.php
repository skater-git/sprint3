<?php
    include("inc/config.php");
    include("inc/header.php");
?>  
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
            function validate() {
                var f1=document.forms['login']['user'].value;
                var f2=document.forms['login']['pass'].value;
                if(f1==null || f1=="" || f2==null || f2=="") {
                    alert("Both fields are necessary. Try again.");
                    return false;
                }
                else {
                    return true;
                }
            }
        </script>
</head>

<body>
	<div id='wrapper'>
    <ul id="nav">
            <li><a href="login.php">Back</a></li>
        </ul>
<div id="loginbox">
			<form action="register.php" method="post" name="register" onsubmit="return validate();">
				<h2>Enter Username And Password</h2>
				<input required pattern=".*\S+.*" type="text" name="user" id='userfield' placeholder="Username">
				<input type="password" name="pass" id='passfield' placeholder="Password">
				<button name="save">Register</button>
			</form>
        </div>
        </div>
        
        <?php
            if(isset($_POST['save'])){
                $username      =mysqli_real_escape_string($con,$_POST['user']);
                $password      = mysqli_real_escape_string($con,$_POST['pass']);;
                if(($username!=="") && ($password!=="")){
                    $sql        = "INSERT INTO admin (uname, password) VALUES('$username', '$password')";
                    $sqlID      = mysqli_query($con,$sql);
                    if($sqlID){
                        echo "<script>location.href='login.php?action=new_user';</script>";
                    }
                    else {
                        echo "<div class='error'>ERROR : ".mysqli_error($con)."</div>";
                    }   
                }                 
            }
            
                ?>
        </body>
</html>