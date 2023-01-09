<?php
$tranche_valide=Doctrine_Core::getTable('Tranchebudget')->createQuery('a')
->where('id_titrebudget='.$titrebudjet->getId())->andWhere('etattranche=true')->execute()->getFirst();


?>
<td>
    
                <?php $user = $sf_user->getAttribute('userB2m'); ?>
                <?php // if ($user->getIdProfil() == 28 && $titrebudjet->getEtatbudget() == "2" ) { ?>
                    <?php echo $helper->linkToEdit($titrebudjet, array('params' => array(),
                     'class_suffix' => 'edit', 'label' => 'Détails budget',)) ?>

                <?php // } ?>
                
                
          
  
</td>