<?php for ($i = 0; $i < sizeof($balance); $i++): ?>
    <tr style="cursor: pointer;<?php echo $balance[$i]['ligne']; ?>" compte_id = "<?php echo $balance[$i]['id']; ?>">
        <td style="text-align: center;<?php echo $balance[$i]['ligne']; ?>" id="ligne_<?php echo $i; ?>">
            <?php if ($balance[$i]['compte'] != '411' && $balance[$i]['compte'] != '401'): ?>
                <?php echo $balance[$i]['compte']; ?>
            <?php else: ?>
                <a style="font-weight: bold;" onclick="ajouterLigne('<?php echo $balance[$i]['id']; ?>', '<?php echo $balance[$i]['compte']; ?>')">
                    <?php echo $balance[$i]['compte']; ?>
                </a>
            <?php endif; ?>
        </td>
        <td style="text-align: left; padding-left: 1%;<?php echo $balance[$i]['ligne']; ?>"><?php echo $balance[$i]['libelle']; ?></td>
        <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
            <?php
            if ($balance[$i]['debitOuv'] != 0)
                echo number_format($balance[$i]['debitOuv'], 3, '.', ' ');
            ?>
        </td>
        <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
            <?php
            if ($balance[$i]['creditOuv'] != 0)
                echo number_format($balance[$i]['creditOuv'], 3, '.', ' ');
            ?>
        </td>
        <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
            <?php
            if ($balance[$i]['debitMois'] != 0)
                echo number_format($balance[$i]['debitMois'], 3, '.', ' ');
            ?>
        </td>
        <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
            <?php
            if ($balance[$i]['creditMois'] != 0)
                echo number_format($balance[$i]['creditMois'], 3, '.', ' ');
            ?>
        </td>
        <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
            <?php
            if ($balance[$i]['debiteur'] != 0)
                echo number_format($balance[$i]['debiteur'], 3, '.', ' ');
            ?>
        </td>
        <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
            <?php
            if ($balance[$i]['crediteur'] != 0)
                echo number_format($balance[$i]['crediteur'], 3, '.', ' ');
            ?>
        </td>
    </tr>
<?php endfor; ?>