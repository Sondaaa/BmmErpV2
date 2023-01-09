<?php $listesdetailprix = Doctrine_Core::getTable('detailprix')->findOneByIdLotsAndIdTypedetailprix($lots->getId(), 2); ?>
<td>
    <?php if ($listesdetailprix) { ?>
        <a class="btn btn-sm btn-white btn-primary" href="<?php echo url_for('lots/rempliravanace') . '?id=' . $lots->getId() ?>">Détail & Remplir Décompte</a>
        <a target="_blank" id="lots_print" type="button" class="btn btn-sm btn-white btn-success" href="<?php echo url_for('lots/ImprimerFiche') . '?id=' . $lots->getId() ?>">Fiche</a>
        <a target="_blank" class="btn btn-sm btn-white btn-success" href="<?php echo url_for('lots/ImprimerDecomptes') . '?id=' . $lots->getId() ?>">Décomptes</a>
    <?php } ?>
</td>