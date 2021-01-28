<?php
	include("inc/config.php");
	include("inc/header.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blog</title>
	<link href="style_blog.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php

		$sql= "SELECT * FROM categories";
$sqlID= mysqli_query($con,$sql);
if(mysqli_num_rows($sqlID)!=0){
	while($row=mysqli_fetch_array($sqlID)) {
	?>
<div id="wrapper">
        <ul id="nav">
		<li><a href='index.php?name=<?php echo $row['c_name'] ?>'><?php echo $row['c_name']; ?></a>
		</li>
		<?php
	}
	?>
	</ul>
	</div>
	<?php
}
?>						
	<?php 
						if(isset($_GET['name'])){
							?>
							<div id="wrapper">
							<div id="header">
							<a href="index.php">
							<h1>WEB Programming</h1>
							<h2>Coding and hacking...</h2>
							</a>
							<?php
                        $name = $_GET['name'];
                          $sql__ = "SELECT * FROM post WHERE category_name =('$name') ORDER BY timestam DESC";
						  $results = mysqli_query($con,$sql__);
						  if(mysqli_num_rows($results)>0){
							while($row=mysqli_fetch_array($results)) {
							?>
							
							<div id="content">
							<div id="main">
								<div class="post">
									<div class="timestamp">
										<?php echo date('d M Y',$row['timestam']); ?>
									</div>
									<h2 style="color:black; font-size:28px;  font-family: 'Arial',sans-serif; font-weight:bold; letter-spacing: -1px;">
										<?php echo $row['title']; ?>
									</h2>
									<div class='entry'>
										<?php echo nl2br($row['content']); ?>
									</div>
									<div>
									posted by &copy; <?php echo $row['post_author'];?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<div>
							<?php
							}
							} 
						} else {
							
						?>
						<?php 
						if(isset($_GET['id'])){
                        $id = $_GET['id'];
			$sqlID= mysqli_query($con,$sql);
			$sqlID= mysqli_query($con,$sql);
                          $sql_ = "SELECT * FROM post WHERE id =('$id') ";
						  $result = mysqli_query($con,$sql_);
						  if(mysqli_num_rows($result)>0){
							while($row=mysqli_fetch_array($result)) {
							?>
							<div id="wrapper">
							<div id="header">
		
							<a href="index.php">
							<h1>WEB Programming</h1>
							<h2>Coding and hacking...</h2>
							</a>
		
							</div>
							<div id="content">
							<div id="main">
								<div class="post">
									<div class="timestamp">
										<?php echo date('d M Y',$row['timestam']); ?>
									</div>
									<h2>
										<?php echo $row['title']; ?>
									</h2>
									<div class='entry'>
										<?php echo nl2br($row['content']); ?>
									</div>
									<div>
									posted by &copy; <?php echo $row['post_author'];?>
									</div>
								</div>
							<?php
							}
							} 
						} else {
							
						?> 
						  
<div id="wrapper">
	<div id="header">
		
		<a href="index.php">
			<h1>WEB Programming</h1>
			<h2>Coding and hacking...</h2>
		</a>
	</div>
	<div id="content">
		<div id="main">
			
		<?php
		
					$sql= "SELECT * FROM post ORDER BY timestam DESC";
			$sqlID= mysqli_query($con,$sql);
			if(mysqli_num_rows($sqlID)!=0){
				while($row=mysqli_fetch_array($sqlID)) {
				?>
					<div class="post">
						<div class="timestamp">
							<?php echo date('d M Y',$row['timestam']); ?>
						</div>
						<h2>
						<a href='index.php?id=<?php echo $row['id'] ?>'><?php echo $row['title']; ?></a>
						</h2>
						<div class='entry'>
							<span><?php echo nl2br($row['content']); ?></span>
						</div>
						<div>
							posted by &copy; <?php echo $row['post_author']?>
					</div>
					</div>
				<?php
				}
			} else {
				echo "<div class='error'>No Posts Found</div>";
			}
		
		?>
				</div>
        </div>			
    </div>
	<?php
}
?>
</div>
<?php
}
?>
</body>
</html>