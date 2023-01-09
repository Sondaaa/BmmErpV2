<script  type="text/javascript">

<?php foreach ($demandeurs as $demandeur): ?>
        $("#de_man_deur_<?php echo strtoupper(trim(preg_replace('/[^a-zA-Z0-9]/', '', html_entity_decode($demandeur->getLibelle(), ENT_QUOTES)))); ?>").remove();
<?php endforeach; ?>

    $("#count_demandeur").html('<hr style="margin-top: 10px; margin-bottom: 10px;">' + $('#verif_zone_demandeur table tbody tr').length + ' Nouveau(x) Demandeur(s).');

</script>