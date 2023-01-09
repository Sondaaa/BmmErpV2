<div id="sf_admin_container">
    <h1 id="replacediv"> 
        Détail<br><?php echo $documentachat->getNumerodocachat() ?>
    </h1>
    <?php if ($documentachat->getIdTypedoc() == 7) { ?>
        <?php echo html_entity_decode($documentachat->ReadHtmlBonexterne()); ?> 
        <a class="btn btn-white btn-default" href="<?php echo url_for('Documents/Imprimerbonexterne?iddoc=') . $documentachat->getId() ?>"    target="_blanc">Exporter PDF</a>
    <?php } ?>
    <?php if ($documentachat->getIdTypedoc() == 8) { ?>
        <?php echo html_entity_decode($documentachat->getHtmlDemandedeprix()); ?> 
        <a class="btn btn-white btn-default" href="<?php echo url_for('Documents/Imprimerdemandedachat?iddoc=') . $documentachat->getId() ?>"    target="_blanc">Exporter PDF</a>
    <?php } ?>
    <?php if ($documentachat->getIdTypedoc() == 2) { ?>
        <?php echo html_entity_decode($documentachat->ReadHtmlBondeponse()); ?> 
        <a class="btn btn-white btn-default" href="<?php echo url_for('Documents/Imprimerbondeponse?iddoc=') . $documentachat->getId() ?>"    target="_blanc">Exporter PDF</a>
    <?php } ?>
</div>


