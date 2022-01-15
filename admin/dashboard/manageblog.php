<?php
ob_start();
session_start();

// require("../../script.php");
// $classObj = new topspin;
// $classObj->dbcon();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title>  Crypstaccel Tradefast   || Admin Dashboard || Users </title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="../../customer/icon52.png">
     <?php
        if ( !isset($_SESSION["admin_name"]) && !isset($_SESSION["admin_id"]) ) {
        
             echo '
                <script>
                    window.location.assign("../");
                </script>
           ';
          
        }
    ?>
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
    <script type="text/javascript">
        function checkDelete(){
            return confirm('Are you sure you want to Delete?');
        }
    </script>
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
                                    <li class="active">Users</li>
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

                                <?php
                            if(!empty($_SESSION['err'])){

                            if($_SESSION['err'] == 'empty'){
                            echo '
                            <div class="alert alert-warning alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Warning!</strong> Pls Filling in the Missing Feilds
                            </div>
                            ';
                            unset($_SESSION['err']);
                            }
                            else if($_SESSION['err'] == 'success'){
                            echo '<div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> Update Sucessful.
                          </div>
                            ';
                            unset($_SESSION['err']);
                             }
                             else if($_SESSION['err'] == 'delsuccess'){
                                echo '<div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> Deleted Sucessfully.
                              </div>
                                ';
                                unset($_SESSION['err']);
                                 }
                                 else if($_SESSION['err'] == 'delfailed'){
                                    echo ' <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Danger!</strong> Could not Delete
                                    </div>
                                    ';
                                    unset($_SESSION['err']);
                                     }
                             else{
                                echo '
                                <div class="alert alert-warning alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Warning!</strong> Check the fileformat or File size of your pic.
                                </div>
                                ';
                                unset($_SESSION['err']);
                             }
                            }
                            ?>
                                    <div class="panel panel-primary">
                                        <div class="panel-header">
                                            <h4 class="text-center"> Manage Blog</h4>
                                        </div>
                                        <div class="panel-body  table-responsive">

                                        <table class="table table-hover table-striped">
                                        <thead>
                                            <th>S/N</th>
                                            <th>Title</th>
                                            <th>News date</th>
                                            <th>By</th>
                                            <th>edit</th>
                                            <th>delete</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if(isset($_GET['page'])){
                                                $page = $_GET['page'];
                                            }
                                            else{
                                                $page=1;
                                            }
                                            
                                            include 'view_blog.php';
                                             $get = new viewNews;
                                            $get->see_News($page);
                                            ?>
                                           
                                        </tbody>
                                    </table>
                                       
                                        <!-- <table id="example" class="display table table-bordered" style="width:100%">
                                            <thead>
                                               <tr>
                                                    <th>S/N</th>
                                                    <th>Username</th>
                                                    <th>Customer ID</th>
                                                    <th>Phone number</th>
                                                    <th>Email </th>
                                                    <th>Withdraw</th>
                                                    <th>View</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                  
                                                 
                                            </tbody>
                                        </table>          -->
                                            
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

    <div id="search">
        <button type="button" class="close">×</button>
        <form>
            <input type="search" value="" placeholder="type keyword(s) here" />
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
        
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h3>WElcome to Mistri mama!!!</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                 <p>A welcome note and a welcome picture goes here :</p>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-info  pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
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
            $('#example').DataTable();
        });
    </script>
</body>

</html>
<?php ob_end_flush() ?>
