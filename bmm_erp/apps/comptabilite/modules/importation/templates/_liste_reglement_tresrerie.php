
<table id="listFacture" class="mws-datatable-fn mws-table">
    <thead>
        <tr style="border-bottom: 1px solid #000000">
            <th style="width: 6%; text-align: center;"><input id="selecte_all" type="checkbox" /></th>
            <th style="width: 9%; text-align: center;">Date opèration</th>
            <th style="width: 10%; text-align: center;">Numéro Pièce</th>
            <th style="width: 25%; text-align: center;">Libellé</th>
            <th style="width: 25%; text-align: center;">Date Valeur</th>
            <th style="width: 8%; text-align: center;">Total Ht</th>
            <th style="width: 8%; text-align: center;">Total Tva</th>
            <th style="width: 8%; text-align: center;">Total Ttc</th>
            <th style="width: 8%; text-align: center;">Type</th>
          <th style="width: 8%; text-align: center;">Banque/Caisse</th>
            <th style="width: 10%; text-align: center;">Opérations</th>
        </tr>
        <tr>
            <th></th>
            <th><input type="text" id="numero" onkeyup="goPageTresorerie(1);" style="width: 100%;" /></th>
            <th><input id="libelle" onkeyup="goPageTresorerie(1);" type="text" style="width: 100%;" /></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
           <th><input id="type" onkeyup="goPageTresorerie(1);" type="text" style="width: 100%;" /></th>
        <th></th>
            <th></th>
        </tr>
    </thead>
    <tfoot>
    </tfoot>
    <tbody>
        <?php if (count($factures) == 0): ?>
            <tr>
                <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="10">Liste des Factures Vide</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($factures as $facture): ?>
            <tr class="row_facture" id="row_<?php echo $facture->getId(); ?>">
                 <td style="text-align: center;">
                    <input id="check_<?php echo $facture->getId(); ?>" value="<?php echo $facture->getId(); ?>" type="checkbox" class="list_checbox_facture"/>
                </td>
                  <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($facture->getDate())) ?></td>
              
                <td style="text-align: center;"><?php echo $facture->getNumero() ?></td>
                <td style="text-align: center;"><?php echo $facture->getLibelle() ?></td>
                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($facture->getDatevaleur())) ?></td>

                <td style="text-align: right;"><?php echo $facture->getTotalht() ?></td>
                <td style="text-align: right;"><?php echo $facture->getTotaltva() ?></td>

                <td style="text-align: right;"><?php echo $facture->getTotalttc() ?></td>
                <td style="text-align: center;"><?php echo $facture->getType();  ?></td>
                <td style="text-align: center;"><?php echo $facture->getCaissesbanques();  ?></td>
                <td style="cursor: pointer; text-align: center;">
                    <a title="Supprimer Facture" onclick="deleteRow('<?php echo $facture->getId() ?>')" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>   