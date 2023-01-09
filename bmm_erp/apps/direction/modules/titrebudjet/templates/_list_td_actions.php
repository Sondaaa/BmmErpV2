<td style="width: 15%;">
    <?php // if ($titrebudjet->getEtatbudget() == "2"): ?>
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                <?php if (!$titrebudjet->getEtatbudget() || $titrebudjet->getEtatbudget() == "1") { ?>
                    <?php echo $helper->linkToEdit($titrebudjet, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Détails',)) ?>
                    <?php  if (count($titrebudjet->getLigprotitrub()) <= 0) echo $helper->linkToDelete($titrebudjet, array('params' => array(), 'confirm' => 'Êtes-vous sûr ?', 'class_suffix' => 'delete', 'label' => 'Supprimer',)) ?>
                <?php } else { ?>
                    <?php if ($titrebudjet->getEtatbudget() != "2"): ?>
                        <?php echo $helper->linkToEdit($titrebudjet, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Mettre à jour',)) ?>
                    <?php else: ?>
                        <?php echo $helper->linkToEdit($titrebudjet, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Détails',)) ?>
                    <?php endif; ?>
                    <li>
                        <a class="btn btn-white btn-success" href="<?php echo url_for('titrebudjet/detailbudget') . '?id=' . $titrebudjet->getId() ?>">Détail & Exporter Pdf</a>  
                    </li>  
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php // endif; ?>
</td>