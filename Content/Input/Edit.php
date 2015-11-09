<header id="header" class="panel-heading">
<strong> Entry Data Notulen </strong>
</header>
<section id="input" class="panel" style="border: none !important;">
	<div class="panel-body">
		<?php
		$GetQ = $_GET['q'];
		$Decrypt = $Init->Decrypt($_GET['q']);
		$NoRTM = $Decrypt;
		$_GET['q'] != $Init->Encrypt($NoRTM) ? header('Location: http://www.google.co.id') : ' ';
		$SQL	= $Init->Query('SELECT * FROM NOTULENSI WHERE NO_RTM = \''.$NoRTM.'\'');
		$Init->Execute(array($SQL));
		$Result	= $Init->FetchAssoc($SQL);
		$ExpRTM		= explode('/',$NoRTM);
		$ExpTanggal	= explode('-',end($ExpRTM));
		$ExpJam1	= explode(':',$Result['JAM_MULAI']);
		$ExpJam2	= explode(':',$Result['JAM_SELESAI']);
		?>
		<form method="post" class="form-horizontal">
			<div class="pull-left col-sm-11" style="padding-left: 0px !important;">
				<div class="form-group">
					<label class="col-sm-3 control-label text-left" >Tanggal</label>
					<div class="col-sm-6 media m-t-none">
						<input type="text" name="tanggal" id="datepicker" class="bg-focus form-control input-s-sm text-center" style="display:inline !important;" value="<?=str_replace('.','/',$ExpTanggal[0])?>">
					</div>
        </div>
				<div class="form-group">
					<label class="col-sm-3 control-label text-left" >Ruang / Tempat</label>
					<div class="col-sm-8 media m-t-none">

						<select name="ruang" class="form-control" style="width:150px !important;display: inline !important;">
							<option value="<?=$Result['ID_RUANGAN']?>"><?=$Init->GetIDRuangan($Result['ID_RUANGAN'])?></option>
							<option disabled="disabled">-</option>
							<?php
							$SQL	= $Init->Query('SELECT * FROM RUANGAN ORDER BY NAMA_RUANGAN ASC');
							$Init->Execute(array($SQL));
							while($Data = $Init->FetchAssoc($SQL)):
							?>
							<option value="<?=$Data['ID_RUANGAN']?>"><?=$Data['NAMA_RUANGAN']?></option>
							<?php endwhile; ?>
						</select>

					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label text-left" >Pukul</label>
					<div class="col-sm-8 media m-t-none">
						<input type="text" name="jam1" class="combodate form-control" data-format="HH:mm" data-template="HH : mm" value="<?=current($ExpJam1);?>:<?=end($ExpJam1);?>"> -
						<input type="text" name="jam2" class="combodate form-control" data-format="HH:mm" data-template="HH : mm" value="<?=current($ExpJam2);?>:<?=end($ExpJam2);?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label text-left " >Undangan Berdasarkan</label>
					<div class="col-sm-8 media m-t-none">
						<div class="checkbox" style="display:inline !important;">
							<label class="checkbox-custom">
								<input type="checkbox" name="sms"> <i class="icon-unchecked"></i> SMS</label>
						</div>
					<div class="checkbox" style="display:inline !important;">
						<label class="checkbox-custom">
							<input type="checkbox" name="undangan"> <i class="icon-unchecked"></i> Undangan</label>
					</div>
					<div class="checkbox" style="display:inline !important;">
						<label class="checkbox-custom">
							<input type="checkbox" name="telepon"> <i class="icon-unchecked"></i> Telepon</label>
					</div>
							<div class="checkbox" style="display:inline !important;">
                            	<label class="checkbox-custom">
                                <input type="checkbox" name="email"> <i class="icon-unchecked"></i> E-Mail</label>
                           	</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left" >Level Rapat</label>
                        <div class="col-sm-8 media m-t-none" style="">
                            <select name="level" id="level_rapat" class="form-control" style="width:150px !important;display: inline !important;">
                            	<option value="<?=$Result['LEVEL_RAPAT']?>"><?=$Init->GetLevelRapat($Result['LEVEL_RAPAT'])?></option>
                         	</select>
                            <select name="sublevel" id="bagian_level_rapat" class="form-control" style="width:150px !important;display: inline !important;">
                                <option disabled>-</option>
                         	</select>
                            <select name="pimpinan" class="form-control" style="width:150px !important;display: inline !important;">
                                <option><?=$Result['KEPALA']?></option>
                         	</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left" >No. RTM</label>
                        <div class="col-sm-8 media m-t-none">
                            <input type="text" name="no1" id="val_col_1" class="bg-focus form-control input-s-sm text-center" style="display:inline !important;width:45px !important" value="<?=$ExpRTM[0]?>" readonly> /
                            <input type="text" name="no2" id="val_col_2" class="bg-focus form-control input-s-sm text-center" style="display:inline !important;width:35px !important" value="<?=current(explode('-',$ExpRTM[1]))?>" readonly> -
                            <input type="text" name="no3" id="val_col_3" class="bg-focus form-control input-s-sm text-center" style="display:inline !important;width:75px !important" value="<?=explode('-',$ExpRTM[1])[1]?>" readonly> /
                            <input type="text" name="no4" id="val_col_4" class="bg-focus form-control input-s-sm text-center" style="display:inline !important;" readonly> -
                            <input type="text" name="no5" id="val_col_5" class="bg-focus form-control input-s-sm text-center" style="display:inline !important;width:75px !important" value="<?=end($ExpTanggal)?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left" >Jenis Rapat</label>
                        <div class="col-sm-8 media m-t-none">
                            <select name="jenis" class="form-control" style="width:150px !important;">
                            	<option>Urgent</option>
                                <option>Assiten Direktur</option>
                            	<option>Kajur/Sekjur/Kaprodi</option>
                            	<option>Ka Unit</option>
                                <option>Ka Subbag</option>
                         	</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left " >Kehadiran</label>
                        <div class="col-sm-8 media m-t-none">
                        	<div id="checkbox_kehadiran" style="float: left !important">
                                <div class="checkbox">
                                    <label class="checkbox-custom">
                                    <input type="checkbox" name="direktur" value="bos"> <i class="icon-unchecked"></i> Direktur</label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-custom">
                                    <input type="checkbox" name="asdir" value="asdir"> <i class="icon-unchecked"></i> Assiten Direktur</label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-custom">
                                    <input type="checkbox" name="kaprodep" value="kaprodi"> <i class="icon-unchecked"></i> Kaprodi / Kadep</label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-custom">
                                    <input type="checkbox" name="kaunit" value="kplunit"> <i class="icon-unchecked"></i> Ka Unit</label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-custom">
                                    <input type="checkbox" name="kasubbag" value="kasubag"> <i class="icon-unchecked"></i> Ka Subbag</label>
                                </div>
                                <div class="checkbox" style="display:inline !important;">
                                    <label class="checkbox-custom">
                                    <input type="checkbox" name="dosen" value="dosen"> <i class="icon-unchecked"></i> Dosen</label>
                                </div>
                                <div class="checkbox" style="display:inline !important;">
                                    <label class="checkbox-custom">
                                    <input type="checkbox" name="karyawan" value="karyawan"> <i class="icon-unchecked"></i> Karyawan</label>
                                </div>
                                <div class="checkbox" style="display:inline !important;">
                                    <label class="checkbox-custom">
                                    <input type="checkbox" name="lain" id="Lain"> <i class="icon-unchecked"></i> Lain-lain</label>
                                </div>
                            </div>
                            <div style="float:left;margin-left:15px !important">
                                <select name="daftaranggota" class="form-control" size="7" multiple="multiple" style="width:175px !important;display: inline !important;">
                                    <optgroup id="daftar_anggota" label="Daftar Anggota">
                                    </optgroup>
                                </select>
                            </div>
                            <div style="float:left;margin-left:15px !important">
                            	<br/><br/>
                            	<button type="button" name="btnRight" id="btnRight" class="btn"><i class="icon-arrow-right"></i></button>
                                	<br/><br/>
                            	<button type="button" name="btnRight" id="btnLeft" class="btn"><i class="icon-arrow-left"></i></button>
                            </div>
                            <div style="float:left;margin-left:15px !important">
                                <select name="hadir[]" id="hadir" class="form-control" size="7" multiple="multiple" style="width:175px !important;display: inline !important;">
                                    <optgroup id="daftar_hadir" label="Daftar Kehadiran">
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left">Peserta dari luar PENS</label>
                        <div class="col-sm-8 media m-t-none">
                        	<input type="hidden" name="tag1" id="select2-1" style="width:260px" disabled>
                       	</div>
              		</div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left">Topik Agenda</label>
                        <div class="col-sm-8 media m-t-none">
                        	<input type="hidden" name="tag2" id="select2-2" style="width:260px" value="<?=$Init->GetTopikAgenda($NoRTM)?>"/>
                       	</div>
              		</div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left" >Jumlah Kehadiran</label>
                        <div class="col-sm-1 media m-t-none">
                            <input type="text" name="jumlahhadir" id="jumlah_hadir" class="text-center bg-focus form-control" value="<?=$Result['JUMLAH']?>" readonly>
                        </div>
                        <select name="notulis" class="form-control" style="width:150px !important;display:inline !important;">
                            <option><?=$_SESSION['idUser']?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left" ></label>
                        <div class="m-b col-sm-3">
                        	<button type="submit" name="submit" id="idFormElector" class="btn btn-success">
                            	Ubah
                         	</button>
                    	</div>
                    </div>
        		</div>
            </form>
            <?php
				if(isset($_POST['submit'])):
					print_r($_POST).'<br/>';
					$Ruangan	= $_POST['ruang'];
					$Tanggal	= $_POST['tanggal'];
					$JMulai		= $_POST['jam1'];
					$Jenis		= $_POST['jenis'];
					$Level		= $_POST['level'];
					$Lain		= explode(',',$_POST['tag1']);
					$Jumlah		= $_POST['jumlahhadir']+($Lain == 0 || $Lain == NULL ? 0 : count($Lain));
					$JSelesai	= $_POST['jam2'];
					$Agenda		= $_POST['tag2'];
					$Notulen	= $_POST['notulis'];
					$Pimpinan	= $_POST['pimpinan'];
					$QueryA		= $Init->Query("
						UPDATE NOTULENSI SET
							ID_RUANGAN = '".$Ruangan."',
							ID_ASSISTEN = ' ',
							TANGGAL = '".date('M/d/Y',strtotime($Tanggal))."',
							KEPADA = ' ',JABATAN = ' ',BAGIAN = ' ',TANGGAL_RTM = ' ',
							JAM_MULAI = '".$JMulai."',TEMPAT = ' ',DIBUAT = ' ',DISETUJUI = ' ',
							JENIS = '".$Jenis."',KEPALA = '".$Pimpinan."',
							LEVEL_RAPAT = '".$Level."',
							JUMLAH = '".$Jumlah."',
							NOTULEN = '".$Notulen."',
							JENIS_RAPAT = ' ',LEVELAN = ' ',
							JAM_SELESAI = '".$JSelesai."',
							KODE1_RTM = ' ',KODE2_RTM = ' '
						WHERE NO_RTM = '".$NoRTM."'
					");
					$QueryB		= $Init->Query("
						UPDATE DETAIL SET
							AGENDA = '".$Agenda."',
							TINDAK_LANJUT = ' ',
							PENANGGUNG_JAWAB = ' ',TARGET = ' ',TANGGAL_TARGET = ' '
						WHERE NO_RTM = '".$NoRTM."'
					");
					$Execute = $Init->Execute(
						array($QueryA,$QueryB)
					);
					if($Execute):
						if($Execute != FALSE):
							header('Location: ../'.$Init->Root.'/?id=listnotulen&year='.date('Y'));
						else:
							var_dump ($Execute);
						endif;
					else:
						var_dump ($Execute);
					endif;
				endif;
			?>
        </div>
    </section>
