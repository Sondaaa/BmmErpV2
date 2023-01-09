<?php
$id = $sous_rubrique->getId();
$nordre = trim($sous_rubrique->getNordre());
$code = trim($sous_rubrique->getCode());
$libelle = trim($sous_rubrique->getRubrique()->getLibelle());
?>
<tr>
    <td style="width: 10%; text-align: center; display: none;"><?php echo $nordre; ?></td>
    <td style="width: 10%; text-align: center;"><?php echo $code; ?></td>
    <td style="width: 40%; font-size: 12px;">
        <table>
            <tr>
                <td colspan="4"><?php echo $libelle; ?></td>
            </tr>
            <?php $sous_rubriques = LigprotitrubTable::getInstance()->getSousRubrique($sous_rubrique->getIdRubrique(), $sous_rubrique->getIdTitre()); ?>
            <?php if ($sous_rubriques->count() != 0): ?>
                <tr>
                    <td>
                        <table>
                            <thead>
                                <tr>
                                    <th style="display: none;">Ordre</th>
                                    <th>Code</th>
                                    <th>Sous Rubrique</th>
                                    <th>Montant</th>
                                    <th>Encaissement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sous_rubriques as $s_rubrique): ?>
                                    <?php include_partial('ligprotitrub/ligne_sous_rubrique_alimentation', array('sous_rubrique' => $s_rubrique, 'index' => $id)); ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </td>
    <td style="width: 20%;">
        <input type="text" readonly="true" id="hidden_encaissement_mnt_<?php echo $id; ?>" value="<?php echo $sous_rubrique->getMnt(); ?>">
    </td>
    <td style="width: 20%;">
        <input type="text" value="" id_rubrique="<?php echo $id ?>" nature="montant" ligne_id="<?php echo $id; ?>" rubrique_montant="<?php echo $index ?>" id="encaissement_mnt_<?php echo $id; ?>" onkeyup="calculerRubriqueTotal()" onblur="setArrondissement()" <?php if ($sous_rubriques->count() != 0): ?>readonly="true"<?php endif ?> />
    </td>
</tr>