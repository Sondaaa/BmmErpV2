<?php
$documentbudget = new Documentbudget();
$document_budget = Doctrine_Core::getTable('documentbudget')->findOneById($form->getObject()->getId());
$documentbudget = $document_budget;
$piecejointbudget = new Piecejointbudget();
$piece = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocumentbudget($documentbudget->getId());
$piecejointbudget = $piece;
if ($piecejointbudget != null)
    $id = $piecejointbudget->getIdDocachat();
else
    $id = '';
?>
<div id="sf_admin_container" >
    <div id="sf_admin_content">
        <div class="col-sm-12" >
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            <i class="green ace-icon fa fa-user bigger-120"></i>
                            IMPULATION BUDGETAIRE
                        </a>
                    </li>
                    <?php if ($documentbudget->getIdType() == 1): ?>
                        <li>
                            <a data-toggle="tab" href="#ordonnance">
                                <i class="green ace-icon fa fa-user bigger-120"></i>
                                ORDONNANCE DE PAIEMENT
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <fieldset>
                            <legend>Fiche d'engagement :</legend>
                            <a class="btn btn-white btn-default" target="__blanc" href="<?php echo url_for('Documents/Imprimerprovisoire?idfiche=') . $documentbudget->getId() . '&iddoc=' . $id ?>" >Exporter Pdf & Impression Fiche</a>
                            <br><br>
                            <object style="width: 100%;height: 900px;" data="<?php echo url_for('Documents/Imprimerprovisoire?idfiche=' . $documentbudget->getId() . '&iddoc=' . $id) ?>" type="application/pdf">
                                <embed src="<?php echo url_for('Documents/Imprimerprovisoire?idfiche=' . $documentbudget->getId() . '&iddoc=' . $id) ?>" type="application/pdf" />
                            </object>
                        </fieldset>
                    </div>
                    <?php if ($documentbudget->getIdType() == 1): ?>
                        <div id="ordonnance" class="tab-pane fade in">
                            <fieldset>
                                <legend>Ordonnance de Paiement :</legend>
                                <a class="btn btn-white btn-default" target="__blanc" href="<?php echo url_for('documentbudget/Imprimerordonnance?id=' . $documentbudget->getId()) ?>">Exporter Pdf & Impression Fiche</a>
                                <br><br>
                                <object style="width: 100%;height: 900px;" data="<?php echo url_for('documentbudget/Imprimerordonnance?id=' . $documentbudget->getId()) ?>" type="application/pdf">
                                    <embed src="<?php echo url_for('documentbudget/Imprimerordonnance?id=' . $documentbudget->getId()) ?>" type="application/pdf"/>
                                </object>
                            </fieldset>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div><!--/.col -->
    </div>
</div>