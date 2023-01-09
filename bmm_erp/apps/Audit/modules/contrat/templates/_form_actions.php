<ul class="sf_admin_actions">
    <?php if ($form->isNew()): ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
    <?php else: ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <li class="sf_admin_action_list">
            <a target="_blank" style="margin-left: 15px" href="<?php echo url_for('contrat/ImprimerFiche?iddoc=' . $contrat->getId()) ?>" class="btn btn-white btn-primary">
                <i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
        </li>
    <?php endif; ?>
</ul>
