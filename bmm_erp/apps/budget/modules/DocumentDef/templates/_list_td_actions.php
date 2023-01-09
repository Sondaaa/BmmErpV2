
<td style="text-align: center;">
    <ul class="sf_admin_td_actions" style="width: 100%;">
        <?php
        if ($documentbudget->getIdType() == 1) :
            foreach ($documentbudget->getPiecejointbudget() as $piece) :
                if ($piece->getIdDocachat() == null) :
        ?>
                    <!--<a target="_blank" class="btn btn-xs btn-primary" style="margin-right: 1px;"  type="button" href="<?php //  echo url_for('Documents/preengagementSansBCI?id=' . $documentbudget->getId());       
                                                                                                                            ?>">Modifier</a>-->
                    <a target="_blank" class="btn btn-xs btn-danger" style="margin-right: 1px; margin-left: 1px" type="button" href="<?php echo url_for('Documents/deleteBudget?id=' . $documentbudget->getId()); ?>">Annuler</a>
                    <?php echo $helper->linkToEdit($documentbudget, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Détail & Imprimer',)) ?>
                    <?php $ordonnace_paiement_hors_bci = DocumentbudgetTable::getInstance()->getByDocbudgetAndType($documentbudget->getId(), 2); ?>
                    <?php 
                     if (sizeof($ordonnace_paiement_hors_bci) <= 1) { ?>
                        <a target="_blank" class="btn btn-xs btn-primary" style="margin-right: 1px;" type="button"
                         href="<?php echo url_for('documentbudget/newordonancehorsBCI?id=' . $documentbudget->getId()); ?>">
                        Nouvelle Fiche de Paiement </a>
                    <?php } ?>
                <?php endif;
                ?>
        <?php
            endforeach;
        endif;
        ?>
        <?php
        if ($documentbudget->getIdType() == 1) :
            if ($documentbudget->getPiecejointbudget()->getFirst()) {
                if ($documentbudget->getPiecejointbudget()->getFirst()->getIdDocachat() != null) :
        ?>
                    <?php echo $helper->linkToEdit($documentbudget, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Détail & Imprimer',)) ?>
        <?php
                endif;
            }
        endif;
        ?>
        <?php //echo $helper->linkToDelete($documentbudget, array(  'params' =>   array(  ),  'confirm' => 'Êtes-vous sûr ?',  'class_suffix' => 'delete',  'label' => 'Delete',)) 
        ?>

        <?php if ($documentbudget->getCertificatretenue()->count() > 0 ) : ?>
            <li>
                <a class="btn btn-xs btn-primary" target="_blank" href="<?php echo url_for('certificatretenue/show?id=' . $documentbudget->getCertificatretenue()->getFirst()->getId()); ?>">
                    Certificat de R.S
                    <i class="ace-icon fa fa-eye icon-on-right"></i>
                </a>
            </li>
        <?php endif; ?>


        <?php if ($documentbudget->getPiecejointbudget()->count() > 0 && $documentbudget->getCertificatretenue()->count() == 0 ) : ?>
            <?php
            $ids = '';
            $fournisseur = null;
            foreach ($documentbudget->getPiecejointbudget() as $piece) :
                $doc_achat = $piece->getDocumentachat();
                if ($doc_achat->getIdTypedoc() == 15) {
                    $ids = $ids . $doc_achat->getId() . ',';
                    $fournisseur = $doc_achat->getFournisseur();
                }
                if ($doc_achat->getIdTypedoc() == 22) {
                    $documentachat_facture_bddcregroupe = DocumentachatTable::getInstance()->findbyIdDocparentAndIdTypedoc($piece->getIdDocachat(), 15);
                    foreach ($documentachat_facture_bddcregroupe as $docachat_facture_bddcr) :
                        $ids = $ids . $docachat_facture_bddcr->getId() . ',';
                        $fournisseur = $fournisseur . $docachat_facture_bddcr->getFournisseur() . ',';
                    endforeach;
                }
            endforeach;
            ?>
            <?php if ($fournisseur != null && $piece->getDocumentachat()->getIdTypedoc() == 15) : ?>
                <li>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle" aria-expanded="false">
                            Certificat de R.S <?php // echo $piece->getDocumentachat()->getIdTypedoc();    
                                                ?>
                            <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-primary dropdown-menu-right">
                            <li><a target="_blank" href="<?php echo url_for('DocumentDef/certificatRs?ids=' . $ids . '&id=' . $documentbudget->getId() . '&fournisseur_id=' . $fournisseur->getId()); ?>"><?php echo $fournisseur; ?></a></li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <?php if ($fournisseur != null && $piece->getDocumentachat()->getIdTypedoc() == 22) :
            ?>
                <li>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle" aria-expanded="false">
                            Certificat de BDCR R.S
                            <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-primary dropdown-menu-right">
                            <?php foreach ($documentachat_facture_bddcregroupe as $docachat_facture_bddcr) : ?>
                                <li><a target="_blank" href="<?php echo url_for('DocumentDef/certificatRsFacBDCR') . '?ids=' . $docachat_facture_bddcr->getId() . '&id=' . $documentbudget->getId() . '&fournisseur_id=' . $docachat_facture_bddcr->getFournisseur()->getId(); ?>"><?php echo $docachat_facture_bddcr->getFournisseur(); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</td>

<style>
    .sf_admin_td_actions li {
        margin-left: 0px !important;
        margin-right: 10px;
    }

    ul {
        margin: 0px 0px 0px 0px !important;
    }

    ul>li>ul {
        padding: 0px;
    }

    .dropdown-menu>li>a {
        margin: 0px !important;
    }

    .dropdown-menu-right {
        padding: 0px !important;
    }
</style>