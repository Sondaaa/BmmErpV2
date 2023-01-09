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
                <td style="text-align: left;"><?php echo $facture->getLibelle() ?></td>
              
              

                <td style="text-align: right;"><?php echo $facture->getMontant() ?></td>
                <td style="text-align: center;"><?php echo $facture->getType(); ?></td>
                <td style="cursor: pointer; text-align: center;">
                    <a title="Supprimer Facture" onclick="deleteRow('<?php echo $facture->getId() ?>')" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash"></i></a>
                </td>
            </tr>
<?php endforeach; ?>
