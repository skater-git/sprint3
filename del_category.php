<?php
include("inc/config.php");
include("inc/header.php");    
authenticate();
$category = $_GET['category'];
 $username = $_GET['user']; 
    if(isset($_GET['id'])){
        $id     = mysqli_real_escape_string($con,$_GET['id']);
        $query  ="DELETE FROM categories WHERE id='$id'";
        $queryID= mysqli_query($con,$query);
        if($queryID){
            echo "<script>location.href='dashboard.php?action=del_category&user=".$username."';</script>";
        }
        else {
            echo "<div class='error'>ERROR : ".mysqli_error($con)."</div>";
        }
    }
    $sql_emp = "UPDATE post SET category_name ='' WHERE category_name ='$category'";
if (mysqli_query($con, $sql_emp)) {
    echo "<script>location.href='dashboard.php?action=del_category&user=".$username."';</script>";
} else {
    echo "<div class='error'>ERROR : " . mysqli_error($con)."</div>";
} 
?>