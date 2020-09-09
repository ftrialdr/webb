<?php
$con=mysqli_connect('localhost','root','','tms');
include('includes/config.php');
$per_page=5;
$start=0;
$current_page=1;
if(isset($_GET['start'])){
	$start=$_GET['start'];
	if($start<=0){
		$start=0;
		$current_=1;
	}else{
		$current_page=$start; 
		$start--;
		$start=$start*$per_page;
	}
}
$record=mysqli_num_rows(mysqli_query($con,"select PackageId,PackageName,PackageType,PackageLocation,PackagePrice,PackageFeatures,PackageImage from tms"));
$pagi=ceil($record/$per_page);

$sql="select PackageId,PackageName,PackageType,PackageLocation,PackagePrice,PackageFeatures,PackageImage from tb_tour limit $start,$per_page";
$res=mysqli_query($con,$sql);
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
		<h2>Pencarian</h2>
		<form action="" method="post">
			<input type="text" name="kata_kunci" placeholder="Masukkan kata kunci" />
			<input type="submit" name="submit" value="Cari" />
		</form>
		
		<?php
		//jika tombol Cari di klik akan menjalankan script berikutnya
		if(isset($_POST['submit'])){
			//membuat variabel $kata_kunci yang menyimpan data dari inputan kata kunci
			$kata_kunci = $koneksi->real_escape_string(htmlentities(trim($_POST['kata_kunci'])));
			
			//cek apakah kata kunci kurang dari 3 karakter
			if(strlen($kata_kunci)<3){
				//pesan error jika kata kunci kurang dari 3 karakter
				echo '<p>Kata kunci terlalu pendek.</p>';
			}else{
				//membuat variabel $where dengan nilai kosong
				$where = "";
				
				//membuat variabel $kata_kunci_split untuk memecah kata kunci setiap ada spasi
				$kata_kunci_split = preg_split('/[\s]+/', $kata_kunci);
				//menghitung jumlah kata kunci dari split di atas
				$total_kata_kunci = count($kata_kunci_split);
				
				//melakukan perulangan sebanyak kata kunci yang di masukkan
				foreach($kata_kunci_split as $key=>$kunci){
					//set variabel $where untuk query nanti
					$where .= "kata_kunci LIKE '%$kunci%'";
					//jika kata kunci lebih dari 1 (2 dan seterusnya) maka di tambahkan OR di perulangannya
					if($key != ($total_kata_kunci - 1)){
						$where .= " OR ";
					}
				}
				
				//melakukan query ke database dengan SELECT, dan dimana WHERE ini mengambil dari $where
				$results = $koneksi->query("SELECT judul, LEFT(deskripsi, 60) as deskripsi, url FROM artikel WHERE $where");
				//menghitung jumlah hasil query di atas
				$num = $results->num_rows;
				//jika tidak ada hasil
				if($num == 0){
					//pesan jika tidak ada hasil
					echo '<p>Pencarian dengan kata kunci <b>'.$kata_kunci.'</b> tidak ada hasil.</p>';
				}else{
					//pesan jika ada hasil pencarian
					echo '<p>Pencarian dari kata kunci <b>'.$kata_kunci.'</b> mendapatkan '.$num.' hasil:</p>';
					//perulangan untuk menampilkan data
					while($row = $results->fetch_assoc()){
					//menampilkan data
						<div class="container">
							<div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
									<img src="images/tour/<?php echo htmlentities($result->PackageImage); ?>" class="img-responsive" alt="">
								</div>
								<div class="rom-btm">
								<div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
									<h4>Nama: <?php echo htmlentities($result->PackageName); ?></h4>
									<h6>Kategori : <?php echo htmlentities($result->PackageType); ?></h6>
									<p><b>Lokasi :</b> <?php echo htmlentities($result->PackageLocation); ?></p>
									<p><b>Fitur</b> <?php echo htmlentities($result->PackageFeatures); ?></p>
								</div>
							<div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
									<h5>Rp <?php echo htmlentities($result->PackagePrice); ?>.000</h5>
									<a href="package-details.php?pkgid=<?php echo htmlentities($result->PackageId); ?>" class="view">Details</a>
								</div>
						</div>
						
						<div class="clearfix"></div>
					}
				}
			}
		}
		?>
		<?php include('includes/header.php');?>

		<div class="container mt-100">
		  <h2 class="mb-30">Pagination Example</h2>
		  <ul class="list-group">
			<?php 
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_assoc($res)){?>
				<li class="list-group-item"><?php echo $row['title']?></li>
		    <?php } } else {?>
			No records
			<?php } ?>
		  </ul>              
		  <ul class="pagination mt-30">
			<?php 
			for($i=1;$i<=$pagi;$i++){
			$class='';
			if($current_page==$i){
				?><li class="page-item active"><a class="page-link" href="javascript:void(0)"><?php echo $i?></a></li><?php
			}else{
			?>
				<li class="page-item"><a class="page-link" href="?start=<?php echo $i?>"><?php echo $i?></a></li>
			<?php
			}
			?>
		    
			<?php } ?>
		  </ul>
		</div>
		
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