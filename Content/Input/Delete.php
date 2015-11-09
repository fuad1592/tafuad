<?php
if(isset($_GET['q'])):

	$GetQ		= $_GET['q'];
	$Decrypt	= $Init->Decrypt($_GET['q']);
	$NoRTM		= $Decrypt;
	$_GET['q'] != $Init->Encrypt($NoRTM) ? header('Location: http://www.google.co.id') : ' ';
	$SQL	= $Init->Query('DELETE FROM NOTULENSI WHERE NO_RTM = \''.$NoRTM.'\'');
	$Init->Execute(array($SQL));
	header('Location: ../'.$Init->Root.'/?id=listnotulen&year='.date('Y'));
	
endif;
