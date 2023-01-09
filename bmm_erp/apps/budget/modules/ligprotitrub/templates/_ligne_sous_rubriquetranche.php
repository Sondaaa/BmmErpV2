<?php
$id = $sous_rubrique->getId();
$nordre = trim($sous_rubrique->getNordre());
$code = trim($sous_rubrique->getCode());
$libelle = trim($sous_rubrique->getRubrique()->getLibelle());
?>
<tr>
    
    <td style=" text-align:center;">
        <?php echo $code; ?>
    </td>
    <td style="">
        <?php echo $libelle; ?>
        <?php 
        if(!isset($tranche))
        $sous_rubriques = LigprotitrubTable::getInstance()->getSousRubrique($sous_rubrique->getIdRubrique(), $sous_rubrique->getIdTitre()); 
        else if($tranche)
        $sous_rubriques = LigprotitrubTable::getInstance()->getSousRubrique($sous_rubrique->getIdRubrique(), $sous_rubrique->getIdTitre(),$tranche->getId()); 

        ?>
        <table  <?php if ($sous_rubriques->count() == 0): ?>style="display: none;"<?php endif; ?>>
            <thead>
                <tr>
                    <th style=" text-align:center; display: none;">N° Ordre</th>
                    <th style=" text-align:center;">Code</th>
                    <th style="">Sous Rubrique</th>
                    <?php if (trim($sous_rubrique->getTitrebudjet()->getTypebudget()) != 'Prototype'): ?>
                        
                        <th style="">CREDITS ALLOUES</th>
                    <?php endif; ?>
                    <th style="">Mnt. Bloqué</th>
                </tr>
            </thead>
            <tbody id="tbody_rubrique_<?php echo $index . '_' . $id; ?>">
                <?php foreach ($sous_rubriques as $s_rubrique): ?>
                    <?php 
                    if(!isset($tranche))
                        include_partial('ligprotitrub/_ligne_sous_rubriquetranche', array('sous_rubrique' => $s_rubrique, 'index' => $index . '_' . $id)); 
                        else if($tranche)
                        include_partial('ligprotitrub/_ligne_sous_rubriquetranche', array('tranche'=>$tranche,'sous_rubrique' => $s_rubrique, 'index' => $index . '_' . $id)); 
                        
                        ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        </td>
    <?php if (trim($sous_rubrique->getTitrebudjet()->getTypebudget()) != 'Prototype'): ?>
        <!-- <td style="width: 8%; text-align: right;"></td>     -->
        <td style="width: 12%; text-align: right;">
            <?php echo number_format($sous_rubrique->getMnt(), 3, '.', '') ?>
        </td>
    <?php endif; ?>
    
       
            <td style="width: 8%;" class="">
                <?php echo number_format($sous_rubrique->getMntexterne() + $sous_rubrique->getMntencaisse(), 3, '.', '') ?>
            </td>
       
</tr>

<script  type="text/javascript">
    $("table").addClass("table table-bordered table-hover");
    $(document).ready(function () {
        $('#tbody_rubrique_<?php echo $index . '_' . $id; ?>').sortable();
    });
</script>