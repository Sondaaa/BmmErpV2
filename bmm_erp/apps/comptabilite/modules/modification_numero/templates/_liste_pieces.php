<?php if ($pieces->count() == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="6">Liste Pieces Vide</td>
    </tr>
<?php else: ?>
    <?php $i = 0; ?>
    <?php foreach ($pieces as $piece): ?>
        <tr>
            <td name="ligne_date" style="text-align: center;">
                <?php echo date('d/m/Y', strtotime($piece->getDate())) ?>
                <input id="piece_id_<?php echo $i ?>" name="ligne" value="<?php echo $piece->getId() ?>" type="hidden"/>
            </td>
            <td name="ligne_numero" style="text-align: center;"><?php echo $piece->getNumero() ?></td>
            <td><?php echo $piece->getLibelle() ?></td>
            <td style="text-align: center;">
                <a style="cursor: pointer;" onclick="showDate('<?php echo $i; ?>')" id="text_new_date_<?php echo $i ?>"><i class="ace-icon fa fa-calendar bigger-110"></i> <?php echo date('d/m/Y', strtotime($piece->getDate())) ?></a>
            </td>
            <td style="text-align: center;">
                <input type="text" readonly="true" id="nouveau_numero_<?php echo $i ?>" name="nouveau_numero" style="width: 90%; text-align: center;" value="<?php echo $numero; ?>">
                <input id="serie_id_<?php echo $i ?>" name="serie" value="<?php echo $piece->getIdSerie() ?>" type="hidden"/>
                <input id="date_<?php echo $i ?>" name="date" value="<?php echo $piece->getDate() ?>" type="hidden"/>
            </td>
            <td style="text-align: center;">
                <button class="btn btn-xs btn-primary" onclick="saveModifNum('<?php echo $i ?>')">
                    <i class="ace-icon fa fa-save bigger-110"></i>
                    <span class="bigger-110 no-text-shadow">Enregistrer</span>
                </button>
            </td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
<?php endif; ?>