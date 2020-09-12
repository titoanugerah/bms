<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php echo 'BMS | '.$viewName; ?></title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/img/icon.ico" type="image/x-icon"/>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet" />
	<!-- Fonts and icons -->
	<script src="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/css/demo.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="<?php echo base_url(''); ?>" class="logo" style="color:white;">
					Backup Monitoring 
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<div class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." id="keyword" class="form-control">
							</div>
						</div>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret" <?php if(!$this->session->userdata('isLogin')){echo 'hidden';} ?>>
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<span class="notification">4</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">You have 4 new notification</div>
								</li>
								<li>
									<div class="notif-scroll scrollbar-outer">
										<div class="notif-center">
											<a href="#">
												<div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
												<div class="notif-content">
													<span class="block">
														New user registered
													</span>
													<span class="time">5 minutes ago</span>
												</div>
											</a>
										</div>
									</div>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<input type="text" id="isLogin" value="<?php echo $this->session->userdata('isLogin'); ?>" hidden>
									<img src="<?php if(!$this->session->userdata('isLogin')){echo base_url('assets/picture/user.jpg');} else { echo $this->session->userdata('image');}?>" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn" >
								<div class="dropdown-user-scroll scrollbar-outer" <?php if(!$this->session->userdata('isLogin')){echo "hidden";}?>>
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="<?php echo $this->session->userdata('image'); ?>" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?php echo $this->session->userdata('name'); ?></h4>
												<p class="text-muted"><?php echo $this->session->userdata('email') ?></p><a href="<?php echo base_url('profile'); ?>" class="btn btn-xs btn-secondary btn-sm">Lihat Profil</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Keluar</a>
									</li>
								</div>

                <div class="dropdown-user-scroll scrollbar-outer" <?php if($this->session->userdata('isLogin')){echo "hidden";}?>>
									<li>
										<div class="user-box">
                      <div class="card card-info card-annoucement card-round">
                        <div class="card-body text-center">
                          <div class="card-opening">Belum Login</div>
                          <div class="card-desc">
                            Silahkan lakukan login terlebih dahulu dengan mengklik tombol login dibawah ini
                          </div>
                          <div class="card-detail">
                            <a class="btn btn-light btn-rounded" href="<?php echo $this->session->flashdata('link'); ?>">Login</a>
                          </div>
                        </div>
                      </div>
                    </div>
									</li>

								</div>

							</ul>

						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="<?php if(!$this->session->userdata('isLogin')){echo base_url('assets/picture/user.jpg');} else { echo $this->session->userdata('image');}?>" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?php if(!$this->session->userdata('isLogin')){echo "Belum Login"; } else {echo $this->session->userdata('name');} ?>
									<span class="user-level"><?php if(!$this->session->userdata('isLogin')){echo "Belum Login"; } else {echo $this->session->userdata('role');} ?></span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li <?php if(!$this->session->userdata('isLogin')){echo "hidden"; } ?>>
										<a href="<?php echo base_url('profile'); ?>">
											<span class="link-collapse">Profil Saya</span>
										</a>
									</li>
                  <li <?php if($this->session->userdata('isLogin')){echo "hidden"; } ?>>
										<a href="#edit">
											<span class="link-collapse">Login</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
            <?php if($this->session->userdata('isLogin')){$this->load->view('menu/'.$this->session->userdata('role'));} ?>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
        <?php $this->load->view($viewName); ?>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="https://www.themekita.com">
									Artwork
								</a>
							</li>

						</ul>
					</nav>
					<div class="copyright ml-auto">
						2020, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
					</div>
				</div>
			</footer>
		</div>

		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	<script src="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/js/core/popper.min.js"></script>
	<script src="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/js/core/bootstrap.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<!-- jQuery Scrollbar -->
	<script src="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Chart JS -->
	<script src="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/js/plugin/chart.js/chart.min.js"></script>


	<!-- Datatables -->
	<script src="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/js/plugin/datatables/datatables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
 
	<!-- Bootstrap Notify -->
	<script src="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- Sweet Alert -->
	<script src="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="<?php echo base_url('assets/template/AtlantisLite/'); ?>/assets/js/atlantis.min.js"></script>
	<?php
		if(file_exists('./assets/script/'.$viewName.'.js'))
		{
	    echo "<script type='text/javascript' src=".base_url('./assets/script/'.$viewName.'.js')."></script>";
	  }
	?>

	<script type="text/javascript">

	$(document).ready(function() {
	    $('.js-example-basic-single').select2();
			$('.select2-modal').select2();
	});
		//Notify
		<?php if($this->session->userdata('notify')){
			echo "notify('".$this->session->userdata['icon']."','".$this->session->userdata['title']."','".$this->session->userdata['message']."','".$this->session->userdata['type']."')";
		} ?>
		</script>
</body>
</html>
