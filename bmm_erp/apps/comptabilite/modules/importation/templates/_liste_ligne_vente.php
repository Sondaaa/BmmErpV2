<div style="font-size: 14px; margin-bottom: 10px">
    <b> Facture </b> : <?php echo $facture->getReference() ?> 
    <br>
    <b> Dossier Comptable </b> : <?php echo $facture->getDossierComptable()->getRaisonSociale(); ?> 
</div>
<table id="" style="width: 100%" class="mws-table" cellspacing="0" cellpadding="0" border="0">
    <thead>
        <tr>
            <th style="width: 10%">Date</th>
            <th style="width: 20%">Total Ht</th>
            <th style="width: 20%">Tva</th>
            <th style="width: 20%">Total Tva</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($facture->count() == 0): ?>
            <tr>
                <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">Liste des Factures Vide</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($facture->getLigneFactureComptableVente() as $ligne): ?>
            <tr>
                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($ligne->getDateImportation())) ?></td>
                <td style="text-align: center;"><?php echo $ligne->getTotalHt() ?></td>
                <td style="text-align: center;"><?php echo $ligne->getTva()->getTaux() ?></td>
                <td style="text-align: center;"><?php echo $ligne->getTotalTva() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>