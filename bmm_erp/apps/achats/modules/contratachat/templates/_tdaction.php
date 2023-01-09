<?php if ($boncomm->getEtatdocachat() == ''): ?>
    <?php
    $ligne = new Ligneoperationcaisse();
    if ($boncomm->getIdTypedoc() == 20)
        $contrat = Doctrine_Core::getTable('contratachat')->findOneById($boncomm->getIdContrat());
    if ($boncomm->getIdTypedoc() == 19)
        $contrat = Doctrine_Core::getTable('contratachat')->findOneById($boncomm->getId());
    $lignecaisse = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachatAndIdCategorie($boncomm->getId(), 1);
    $docs_pdcd = Doctrine_Core::getTable('documentachat')->findOneById($boncomm->getId());
    $doc_achat_etat_doc = DocumentachatTable::getInstance()->getEtatDoc($boncomm->getId(), 38);
//    die ($boncomm->getId().'ppp'.sizeof($doc_achat_etat_doc).'mmm');
//    if ($lignecaisse && $boncomm->ActionSignature() != "") {
    $ligne = $lignecaisse;
    $document_pdcd = new Documentachat();
    
    if ($docs_pdcd) {
        ?>
        <?php if ($boncomm->getIdTypedoc() == 19 && sizeof($doc_achat_etat_doc) >= 1) { ?>
            <a href="<?php echo url_for('documentachat/exportcontratdefinitif') . '?iddoc=' . $boncomm->getId() . '&idcontrat=' . $boncomm->getIdContrat() . '&tab=3' ?>" >
                Exporter En Contrat Définitif
            </a>
        <?php } ?>
    <?php } else { ?>
        <?php include_partial('tddetaildoc', array('boncomm' => $docs_pdcd)) ?>
        <?php
    }
//    }



    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
    $query = "SELECT documentbudget.id as id "
            . "FROM  piecejointbudget, documentachat, documentbudget "
            . "WHERE piecejointbudget.id_documentbudget = documentbudget.id "
            . "AND piecejointbudget.id_docachat = documentachat.id "
            . "AND documentbudget.id_type =20 "
            . "AND documentachat.id IN (select id from documentachat where id_docparent = " . $boncomm->getId() . ") ";

    $ordonnance_paiement = $conn->fetchAssoc($query);
    ?>
    <?php if (sizeof($ordonnance_paiement) > 0): ?>
        <button onclick="document.location.href = '<?php echo url_for('documentachat/annuler') . '?iddoc=' . $boncomm->getId() ?>'" class="btn btn-xs btn-default"><i class="fa fa-undo"></i> Annuler</button>
    <?php endif; ?>
<?php else: ?>
    Annulé
<?php endif; ?>