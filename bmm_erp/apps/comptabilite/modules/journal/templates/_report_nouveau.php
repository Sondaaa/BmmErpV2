<div class="mws-panel-body">
    <table id="listReport" class="mws-datatable-fn mws-table">
        <thead>
            <tr style="border-bottom: 1px solid #000000">
                <th>Compte</th>
                <th>Libellé</th>
                <th>Soldes</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($reports->count() == 0): ?>
                <tr>
                    <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="3">Liste des Comptes Comptables Vide</td>
                </tr>
            <?php endif; ?>
            <?php foreach ($reports as $report): ?>

                <tr>
                    <td style="text-align: center;"><?php echo $report->getNumeroCompte() ?></td>
                    <td style="text-align: left; padding-left: 1%;"><?php echo $report->getLibelle() ?></td>
                    <td style="text-align: right;padding-right: 1%;"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>