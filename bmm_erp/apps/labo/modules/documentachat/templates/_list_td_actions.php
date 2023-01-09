<td style="width: 45%;">
<?php 
if($documentachat->getIdDocparent())
$doc_parent_def = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($documentachat->getIdDocparent(), 23);
else
$doc_parent_def = null;
?>
<?php if ($idtype == 11 && count($doc_parent_def) == 0) {?>
<a target="_blanc" id="btnimpexpobsortiedef"  class="btn btn-outline btn-success" href="<?php echo url_for('documentachat/new?iddoc=') . $documentachat->getId() . '&idtype=23'; ?>">Exporter :<?php echo $documentachat->getNumerodocachat() ?> en Définitif</a>
<?php }?>
<a target="_blanc"  id="btnimpexpo"  class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/showdocument?iddoc=') . $documentachat->getId() ?>">Détail N°:<?php echo $documentachat->getNumerodocachat() ?></a>
    <a target="_blanc"  class="btn btn-outline btn-danger" href="<?php echo url_for('Documents/Imprimerdocentre?iddoc=' . $documentachat->getId()) ?>">Impprimer & Exporter Pdf</a>
    <?php if ($documentachat->getEtatdocachat() == ''): ?>
        <?php if ($documentachat->getIdEtatdoc() == 17) {?>
            <a id="btnimpexpo"  class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/new?iddoc=') . $documentachat->getId() ?>">Valider  le transfer</a>
        <?php }?>
    <?php endif;?>

</td>
