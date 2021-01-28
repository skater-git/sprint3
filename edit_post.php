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
        <title>Edit Post </title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            function validate() {
                var f1=document.forms['edit']['title'].value;
                var f2=document.forms['edit']['content'].value;
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
    <?php $username = $_GET['user']; ?>
    <div id="wrapper">
        <ul id="nav">
            <li><a href="dashboard.php?user=<?php echo $username;?>">Back</a></li>
        </ul>
        <?php
            
            if(isset($_GET['id'])){
                if(isset($_POST['update'])) {
                    $id     = mysqli_real_escape_string($con,$_GET['id']);
                    $title      = mysqli_real_escape_string($con,$_POST['title']);
                    $content= mysqli_real_escape_string($con,$_POST['content']);
                    $category= mysqli_real_escape_string($con,$_POST['category_name']);
                    if(($title!=="") && ($content!=="")){
                        $time   = time();
                        $sql    = "UPDATE post SET title='$title', content='$content',category_name='$category', timestam=$time WHERE id=$id";
                        $sqlID  = mysqli_query($con,$sql);
                        if(mysqli_error($con)==="") {
                            echo "<script>location.href='dashboard.php?action=update&user=". $username . "';</script>";
                        } else {
                            echo "<div class='error'>ERROR : ".mysqli_error($con)."</div>";
                        }
                    }
                }
                else {
                    $id     = mysqli_real_escape_string($con,$_GET['id']);
                    $query  = "SELECT title,content FROM post WHERE id='$id'";
                    $queryID= mysqli_query($con,$query);
                    $row    = mysqli_fetch_array($queryID);
                    if(mysqli_num_rows($queryID)===1) {
                    
                    ?>
                        <div id="box">
                        <form action="edit_post.php?id=<?php echo $id; ?>&user=<?php echo $username;?>" method="post" name="edit" onsubmit="return validate();">
                            <h2>Edit Post</h2>
                            <br><label for="title">Title:</label> <input required pattern=".*\S+.*" type="text" name="title" id="title" maxlength="50" value="<?php echo $row['title']; ?>">
                            <br><label for="content">Content:</label> <textarea name="content" id="content"><?php echo $row['content']; ?></textarea>
                            <input required pattern=".*\S+.*" name="update" value="true" type="hidden">
                            <div>
                            <label for="c_id">Choose the category:</label>
                            <select id="c_id" name="category_name">
                             <option selected="selected" disabled="disabled">Select a Category</option>
                            <?php
            
                                 $sql= "SELECT * FROM categories";
                                 $sqlID= mysqli_query($con,$sql);
                                 if(mysqli_num_rows($sqlID)!=0){
                                  while($row=mysqli_fetch_array($sqlID)) {
                                 
                             print('<option value="' . $row['c_name'] . '">' . $row['c_name'] . '</option>');
                         }
                         ?>
                         <?php
                         }
                         ?>
                    </select>
                     </div> 
                     <br>
                            <input type="submit" value="Update">
                        </form>
                        </div>
                    <?php
                        } else {
                            echo "<div class='error'>The post cannot be edited</div>"; 
                            }
                    } 
                }
        ?>
    </div>
    </body>
</html>
