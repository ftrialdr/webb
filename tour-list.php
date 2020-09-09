<?php
	session_start();
	error_reporting(0);
	include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>WisataGK | Tour List</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
		<link href="css/font-awesome.css" rel="stylesheet">

		<link href="images/logo.png" rel="icon">
	  	<link href="images/logo.png" rel="logo-icon">

		<!-- Custom Theme files -->
		<script src="js/jquery-1.12.0.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<!--animate-->
		<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
		<script src="js/wow.min.js"></script>
			<script>
				 new WOW().init();
			</script>
		<!--//end-animate-->
	</head>
	<body>

		<?php include('includes/header.php');?>

		<!--- banner ---->
		<div class="banner-3">
			<div class="container">
				<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> Jelajahi Indahnya Gunungkidul!</h1>
			</div>
		</div>
		<!--- /banner ---->

		<!--- rooms ---->
		<div class="rooms">
			<div class="container">
				
				<div class="room-bottom">
					<h3>Tour List</h3>
				
		<?php $sql = "SELECT * from tb_tour";
		$query = $dbh->prepare($sql);
		$query->execute();
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		$cnt=1;
		if($query->rowCount() > 0)
		{
		foreach($results as $result)
		{	?>
					<div class="rom-btm">
						<div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
							<img src="images/tour/<?php echo htmlentities($result->PackageImage);?>" class="img-responsive" alt="">
						</div>
						<div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
							<h4>Nama: <?php echo htmlentities($result->PackageName);?></h4>
							<h6>Kategori : <?php echo htmlentities($result->PackageType);?></h6>
							<p><b>Lokasi :</b> <?php echo htmlentities($result->PackageLocation);?></p>
							<p><b>Fitur</b> <?php echo htmlentities($result->PackageFeatures);?></p>
						</div>
						<div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
							<h5>Rp <?php echo htmlentities($result->PackagePrice);?>.000</h5>
							<a href="package-details.php?pkgid=<?php echo htmlentities($result->PackageId);?>" class="view">Details</a>
						</div>
						<div class="clearfix"></div>
					</div>

		<?php }} ?>
					
				
				
				</div>
			</div>
		</div>
		<!--- /rooms ---->

		<!--- /footer-top ---->
		<?php include('includes/footer.php');?>
		<!-- signup -->
		<?php include('includes/signup.php');?>			
		<!-- //signu -->
		<!-- signin -->
		<?php include('includes/signin.php');?>			
		<!-- //signin -->
		<!-- write us -->
		<?php include('includes/write-us.php');?>			
		<!-- //write us -->
	</body>
</html>