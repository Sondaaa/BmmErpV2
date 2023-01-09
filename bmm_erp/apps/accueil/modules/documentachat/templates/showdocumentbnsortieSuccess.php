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
        $doc = $documentachat;?>
        
        <?php
        if ($doc->getIdTypedoc() == 11 || $doc->getIdTypedoc() == 23) {
            echo html_entity_decode($doc->ReadHtmlBonSortie());
            ?>
            
            <a target="_blanc" class="btn btn-outline btn-danger" href="<?php echo url_for('Documents/Imprimerdocentre?iddoc=' . $documentachat->getId()) ?>">Impprimer & Exporter Pdf</a>  
            <?php
        }?>
        
    </div>
</div>