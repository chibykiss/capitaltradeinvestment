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
   <!--  <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title>  Crypstaccel Tradefast   || Admin Dashboard || Plans </title>
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
    <script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
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
                                    <li class="active">Blog</li>
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
                            <strong>Success!</strong> Post Sucessful.
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
                                        <h4 class="text-center">  Edit Blog </h4>

                                    </div>
                                    <div class="panel-body">
                                        <h5 class="text-center"> Edit Post  </h5>


                                        <form action="update_blog.php" method="POST" enctype="multipart/form-data">
                                        <?php
                                        include 'for_blog_update.php';
                                        $theid = $_GET['id'];
                                        //echo $theid;

                                        $to_update = new fix_update;
                                         $to_update->show($theid);
                                    ?>
                                        <!-- <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Blog Title</label>
                                                    <input type="text" class="form-control" placeholder="Blog Title" name="btitle">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Posted By</label>
                                                    <input type="text" class="form-control" placeholder="e.g Admin" name="bpostby">
                                                </div>
                                            </div>
                                          
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                     <label>Post Pic</label>
                                                   <input type="file" class="form-control-file" name="bpic">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <select name="pstat" class="form-control">
                                                    <option value="Investment">Investment</option>
                                                    <option value="Community">Community</option>
                                                    <option value="corporate">Corporate</option>
                                                    <option value="Business">Business</option>
                                                    <option value="Banking">Banking</option>
                                                    <option value="Deposit">Deposit</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                        
                                        </div>
                                           <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>News Content</label>
                                                    <textarea rows="4" cols="80" id="editor1" name="editor1" class="form-control" placeholder="Full Blog Details"></textarea>
                                                </div>
                                            </div>
                                              <script>
                                                CKEDITOR.replace('editor1', {
                                                 height: 400,
                                                 baseFloatZIndex: 10005
                                                });
                                             </script>
                                        </div>
                                         <button type="submit" name="submit" class="btn btn-info btn-fill pull-right">Post</button>
                                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat"> Update Post </button>
                                      <div class="clearfix"></div> -->
                                    </form>


                                        <!-- <form class="form-horizontal" action="create_news.php" method="post" enctype="multipart/form-data">
                                            <div class="input-group">
                                                 <span class="input-group-addon"><i class="ti-agenda"></i></span> 
                                                 <input  type="text" id="pname"  class="form-control"  placeholder="Blog Title" required />
                                            </div>
                                            <div class="input-group">
                                                 <span class="input-group-addon"><i class="ti-money"></i></span> 
                                                 <input  type="text" id="mi"  min="0"  class="form-control"  placeholder="Posted By" required />
                                            </div>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-money"></i></span>
                                            <select name="pstat" class="form-control">
                                                    <option>Categories</option>
                                                    <option value="Awaiting Department">Investment</option>
                                                    <option value="Awaiting Arrival">Community</option>
                                                    <option value="Delivered">Corporate</option>
                                                    <option value="Awaiting Department">Business</option>
                                                    <option value="Awaiting Arrival">Banking</option>
                                                    <option value="Delivered">Deposit</option>
                                                    </select>
                                            </div>
                                            <div class="input-group">
                                                 <span class="input-group-addon"><i class="ti-money"></i></span> 
                                                 
                                                     <label>Post Pic</label>
                                                   <input type="file" class="form-control-file" name="bpic">
                                                
                                            </div>
                                            <div class="input-group">
                                              
                                                 <textarea rows="4" cols="80" id="editor1" name="editor1" class="form-control" placeholder="Full Blog Details"></textarea>
                                                 
                                            </div>
       
 
                                   
                                        <button type="submit" name="sub" class="btn btn-primary btn-block btn-flat"> Create post </button>
                               
                                    </form> -->

                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <div class="row">
                

                         
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
  

</body>

</html>

<?php ob_end_flush() ?>