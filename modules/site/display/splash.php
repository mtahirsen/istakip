<article style="min-width: 500px; min-height: 580px;">
<?php
$site_general = $sql->get_row("site_general","*","WHERE id='1'");
echo $site_general["splash_content"];
?>
</article>