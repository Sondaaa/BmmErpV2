<ul id="ul_hierarchie" style="margin-left: 5%;">
    <?php for($i = sizeof($listes) - 1; $i >= 0; $i--): ?>
    <li name="hierarchie_compte" value="<?php echo $listes[$i]['id']; ?>" style="line-height: 30px;"><?php echo html_entity_decode($listes[$i]['libelle']); ?></li>
        <?php endfor; ?>
</ul>

<h5 class="lighter block brown" style="line-height: 25px;">
    <b>Remarque :</b> Il se peut que toute cette hiérarchie sera transferée pour transferer le compte comptable :
    <br>
    <label style="color: #000000;"><u><?php echo html_entity_decode($listes[0]['libelle']); ?></u></label>
</h5>