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
        <title>New Post</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            function validate() {
                var title=document.forms['new']['title'].value;
                var content=document.forms['new']['content'].value;
                if(title==null || title=="" || content==null || content=="") {
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
    <?php $id= $_GET['user'];?>
    <div id="wrapper">
        <ul id="nav">
            <li><a href="dashboard.php?user=<?php echo $id; ?>">Back</a></li>
        </ul>
        <?php
       
            if(isset($_POST['save'])){
                
                $title      =mysqli_real_escape_string($con,$_POST['title']);
                $content    =mysqli_real_escape_string($con,$_POST['content']);
                 $author    =mysqli_real_escape_string($con,$id);
                if(($title!=="") && ($content!=="")){
                    $time       =time();
                    $sql        = "INSERT INTO post(title,content,post_author,timestam) VALUES('$title','$content','$author',$time)";
                    $sqlID      = mysqli_query($con,$sql);
                    if($sqlID){
                        echo "<script>location.href='dashboard.php?action=new&user=". $id ."';</script>";
                    }
                    else {
                        echo "<div class='error'>ERROR : ".mysqli_error($con)."</div>";
                    }   
                }                 
            }
            else{
                ?>
                <div id="box">
                <form name="new" action="new_post.php?user=<?php echo $id;?>" method="post" onsubmit="return validate();">
                    <h2>New Post</h2>
                    <br><label for="title">Title:</label> <input required pattern=".*\S+.*" type="text" name="title" id="title" maxlength="50">
                    <br><label for="content">Content</label> <textarea required pattern=".*\S+.*" name="content" id="content"></textarea>
                    <br><button name="save">Post</button>
                </form>
                </div>
            <?php
            }
        ?>
    </div>
    </body>
</html>