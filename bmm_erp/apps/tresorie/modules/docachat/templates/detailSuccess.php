<div id="sf_admin_container">
    <h1 id="replacediv"> 
        Détail<br><?php echo $documentachat->getNumerodocachat() ?>
    </h1>
    <?php if ($documentachat->getIdTypedoc() == 7) { ?>
    <a class="btn btn-white btn-default" href="<?php echo url_for('Documents/Imprimerbonexterne?iddoc=') . $documentachat->getId() ?>"    target="_blanc">Exporter PDF</a>
        <?php if ($documentachat->ActionSignature() != "" && !$documentachat->getDatesignature()) { ?>
            <a href="#my-modal" role="button" class=" btn btn-white btn-default" data-toggle="modal">
                Ajouter Date Signature
            </a>
            <div id="my-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog" ng-controller="CtrlListesBonexterne">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="smaller lighter blue no-margin">Signature Bon commnade Externe Système: <br> <?php echo $documentachat->getNumerodocachat() ?></h3>
                        </div>

                        <div class="modal-body">
                            <table>
                                <tr>
                                    <td><label>Date Signature</label></td>
                                    <td><input type="date" id="datesignature<?php echo $documentachat->getId() ?>"</td>
                                </tr>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-sm btn-primary pull-right" data-dismiss="modal" ng-click="ValiderSignatureRedirectPage(<?php echo $documentachat->getId() ?>)">
                                <i class="ace-icon fa fa-plus"></i>
                                Ajouter
                            </button>
                            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                fermer
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        <?php } ?>
        <?php echo html_entity_decode($documentachat->ReadHtmlBonexterne()); ?> 
        
    <?php } ?>
    <?php if ($documentachat->getIdTypedoc() == 8) { ?>
        <?php echo html_entity_decode($documentachat->getHtmlDemandedeprix()); ?> 
        <a class="btn btn-white btn-default" href="<?php echo url_for('Documents/Imprimerdemandedachat?iddoc=') . $documentachat->getId() ?>"    target="_blanc">Exporter PDF</a>
    <?php } ?>
    <?php if ($documentachat->getIdTypedoc() == 2||$documentachat->getIdTypedoc() == 17) { ?>
        <?php echo html_entity_decode($documentachat->ReadHtmlBondeponse()); ?> 
        <a class="btn btn-white btn-default" href="<?php echo url_for('Documents/Imprimerbondeponse?iddoc=') . $documentachat->getId() ?>"    target="_blanc">Exporter PDF</a>
    <?php } ?>
</div>