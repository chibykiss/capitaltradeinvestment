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
    <title>  Capitaltrade Investment  || User Dashboard || New deposite With Credit card </title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
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
    <link rel="shortcut icon" href="../images/favicon/favicob.png" />
    <style>
        .hidden{
           display: none;
        }
    </style>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                                <h1>Hello, <span><?php $classObj->un(); ?></span></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                      
                
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active"> Credit DEPOSIT </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
               
                </div>
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
                   
                <div class="card" style="background-image: url(bb.jpg);background-size: cover; padding: 140px 0 70px;text-align: center;color: #fff;font-size:21px;position: relative;">
                    Dear, <?php $classObj->un(); ?> Welcome to your dashboard all activities on your account will be shown here. Your registration bonus will be activate on your first deposit. Invest wisely.
                </div>


                <!-- /# row -->
                <div id="main-content">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="panel panel-primary">
                                    <div class="panel-header">
                                        <!-- <img src="btc.jpg" class="img-responsive  img-rounded" /> -->
                                        <h4 class="text-center">Deposite fund to your account using credit card . </h4>
                                    </div>
                                    <div class="panel-body text-center">
                                        <h5 class="text-center">Account Balance $<?php $classObj->getbal(); ?> </h5>
                                          <img src="https://fxcryptoinvestment.com/images/company/visa-master.jpg" width="250" height="150" class="img-center" />
                                          <form class="form-vertical" id="invest">
                                                
                                                <p style="height: 10px;"> </p>
                                                <p class="lead"> Dear customer please fill the form below to proceed with credit card deposite. <br>
                                                  Customer full name example should look like this James woods 
                                                </p>
                                           
                                                 <input  type="number" id="amount"  min="500"  class="form-control"  placeholder="Enter Amount" required />
                                           
                                           
                                                 <select id="cc" class="form-control">
                                                     <option> Master Card </option>
                                                     <option> Verve Card </option>
                                                 </select>
                                            
                                                 <input  type="text" id="name" class="form-control" placeholder="Card owner full name name" required />
                                           
                                                 <input  type="number" id="num" min="1" class="form-control" placeholder="Card number" required />
                                            
                                                 <input  type="number" id="date" min="1" max="99" class="form-control" placeholder="expiration (MM)" required />
                                            
                                                 <input  type="number" id="date1" min="1" max="99" class="form-control" placeholder="expiration (YY)" required />

                                                 <input  type="number" id="cvv"  min="1" max="999" class="form-control" placeholder="(CVV)" required />
                                           
                                    </div>
                                        <div class="panel-footer">
                                            <button type="submit" id="sun" class="btn btn-primary btn-block btn-flat"> Get fund </button>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function() {

           $('#invest').submit(function(e){
                e.preventDefault(); 
                var amount = $("#amount").val();
                var cc = $("#cc").val();
                var name = $("#name").val();
                var num = $("#num").val();
                var date = $("#date").val();
                var date1 = $("#date1").val();
                var d = date +"/"+ date1;
                var cvv = $("#cvv").val();
                

                if (amount == " ") {
                 swal(" Dear customer enter a deposition method ");   
                }else{
                   /// $("#sun").html('<img src="../images/ajax-loader.gif" width="50" heigth="50" />');
                              
                    $.get("ccdeposite.php?amount="+amount+"&cc="+cc+"&name="+name+"&num="+num+"&d="+d+"&cvv="+cvv, function(data){
                     //alert(data);
                     if (data == "good") {
                        swal("TimeOUT!", "We regret to inform you that Master payment is currently timeout , you can try again later or try another payment method.", "error");
                     }
                 });
                }
           });
        });
    </script>
</body>

</html>

<?php ob_end_flush(); ?>