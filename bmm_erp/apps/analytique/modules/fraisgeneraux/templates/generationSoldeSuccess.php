<script  type="text/javascript">
<?php $charge_lignes = LignefraisgenerauxTable::getInstance()->getByRapportAndType($rapport->getId(), '6'); ?>
<?php $charges = 0; ?>
<?php foreach ($charge_lignes as $ligne): ?>
        $("#l_<?php echo $ligne->getId(); ?>").val('<?php echo number_format($ligne->getPlandossiercomptable()->getSolde(), 3, '.', ''); ?>');
    <?php $charges = $charges + $ligne->getPlandossiercomptable()->getSolde(); ?>
<?php endforeach; ?>
    $("#charge_rapport").val('<?php echo number_format($charges, 3, '.', ''); ?>');

<?php $produit_lignes = LignefraisgenerauxTable::getInstance()->getByRapportAndType($rapport->getId(), '7'); ?>
<?php $produits = 0; ?>
<?php foreach ($produit_lignes as $ligne): ?>
        $("#l_<?php echo $ligne->getId(); ?>").val('<?php echo number_format($ligne->getPlandossiercomptable()->getSolde(), 3, '.', ''); ?>');
    <?php $produits = $produits + $ligne->getPlandossiercomptable()->getSolde(); ?>
<?php endforeach; ?>
    $("#produit_rapport").val('<?php echo number_format($produits, 3, '.', ''); ?>');
    $("#montant_rapport").val('<?php echo number_format($charges - $produits, 3, '.', ''); ?>');
    $("#save_button").show();
</script>