<?php if ($numerotation == 1): ?>
    <tr>
        <td style="text-align: center;"><?php echo date('Y', strtotime($date_debut)); ?></td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($date_debut)) ?></td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($date_fin)); ?></td>
        <td style="text-align: center;"><?php echo '001' ?></td>
        <td style="text-align: center;"><?php echo '001' ?></td>
        <td style="text-align: center;"><?php echo '001' ?></td>
        <td style="text-align: center;">
            <i name="image_bloque" id_input="bloque_a" id="bloque_image_a" class="ace-icon fa fa-square-o bigger-170" onclick="checkBloque('a', 0)" style="cursor: pointer"></i>
            <i name="image_bloque_block" id_input="bloque_a" id="bloque_block_image_a" class="ace-icon fa fa-check-square-o bigger-170" onclick="checkBloque('a', 1)" style="cursor: pointer; display: none;"></i>
            <input id="bloque_a" type="hidden" value="0" />
        </td>
    </tr>
<?php endif; ?>
<?php if ($numerotation == 2): ?>
    <?php
    $m1 = date('m', strtotime($date_debut));
    $m2 = date('m', strtotime($date_fin));
    $y = date('Y', strtotime($date_fin));
    ?>
    <?php for ($i = $m1; $i <= $m2; $i++): ?>
        <?php
        $m = $i;

        $date_debut_mois = $y . '-' . $m . '-01';
        $date_fin_mois = date('Y-m-d', strtotime("+1 month", strtotime($date_debut_mois)));
        $date_fin_mois = date('Y-m-d', strtotime("-1 day", strtotime($date_fin_mois)));

        if ($i != $m1 && $i < 10)
            $m = '0' . $m;
        ?>

        <tr>
            <td style="text-align: center;"><?php echo date('y', strtotime($date_debut)) . $m; ?></td>
            <td style="text-align: center;"><?php
                if ($i == $m1)
                    echo date('d/m/Y', strtotime($date_debut));
                else
                    echo date('d/m/Y', strtotime($date_debut_mois));
                ?></td>
            <td style="text-align: center;"><?php
                if ($i == $m2)
                    echo date('d/m/Y', strtotime($date_fin));
                else
                    echo date('d/m/Y', strtotime($date_fin_mois));
                ?></td>
            <td style="text-align: center;"><?php echo '001' ?></td>
            <td style="text-align: center;"><?php echo '001' ?></td>
            <td style="text-align: center;"><?php echo '001' ?></td>
            <td style="text-align: center;">
                <i name="image_bloque_block" id_input="bloque_<?php echo $i ?>" id="bloque_block_image_<?php echo $i ?>" class="ace-icon fa fa-check-square-o bigger-170" onclick="checkBloque('<?php echo $i ?>', 1)" style="cursor: pointer; display: none;"></i>
                <i name="image_bloque" id_input="bloque_<?php echo $i ?>" id="bloque_image_<?php echo $i ?>" class="ace-icon fa fa-square-o bigger-170" onclick="checkBloque('<?php echo $i ?>', 0)" style="cursor: pointer"></i>
                <input id="bloque_<?php echo $i ?>" type="hidden" value="0" />
            </td>
        </tr>
    <?php endfor; ?>
<?php endif; ?>

<script  type="text/javascript">

    function checkBloque(i, bloque) {
        if (bloque == 0) {
            $('#bloque_image_' + i).hide();
            $('#bloque_block_image_' + i).show();
            $('#bloque_' + i).val('1');
        } else {
            $('#bloque_block_image_' + i).hide();
            $('#bloque_image_' + i).show();
            $('#bloque_' + i).val('0');
        }
    }

</script>