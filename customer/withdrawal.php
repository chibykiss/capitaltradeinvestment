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
    <title>  Capitaltrade Investment   || User Dashboard || Withdrawal </title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="../assets/images/favicon.png">
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/datatables.min.css"/>
    <!-- <link rel="shortcut icon" href="../favicon.png" /> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
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
                                <h1>Hello, <span>Welcome <?php $classObj->un(); ?></span></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Withdrawal</li>
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
                    Company Wallet Address: <?php $classObj->getbtc1(); ?><br><br>
                    Dear <?php $classObj->un(); ?>, Welcome to your dashboard all activities on your account will be shown here. Your registration bonus will be activated on your first deposit. Invest wisely.
                </div>

                <div id="main-content">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="panel panel-primary">
                                    <div class="panel-header">
                                        <h4 class="text-center">Withdraw fund from your account </h4>
                                        <!--<p class="text-center">Withdrawal fund from account and transferred to your btc account and settlement will be done in btc</p>-->
                                    </div>
                                    <div class="panel-body">
                                        <h5 class="text-center">Account Balance $<?php $classObj->getbal(); ?> </h5>
                                        <form class="form-horizontal" id="invest">
                                            <div class="input-group">
                                                 <span class="input-group-addon"><i class="ti-money"></i></span> 
                                                 <input  type="number" id="amount"  min="18"  class="form-control"  placeholder="Enter Amount" required />
                                            </div>


                                            <div class="input-group">
                                                 <span class="input-group-addon"><i class="ti-location-arrow"></i></span> 
                                                 
                                                 <select id="btc" class="form-control">
                                                   <option value=" ">SELECT PAYMENT METHOD</option>
                                                   <?php $classObj->getpaytype(); ?>
                                                 </select>
                                            </div>

                                            <div class="input-group">
                                                 <span class="input-group-addon"><i class="ti-lock"></i></span> 
                                                 <input type="password" id="pass" class="form-control"  placeholder="Enter your password " required/>
                                            </div>     
                                    </div>
                                    <div class="panel-footer">
                                        <div id="result"></div>
                                        <button type="submit" id="sun" class="btn btn-primary btn-block btn-flat"> Withdraw  </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <?php include("footer.php");?>

                </div>
            </div>
        </div>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
          //  $('#example').DataTable();
           $('#invest').submit(function(e){
              //  e.preventDefault(); 
                var amount = $("#amount").val();
                var pass = $("#pass").val(); 
                var btc = $("#btc").val();
                if (btc == ' ') {
                  swal(" Dear customer enter a Withdrawal method ");  
                }else{
                //      $("#sun").html('<img src="../loader.gif" width="50" heigth="50" />');           
                 $.get("with.php?amount="+amount+"&pass="+pass+"&btc="+btc, function(data){
                    //alert(data);
                    //window.location.assign(data);
                    $("#result").empty().html(data);
                 });
               // alert(amount);
                //alert(pass);
              }
           });
        });
    </script>
</body>

</html>

<?php ob_end_flush(); ?>