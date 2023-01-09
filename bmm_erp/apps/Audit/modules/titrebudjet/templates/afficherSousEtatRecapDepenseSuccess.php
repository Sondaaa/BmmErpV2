<?php foreach ($listes as $liste): ?>
    <tr style="background-color: #deffd0;">
        <td><b style="color: #0066cc;"><?php echo $liste->getLigprotitrub()->getNordre(); ?> : </b> <?php echo $liste->getRubrique(); ?></td>
        <td style="text-align: right;"><?php echo number_format($liste->getMntCaisse(), 3, '.', ' '); ?></td>
        <td style="text-align: right;"><?php echo number_format($liste->getMntBanque(), 3, '.', ' '); ?></td>
        <td style="text-align: right; color: #3BB014;"><?php echo number_format($liste->getMntCaisse() + $liste->getMntBanque(), 3, '.', ' '); ?></td>
        <td style="text-align: right;"><?php echo number_format($liste->getMntAnt(), 3, '.', ' '); ?></td>
        <td style="text-align: right; color: #CC1F00;"><?php echo number_format($liste->getMntCaisse() + $liste->getMntBanque() + $liste->getMntAnt(), 3, '.', ' '); ?></td>
    </tr>
<?php endforeach; ?>