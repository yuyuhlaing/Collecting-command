<?php session_start();
	include("includes/db.php"); 
	 $login_err='';
	 if(isset($_GET['login_error'])){
	 	if($_GET['login_error']=='empty'){
	 		$login_err='<div class="alert alert-danger">User name or Password was empty!</div>';
	 	}elseif($_GET['login_error']=='wrong'){
	 		$login_err='<div class="alert alert-danger">User name or Password was wrong!</div>';
	 	}
	 }


	 $per_page=4;
	 if(isset($_GET['page'])){
	 	$page=$_GET['page'];
	 }else{
	 	$page=1;
	 }
	 $start_from=($page-1)*$per_page;
	

?>
<?php
  
  include 'includes/db.php';
  if(isset($_POST['submit_login']))
  {
  	if(!empty($_POST['email']) && !empty($_POST['password']))
  	{
  		$get_user_name=mysqli_real_escape_string($conn,$_POST['email']);
  		$get_password=mysqli_real_escape_string($conn,$_POST['password']);
  		$sql="SELECT * FROM userlist WHERE Email='$get_user_name' AND Password='$get_password'";
  		if($result=mysqli_query($conn,$sql))
  		{
  			if(mysqli_num_rows($result)==1)
  			{
          $_SESSION['user']=$get_user_name;
          $_SESSION['password']=$get_password;

  				header('Location: newpost.php');
  			}
  			else
  			{
  			header('Location: login.php?login_error=wrong');

  			}
  		}
    
  	  	else
  			{
  				header('Location: login.php?login_error=query_error');
  			}
  	}
  		else
  		{
  			header('Location: login.php?login_error=empty');
  		}
  }
?>
<html>
	<head>
		<title>Myanmar Charities Connection</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="../../bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.css">
		<script type="../../js/jquery.js"></script>
		<script type="../../bootstrap/js/bootstrap.js"></script>
		<style type="text/css">
			.container .container_style{
				font-family: Zawgyi-One, Georgia;
				line-height: 1.8em;
			}

		</style>

	</head>
	<body>
		

		
		<header class="navbar navbar navbar-static-top" height="150px" id="header_design">
			<div class="container">
					
						<div style="float:left;">
						<a class="navbar-brand" rel="home" href="#" title="Brand" style="padding-top: 20px; padding-bottom: 10px">
        				<img style="height: 80px; width:150px;" src="mc2.png">
    					</a></div>
    					
						<div style="height:110px;">
						<a href="index.php"  class="navbar-brand" style="padding-top:48px;font-size:30px; color:#B9CE21;">
						Myanmar Charities Connection</a></div>
						
					
				
			<div style="padding-top:10px;">	
				<ul id="navmenu" class="nav navbar-nav navbar-left">
					<li class="active"><a href="index.html">Home</a></li>
					<li ><a href="news.php">News</a></li>
						
						
						<li class="dropdown" ><a data-toggle="dropdown" class="dropdown-toggle">Projects<span class="downarrow">  &#9660; </span></a>
							
							<ul  class="dropdown-menu" class="dropdown_menu">
								<li><a href="education.php">Education</a></li>

								<li><a href="water.php">Water</a></li>
								<li><a href="disability.php">Disability</a></li>

							</ul>

						</li>
						<li><a href="volunteerlist.php">Volunteers</a></li>
						<li><a href="charitylist.php">Charities</a></li>
						<li><a href="aboutus.php">About us</a></li>
						<li><a href="Contact.php">Contact us</a></li>
						<li><a href="register.php">Registration</a></li>
					</ul>
					</div>
				</div>
			</header>
			<div  class="container" >
				<div class="container_style">
					<?php echo $login_err; ?>
				 	<section class="col-lg-8">
				 		
				 		
				 		<?php 
						
							$sel_sql1="SELECT * FROM posts WHERE category='Education' ORDER BY id DESC LIMIT $start_from,$per_page";
							$run_sql1=mysqli_query($conn,$sel_sql1);
							while($rows=mysqli_fetch_assoc($run_sql1)){
								
										echo ' 
											<div class="panel panel-success">
												<div class="panel-heading">
													<h3>'.$rows['title'].'</h3>
												</div>
												<div class="panel-body">
													<div class="col-lg-4">

														<img src="'.$rows['image'].'" width="100%">
													</div>
													<div calss="col-lg-8">
														<p>'.substr($rows['description'],0, 350).'</p>
													</div>
													<a href="post.php?post_id='.$rows['id'].'" class="btn btn-primary">Read More</a>
												</div>
											</div>
											';
									
								}
						?>
