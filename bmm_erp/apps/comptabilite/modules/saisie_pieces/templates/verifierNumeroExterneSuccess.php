<?php if ($lignes->count() != 0): ?>
    <div style="width:100%;">
        <span>Attention : numéro externe existe</span>
        
        <div align="center" style="padding: 20px 0px; font-size: 18px">
            Attention ! Le numéro externe <u><?php echo $numero_externe; ?></u> déjà utilisé,<br> voulez-vous continuer ?
            <br><br>
            <a style="cursor: pointer; font-size: 14px; float: left; margin-left: 20px; margin-bottom: 20px;" onclick="showPieceExistantes()">
                Afficher la/les pièce(s) existante(s) et portant ce numéro <u><?php echo $numero_externe; ?></u>
            </a>
        </div>
        <div id="zone_piece_existante" style="display: none; margin-top: 10px;">
            <ul style="float: left; margin-left: 30px;">
                <?php foreach ($lignes as $ligne): ?>

                    <li><?php echo $ligne->getPiececomptable()->getNumero(); ?></li>

                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>