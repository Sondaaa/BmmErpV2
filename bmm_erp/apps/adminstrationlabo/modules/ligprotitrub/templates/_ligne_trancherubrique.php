<?php
$id = $rubrique->getId();
$code = trim($rubrique->getCode());
$libelle = trim($rubrique->getRubrique()->getLibelle());
?>
<tr>
   
    <td style=" text-align:center;">
       <?php echo $code; ?>
    </td>
    <td style="">
        <?php echo $libelle; ?>
        <?php 
        if(!isset($tranche))
        $sous_rubriques = LigprotitrubTable::getInstance()->getSousRubrique($rubrique->getIdRubrique(), $rubrique->getIdTitre());
        else if($tranche)
        $sous_rubriques = LigprotitrubTable::getInstance()->getSousRubrique($rubrique->getIdRubrique(), $rubrique->getIdTitre(),$tranche->getId());
        ?>
        <table  <?php if ($sous_rubriques->count() == 0): ?>style="display: none;"<?php endif; ?>>
            <thead>
                <tr>
                    <th style="width: 5%; text-align:center; display: none;">N° Ordre</th>
                    <th style="width: 25%; text-align:center;">Code</th>
                    <th style="width: 31%;">Sous Rubrique</th>
                    <?php if (trim($rubrique->getTitrebudjet()->getTypebudget()) != 'Prototype'): ?>
                        
                        <th style="width: 15%">CREDITS ALLOUES</th>
                    <?php endif; ?>
                    <th style="width: 15%">Mnt. Bloqué</th>
                </tr>
            </thead>
            <tbody id="tbody_rubrique_<?php echo $id; ?>">
                <?php foreach ($sous_rubriques as $sous_rubrique): ?>
                    <?php 
                        
                            include_partial('ligprotitrub/ligne_sous_rubriquetranche', array('tranche'=>$tranche,'sous_rubrique' => $sous_rubrique, 'index' => $id));
                        ?>
                <?php endforeach; ?>
            </tbody>
        </table>
       
    </td>
    <?php if (trim($rubrique->getTitrebudjet()->getTypebudget()) != 'Prototype'): ?>
        
        <td style="width: 12%; text-align: right;">
            <?php echo number_format($rubrique->getMnt(), 3, '.', '') ?>
        </td>
    <?php endif; ?>
    <?php if ($rubrique->getTitrebudjet()->getEtatbudget() == 2): ?>
        <?php if (trim($rubrique->getTitrebudjet()->getTypebudget()) != "Prototype"): ?>
            <td style="width: 8%;" class="disabledbutton">
                <?php echo number_format($rubrique->getMntexterne() + $rubrique->getMntencaisse(), 3, '.', '') ?>
            </td>
        <?php endif; ?>
    <?php else: ?>
        <?php if ($rubrique->getTitrebudjet()->getEtatbudget() == 1): ?>
            <?php if (trim($rubrique->getTitrebudjet()->getTypebudget()) != "Prototype"): ?>
            <td style="width: 8%;" class="disabledbutton">
               <?php echo number_format($rubrique->getMntexterne() + $rubrique->getMntencaisse(), 3, '.', '') ?>
            </td>
            <?php endif;?>
           
        <?php endif; ?>
    <?php endif; ?>
</tr>

<script  type="text/javascript">
    $("table").addClass("table table-bordered table-hover");
    $(document).ready(function () {
        $('#tbody_rubrique_<?php echo $id; ?>').sortable();
    });
</script>