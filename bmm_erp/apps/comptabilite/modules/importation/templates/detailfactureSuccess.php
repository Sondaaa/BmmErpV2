<?php if ($documentachat->getIdContrat() == '') {?>
    <div id="sf_admin_container">
        <h1 id="replacediv"> 
            Détail : <?php echo $documentachat->getNumerodocachat() ?>
        </h1>
        <?php if ($documentachat->getIdTypedoc() == 7) { ?>
            <?php echo html_entity_decode($documentachat->ReadHtmlBonexterne()); ?> 
            <a class="btn btn-white btn-default" href="<?php echo url_for('importation/Imprimerbonexterne?iddoc=') . $documentachat->getId() ?>"    target="_blanc">Exporter PDF</a>
        <?php } ?>
        <?php if ($documentachat->getIdTypedoc() == 15) { ?>
            <div class="panel-body">
                <!-- Nav tabs -->

                <div class="tab-content">
                    <div class="tab-pane fade active in" id="accuelbci">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php echo html_entity_decode($documentachat->ReadHtmlFactureImression()); ?> 
                                <div class="col-lg-12">

                                    <a class="btn btn-white btn-default pull-right" href="<?php echo url_for('importation/Imprimerdocentre?iddoc=') . $documentachat->getId() ?>" target="_blanc">
                                        <i class="ace-icon fa fa-file-pdf-o"></i> Exporter en PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php } ?>
        <?php if ($documentachat->getIdTypedoc() == 8) { ?>
            <?php echo html_entity_decode($documentachat->getHtmlDemandedeprix()); ?> 
            <a class="btn btn-white btn-default" href="<?php echo url_for('importation/Imprimerdemandedachat?iddoc=') . $documentachat->getId() ?>" target="_blanc">Exporter en PDF</a>
        <?php } ?>
        <?php if ($documentachat->getIdTypedoc() == 2) { ?>
            <?php echo html_entity_decode($documentachat->ReadHtmlBondeponse()); ?> 
            <a class="btn btn-white btn-default" href="<?php echo url_for('importation/Imprimerbondeponse?iddoc=') . $documentachat->getId() ?>" target="_blanc">Exporter en PDF</a>
        <?php } ?>
    </div>
<?php } if ($documentachat->getIdContrat() != '') { ?>
<div id="sf_admin_container">
        <h1 id="replacediv"> 
            Détail : <?php echo $documentachat->getNumerodocachat();
           ?>
        </h1>
        <?php if ($documentachat->getIdTypedoc() == 7) { ?>
            <?php echo html_entity_decode($documentachat->ReadHtmlBonexterne()); ?> 
            <a class="btn btn-white btn-default" href="<?php echo url_for('importation/Imprimerbonexterne?iddoc=') . $documentachat->getId() ?>"    target="_blanc">Exporter PDF</a>
        <?php } ?>
        <?php if ($documentachat->getIdTypedoc() == 15) { ?>
            <div class="panel-body">
                <!-- Nav tabs -->

                <div class="tab-content">
                    <div class="tab-pane fade active in" id="accuelbci">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php echo html_entity_decode($documentachat->ReadHtmlFactureImression()); ?> 
                                <div class="col-lg-12">

                                    <a class="btn btn-white btn-default pull-right" href="<?php echo url_for('importation/Imprimerdocentre?iddoc=') . $documentachat->getId() ?>" target="_blanc">
                                        <i class="ace-icon fa fa-file-pdf-o"></i> Exporter en PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php } ?>
        <?php if ($documentachat->getIdTypedoc() == 8) { ?>
            <?php echo html_entity_decode($documentachat->getHtmlDemandedeprix()); ?> 
            <a class="btn btn-white btn-default" href="<?php echo url_for('imporation/Imprimerdemandedachat?iddoc=') . $documentachat->getId() ?>" target="_blanc">Exporter en PDF</a>
        <?php } ?>
        <?php if ($documentachat->getIdTypedoc() == 2) { ?>
            <?php echo html_entity_decode($documentachat->ReadHtmlBondeponse()); ?> 
            <a class="btn btn-white btn-default" href="<?php echo url_for('importation/Imprimerbondeponse?iddoc=') . $documentachat->getId() ?>" target="_blanc">Exporter en PDF</a>
        <?php } ?>
    </div>
    <?php } ?>
<style>

    h3{text-align: center;}

</style>