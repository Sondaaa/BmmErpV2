<td style="width: 15%;display: inline-flex;" >
    
                <?php $user = $sf_user->getAttribute('userB2m'); ?>
                <?php if ($user->getIdProfil() == 28 && $titrebudjet->getEtatbudget() == "2" ) { ?>
                    <?php  echo $helper->linkToEdit($titrebudjet, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>

                <?php } ?>
                <?php if (!$titrebudjet->getEtatbudget() || $titrebudjet->getEtatbudget() == "1") { ?>
                    <?php echo $helper->linkToEdit($titrebudjet, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
                    <?php if (count($titrebudjet->getLigprotitrub()) <= 0) echo $helper->linkToDelete($titrebudjet, array('params' => array(), 'confirm' => 'Êtes-vous sûr ?', 'class_suffix' => 'delete', 'label' => 'Supprimer',)) ?>
                <?php } else { ?>
                    <?php if ($titrebudjet->getEtatbudget() != "2"): ?>
                        <?php echo $helper->linkToEdit($titrebudjet, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Mettre à jour',)) ?>
                    <?php else: ?>
                        <?php echo $helper->linkToEdit($titrebudjet, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Détails budget',)) ?>
                    <?php endif; ?>
                   
                        <a class="btn btn-white btn-success" href="<?php echo url_for('titrebudjet/detailbudget') . '?id=' . $titrebudjet->getId(); ?>">Détail & Exporter Pdf</a>  
                   
                <?php } ?>
               
                 <?php if ($titrebudjet->getEtatbudget() != "3"): ?>                      
                        <?php $doc_parent_budget = TitrebudjetTable::getInstance()->findByIdTitrebudget($titrebudjet->getId()); ?>                      
                        <?php
                        if (count($doc_parent_budget) < 1)
                            echo $helper->linkToDelete($titrebudjet, array('params' => array(), 'confirm' => 'Êtes-vous sûr ?', 'class_suffix' => 'delete', 'label' => 'Supprimer',))
                            ?>
                  
                <?php endif; ?>

                <?php
                $user = $sf_user->getAttribute('userB2m');
                if ($user->getIdProfil() == 28):
                    ?>  
                    <?php if ($titrebudjet->getEtatbudget() == "3"): ?>
                     
                            <?php $doc_parent_budget = TitrebudjetTable::getInstance()->findByIdTitrebudget($titrebudjet->getId()); ?>                      
                            <?php
                            if (count($doc_parent_budget) < 1)
                                echo $helper->linkToDelete($titrebudjet, array('params' => array(), 'confirm' => 'Êtes-vous sûr ?', 'class_suffix' => 'delete', 'label' => 'Supprimer Budget Définitif',))
                                ?>
                      
                    <?php endif; ?>
                <?php endif; ?>
          
  
</td>