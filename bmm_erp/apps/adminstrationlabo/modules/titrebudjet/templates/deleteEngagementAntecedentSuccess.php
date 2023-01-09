<?php $total = 0; ?>
<?php if ($engagements->count() != 0): ?>
    <?php foreach ($engagements as $engagement): ?>
        <tr>
            <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($engagement->getDate())); ?></td>
            <?php if ($engagement->getLigprotitrub()->getRubrique()->getIdRubrique() != null): ?>
                <?php $ligprotitrub = LigprotitrubTable::getInstance()->findOneByIdTitreAndIdRubrique($engagement->getIdTitre(), $engagement->getLigprotitrub()->getRubrique()->getIdRubrique()); ?>
                <td><?php echo $ligprotitrub->getNordre() . ' : ' . $ligprotitrub->getRubrique(); ?></td>
                <td><?php echo $engagement->getLigprotitrub()->getNordre() . ' : ' . $engagement->getLigprotitrub()->getRubrique()->getLibelle(); ?></td>
            <?php else: ?>
                <td><?php echo $engagement->getLigprotitrub()->getNordre() . ' : ' . $engagement->getLigprotitrub()->getRubrique(); ?></td>
                <td></td>
            <?php endif; ?>
            <td><?php if ($engagement->getIdDocachat() != null) echo $engagement->getDocumentachat(); ?></td>
            <td><?php echo $engagement->getDescription(); ?></td>
            <td style="text-align: right;"><?php echo number_format($engagement->getMontant(), 3, '.', ' '); ?></td>
            <td style="text-align: center;">
                <button class="btn btn-xs btn-danger" onclick="deleteEngagement('<?php echo $engagement->getId(); ?>')"><i class="ace-icon fa fa-trash"></i></button>  
            </td>
        </tr>
        <?php $total = $total + $engagement->getMontant(); ?>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="6" style="text-align: center; font-weight: bold; height: 30px;"> Pas d'engagement(s) antécédent(s)</td>
    </tr>
<?php endif; ?>
<tr style="background-color: #F4F4F4;">
    <td colspan="5" style="text-align: right; font-weight: bold;">Total </td>
    <td style="text-align: right; font-weight: bold;"><?php echo number_format($total, 3, '.', ' '); ?></td>
    <td></td>
</tr>