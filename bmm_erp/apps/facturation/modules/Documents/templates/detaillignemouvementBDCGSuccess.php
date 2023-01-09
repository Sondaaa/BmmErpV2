 <div id="sf_admin_container">
        <h1 id="replacediv"> 
            Détail Document Achats
        </h1>
        <div id="sf_admin_content" ng-controller="Ctrlfacturation">  
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <?php
                    $disabled = '';
                    $documents_parent = DocumentparentTable::getInstance()->findByIdDocumentachat($documentachat->getId());
                    if ($documents_parent->count() != 0) {
                        if ($lienFacture == 0)
                            $active = 'active';
                        foreach ($documents_parent as $doc) {
                            $doc_achat = DocumentachatTable::getInstance()->find($doc->getIdDocumentparent());
                            ?>
                            <li class="<?php echo $active; ?>">
                                <a href="#accuelbci_<?php echo $doc_achat->getId() ?>" data-toggle="tab" aria-expanded="true">Détail <?php echo $doc_achat; ?></a>
                            </li>
                            <?php
                            if ($active == 'active')
                                $active = '';
                        }
                    } else {
                        if ($documentachat->getIdDocparent()) {
                            $docparent = $documentachat->getDocumentparent();
                            ?>
                            <li>
                                <a href="#accuelbci" data-toggle="tab" aria-expanded="true">Détail <?php echo $docparent; ?></a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                    <li class="">
                        <a href="#bceoubdc" data-toggle="tab" aria-expanded="false">Détail <?php
                            if ($documentachat->getIdTypedoc() == 22)
                                echo "B.D.C.Regroupé";
                           
                            ?>
                        </a>
                    </li>
                    <?php if ($lienBCEJ != 0) { ?>
                        <li class="" ng-click="InialiserChamps()">
                            <a href="#jeton" data-toggle="tab" aria-expanded="false"><?php echo $jeton->getTypedoc() ?></a>
                        </li>
                    <?php } ?>
                    <?php if ($lienFacture != 0) { ?>
                        <li class="active">
                            <a href="#facture" data-toggle="tab" aria-expanded="false"><?php echo $facture->getTypedoc() ?></a>
                        </li>
                    <?php } ?>
                    <!--                <li class=""><a href="#pvreception" data-toggle="tab" aria-expanded="false">Détails PV Réception</a>
                                    </li>-->

                    <!--                <li class=""><a href="#factures" data-toggle="tab" aria-expanded="false">Fiche Facture</a>
                                    </li>-->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <?php
                    if ($documents_parent->count() != 0) {
                        foreach ($documents_parent as $doc) {
                            $doc_achat = DocumentachatTable::getInstance()->find($doc->getIdDocumentparent());
                            ?>
                            <div class="tab-pane <?php if ($lienFacture == 0): ?>fade active in<?php endif; ?>" id="accuelbci_<?php echo $doc_achat->getId() ?>">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php
                                        if ($doc_achat->getIdTypedoc() == 6) {
                                            ?>
                                            <div class="col-lg-10">
                                                <?php // echo html_entity_decode($doc_achat->getBonCommandeInterne()); ?>
                                                <?php echo html_entity_decode($doc_achat->getBonCommandeInterneForm()); ?>
                                            </div>
                                            <div class="col-lg-2">
                                                <a style="font-size: 18px; width: 150px; height: 70px" class="btn btn-white btn-default" href="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=') . $doc_achat->getId() ?>" target="_blanc">Exporter PDF<br>
                                                    <?php echo $doc_achat; ?></a>
                                            </div>
                                            <?php
                                        }
                                        ?>
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
                                        if ($docparent->getIdTypedoc() == 6) {
                                            ?>
                                            <div class="col-lg-10">
                                                <?php // echo html_entity_decode($docparent->getBonCommandeInterne()); ?>
                                                <?php echo html_entity_decode($docparent->getBonCommandeInterneForm()); ?>
                                            </div>
                                            <div class="col-lg-2">
                                                <a style="font-size: 18px; width: 150px; height: 70px" class="btn btn-white btn-default" href="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=') . $docparent->getId() ?>" target="_blanc">Exporter PDF<br>
                                                    <?php echo $docparent; ?></a>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="tab-pane" id="accuelbci">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                if ($documentachat->getIdDocparent()) {
                                    $docparent = $documentachat->getDocumentparent();
                                    if ($docparent->getIdTypedoc() == 6) {
                                        ?>
                                        <div class="col-lg-10">
                                            <?php // echo html_entity_decode($docparent->getBonCommandeInterne()); ?>
                                            <?php echo html_entity_decode($docparent->getBonCommandeInterneForm()); ?>
                                        </div>
                                        <div class="col-lg-2" style="margin-top: 4%">
                                            <a style="font-size: 18px; width: 150px; height: 70px" class="btn btn-white btn-default" href="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=') . $docparent->getId() ?>" target="_blanc">Exporter PDF<br>
                                                <?php echo $docparent; ?></a>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="bceoubdc">
                        <div class="row">
                            <div class="col-lg-12">
                               
                                <?php if ($documentachat->getIdTypedoc() == 22) { ?>
                                    <div class="col-lg-10">
                                        <?php echo html_entity_decode($documentachat->ReadHtmlBondeponseRegroupe($documentachat->getId())); ?> 
                                    </div>
                                    <!--                                <div class="col-lg-2" style="margin-top: 4%">
                                                                        <a style="font-size: 18px; width: 150px;height: 70px" class="btn btn-white btn-default" href="<?php echo url_for('Docments/Imprimerdemandedachat?iddoc=') . $documentachat->getId() ?>"    target="_blanc">Exporter PDF
                                                                            <br>
                                    <?php echo $documentachat; ?>
                                                                        </a>
                                                                       
                                                                    </div>-->
                                    <div class="col-lg-2" style="margin-top: 5%;">
                                        <ul>
                                            <li>
                                                <a style="font-size: 18px; width: 150px; height: 70px;" class="btn btn-white btn-default" href="<?php echo url_for('Documents/Imprimerbondeponse?iddoc=') . $documentachat->getId() ?>" target="_blanc">Exporter PDF
                                                    <br>
                                                    <?php echo $documentachat; ?>
                                                </a>
                                            </li>
<!--                                            <li style="margin-top: 1%" class="<?php // echo $classBtn . ' ' . $classBtnJ . ' ' . $classBtnF ?>">
                                                <a href="<?php // echo url_for('Documents/detail') . '?exporterjeton=' . $documentachat->getId() . '&id=' . $documentachat->getId() ?>" style="font-size: 18px; width: 150px; height: 100px; margin-top: 3px;" class="btn btn-default">Modifier le Bon <br> de déponse au <br>Comptant</a>
                                            </li>-->
                                            <?php $ligne_mouvement = LignemouvementfacturationTable::getInstance()->findOneByIdDocumentachat($documentachat->getId()); ?>
                                            <?php if ($ligne_mouvement): ?>
                                                <?php if ($jeton): ?>
                                                    <?php if ($ligne_mouvement->getMontant() != $jeton->getMntttc()):
                                                        ?>
                                                        <?php $disabled = ' disabledbutton'; ?>
                                                    <?php else: ?>
                                                        <?php $disabled = ''; ?>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <?php if ($ligne_mouvement->getMontant() != $documentachat->getMntttc()): ?>
                                                        <?php $disabled = ' disabledbutton'; ?>
                                                    <?php else: ?>
                                                        <?php $disabled = ''; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php $disabled = ' disabledbutton'; ?>
                                            <?php endif; ?>
                                            <li id="export_to_facture" style="margin-top: 1%" class="<?php // echo $classBtnF . ' ' . $disabled ?>"><!--$classBtn . ' ' .-->
                                                <a href="<?php echo url_for('Documents/traiterFacture') . '?id=' . $documentachat->getId() ?>" 
                                                   style="font-size: 18px; width: 150px; height: 80px; margin-top: 2px;" class="btn btn-primary">
                                                    Traitement <br>Facture
                                                </a>
                                            </li>
<!--                                            <li id="export_to_facture" style="margin-top: 1%" class="<?php //  echo $classBtnF . ' ' . $disabled ?>">
                                                <a href="<?php //  echo url_for('Documents/detail') . '?exporterfacture=' . $documentachat->getId() . '&id=' . $documentachat->getId() ?>" style="font-size: 18px; width: 150px; height: 80px; margin-top: 2px;" class="btn btn-primary">Exporter<br>Facture</a>
                                            </li>-->
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php include_partial('documentachat/pvreception', array('documentachat' => $documentachat, 'lienBCEJ' => $lienBCEJ, 'lienFacture' => $lienFacture, 'jeton' => $jeton, 'facture' => $facture, 'classBtn' => $classBtn, 'classBtnF' => $classBtnF, 'disabled' => $disabled)) ?>
                </div>
            </div>
        </div>
    </div>


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