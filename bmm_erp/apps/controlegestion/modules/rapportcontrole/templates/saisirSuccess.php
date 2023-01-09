<div id="sf_admin_container">
    <h1 id="replacediv"> Rapports Travaux des Chantiers 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Saisir les Articles</small>
    </h1>
</div>

<legend>Saisir les Articles</legend>
<input type="hidden" id="id_rapport" value="<?php echo $rapportcontrole->getId(); ?>">
<div class="row">
    <div class="col-sm-12">
        <span style="font-size: 18px;"><b>Nature :</b> <?php echo $rapportcontrole->getNaturetravaux()->getLibelle(); ?></span>
        <br>
        <span style="font-size: 18px;"><b>Service :</b> <?php echo $rapportcontrole->getServicecontrole()->getLibelle(); ?></span>
        <br>
        <span style="font-size: 16px;"><b>Chantier :</b> <?php echo $rapportcontrole->getChantiercontrole()->getLibelle(); ?></span>
        <br>
        <span style="font-size: 14px;"><b>Référence :</b> <?php echo $rapportcontrole->getChantiercontrole()->getReference(); ?></span>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <table>
            <tr>
                <td style="width:5%;text-align:center;vertical-align:middle;">
                    <input type="text" class="align-center" value="<?php echo $rapportcontrole->getLignerapportcontrole()->count() + 1 ?>" id="numero" readonly="true">
                </td>
                <?php if ($rapportcontrole->getIdNaturetravaux() == 1 || $rapportcontrole->getIdServicecontrole() == 2 || $rapportcontrole->getIdServicecontrole() == 4): ?>
                    <td style="width:35%;">
                        <input type="text" id="designation">
                    </td>
                    <td style="width:16%;">
                        <input type="text" class="align-center" id="unite">
                    </td>
                    <td style="width:11%;">
                        <input type="text" class="align-center" id="quantite" onkeyup="calculerPrixTotal()">
                    </td>
                <?php elseif ($rapportcontrole->getIdNaturetravaux() == 2): ?>
                    <td style="width:51%;">
                        <input type="text" id="designation">
                    </td>
                    <td style="width:11%;">
                        <input type="text" class="align-center" id="quantite">
                    </td>
                <?php endif; ?>

                <?php if ($rapportcontrole->getIdNaturetravaux() == 1 || $rapportcontrole->getIdServicecontrole() == 2 || $rapportcontrole->getIdServicecontrole() == 4): ?>
                    <td style="width:11%;">
                        <input type="text" class="align_right" id="prix_unitaire" onkeyup="calculerPrixTotal()">
                    </td>
                    <td style="width:11%;">
                        <input type="text" class="align_right" id="prix_total" readonly="true">
                    </td>
                <?php elseif ($rapportcontrole->getIdNaturetravaux() == 2): ?>
                    <td style="width:22%;">
                        <input type="text" id="observation">
                    </td>
                <?php endif; ?>
                <td style="width:11%;text-align:center;">
                    <button onclick="ajouterArticle()" class="btn btn-white btn-primary"> <i class="ace-icon fa fa-arrow-down"></i> Ajouter</button>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <table id="liste_articles">
            <thead>
                <tr>
                    <th style="width:5%;text-align:center;">#</th>
                    <?php if ($rapportcontrole->getIdNaturetravaux() == 1 || $rapportcontrole->getIdServicecontrole() == 2 || $rapportcontrole->getIdServicecontrole() == 4): ?>
                        <th style="width:35%;height:25px;text-align:center;"><b>Désignation</b></th>
                        <th style="width:16%;text-align:center;"><b>Unité</b></th>
                    <?php elseif ($rapportcontrole->getIdNaturetravaux() == 2): ?>
                        <th style="width:51%;height:25px;text-align:center;"><b>Désignation</b></th>
                    <?php endif; ?>
                    <th style="width:11%;text-align:center;"><b>Quantité</b></th>
                    <?php if ($rapportcontrole->getIdNaturetravaux() == 1 || $rapportcontrole->getIdServicecontrole() == 2 || $rapportcontrole->getIdServicecontrole() == 4): ?>
                        <th style="width:11%;text-align:center;"><b>P.U (DT)</b></th>
                        <th style="width:11%;text-align:center;"><b>P.R (DT)</b></th>
                    <?php elseif ($rapportcontrole->getIdNaturetravaux() == 2): ?>
                        <th style="width:22%;text-align:center;"><b>Observation</b></th>
                    <?php endif; ?>
                    <th style="width:11%;text-align:center;">Opération</th>
                </tr>
            </thead>
            <tbody>
                <?php $compteur = 0; ?>
                <?php $total = 0; ?>
                <?php foreach ($rapportcontrole->getLignerapportcontrole() as $ligne): ?>
                    <tr id="tr_<?php echo $ligne->getId(); ?>">
                        <td name="numero" style="text-align: center;"><?php echo $ligne->getNumero(); ?></td>
                        <td name="designation"><?php echo $ligne->getDesignation(); ?></td>
                        <?php if ($rapportcontrole->getIdNaturetravaux() == 1 || $rapportcontrole->getIdServicecontrole() == 2 || $rapportcontrole->getIdServicecontrole() == 4): ?>
                            <td name="unite" style="text-align:center;"><?php echo $ligne->getUnite(); ?></td>
                        <?php endif; ?>
                        <td name="quantite" style="text-align:center;"><?php echo $ligne->getQuantite(); ?></td>
                        <?php if ($rapportcontrole->getIdNaturetravaux() == 1 || $rapportcontrole->getIdServicecontrole() == 2 || $rapportcontrole->getIdServicecontrole() == 4): ?>
                            <td name="prix_unitaire" style="text-align:right;"><?php echo $ligne->getPrixunitaire(); ?></td>
                            <td name="prix_total" style="text-align:right;"><?php echo $ligne->getPrixtotal(); ?></td>
                        <?php elseif ($rapportcontrole->getIdNaturetravaux() == 2): ?>
                            <td name="observation"><?php echo $ligne->getObservation(); ?></td>
                        <?php endif; ?>
                        <td style="text-align:center;vertical-align:middle;">
                            <button class="btn btn-xs btn-danger" onclick="suprimerArticle('<?php echo $ligne->getId(); ?>')">
                                <i class="ace-icon fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php $compteur = $ligne->getId(); ?>
                    <?php $total = $total + $ligne->getPrixtotal(); ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if ($rapportcontrole->getIdNaturetravaux() == 1 || $rapportcontrole->getIdServicecontrole() == 2 || $rapportcontrole->getIdServicecontrole() == 4): ?>
            <table>
                <tr style="background-color: #F0F0F0;">
                    <td style="width:67%;"></td>
                    <td style="width:11%;text-align:right;">Total </td>
                    <td style="width:11%;text-align:right;" id="total"><?php echo number_format($total, 3, '.', ' '); ?></td>
                    <td style="width:11%;"></td>
                </tr>
            </table>
        <?php elseif ($rapportcontrole->getIdNaturetravaux() == 2): ?>
        <?php endif; ?>
    </div>
    <div class="col-sm-12" style="text-align: right; margin-top: 20px;">
        <button class="btn btn-white btn-primary" onclick="enregister()">
            <i class="ace-icon fa fa-save"></i> Enregistrer
        </button>
        <a class="btn btn-white btn-success" href="<?php echo url_for('@rapportcontrole'); ?>">
            <i class="ace-icon fa fa-undo"></i> Retour à la Liste
        </a>
    </div>
