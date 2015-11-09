<?php 
/**
 * Sistem Informasi Manajemen Review - Politeknik Elektronika Negeri Surabaya
 * 
 * @name		Modul.php
 * @author		Fuad Nasrudin ()
 */



class Modul 
{
	private $Key = '-_-donthackit-_-';
	public $DB,$App,$Root;
	public function __construct()
	{
		require_once '/Engine/Config.php';
		error_reporting($Config['Database']['ErrorDisp']);
		$this->DB	= $Config['Database'];
		$this->App	= $Config['Application'];
		$this->Root	= basename(getcwd());
		$this->Connection();
		
	}
	public function Connection()
	{
		if($this->DB['Status'] == 'Disable'):
			return NULL;
		elseif($this->DB['Status'] == 'Enable'):
			return oci_connect($this->DB['Username'], $this->DB['Password'], $this->DB['Host'] . '/' . $this->DB['ID']);
		else:
			return '';
		endif;
	}
	public function Cursor(){
		return oci_new_cursor($this->Connection());
	}
	public function Execute($Execute){
		$Exe = "";
		if(is_array($Execute)):
			for($i=0;$i<count($Execute);$i++):
				$Exe .= oci_execute($Execute[$i]);
			endfor;
		endif;
		return $Exe;
	}
	public function Query($SQLCommand){
		return oci_parse($this->Connection(), $SQLCommand);
	}
	public function SetRecap($Parse,$Cursor){
		oci_bind_by_name($Parse, ":REKAP", $Cursor, -1, OCI_B_CURSOR);
	}
	public function FetchAll($Statement,$Result){
		return oci_fetch_all($Statement,$Result);
	}
	public function FetchArray($Query){
		return oci_fetch_array($Query);
	}
	public function FetchAssoc($Query){
		return oci_fetch_assoc($Query);
	}
	public function FetchObject($Query){
		return oci_fetch_object($Query);
	}
	public function FetchRow($Query){
		return oci_fetch_row($Query);
	}
	public function FreeStatement($Statement){
		return oci_free_statement($Statement);	
	}
	public function NumRows($Query){
		return oci_num_rows($Query);
	}
	public function Base64Enc($Data)
	 {
		 return base64_encode($Data);
	 }
	 public function BaseEncrypt64($String)
	 {
		 $v 	= $this->Base64Enc($String);
		 $Data	= str_replace(array('+','/','='),array('-','_',''),$v);
		 return $Data;
	 }
	 public function Base64Dec($Data)
	 {
		  return base64_decode($Data);
	 }
	 public function BaseDecrypt64($String)
	 {
		 $Data = str_replace(array('-','_'),array('+','/'),$String); 
		 $Mode = strlen($Data) % 4; 
		 if($Mode):
		 	$Data .= substr('====', $Mode);
		 endif;
		 return $this->Base64Dec($Data);
	 }
	 public function Encrypt($String)
	 {
		 $IV_Size	= mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		 $IV		= mcrypt_create_iv($IV_Size, MCRYPT_RAND); 
		 $Crypter	= mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$this->Key,$String,MCRYPT_MODE_ECB,$IV);
		 return !$String ? FALSE : trim($this->BaseEncrypt64($Crypter));
	 }
	 public function Decrypt($String)
	 {
		 $Crypter	= $this->BaseDecrypt64($String);  
		 $IV_Size	= mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		 $IV		= mcrypt_create_iv($IV_Size, MCRYPT_RAND); 
		 $Decrypter	= mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$this->Key,$Crypter,MCRYPT_MODE_ECB,$IV); 
		 return !$String ? FALSE : trim($Decrypter);
	 }
}

class Procedure extends Modul 
{
	
	public function Login($Username=NULL,$Password=NULL){
		$SQL	= 'SELECT jabatan,username,password FROM pegawai WHERE username=\''.$Username.'\' AND password=\''.$Password.'\'';
		$Parse	= $this->Query($SQL);
		$this->Execute(
			array($Parse)
		);
		$Data	= $this->FetchAssoc($Parse);
		return $Data;
	}
	public function GetID(){
		$SQL	= 'SELECT ID FROM NOTULENSI ORDER BY ID DESC';
		$Parse	= $this->Query($SQL);
		$this->Execute(
			array($Parse)
		);	
		$Data	= $this->FetchAssoc($Parse);
		return $Data['ID']+1;
	}
	public function GetRTM(){
		$SQL	= 'SELECT NO_RTM,ID FROM NOTULENSI ORDER BY ID DESC';
		$Parse	= $this->Query($SQL);
		$this->Execute(
			array($Parse)
		);	
		$Data	= $this->FetchAssoc($Parse);
		return $Data['NO_RTM'] == NULL || $Data['NO_RTM'] == '' ? '0001' : substr($Data['NO_RTM'],strlen($Data['NO_RTM'])-4,3).($Data['ID']+1);
	}
	public function GetIDRuangan($Id){
		$SQL	= 'SELECT NAMA_RUANGAN FROM RUANGAN WHERE ID_RUANGAN=\''.$Id.'\' ORDER BY ID_RUANGAN ASC';
		$Parse	= $this->Query($SQL);
		$this->Execute(
			array($Parse)
		);	
		$Data	= $this->FetchAssoc($Parse);
		return $Data['NAMA_RUANGAN'];
	}
	public function GetLevelRapat($Value){
		$Array	= array(
			'U'=>'Umum',
			'P'=>'PENS (Non-RTM)',
			'RTM_PENS'=>'RTM PENS',
			'S'=>'Senat',
			'R'=>'Rapim',
			'A'=>'Asdir',
			'J'=>'Jurusan / Prodi',
			'K'=>'Tim Kurikulum',
			'T'=>'Tim PA',
			'B'=>'Subbag/Unit',
			'L'=>'Laboratorium'
		);
		return $Array[$Value];
	}
	public function GetTopikAgenda($No,$Return='AGENDA'){
		$SQL	= 'SELECT * FROM DETAIL WHERE NO_RTM=\''.$No.'\'';
		$Parse	= $this->Query($SQL);
		$this->Execute(
			array($Parse)
		);	
		$Data	= $this->FetchAssoc($Parse);
		return $Data[$Return];
	}	
	public function GetPeserta($No,$Type){
		$SQL	= 'SELECT * FROM PESERTA WHERE TYPE_PESERTA = \''.$Type.'\' AND NO_RTM=\''.$No.'\'';	
		$Parse	= $this->Query($SQL);
		$this->Execute(
			array($Parse)
		);	
		$Name	= '';
		while($Data = $this->FetchAssoc($Parse)):
			if($Type == 'PESERTA LAIN'){
				$Name .= $Data['NAMA_PESERTA'] . ',';
			} elseif($Type == 'PESERTA') {
				$Name .= '- ' . $Data['NAMA_PESERTA'] . '<br/>';	
			}
			
		endwhile;
		return $Type == 'PESERTA LAIN' ? substr($Name,0,strlen($Name)-1) : $Name;
	}
}