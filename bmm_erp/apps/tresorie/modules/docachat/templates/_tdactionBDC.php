<?php // if (sizeof($boncomm) >= 1 && $boncomm->getIdTypedoc() != null && $boncomm->getIdTypedoc() != ''):   ?>
<?php if ($boncomm->getEtatdocachat() == ''): ?>
    <?php
    $ligne = new Ligneoperationcaisse();
    $lignecaisse = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachatAndIdCategorie($boncomm->getId(), 1);
    $docs_pdcd = Doctrine_Core::getTable('documentachat')->findOneByIdFils($boncomm->getId());

    if ($lignecaisse && $boncomm->ActionSignature() != "") {
        $ligne = $lignecaisse;
        $document_pdcd = new Documentachat();
        if (!$docs_pdcd) {
            ?>
            <?php
            if ($boncomm->getIdTypedoc() == 17) {
                // && $boncomm->getDatesignature() != null
                ?>
                <a href="<?php echo url_for('docachat/exportbccnull') . '?iddoc=' . $boncomm->getIdDocparent() . '&idbdc=' . $boncomm->getId() . '&tab=3' ?>" >
                    Exporter En BDC. Définitif
                </a>
            <?php } ?>
        <?php } else { ?>
            <?php include_partial('tddetaildoc', array('boncomm' => $docs_pdcd)) ?>
            <?php
        }
    }
    if ($boncomm->getIdTypedoc() == 7 && $boncomm->ActionSignature() != "" && !$boncomm->getDatesignature()) {
        ?>
        <a href="<?php echo url_for('docachat/detail') . '?id=' . $boncomm->getId() ?>">Ajouter Date Signature</a>
        <?php
    }
    if ($boncomm->getIdTypedoc() == 7 && $boncomm->ActionSignature() != "" && $boncomm->getDatesignature()) {
        echo date('d/m/Y', strtotime($boncomm->getDatesignature()));
    }
    ?>

    <?php if ($boncomm->getIdTypedoc() == 18 && $docs_pdcd && $boncomm->ActionSignature() != "") { ?>
        <?php
        include_partial('tddetaildoc', array('boncomm' => $docs_pdcd));
        if ($docs_pdcd->getDatesignature())
            echo date('d/m/Y', strtotime($docs_pdcd->getDatesignature()));
        ?>
    <?php } ?>

    <?php
    // if($boncomm->getIdDocparent()  != null && $boncomm->getIdDocparent()  != '' ){
    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
    $query = "SELECT documentbudget.id as id "
            . "FROM  piecejointbudget, documentachat, documentbudget "
            . "WHERE piecejointbudget.id_documentbudget = documentbudget.id "
            . "AND piecejointbudget.id_docachat = documentachat.id "
            . "AND documentbudget.id_type =2 or  documentbudget.id_type =17 "
            . "AND documentachat.id IN (select id from documentachat where id_docparent = "
            . $boncomm->getIdDocparent() . ") "

    ;
//die($query);
    $ordonnance_paiement = $conn->fetchAssoc($query);
    ?>
    <?php if (sizeof($ordonnance_paiement) > 0): ?>
        <button onclick="document.location.href = '<?php echo url_for('docachat/annuler') . '?iddoc=' . $boncomm->getId() ?>'" class="btn btn-xs btn-default"><i class="fa fa-undo"></i> Annuler</button>
    <?php endif; ?>

    <?php
    $user = $sf_user->getAttribute('userB2m');
    if ($user->getIdProfil() == 28):
        ?>
        <button onclick="document.location.href = '<?php echo url_for('docachat/deleteBDcNull') . '?id=' . $boncomm->getId() ?>'" class="btn btn-xs btn-danger"><i class="fa fa-undo"></i> Supprimer</button>   
    <?php endif; ?>
<?php else: ?>
    Annulé
<?php endif; ?>
<?php
//  endif;?>