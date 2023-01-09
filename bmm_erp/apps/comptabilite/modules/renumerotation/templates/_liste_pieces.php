<?php $first_number = $numero; ?>
<?php if ($pieces->count() == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="11">Extrait de Compte Vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($pieces as $piece): ?>
    <tr id="ligne_0" index_ligne="0">
        <td name="ligne_date" style="text-align: center;">
            <?php echo date('d/m/Y', strtotime($piece->getDate())) ?>
            <input name="ligne" value="<?php echo $piece->getId() ?>" type="hidden"/>
        </td>
        <td name="ligne_numero" style="text-align: center;"><?php echo $piece->getNumero() ?></td>
        <td><?php echo $piece->getLibelle() ?></td>
        <td style="text-align: center;" name="new_number"><?php echo $numero++ ?></td>
        <td style="text-align: center;">
            <a name="upfirstligne" title="Déplacer vers le 1èr ligne." onclick="upFirstLigne(0)" class="btn btn-xs btn-warning" style="padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-angle-double-up align-top" style="margin-top: 4px; margin-right: 0px;"></i></a>
            <a name="upligne" title="Déplacer vers le haut." onclick="upLigne(0)" class="btn btn-xs btn-primary" style="padding: 5.5px 12px; padding-top: 3px; margin-right: 1%;"><i class="ace-icon fa fa-arrow-up align-top" style="margin-top: 4px; margin-right: 0px;"></i></a>
            <a name="downligne" title="Déplacer vers le bas." onclick="downLigne(0)" class="btn btn-xs btn-primary" style="padding: 5.5px 12px; padding-top: 3px; margin-right: 1%;"><i class="ace-icon fa fa-arrow-down align-top" style="margin-top: 4px; margin-right: 0px;"></i></a>
            <a name="downlastligne" title="Déplacer vers le dernier ligne." onclick="downLastLigne(0)" class="btn btn-xs btn-warning" style="padding: 5.5px 12px; padding-top: 3px; margin-right: 1%;"><i class="ace-icon fa fa-angle-double-down align-top" style="margin-top: 4px; margin-right: 0px;"></i></a>
        </td>
    </tr>
<?php endforeach; ?>
<script  type="text/javascript">
    $('#first_number').val('<?php echo $first_number; ?>');
</script>