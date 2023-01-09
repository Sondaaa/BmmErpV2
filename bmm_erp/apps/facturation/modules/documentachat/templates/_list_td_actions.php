<?php
$doc_bdc = DocumentachatTable::getInstance()->getSansFrs();
//die($documentsachat_ligne->getId().'fdccccr');
if ($idtype == 22 && $documentachat->getIdFrs() == null) {
    ?>
<td > </ul><li>
        <a id="btnimpexpo" target="_blank" class="btn btn-xs btn-success" href="<?php echo url_for('Documents/detaillignemouvementBDCG?id=') . $documentachat->getId() ?>">
            <i class="ace-icon fa fa-eye"></i> Détail B.D.C.Reg.N° :
            <?php echo $documentachat->getNumerodocachat() ?>
        </a>
</li></ul> </td>
<?php } ?>
<?php if ($idtype != 20 && $idtype != 21) { ?>

    <td><ul>
        <?php if ($documentachat->getIdTypedoc() != 15) {


            if ( $documentachat->getIdFrs() != null) {?>
            
                <li style="width: 8%">

                <a id="btnimpexpo" target="_blank" class="btn btn-xs btn-success" href="<?php echo url_for('Documents/detail?id=') . $documentachat->getId() ?>">
                    <i class="ace-icon fa fa-eye"></i> Détail N°: <?php echo $documentachat->getNumerodocachat() ?>
                </a>
                </li>
            <?php }
        } ?>

    <?php if ($documentachat->getIdTypedoc() == 15) { ?>
           
                <li style="width: 8%">
                    <a id="btnimpexpo" target="_blank" class="btn btn-xs btn-success" 
                       href="<?php echo url_for('Documents/detailfacture?id=') . $documentachat->getId() ?>" style="max-width: 200px">
                        <i class="ace-icon fa fa-eye"></i> Détail N°: <?php echo $documentachat->getNumerodocachat() ?>
                    </a>
                </li>
                    <?php if ($documentachat->getEtatdocachat() == ''): ?>
                        <?php if (trim($documentachat->getEtatdocachat()) != "Annulé(e)"): ?>
                            <?php
                            $type_doc = $documentachat->getIdTypedoc();
                            while ($type_doc != '15') {
                                $documentachat = DocumentachatTable::getInstance()->findOneByIdDocparent($documentachat->getId());
                                $type_doc = $documentachat->getIdTypedoc();
                            }
                            if ($documentachat->getPiecejointbudget()->count() == 0):
                                ?>
                            <li class="sf_admin_action_delete">
                                <a class="btn btn-xs btn-danger" onclick="annulerFacture('<?php echo $documentachat->getId(); ?>')">Annuler</a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                <?php if ($documentachat->getAnnulationengagement()->count() == 0): ?>
                            <li class="sf_admin_action_delete">
                                <a class="btn btn-xs btn-danger" onclick="annulerFacture('<?php echo $documentachat->getId(); ?>')">Annuler</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
            <?php endif; ?>
          
    <?php } ?>
   </ul> </td>  
    <?php
}
if ($idtype == 20) {
    ?>
    <td> <ul>
    <?php if ($documentachat->getDocumentachat()->getIdTypedoc() != 15) { ?>
            <a id="btnimpexpo" target="_blank" class="btn btn-xs btn-success" href="<?php echo url_for('Documents/detaillignemouvement?id=') . $documentachat->getId() ?>">
                <i class="ace-icon fa fa-eye"></i> Détail N°: <?php echo $documentachat->getDocumentachat()->getNumerodocachat() ?>
            </a>
        <?php } ?>

    <?php if ($documentachat->getDocumentachat()->getIdTypedoc() == 15) { ?>
           
                <li>
                    <a id="btnimpexpo" target="_blank" class="btn btn-xs btn-success" href="<?php echo url_for('Documents/detailfacture?id=') . $documentachat->getId() ?>">
                        <i class="ace-icon fa fa-eye"></i> Détail N°: <?php echo $documentachat->getDocumentachat()->getNumerodocachat() ?>
                    </a>
                </li>
                <?php if ($documentachat->getDocumentachat()->getEtatdocachat() == ''): ?>
                    <?php if (trim($documentachat->getDocumentachat()->getEtatdocachat()) != "Annulé(e)"): ?>
                        <?php
                        $type_doc = $documentachat->getDocumentachat()->getIdTypedoc();
                        while ($type_doc != '15') {
                            $documentachat = DocumentachatTable::getInstance()->findOneByIdDocparent($documentachat->getId());
                            $type_doc = $documentachat->getIdTypedoc();
                        }
                        if ($documentachat->getPiecejointbudget()->count() == 0):
                            ?>
                            <li class="sf_admin_action_delete">
                                <a class="btn btn-xs btn-danger" onclick="annulerFacture('<?php echo $documentachat->getId(); ?>')">Annuler</a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                <?php if ($documentachat->getAnnulationengagement()->count() == 0): ?>
                            <li class="sf_admin_action_delete">
                                <a class="btn btn-xs btn-danger" style="margin-left: 2px; max-width: 200px"
                                   onclick="annulerFacture('<?php echo $documentachat->getId(); ?>')">Annuler</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
            <?php endif; ?>
           
    <?php } ?> 
   </ul>  </td>
<?php } ?>
