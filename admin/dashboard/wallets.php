<?php
ob_start();
session_start();
require("../../script.php");
$classObj = new topspin;
$classObj->dbcon();
$classObj->lockadmin();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!--  <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title>  Crypstaccel Tradefast   || Admin Dashboard || Wallets </title>
    <!-- ================= Favicon ================== -->
     <?php
        if ( !isset($_SESSION["admin_name"]) && !isset($_SESSION["admin_id"]) ) {
        
             echo '
                <script>
                    window.location.assign("../");
                </script>
           ';
          
        }
    ?>
    <!-- Standard -->
        <link rel="icon" type="image/icon" href="../../images/favicon/favicon.png">
    <!-- Retina iPad Touch Icon-->
    <!-- Styles -->
    <link href="../../customer/assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="../../customer/assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../../customer/assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../../customer/assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="../../customer/assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="../../customer/assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="../../customer/assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../../customer/assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../../customer/assets/css/lib/unix.css" rel="stylesheet">
    <link href="../../customer/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/datatables.min.css"/>
    <link rel="shortcut icon" href="../favicon.png" />

</head>

<body>
 
 <?php include("header.php"); ?>
    <p style="height: 40px;"></p>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hello, <span>Welcome Admin</span></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="index.php">Dashboard</a></li>
                                    <li class="active">Wallets</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card">
                                <div class="panel panel-primary">
                                    <div class="panel-header">
                                        <h4 class="text-center"> Bitcoins </h4> <br>
                                        <h5 class="text-center">(  <?php $classObj->getbtc1(); ?>  )</h5>

                                    </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" id="invest">
                                            <div class="input-group">
                                                 <span class="input-group-addon"><i class="ti-agenda"></i></span> 
                                                 <input  type="text" id="bitcoin"  class="form-control"  placeholder="Bitcoin" required />
                                            </div>
                                    </div>
                                    <div class="panel-footer">
                                        <div id="result"></div>
                                        <button type="submit" id="sun" class="btn btn-primary btn-block btn-flat"> Add Bitcoin address</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card">
                                <div class="panel panel-primary">
                                    <div class="panel-header">
                                        <h4 class="text-center"> Usdt </h4> <br>
                                        <h5 class="text-center">(  <?php $classObj->getbtcash(); ?>  )</h5>

                                    </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" id="invest1">
                                            <div class="input-group">
                                                 <span class="input-group-addon"><i class="ti-agenda"></i></span> 
                                                 <input  type="text" id="cash"  class="form-control"  placeholder="Usdt" required />
                                            </div>
                                    </div>
                                    <div class="panel-footer">
                                        <div id="result"></div>
                                        <button type="submit" id="sun" class="btn btn-primary btn-block btn-flat"> Add Usdt address</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                       

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card">
                                <div class="panel panel-primary">
                                    <div class="panel-header">
                                        <h4 class="text-center"> Perfect </h4> <br>
                                        <h5 class="text-center">(  <?php $classObj->getpaypal(); ?>  )</h5>

                                    </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" id="invest2">
                                            <div class="input-group">
                                                 <span class="input-group-addon"><i class="ti-agenda"></i></span> 
                                                 <input  type="text" id="pay"  class="form-control"  placeholder="Perfect Money" required />
                                            </div>
                                    </div>
                                    <div class="panel-footer">
                                        <div id="result"></div>
                                        <button type="submit" id="sun" class="btn btn-primary btn-block btn-flat"> Add perfect money address</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>                       

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card">
                                <div class="panel panel-primary">
                                    <div class="panel-header">
                                        <h4 class="text-center"> Etherum </h4> <br>
                                        <h5 class="text-center">(  <?php $classObj->getether(); ?>  )</h5>

                                    </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" id="invest3">
                                            <div class="input-group">
                                                 <span class="input-group-addon"><i class="ti-agenda"></i></span> 
                                                 <input  type="text" id="ether"  class="form-control"  placeholder="Etherum" required />
                                            </div>
                                    </div>
                                    <div class="panel-footer">
                                        <div id="result"></div>
                                        <button type="submit" id="sun" class="btn btn-primary btn-block btn-flat"> Add Etherum address</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>

                        </div>
                        </div>
                        </div>
                    </div>
                    
                    
                   
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>  Crypstaccel Tradefast   &copy; <span id="date-time"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




    <script src="../../customer/assets/js/lib/jquery.min.js"></script>
    <!-- jquery vendor -->
    <script src="../../customer/assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="../../customer/assets/js/lib/menubar/sidebar.js"></script>
    <script src="../../customer/assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="../../customer/assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
    <script src="../../customer/assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <script src="../../customer/assets/js/scripts.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/datatables.min.js"></script>
     <script>
        $(document).ready(function() {

           $('#invest').submit(function(e){
                e.preventDefault(); 
                var bit = $("#bitcoin").val();
                              
                    $.get("addbtc.php?bitcoin="+bit, function(data){
                     //console.log(data);
                    
                    if(data == 200){
                          location.reload();
                     }
                  
                 });
           });

            $('#invest1').submit(function(e){
                e.preventDefault(); 
                var cash = $("#cash").val();
                              
                    $.get("addcash.php?bitcoin="+cash, function(data){
                     //console.log(data);
                    
                    if(data == 200){
                          location.reload();
                     }
                  
                 });
           });


            $('#invest2').submit(function(e){
                e.preventDefault(); 
                var pay = $("#pay").val();                
                    $.get("addpaypal.php?bitcoin="+pay, function(data){
                     //console.log(pay);        
                      if(data == 200){
                              location.reload();
                       }
                 });
           });

            $('#invest3').submit(function(e){
                e.preventDefault(); 
                var ether = $("#ether").val();                
                    $.get("addether.php?bitcoin="+ether, function(data){
                     //console.log(pay);        
                      if(data == 200){
                              location.reload();
                       }
                 });
           });
        });
    </script>

</body>

</html>

<?php ob_end_flush(); ?>