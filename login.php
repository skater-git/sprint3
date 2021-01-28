<?php
	include("inc/config.php");
	include("inc/header.php");
	
	if(isset($_GET["logout"])) {
		unset($_SESSION["login"]);
		session_destroy();
		header("Location:login.php?done=logout");
	}
	if(isset($_GET['action'])) {
      if($_GET['action']==="new_user"){
            echo "<div class='success'>User successfully created</div>";
        }
    }
    echo "<br>";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
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
		<?php
		if(isset($_POST['user']) || isset($_POST['pass'])) {
			$username = $_POST['user'];
			if(isset($_POST['user']) && isset($_POST['pass'])) {
				$user   = mysqli_real_escape_string($con,$_POST['user']);
				$pass   = mysqli_real_escape_string($con,$_POST['pass']);
				$sql	= "SELECT * FROM admin WHERE uname='$user' AND password='$pass'";
				$sqlID	= mysqli_query($con,$sql);
				if(mysqli_num_rows($sqlID)===1) {
					$_SESSION["login"] = true;
					echo "<div class='success'>Login successful. Redirecting to Dashboard<script>location.href='dashboard.php?user=". $username ."';</script></div>";
				} else {
					echo "<div class='error'>Incorrect Username and password</div>";
				}
			}
			else {
				echo "<div class='error'>Both fields are required</div>";
			}
		
		}elseif(isset($_GET["done"]) && $_GET["done"]==="logout") {
			echo "<div class='success'>You are now logged out successfully</div>";
		}
		?>
		
		<div id="loginbox">
			<form action="login.php" method="post" name="login" onsubmit="return validate();">
				<h2>Welcome</h2>
				<input type="text" name="user" id='userfield' placeholder="Username">
				<input type="password" name="pass" id='passfield' placeholder="Password">
				<button>Login</button>
			</form>
        </div>
	</div>
	<?php
	
	?>
        <div id="back">
		<a href="register.php"><button id="loginbox" style="background: #06a; color:white; font-size:16px">Register</button></a>
		<br>
		<br>
		<a href="index.php"><button id="back">Back to blog</button></a>
		</div>
</body>
</html>