<ul class="sf_admin_actions">
    <?php if ($form->isNew()): ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
    <?php else: ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <li class="sf_admin_action_edit">
            <a target="_blank" href="<?php echo url_for('ouvrier/ImprimerFiche') . '?id=' . $ouvrier->getId() ?>" class="btn btn-white btn-primary">Imprimer</a>
        </li>
    <?php endif; ?>
</ul>
