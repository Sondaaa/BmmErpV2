<span class="bigger-120 blue">Liste des pièces comptables dupliquées à partir du <u><?php echo $piece->getNumero() ?></u></span>

<div class="row" style="margin-top: 20px; margin-left: 5%; width: 90%;">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Numéro</th>
                <th style="text-align: center;">Date</th>
                <th style="text-align: center;">Journal Comptable</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($piece->getPiececomptable() as $i => $piece_child): ?>
                <tr style="text-align: center;">
                    <td><?php echo $i + 1 ?></td>
                    <td><a href="<?php echo url_for('operation_piece/afficher?id=' . $piece->getId()); ?>" target="_blank"><?php echo $piece_child->getNumero() ?></a></td>
                    <td><?php echo date('d/m/Y', strtotime($piece_child->getDate())) ?></td>
                    <td><?php echo $piece_child->getJournalcomptable()->getCode() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td style ="padding: 0px;" colspan ="8">
                    <div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">
                        <div class ="col-xs-12"></div>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<div class="row" style="margin-left: 2%; width: 93%; text-align: justify; font-weight: normal;">
    <b style="color: #8A3104;">Remarque :</b> Libérer la pièces comptables N° <b><?php echo $piece->getNumero() ?></b> => Libérer toute les pièces comptables dupliquées par cette pièce (présentées dans le tableau en haut).
</div>