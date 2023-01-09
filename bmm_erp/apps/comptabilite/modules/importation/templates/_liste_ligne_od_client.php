<div style="font-size: 14px; margin-bottom: 10px">
    <b>Facture :</b> <?php echo $facture->getReference() ?>
</div>
<table style="width: 100%" class="table table-bordered table-hover" cellspacing="0" cellpadding="0" border="0">
    <thead>
        <tr>
            <th style="width: 30%; text-align: center;">Base</th>
            <th style="width: 30%; text-align: center;">Taux</th>
            <th style="width: 40%; text-align: center;">Net</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($facture->count() == 0): ?>
            <tr>
                <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">Liste des Factures Vide</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($facture->getLignefacturecomptableachat() as $ligne): ?>
            <tr>
                <td style="text-align: center;"><?php echo number_format($ligne->getTotalht(), 3, '.', ' ') ?></td>
                <td style="text-align: center;"><?php echo number_format($ligne->getTva()->getValeurtva(), 2, '.', '') ?> %</td>
                <td style="text-align: center;"><?php echo number_format($ligne->getTotaltva(), 3, '.', ' ') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>