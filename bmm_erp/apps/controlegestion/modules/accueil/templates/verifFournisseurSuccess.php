<script  type="text/javascript">

<?php foreach ($fournisseurs as $fournisseur): ?>
        $("#Four_niss_eur_<?php echo strtoupper(trim(preg_replace('/[^a-zA-Z0-9]/', '', html_entity_decode($fournisseur->getRs(), ENT_QUOTES)))); ?>").remove();
<?php endforeach; ?>

    $("#count_fournisseur").html('<hr style="margin-top: 10px; margin-bottom: 10px;">' + $('#verif_zone_fournisseur table tbody tr').length + ' Nouveau(x) Fournisseur(s).');

</script>