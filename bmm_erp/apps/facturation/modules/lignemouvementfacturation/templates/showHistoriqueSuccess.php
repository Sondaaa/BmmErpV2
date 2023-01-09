<?php
switch ($document->getIdTypedoc()) {
    case 2:
        $document_label = " B.D.C";
        break;

    case 7:
        $document_label = " B.C.E";
        break;

    case 19:
        $document_label = " Contrats";
        break;
}
?>
<h3>Historique du facturation du <?php echo $document_label; ?> N° : <?php echo $document->getReference(); ?></h3>
<table class="table table-bordered table-hover" style="width: 100%; margin-bottom: 0px;">
    <thead>
        <tr>
            <td style="width: 10%; font-size: 14px; font-weight: bold;">Ordre</td>
            <td style="width: 30%; font-size: 14px; font-weight: bold;">Date</td>
            <td style="width: 30%; font-size: 14px; font-weight: bold;">Facture</td>
            <td style="width: 30%; font-size: 14px; font-weight: bold;">Montant</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="3" style="text-align: center;">Montant <?php echo $document_label; ?> N° : <?php echo $document->getReference(); ?></td>
            <td style="text-align: right;"><?php echo number_format($document->getMntttc(), 3, '.', ' '); ?></td>
        </tr>
        <?php $total_facture = 0; ?>
        <?php foreach ($mouvements as $mvt): ?>
            <tr>
                <td><?php echo $mvt->getOrdre(); ?></td>
                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($mvt->getDate())); ?></td>
                <td><?php echo $mvt->getNumerofacture(); ?></td>
                <td style="text-align: right;"><?php echo number_format($mvt->getMontant(), 3, '.', ' '); ?></td>
            </tr>
            <?php $total_facture = $total_facture + $mvt->getMontant(); ?>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr style="background-color: #F2F2F2;">
            <td colspan="3" style="text-align: right;">Total</td>
            <td style="text-align: right;"><?php echo number_format($total_facture, 3, '.', ' '); ?></td>
        </tr>
        <tr style="background-color: #F2F2F2;">
            <td colspan="3" style="text-align: right;">Reste</td>
            <td style="text-align: right;"><?php echo number_format($document->getMntttc() - $total_facture, 3, '.', ' '); ?></td>
        </tr>
    </tfoot>
</table>