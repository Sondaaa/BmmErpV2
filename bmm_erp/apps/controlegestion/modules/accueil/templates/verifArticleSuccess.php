<script  type="text/javascript">

<?php foreach ($articles as $article): ?>
        $("#ar_ti_cle_<?php echo strtoupper(trim(preg_replace('/[^a-zA-Z0-9]/', '', html_entity_decode($article->getDesignation(), ENT_QUOTES)))); ?>").remove();
<?php endforeach; ?>

    $("#count_article").html('<hr style="margin-top: 10px; margin-bottom: 10px;">' + $('#verif_zone_article table tbody tr').length + ' Nouveau(x) Article(s).');

</script>