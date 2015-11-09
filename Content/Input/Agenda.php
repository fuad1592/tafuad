	<header id="header" class="panel-heading">
    	<strong> Detail Agenda Notulensi </strong>
    </header>
    <section id="input" class="panel" style="border: none !important;">
        <div class="panel-body">
        	<?php
				$GetQ		= $_GET['q'];
				$Decrypt	= $Init->Decrypt($_GET['q']);
				$NoRTM		= $Decrypt;
				$_GET['q'] != $Init->Encrypt($NoRTM) ? header('Location: http://www.google.co.id') : ' ';
				$SQL	= $Init->Query('SELECT * FROM NOTULENSI WHERE NO_RTM = \''.$NoRTM.'\'');
				$Init->Execute(
					array($SQL)
				);
				$Result	= $Init->FetchAssoc($SQL);
				$ExpRTM		= explode('/',$NoRTM);
				$ExpTanggal	= explode('-',end($ExpRTM));
				$ExpJam1	= explode(':',$Result['JAM_MULAI']);
				$ExpJam2	= explode(':',$Result['JAM_SELESAI']);
			?>
            <form method="post" class="form-horizontal">
                <div class="pull-left col-sm-11" style="padding-left: 0px !important;">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left" >No. RTM</label>
                        <div class="col-sm-6 media m-t-none">:
                            <?=$NoRTM?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left" >Hari / Tanggal</label>
                        <div class="col-sm-8 media m-t-none">:
                            <?=$Result['TANGGAL']?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left" >Ruang / Tempat</label>
                        <div class="col-sm-8 media m-t-none">:
                            <?=$Init->GetIDRuangan($Result['ID_RUANGAN'])?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left " >Pukul</label>
                        <div class="col-sm-8 media m-t-none">:
                            <?=current($ExpJam1);?>:<?=end($ExpJam1);?> s/d <?=current($ExpJam2);?>:<?=end($ExpJam2);?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left " >Undangan Berdasarkan</label>
                        <div class="col-sm-8 media m-t-none">:

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left " >Level Rapat</label>
                        <div class="col-sm-8 media m-t-none">:

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left " >Pimpinan Rapat</label>
                        <div class="col-sm-8 media m-t-none">:
                            <?=$Result['KEPALA']?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left " >Jenis Rapat</label>
                        <div class="col-sm-8 media m-t-none">:
                            <?=$Result['JENIS_RAPAT']?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left " >Kehadiran</label>
                        <div class="col-sm-8 media m-t-none">:
                            <?=$Init->GetPeserta($NoRTM,'PESERTA')?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left " >Notulis</label>
                        <div class="col-sm-8 media m-t-none">:
                            <?=$Result['NOTULEN']?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left">Lain-Lain</label>
                        <div class="col-sm-8 media m-t-none">
                        	<input type="hidden" name="tag2" id="select2-2" style="width:260px" value="<?=$Init->GetPeserta($NoRTM,'PESERTA LAIN')?>"/> &nbsp;&nbsp;<?=count(explode(',',$Init->GetPeserta($NoRTM,'PESERTA LAIN')))?> Orang
                       	</div>
              		</div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left " >Uraian / Permasalah</label>
                        <div class="col-sm-8 media m-t-none">
                            <textarea placeholder="Uraian / Permasalah" rows="5" class="form-control"><?=$Init->GetTopikAgenda($NoRTM)?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left " >Tindak Lanjut / Hasil</label>
                        <div class="col-sm-8 media m-t-none">
                            <textarea name="tindak" placeholder="Tindak Lanjut / Hasil" rows="5" class="form-control"><?=$Init->GetTopikAgenda($NoRTM,'TINDAK_LANJUT')?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left " >Penanggung Jawab</label>
                        <div class="col-sm-8 media m-t-none">
                            <textarea name="penanggung" placeholder="Penanggung Jawab" rows="4" class="form-control"><?=$Init->GetTopikAgenda($NoRTM,'PENANGGUNG_JAWAB')?></textarea>
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
					$Query	= $Init->Query("
						UPDATE DETAIL SET
							TINDAK_LANJUT = '".$_POST['tindak']."',
							PENANGGUNG_JAWAB = '".$_POST['penanggung']."'
						WHERE NO_RTM = '".$NoRTM."'
					");
					$Execute = $Init->Execute(
						array($Query)
					);
					if($Execute){
						header('Location: ../'.$Init->Root.'/?id=listnotulen&year='.date('Y'));
					} else {
						var_dump ($Execute);
					}
				endif;
			?>
        </div>
    </section>
