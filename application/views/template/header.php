<?php echo doctype('html5'); ?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Zulyantara">
		<meta name="" content="">
		<meta name="Keywords" content="BPNCIMS, BPNCIMS 2014, Bintang Pelajar, National Competition">
		<meta name="Description" content="BPNCIMS, BPNCIMS 2014, Bintang Pelajar, National Competition">
		
		<link rel="shortcut icon" href="<?php echo base_url('assets/favicon.ico'); ?>">
		
		<title><?php echo APP_TITLE; ?></title>
		
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/uikit/css/uikit.gradient.min.css'); ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/my-style.css'); ?>" />
		
		<link rel="stylesheet" href="<?php echo base_url('assets/jquery/smoothness/jquery.ui.all.css'); ?>" />
		
		<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.0.3.js'); ?>"></script>
	</head>
	<body>
		<div class="uk-container uk-container-center main">
			<div class="uk-margin">
				<img src="<?php echo base_url('assets/img/header.png'); ?>" alt="BPNCIMS 2014">
				<nav class="uk-navbar uk-navbar-attached">
					<ul class="uk-navbar-nav">
						<li id="home"><a href="<?php echo base_url(); ?>"><i class="uk-icon-home"></i> Home</a></li>
						<li data-uk-dropdown="" class="uk-parent">
							<a href="<?php echo base_url(); ?>"><i class="uk-icon-file-text"></i> Pendaftaran BPNCIMS</a>
							<div class="uk-dropdown uk-dropdown-navbar" style="">
								<ul class="uk-nav uk-nav-navbar">
									<!--<li id="form_pendaftaran"><a href="<?php echo base_url('pendaftaran/form_pendaftaran'); ?>">Pendaftaran Baru</a></li>-->
									<?php
									$is_logged_in = $this->session->userdata('is_logged_in');
									if($is_logged_in OR $is_logged_in == TRUE)
									{
										?>
										<li id="form_pendaftaran"><a href="#info-pendaftaran" data-uk-modal>Pendaftaran Baru</a></li>
										<?php
									}
									?>
									<li id="form_pendaftaran"><a href="#edit-pendaftaran" data-uk-modal>Edit Data Sekolah</a></li>
									<li id="form_pendaftaran"><a href="#tambah-tim" data-uk-modal>Tambah Tim</a></li>
									<li id="form_pendaftaran"><a href="#edit-tim" data-uk-modal>Edit Data Tim</a></li>
								</ul>
							</div>
                        </li>
						<?php
						$is_logged_in = $this->session->userdata('is_logged_in');
						if($is_logged_in OR $is_logged_in == TRUE)
						{
							?>
							<li><a href="#offcanvas-kota" data-uk-offcanvas><i class="uk-icon-list"></i> Sekolah Terdaftar</a></li>
							<?php
						}
						?>
						<li data-uk-dropdown="" class="uk-parent">
							<a href="<?php echo base_url(); ?>"><i class="uk-icon-hdd-o"></i> Galeri BPNCIMS 2013</a>
							<div class="uk-dropdown uk-dropdown-navbar" style="">
								<ul class="uk-nav uk-nav-navbar">
									<li><a href="#"><i class="uk-icon-list-alt"></i> Info Pemenang</a></li>
									<li><a href="http://www.bintangpelajar.com/download" target="_blank"><i class="uk-icon-hdd-o"></i> Download Soal BPNC-IMS 2013</a></li>
									<li><a href="#"><i class="uk-icon-th"></i> Foto Kegiatan</a></li>
								</ul>
							</div>
						</li>
						<li data-uk-dropdown="" class="uk-parent">
							<a href="<?php echo base_url("home/list_lokasi_kompetisi"); ?>"><i class="uk-icon-anchor"></i> Info Lokasi Kompetisi</a>
							<div class="uk-dropdown uk-dropdown-navbar" style="">
								<ul class="uk-nav uk-nav-navbar">
									<li><a href="<?php echo base_url("home/lokasi_semi_final"); ?>">Lokasi Semi Final</a></li>
								</ul>
							</div>
						</li>
						<?php
						$is_logged_in = $this->session->userdata('is_logged_in');
						if($is_logged_in OR $is_logged_in == TRUE)
						{
							?>
							<li><a href="<?php echo base_url('cpanels'); ?>"><i class="uk-icon-gear"></i> CPanel</a></li>
							<?php
						}
						?>
					</ul>
					<div class="uk-navbar-flip">
						<ul class="uk-navbar-nav">
							<li id="faq"><a href="<?php echo base_url('home/faq'); ?>"><i class="uk-icon-question-circle"></i> Download Juknis</a></li>
							<?php
							$is_logged_in = $this->session->userdata('is_logged_in');
							if($is_logged_in OR $is_logged_in == TRUE)
							{
								?>
								<li><a href="<?php echo base_url('auth/logout'); ?>"><i class="uk-icon-sign-out"></i> Logout</a></li>
								<?php
							}
							?>
						</ul>
					</div>
				</nav>
			</div>
			
			<div id="info-pendaftaran" class="uk-modal">
				<div class="uk-modal-dialog">
					<a class="uk-modal-close uk-close"></a>
					<h2>Sebelum melakukan pendaftaran, siapkanlah:</h2>
					<ol>
						<li>Data Formulir Pendaftaran</li>
						<li>Biodata Siswa Peserta Kompetisi</li>
						<li>Bukti Transfer Pendaftaran</li>
					</ol>
					<p>Jangan lupa awali dengan <span class="uk-text-info">basmallah</span></p>
					<p>Selamat mendaftar ...</p>
					<p>Jika mengalami kesulitan, silahkan hubungi panitia</p>
					<ul>
						<li>Sunandar [0812 9778 2020]</li>
						<li>Fendi Kurniawan [0819 0819 7338]</li>
						<li>Eli Yansyah [0857 1140 7777]</li>
						<li>Shafiq [0823 0713 4000]</li>
						<li>Email [bpncims@bintangpelajar.com]</li>
					</ul>
					<a href="<?php echo base_url('pendaftaran/form_pendaftaran'); ?>" class="uk-button uk-button-danger">Mulai Mendaftar</a>
				</div>
			</div>
			
			<div id="edit-pendaftaran" class="uk-modal">
				<div class="uk-modal-dialog uk-modal-dialog-slide">
					<a class="uk-modal-close uk-close"></a>
					<div class="uk-alert uk-alert-danger">Untuk edit pendaftaran wilayah JABODETABEK, Bandung dan Karawang sudah ditutup, untuk info lebih lanjut silahkan hubungi panitia BPNCIMS</div>
					<?php
					$attr_form = array('class' => 'uk-form uk-form-horizontal', 'name' => 'form_edit_pendaftaran', 'id' => 'form_edit_pendaftaran');
					echo form_open('pendaftaran/form_edit_pendaftaran', $attr_form);
					?>
						<div class="uk-form-row">
							<?php echo form_error('txt_pendaftaran_kode'); ?>
							<label for="txt_pendaftaran_kode" class="uk-form-label">Kode Pendaftaran</label>
							<div class="uk-form-controls">
								<div class="uk-form-icon">
									<i class="uk-icon-barcode"></i>
									<input type="text" placeholder="Kode Pendaftaran" name="txt_pendaftaran_kode" id="txt_pendaftaran_kode" class="uk-form-width-large" value="<?php echo set_value('txt_pendaftaran_kode'); ?>" autofocus="autofocus">
								</div>
							</div>
						</div>
						<div class="uk-form-row">
							<button class="uk-button uk-button-success" type="submit" name="btn_simpan" value="btn_simpan"><i class="uk-icon-save"> Edit</i></button>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			
			<div id="edit-tim" class="uk-modal">
				<div class="uk-modal-dialog">
					<a class="uk-modal-close uk-close"></a>
					<div class="uk-alert uk-alert-danger">Untuk edit tim wilayah JABODETABEK, Bandung dan Karawang sudah ditutup, untuk info lebih lanjut silahkan hubungi panitia BPNCIMS</div>
					<?php
					$attr_form = array('class' => 'uk-form uk-form-horizontal', 'name' => 'form_edit_tim', 'id' => 'form_edit_tim');
					echo form_open('pendaftaran/form_edit_tim', $attr_form);
					?>
						<div class="uk-form-row">
							<?php echo form_error('txt_pendaftaran_kode'); ?>
							<label for="txt_pendaftaran_kode" class="uk-form-label">Kode Pendaftaran</label>
							<div class="uk-form-controls">
								<div class="uk-form-icon">
									<i class="uk-icon-barcode"></i>
									<input type="text" placeholder="Kode Pendaftaran" name="txt_pendaftaran_kode" id="txt_pendaftaran_kode" class="uk-form-width-large" value="<?php echo set_value('txt_pendaftaran_kode'); ?>" autofocus="autofocus">
								</div>
							</div>
						</div>
						<div class="uk-form-row">
							<button class="uk-button uk-button-success" type="submit" name="btn_simpan" value="btn_simpan"><i class="uk-icon-save"> Edit</i></button>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			
			<div id="tambah-tim" class="uk-modal">
				<div class="uk-modal-dialog">
					<a class="uk-modal-close uk-close"></a>
					<div class="uk-alert uk-alert-danger">Untuk tambah tim wilayah JABODETABEK, Bandung dan Karawang sudah ditutup, untuk info lebih lanjut silahkan hubungi panitia BPNCIMS</div>
					<?php
					$attr_form = array('class' => 'uk-form uk-form-horizontal', 'name' => 'form_tambah_tim', 'id' => 'form_tambah_tim');
					echo form_open('pendaftaran/form_tambah_tim', $attr_form);
					?>
						<div class="uk-form-row">
							<?php echo form_error('txt_pendaftaran_kode'); ?>
							<label for="txt_pendaftaran_kode" class="uk-form-label">Kode Pendaftaran</label>
							<div class="uk-form-controls">
								<div class="uk-form-icon">
									<i class="uk-icon-barcode"></i>
									<input type="text" placeholder="Kode Pendaftaran" name="txt_kode_pendaftaran" id="txt_kode_pendaftaran" class="uk-form-width-large" value="<?php echo set_value('txt_pendaftaran_kode'); ?>" autofocus="autofocus">
								</div>
							</div>
						</div>
						<?php
						$jmlTim = array('1'=>'1 Tim [Rp. 75.000]','2'=>'2 Tim [Rp. 150.000]','3'=>'3 Tim [Rp. 225.000]','4'=>'4 Tim [Rp. 300.000]','5'=>'5 Tim [Rp. 375.000]','6'=>'6 Tim [Rp. 450.000]','7'=>'7 Tim [Rp. 525.000]','8'=>'8 Tim [Rp. 600.000]','9'=>'9 Tim [Rp. 675.000]','10'=>'10 Tim [Rp. 750.000]');
						?>
						<div class="uk-form-row">
							<?php echo form_error('opt_jml_tim'); ?>
							<label for="opt_jml_tim" class="uk-form-label">Jumlah Tim</label>
							<div class="uk-form-controls">
								<select name="opt_jml_tim" id="opt_jml_tim">
									<option selected="selected" value="">Jumlah Tim</option>
									<?php
									foreach($jmlTim as $keyJml => $rowJml)
									{
										?>
										<option value="<?php echo $keyJml; ?>" <?php echo set_select('opt_jml_tim', $keyJml); ?>><?php echo $rowJml; ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						
						<div class="uk-form-row">
							<button class="uk-button uk-button-success" type="submit" name="btn_simpan" value="btn_simpan"><i class="uk-icon-save"> Edit</i></button>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			
			<div class="uk-grid">
				<div class="uk-width-1-4 uk-container-center uk-hidden-small">
					<div class="uk-panel uk-panel-box">
						<div class="uk-margin" id="pics">
							<img class="uk-thumbnail" src="<?php echo base_url('assets/img/logo.png'); ?>" alt="">
							<img class="uk-thumbnail" src="<?php echo base_url('assets/img/logoBPNCIMS2014.png'); ?>" alt="">
						</div>
						<div class="uk-margin uk-text-center">
							<span class="uk-text-bold uk-text-info uk-text-small">Lembaga Mitra Pengelola</span>
							<span class="uk-text-bold uk-text-info uk-text-small">dan Tempat Pelaksanaan</span>
							<span class="uk-text-bold uk-text-info uk-text-small">Bintang Pelajar National Competition</span>
							<span class="uk-text-bold uk-text-info uk-text-small">Islamic Knowledge, Mathematics</span>
							<span class="uk-text-bold uk-text-info uk-text-small">and Science (BPNC-IMS) 2014</span>
							<img class="uk-thumbnail" src="<?php echo base_url('assets/img/logo-mitra-web.png'); ?>" alt="">
						</div>
						<div class="uk-margin uk-text-center">
							<span class="uk-text-bold uk-text-info uk-text-small">Acara ini disponsori oleh</span>
							<img class="uk-thumbnail" src="<?php echo base_url('assets/img/Toyota_logo.png'); ?>" alt="">
						</div>
						<div class="uk-margin uk-text-center">
							<span class="uk-text-bold uk-text-info uk-text-small">Media Partner</span>
							<img class="uk-thumbnail" src="<?php echo base_url('assets/img/republika.png'); ?>" alt="">
						</div>
					</div>
				</div>
				<div class="uk-width-3-4 uk-container-center">
					<?php
					if(isset($panel_title))
					{
						?>
						<div class="uk-panel uk-panel-box">
							<div class="uk-panel uk-panel-header">
								<h3 class="uk-panel-title"><?php echo $panel_title; ?></h3>
						<?php
					}
					?>