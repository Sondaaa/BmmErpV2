<div class="page-header">
<h1 > 
        Détail : <?php echo $documentachat->getNumerodocachat() ?>
    </h1>
</div>

<div class="row">
   <div class="col-xs-12">
    <?php if ($documentachat->getIdTypedoc() == 4) { ?>
        <?php echo html_entity_decode($documentachat->ReadHTMLBonInterne()); ?> 
        <a class="btn btn-white btn-default" href="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=') . $documentachat->getId() ?>"    target="_blanc">Exporter PDF</a>
    <?php } ?>
    <?php if ($documentachat->getIdTypedoc() == 7) { ?>
        <?php echo html_entity_decode($documentachat->ReadHtmlBonexterne()); ?> 
        <a class="btn btn-white btn-default" href="<?php
        // echo url_for('Documents/Imprimerbonexterne?iddoc=') . $documentachat->getId() 
        echo   url_for('Documents/ImprimerBCEDefinitf') . '?iddoc=' . $documentachat->getId()?>"    target="_blanc">Exporter PDF</a>
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
</div>


