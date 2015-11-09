<?php require 'init.php'; ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=$Init->App['Title']?></title>
<meta name="description" content="<?=$Init->App['Description']?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" type="text/css" href="<?=CSS?>basic.css">
<link rel="stylesheet" href="<?=CSS?>jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?=FONT?>fonts.css">
<style type="text/css">
	li.ui-menu-item { font-size:12px !important; }
</style>
</head>

<body>
<?php
	if(!isset($_SESSION['idUser'])):
		require CONTENT . 'Login/Login.php' ;
	else:
		require CONTENT . 'Default/Default.php'; 
	endif;
?>
<script src="<?=JS?>basic.js"></script>
<script src="<?=JS?>common.js"></script>
</body>
</html>