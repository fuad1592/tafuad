	<section id="content" class="m-t-lg wrapper-md animated fadeInDown">
        <a class="nav-brand" href="">
            <img src="Assets/img/logo-pens.fw.png" width="175" height="175"> 
        </a>
        <div class="row m-n"> 
            <div class="col-md-4 col-md-offset-4 m-t-lg"> 
                <section class="panel"> 
                    <form method="post" class="panel-body"> 
                        <div class="form-group"> 
                            <label class="control-label">E-Mail</label> 
                            <input type="text" name="username" id="inputUsername" placeholder="E-Mail" class="form-control" autofocus required> 
                        </div> 
                        <div class="form-group"> 
                            <label class="control-label">Kata Sandi</label> 
                            <input type="password" name="password" id="inputPassword" placeholder="Kata Sandi" class="form-control" required> 
                        </div> 
                        <div class="checkbox"> 
                            <label> 
                            <input type="checkbox"> Tetap Masuk </label> 
                        </div> 
                        <button type="submit" name="submit" class="btn btn-success">Masuk</button> 
                        <div class="line line-dashed"></div> 
                    </form>
                    <?php
						/*# ========== LOGIN ==========#*/
						if(isset($_POST['submit'])):
							$Data = $Init->Login(
								$_POST['username'],$_POST['password']
							);
							if($Data == FALSE):
								header('Location: ../'.$Init->Root.'/');
							else:
								$_SESSION['idUser']		= $Data['USERNAME'];
								$_SESSION['idJabatan']	= $Data['JABATAN'];
								header('Location: ../'.$Init->Root.'/?id=listnotulen&year='.date('Y'));
							endif;
						endif;
					?> 
                </section> 
            </div> 
        </div>
    </section>
    <footer id="footer"> 
        <div class="text-center padder clearfix"> 
            <p> 
                <small>Sistem Informasi Manajemen Review - Politeknik Elektronika Negeri Surabaya<br>&copy; 2014</small> 
            </p> 
        </div> 
    </footer>
