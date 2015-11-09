	<section class="hbox stretch">
		<aside class="bg-primary aside-sm nav-vertical" id="nav">
            <section class="vbox">
                <header class="dker nav-bar" style="background-color:#103B64 !important;"> 
                    <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="body"> 
                        <i class="icon-reorder"></i> 
                    </a> 
                    <a href="../<?=$Init->Root?>" class="nav-brand">PENS</a> 
                    <a class="btn btn-link visible-xs" data-toggle="class:show" data-target=".nav-user"> 
                        <i class="icon-comment-alt"></i> 
                    </a> 
                </header> 
                <footer class="footer bg-gradient hidden-xs"> 
                    <a href="?id=signout" class="btn btn-sm btn-link m-r-n-xs pull-right"> 
                        <i class="icon-off"></i> 
                    </a> 
                    <a data-toggle="class:nav-vertical" class="btn btn-sm btn-link m-l-n-sm"> 
                        <i class="icon-reorder"></i> 
                    </a> 
                </footer>
                <section>
                    <div class="nav-user hidden-xs pos-rlt">
                        <div class="nav-avatar pos-rlt">
                            <a class="thumb-sm avatar animated" data-toggle="dropdown">
                                <img src="<?=IMG?>logo-ava.fw.png" alt="" class=""> 
                            </a>
                            <div class="visible-xs m-t m-b"> 
                                <a class="h4"></a> 
                                <p><i class="icon-map-marker"></i> </p> 
                            </div>   				
                        </div>
                        <div class="nav-msg">
                            <a class="dropdown-toggle" data-toggle="dropdown">
                                <b class="badge badge-white count-n">0</b>
                            </a>
                        </div>
                    </div>
                    <nav class="nav-primary hidden-xs">
                        <ul class="nav">
                            <li style="border-top:1px solid rgba(0,0,0,0.075) !important;">
                                <a id="push" class="class-bar" href="?id=inputnotulen"> 
                                    <i class="icon-pencil" style="color: #FFF !important;"></i> 
                                    <span style="color: #FFF !important;">Entry Data Baru</span>
                                </a>
                            </li>
                            <li style="border-top:1px solid rgba(0,0,0,0.075) !important;">
                                <a id="push" class="class-bar" href="?id=listnotulen"> 
                                    <i class="icon-pencil" style="color: #FFF !important;"></i> 
                                    <span style="color: #FFF !important;">Daftar Notulensi</span>
                                </a>
                            </li> 
                        </ul>
                    </nav>
                </section>
            </section>
        </aside>
        <section id="content">
            <section class="vbox">
					<header class="header bg-white b-b" align="center">
						<p id="jam" style="float: left !important;"></p>
                        <p style="float: right !important;">
                        	Masuk sebagai, <strong><?=$_SESSION['idUser']?></strong>
                        </p>
					</header>
                <section class="scrollable wrapper">
                    <div class="row">
                        <div id="content-load" class="col-lg-12">
                            <?php
								if($_GET['id'] == 'inputnotulen'):
									include CONTENT . 'Input/Input.php';
								elseif($_GET['id'] == 'listnotulen'):
									if(!isset($_GET['year'])):
										header('Location: ../'.$Init->Root.'/?id=listnotulen&year='.date('Y'));
									else:
										include CONTENT . 'Input/List.php';
									endif;
								elseif($_GET['id'] == 'editnotulen'):
									if(!isset($_GET['q'])):
										header('Location: ../'.$Init->Root.'/?id=listnotulen&year='.date('Y'));
									else:
										include CONTENT . 'Input/Edit.php';
									endif;
								elseif($_GET['id'] == 'hapusnotulen'):
									if(!isset($_GET['q'])):
										header('Location: ../'.$Init->Root.'/?id=listnotulen&year='.date('Y'));
									else:
										include CONTENT . 'Input/Delete.php';
									endif;
								elseif($_GET['id'] == 'editagenda'):
									if(!isset($_GET['q'])):
										header('Location: ../'.$Init->Root.'/?id=listnotulen&year='.date('Y'));
									else:
										include CONTENT . 'Input/Agenda.php';
									endif;
								elseif($_GET['id'] == 'signout'):
									unset($_SESSION['iduser']);
									session_destroy();
									header('Location: ../'.$Init->Root);
								else:
									header('Location: ../'.$Init->Root.'/?id=listnotulen&year='.date('Y'));
								endif;
							?>
                            <!--
                                <section class="panel">
                                </section>
                            -->                    
                        </div>
                    </div>
                </section>
            </section>
            <a class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="body"></a>
        </section>
    </section>