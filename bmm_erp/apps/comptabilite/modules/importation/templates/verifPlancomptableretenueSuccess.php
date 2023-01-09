<script  type="text/javascript">

<?php foreach ($comptecomptable as $fournisseur): ?>
        $("#Four_niss_eur_<?php echo strtoupper(trim(preg_replace('/[^a-zA-Z0-9]/', '', html_entity_decode($fournisseur->getNumerocompte(), ENT_QUOTES)))); ?>").remove();
        
        $("#compte_charge_<?php echo strtoupper(trim(preg_replace('/[^a-zA-Z0-9]/', '', html_entity_decode($fournisseur->getNumerocompte(), ENT_QUOTES)))); ?>").remove();
<?php endforeach; ?>

    $("#count_comptecomptable").html('<hr style="margin-top: 10px; margin-bottom: 10px;">' + $('#verif_zone_comptecomptable table tbody tr').length  + ' Nouveau(x) Compte(s) Comptable(s).');

</script>