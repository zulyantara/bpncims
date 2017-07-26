                        </div>
                    </div>
                </div>
        <?php
        if(isset($panel_title))
        {
            ?>
                </div>
                <footer>
                    <nav class="uk-navbar uk-navbar-attached">
                        <div class="uk-navbar-content"><?php echo APP_FOOTER; ?></div>
                        <!--<div class="uk-navbar-content uk-navbar-center">Bintang Pelajar National Competition for Islamic Mathematics and Science</div>-->
                    </nav>
                </footer>
            </div>
            <?php
        }
        ?>
        
        <div class="uk-offcanvas" id="offcanvas-kota">
            <div class="uk-offcanvas-bar">
                <ul data-uk-nav="" class="uk-nav uk-nav-offcanvas uk-nav-parent-icon">
                    <li class="uk-nav-header">Lokasi Kompetisi</li>
                    <li><a href="<?php echo base_url('pendaftaran/cari_sekolah/00'); ?>">Semua Kota</a></li>
                    <?php
                    foreach ($sql_kota as $key_kota => $row_kota)
                    {
                        ?>
                        <li><a href="<?php echo base_url('pendaftaran/cari_sekolah/'.$row_kota->kota_no); ?>"><?php echo $row_kota->kota_ket; ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        
        <div class="uk-offcanvas" id="offcanvas-kota-sekolah-aktif">
            <div class="uk-offcanvas-bar">
                <ul data-uk-nav="" class="uk-nav uk-nav-offcanvas uk-nav-parent-icon">
                    <li class="uk-nav-header">Lokasi Kompetisi</li>
                    <li><a href="<?php echo base_url('cpanels/form_sekolah_aktif/00'); ?>">Semua Kota</a></li>
                    <?php
                    foreach ($sql_kota as $key_kota => $row_kota)
                    {
                        ?>
                        <li><a href="<?php echo base_url('cpanels/form_sekolah_aktif/'.$row_kota->kota_no); ?>"><?php echo $row_kota->kota_ket; ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        
		<script type="text/javascript" src="<?php echo base_url('assets/jquery/ui/jquery.ui.core.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/jquery/ui/jquery.ui.widget.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/jquery/ui/jquery.ui.effect.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/jquery/ui/jquery.ui.effect-bounce.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/jquery/ui/jquery.ui.datepicker.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/jquery/ui/jquery.ui.position.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/jquery/ui/jquery.ui.tooltip.js'); ?>"></script>
		
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.cycle.all.js'); ?>"></script>
		
		<script type="text/javascript" src="<?php echo base_url('assets/uikit/js/uikit.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/uikit/addons/js/sticky.min.js'); ?>"></script>
		
        <script type="text/javascript">
        $( "#<?php echo $content; ?>" ).addClass( "uk-active" );
        
        $(document).ready(function(){
            $("#pics").cycle({
                fx: 'scrollRight',
                easing:  'easeInOutBack'
            });
            
            $("#gambar").cycle({
                fx: 'fade',
                easing:  'easeInOutBack',
                delay: -2000,
                pause: 1
            });
        });
        
        $(function() {
            var tooltips = $( "[title]" ).tooltip();
            $( "#txt_tgl_transfer" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd"
            });
        });
        </script>
	</body>
</html>