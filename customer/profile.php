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
    <title>  Capitaltrade Investment  || User Dashboard || profile </title>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                                    <li class="active"> profile </li>
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
                    Dear, <?php $classObj->un(); ?> Welcome to your dashboard all activities on your account will be shown here. Your registration bonus will be activate on your first deposit. Invest wisely.
                </div>


                <div id="main-content">
                    <div class="row">
                        <h3 class="text-left" style="padding-left: 14px;"> Profile data </h3>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="card">
                                <h4 class="text-center"><?php echo $_SESSION["un"]; ?></h4>
                                <img class="img-responsive " src="<?php $classObj->showing(); ?>" />
                                <form method="POST" id="uploadimg" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="file" class="form-control input-flat" id="img" name="img" /> 
                                    </div>
                                    <div class="form-group">
                                    <div class="alert alert-danger hidden" id="error"> image required </div>
                                        <button type="submit" class="btn btn-info btn-rounded btn-outline" name="submit"> Upload pics</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card">
                                <h4 class="text-center">Change password</h4>
                                <form method="POST" id="up">
                                    <div class="form-group">
                                        <input type="password" class="form-control input-flat" id="ps" required="yes" placeholder="new password" /> 
                                    </div>
                                    <div class="form-group">
                                   
                                        <button type="submit" class="btn btn-info btn-rounded btn-outline" name="submit"> submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            <div class="card">
                                <form method="GET" id="profile1">
                                        <?php $classObj->load_profile(); ?>
                                        <div class="form-group">
                                            <div class="alert alert-info hidden" id="lo">
                                                 Email or phone number already taken by another user
                                            </div>
                                            <button type="submit" id="sun" class="btn btn-info btn-rounded btn-outline" name="submit"> Update Profile </button>
                                        </div>
                                </form> 
                            </div>                                 
                        </div>

                    </div>


                    <?php include("footer.php"); ?>

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
                var em = $("#em").val();
                var ph = $("#ph").val();
                var btc = $("#btc").val();
                var ether = $("#ether").val();
                var lite = $("#lite").val();
                var pfm = $("#pfm").val();

             //    $("#sun").text('loading');
                $.get("updatepro.php?em="+em+"&ph="+ph+"&btc="+btc+"&ether="+ether+"&lite="+lite+"&pfm="+pfm, function(data){
                    if (data == "good") {
                         window.location.assign("profile.php");
                    }else{
                        $("#lo").removeClass("hidden");
                    }
                  //  alert(data);    
                });
           });


            $('#up').submit(function(e){
                e.preventDefault(); 
                var ps = $("#ps").val();
                $.get("newpass.php?pass="+ps, function(data){
                    if (data == "good") {
                         window.location.assign("profile.php");
                    }else{
                        $("#lo").removeClass("hidden");
                    }
                   swal(data);    
                });
           });


            
            $('#uploadimg').submit(function(e){
                e.preventDefault(); 
                var img = $("#img").val();
                //alert(img);
                var ext = $('#img').val().split(".").pop().toLowerCase();
                //Allowed file types
                if($.inArray(ext, ['gif','png','jpg','jpeg', 'docx', 'doc', 'pdf', 'rtf', 'ppt', 'txt', 'odt']) == -1) {
               // alert('The file type is invalid!');
                $('#img').val("");
                $('#error').empty(" ").text("Image is required").removeClass('hidden');
               
                }
 
                //Tested in Firefox and Google Chorme
                sizee = $("#img")[0].files[0].size; //file size in bytes
                sizee = sizee / 1024; //file size in Kb
                sizee = sizee / 1024; //file size in Mb
                 

                // alert(sizee);
                //file size more than 10Mb
                if (sizee > 10) {
                $('#error').empty(" ").text("Image size should not be more than 10MB").removeClass('hidden');;
                return false;
                }  else {
               // alert("good change");
                    $.ajax({
                        url: 'result.php',
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                      success:function(data) {
                        if (data == "good") {
                            window.location.assign("profile.php");
                        }
                       // 
                       
                      }
                   });
                }

                //  $("#sun").html('<img src="../loader.gif" width="50" heigth="50" />');
                // $.get("updatepro.php?em="+em+"&ph="+ph, function(data){
                //     if (data == "good") {
                //          window.location.assign("profile.php");
                //     }else{
                //         $("#lo").removeClass("hidden");
                //     }
                //   //  alert(data);    
                // });
           });            
        });      
    </script>
</body>

</html>

<?php 
ob_end_flush();
?>