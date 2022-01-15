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
<title>Market Screener | Capitaltrade Investment </title>
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
    include_once 'incs/header.php';
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
                        <h1>Market Screener</h1>
                    </div>
					<div class="clearfix"></div>
					<ol class="breadcrumb">
						<li><a href="index-2.html">Home</a></li>
						<li class="active">Market Screener</li>
					</ol>
				</div><!-- .title end -->
			</div><!-- .col-lg-12 end -->
		</div><!-- .row end -->
	</div><!-- .container end -->
</section><!-- #page-title end -->

<!-- Accordion #1
============================================= -->
<section>
  <div class="container-fluid mtb15">
    <div class="row">
      <div class="col-md-12">
        <!-- TradingView Widget BEGIN -->
        <div class="tradingview-widget-container">
          <div class="tradingview-widget-container__widget"></div>
          <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js"
            async>
              {
                "width": "100%",
                  "height": 900,
                    "defaultColumn": "overview",
                      "defaultScreen": "general",
                        "market": "crypto",
                          "showToolbar": true,
                            "colorTheme": "dark",
                              "locale": "en"
              }
            </script>
        </div>
        <!-- TradingView Widget END -->
      </div>
    </div>
  </div>
</section>

<!-- Footer #1
============================================= -->
<?php
    include_once 'incs/footer.php';
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