<script  type="text/javascript">

<?php foreach ($unites as $unite): ?>
        $("#uni_te_<?php echo strtoupper(trim(preg_replace('/[^a-zA-Z0-9]/', '', html_entity_decode($unite->getLibelle(), ENT_QUOTES)))); ?>").remove();
<?php endforeach; ?>

    $("#count_unite").html('<hr style="margin-top: 10px; margin-bottom: 10px;">' + $('#verif_zone_unite table tbody tr').length + ' Nouvelle(x) Unité(s).');

</script>