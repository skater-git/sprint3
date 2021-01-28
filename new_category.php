<?php
    include("inc/config.php");
    include("inc/header.php");
    authenticate();
?>   
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>New Category</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            function validate() {
                var category=document.forms['new_category']['title'].value;
                if(category==null || category=="") {
                    alert("Field are necessary. Try again.");
                    return false;
                }
                else {
                    return true;
                }
            }
        </script>
    </head>
    <body>
    <?php $username = $_GET['user']; ?>
    <div id="wrapper">
        <ul id="nav">
            <li><a href="dashboard.php?user=<?php echo $username;?>">Back</a></li>
        </ul>
        <?php
            if(isset($_POST['save'])){
                $category      =mysqli_real_escape_string($con,$_POST['category_name']);
                if(($category!=="")){
                    $sql        = "INSERT INTO categories (c_name) VALUES('$category')";
                    $sqlID      = mysqli_query($con,$sql);
                    if($sqlID){
                        echo "<script>location.href='dashboard.php?action=new_category&user=". $username . "';</script>";
                    }
                    else {
                        echo "<div class='error'>ERROR : ".mysqli_error($con)."</div>";
                    }   
                }                 
            }
            else{
                ?>
                <div id="box">
                <form name="new_category" action="new_category.php?user=<?php echo $username; ?>" method="post" onsubmit="return validate();">
                    <h2>New Category</h2>
                    <br><label for="category_name">Category:</label> <input required pattern=".*\S+.*" type="text" name="category_name" id="title" maxlength="30">
                    <br><button name="save">Post</button>
                </form>
                </div>
            <?php
            }
        ?>
    </div>
    </body>
</html>