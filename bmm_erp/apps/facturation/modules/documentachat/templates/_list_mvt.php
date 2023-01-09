
<?php if (sizeof($liste_mvt) == 0): ?>
    <tr>
        <td class="empty_list" colspan="5" style="text-align: center">Liste des Mouvements vide</td>
    </tr>
<?php endif; ?>
<?php
for ($i = 0 ; $i < sizeof($liste_mvt) ; $i++):
   
?>
<tr class="ligne_compte">
    <td><?php echo $liste_mvt[$i]['numerofacture'] ; ?></td>
    <td style="text-align: center"> <?php echo date('d/m/Y', strtotime( $liste_mvt[$i]['date']))  ; ?> </td>
    
    <td style="text-align: center"><?php echo $liste_mvt[$i]['numero'] ?></td>
    <td style="text-align: right"><?php echo number_format($liste_mvt[$i]['montant'], 3, ".", " ");
     ?></td>
    <td style="text-align: center;">
        
        <a id="btnimpexpo" target="_blank" class="btn btn-xs btn-success" 
           href="<?php echo url_for('Documents/detaillignemouvementAchat?id=') . $liste_mvt[$i]['ref'] ?>">
            <i class="ace-icon fa fa-eye"></i> Détail BDCG N°:
            <?php echo $liste_mvt[$i]['numero'] ?>
        </a>
    </td>
</tr>
<?php endfor; ?>
  