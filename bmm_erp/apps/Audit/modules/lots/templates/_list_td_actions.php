<?php //$listesdetailprix = Doctrine_Core::getTable('detailprix')->findOneByIdLotsAndIdTypedetailprix($lots->getId(), 2); ?>
<td id="actionlots" style="text-align: center;">
    <div class="btn-group">
        <a class="btn btn-sm btn-white btn-primary" href="<?php echo url_for('lots/Detailsousdetails') . '?id=' . $lots->getId() ?>">Détail Sous Détail de Prix</a>
        <a target="_blank" id="lots_print" type="button" class="btn btn-sm btn-white btn-success" href="<?php echo url_for('lots/ImprimerFiche') . '?id=' . $lots->getId() ?>">Fiche</a>
        <a target="_blank" class="btn btn-sm btn-white btn-success" href="<?php echo url_for('lots/ImprimerDecomptes') . '?id=' . $lots->getId() ?>">Décomptes</a>
    </div>
</td>