<?php

if($tranche)
{
    $rubriques = LigprotitrubTable::getInstance()->getFirstParentByTitre($formdetail->getObject()->getId(), $tranche->getId());
    $totalmnt = LigprotitrubTable::getInstance()->getMntAllouerAndMntEnCaissier($formdetail->getObject()->getId(), $tranche->getId());
    $mntglobal = $formdetail->getObject()->getMntglobal() - $tranche->getMntvaleur();
    $alimentations = AlimentationcompteTable::getInstance()->findByIdTranchebudget($tranche->getId());
}

else{
    $rubriques = LigprotitrubTable::getInstance()->getFirstParentByTitre($formdetail->getObject()->getId(), null);
    $totalmnt = LigprotitrubTable::getInstance()->getMntAllouerAndMntEnCaissier($formdetail->getObject()->getId(), null);
    $mntglobal = $formdetail->getObject()->getMntglobal() ;
    $tranches=Doctrine_Core::getTable('Tranchebudget')->createQuery('a')
    ->whereIn('id',json_decode($formdetail->getObject()->getIdTranches()))->execute();
    
    
}


?>

<fieldset>
    <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
        <table class="disabledbutton">
            <tr>
                <td>
                    <label>Montant du tranche:  <?php if($tranche) echo $tranche->getMntvaleur();else echo $formdetail->getObject()->getMntglobal() ?></label>
                   
                </td>

                <td>
                    <label>Reste du Montant du tranche: <?php  echo $formdetail->getObject()->getMntRestant() ?></label>
                    
                </td>
            </tr>
        </table>
    <?php } ?>
    <div class="col-lg-7" style="float: left; margin-top: 15px; margin-bottom: 15px;">
        <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
            <table>
                <thead>
                    <tr>
                        <td colspan="5"><label>Mnt Reste débloqué: <?php echo $mntglobal ?></label>

                            
                        </td>
                    </tr>
                    <tr>
                        <th>Nom du Tranche</th>
                        <th>Date</th>
                        <th>Mnt.</th>
                        <th>Pourcentage%</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php if($tranche):?>
                    <tr>
                        <td><?php echo $tranche->getLibelle() ?></td>
                        <td>
                            <?php if ($tranche) echo $tranche->getDatetranche() ?>
                        </td>
                        <td>
                           <?php echo $tranche->getMntvaleur() ?>
                        </td>
                        <td>
                            <?php  echo $tranche->getMntpourcentage() ?>
                        </td>
                       
                    </tr>
                    <?php else: ?>
                        <?php foreach($tranches as $tranche_detail):?>

                            <tr>
                        <td><?php echo $tranche_detail->getLibelle() ?></td>
                        <td>
                            <?php if ($tranche_detail) echo $tranche_detail->getDatetranche() ?>
                        </td>
                        <td>
                           <?php echo $tranche_detail->getMntvaleur() ?>
                        </td>
                        <td>
                            <?php  echo $tranche_detail->getMntpourcentage() ?>
                        </td>
                       
                    </tr>
                            <?php endforeach;?>
                        <?php endif; ?>
                </tbody>
            </table>
            
        <?php } ?>
    </div>
    <?php if($tranche):?>
    <div class="col-lg-5" style="float: right; margin-top: 15px; margin-bottom: 15px;">
       
                <table id="list_alimentation">
                    <thead>
                        <tr>
                            <th colspan="4" style="text-align: center;">Alimentation des Comptes Bancaires/CCP</th>
                        </tr>
                        <tr>
                            <th style="width: 22%;">Date</th>
                            <th style="width: 47%;">Compte Bancaires/CCP</th>
                            <th style="width: 25%;">Montant</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alimentations as $alimentation) : ?>
                            <tr>
                                <td style="text-align: center;">
                                    <?php echo date('d/m/Y', strtotime($alimentation->getDate())) ?>
                                    
                                </td>
                                <td><?php echo $alimentation->getCaissesbanques() ?></td>
                                <td style="text-align: right;">
                                    <?php echo number_format($alimentation->getMontant(), 3, '.', ' ') ?>
                                    
                                </td>
                               
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
          
    </div>
    <?php endif;?>
    <table>
    <thead>
                <tr>
                    <th style=" text-align:center; display: none;">N° Ordre</th>
                    <th style=" text-align:center;">Code</th>
                    <th style="">Rubrique</th>
                   
                        <th style="">CREDITS ALLOUES</th>
                   
                    <th style="">Mnt. Bloqué</th>
                </tr>
            </thead>
        <tbody>
            <?php $id_current = 0; ?>
            <?php foreach ($rubriques as $rubrique) : ?>
                <?php include_partial('ligprotitrub/ligne_trancherubrique', array('rubrique' => $rubrique, 'tranche' => $tranche)); ?>
                <?php $id_current = $rubrique->getId(); ?>
            <?php endforeach; ?>
            <?php $id_current = $id_current + 1; ?>
        </tbody>
    </table>

   

</fieldset>



<style>
    input[nature="montant"] {
        color: #007bb6;
        text-align: right;
    }

    input[nature="montant"]:focus {
        color: #007bb6;
    }

    table {
        margin-bottom: 0px !important;
    }
</style>