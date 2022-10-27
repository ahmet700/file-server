<?php
session_start();
$mypassword ="123456";  /* Şifrenizi Değiştirmeyi Unutmayın*/

if(@$_GET['logout']==1)
{
	unset($_SESSION['melogin']);
	session_destroy();
}

if(!isset($_SESSION['melogin'])) {
	
	if(isset($_POST['ctx']))
	{
		if ($_POST['ctx']==$mypassword) {
			
			$_SESSION['melogin'] = true;
			header("refresh:0");
			//die();
			
		}
		
		
		
	} else {
		?>
		<form action="index.php" method="post">
		<label>
			<input name="ctx" type="text" value="">
			<input type="submit" value="giriş">
		</label>
		</form>
		<?php
		die();
	}
	
	
	
	
die('Yanlış Şifre');
}

function hfilesize($bytes, $decimals = 2) {
 // $bytes =  ($bytes);
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor].'b';
}
?>
<!doctype html>
<html lang="tr">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<title>Upload</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<h1>Upload</h1>
				<form id="uploadForm" enctype="multipart/form-data">
					<div class="form-group">
						<label for="file">Yüklenecek Dosya</label>
						<input type="file" class="form-control" name="file" id="file" required />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Upload</button>
					</div>
				</form>
				<div id="result"></div>
			</div>
		</div>
		<a href="index.php?logout=1" style="float:right">Çıkış</a>
		<div class="">Kabul Edilen Max Dosya Boyutu: <?= (ini_get('upload_max_filesize'));?></div>
		<div class="">Kabul Edilen Max POST Boyutu: <?= (ini_get('post_max_size'));?></div>
		<table class="table ">
		<thead class="thead-light">
			<tr>
				<td>sıra</td>
				<td>Adı</td>
				<td>Dosya Boyutu</td>
				<td>İşlem</td>
			</tr>
		</thead>
		<tbody>
		<?php
		$i=0;
foreach (glob("u/*") as $dosya) {
	
	if (is_file($dosya)) {
		$i++;
	?>
    <tr>
		<td><?=$i?></td>
		<td><a href="<?=$dosya?>" target="_blank"><?=basename($dosya)?></a></td>
		<td><?=hfilesize(filesize($dosya))?></td>
		<td><form action="upload.php" method="post" onSubmit="return confirm('Bu Dosya Silinecek);">
		<input type="hidden" name="filename" value="<?=base64_encode(basename($dosya))?>">
		<input type="submit" value="Sil">
		</form>
		</td>
	
</tr>	
	
	<?php
}}
?>
<tbody>
</table>
		
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="assets/custom.js"></script>
</body>
</html>