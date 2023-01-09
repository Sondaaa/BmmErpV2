<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Liste des Fiches Comptes Comptables
            <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;margin-left: 3px" href="<?php echo url_for("etat/imprimeEtatLivre?date_debut=" . $date_debut . "&date_fin=" . $date_fin . "&compte_min=" . $compte_min . "&compte_max=" . $compte_max . "&order=" . $order . "&toutlivre=" . $toutlivre); ?>">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
            <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px; margin-left: 3px" href="<?php echo url_for("etat/exportergrandlivreExcel_1?date_debut=" . $date_debut . "&date_fin=" . $date_fin . "&compte_min=" . $compte_min . "&compte_max=" . $compte_max . "&order=" . $order . "&toutlivre=" . $toutlivre); ?>">
                <i class="ace-icon fa fa-file-excel-o"></i>
                <span class="bigger-110 no-text-shadow">Exporter</span>
            </a>
        </div>
        <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;">
            <table id="liste_etat" class="table table-bordered table-hover" >

                <thead>
                    <tr style="border-bottom: 1px solid #000000">
                        <th style="width: 10%;">Date</th>
                        <th style="text-align: left;width: 10%;">Journal</th>
<!--                        <th style="width: 10%;">Nature Pièce</th>-->
                        <th style="width: 8%;">N° Pièce</th>
                        <th style="width: 4%;">N° Externe</th>
                        <th style="width: 25%;">Libellé</th>
                        <th style="width: 3%;">Lettre</th>
                        <th style="width: 10%;">Débit</th>
                        <th style="width: 10%;">Crédit</th>
                        <th style="width: 10%;">Solde Débiteur</th>
                        <th style="width: 10%;">Solde Créditeur</th>
                    </tr>
                </thead>
                <tfoot id="listPiece_footer">

                </tfoot>
                <tbody>   
                    <?php include_partial("etat/etat_livre_paginate", array("pager" => $pager, "page" => $page, "etatLivre" => $etatLivre, 'toutlivre' => $toutlivre, "pager_precedenet" => $pager_precedenet, "etatLivre_precedent" => $etatLivre_precedent)) ?>



                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function goPage(page) {
        $('[class="detail-row open"]').each(function () {
            $(this).remove();
        });
        var order = '';
        $('input[name=ordre]').each(function () {
            if ($(this).is(':checked'))
                order = $(this).val();
        });
        $.ajax({
            url: '<?php echo url_for('etat/goPage'); ?>',
            data: 'page=' + page + '&compte_min=' + $('#compte_min').val() + '&compte_max=' + $('#compte_max').val() +
                    '&date_debut=' + $('#date_debut').val() + '&date_fin=' + $('#date_fin').val() +
                    '&toutlivre=' + $('#toutlivre').is(':checked') + '&order=' + order,
            success: function (data) {
                $('#liste_etat tbody').html(data);
            }
        });
    }
</script>