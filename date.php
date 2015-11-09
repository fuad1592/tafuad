<?php
	session_start();
	date_default_timezone_set('Asia/Jakarta');
	$Array	= array(
		'English' => array(
			'Day'	=> array('','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'),
			'Month'	=> array('','January','February','March','April','May','June','July','August','September','October','November','December')
		),
		'Bahasa' => array(
			'Day'	=> array('','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'),
			'Month'	=> array('','Januari','Februar','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember')
		),
		'Portuguese' => array(
			'Day'	=> array('','Segunda-feira','Terca-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado','Domingo'),
			'Month'	=> array('','Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro')
		)
	);
	$Day	= $Array['Bahasa']['Day'];
	$Month	= $Array['Bahasa']['Month'];
	if(@$_GET['id'] == 'short'):
		echo date('D, d M Y - H:i:s');
	else:
		echo str_replace(date('N'),$Day[date('N')],date('N')) . date(', d ') . str_replace(date('n'),$Month[date('n')],date('n')) . date(' Y - H:i:s');
	endif;
?>