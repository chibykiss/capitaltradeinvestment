<?php
ob_start();
session_start();
require("../script.php");
$classObj = new topspin;
$classObj->dbcon();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Admin Login </title>
    <?php
        if ( isset($_SESSION["admin_name"]) && isset($_SESSION["admin_id"]) ) {
        
             echo '
                <script>
                    window.location.assign("dashboard")
                </script>
           ';
        }
    ?>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
   <link rel="shortcut icon" href="../customer/icon52.png">
        <!-- Styles -->
    <link href="../customer/assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../customer/assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../customer/assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../customer/assets/css/lib/unix.css" rel="stylesheet">
    <link href="../customer/assets/css/style.css" rel="stylesheet">
    <style type="text/css">
         .bg-primary{
            background: #044630;
        }
    </style>
</head>

<body class="bg-primary">

    <div class="unix-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#"><span>  Capitaltrade Admin </span></a>
                            <?php $classObj->adminlogin(); ?>
                        </div>
                        <div class="login-form">
                            <h4>Admin Login</h4>
                            <form method="post">
                                <div class="form-group">
                                    <label>Admin id</label>
                                    <input type="text"  name="admin_un" class="form-control" placeholder="admin id" required="yes">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="admin_pass" class="form-control" placeholder="Password" required="yes">
                                </div>
                                <div class="checkbox">
                                   

                                </div>
                                <button type="submit" name="adminlogin" class="btn bg-primary btn-flat m-b-30 m-t-30">Sign in</button>
                               
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php ob_end_flush(); ?>