<td class="sf_admin_text sf_admin_list_td_datecreationachat">
    <?php echo date('d/m/Y', strtotime($documentachat->getDatecreationachat())) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_reference">
    <?php echo $documentachat->getReference() ?>
</td>
<td class="sf_admin_text">
    <a target="_blank" href="<?php echo url_for('documentachat/showdocument?iddoc=') . $documentachat->getId() ?>"><?php echo $documentachat ?></a>
</td>
<td class="sf_admin_text sf_admin_list_td_agents">
    <?php echo $documentachat->getAgents() ?>
</td>
<?php if ($documentachat->getIdTypedoc() != 15): ?>
    <td class="sf_admin_text">
        <?php
        $document_imptation = null;
        $document_1 = DocumentachatTable::getInstance()->findByIdDocparent($documentachat->getId());
        if ($document_1->count() != 0):
            ?>
            <ul>
                <?php foreach ($document_1 as $document): ?>
                    <li><?php include_partial('Documents/tddetaildoc', array('boncomm' => $document)) ?></li>
                    <?php
                    if ($document->getIdTypedoc() != 8 && $document->getIdTypedoc() != 19 && $document_imptation == null):
                        if ($document->ActionSignature() != "")
                            $document_imptation = $document;
                    endif;
                    ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </td>
    <td>
        <?php if ($document_imptation != null) { ?>
            <span class="label label-sm label-warning" style="font-size: 12px !important; height: 100% !important; font-weight: bold; white-space: normal;">
                <?php echo html_entity_decode($document_imptation->ActionSignature()); ?>
            </span> 
        <?php } ?>
    </td>
    <td>
        <?php
        if ($document_imptation != null) {
            $p = new Piecejointbudget();
            $piece = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($document_imptation->getId());

            if ($piece) {
                $p = $piece;
//            echo $p->getDocumentbudget();
                ?>
                <a target="_blank" href="<?php echo sfconfig::get('sf_appdir') ?>/controlegestion.php/documentbudget/<?php echo $p->getDocumentbudget()->getId(); ?>/edit"><?php echo $p->getDocumentbudget(); ?></a>
                <?php
            }
        }
        ?>
    </td>
<?php else: ?>
    <td>
        <?php
        $document_imptation = null;
        $document_parent = DocumentachatTable::getInstance()->find($documentachat->getIdDocparent());
        if ($document_parent != null):
            ?>
            <ul>
                <li><?php include_partial('Documents/tddetaildoc', array('boncomm' => $document_parent)) ?></li>
                <?php
                if ($document_parent->getIdTypedoc() != 8 && $document_parent->getIdTypedoc() != 19 && $document_imptation == null):
                    if ($document_parent->ActionSignature() != "")
                        $document_imptation = $document_parent;
                endif;
                ?>
            </ul>
        <?php endif; ?>
    </td>
    <td>
        <?php if ($document_imptation != null) { ?>
            <span class="label label-sm label-warning" style="font-size: 12px !important;height: 100% !important;font-weight: bold">
                <?php echo html_entity_decode($document_imptation->ActionSignature()); ?>
            </span> 
        <?php } ?>
    </td>
    <td>
        <?php
        if ($document_imptation != null) {
            $p = new Piecejointbudget();
            $piece = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($document_imptation->getId());

            if ($piece) {
                $p = $piece;
//            echo $p->getDocumentbudget();
                ?>
                <a target="_blank" href="<?php echo sfconfig::get('sf_appdir') ?>/controlegestion.php/documentbudget/<?php echo $p->getDocumentbudget()->getId(); ?>/edit"><?php echo $p->getDocumentbudget(); ?></a>
                <?php
            }
        }
        ?>
    </td>
<?php endif; ?>