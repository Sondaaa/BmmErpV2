<?php
$id = $rubrique->getId();
$code = trim($rubrique->getCode());
$libelle = trim($rubrique->getRubrique()->getLibelle());
?>
<tr>
    <td style="width: 5%; text-align: center; display: none;"><?php echo trim($rubrique->getNordre()) ?></td>
    <td style="width: 5%; text-align: center;"><?php echo $code; ?></td>
    <td style="width: 64%;">
        <table>
            <tr>
                <td colspan="4"><?php echo $libelle; ?></td>
            </tr>
            <?php $sous_rubriques = LigprotitrubTable::getInstance()->getSousRubrique($rubrique->getIdRubrique(), $rubrique->getIdTitre()); ?>
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
                                <?php foreach ($sous_rubriques as $sous_rubrique): ?>
                                    <?php include_partial('ligprotitrub/ligne_sous_rubrique_alimentation', array('sous_rubrique' => $sous_rubrique, 'index' => $id)); ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </td>
    <td style="width: 13%;">
        <input type="text" readonly="true" id="hidden_encaissement_mnt_<?php echo $rubrique->getId() ?>" value="<?php echo $rubrique->getMnt() ?>">
    </td>
    <td style="width: 13%;">
        <input type="text" value="" ligne_rubrique="rubrique" ligne_id="<?php echo $rubrique->getId() ?>" id_rubrique="<?php echo $rubrique->getId() ?>" nature="montant" id="encaissement_mnt_<?php echo $rubrique->getId() ?>" onkeyup="calculerResteEncaissement()" <?php if ($sous_rubriques->count() != 0): ?>readonly="true"<?php endif ?> />
    </td>
</tr>