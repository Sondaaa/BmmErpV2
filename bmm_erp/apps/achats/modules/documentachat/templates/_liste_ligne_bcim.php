<div class="main_Container">
    <?php if (count($lignes) == 0): ?>

        <tr>
            <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Liste des Lignes du BCI vide</td>
        </tr>
    <?php endif;?>

    <?php
for ($i = 0; $i < sizeof($lignes); $i++): ?>
        <tr id="ligne_0" index_ligne="0">
            <td style="text-align:center;">
            
        <td >
            <input  type="input"  name="id" 
            id="id_ligne_<?php echo $lignes[$i]['id'] ?>"</td>

            <td style="text-align:left;">
                <?php echo $lignes[$i]['codearticle'] . " " . $lignes[$i]['designation']; ?>
            </td>
            <?php if ($lignes[$i]['unitedemander']): ?>
                <td><?php echo $lignes[$i]['qtedemander'] . " (" . trim($lignes[$i]['unitedemander']) . ")" ?></td>
            <?php else: ?>
                <td><?php echo $lignes[$i]['qtedemander']; ?></td>
            <?php endif;?>
            <td><?php echo $lignes[$i]['qtees']; ?></td>
            <td><input type="text"
             value="<?php echo number_format($lignes[$i]['qtedemander'] - $lignes[$i]['qtees'], '3', '.', ' '); ?>"
             id="qte_achat_<?php echo $lignes[$i]['id']; ?> ></td>
        </tr>

    <?php endfor;?>
</div>