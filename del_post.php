<?php
    include("inc/config.php");
    include("inc/header.php");    
    authenticate();
     $username = $_GET['user']; 
    if(isset($_GET['id'])){
        $id     = mysqli_real_escape_string($con,$_GET['id']);
        $query  ="DELETE FROM post WHERE id='$id'";
        $queryID= mysqli_query($con,$query);
        if($queryID){
            echo "<script>location.href='dashboard.php?action=delete&user=".$username."';</script>";
        }
        else {
            echo "<div class='error'>ERROR : ".mysqli_error($con)."</div>";
        }
    } 
?>