<table id="listTresorerie" class="mws-datatable-fn mws-table">
    <thead>
        <tr style="border-bottom: 1px solid #000000">
            <th style="width: 8%; text-align: center;">Numéro</th>
            <th style="width: 10%; text-align: center;">Date opèration</th>
            <th style="width: 25%; text-align: center;">Libellé</th>
            <th style="width: 10%; text-align: center;">Date Valeur</th>
            <th style="width: 10%; text-align: center;">Montant</th>
          
            <th style="width: 8%; text-align: center;">Type</th>

        </tr>
    </thead>
    <tbody>
        <?php if (sizeof($factures) == 0): ?>
            <tr>
                <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Liste des Règlements de Trésorerie Vide</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($factures as $reglement): ?>
            <tr>
                <td style="text-align: center;"><?php echo $reglement->getNumero() ?></td>
                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($reglement->getDate())) ?></td>
                <td style="text-align: center;"><?php echo $reglement->getLibelle() ?></td>
                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($reglement->getDatevaleur())) ?></td>
                <td style="text-align: right;"><?php echo $reglement->getMontant() ?></td>
               
                <td style="text-align: center;"><?php echo $reglement->getType(); ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script  type="text/javascript">

    $("table").addClass("table table-bordered table-hover");

</script>