</section>	
				 	<aside class="col-lg-4">
				 		<form class="panel-group form-horizontal" role="form" method="post" >
				 				<div class="panel panel-default">
				 					<div class="panel-heading" style="background-color:#D6E9C6;text-align:center;color:#3C763D;"><p>If you wanna post, you <b>must</b></p><h1>Login</h1></div>
				 					<div class="panel-body">
				 						<div class="form-group">
				 							<label for="username" class="control-label col-sm-5">User Name</label>
				 							<div class="col-sm-7">
				 								<input type="text" id="username" placeholder="Enter Email Address" class="form-control" name="email">
				 							</div>
				 						</div>
				 						<div class="form-group">
				 						<label for="password" class="control-label col-sm-5">Password</label>
				 							<div class="col-sm-7">
				 								<input type="password" id="password" placeholder="Enter Your Password" class="form-control" name="password">
				 							</div>
				 						</div>
				 						<div class="form-group">
				 						<label for="sumbit" class="control-label col-sm-5"></label>
				 							<div class="col-sm-7">
				 								<input type="submit" id="submit"  class="btn btn-success btn-block" value="Submit" name="submit_login">
				 							</div>
				 						</div>
				 					</div>
				 					</div>
				 					<div class="panel panel-default">
				 					 	<div class="panel-body">
				 						 	<div class="form-group">
				 								<div>
				 									<label for="register" class="control-label">If you didn't register,register here</label>
				 								</div>
				 								<label for="sumbit" class="control-label col-sm-5"></label>
				 							<div class="col-sm-7">
				 								<a href="register.php"><input type="button" id="register" style="text-decoration:none;" value="Register" class="btn btn-success btn-block"></a>
				 							</div>
				 						</div>
				 						</div>
				 					</div>
				 				
				 			</form>
				 		<?php 
						
							$sel_sql="SELECT * FROM category ";
							$run_sql=mysqli_query($conn,$sel_sql);
							while($rows=mysqli_fetch_assoc($run_sql)){
								if($rows['category_name']=='Education')
				 				{
								echo ' 
									<div class="panel panel-default">
										<div class="panel-heading">
											<h3>'.$rows['category_name'].' In Myanmar</h3>
										</div>
										<div class="panel-body">
											
											<div calss="col-lg-4">
												<p>'.substr($rows['category_description'],0, 1900).'</p>
											</div>
											<a href="post1.php?post_id='.$rows['id'].'" class="btn btn-primary">Read More</a>
										</div>
									</div>
									';
									}
								}
							?>
				 		</aside>

				 		<div class="text-center">
					<ul class="pagination" >
						<?php
							$pagination_sql="SELECT * from posts WHERE category='Education'";
							$run_pagination=mysqli_query($conn,$pagination_sql);
							$count=mysqli_num_rows($run_pagination);
							$total_pages=ceil($count/$per_page);

							for($i=1;$i<=$total_pages;$i++){
								echo '<li ><a href="login.php?page='.$i.'">'.$i.'</a></li>';
							}
						?>
					</ul>
				</div>
			</div>
			

		</div>
		
	
		<footer class="navbar navbar navbar-auto-bottom">
			<div class="container">
					<div style="margin-left:5px;">
						<div id="footer1">
							<h4>Navigation</h4>
							<ul>
								<li><a href="index.html" >Home</a></li>
								<li><a href="news.php" >News</a></li>
								<li><a href="volunteerlist.php" >Volunteers</a></li>
							</ul>
							<ul>
								
								<li><a href="charitylist.php" >Charities</a></li>
								<li><a href="aboutus.php" >About Us</a></li>
								<li><a href="Contact.php" >Contact Us</a></li>
							</ul>
							
						</div>
					
						<div id="footer2">
							<h4>Contact</h4>
							<ul>
								<li>Email:<a href="yuhlaing98765@gmail.com">yuhlaing98765@gmail.com</a></li>
								<li>Phone:09787092363,09250037415</li>
								<li>Address:Yangon,Hmawbi,Myaungtaga,UE street,No.122</li>
							</ul>
						</div>
						<div id="footer3">
							<img src="mc2.png" width="200px" height="100" alt="logo" title="mc2"/>
						</div>
					</div>
				</div>
				</footer>
	</body>

</html>
