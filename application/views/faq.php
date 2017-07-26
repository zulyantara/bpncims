<h4 class="tm-article-subtitle">Pendaftaran Kompetisi</h4>
<ul class="uk-list uk-list-striped">
<?php
$jf1 = sizeof($files1);
for($i=0;$i<$jf1;$i++)
{
    echo "<li>".anchor("home/download_form_pendaftaran/".$files1[$i], $files1[$i].br())."</li>";
}
?>
</ul>

<h4 class="tm-article-subtitle">Pedoman Pelaksanaan Kompetisi</h4>
<ul class="uk-list uk-list-striped">
<?php
$jf2 = sizeof($files2);
for($i=0;$i<$jf2;$i++)
{
    echo "<li>".anchor("home/download_pedoman_pendaftaran/".$files2[$i], $files2[$i].br())."</li>";
}
?>
</ul>

<h4 class="tm-article-subtitle">Technical Meeting Peserta Kompetisi</h4>
<ul class="uk-list uk-list-striped">
<?php
$jf3 = sizeof($files3);
for($i=0;$i<$jf3;$i++)
{
    echo "<li>".anchor("home/download_technical_meeting/".$files3[$i], $files3[$i].br())."</li>";
}
?>
</ul>

<h4 class="tm-article-subtitle">Semi Final</h4>
<ul class="uk-list uk-list-striped">
<?php
$jf4 = sizeof($files4);
for($i=0;$i<$jf4;$i++)
{
    echo "<li>".anchor("home/download_semi_final/".$files4[$i], $files4[$i].br())."</li>";
}
?>
</ul>