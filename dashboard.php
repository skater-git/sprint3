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
            <li><a href='index.php'target="_blank">View Blog</a></li>
            <li><a href='new_post.php?user=<?php echo $username; ?>'>New Post</a></li>
            <li><a href='new_category.php?user=<?php echo $username; ?>'>New Category</a></li>
            <li><a href='delete_category.php?user=<?php echo $username; ?>'>Delete Category</a></li>
            <li><a href='login.php?logout'>Logout</a></li>
        </ul>
    <h2 class="text-center">Manage Posts</h2>
    <div class="clear"></div>    
    <?php
      
    if(isset($_GET['action'])) {
        if($_GET['action']==="delete"){
            echo "<div class='success'>Post successfully deteted</div>";
            
        }
        else if($_GET['action']==="new"){
            echo "<div class='success'>Post successfully saved</div>";
        }
        else if($_GET['action']==="new_user"){
            echo "<div class='success'>User successfully created</div>";
        }
        else if($_GET['action']==="update"){
            echo "<div class='success'>Post successfully updated</div>";
        }
        else if($_GET['action']==="new_category"){
            echo "<div class='success'>Category successfully saved</div>";
        }
        else if($_GET['action']==="del_category"){
            echo "<div class='success'>Category successfully deteted</div>";
        }
    }
    echo "<br>";
    
    $sql= "SELECT * FROM post ORDER BY timestam";
    $sqlID= mysqli_query($con,$sql);
    if(mysqli_num_rows($sqlID)!=0){
        echo "
            <table border='0' class='tbl' cellspacing='0' cellpadding='0'>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Post</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>";
            while($row=mysqli_fetch_array($sqlID)){
            $id=$row['id'];
                echo "
                    <tr>
                        <td><a href='index.php?id=".$id."' target='_blank'>".$row['title']."</a></td>
                        <td class='text-center'>".$row['category_name']."</td>
                        <td>".substr($row['content'],-30)."</td>
                        <td class='text-center'>".@date('Y-m-d H:i:s',$row['timestam']+7200)."</td>
                        <td class='text-center'><a href='del_post.php?id=".$row['id']."&user=".$username."'>Delete</a> / <a href='edit_post.php?id=".$row['id']."&user=".$username."'>Edit</a></td>
                    </tr>";
                }
            echo "</table>";
        }
    else{
        echo "<div class='error'>No Posts Found</div>";
    }
    ?>
    </div>
    </body>
</html>