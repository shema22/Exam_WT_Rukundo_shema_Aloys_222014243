
<?php
session_start();
include('includes/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    // Prepare the SQL query using prepared statement
    $stmt = $connection->prepare("SELECT instructorID FROM instructor WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['instructor'] = $row['instructorID']; 
       
        header("Location:dashboard.php"); 
        exit();
    } else {
        echo "<script>alert('Fail to login. Try Again!');</script>";
    }
}
?>
<!--html session start-->
<!DOCTYPE HTML>
<html>
<head>
	<title>virtual lean workshop plaform||Login Page</title>

	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<!-- Graph CSS -->
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<!-- jQuery -->
	<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
	<!-- lined-icons -->
	<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
	<!-- //lined-icons -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<!--clock init-->
</head> 
<body>
	<div class="error_page">
		<div class="error-top">
			<h2 class="inner-tittle page">VLWP Instructor</h2>
			<div class="login">
				
				<div class="buttons login">
					<h3 class="inner-tittle t-inner" style="color: lightblue">Sign In</h3>
				</div>
				<form id="login" method="post" name="login"> 
					<input type="text" class="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-mail address';}" name="email" required="true">
					<input type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" name="password" required="true">
					<div class="submit"><input type="submit" onclick="myFunction()" value="Login" name="login" ></div>
					<div class="clearfix"></div>

					<div class="new">
						<p><a href="forgot-password.php">Forgot Password?</a></p>
						<p><a href="../index.php">Back Home!!</a></p>
						<div class="clearfix"></div>
					</div>
				</form>
			</div>


		</div>


		<!--//login-top-->
	</div>

	<!--//login-->
	<!--footer section start-->
	<div class="footer">
		
		<?php include_once('includes/footer.php');?>
	</div>
	<!--footer section end-->
	<!--/404-->
	<!--js -->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
</body>
</html>