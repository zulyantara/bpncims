<ul class="uk-tab" data-uk-tab="{connect:'#my-id'}">
    <li class="uk-active"><a href="#tabs-1">SD</a></li>
    <li><a href="">SMP</a></li>
    <li><a href="">SMA</a></li>
</ul>

<ul id="my-id" class="uk-switcher uk-margin">
    <li>
        <div class="uk-grid">
            <?php
            foreach($sql_lokasi_kompetisi_sd as $row_lokasi_kompetisi_sd)
            {
                ?>
                <div class="uk-width-1-2" style="padding-bottom: 10px;">
                    <dl class="uk-description-list uk-description-list-line">
                        <dt><h3 class="tm-article-subtitle"><?php echo $row_lokasi_kompetisi_sd->kota_ket; ?></h3></dt>
                        <dd>
                            <span class="uk-clearfix"><?php echo $row_lokasi_kompetisi_sd->lm_nama_sekolah; ?></span>
                            <span class="uk-clearfix"><?php echo $row_lokasi_kompetisi_sd->lm_alamat; ?></span>
                            <span class="uk-clearfix">
                                <a href="<?php echo $row_lokasi_kompetisi_sd->lm_website; ?>" target="_blank">
                                    <?php echo $row_lokasi_kompetisi_sd->lm_website; ?>
                                </a>
                            </span>
                            <span class="uk-clearfix"><?php echo $row_lokasi_kompetisi_sd->lm_telp; ?></span>
                        </dd>
                    </dl>
                </div>
                <?php
            }
            ?>
        </div>
    </li>
    <li>
        <div class="uk-grid">
            <?php
            foreach($sql_lokasi_kompetisi_smp as $row_lokasi_kompetisi_smp)
            {
                ?>
                <div class="uk-width-1-2" style="padding-bottom: 10px;">
                    <dl class="uk-description-list uk-description-list-line">
                        <dt><h3 class="tm-article-subtitle"><?php echo $row_lokasi_kompetisi_smp->kota_ket; ?></h3></dt>
                        <dd>
                            <span class="uk-clearfix"><?php echo $row_lokasi_kompetisi_smp->lm_nama_sekolah; ?></span>
                            <span class="uk-clearfix"><?php echo $row_lokasi_kompetisi_smp->lm_alamat; ?></span>
                            <span class="uk-clearfix">
                                <a href="<?php echo $row_lokasi_kompetisi_smp->lm_website; ?>" target="_blank">
                                    <?php echo $row_lokasi_kompetisi_smp->lm_website; ?>
                                </a>
                            </span>
                            <span class="uk-clearfix"><?php echo $row_lokasi_kompetisi_smp->lm_telp; ?></span>
                        </dd>
                    </dl>
                </div>
                <?php
            }
            ?>
        </div>
    </li>
    <li>
        <div class="uk-grid">
            <?php
            foreach($sql_lokasi_kompetisi_sma as $row_lokasi_kompetisi_sma)
            {
                ?>
                <div class="uk-width-1-1" style="padding-bottom: 10px;">
                    <dl class="uk-description-list uk-description-list-line">
                        <dt><h3 class="tm-article-subtitle"><?php echo $row_lokasi_kompetisi_sma->kota_ket; ?></h3></dt>
                        <dd>
                            <span class="uk-clearfix"><?php echo $row_lokasi_kompetisi_sma->lm_nama_sekolah; ?></span>
                            <span class="uk-clearfix"><?php echo $row_lokasi_kompetisi_sma->lm_alamat; ?></span>
                            <span class="uk-clearfix">
                                <a href="<?php echo $row_lokasi_kompetisi_sma->lm_website; ?>" target="_blank">
                                    <?php echo $row_lokasi_kompetisi_sma->lm_website; ?>
                                </a>
                            </span>
                            <span class="uk-clearfix"><?php echo $row_lokasi_kompetisi_sma->lm_telp; ?></span>
                        </dd>
                    </dl>
                </div>
                <?php
            }
            ?>
        </div>
    </li>
</ul>