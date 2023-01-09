<div id="sf_admin_container">
    <h1 id="replacediv"> Rapports des Travaux 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Traiter les Montants - <?php echo $rapport->getAnnee(); ?>
        </small>
    </h1>
    <div class="panel-body" style="padding: 0px;">
        <div class="col-md-12">
            <table>
                <tr>
                    <td style="width: 15%;">Année
                        <input type="text" class="align-center" readonly="true" value="<?php echo $rapport->getAnnee(); ?>" />
                        <input type="hidden" id="rapport_id" value="<?php echo $rapport->getId(); ?>" />
                    </td>
                    <td style="width: 15%;">Total Montants
                        <input type="text" class="align_right" readonly="true" value="<?php echo number_format($rapport->getMontant(), 3, '.', ' '); ?>" />
                    </td>
                    <td style="width: 35%;">Libellé
                        <input type="text" readonly="true" value="<?php echo $rapport->getLibelle(); ?>" />
                    </td>
                    <td style="width: 35%;">Service
                        <input type="text"readonly="true" value="<?php echo $rapport->getTyperapport(); ?>" />
                    </td>
                </tr>
            </table>
        </div>
        <?php if ($rapport->getIdType() != 2): ?>
            <div class="col-md-12">
                <legend>Ajouter les Travaux & Saisir les Montants</legend>
                <table>
                    <tr>
                        <td style="width: 10%;">Travail :</td>
                        <td style="width: 75%;">
                            <input type="text" value="" id="travail_rapport" />
                        </td>
                        <td style="width: 15%; text-align: center;">
                            <button onclick="ajouterTravail()" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-arrow-down"></i> Ajouter Travail</button>
                        </td>
                    </tr>
                </table>
                <table id="liste_travail" style="margin-bottom: 0px;">
                    <thead>
                        <tr>
                            <th colspan="4">Travail</th>
                            <th style="text-align: center; width: 20%;">Montant</th>
                            <th style="text-align: center; width: 10%;">Action</th>
                        </tr>
                        <tr>
                            <th style="width: 5%;"></th>
                            <th style="width: 40%;">Article</th>
                            <th style="text-align: center; width: 20%;">Montant Article</th>
                            <th style="text-align: center; width: 5%;">Action</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $travaux = TravailrapporttravauxTable::getInstance()->getByRapport($rapport->getId()); ?>
                        <?php foreach ($travaux as $travail): ?>
                            <tr id="tr_<?php echo $travail->getId() ?>">
                                <td colspan="4"><?php echo $travail->getLibelle() ?></td>
                                <td style="text-align: center;"><input readonly="true" style="width:100%;" class="align_right" type="text" travail="<?php echo $travail->getId() ?>" save="1" name="montant_travail" id="montant_travail_<?php echo $travail->getId() ?>" value="<?php echo number_format($travail->getMontant(), 3, '.', '') ?>" /></td>
                                <td style="display: none;"><input type="hidden" save="1" name="libelle_travail" travail="<?php echo $travail->getId() ?>" value="<?php echo $travail->getLibelle() ?>" /></td>
                                <td style="text-align: center;vertical-align:middle;"><button class="btn btn-xs btn-danger" onclick="suprimerBaseTravail('<?php echo $travail->getId() ?>')"><i class="ace-icon fa fa-trash"></i></button></td>
                            </tr>

                            <?php $lignes = LignetravailrapportTable::getInstance()->getByTravail($travail->getId()); ?>
                            <?php foreach ($lignes as $ligne): ?>
                                <tr name="tache_tr_<?php echo $travail->getId() ?>" id="tr_<?php echo $travail->getId() ?>_<?php echo $ligne->getId() ?>">
                                    <td style="text-align: center; background-color: #e6ffe3;"></td>
                                    <td style="text-align: center;"><input style="width:100%;" readonly="true" type="text" travail="<?php echo $travail->getId() ?>" save="1" name="libelle_tache" value="<?php echo $ligne->getLibelle() ?>" /></td>
                                    <td style="text-align: center;"><input style="width:100%;" class="align_right" readonly="true" type="text" travail="<?php echo $travail->getId() ?>" mtravail="<?php echo $travail->getId() ?>" save="1" name="montant_tache" value="<?php echo number_format($ligne->getMontant(), 3, '.', '') ?>" /></td>
                                    <td style="text-align: center;vertical-align:middle;"><button class="btn btn-xs btn-danger" onclick="supprimerBaseTache('<?php echo $travail->getId() ?>', '<?php echo $ligne->getId() ?>')"><i class="ace-icon fa fa-trash"></i></button></td>
                                    <td style="background-color: #ddd;"></td>
                                    <td style="background-color: #ddd;"></td>
                                </tr>
                            <?php endforeach; ?>

                            <tr id="btn_tr_<?php echo $travail->getId() ?>">
                                <td style="text-align: center;vertical-align:middle;"><button class="btn btn-xs btn-success" onclick="ajouterTache('<?php echo $travail->getId() ?>')"><i class="ace-icon fa fa-plus"></i></button></td>
                                <td style="text-align: center;"><input style="width:100%;" type="text" id="libelle_tache_<?php echo $travail->getId() ?>_0" value="" /></td>
                                <td style="text-align: center;"><input style="width:100%;" class="align_right" type="text" id="montant_tache_<?php echo $travail->getId() ?>_0" value="" /></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <table>
                    <tr style="background-color: #F3F3F3;">
                        <td style="width: 60%;"></td>
                        <td style="width: 10%; text-align: center;">Total : </td>
                        <td style="width: 20%;"><input id="total_travaux" class="align_right" type="text" readonly="true" value="<?php echo number_format($rapport->getMontant(), 3, '.', '') ?>" style="width: 100%;" /></td>
                        <td style="width: 10%;"></td>
                    </tr>
                </table>
            </div>
        <?php else: ?>
            <table>
                <tr>
                    <td style="width: 40%;">Article (Matériel Patrimoine) :
                        <input type="text" value="" id="article_libelle" onkeyup="chargerArticle('#article_libelle', '#article_id')"/>
                        <input type="hidden" value="" id="article_id" />
                    </td>
                    <td style="width: 10%;">MRE
                        <input id="mre" class="align_right" type="text" value="" />
                    </td>
                    <td style="width: 10%;">DPS
                        <input id="dps" class="align_right" type="text" value="" />
                    </td>
                    <td style="width: 10%;">DTX MAINT
                        <input id="maint" class="align_right" type="text" value="" />
                    </td>
                    <td style="width: 10%;">DTX BAT
                        <input id="bat" class="align_right" type="text" value="" />
                    </td>
                    <td style="width: 10%;">DTS PLANT
                        <input id="dts" class="align_right" type="text" value="" />
                    </td>
                    <td style="width: 10%; text-align: center; vertical-align: middle;">
                        <button onclick="ajouterArticle()" class="btn btn-xs btn-primary" style="width: 95px; font-weight: bold;"><i class="ace-icon fa fa-arrow-down"></i> Ajouter<br>Article</button>
                    </td>
                </tr>
            </table>
            <table id="liste_article" style="margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th style="width: 34%;">Article</th>
                        <th style="text-align: center; width: 10%;">MRE</th>
                        <th style="text-align: center; width: 10%;">DPS</th>
                        <th style="text-align: center; width: 10%;">DTX MAINT</th>
                        <th style="text-align: center; width: 10%;">DTX BAT</th>
                        <th style="text-align: center; width: 10%;">DTS PLANT</th>
                        <th style="text-align: center; width: 10%;">T FRAIS</th>
                        <th style="text-align: center; width: 6%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $articles = ArticlerapporttravauxTable::getInstance()->getByRapport($rapport->getId()); ?>
                    <?php foreach ($articles as $article): ?>
                        <tr id="tr_<?php echo $article->getId(); ?>">
                            <td style="background-color: #e6ffe3;"><?php echo $article->getImmobilisation()->getDesignation(); ?>"</td>
                            <td style="text-align: center;"><input readonly="true" class="align_right" type="text" article="<?php echo $article->getId(); ?>" save="1" name="montant_mre" id="montant_mre_<?php echo $article->getId(); ?>" value="<?php if ($article->getMre() != '') echo number_format($article->getMre(), 3, '.', ''); ?>" /></td>
                            <td style="text-align: center;"><input readonly="true" class="align_right" type="text" article="<?php echo $article->getId(); ?>" save="1" name="montant_dps" id="montant_dps_<?php echo $article->getId(); ?>" value="<?php if ($article->getDps() != '') echo number_format($article->getDps(), 3, '.', ''); ?>" /></td>
                            <td style="text-align: center;"><input readonly="true" class="align_right" type="text" article="<?php echo $article->getId(); ?>" save="1" name="montant_maint" id="montant_maint_<?php echo $article->getId(); ?>" value="<?php if ($article->getMaint() != '') echo number_format($article->getMaint(), 3, '.', ''); ?>" /></td>
                            <td style="text-align: center;"><input readonly="true" class="align_right" type="text" article="<?php echo $article->getId(); ?>" save="1" name="montant_bat" id="montant_bat_<?php echo $article->getId(); ?>" value="<?php if ($article->getBat() != '') echo number_format($article->getBat(), 3, '.', ''); ?>" /></td>
                            <td style="text-align: center;"><input readonly="true" class="align_right" type="text" article="<?php echo $article->getId(); ?>" save="1" name="montant_dts" id="montant_dts_<?php echo $article->getId(); ?>" value="<?php if ($article->getPlant() != '') echo number_format($article->getPlant(), 3, '.', ''); ?>" /></td>
                            <td style="text-align: center; background-color: #FFE0E0"><input readonly="true" class="align_right" type="text" article="<?php echo $article->getId(); ?>" save="1" name="montant_article" id="montant_article_<?php echo $article->getId(); ?>" value="<?php echo number_format($article->getMontant(), 3, '.', ''); ?>" /></td>
                            <td style="display: none;"><input type="hidden" save="1" name="id_article" article="<?php echo $article->getId(); ?>" value="<?php echo $article->getId(); ?>" /></td>
                            <td style="text-align: center; vertical-align: middle;"><button class="btn btn-xs btn-danger" onclick="suprimerBaseArticle('<?php echo $article->getId(); ?>')"><i class="ace-icon fa fa-trash"></i></button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <table>
                <tr style="background-color: #F3F3F3;">
                    <td style="width: 34%; font-size: 14px; text-align: right; vertical-align: middle;">Total : <span id="count_article"></span></td>
                    <td style="width: 10%;"><input id="total_mre" class="align_right" type="text" readonly="true" value="" /></td>
                    <td style="width: 10%;"><input id="total_dps" class="align_right" type="text" readonly="true" value="" /></td>
                    <td style="width: 10%;"><input id="total_maint" class="align_right" type="text" readonly="true" value="" /></td>
                    <td style="width: 10%;"><input id="total_bat" class="align_right" type="text" readonly="true" value="" /></td>
                    <td style="width: 10%;"><input id="total_dts" class="align_right" type="text" readonly="true" value="" /></td>
                    <td style="width: 10%;"><input id="total_article" class="align_right" type="text" readonly="true" value="" /></td>
                    <td style="width: 6%;"></td>
                </tr>
            </table>
        <?php endif; ?>
        <div class="col-md-3 pull-right">
            <button class="btn btn-white btn-primary" onclick="enregister()">Enregistrer</button>
            <a class="btn btn-white btn-success" href="<?php echo url_for('@rapporttravaux') ?>">Retour à la Liste</a>
        </div>
    </div>