</div>

<input type="hidden" id="compteur_article" value="<?php echo $compteur; ?>">

<?php if ($rapportcontrole->getIdNaturetravaux() == 1 || $rapportcontrole->getIdServicecontrole() == 2 || $rapportcontrole->getIdServicecontrole() == 4): ?>
    <script>

        function calculerPrixTotal() {
            if ($("#quantite").val() != '' && $("#prix_unitaire").val() != '') {
                var total = parseFloat($('#quantite').val()) * parseFloat($('#prix_unitaire').val());
                $("#prix_total").val(parseFloat(total).toFixed(3));
            } else {
                $("#prix_total").val('');
            }
        }

        function ajouterArticle() {
            if ($("#designation").val() != '' && $("#unite").val() != '' && $("#quantite").val() != '') {
                var id = parseInt($('#compteur_article').val());
                var numero = parseInt($('#numero').val());
                var tr_html = '<tr id="tr_' + id + '">';
                tr_html = tr_html + '<td name="numero" style="text-align: center;">' + $("#numero").val() + '</td>';
                tr_html = tr_html + '<td name="designation">' + $("#designation").val() + '</td>';
                tr_html = tr_html + '<td name="unite" style="text-align:center;">' + $("#unite").val() + '</td>';
                tr_html = tr_html + '<td name="quantite" style="text-align:center;">' + $("#quantite").val() + '</td>';
                tr_html = tr_html + '<td name="prix_unitaire" style="text-align:right;">' + $("#prix_unitaire").val() + '</td>';
                tr_html = tr_html + '<td name="prix_total" style="text-align:right;">' + $("#prix_total").val() + '</td>';
                tr_html = tr_html + '<td style="text-align:center;vertical-align:middle;"><button class="btn btn-xs btn-danger" onclick="suprimerArticle(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
                tr_html = tr_html + '</tr>';
                $("#liste_articles tbody").append(tr_html);
                id++;
                numero++;
                $('#compteur_article').val(id);
                $("#numero").val(numero);
                $("#designation").val('');
                $("#unite").val('');
                $("#quantite").val('');
                $("#prix_unitaire").val('');
                $("#prix_total").val('');

                setTotalArticle();
            } else {
                bootbox.dialog({
                    message: "Veuillez saisir la désignation, l'unité et/ou la quantité !",
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
            setNumeroArticle();
            setTotalArticle();
        }

        function setTotalArticle() {
            var total = 0;
            $('td[name="prix_total"]').each(function () {
                if ($(this).html() != '')
                    total = parseFloat(total) + parseFloat($(this).html());
            });

            $("#total").html(parseFloat(total).toFixed(3));
        }

        function setNumeroArticle() {
            var numero = 1;
            $('td[name="numero"]').each(function () {
                $(this).html(numero);
                numero++;
            });
            $("#numero").val(numero);
        }

        function enregister() {
            var numero = '';
            $('[name="numero"]').each(function () {
                numero = numero + $(this).html() + ',';
            });

            var designation = '';
            $('[name="designation"]').each(function () {
                designation = designation + $(this).html() + ',**,';
            });

            var unite = '';
            $('[name="unite"]').each(function () {
                unite = unite + $(this).html() + ',**,';
            });

            var quantite = '';
            $('[name="quantite"]').each(function () {
                quantite = quantite + $(this).html() + ';*;';
            });

            var prix_unitaire = '';
            $('[name="prix_unitaire"]').each(function () {
                prix_unitaire = prix_unitaire + $(this).html() + ';';
            });

            var prix_total = '';
            $('[name="prix_total"]').each(function () {
                prix_total = prix_total + $(this).html() + ';';
            });

            $.ajax({
                url: '<?php echo url_for('rapportcontrole/enregistrer') ?>',
                data: 'id=' + $("#id_rapport").val() +
                        '&total=' + $("#total").html() +
                        '&numero=' + numero +
                        '&designation=' + designation +
                        '&unite=' + unite +
                        '&quantite=' + quantite +
                        '&prix_unitaire=' + prix_unitaire +
                        '&prix_total=' + prix_total,
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

    </script>
<?php elseif ($rapportcontrole->getIdNaturetravaux() == 2): ?>
    <script>

        function ajouterArticle() {
            if ($("#designation").val() != '' && $("#quantite").val() != '') {
                var id = parseInt($('#compteur_article').val());
                var numero = parseInt($('#numero').val());
                var tr_html = '<tr id="tr_' + id + '">';
                tr_html = tr_html + '<td name="numero" style="text-align: center;">' + $("#numero").val() + '</td>';
                tr_html = tr_html + '<td name="designation">' + $("#designation").val() + '</td>';
                tr_html = tr_html + '<td name="quantite" style="text-align:center;">' + $("#quantite").val() + '</td>';
                tr_html = tr_html + '<td name="observation">' + $("#observation").val() + '</td>';
                tr_html = tr_html + '<td style="text-align:center;vertical-align:middle;"><button class="btn btn-xs btn-danger" onclick="suprimerArticle(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
                tr_html = tr_html + '</tr>';
                $("#liste_articles tbody").append(tr_html);
                id++;
                numero++;
                $('#compteur_article').val(id);
                $("#numero").val(numero);
                $("#designation").val('');
                $("#quantite").val('');
                $("#observation").val('');
            } else {
                bootbox.dialog({
                    message: "Veuillez saisir la désignation, l'unité et/ou la quantité !",
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
            setNumeroArticle();
        }

        function setNumeroArticle() {
            var numero = 1;
            $('td[name="numero"]').each(function () {
                $(this).html(numero);
                numero++;
            });
            $("#numero").val(numero);
        }

        function enregister() {
            var numero = '';
            $('[name="numero"]').each(function () {
                numero = numero + $(this).html() + ',';
            });

            var designation = '';
            $('[name="designation"]').each(function () {
                designation = designation + $(this).html() + ',**,';
            });

            var quantite = '';
            $('[name="quantite"]').each(function () {
                quantite = quantite + $(this).html() + ';*;';
            });

            var observation = '';
            $('[name="observation"]').each(function () {
                observation = observation + $(this).html() + ';*;';
            });

            $.ajax({
                url: '<?php echo url_for('rapportcontrole/enregistrer') ?>',
                data: 'id=' + $("#id_rapport").val() +
                        '&numero=' + numero +
                        '&designation=' + designation +
                        '&quantite=' + quantite +
                        '&observation=' + observation,
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

    </script>
<?php endif; ?>