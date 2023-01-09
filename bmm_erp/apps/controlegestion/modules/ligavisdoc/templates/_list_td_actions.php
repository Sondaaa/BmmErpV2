<td style="text-align: center;">
    <ul class="sf_admin_td_actions">
        <?php
        $ligavissig = Doctrine_Core::getTable('ligavissig')->findOneByIdDoc($ligavisdoc->getIdDoc());
        if ($ligavissig == null):
            ?>
            <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/rempliretexporter') . '?iddoc=' . $ligavisdoc->getIdDoc() ?>'" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-gavel"></i> Affecter Visa d'Achat</button>
        <?php endif; ?>
        <?php // echo $helper->linkToEdit($ligavisdoc, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
        <?php // echo $helper->linkToDelete($ligavisdoc, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
    </ul>
</td>