</div>

<?php if ($rapport->getIdType() != 2): ?>
    <?php if ($travaux->count() != 0): ?>
        <input type="hidden" id="compteur_travail" value="<?php echo $travail->getId() + 1 ?>" />
        <?php if ($lignes->count() != 0): ?>
            <input type="hidden" id="compteur_tache" value="<?php echo $ligne->getId() + 1 ?>" />
        <?php else: ?>
            <input type="hidden" id="compteur_tache" value="1" />
        <?php endif; ?>
    <?php else: ?>
        <input type="hidden" id="compteur_travail" value="1" />
        <input type="hidden" id="compteur_tache" value="1" />
    <?php endif; ?>
<?php else: ?>
    <input type="hidden" id="compteur_article" value="0" />
<?php endif; ?>

<?php if ($rapport->getIdType() != 2): ?>
    <script  type="text/javascript">

        function ajouterTravail() {
            if ($("#travail_rapport").val() != '') {
                var id = parseInt($('#compteur_travail').val());
                var tr_html = '<tr id="tr_' + id + '">';
                tr_html = tr_html + '<td colspan="4">' + $("#travail_rapport").val() + '</td>';
                tr_html = tr_html + '<td style="text-align: center;"><input readonly="true" style="width:100%;text-align:right;" type="text" travail="' + id + '" save="0" name="montant_travail" id="montant_travail_' + id + '" value="0.000" /></td>';
                tr_html = tr_html + '<td style="display: none;"><input type="hidden" save="0" name="libelle_travail" travail="' + id + '" value="' + $("#travail_rapport").val() + '" /></td>';
                tr_html = tr_html + '<td style="text-align: center;vertical-align:middle;"><button class="btn btn-xs btn-danger" onclick="suprimerTravail(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
                tr_html = tr_html + '</tr>';
                $("#liste_travail tbody").append(tr_html);

                var id_tache = '0';
                var sous_tr_html = '<tr id="btn_tr_' + id + '">';
                sous_tr_html = sous_tr_html + '<td style="text-align: center;vertical-align:middle;"><button class="btn btn-xs btn-success" onclick="ajouterTache(' + id + ')"><i class="ace-icon fa fa-plus"></i></button></td>';
                sous_tr_html = sous_tr_html + '<td style="text-align: center;"><input style="width:100%;" type="text" id="libelle_tache_' + id + '_' + id_tache + '" value="" /></td>';
                sous_tr_html = sous_tr_html + '<td style="text-align: center;"><input style="width:100%;text-align:right;" type="text" id="montant_tache_' + id + '_' + id_tache + '" value="" /></td>';
                sous_tr_html = sous_tr_html + '<td></td>';
                sous_tr_html = sous_tr_html + '<td></td>';
                sous_tr_html = sous_tr_html + '<td></td>';
                sous_tr_html = sous_tr_html + '</tr>';
                $("#liste_travail tbody").append(sous_tr_html);
                id++;
                $('#compteur_travail').val(id);
                $("#travail_rapport").val('');
            } else {
                bootbox.dialog({
                    message: "Veuillez saisir le travail du rapport !",
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                            }
                });
            }
        }

        function ajouterTache(id) {
            if ($("#libelle_tache_" + id + "_0").val() != '' && $("#montant_tache_" + id + "_0").val() != '') {
                var id_tache = parseInt($('#compteur_tache').val());

                var sous_tr_html = '<tr name="tache_tr_' + id + '" id="tr_' + id + '_' + id_tache + '">';
                sous_tr_html = sous_tr_html + '<td style="text-align: center; background-color: #ddd;"></td>';
                sous_tr_html = sous_tr_html + '<td style="text-align: center;"><input style="width:100%;" readonly="true" type="text" travail="' + id + '" save="0" name="libelle_tache" value="' + $("#libelle_tache_" + id + "_0").val() + '" /></td>';
                sous_tr_html = sous_tr_html + '<td style="text-align: center;"><input style="width:100%;text-align:right;" readonly="true" type="text" travail="' + id + '" mtravail="' + id + '" save="0" name="montant_tache" value="' + $("#montant_tache_" + id + "_0").val() + '" /></td>';
                sous_tr_html = sous_tr_html + '<td style="text-align: center;vertical-align:middle;"><button class="btn btn-xs btn-danger" onclick="supprimerTache(' + id + ', ' + id_tache + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
                sous_tr_html = sous_tr_html + '<td style="background-color: #ddd;"></td>';
                sous_tr_html = sous_tr_html + '<td style="background-color: #ddd;"></td>';
                sous_tr_html = sous_tr_html + '</tr>';
                $('#btn_tr_' + id).before(sous_tr_html);

                id_tache++;
                $('#compteur_tache').val(id_tache);
                $("#libelle_tache_" + id + "_0").val('');
                $("#montant_tache_" + id + "_0").val('');
                setTotalTravail(id);
            } else {
                bootbox.dialog({
                    message: "Veuillez saisir la tâche et/ou le montant !",
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                            }
                });
            }
        }

        function supprimerTache(id, id_tache) {
            $("#tr_" + id + "_" + id_tache).remove();
            setTotalTravail(id);
        }

        function suprimerTravail(id) {
            $("#tr_" + id).remove();
            $('tr[name="tache_tr_' + id + '"]').each(function () {
                $(this).remove();
            });
            $("#btn_tr_" + id).remove();
            setTotalTravaux();
        }

        function setTotalTravail(id) {
            var total = 0;
            $('input[mtravail="' + id + '"]').each(function () {
                total = parseFloat(total) + parseFloat($(this).val());
            });
            $("#montant_travail_" + id).val(parseFloat(total).toFixed(3));
            setTotalTravaux();
        }

        function setTotalTravaux() {
            var total = 0;
            $('input[name="montant_travail"]').each(function () {
                total = parseFloat(total) + parseFloat($(this).val());
            });
            $("#total_travaux").val(parseFloat(total).toFixed(3));
        }

        function enregister() {
            var ids = '';
            var libelles = '';
            $('[name="libelle_travail"]').each(function () {
                ids = ids + $(this).attr('travail') + ',';
                if ($(this).attr('save') == "0") {
                    libelles = libelles + $(this).val() + ',**,';
                }
            });

            var montants = '';
            $('[name="montant_travail"]').each(function () {
                montants = montants + $(this).val() + ';';
            });

            var tache_libelles = '';
            $('[name="libelle_tache"]').each(function () {
                if ($(this).attr('save') == "0")
                    tache_libelles = tache_libelles + $(this).attr('travail') + ';*;' + $(this).val() + ',**,';
            });
            var tache_montants = '';
            $('[name="montant_tache"]').each(function () {
                if ($(this).attr('save') == "0")
                    tache_montants = tache_montants + $(this).attr('travail') + ';' + $(this).val() + ';*;';
            });

            $.ajax({
                url: '<?php echo url_for('rapporttravaux/enregistrer') ?>',
                data: 'id=' + $("#rapport_id").val() +
                        '&total=' + $("#total_travaux").val() +
                        '&ids=' + ids +
                        '&libelles=' + libelles +
                        '&montants=' + montants +
                        '&tache_libelles=' + tache_libelles +
                        '&tache_montants=' + tache_montants,
                success: function (data) {
                    bootbox.dialog({
                        message: "Travaux ajoutés avec succès !",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                    location.reload();
                }
            });
        }

        function supprimerBaseTache(id, id_tache) {
            $.ajax({
                url: '<?php echo url_for('rapporttravaux/deleteTache') ?>',
                data: 'id=' + id +
                        '&id_tache=' + id_tache,
                success: function (data) {
                    supprimerTache(id, id_tache);
                }
            });
        }

        function suprimerBaseTravail(id) {
            $.ajax({
                url: '<?php echo url_for('rapporttravaux/deleteTravail') ?>',
                data: 'id=' + id,
                success: function (data) {
                    suprimerTravail(id);
                }
            });
        }

    </script>
<?php else: ?>
    <script  type="text/javascript">

        setTotauxArticle();

        function ajouterArticle() {
            if ($("#article_id").val() != '' && ($("#mre").val() || $("#dps").val() || $("#maint").val() || $("#bat").val() || $("#dts").val())) {
                var id = parseInt($('#compteur_article').val());
                var total_article = Number($("#mre").val()) + Number($("#dps").val()) + Number($("#maint").val()) + Number($("#bat").val()) + Number($("#dts").val());

                var tr_html = '<tr id="tr_' + id + '">';
                tr_html = tr_html + '<td>' + $("#article_libelle").val() + '</td>';
                tr_html = tr_html + '<td style="text-align: center;"><input readonly="true" style="width:100%;text-align:right;" type="text" article="' + id + '" save="0" name="montant_mre" id="montant_mre_' + id + '" value="' + $("#mre").val() + '" /></td>';
                tr_html = tr_html + '<td style="text-align: center;"><input readonly="true" style="width:100%;text-align:right;" type="text" article="' + id + '" save="0" name="montant_dps" id="montant_dps_' + id + '" value="' + $("#dps").val() + '" /></td>';
                tr_html = tr_html + '<td style="text-align: center;"><input readonly="true" style="width:100%;text-align:right;" type="text" article="' + id + '" save="0" name="montant_maint" id="montant_maint_' + id + '" value="' + $("#maint").val() + '" /></td>';
                tr_html = tr_html + '<td style="text-align: center;"><input readonly="true" style="width:100%;text-align:right;" type="text" article="' + id + '" save="0" name="montant_bat" id="montant_bat_' + id + '" value="' + $("#bat").val() + '" /></td>';
                tr_html = tr_html + '<td style="text-align: center;"><input readonly="true" style="width:100%;text-align:right;" type="text" article="' + id + '" save="0" name="montant_dts" id="montant_dts_' + id + '" value="' + $("#dts").val() + '" /></td>';
                tr_html = tr_html + '<td style="text-align: center;"><input readonly="true" style="width:100%;text-align:right;" type="text" article="' + id + '" save="0" name="montant_article" id="montant_article_' + id + '" value="' + parseFloat(total_article).toFixed(3) + '" /></td>';
                tr_html = tr_html + '<td style="display: none;"><input type="hidden" save="0" name="id_article" article="' + id + '" value="' + $("#article_id").val() + '" /></td>';
                tr_html = tr_html + '<td style="text-align: center;vertical-align:middle;"><button class="btn btn-xs btn-danger" onclick="suprimerArticle(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
                tr_html = tr_html + '</tr>';
                $("#liste_article tbody").append(tr_html);

                id++;
                $('#compteur_article').val(id);
                $("#article_id").val('');
                $("#article_libelle").val('');
                $("#mre").val('');
                $("#dps").val('');
                $("#maint").val('');
                $("#bat").val('');
                $("#dts").val('');

                setTotauxArticle();
            } else {
                bootbox.dialog({
                    message: "Veuillez choisir l'article et/ou siaisir un montant !",
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                            }
                });
            }
        }

        function suprimerArticle(id) {
            $("#tr_" + id).remove();
            setTotauxArticle();
        }

        function setTotauxArticle() {
            var total_mre = 0;
            $('input[name="montant_mre"]').each(function () {
                total_mre = Number(total_mre) + Number($(this).val());
            });
            $("#total_mre").val(parseFloat(total_mre).toFixed(3));

            var total_dps = 0;
            $('input[name="montant_dps"]').each(function () {
                total_dps = Number(total_dps) + Number($(this).val());
            });
            $("#total_dps").val(parseFloat(total_dps).toFixed(3));

            var total_maint = 0;
            $('input[name="montant_maint"]').each(function () {
                total_maint = Number(total_maint) + Number($(this).val());
            });
            $("#total_maint").val(parseFloat(total_maint).toFixed(3));

            var total_bat = 0;
            $('input[name="montant_bat"]').each(function () {
                total_bat = Number(total_bat) + Number($(this).val());
            });
            $("#total_bat").val(parseFloat(total_bat).toFixed(3));

            var total_dts = 0;
            $('input[name="montant_dts"]').each(function () {
                total_dts = Number(total_dts) + Number($(this).val());
            });
            $("#total_dts").val(parseFloat(total_dts).toFixed(3));

            var total = 0;
            $('input[name="montant_article"]').each(function () {
                total = parseFloat(total) + parseFloat($(this).val());
            });
            $("#total_article").val(parseFloat(total).toFixed(3));
            $("#count_article").html($("#liste_article tbody tr").length + ' Articles ');
        }

        function enregister() {
            var ids = '';
            $('[name="id_article"]').each(function () {
                if ($(this).attr('save') == "0") {
                    ids = ids + $(this).val() + ',';
                }
            });

            var total_mre = '';
            $('input[name="montant_mre"]').each(function () {
                if ($(this).attr('save') == "0") {
                    total_mre = total_mre + $(this).val() + ';';
                }
            });

            var total_dps = '';
            $('input[name="montant_dps"]').each(function () {
                if ($(this).attr('save') == "0") {
                    total_dps = total_dps + $(this).val() + ';';
                }
            });

            var total_maint = '';
            $('input[name="montant_maint"]').each(function () {
                if ($(this).attr('save') == "0") {
                    total_maint = total_maint + $(this).val() + ';';
                }
            });

            var total_bat = '';
            $('input[name="montant_bat"]').each(function () {
                if ($(this).attr('save') == "0") {
                    total_bat = total_bat + $(this).val() + ';';
                }
            });

            var total_dts = '';
            $('input[name="montant_dts"]').each(function () {
                if ($(this).attr('save') == "0") {
                    total_dts = total_dts + $(this).val() + ';';
                }
            });

            var montants = '';
            $('[name="montant_article"]').each(function () {
                if ($(this).attr('save') == "0") {
                    montants = montants + $(this).val() + ';';
                }
            });

            $.ajax({
                url: '<?php echo url_for('rapporttravaux/enregistrerArticles') ?>',
                data: 'id=' + $("#rapport_id").val() +
                        '&total=' + $("#total_article").val() +
                        '&ids=' + ids +
                        '&total_mre=' + total_mre +
                        '&total_dps=' + total_dps +
                        '&total_maint=' + total_maint +
                        '&total_bat=' + total_bat +
                        '&total_dts=' + total_dts +
                        '&montants=' + montants,
                success: function (data) {
                    bootbox.dialog({
                        message: "Articles ajoutés avec succès !",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                    location.reload();
                }
            });
        }

        function suprimerBaseArticle(id) {
            $.ajax({
                url: '<?php echo url_for('rapporttravaux/supprimerArticle') ?>',
                data: 'id=' + $("#rapport_id").val() +
                        '&id_article=' + id,
                success: function (data) {
                    suprimerArticle(id);
                }
            });
        }

    </script>

    <script  type="text/javascript">
        var table = '';
        function closeListe() {
            $(".testul").remove();
        }
        function chargerArticle(id1, id2) {
            if ($(id1).val() != '') {
                $.ajax({
                    url: '<?php echo url_for('rapporttravaux/chargerArticle') ?>',
                    data: 'libelle=' + $(id1).val(), success: function (data) {
                        var data = JSON.parse(data);
                        $(".testul ul").css('width', $(id2).width());
                        htmlins = '';
                        table = data;
                        $(".testul").remove();
                        if (data.length > 0) {
                            htmlins = '<div class="testul">' +
                                    '<ul id="ul_compte" style="z-index: 9;">';
                            for (i = 0; i < data.length; i++) {
                                if (i == 0)
                                    htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
                                else
                                    htmlins += '<li data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
                            }
                            htmlins += '</ul></div>';
                        }
                        $(id1).after(htmlins);
                    }
                });
            } else {
                $(id2).val('');
            }
        }

        function clickSelectElement(value2, id1, id2) {
            var valeu1 = "";
            for (i = 0; i < table.length; i++) {
                if (value2 - table[i].id === 0) {
                    valeu1 = table[i].name;
                    break;
                }
            }
            if (id1)
                $(id1).val(valeu1);
            if (id2)
                $(id2).val(value2);
            $(".testul").remove();
        }

    </script>

    <style>

        .selected_li{
            background-color:#3875d7;background-image:-webkit-gradient(linear,50% 0,50% 100%,color-stop(20%,#3875d7),color-stop(90%,#2a62bc));background-image:-webkit-linear-gradient(#3875d7 20%,#2a62bc 90%);background-image:-moz-linear-gradient(#3875d7 20%,#2a62bc 90%);background-image:-o-linear-gradient(#3875d7 20%,#2a62bc 90%);background-image:linear-gradient(#3875d7 20%,#2a62bc 90%);color:#fff
        }

    </style>
<?php endif; ?>