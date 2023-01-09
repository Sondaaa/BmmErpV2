<td style="width: 45%;">
    <a id="btnimpexpo"  class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/showdocument?iddoc=') . $documentachat->getId() ?>">Détail N°:<?php echo $documentachat->getNumerodocachat() ?></a>
    <a target="_blanc"  class="btn btn-outline btn-danger" href="<?php echo url_for('Documents/Imprimerdocentre?iddoc=' . $documentachat->getId()) ?>">Impprimer & Exporter Pdf</a>
    <?php if ($documentachat->getEtatdocachat() == ''): ?>  
        <?php if ($documentachat->getIdEtatdoc() == 17) { ?>
            <a id="btnimpexpo"  class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/new?iddoc=') . $documentachat->getId() ?>">Valider  le transfer</a> 
        <?php } ?>
    <?php endif; ?>

</td>
