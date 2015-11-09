	<header id="header" class="panel-heading">
    	<strong> Notulen Rapat Tinjauan Manajemen - Periode <?=!isset($_GET['year']) ? date('Y') : $_GET['year']?></strong> 
    </header>
    <section id="input" class="panel" style="border: none !important;">
    	<div class="panel-body">
            <div class="pull-left">
                <form method="post" class="form-horizontal">
                    <label class="m-r-sm">Periode : </label>
                    <select name="age" class="form-control input-sm input-s-sm inline agePost" style="width: 75px !important;" onchange="window.location.href='?id=listnotulen&year='+this.form.age.options[this.form.age.selectedIndex].value"> 
                        <?php for($i=0;$i<6;$i++): ?>
                            <option <?=$_GET['year'] == date('Y') - $i ? 'selected' : ''?>><?=date('Y') - $i?></option> 
                        <?php endfor; ?>
                    </select>
                </form>
            </div>
            <div class="pull-right col-sm-4">
                <form method="post" class="form-horizontal pull-right">
                    <label class="m-r-sm">Cari</label> 
                    <input type="text" name="tanggal" class="form-control input-s-sm inline">
                    <button type="submit" name="cari" id="idFormElector" class="btn btn-success">
                        <i class="icon-search"></i>
                    </button>
                </form>
            </div>
    	</div>
        <?php if(isset($_POST['cari'])): ?>
        
        <?php else: ?>
        <div class="panel-body" style="padding-top:0px !important;">
            <table class="table table-striped b-t" style="margin-bottom: 0px !important; padding-bottom:0px !important" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th class="fc-header-center b-l" style="vertical-align:middle !important;">No.</th>
                        <th class="fc-header-center" style="vertical-align:middle !important;">Data Rapat</th>
                        <th class="fc-header-center" style="vertical-align:middle !important;">Level Rapat</th>
                        <th class="fc-header-center" style="vertical-align:middle !important;">Jenis Rapat</th>
                        <th class="fc-header-center" style="vertical-align:middle !important;">Jumlah Kehadiran</th>
                        <th class="fc-header-center" style="vertical-align:middle !important;">Notulis</th>
                        <th class="fc-header-center" style="vertical-align:middle !important;">Topik Agenda</th>
                        <th class="fc-header-center" style="border-right:1px solid #E0E4E8 !important;vertical-align:middle">Cetak</th>
                        <th class="fc-header-center" style="border-right:1px solid #E0E4E8 !important;vertical-align:middle">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
						$Query 	= $Init->Query('SELECT * FROM NOTULENSI WHERE TANGGAL LIKE \'%'.$_GET['year'].'%\' ORDER BY ID ASC');
						$Init->Execute(
							array($Query)
						);
						$i		= 0;
						while($Fetch = 	$Init->FetchAssoc($Query)):
					?>
                    <tr>
                        <td align="center" class="b-r b-l b-b" valign="middle" style="width:1% !important;vertical-align:middle !important;">
                        	<?=$i+1?>
                        </td>
                        <td align="left" class="b-r b-b" style="width:12% !important;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="padding:0px !important; ">
                              <tr>
                                <td style="border:1px solid #000 !important;padding:5px !important;">No. Rapat</td>
                                <td style="border:1px solid #000 !important;padding:5px !important;">
									<?php if($_SESSION['idUser'] == $Fetch['NOTULEN']): ?>
                                    : <a href="?id=editnotulen&q=<?=$Init->Encrypt($Fetch['NO_RTM'])?>"><?=$Fetch['NO_RTM']?></a>
                                    <?php else: ?>
                                    : <?=$Fetch['NO_RTM']?>
                                    <?php endif; ?>
                                </td>
                              </tr>
                              <tr>
                                <td style="border:1px solid #000 !important;padding:5px !important;">Tanggal</td>
                                <td style="border:1px solid #000 !important;padding:5px !important;">: <?=$Fetch['TANGGAL']?></td>
                              </tr>
                              <tr>
                                <td style="border:1px solid #000 !important;padding:5px !important;">Ruang</td>
                                <td style="border:1px solid #000 !important;padding:5px !important;">: <?=$Init->GetIDRuangan($Fetch['ID_RUANGAN'])?></td>
                              </tr>
                              <tr>
                                <td style="border:1px solid #000 !important;padding:5px !important;">Waktu</td>
                                <td style="border:1px solid #000 !important;padding:5px !important;">: <?=$Fetch['JAM_MULAI']?> s/d <?=$Fetch['JAM_SELESAI']?></td>
                              </tr>
                              <tr>
                                <td style="border:1px solid #000 !important;padding:5px !important;">Pimpinan Rapat</td>
                                <td style="border:1px solid #000 !important;padding:5px !important;">: <?=$Fetch['KEPALA']?></td>
                              </tr>
                            </table>
                        </td>
                        <td align="center" class="b-r b-b" style="width:5% !important;vertical-align:middle !important;">
                        	<?=$Init->GetLevelRapat($Fetch['LEVEL_RAPAT'])?>
                        </td>
                        <td align="center" class="b-r b-b" style="width:3% !important;vertical-align:middle !important;">
                        	<?=$Fetch['JENIS']?>
                        </td>
                        <td align="center" class="b-r b-b" style="width:3% !important;vertical-align:middle !important;">
                        	<?=$Fetch['JUMLAH']?> Orang
                        </td>
                        <td align="center" class="b-r b-b" style="width:3% !important;vertical-align:middle !important;">
                        	<?=$Fetch['NOTULEN']?>
                        </td>
                        <td align="center" class="b-r b-b" style="width:3% !important;vertical-align:middle !important;">
                        	<?php if($_SESSION['idUser'] == $Fetch['NOTULEN']): ?>
                        	<a href="?id=editagenda&q=<?=$Init->Encrypt($Fetch['NO_RTM'])?>">Isi Data</a>
                            <?php else: ?>
                        	Isi Data
                            <?php endif; ?>
                        </td>
                        <td align="center" class="b-r b-b" style="width:2% !important;vertical-align:middle !important;">
                        	Cetak
                        </td>
                        <td align="center" class="b-r b-b" style="width:2% !important;vertical-align:middle !important;">
                        	<a href="?id=hapusnotulen&q=<?=$Init->Encrypt($Fetch['NO_RTM'])?>">Hapus</a>
                        </td>
                    </tr>
                    <?php $i++; endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </section>
