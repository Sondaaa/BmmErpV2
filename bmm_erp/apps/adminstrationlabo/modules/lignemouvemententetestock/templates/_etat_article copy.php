<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Liste des Fiches E/S ARTICLE
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
                        <th style="text-align: left;width: 10%;">REF</th>
<!--                        <th style="width: 10%;">Nature Pièce</th>-->
                        <th style="width: 8%;">Article</th>
                        <th style="width: 4%;">Famille</th>
                        <th style="width: 25%;">Sous Famille</th>
                        <th style="width: 10%;">N Bon entre</th>
                        <th style="width: 10%;">Qte Entre</th>
                        <th style="width: 10%;">Qte Sortie</th>
                        <th style="width: 10%;">Stock Final</th>
                        <th style="width: 10%;">PU Achat</th>
                        <th>CUMP</th>
                        <th>Stock en valeur</th>
                    </tr>
                </thead>
                <tfoot id="listPiece_footer">

                </tfoot>
                <tbody>   
                    <?php //include_partial("etat/etat_livre_paginate", array("pager" => $pager, "page" => $page, "etatLivre" => $etatLivre, 'toutlivre' => $toutlivre, "pager_precedenet" => $pager_precedenet, "etatLivre_precedent" => $etatLivre_precedent)) ?>
                    <?php foreach($lignemouvement as $ligne):
                        $lignem=new Lignemouvemententetestock();
                        $lignem=$ligne;
                        ?>
                        <tr>
                            <td><?php echo $lignem->getCreatedAt() ?></td>
                            <td><?php echo $lignem->getArticle()->getCodeart() ?></td>
                            <td><?php echo $lignem->getArticle() ?></td>
                            <td><?php echo $lignem->getArticle()->getFamillearticle() ?></td>
                            <td><?php echo $lignem->getArticle()->getSousfamillearticle() ?></td>
                            <td><?php echo $lignem->getMouvemententetestock().' - '.$ligne->getLibelle() ?></td>
                            <td><?php echo $lignem->getQteEntere() ?></td>
                            <td><?php echo '' ?></td>
                            <td><?php echo $lignem->getQteEntere() ?></td>
                            <td><?php echo $lignem->getPuachat() ?></td>
                            <td><?php echo $lignem->getCump() ?></td>
                            <td><?php echo $lignem->getStockValeur() ?></td>

                        </tr>


                        <?php endforeach?>


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