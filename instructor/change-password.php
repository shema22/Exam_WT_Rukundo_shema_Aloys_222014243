<?php
session_start();
include('includes/dbconnection.php');
if (!isset($_SESSION['instructor'])) {
    header("Location:index.php"); 
}
    $user = $_SESSION['instructor'];
    // Prepare the SQL query using prepared statement
    $stmt = $connection->prepare("SELECT * FROM instructor WHERE instructorID = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }else{

    header("index.php");
    }
if (isset($_POST['submit'])) {
    $user = $_SESSION['instructor'];
    $cpassword = md5($_POST['currentpassword']);
    $newpassword = md5($_POST['newpassword']);
    $sql = "SELECT password FROM instructor WHERE instructorID = ?";
    $query = $connection->prepare($sql);
    $query->bind_param('s',$user);
    $query->execute();
    $result = $query->get_result();
    $results = $result->fetch_assoc();
    if ($cpassword == $results['password']) {
        $con = "UPDATE instructor SET password=? WHERE instructorID=?";
        $chngpwd1 = $connection->prepare($connection);
        $chngpwd1->bind_param('ss', $newpassword, $adminid);
        $chngpwd1->execute();

        echo '<script>alert("Your password successfully changed")</script>';
        echo "<script>window.location.href ='change-password.php'</script>";
    } else {
        echo '<script>alert("Your current password is wrong")</script>';
    }
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>virtual lean workshop platform|| Change Password</title>

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- Graph CSS -->
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <!-- jQuery -->
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
    <!-- Lined-icons -->
    <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
    <!-- //Lined-icons -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <!--clock init-->
    <script src="js/css3clock.js"></script>
    <!--Easy Pie Chart-->
    <!--skycons-icons-->
    <script src="js/skycons.js"></script>
    <!--//skycons-icons-->
    <script type="text/javascript">
        function checkpass()
        {
            if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
            {
                alert('New Password and Confirm Password field does not match');
                document.changepassword.confirmpassword.focus();
                return false;
            }
            return true;
        }   

    </script>
</head> 
<body>
    <div class="page-container">
        <!-- Content-inner -->
        <div class="left-content">
            <div class="inner-content">

                <?php include_once('includes/header.php');?>
                <!--//outer-wp-->
                <div class="outter-wp">
                    <!--/sub-heard-part-->
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Change Password</li>
                        </ol>
                    </div>  
                    <!--/sub-heard-part-->  
                    <!--/forms-->
                    <div class="forms-main">
                        <h2 class="inner-tittle">Change Password </h2>
                        <div class="graph-form">
                            <div class="form-body">
                                <form name="changepassword" method="post" onsubmit="return checkpass();" action=""> 

                                    <div class="form-group"> <label for="exampleInputEmail1">Current Password</label> <input type="password" name="currentpassword" id="currentpassword" class="form-control" required="true"> </div>
                                    <div class="form-group"> <label for="exampleInputEmail1">New Password</label> <input type="password" name="newpassword"  class="form-control" required="true"> </div>
                                    <div class="form-group"> <label for="exampleInputEmail1">Confirm Password</label><input type="password" name="confirmpassword" id="confirmpassword" value=""  class="form-control" required="true"> </div>

                                    <button type="submit" class="btn btn-default" name="submit" id="submit">Change</button> </form> 
                            </div>
                        </div>
                    </div> 
                </div>
                <?php include_once('includes/footer.php');?>
            </div>
        </div>      
        <?php include_once('includes/sidebar.php');?>
        <div class="clearfix"></div>      
    </div>
    <script>
        var toggle = true;

        $(".sidebar-icon").click(function() {                
            if (toggle)
            {
                $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                $("#menu span").css({"position":"absolute"});
            }
            else
            {
                $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                setTimeout(function() {
                    $("#menu span").css({"position":"relative"});
                }, 400);
            }

            toggle = !toggle;
        });
    </script>
    <!--js -->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
