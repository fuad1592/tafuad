<?php
require 'init.php';

if($_GET['type'] == 'checkbox'):
	if($_POST['id']):
		$Id		= $_POST['id'];
		if($Id 	== 'kaprodi'):
			$SQL	= $Init->Query("SELECT nip, gelar_depan, nama, gelar_belakang FROM pegawai WHERE kelompok='kaprodi' OR kelompok='kadep'");
		elseif($Id == 'dosen'):
			$SQL	= $Init->Query("SELECT nip, gelar_depan, nama, gelar_belakang FROM pegawai WHERE kelompok='dosen' OR kelompok='kalab'");
		else:
			$SQL	= $Init->Query("SELECT nip, gelar_depan, nama, gelar_belakang FROM pegawai WHERE kelompok='".$Id."'");
		endif;
		$Init->Execute(
			array($SQL)
		);
		while($Data = $Init->FetchAssoc($SQL)):
			$Nama		= $Data['NAMA'];
			$GDepan		= $Data['GELAR_DEPAN'];
			$GBlkg		= $Data['GELAR_BELAKANG'];
			echo '<option value="'.$Data['NIP'].'|' . $GDepan . ' ' . $Nama . ' ' . $GBlkg . '" id="1">' . $GDepan . ' ' . $Nama . ' ' . $GBlkg . '</option>';
		endwhile;
	else:
		echo '<option>-</option>';
	endif;
elseif($_GET['type'] == 'select'):
	if($_POST['id'] == 'J'):
		$Id		= $_POST['id'];
		$SQL	= $Init->Query("SELECT id_jurusan,nama_jurusan FROM jurusan");
		$Init->Execute(
			array($SQL)
		);
		while($Data = $Init->FetchAssoc($SQL)):
			$Idjur	= $Data['ID_JURUSAN'];
			$Nama	= $Data['NAMA_JURUSAN'];
			echo '<option value="'.$Idjur.'">' . $Nama . '</option>';
		endwhile;
	else:
		echo '<option>-</option>';
	endif;
elseif($_GET['type'] == 'autocomplete'):
	#if(isset($_REQUEST['term'])):
		$Array 	= array();
		$SQL	= $Init->Query('SELECT NAMA_RUANGAN FROM RUANGAN WHERE NAMA_RUANGAN LIKE \'%'.$_REQUEST['term'].'%\'');
		$Init->Execute(
			array($SQL)
		);
		while($Data = $Init->FetchAssoc($SQL)):
			$Array[] = $Data['NAMA_RUANGAN'];
		endwhile;
		echo json_encode($Array);
	#endif;
endif;
