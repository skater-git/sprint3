<?php
    include("inc/config.php");
    include("inc/header.php");    
    authenticate();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <?php $username = $_GET['user']; ?>
    <div id="wrapper">
        <ul id="nav">
            <li><a href="dashboard.php?user=<?php echo $username;?>">Back</a></li>
        </ul>
        <?php
    $sql= "SELECT * FROM categories";
    $sqlID= mysqli_query($con,$sql);
    if(mysqli_num_rows($sqlID)!=0){
        echo "
            <table border='0' class='tbl' cellspacing='0' cellpadding='0'>
                <tr>
                    <th>Category</th>
                    <th>Action</th>
                </tr>";
            while($row=mysqli_fetch_array($sqlID)){
            $id=$row['id'];
                echo "
                    <tr>
                        <td class='text-center'>".$row['c_name']."</td>
                        <td class='text-center'><a href='del_category.php?id=".$row['id']."&user=".$username."&category=".$row['c_name']."'>Delete</a></td>
                    </tr>";
                }
            echo "</table>";
        } else{
            echo "<div class='error'>No Categories Found</div>";
        }
        ?>