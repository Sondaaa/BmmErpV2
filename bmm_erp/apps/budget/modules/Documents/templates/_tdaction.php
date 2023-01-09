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
            <?php if ($boncomm->getIdTypedoc() == 17 && $boncomm->getDatesignature() != null) { ?>
                <a href="<?php echo url_for('documentachat/exportbcc') . '?iddoc=' . $boncomm->getIdDocparent() . '&idbdc=' . $boncomm->getId() . '&tab=3' ?>" >
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
        <a href="<?php echo url_for('Documents/detail') . '?id=' . $boncomm->getId() ?>">Ajouter Date Signature</a>
        <?php
    }
    if ($boncomm->getIdTypedoc() == 7 && $boncomm->ActionSignature() != "" && $boncomm->getDatesignature()) {
        echo date('d/m/Y', strtotime($boncomm->getDatesignature()));
    }
    ?>
    <?php if ($boncomm->getIdTypedoc() == 18 && !$docs_pdcd && $boncomm->getDatesignature() != null && $boncomm->ActionSignature() != "") { ?>
        <a href="<?php echo url_for('documentachat/exportbce') . '?iddoc=' . $boncomm->getIdDocparent() . '&idbdc=' . $boncomm->getId() . '&tab=3' ?>">
            Exporter En BCE. Définitif
        </a>
    <?php } ?>
    <?php if ($boncomm->getIdTypedoc() == 18 && $docs_pdcd && $boncomm->ActionSignature() != "") { ?>
        <?php include_partial('tddetaildoc', array('boncomm' => $docs_pdcd)); ?>
    <?php } ?>

    <?php
    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
    $query = "SELECT documentbudget.id as id "
            . "FROM  piecejointbudget, documentachat, documentbudget "
            . "WHERE piecejointbudget.id_documentbudget = documentbudget.id "
            . "AND piecejointbudget.id_docachat = documentachat.id "
            . "AND documentbudget.id_type =2 "
            . "AND documentachat.id IN (select id from documentachat where id_docparent = " . $boncomm->getIdDocparent() . ") ";

    $ordonnance_paiement = $conn->fetchAssoc($query);
    ?>
    <?php if (sizeof($ordonnance_paiement) > 0): ?>
        <button onclick="document.location.href = '<?php echo url_for('documentachat/annuler') . '?iddoc=' . $boncomm->getId() ?>'" class="btn btn-xs btn-default"><i class="fa fa-undo"></i> Annuler</button>
       
    <?php endif; ?>
    
    <a style="float: right;" id="btnimpexpo" class="btn btn-sm btn-outline btn-success" href="<?php echo url_for('documentachat/showdocument?iddoc=') . $boncomm->getId() ?>"><i class="fa fa-eye"></i> Détail</a>
<?php else: ?>
    Annulé
<?php endif; ?>