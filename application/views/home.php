<!--
<div id="gambar">
    <img alt="BPNCIMS 2014" src="<?php echo base_url('assets/img/poster_bpncims_2014.png'); ?>">
    <img alt="BPNCIMS 2014" src="<?php echo base_url("assets/img/jadwal_pelaksanaan_technical_meeting_peserta_bpncims.jpg"); ?>">
    <img class="uk-thumbnail" src="<?php echo base_url('assets/img/Alur_Pendaftaran.png'); ?>" alt="Alur Pendaftaran">
    <img class="uk-thumbnail" src="<?php echo base_url('assets/img/procedure_pendaftaran.png'); ?>" alt="Prosedur Pendaftaran">
</div>
-->

<div class="uk-width-medium-1-1 uk-container-center">
	<div class="uk-panel uk-panel-box uk-text-center">
		<span class="uk-text-large">
			Informasi Pemenang Babak Semifinal BPNCIMS 2014<br>
			<a href="http://www.bintangpelajar.com/pengumuman-pemenang-babak-semifinal-bpncims-2014" target="_blank" class="uk-button uk-button-danger">Pengumuman Pemenang Babak Semifinal BPNCIMS 2014</a></span>
	</div>
	
	<div class="uk-panel uk-panel-box uk-text-center" style="margin-top: 5px;">
		<p>Saksikan tayangan kompetisi BPNC-IMS 2014 secara live. </p>
		<p>Link Bintang Pelajar TV on Android/Blackberry: rtsp://119.235.249.60:1935/imedtv2/live on iphone/ipod apple: http://119.235.249.60:1935/imedtv2/live/playlist.m3u8 web: <a href="http://bintangpelajar.tvdigitalku.tv" target="_blank">bintangpelajar.tvdigitalku.tv</a></p>
		<p>Ikuti Bincang-Bincang Edukatif : Golden Ways Anak Sholeh bersama Ust. Zainal Abidin, Lc di area kompetisi.</p>
	</div>
	
	<div class="uk-panel uk-panel-box uk-text-center" style="margin-top: 5px;">
		<span class="uk-text-large" style="color: #0000FF;">Informasi Semifinal</span>
		<ul class="uk-list">
		<?php
		$jf4 = sizeof($files4);
		for($i=0;$i<$jf4;$i++)
		{
			?>
			<a href="<?php echo base_url("home/download_semi_final/".$files4[$i]); ?>" class="uk-button uk-button-danger" style="margin-top: 5px;"><?php echo $files4[$i]; ?></a><br>
			<?php
			//echo "<li>".anchor("home/download_semi_final/".$files4[$i], $files4[$i].br())."</li>";
		}
		?>
		</ul>
	</div>
	
    <div class="uk-panel uk-panel-box uk-text-center" style="margin-top: 5px;">
        <div class="uk-alert">
            <span class="uk-text-large" style="color: #0000FF;">
                Assalaamu'alaikum Warahmatullahi Wabarakatuh<br>Berikut daftar pemenang babak penyisihan BPNCIMS 2014.<br>
                <a href="http://www.bintangpelajar.com/pengumuman-pemenang-babak-penyisihan-bpncims-2014" class="uk-button uk-button-danger" style="margin-bottom: 5px; margin-top: 5px;">Daftar Pemenang Babak Penyisihan</a><br>
                <a href="http://www.bintangpelajar.com/pengumuman-pemenang-babak-penyisihan-bpncims-2014" class="uk-button uk-button-danger">Daftar Peringkat Seluruh Peserta Babak Penyisihan</a>
            </span>
        </div>
    </div>
</div>