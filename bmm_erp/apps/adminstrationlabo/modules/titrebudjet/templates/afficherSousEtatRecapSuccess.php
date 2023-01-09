<?php foreach ($listes as $liste): ?>
    <tr style="background-color: #deffd0;">
        <td><b style="color: #0066cc;"><?php echo $liste->getLigprotitrub()->getNordre(); ?> : </b> <?php echo $liste->getRubrique(); ?></td>
        <td style="text-align: right;"><?php echo number_format($liste->getMntAllouer(), 3, '.', ' '); ?></td>
        <td style="text-align: right;"><?php echo number_format($liste->getMntEncager(), 3, '.', ' '); ?></td>
        <td style="text-align: right;"><?php echo number_format($liste->getMntMaiement(), 3, '.', ' '); ?></td>
        <td style="text-align: right;"><?php echo number_format($liste->getRelicatEngager(), 3, '.', ' '); ?></td>
        <td style="text-align: right;"><?php echo number_format($liste->getRelicatPaiment(), 3, '.', ' '); ?></td>
    </tr>
<?php endforeach; ?>