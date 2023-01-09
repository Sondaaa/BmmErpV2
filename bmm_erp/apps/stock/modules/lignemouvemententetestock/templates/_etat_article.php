<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Liste des Fiches E/S ARTICLE
            <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;margin-left: 3px" href="<?php echo url_for("lignemouvemententetestock/imprimeMouvementstock?date_debut=" . $date_debut . "&date_fin=" . $date_fin . "&article_min=" . $article_min ); ?>">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
            <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px; margin-left: 3px" href="<?php echo url_for("lignemouvemententetestock/exporterMouvementexcelExcel?date_debut=" . $date_debut . "&date_fin=" . $date_fin . "&article_min=" . $article_min ); ?>">
                <i class="ace-icon fa fa-file-excel-o"></i>
                <span class="bigger-110 no-text-shadow">Exporter</span>
            </a>
        </div>
        <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;">
            <table id="liste_etat" class="table table-bordered table-hover" >

                <thead>
                    <tr style="border-bottom: 1px solid #000000">
                        <th style="width: 7%;">Date</th>
                        <th style="text-align: left;width: 7%;">REF Article</th>
                        <th style="width: 7%;">Article</th>
                        <th style="width: 7%;">Famille</th>
                        <th style="width: 7%;">Sous Famille</th>
                        <th style="width: 10%;">N Bon entre</th>
                        <th style="width: 8%;">Qte Entre</th>
                        <th style="width: 8%;">Qte Sortie</th>
                        <th style="width: 8%;">Stock Final</th>
                        <th style="width: 12%;">PU Achat</th>
                        <th style="width: 12%;">CUMP</th>
                        <th style="width: 12%;">Stock en valeur</th>
                    </tr>
                </thead>
                <tfoot id="listPiece_footer">

                </tfoot>
                <tbody>   
                    <?php include_partial("lignemouvemententetestock/etat_article_paginate", array("pager" => $pager, "page" => $page, "etatLivre" => $etatLivre, "pager_precedenet" => $pager_precedenet, "etatLivre_precedent" => $etatLivre_precedent)) ?>                
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
        
        $.ajax({
            url: '<?php echo url_for('article/goPage'); ?>',
            data: 'page=' + page + '&article_min=' + $('#article_min').val()  +
                    '&date_debut=' + $('#date_debut').val() + '&date_fin=' + $('#date_fin').val() ,
            success: function (data) {
                $('#liste_etat tbody').html(data);
            }
        });
    }
</script>