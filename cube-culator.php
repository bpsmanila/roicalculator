<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" lang="en-US" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" lang="en-US" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" lang="en-US" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if IE 9]>
<html id="ie9" lang="en-US" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<![endif]-->
<html>
<head>
	<title>Cube-culator for Ad Optimization | Cubatica</title>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,600,700,800" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="layout.css" />
	<link rel="shortcut icon" href="images/logo.ico" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="noimageindex, noodp, noydir" />
	<meta name="author" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />	
</head>
<body>
	<header id="main-header">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="col-md-4">
					<a href="http://cubatica.com/" title="Cubatica" class="header-logo" target="_blank"><img class="main-logo lazyload" src="images/header-logo@3x.png" alt="Cubatica" title="Cubatica" /></a>
				</div>
				<div class="col-md-8 header-title">
					<span class="title">The Cube-culator for Ad Optimization</span>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</header>	

	<div ng-app="myCubaticaApp" ng-controller="myCubaticaCtrl">
		<div class="main-content">
			<form id="cube-culator" action="optimization.php" method="post">
				<fieldset id="contactdetail">
					<div class="container">
						<div class="row">
						<div class="col-md-8">
							<h1 class="main-title"><span>Calculate The ROI</span><span>On Your Ads</span></h1>
							<p>We've run over 1000 media buying campaigns. Based on our data and experience, we've created a ROI calculator that can help you estimate your CPAs, ROAS based on your current optmization.</p>
							<p>While we know no calculator can take the place of the actual data of your unique campaign, this calculator can give you an estimate based on your numbers, your set up, and whether you have everything optimized.  <strong>Let's go!</strong></p>
							<p class="lastp"><strong>Put your info below, and we'll show you how much more you can make if you optimize - as well as the steps you can take to optimize.</strong></p>
							<div class="form-row"><div class="form-column column-half"><label for="fullname">Your Fullname</label><div class="input-group"><input class="text" type="text" ng-model="fullname" id="fullname" name="fullname" /></div></div><div class="form-column column-half column-last"><label for="emailaddress">Email Address</label><div class="input-group"><input class="text" type="text" ng-model="emailaddress" id="emailaddress" name="emailaddress"/></div></div></div>
							<div class="form-row"><div class="form-column"><input type="button" name="btncontactdetail" class="next btn btn-right" id="btncontactdetail" value="Let's Go" title="Let's Go" /></div><div class="error_message"></div><p class="privacy">Your privacy is kept safe and anonymous. <span><a href="#" title="Read our privacy policy here">Read our privacy policy here</a></span></p></div>
						</div>
						<div class="col-md-4">
							<img class="roiimg" title="Calculate The ROI On Your Ads" src="images/roi-logo@1x.png" />
						</div>				
						<div class="clearfix"></div>						
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</fieldset>
				<fieldset id="currentdata">
					<div class="container">
						<div class="row">
						<div class="col-md-6">
							<a class="previous btn-previous"></a>
							<h2 class="section-title"><span>Use this Calculator to find out</span> <span>how high your ROI can go</span></h2>
							<div class="form-row"><div class="form-column"><input type="button" name="btncurrentdata" class="next btn btn-right" id="btncurrentdata" value="Next" title="Next" /></div><div class="error_message"></div></div>
						</div>
						<div class="col-md-6">
						</div>				
						<div class="clearfix"></div>						
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</fieldset>
				<fieldset id="optionitem">
					<div class="container">
						<div class="row">
						<div class="col-md-6">
							<a class="previous btn-previous"></a>
							<div class="form-row"><div class="form-column"><input type="submit" name="btnoptionitem" class="next btn btn-right" id="btnoptionitem" value="Next" title="Next" /></div><div class="error_message"></div></div>						
						</div>
						<div class="col-md-6">
						</div>				
						<div class="clearfix"></div>						
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</fieldset>				
			</form>
			<div class="clearfix"></div>
		</div>
		
		<footer class="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<p class="terms">Note: How are we collecting and storing data here? <a href="#" title="How are we collecting and storing data here?">Click here</a></p>
					</div>
					<div class="col-md-6">
						<p class="copyright">Cube-culator for Ad Optimization <span>|</span> Cubatica 2018</p>
					</div>				
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>			
		</footer>		
	</div>
	
	<script src="js/angular.min.js" type='text/javascript'></script>
	<script src="js/angular-animate.js" type='text/javascript'></script>
	<script src="js/jquery-1.12.4.min.js" type='text/javascript'></script>
	<script src="js/jquery-ui.min.js" type='text/javascript'></script>
	<script src="js/bootstrap.min.js" type='text/javascript'></script>
	<script src="script/scripts.js" type='text/javascript'></script>
</body>
</html>