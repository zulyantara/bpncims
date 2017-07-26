<?php echo doctype('html5'); ?>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo APP_TITLE; ?></title>
		
		<link rel="stylesheet" href="<?php echo base_url('assets/uikit/css/uikit.gradient.min.css'); ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/my-style.css'); ?>" />
		
		<link rel="stylesheet" href="<?php echo base_url('assets/jquery/smoothness/jquery.ui.all.css'); ?>" />
		
		<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.0.3.js'); ?>"></script>
	</head>
	<body>
		<div id="my-id" class="uk-offcanvas">
			<div class="uk-offcanvas-bar">
				<ul class="uk-nav uk-nav-offcanvas">
					<li class="uk-nav-header">MENU</li>
					<li><a href="<?php echo base_url('cpanels'); ?>"><i class="uk-icon-home"></i> Home</a></li>
					<?php
					if($this->session->userdata('userlevel') == 0 OR $this->session->userdata("username") == "cs1" OR $this->session->userdata("username") == "cs2" OR $this->session->userdata("username") == "cs3" OR $this->session->userdata("username") == "cs4")
					{
						?>
						<li>
							<a href="<?php echo base_url('cpanels/frm_validasi_pendaftaran'); ?>">
								<i class="uk-icon-check-square-o"></i> Validasi Pendaftaran
							</a>
						</li>
						<?php
					}
					?>
					<li class="uk-nav-divider"></li>
					<li>
						<a href="<?php echo base_url('cpanels/form_tren_sekolah'); ?>">
							<i class="uk-icon-list"></i> Tren Sekolah
						</a>
					</li>
					<li>
						<a href="#offcanvas-kota-sekolah-aktif" data-uk-offcanvas><i class="uk-icon-list"></i> Sekolah Aktif</a>
					</li>
					<?php
					if($this->session->userdata('userlevel') == 0)
					{
						?>
						<li class="uk-nav-divider"></li>
						<li>
							<a href="<?php echo base_url('cpanels/form_lembaga_mitra'); ?>">
								<i class="uk-icon-list"></i> Daftar Lembaga Mitra
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('cpanels/form_bank'); ?>">
								<i class="uk-icon-list"></i> Daftar Bank
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('cpanels/form_kota'); ?>">
								<i class="uk-icon-list"></i> Daftar Kota
							</a>
						</li>
						<?php
					}
					?>
					<li class="uk-nav-divider"></li>
					<li>
						<a href="<?php echo base_url('pendaftaran/form_pendaftaran'); ?>">
							<i class="uk-icon-file-text"></i> Formulir Pendaftaran
						</a>
					</li>
					<li><a href="#offcanvas-kota" data-uk-offcanvas><i class="uk-icon-list"></i> Sekolah Terdaftar</a></li>
					<?php
					if($this->session->userdata('userlevel') == 0)
					{
						?>
						<li><a href="<?php echo base_url("home/list_lokasi_kompetisi"); ?>"><i class="uk-icon-anchor"></i> Lokasi Kompetisi</a></li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>
		
		<div class="uk-container uk-container-center main">
			<div class="uk-margin">
				<nav class="uk-navbar uk-navbar-attached">
					<a class="uk-navbar-toggle" data-uk-offcanvas="{target:'#my-id'}" href="#"></a>
					<a href="<?php echo base_url(); ?>" class="uk-navbar-brand uk-hidden-small"><?php echo APP_HEADER; ?></a>
					<div class="uk-navbar-flip">
						<div class="uk-navbar-content">Ahlan <?php echo ucwords($this->session->userdata("userrealname")); ?></div>
						<ul class="uk-navbar-nav">
							<li><a href="<?php echo base_url('auth/logout'); ?>"><i class="uk-icon-sign-out"></i> Logout</a></li>
						</ul>
					</div>
					<div class="uk-navbar-content uk-navbar-center">CPanel BPNC - IMS</div>
				</nav>
			</div>
			<div class="uk-grid">
				<div class="uk-width-1-4 uk-container-center uk-hidden-small">
					<div class="uk-panel uk-panel-box">
						<div class="uk-margin" id="pics">
							<img class="uk-thumbnail" src="<?php echo base_url('assets/img/logo.png'); ?>" alt="">
							<img class="uk-thumbnail" src="<?php echo base_url('assets/img/logoBPNCIMS2014.png'); ?>" alt="">
						</div>
					</div>
				</div>
				<div class="uk-width-3-4 uk-container-center">
					<div class="uk-panel uk-panel-box">
						<div class="uk-panel uk-panel-header">
							<h3 class="uk-panel-title"><?php echo $panel_title; ?></h3>