<?php
$documentbudget = DocumentbudgetTable::getInstance()->findOneById($id);
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
                        <a data-toggle="tab" href="#ordonnance">
                            <i class="green ace-icon fa fa-file-text-o bigger-120"></i>
                            ORDONNANCE DE PAIEMENT
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="ordonnance" class="tab-pane fade in active">
                        <fieldset>
                            <legend>Ordonnance de Paiement :</legend>
                            <a class="btn btn-white btn-default" target="__blanc" href="<?php echo url_for('mouvementbanciare/Imprimerordonnance?id=' . $documentbudget->getId()) ?>">Exporter Pdf & Impression Fiche</a>
                            <br><br>
                            <object style="width: 100%;height: 900px;" data="<?php echo url_for('mouvementbanciare/Imprimerordonnance?id=' . $documentbudget->getId()) ?>" type="application/pdf">
                                <embed src="<?php echo url_for('mouvementbanciare/Imprimerordonnance?id=' . $documentbudget->getId()) ?>" type="application/pdf"/>
                            </object>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div><!--/.col -->
    </div>
</div>