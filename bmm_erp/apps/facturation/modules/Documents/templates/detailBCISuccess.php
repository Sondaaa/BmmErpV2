
<?php if ($documentachat->getIdTypedoc() == 6) { ?>
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
                    $documents_parent = DocumentachatTable::getInstance()->findById($documentachat->getId());
//                    die($documentachat->getId() . 'fr' . sizeof($documents_parent) . 'r' . $id);
                    if ($documents_parent->count() != 0) {
                        if ($lienFacture == 0)
                            $active = 'active';
                        foreach ($documents_parent as $doc) {
                            $doc_achat = DocumentachatTable::getInstance()->find($documentachat->getId());
                            ?>
                            <li class="<?php echo $active; ?>">
                                <a href="#accuelbci_<?php echo $doc_achat->getId() ?>" data-toggle="tab" aria-expanded="true">Détail <?php echo $doc_achat; ?></a>
                            </li>
                            <?php
                            if ($active == 'active')
                                $active = '';
                        }
                        ?>
                        <li>
                            <a href="#accuelbci" data-toggle="tab" aria-expanded="true">Détail <?php echo $docparent; ?></a>
                        </li>
                        <?php
                    }
                    ?>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <?php
//                    if ($documents_parent->count() != 0) {
//                        foreach ($documents_parent as $doc) {
                    $doc_achat = DocumentachatTable::getInstance()->find($documentachat->getId());
                    ?>
                    <div class="tab-pane <?php if ($lienFacture == 0): ?>fade active in<?php endif; ?>" id="accuelbci_<?php echo $doc_achat->getId() ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                if ($doc_achat->getIdTypedoc() == 6) {
                                    ?>
                                    <div class="col-lg-10">
                                        <?php // echo html_entity_decode($doc_achat->getBonCommandeInterne());  ?>
                                        <?php echo html_entity_decode($doc_achat->getBonCommandeInterneFormBCIDContrat()); ?>
                                    </div>
                                    <div class="col-lg-2">
                                        <a style="font-size: 18px; width: 150px; height: 70px" class="btn btn-white btn-default" href="<?php // echo url_for('documentachat/Imprimerdocachat?iddoc=') . $doc_achat->getId()   ?>" target="_blanc">Exporter PDF<br>
                                            <?php echo $doc_achat; ?></a>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
//                        }
//                    } else {
                    ?>

                    <?php
//                    }
                    ?>
                    <div class="tab-pane" id="accuelbci">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
//                                if ($documentachat->getIdDocparent()) {
                                $docparent = $documentachat;
//                                    if ($docparent->getIdTypedoc() == 6) {
                                ?>
                                <div class="col-lg-10">
                                    <?php // echo html_entity_decode($docparent->getBonCommandeInterne());  ?>
                                    <?php echo html_entity_decode($docparent->getBonCommandeInterneFormBCIDUContrat()); ?>
                                </div>
                                <div class="col-lg-2" style="margin-top: 4%">
                                    <a style="font-size: 18px; width: 150px; height: 70px" class="btn btn-white btn-default" href="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=') . $docparent->getId() ?>" target="_blanc">Exporter PDF<br>
                                        <?php echo $docparent; ?></a>
                                </div>
                                <?php
//                                    }
//                                }
                                ?>
                                <li id="export_to_facture" style="margin-top: 1%" class="<?php // echo $classBtn . ' ' . $classBtnF . ' ' . $disabled ?>">
                                    <a href="<?php echo url_for('Documents/detailBCI') . '?exporterfacture=' . $documentachat->getId() . '&id=' . $documentachat->getId() ?>" style="font-size: 18px; width: 150px; height: 80px; margin-top: 2px;" class="btn btn-primary">Exporter<br>Facture</a>
                                </li>
                            </div>
                        </div>
                    </div>


                    <?php // include_partial('documentachat/pvreception', array('documentachat' => $documentachat, 'lienBCEJ' => $lienBCEJ, 'lienFacture' => $lienFacture, 'jeton' => $jeton, 'facture' => $facture, 'classBtn' => $classBtn, 'classBtnF' => $classBtnF, 'disabled' => $disabled))  ?>
                </div>
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