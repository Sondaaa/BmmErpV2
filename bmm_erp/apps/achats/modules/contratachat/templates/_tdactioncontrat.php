
<?php
if ($boncomm->getEtatdocachat() == ''):
    ?>
    <?php
    $ligne = new Ligneoperationcaisse();
    if ($boncomm->getIdTypedoc() == 20) {
        if (sizeof($boncomm->getDocumentachat()) >= 1)
            $contrat = Doctrine_Core::getTable('contratachat')->findOneById($boncomm->getDocumentachat()->getFirst()->getId());
    }

    if ($boncomm->getIdTypedoc() == 19) {
        if (sizeof($boncomm->getDocumentachat()) >= 1)
            $contrat = Doctrine_Core::getTable('contratachat')->findOneById($boncomm->getDocumentachat()->getFirst()->getId());
    }
    //die($boncomm->getIdEtatdoc().'rf'. $boncomm->getDocumentachat()->getlast()->getIdEtatdoc(). 'frre');
    if ($boncomm->getDocumentachat()->getlast()->getIdEtatdoc() == 20) {
        ?>

        <button type="button" onclick="document.location.href = '<?php echo url_for('contratachat/edit') . '?id=' . $boncomm->getId(); ?>'" class="btn btn-xs btn-primary width-fixed">
            <i class="ace-icon fa fa-edit bigger-110"></i> Modifier 
        </button>
        <?php $user = $sf_user->getAttribute('userB2m');
        if ($user->getIdProfil() == 28) {
            ?>
            <button type="button" onclick="document.location.href = '<?php echo url_for('contratachat/delete') . '?id=' . $boncomm->getId(); ?>'" class="btn btn-xs btn-danger width-fixed">
                <i class="ace-icon fa fa-edit bigger-110"></i> Suprimer 
            </button>
        <?php } ?>
        <?php
    }
    $documentachat = DocumentachatTable::getInstance()->findByIdContrat($boncomm->getId());
    if (sizeof($documentachat) >= 1) {
        $lignecaisse = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachatAndIdCategorie($documentachat->getFirst()->getId(), 1);
        $docs_pdcd = Doctrine_Core::getTable('documentachat')->findOneById($boncomm->getDocumentachat()->getFirst()->getId());
        $doc_achat_etat_doc = DocumentachatTable::getInstance()->getEtatDoc($boncomm->getDocumentachat()->getFirst()->getId(), 38);
        $doc_factures = DocumentachatTable::getInstance()->getByDocparentAndTypedoc($boncomm->getDocumentachat()->getFirst()->getId(), 15);
//    if ($lignecaisse && $boncomm->ActionSignature() != "") {
        $ligne = $lignecaisse;
        $document_pdcd = new Documentachat();
        if (sizeof($doc_achat_etat_doc) >= 1)
            $doc_parent = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdTypedoc($doc_achat_etat_doc->getFirst()->getId(), 20);
        ?>

        <?php if ($docs_pdcd && sizeof($doc_achat_etat_doc) >= 1) { ?>
            <?php if ($boncomm->getIdTypedoc() == 19 && sizeof($doc_parent) <= 1) { ?>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                        Action
                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-primary"> 
                        <li>
                            <a href="<?php echo url_for('documentachat/exportcontratdefinitif') . '?iddoc=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&idcontrat=' . $boncomm->getId() . '&tab=3' ?>" >
                                Exporter En Contrat Définitif
                            </a>
                        </li>
                        <li>    <a href="<?php echo url_for('documentachat/annulationContratProvisoire') . '?iddoc=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&idcontrat=' . $boncomm->getId() . '&tab=3' ?>" >
                                </br>  Annuler Contrat Provisoire
                            </a>
                        </li>
                    </ul>
                </div>
            <?php } ?>

        <?php } else {
            ?>
            <?php
            if ($boncomm->getIdTypedoc() == 19 && sizeof($doc_achat_etat_doc) >= 1) {
                if (sizeof($doc_parent) <= 1) {
                    ?>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                            Action
                            <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-primary"> 
                            <li>         
                                <a href="<?php echo url_for('documentachat/annulationContratProvisoire') . '?iddoc=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&idcontrat=' . $boncomm->getId() . '&tab=3' ?>" >
                                    Annuler Contrat Provisoire
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php
                }
            }
            ?>         
            <?php if ($boncomm->getIdTypedoc() == 20 && sizeof($doc_factures) == 0) { ?>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                        Action
                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-primary"> 
                        <li>   <a class="btn btn-white btn-danger width-fixed" href="<?php echo url_for('contratachat/annulationContratDefinitif') . '?iddoc=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&idcontrat=' . $boncomm->getId() . '&tab=3' ?>" >
                                Annuler Contrat Définitif 
                            </a>
                        </li>
                        <li>
                            <a  href="<?php echo url_for('contratachat/misajourpenalite') . '?id=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&idcontrat=' . $boncomm->getId() . "&tab = 3"; ?>"
                                class = "btn btn-white btn-primary width-fixed">
                                Modifier Fiche Contrat
                            </a>
                        </li>
                        <li>
                            <a class = "btn btn-white btn-success width-fixed"href = "<?php echo url_for('contratachat/remplirios') . '?id=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&idcontrat=' . $boncomm->getId() ?>">Créer Ordre de Service</a>
                        </li>
                        <li>
                            <a class = "btn btn-white btn-primary1 width-fixed" href = "<?php echo url_for('contratachat/misajourpiriode') . '?id=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&idcontrat=' . $boncomm->getId() ?>">Réception Contrat</a>
                        </li>
                    </ul>
                </div>

                <?php
            }
            ?>
            <?php if ($boncomm->getIdTypedoc() == 20 && sizeof($doc_factures) >= 1) { ?>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                        Action
                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-primary">                 
                        <li><a class="btn btn-white btn-danger width-fixed" href="<?php echo url_for('contratachat/resulationducontrat') . '?iddoc=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&idcontrat=' . $boncomm->getId() . '&tab=3' ?>" >
                                Résiliation Contrat Définitif  
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url_for('contratachat/misajourpenalite') . '?id=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&idcontrat=' . $boncomm->getId(); ?>"
                               class="btn btn-white btn-primary width-fixed">
                                Modifier Fiche Contrat
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-white btn-success width-fixed" href="<?php echo url_for('contratachat/remplirios') . '?id=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&idcontrat=' . $boncomm->getId() ?>">Créer Ordre de Service</a>
                        </li>
                        <li>
                            <a class="btn btn-white btn-primary1 width-fixed" href="<?php echo url_for('contratachat/misajourpiriode') . '?id=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&idcontrat=' . $boncomm->getId() ?>">Réception Contrat</a>
                        </li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                        Avenant
                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-primary">
                        <li>
                            <a href="<?php echo url_for('contratachat/rempliravenant') . '?id=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&idcontrat=' . $boncomm->getId() ?>">Avenant Type Date </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo url_for('contratachat/rempliravenanttype2') . '?id=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&idcontrat=' . $boncomm->getId() ?>">Avenant Type Détail de Prix</a>
                        </li>

                    </ul>

                </div>
                <!--                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                        Impression
                                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-primary">
                                        <li>
                                            <a target="_blank" href="<?php echo url_for('contratachat/ImprimerContrat') . '?id=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&idcontrat=' . $boncomm->getId() ?>">
                                               <i class="ace-icon fa fa-file-pdf-o align-top bigger-120"></i>  Imprimer Fiche contrat </a>
                                        </li>
                                       

                                    </ul>
                                </div>-->
            <?php } ?>

            <?php // include_partial('tddetaildoc', array('boncomm' => $docs_pdcd))  ?>
            <?php
        }
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
<?php if (count($boncomm->getDocumentachat()) > 1): ?>
    <a target="_blank" type="button" class="btn btn-sm btn-white btn-success"
       href="<?php echo url_for('contratachat/imprimerbContratdefinitifAvecpenalite') . '?id=' . $boncomm->getDocumentachat()->getFirst()->getId() . '&iddoc=' . $boncomm->getId() ?>">
        <i class="ace-icon fa fa-file-pdf-o align-top bigger-120"></i> 
        Fiche Contrat
    </a>
<?php endif; ?>