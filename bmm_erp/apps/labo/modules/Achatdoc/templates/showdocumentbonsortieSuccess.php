<div id="sf_admin_container">
    <h1><?php echo $documentachat->getTypedoc() ?>  N°:<?php echo $documentachat->getNumerodocachat() ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    ?>
    <div id="sf_admin_container">
    </div>
    <div id="sf_admin_content">  
        <?php
        $doc = new Documentachat();
        $doc = $documentachat;
        if ($doc->getIdTypedoc() == 10) {
            
            echo html_entity_decode($doc->ReadHtmlBonEntree());
            ?>
            <a class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/index?idtype=10') ?>">Listes P.V.</a>
            <a target="_blanc" class="btn btn-outline btn-danger" href="<?php echo url_for('Documents/Imprimerdocentre?iddoc=' . $documentachat->getId()) ?>">Impprimer & Exporter Pdf</a>
            <?php
        }
        if ($doc->getIdTypedoc() == 13) {
            echo html_entity_decode($doc->ReadHtmlBonTransfert());
            ?>
            <a class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/index?idtype=13') ?>">Listes des Transferts</a>
            <a target="_blanc" class="btn btn-outline btn-danger" href="<?php echo url_for('Documents/Imprimerdocentre?iddoc=' . $documentachat->getId()) ?>">Impprimer & Exporter Pdf</a>  
        <?php } ?>
        <?php
        if ($doc->getIdTypedoc() == 11 || $doc->getIdTypedoc() == 23 ) {
            echo html_entity_decode($doc->ReadHtmlBonSortie());
            ?>
            <a class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/index?idtype=11') ?>">Listes B.S.</a>
            <a target="_blanc" class="btn btn-outline btn-danger" href="<?php echo url_for('Documents/Imprimerdocentre?iddoc=' . $documentachat->getId()) ?>">Impprimer & Exporter Pdf</a>  
            <?php
        }
        if ($doc->getIdTypedoc() == 12) {
            echo html_entity_decode($doc->ReadHtmlBonRetour());
            ?>
            <a class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/index?idtype=12') ?>">Listes F.R.</a>
            <a target="_blanc" class="btn btn-outline btn-danger" href="<?php echo url_for('Documents/Imprimerdocentre?iddoc=' . $documentachat->getId()) ?>">Impprimer & Exporter Pdf</a>  
        <?php
        } if ($doc->getIdTypedoc() == 14) {
            echo html_entity_decode($doc->ReadHtmlAvoir());
            ?>
            <a class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/index?idtype=14') ?>">Listes des Avoir Fournisseur</a>
            <a target="_blanc"  class="btn btn-outline btn-danger" href="<?php echo url_for('Documents/Imprimerdocentre?iddoc=' . $documentachat->getId()) ?>">Impprimer & Exporter Pdf</a>  
<?php } ?>
    </div>
</div>