
<?php if ($documentachat->getIdTypedoc() == 20) { ?>
    <div id="sf_admin_container">
        <h1 id="replacediv"> 
            Détail Document Achats (Mouvement)
        </h1>
        <div id="sf_admin_content" ng-controller="Ctrlfacturation"> 
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <?php
                    $disabled = '';
                    $active = '';
                    $id_contrat = $documentachat->getIdContrat();
                    $documents_contrat = ContratachatTable::getInstance()->findById($id_contrat);
                    if ($documents_contrat->count() != 0) {
                        if ($lienFacture == 0)
                            $active = 'active';
                        foreach ($documents_contrat as $doc) {
                            $doc_achat = DocumentachatTable::getInstance()->find($documentachat->getId());
                            ?>
                            <li class="<?php echo $active; ?>">
                                <a href="#accuelbci_<?php echo $doc_achat->getId() ?>" data-toggle="tab" aria-expanded="true">Détail <?php echo $doc_achat; ?></a>
                            </li>
                            <?php
                            if ($active == 'active')
                                $active = '';
                        }
                    }
                    else {
                        if ($documentachat->getIdDocparent()) {
//                            $docparent = $documentachat->getDocumentparent();
                            ?>
                            <li>
                                <a href="#accuelbci" data-toggle="tab" aria-expanded="true">Détail <?php // echo $docparent;      ?></a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                    <li class="active">
                        <a href="#bceoubdc" data-toggle="tab" aria-expanded="false">Détail <?php
                            if ($documentachat->getIdTypedoc() == 20)
                                echo "Contrat";
                            ?>
                        </a>
                    </li>                
                    <?php // if ($lienBCEJ != 0) { ?>
<!--                        <li class="" ng-click="InialiserChamps()">
                            <a href="#jeton" data-toggle="tab" aria-expanded="false"><?php // echo $jeton->getTypedoc() ?></a>
                        </li>-->
                    <?php // } ?>
                    <?php // if ($lienFacture != 0) { ?>
<!--                        <li class="active">
                            <a href="#facture" data-toggle="tab" aria-expanded="false"><?php // echo $facture->getTypedoc() ?></a>
                        </li>-->
                    <?php // } ?>               
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <?php
                    if ($documents_contrat->count() != 0) {
                        foreach ($documents_contrat as $doc) {
                            $doc_achat = DocumentachatTable::getInstance()->findOneByIdContrat($documents_contrat->getFirst()->getId());
                            ?>
                            <div class="tab-pane <?php if ($lienFacture == 0): ?>fade active in<?php endif; ?>" id="accuelbci_<?php echo $doc_achat->getId() ?>">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php ?>
                                        <div class="col-lg-10">
                                            <?php
                                            $doc_parent = DocumentachatTable::getInstance()->findOneByIdDocparent($doc_achat->getId());
// echo html_entity_decode($doc_achat->getBonCommandeInterne()); 
                                            ?>
                                            <?php echo html_entity_decode($doc_achat->getBonCommandeInterneFormContrat()); ?>
                                        </div>
                                        <div class="col-lg-2">
                                            <a style="font-size: 18px; width: 150px; height: 70px" class="btn btn-white btn-default" href="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=') . $doc_achat->getId() ?>" target="_blanc">Exporter PDF<br>
                                                <?php echo $doc_achat->getNumerodocumentachat(); ?></a>
                                        </div>
                                        <?php ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="tab-pane fade active in" id="accuelbci">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php
                                    if ($documentachat->getIdDocparent()) {
                                        $docparent = $documentachat->getDocumentparent();
                                        ?>
                                        <div class="col-lg-10">
                                            <?php // echo html_entity_decode($docparent->getBonCommandeInterne());  ?>
                                            <?php echo html_entity_decode($docparent->getBonCommandeInterneForm()); ?>
                                        </div>
                                        <div class="col-lg-2">
                                            <a style="font-size: 18px; width: 150px; height: 70px" class="btn btn-white btn-default" href="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=') . $docparent->getId() ?>" target="_blanc">Exporter PDF<br>
                                                <?php echo $docparent; ?></a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="tab-pane fade active in" id="bceoubdc">
                        <div class="row">
                            <div class="col-lg-10">
                                <?php
                                $disabled = '';
                                $active = '';
//                            $listesdocuments = Doctrine_Core::getTable('lignedocachat')
//                                            ->createQuery('a')
//                                            ->where('id_doc=' . $documentachat->getId())->orderBy('id asc')->execute();
                                if ($documentachat->getIdTypedoc() == 20) {
                                    ?>
                                    <div class="col-lg-8">
                                        <?php echo html_entity_decode($documentachat->ReadHtmlBCIContrat($id)); ?> 
                                    </div>
                                    <div class="col-lg-2" style="margin-top: 5%;">
                                        <ul>
                                            <?php if ($documentachat->getContratachat()->getConsulte() != 'true') { ?>
                                                <li>
                                                    <button style="font-size: 18px; width: 150px; height: 100px;" 
                                                            class="btn  btn-success" onclick="Saveconsultation('<?php echo $id_contrat ?>')">Consulter 
                                                        <br>le contrat <br>
                                                        <?php // echo $documentachat->getContratachat()->getReference(); ?>
                                                    </button>
                                                </li>
                                                <?php } ?>
                                                <li>
                                                    <a style="font-size: 18px; width: 150px; height: 70px;margin-top: 1%" class="btn btn-white btn-default" href="<?php echo url_for('Documents/Imprimerbonexterne?iddoc=') . $documentachat->getId() ?>" target="_blanc">Exporter PDF
                                                        <br>
                                                        <?php echo $documentachat->getContratachat()->getReference(); ?>
                                                    </a>
                                                </li>
                                                <?php $ligne_mouvement = LignemouvementfacturationTable::getInstance()->findOneByIdDocumentachat($documentachat->getId()); ?>
                                                <?php // die($ligne_mouvement->getId().'mmmmmmmm');
                                                if ($ligne_mouvement): ?>
                                                    <?php if ($ligne_mouvement->getMontant() == $documentachat->getMntttc()): ?>
                                                        <?php $disabled = ' disabledbutton'; ?>
                                                    <?php else: ?>
                                                        <?php $disabled = ''; ?>
                                                    <?php endif; ?>

                                                <?php else: ?>
                                                    <?php $disabled = ' disabledbutton'; ?>
                                                <?php endif; ?>
                                                <li id="export_to_facture" style="margin-top: 1%" class="<?php // echo $classBtn . ' ' . $classBtnF . ' ' . $disabled ?>">
                                                    <a href="<?php echo url_for('Documents/detailContrat') . '?exporterfacture=' . $documentachat->getId() . '&id=' . $documentachat->getId() . '&id_mouvement=' . $id?>" style="font-size: 18px; width: 150px; height: 80px; margin-top: 2px;" class="btn btn-primary">Exporter<br>Facture</a>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div> 

                        <?php // include_partial('documentachat/pvreceptioncontrat', array('documentachat' => $documentachat, 'lienBCEJ' => $lienBCEJ, 'lienFacture' => $lienFacture, 'jeton' => $jeton, 'facture' => $facture, 'classBtn' => $classBtn, 'classBtnF' => $classBtnF, 'disabled' => $disabled)) ?>

                    </div>
                </div>
            </div>
        <?php } ?>
        <script>
            function Saveconsultation(id) {
                $.ajax({
                    url: '<?php echo url_for('documentachat/consuletrContrat') ?>',
                data: 'id=' + id,
                success: function (data) {
                    document.location.reload();
                }
            });
        }
    </script>