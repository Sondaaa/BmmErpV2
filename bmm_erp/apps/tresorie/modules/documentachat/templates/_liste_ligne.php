<div class="main_Container">
    <?php if (count($lignes) == 0) :  ?>

        <tr>
            <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Liste des Lignes du BCI vide</td>
        </tr>
    <?php endif; ?>

    <?php
    for ($i = 0; $i < sizeof($lignes); $i++) : ?>
        <tr style="background: <?php //echo $Str_Row_Color  
                                ?>">
            <td style="text-align:center;"><?php echo $i + 1; //echo sprintf('%02d', $lg->getNordre());  
                                            ?></td>
            <!-- <td style="text-align: justify;">
            <?php //echo $lignes[$i]['id'];; 
            ?>
        </td> -->

            <td style="text-align:left;">
                <?php echo $lignes[$i]['codearticle'] . " " . $lignes[$i]['designation']; ?>
            </td>
            <?php if ($lignes[$i]['unitedemander']) : ?>
                <td><?php echo $lignes[$i]['qte'] . " (" . trim($lignes[$i]['unitedemander']) . ")" ?></td>
            <?php else : ?>
                <td><?php echo $lignes[$i]['qte']; ?></td>
            <?php endif; ?>
            <!-- <td><?php //echo $lignes[$i]['projet']; ?></td> -->
        </tr>

    <?php endfor; ?>
</div>