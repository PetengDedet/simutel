<?php
//Menampilkan semua pesan warning/error
ini_set('display_errors',1);  error_reporting(E_ALL);
?>
<!DOCTYPE HTML>
<html lang="id">
<head>
	<title>SimuTel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
	
	<style type="text/css">
	body {
		background-image: url("back2.png");
		background-repeat: repeat-x;
		background-position: bottom left;
	}
	</style>
</head>
<body>
	<div class="container">
		<div class="row clearfix">
			<div class="col-md-12">
				<center>
					<h1>
						<span class="glyphicon glyphicon-earphone pull-left"></span>
						SimuTel <small>Simulasi antrian telepon Pondok Pesantren</small>
						<span class="glyphicon glyphicon-phone-alt pull-right"></span>
						<div class="progress progress-striped active">
							<div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
								<span class="sr-only"></span>
							</div>
						</div>
					</h1>					
				</center>
				<div class="col-md-6" style="border-right:1px #ddd solid; margin-top:30px;">
					<form class="form-horizontal" role="form" action="" method="POST">
						<div class="form-group">
							<label for="santri" class="col-sm-6 control-label">Jumlah Santri</label>
							<div class="col-sm-6">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input id="santri" type="number" class="form-control" name="santri" required>
									<span class="input-group-addon">orang</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="pesawat" class="col-sm-6 control-label">Jumlah Pesawat Telepon</label>
							<div class="col-sm-5">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
									<input id="pesawat" type="number" class="form-control" name="pesawat" required>
									<span class="input-group-addon">buah</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="durasi" class="col-sm-6 control-label">Durasi Telepon</label>
							<div class="col-sm-5">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-dashboard"></span></span>
									<input id="durasi" type="number" class="form-control" name="durasi" required>
									<span class="input-group-addon">menit/santri</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="buka" class="col-sm-6 control-label">Jam Buka POSTEL</label>
							<div class="col-sm-5">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input id="buka" type="number" class="form-control" name="buka" required>
									<span class="input-group-addon">jam/hari</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="ideal" class="col-sm-6 control-label">Jarak Ideal Menelepon</label>
							<div class="col-sm-5">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-refresh"></span></span>
									<input id="ideal" type="number" class="form-control" name="ideal" required>
									<span class="input-group-addon">hari sekali</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-8 col-sm-2">
								<button name="simulasikan" type="submit" class="btn btn-primary">Simulasikan <span class="glyphicon glyphicon-play"></span></button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-6" style="margin-top:30px;">
					<?php
					if (isset($_POST['simulasikan'])) {
						if (!empty($_POST['santri']) && !empty($_POST['pesawat']) && !empty($_POST['durasi']) && !empty($_POST['buka']) && !empty($_POST['ideal'])){
							require_once 'simutel.class.php';
							$skj = new SimuTel($_POST['santri'],$_POST['pesawat'],$_POST['buka'],$_POST['durasi'],$_POST['ideal']);
							echo "<div class='alert alert-info' style='border-left:5px #337ab7 solid;'>";
							echo "<h5>Diketahui <span class='glyphicon glyphicon-info-sign'></span></h5>";
							echo "<p>";
							echo "<div class='col-md-6'><span class='glyphicon glyphicon-user'></span> Jumlah santri </div>= <strong>" . $skj -> getSantri(). "</strong> orang<br>";
							echo "<div class='col-md-6'><span class='glyphicon glyphicon-phone-alt'></span> Jumlah pesawat Telepon </div>= <strong>" . $skj -> getPesawat() . "</strong> buah<br>";
							echo "<div class='col-md-6'><span class='glyphicon glyphicon-dashboard'></span> Durasi bicara per santri </div>= <strong>" . $skj -> getDurasi() . "</strong> menit<br>";
							echo "<div class='col-md-6'><span class='glyphicon glyphicon-time'></span> Postel buka selama </div>= <strong>" . $skj -> getBuka() / 60 . "</strong> jam<br>";
							echo "<div class='col-md-6'><span class='glyphicon glyphicon-refresh'></span> Ideal telepon santri </div>= <strong>" . $skj -> getIdeal() . "</strong> hari<br>";
							echo "</p>";

							echo "<h5>Maka <span class='glyphicon glyphicon-exclamation-sign'></span></h5>";
							echo "<p>";
							echo "<div class='col-md-6'><span class='glyphicon glyphicon-user'></span> Postel dapat melayani </div> = <strong>" . round($skj -> satuHari()). "</strong> orang/hari<br>";
							echo "<div class='col-md-6'><span class='glyphicon glyphicon-retweet'></span> Siklus giliran</div> = <strong>" . round($skj -> putarGilir()) . "</strong> hari sekali<br>";
							echo "</p>";

							echo "<h5>Idealnya <span class='glyphicon glyphicon-thumbs-up'></span></h5>";
							echo "<p>";
							echo "<div class='col-md-6'><span class='glyphicon glyphicon-user'></span> POSTEL dapat melayani</div> = <strong>" . round($skj -> idealHari()) . "</strong> orang perhari <br>";
							echo "<div class='col-md-6'><span class='glyphicon glyphicon-phone-alt'></span> Jumlah ideal telepon</div> = <strong>" . round($skj -> pesawatIdeal()) . "</strong> buah<br>";
							echo "</p>";
							echo "</div>";
						}else{
							echo "<div class='alert alert-danger>";
							echo "<p>";
							echo "<strong>";
							echo "<span class='glyphicon glyphicon-arrow-right'Harap isi semua field yang tersedia";
							echo "</strong>";
							echo "</p>";
							echo "</div>";
						}
					}else{
						echo "<div class='alert alert-info'>";
						echo "<p>";
						echo "<strong>";
						echo "<span class='glyphicon glyphicon-arrow-left'></span> Harap isi semua field yang tersedia";
						echo "</strong>";
						echo "</p>";
						echo "</div>";
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="container" style="margin-top:230px;">
		<div class="row clearfix">
			<div class="col-md-12" id="">
			</div>
		</div>
	</div>
</body>
</html>