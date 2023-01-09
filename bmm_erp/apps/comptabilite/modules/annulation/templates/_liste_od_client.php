<table id="myTable01">
    <thead>
        <tr>
            <th style="width: 10%; text-align: center;">Numéro</th>
            <th style="width: 9%; text-align: center;">Date</th>
            <th style="width: 10%; text-align: center;">Référence</th>
            <th style="width: 23%;">Client</th>
            <th style="width: 10%; text-align: center;">Total HT</th>
            <th style="width: 10%; text-align: center;">Total TVA</th>
            <th style="width: 8%; text-align: center;">Timbre</th>
            <th style="width: 10%; text-align: center;">Total TTC</th>
           

        </tr>
    </thead>
    <tbody>
        <?php if (sizeof($factures) == 0): ?>
            <tr>
                <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Liste des Factures Vide</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($factures as $facture): ?>
            <tr>
                <td style="text-align: center;"><?php echo $facture->getNumero() ?></td>
                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($facture->getDate())) ?></td>
                <td style="text-align: center;"><?php echo $facture->getReference() ?></td>
                <td><?php echo $facture->getClient()->getRs() ?></td>
                <td style="text-align: right;"><?php echo $facture->getTotalht() ?></td>
                <td style="text-align: right;"><?php echo $facture->getTotaltva() ?></td>
                <td style="text-align: right;"><?php echo $facture->getTimbre() ?></td>
                <td style="text-align: right;"><?php echo $facture->getTotalttc() ?></td>
               
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script  type="text/javascript">

    $("table").addClass("table table-bordered table-hover");

</script>