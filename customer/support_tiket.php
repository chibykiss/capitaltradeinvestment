<?php
ob_start();
session_start();
if ( !isset($_SESSION["un"]) && !isset($_SESSION["hash"]) && !isset($_SESSION["id"]) ) {
    header("location: ../");
}
require("../script.php");
$classObj = new topspin;
$classObj->dbcon();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title> Capitaltrade Investment  || User Dashboard || customer care </title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
    <!-- Retina iPad Touch Icon-->
       <!-- Styles -->
    <link href="assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/unix.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon.png" />
    <style type="text/css">
        .hidden{
            display: none;
        }
    </style>
</head>

<body>

    <?php include("head.php"); ?>

    <p style="height: 40px;"></p>
   
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hello, <span>Welcome, <?php echo $_SESSION["un"]; ?></span></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active"> customer care </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->

                 <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container">
                      <div class="tradingview-widget-container__widget"></div>
                      <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com" rel="noopener" target="_blank"></a></div>
                      <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                      {
                      "symbols": [
                        {
                          "title": "BTC/USD",
                          "proName": "BITFINEX:BTCUSD"
                        },
                        {
                          "title": "ETH/USD",
                          "proName": "BITFINEX:ETHUSD"
                        }
                      ],
                      "theme": "light",
                      "isTransparent": false,
                      "displayMode": "adaptive",
                      "locale": "en"
                    }
                      </script>
                    </div>
                    <!-- TradingView Widget END -->
                   
                <div class="card" style="background-image: url(bba.jpg);background-size: cover; padding: 140px 0 70px;text-align: center;color: #fff;font-size:21px;position: relative;">
                    Company Wallet Address: 17SuDdekse57vV1V7T7aN618q5VV3SULq<br><br>
                    Dear <?php $classObj->un(); ?>, Welcome to your dashboard all activities on your account will be shown here. Your registration bonus will be activated on your first deposit. Invest wisely.
                </div>

                <div id="main-content">
                  
                    <div class="row">
                        <h3 class="text-left" style="padding-left: 14px;"> Customer care</h3>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <p>
                                    Welcome to customer care center if you have any querys please fill the form below to connect to customer care department.
                                </p>
                                <form method="GET" id="profile1">
                                        <div class="form-group">
                                            <label for="name">NAME:</label>
                                            <input type="text" name="name" class="form-control input-flat" value="" id="name" required = "yes" />
                                        </div>
                                        <div class="form-group">
                                            <label for="email">EMAIL:</label>
                                            <input type="text" name="email" class="form-control input-flat" value="" id="email" required = "yes" />
                                        </div>
                                        <div class="form-group">
                                            <label for="message">MESSAGES:</label>
                                            <textarea class="form-control input-flat" id="mess" rows="10" id="message"> </textarea>
                                        </div>
                                        <div class="form-group" id="lo">
                                            <button type="submit" id="sun" class="btn btn-info btn-rounded btn-outline" name="submit"> Send Query </button>
                                        </div>
                                </form> 
                            </div>
                                 
                        </div>

                    </div>


                    <?php include("footer.php");?>

                </div>
            </div>
        </div>
    </div>

    <div id="search">
        <button type="button" class="close">×</button>
        <form>
            <input type="search" value="" placeholder="type keyword(s) here" />
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>


     
    <script src="assets/js/lib/jquery.min.js"></script>
    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
    
    <script src="assets/js/scripts.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
           $('#profile1').submit(function(e){
                e.preventDefault(); 
                var em = $("#email").val();
                var na = $("#name").val();
                var mess = $("#mess").val();
                // $("#sun").html('<img src="../loader.gif" width="50" heigth="50" />');
                $.get("support.php?em="+em+"&na="+na+"&mess="+mess, function(data){
                     if (data == "good") {
                        $("#lo").html('<div class="alert alert-info"> Support query has been added successfully </div>');
                     }else{
                      
                     }
                 //  alert(data);    
                });
           });
        });      
    </script>
</body>

</html>

<?php 
ob_end_flush();
?>