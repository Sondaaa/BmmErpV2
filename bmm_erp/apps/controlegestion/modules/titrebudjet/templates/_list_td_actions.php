<td style="width: 15%;">
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">

                <?php if (trim($titrebudjet->getTypebudget())==="Prototype" || !$titrebudjet->getEtatbudget() || $titrebudjet->getEtatbudget() == "1") { ?>
                    <?php if (trim($titrebudjet->getTypebudget())==="Prototype" || !(strpos(trim($titrebudjet->getTypebudget()), "Direction") === false) || !(strpos(trim($titrebudjet->getTypebudget()), "Global") === false)): ?>
                        <?php echo $helper->linkToEdit($titrebudjet, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
                    <?php endif; ?>
                    <?php  if (count($titrebudjet->getLigprotitrub()) <= 0) 
                    echo $helper->linkToDelete($titrebudjet, array('params' => array(), 'confirm' => 'Êtes-vous sûr ?', 'class_suffix' => 'delete', 'label' => 'Supprimer',)) ?>
                <?php } else { ?>
                    <?php if ($titrebudjet->getEtatbudget() == "3" && strpos(trim($titrebudjet->getTypebudget()), "Prototype")<=-1): ?>
                        <?php echo $helper->linkToEdit($titrebudjet, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Valider Budget',)) ?>
                    <?php endif; ?>
                    <?php if(strpos(trim($titrebudjet->getTypebudget()), "Prototype")<=-1):?>
                    <li style="text-align: left">
                        <a class="btn btn-white btn-success" href="<?php echo url_for('titrebudjet/detailbudget') . '?id=' . $titrebudjet->getId() ?>">Détail & Exporter Pdf</a>  
                    </li>  
                    <?php endif;?>
                <?php } ?> 
                <?php
                $user = $sf_user->getAttribute('userB2m');
                //if ($user->getIdProfil() == 28):
                ?>
                <li>
                    <!--                         <a class="btn btn-danger" style="text-align: center"
                                               href="<?php // echo url_for('titrebudjet/delete') . '?id=' . $titrebudjet->getId()      ?>">Supprimer</a>  -->
                    <?php $doc_parent_budget = TitrebudjetTable::getInstance()->findByIdTitrebudget($titrebudjet->getId()); ?>                      
                    <?php
                    if (count($doc_parent_budget) < 1)
                        echo $helper->linkToDelete($titrebudjet, array('params' => array(), 'confirm' => 'Êtes-vous sûr ?', 'class_suffix' => 'delete', 'label' => 'Supprimer',))
                        ?>
                </li> 
                <?php //endif; ?>
            </ul>
        </div>
    </div>
</td>