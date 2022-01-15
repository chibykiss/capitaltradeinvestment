<?php
ob_start();
// session_start();

require("script.php");
$classObj = new topspin;
$classObj->dbcon();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<!-- Document Meta
    ============================================= -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--IE Compatibility Meta-->
<meta name="description" content=" Capitaltradeinvestment.com gives everyone an easy way to participate in the financial markets. Trade with as little as $1 USD on major currencies, stock indices, commodities, and synthetic indices." />
<meta name="keywords" content=" binary options, forex, forex trading, online trading, financial trading, binary trading, index trading, trading stock indices, forex trades, trading commodities, binary options strategy, binary broker, binary bet, binary options trading platform, binary strategy, finance, investment, trading" />
<meta name="author" content="Capitaltradeinvestment.com" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="assets/images/favicon/favicon.png" rel="icon">

<!-- Fonts
    ============================================= -->
 <link href="https://fonts.googleapis.com/css?family=Exo+2:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i%7CRoboto:300,300i,400,400i,500,500i,700,700i,900,900i%7CWork+Sans:300,400,500,600,700,800,900" rel="stylesheet">

<!-- Stylesheets
    ============================================= -->
<link href="css/style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.css">
<link href="assets/css/external.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">



<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->

<!-- Document Title
    ============================================= -->
<title>Investment Plan | Capitaltrade Investment </title>
</head>
<body>
<div class="preloader">
	<div class="loader-eclipse">
		<div class="loader-content"></div>
	</div>
</div><!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="wrapper clearfix">
<?php
    require_once 'incs/header.php';
?>

<!-- Page Title #1
============================================= -->
<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
	<div class="bg-section">
		<img src="assets/images/page-titles/16.jpg" alt="Background"/>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<div class="title title-6 text-center">
                    <div class="title--heading">
                        <h1>Investment Plan</h1>
                    </div>
					<div class="clearfix"></div>
					<ol class="breadcrumb">
						<li><a href="index-2.html">Home</a></li>
						<li class="active">Investment Plan</li>
					</ol>
				</div><!-- .title end -->
			</div><!-- .col-lg-12 end -->
		</div><!-- .row end -->
	</div><!-- .container end -->
</section><!-- #page-title end -->



<!-- Pricing Table #1
============================================= -->
<section id="pricing1" class="pricing pricing-1 bg-gray pb-90">
	<div class="container">
		<div class="row clearfix">
			<div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
				<div class="heading heading-1 text--center mb-70">
					<p class="heading--subtitle">Trade Now!</p>
					<p class="heading--desc mb-0">We have a wide array of investment plans for our investors to choose from. Choose from the options below the investment plan which best suits you.</p>
				</div>
			</div><!-- .col-lg-8 end -->
		</div><!-- .row end -->
		<div class="demo10">
            <div class="container">
                <div class="row">
                
                <!-- <div class="col-md-3 col-sm-6">
                        <div class="pricingTable10">
                            <div class="pricingTable-header">
                                <h3 class="heading">Elevate Auto Bot</h3>
                                <span class="price-value"> 5%
                                    <span class="month">ROI</span>
                                </span>
                            </div>
                            <div class="pricing-content">
                                <ul>
                                    <li>$150 - $6,999</li>
                                    <li>5% R.O.I Weekly</li>
                                    <li>6.5% Compounding Percent</li>
                                    <li>Investment Duration - 3 Months</li>
                                    <li>3% Referral Bonus</li>
                                    <li>24/7 Support</li>
                                </ul>
                                <a href="https://trade.Capitaltradeinvestment.com/register" class="read">Invest Now</a>
                            </div>
                        </div>
                    </div> -->
                    <?php $classObj->getget(); ?>

                   
           

               
                </div>


</section>
      <div class="col-md-12 mb15">
        <!-- TradingView Widget BEGIN -->
        <div class="tradingview-widget-container">
          <div class="tradingview-widget-container__widget"></div>
          <script type="text/javascript" src="../s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js"
            async>
              {
                "colorTheme": "dark"
              }
            </script>
        </div>
        <!-- TradingView Widget END -->
          <!-- TradingView Widget BEGIN -->
          <div class="tradingview-widget-container">
            <div class="tradingview-widget-container__widget"></div>
            <script type="text/javascript" src="../s3.tradingview.com/external-embedding/embed-widget-timeline.js"
              async>
                {
                  "colorTheme": "dark",
                    "isTransparent": false,
                      "displayMode": "compact",
                        "width": "100%",
                          "height": 430,
                            "locale": "en"
                }
              </script>
          </div>
          <!-- TradingView Widget END -->
<!-- Testimonial #1
============================================= -->
<section id="testimonial1" class="testimonial testimonial-1 pt-90">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-10 offset-lg-1">
                <div class="carousel owl-carousel  " data-slide="1" data-slide-rs="1" data-autoplay="true" data-nav="false" data-dots="false" data-space="0" data-loop="true" data-speed="800">
					<!-- Testimonial #1 -->
					<div class="testimonial-panel">
					<div class="testimonial--icon"></div><!-- .testimonial-icon end -->
						<div class="testimonial--body">
							<p>“Fell in love with the platform the moment I saw it. Its clean and simple design was what sealed the deal for me.”</p>
						</div><!-- .testimonial-body end -->
						
						<div class="testimonial--meta">
							<div class="testimonial--meta-img">
								<img src="assets/images/testimonial/2.png" alt="Testimonial Author">
							</div>
							<h4>Ahmad Bramant</h4>
							
						</div><!-- .testimonial-meta end -->
					</div><!-- .testimonial-panel end -->
					
					<!-- Testimonial #2 -->
					<div class="testimonial-panel">
						<div class="testimonial--icon"></div><!-- .testimonial-icon end -->
						<div class="testimonial--body">
							<p>“I’ve learned a lot about the financial markets while working with this company. Now I can invest and earn money.”</p>
						</div><!-- .testimonial-body end -->
						
						<div class="testimonial--meta">
							<div class="testimonial--meta-img">
								<img src="assets/images/testimonial/1.png" alt="Testimonial Author">
							</div>
							<h4>Brian Murphy</h4>
							
						</div><!-- .testimonial-meta end -->
					</div><!-- .testimonial-panel end -->
					
					<!-- Testimonial #3 -->
					<div class="testimonial-panel">
						<div class="testimonial--icon"></div><!-- .testimonial-icon end -->
						<div class="testimonial--body">
							<p>“Contacting support was simple and easy. I was surprised by how quickly they actually get back to you.”</p>
						</div><!-- .testimonial-body end -->
						
						<div class="testimonial--meta">
							<div class="testimonial--meta-img">
								<img src="assets/images/testimonial/3.png" alt="Testimonial Author">
							</div>
							<h4>Amanda Ricci</h4>
							
						</div><!-- .testimonial-meta end -->
					</div><!-- .testimonial-panel end -->
				</div>
			</div><!-- .col-lg-12 end -->
		</div><!-- .row end -->
	</div><!-- .container end -->
</section><!-- #testimonial1 end -->


<!-- Footer #1
============================================= -->
<?php
require_once 'incs/footer.php';
?>

<div id="back-to-top" class="backtop"><i class="fa fa-long-arrow-up"></i></div>
 </div><!-- #wrapper end -->

<!-- Footer Scripts
============================================= -->
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/functions.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>