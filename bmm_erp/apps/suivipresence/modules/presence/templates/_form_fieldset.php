<div class="row" >
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Fiche Présence</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="min-height: 200px;">
                    <form>
                        <fieldset id="sf_fieldset_none">

                            <div id="right-menu" class="modal aside" data-body-scroll="false" data-offset="true" data-placement="right" data-fixed="true" data-backdrop="false" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header no-padding">
                                            <div class="table-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                    <span class="white">&times;</span>
                                                </button>
                                                Régime de Travail
                                            </div>
                                        </div>

                                        <div class="modal-body">
                                            <fieldset>
                                                <table style="width: 100%">
                                                    <tbody>
                                                        <tr>
                                                            <td><input type="hidden" id="nbr">
                                                                <label>R.Horaire </label>
                                                                <select id="regime" onchange="affichenbrheur()" ><!--ng-model="regime"  ng-change="affichenbrheur()"-->
                                                                    <option></option>
                                                                    <?php $regime = RegimehoraireTable::getInstance()->findAll(); ?>
                                                                    <?php foreach ($regime as $m): ?>
                                                                        <option  value="<?php echo $m->getId(); ?>"><?php echo $m->getLibelle(); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 40%">
                                                                <select  id="mois" >
                                                                    <option <?php if (date('m') == '1'): ?>selected="true"<?php endif; ?> value="01">Janvier</option>
                                                                    <option <?php if (date('m') == '2'): ?>selected="true"<?php endif; ?> value="02">Février</option>
                                                                    <option <?php if (date('m') == '3'): ?>selected="true"<?php endif; ?> value="03">Mars</option>
                                                                    <option <?php if (date('m') == '4'): ?>selected="true"<?php endif; ?> value="04">Avril</option>
                                                                    <option <?php if (date('m') == '5'): ?>selected="true"<?php endif; ?> value="05">Mai</option>
                                                                    <option <?php if (date('m') == '6'): ?>selected="true"<?php endif; ?> value="06">juin</option>
                                                                    <option <?php if (date('m') == '7'): ?>selected="true"<?php endif; ?> value="07">Juillet</option>
                                                                    <option <?php if (date('m') == '8'): ?>selected="true"<?php endif; ?> value="08">Août</option>
                                                                    <option <?php if (date('m') == '9'): ?>selected="true"<?php endif; ?> value="09">Septembre</option>
                                                                    <option <?php if (date('m') == '10'): ?>selected="true"<?php endif; ?> value="10">Octobre</option>
                                                                    <option <?php if (date('m') == '11'): ?>selected="true"<?php endif; ?> value="11">Nouvembre</option>
                                                                    <option <?php if (date('m') == '12'): ?>selected="true"<?php endif; ?> value="12">Décembre</option>
                                                                </select>
                                                            </td>
                                                            <td style="width: 60%">
                                                                <select  id="annee_grille">
                                                                    <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                                                        <option <?php if ($i == date('Y')): ?>selected="true"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                    <?php endfor; ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div id="clendrier_zone"></div>
                                                <table> 
                                                    <tbody>
                                                        <tr>
                                                    <label>Nbr.Heures Travail/Jour</label>
                                                    <?php for ($i = 1; $i <= 7; $i++): ?>

                                                        <td id="nbrheur_<?php echo $i; ?>">
        <!--                                                            <input class="grille_regime_input" type="text" name="jour_heure" id="nbrheur_<?php echo $i; ?>" style="height: 20px;width: 20px">-->
                                                            <input type="hidden" value="<?php echo $i ?>" name="jour">
                                                        </td>
                                                    <?php endfor; ?>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                    <label>Jours Repos</label>

                                                    <?php for ($i = 1; $i <= 7; $i++): ?>
                                                        <td style="text-align: center;width: 10%;">
                                                            <input class="grille_regime_input" type="checkbox" name="jourr" id="jr_<?php echo $i; ?>" onchange="testerJourR('<?php echo $i; ?>')"/>
                                                        </td>
                                                    <?php endfor; ?>
                                                    </tr>
                                                    </tbody>
                                                </table>
<!--                                                    <table>
                                                    <tr>-->
                                                <table>
                                                    <tr>
                                                        <td><label>Nb.Jour Travail/Mois</label>
                                                            <input class="grille_regime_input" type="text" id="jour_travail" readonly="true">
                                                        </td>
                                                        <td>
                                                            <label>Nb.Heure Travail/Mois</label>
                                                            <input class="grille_regime_input" type="text" id="heure_travail" readonly="true" >
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label style="color: #FFA500">Nb.Jour Férié/Mois</label>
                                                            <input class="grille_regime_input" type="text" id="jour_ferier"  readonly="true">
                                                        </td>
                                                        <td>
                                                            <label>Nb.Heure Férié/Mois</label>
                                                            <input class="grille_regime_input" type="text" id="heure_ferie" readonly="true">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label>Nb.Jours Moyen Travail/Mois</label>
                                                            <input class="grille_regime_input" type="text" id="jour_moyen" readonly="true">
                                                        </td>
                                                        <td>
                                                            <label>Nb.Heures Moyen Travail/Mois</label>
                                                            <input class="grille_regime_input" type="text" id="heure_moyen" readonly="true">
                                                        </td>
                                                    </tr>
                                                </table>
                                                <br>
                                            </fieldset>
                                        </div>
                                    </div><!-- /.modal-content -->

                                    <button class="aside-trigger btn btn-info btn-app btn-xs ace-settings-btn" data-target="#right-menu" data-toggle="modal" type="button"
                                            onclick="initialiserselect()">
                                        <i data-icon1="fa-plus" data-icon2="fa-minus" class="ace-icon fa fa-plus bigger-110 icon-only"></i>
                                    </button>
                                </div><!-- /.modal-dialog -->
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="form-group" id="zone_choix_demandeur">
                                <div class="col-sm-12" id="zone_agent">
                                    <legend class="control-label no-padding-top">Liste des Agents </legend>
                                    <table style="margin-bottom: 20px;">
                                        <tr>
                                            <td style="width: 25%;">Choisir Agent </td>
                                            <td style="width: 75%;">
                                                <select id="test" onchange="getRegime()">
                                                    <option value="0" selected="true"></option>
                                                    <option value="1"><?php echo "Avec Congé" ?></option>
                                                    <option value="2"><?php echo "Sans Congé" ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="panel panel-default" id="regimehoraires" style="display: none">
                                        <table>
                                            <tr>
                                                <td><label>Régime Horaire </label></td>
                                                <td>
                                                    <?php echo $form['id_regimehoraire']->renderError() ?>
                                                    <?php echo $form['id_regimehoraire'] ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="panel panel-default" id="listeagentssansconge" style="display: none">
                                        <select multiple="multiple" size="12" name="suivipresence[id_agent]" id="suivipresence_id_agent">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <?php $annee = date("Y"); ?>
                                    <div class="panel panel-default" id="listeagentsavecconge" style="display: none" >
                                        <?php $agents_avecconge = AgentsTable::getInstance()->getAllByNomCompletAvecConge($annee); ?>
                                        <table>
                                            <tr>
                                                <td  style="width: 25%;">Liste des agents</td>
                                                <td style="width: 75%;">
                                                    <select id="suivipresence_avecconge_id_agent">
                                                        <option value="0" selected="true"></option>
                                                        <?php foreach ($agents_avecconge as $ag): ?>
                                                            <option  value="<?php echo $ag->getId(); ?>"><?php echo $ag->getIdrh() . "    " . $ag->getNomcomplet() . "  " . $ag->getPrenom(); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <input type="hidden" id="id_regime">
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <thead>
                                                <tr style="background-color: #D3D3D3">
                                                    <th>Date Début</th>
                                                    <th>Date Fin</th>
                                                    <th>Type Congé</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="ligneconge in listesConge" ng-style="{
                                                            background: '#c6abbb'
                                                        }">
                                                    <td>{{ligneconge.datedebut}}</td>
                                                    <td>{{ligneconge.datefin}}</td>
                                                    <td style="display: none">{{ligneconge.idtype}}</td>
                                                    <td>{{ligneconge.typeconge}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="hr hr-16 hr-dotted"></div>
                                </div>

                                <fieldset class="col-lg-6">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="width: 30%">
                                                    <select name="presence[mois]" id="presence_mois" onchange="IntitialiserGrillePresence()" >
                                                        <option <?php if (date('m') == '1'): ?>selected="true"<?php endif; ?> value="01">Janvier</option>
                                                        <option <?php if (date('m') == '2'): ?>selected="true"<?php endif; ?> value="02">Février</option>
                                                        <option <?php if (date('m') == '3'): ?>selected="true"<?php endif; ?> value="03">Mars</option>
                                                        <option <?php if (date('m') == '4'): ?>selected="true"<?php endif; ?> value="04">Avril</option>
                                                        <option <?php if (date('m') == '5'): ?>selected="true"<?php endif; ?> value="05">Mai</option>
                                                        <option <?php if (date('m') == '6'): ?>selected="true"<?php endif; ?> value="06">juin</option>
                                                        <option <?php if (date('m') == '7'): ?>selected="true"<?php endif; ?> value="07">Juillet</option>
                                                        <option <?php if (date('m') == '8'): ?>selected="true"<?php endif; ?> value="08">Août</option>
                                                        <option <?php if (date('m') == '9'): ?>selected="true"<?php endif; ?> value="09">Septembre</option>
                                                        <option <?php if (date('m') == '10'): ?>selected="true"<?php endif; ?> value="10">Octobre</option>
                                                        <option <?php if (date('m') == '11'): ?>selected="true"<?php endif; ?> value="11">Nouvembre</option>
                                                        <option <?php if (date('m') == '12'): ?>selected="true"<?php endif; ?> value="12">Décembre</option>
                                                    </select>
                                                </td>
                                                <td style="width: 20%">
                                                    <select name="presence[annee]" id="presence_annee" onchange="IntitialiserGrillePresence()">
                                                        <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                                            <option <?php if ($i == date('Y')): ?>selected="true"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                                <fieldset class="col-lg-6">
                                    <table id="magJourF">
                                        <thead>
                                            <tr style="background-color: #D3D3D3">
                                                <th style="width: 40%"><label>Jour Férier</label></th>
                                                <th style="width: 40%"><label>Date.J.F</label></th>
                                                <th style="width: 10%"><label>Payé/Non</label></th>
                                                <th style="width: 10%"><label>Périodique/Non</label></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="ligne in listesJourFerier" ng-style="{
                                                        background: doc_classes_colors[$index % doc_classes_colors.length]
                                                    }">
                                                <td>{{ligne.jourf}}</td>
                                                <td>{{ligne.date}}</td>
                                                <td style="text-align: center">
                                                    <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="ligne.paye"></i>
                                                    <i class="ace-icon fa fa-square-o bigger-170" ng-if="ligne.paye == false"></i>
                                                </td>
                                                <td style="text-align: center">
                                                    <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="ligne.periodique"></i>
                                                    <i class="ace-icon fa fa-square-o bigger-170" ng-if="ligne.periodique == false"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </fieldset>
                            </div>
                        </fieldset>
                    </form>

                    <!--********************************************************-->
                    <fieldset id="presence_grille">

                    </fieldset>
                    <!--********************************************************-->

                </div>
                <div class="form-actions center" style="margin-bottom: 0px; margin-top: 0px;">
                    <a href="<?php echo url_for('@presence') ?>" class="btn btn-white btn-success">Retour à la liste</a>
                    <button id="save_button" type="button" class="btn btn-sm btn-success" ng-click="AjouterEmploye()">
                        Enregistrer
                        <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                    </button>
                    <a id="print_button" style="display: none;" target="_blank" href="" type="button" class="btn btn-sm btn-primary">
                        Imprimer
                        <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id='data_regime'></div>
<?php //echo date("t"); // $lastDay = \DateTime::createFromFormat("Y-m-d", "2009-11-23")->format("Y-m-t");    ?>
<script>

    for (var i = 1; i <= 5; i++) {
        CalculTotal(i);
        CalculTotalHsup(i);
    }

    function initialiserselect() {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
    }

    //nbre heure du regime horaire 
    function affichenbrheur() {
        if ($('#regime').val() != "")
        {
            $.ajax({
                url: '<?php echo url_for('presence/afficheDetailRegime') ?>',
                data: 'id=' + $('#regime').val() + '&annee=' + $('#annee_grille').val() + '&mois=' + $('#mois').val(),
                success: function (data) {
                    $('#data_regime').html(data)
                }
            });
        }
        else {

            $('#jour_travail').val("");
            $('#heure_travail').val("");
            $('#jour_ferier').val("");
            $('#heure_ferie').val("");
            $('#jour_moyen').val("");
            $('#heure_moyen').val("");
            for (var i = 1; i <= 7; i++)
            {
                $('#nbrheur_' + i).html('');
                $('#jr_' + i).removeAttr('checked');
            }

        }
    }
    function CalculTotal(i) {
        var total = 0;
        var type_input = "heure_" + i;
        $('[type_input="' + type_input + '"]').each(function () {
            if ($(this).val() != '') {
                var value = $(this).val();
            } else {
                var value = 0;
            }
            total = parseInt(total) + parseInt(value);
        });
        $('#total_heure_' + i).val(parseInt(total));
        calcultotalhmois();
    }
    function CalculTotalHsup(i) {
        var total = 0;
        var type_input = "supp_" + i;
        $('[type_input="' + type_input + '"]').each(function () {
            if ($(this).val() != '') {
                var value = $(this).val();
            } else {
                var value = 0;
            }
            total = parseInt(total) + parseInt(value);
        });
        $('#total_sup_' + i).val(parseInt(total));
        calcultotalheuresuppmois();
    }
    function calcultotalhmois() {
        var tot = 0;
        for (var j = 1; j <= 5; j++)
        {
            var nbrh = $("#total_heure_" + j).val();
            tot = parseFloat(tot) + parseFloat(nbrh);
        }
        $('#total_heure_normal').val(tot);
    }
    function calcultotalheuresuppmois() {
        var tot = 0;
        for (var j = 1; j <= 5; j++)
        {
            if ($("#total_sup_" + j).val() != "")
            {
                var nbrh = $("#total_sup_" + j).val();
            }
            else
                nbrh = 0;
            tot = parseFloat(tot) + parseFloat(nbrh);
        }
        $('#total_heure_supp').val(tot);
    }
    function IntitialiserGrillePresence() {
        if ($('#presence_mois').val() != '' && $('#presence_annee').val() != '') {
            $.ajax({
                url: '<?php echo url_for('presence/affichegrille') ?>',
                data: 'idpresence_mois=' + $('#presence_mois').val() + '&idpresence_annee=' + $('#presence_annee').val(),
                success: function (data) {
                    $('#presence_grille').html(data);
                }
            });
        }
    }
    function getListeAgents() {
        if ($('#test').val() == 1)
        {
            $('#listeagentssansconge').hide();
            $('#listeagentsavecconge').show();
            $('#regimehoraires').show();
            $('#regimehoraires').addClass("disabledbutton");
            $('.chosen-container').attr('style', 'width:100%');
            $('.chosen-container').trigger("chosen:updated");
        }
        else if ($('#test').val() == 2) {
            $('#listeagentssansconge').show();
            $('#regimehoraireavecconge').hide();
            $('#regimehoraires').show();
            $('#regimehoraires').removeClass("disabledbutton");
            $('#listeagentsavecconge').hide();
            $('.chosen-container').attr('style', 'width:100%');
            $('.chosen-container').trigger("chosen:updated");
        }
    }

    function getRegime() {
        if ($('#test').val() == 1) {
            $('#listeagentssansconge').hide();
            $('#listeagentsavecconge').show();
            $('#regimehoraires').show();
            $('#regimehoraires').addClass("disabledbutton");
            $('.chosen-container').attr('style', 'width:100%');
            $('.chosen-container').trigger("chosen:updated");
            $('#presence_id_regimehoraire').val('');
            $('#presence_id_regimehoraire').trigger("chosen:updated");
        }
        else if ($('#test').val() == 2) {
            $('#listeagentssansconge').show();
            $('#regimehoraireavecconge').hide();
            $('#regimehoraires').show();
            $('#regimehoraires').removeClass("disabledbutton");
            $('#listeagentsavecconge').hide();
            $('.chosen-container').attr('style', 'width:100%');
            $('.chosen-container').trigger("chosen:updated");
            $('#presence_id_regimehoraire').val('');
            $('#presence_id_regimehoraire').trigger("chosen:updated");
        }
        else {
            $('#presence_id_regimehoraire').val('');
            $('#presence_id_regimehoraire').trigger("chosen:updated");
            $('#suivipresence_avecconge_id_agent').val('');
            $('#suivipresence_avecconge_id_agent').trigger("chosen:updated");
            $('[name="semaine_heure"]').each(function () {
                $(this).val('');
            });
            $('[name="heur_supp"]').each(function () {
                $(this).val('');
            });

            $('#suivipresence_id_agent').val('');
            $('#suivipresence_id_agent').trigger("chosen:updated");

        }
    }
</script>
<script type="text/javascript">

    var html_clendrier = '';
    var d = new Date();
    var dm = d.getMonth() + 1;
    var dan = d.getYear();
    if (dan < 999)
        dan += 1900;
    $('#clendrier_zone').html(calendrier(dm, dan));
    function calendrier(mois, an) {
        nom_mois = new Array
                ("Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet",
                        "Ao&ucirc;t", "Septembre", "Octobre", "Novembre", "D&eacute;cembre");
        jour = new Array("Lu", "Ma", "Me", "Je", "Ve", "Sa", "Di");
        var police_entete = "Verdana,Arial"; /* police entête de calendrier  */
        var taille_pol_entete = 3; /* taille de police 1-7 entête de calendrier  */
        var couleur_pol_entete = "#FFFF00"; /* couleur de police entête de calendrier  */
        var arrplan_entete = "#000066"; /* couleur d'arrière plan entête de calendrier  */
        var police_jours = "Verdana,Arial"; /* police affichage des jours  */
        var taille_pol_jours = 3; /* taille de police 1-7 affichage des jours  */
        var coul_pol_jours = "#000000"; /* couleur de police affichage des jours  */
        var arrplan_jours = "#D0F0F0"; /* couleur d'arrière plan affichage des jours  */
        var couleur_dim = "red"; /* couleur de police pour dimanches  */
        var couleur_cejour = "#FFFF00"; /* couleur d'arrière plan pour aujourd'hui  */

        var maintenant = new Date();
        var ce_mois = maintenant.getMonth() + 1;
        var cette_annee = maintenant.getYear();
        if (cette_annee < 999)
            cette_annee += 1900;
        var ce_jour = maintenant.getDate();
        var temps = new Date(an, mois - 1, 1);
        var Start = temps.getDay();
        if (Start > 0)
            Start--;
        else
            Start = 6;
        var Stop = 31;
        if (mois == 4 || mois == 6 || mois == 9 || mois == 11)
            --Stop;
        if (mois == 2) {
            Stop = Stop - 3;
            if (an % 4 == 0)
                Stop++;
            if (an % 100 == 0)
                Stop--;
            if (an % 400 == 0)
                Stop++;
        }
//        document.write('<table border="3" cellpadding="1" cellspacing="1">');
        html_clendrier = '<table id="calendrier_table"   border="3" cellpadding="1" cellspacing="1">';
        var entete_mois = nom_mois[mois - 1] + " " + an;
        html_clendrier = html_clendrier + inscrit_entete(entete_mois, arrplan_entete, couleur_pol_entete, taille_pol_entete, police_entete);
        var nombre_jours = 1;
        for (var i = 0; i <= 5; i++) {
//            document.write("<tr>");
            html_clendrier = html_clendrier + "<tr>";
            for (var j = 0; j <= 5; j++) {
                if ((i == 0) && (j < Start))
                    html_clendrier = html_clendrier + inscrit_cellule("&#160;", arrplan_jours, coul_pol_jours, taille_pol_jours, police_jours);
                else {
                    if (nombre_jours > Stop)
                        html_clendrier = html_clendrier + inscrit_cellule("&#160;", arrplan_jours, coul_pol_jours, taille_pol_jours, police_jours);
                    else {
                        if ((an == cette_annee) && (mois == ce_mois) && (nombre_jours == ce_jour))
                            html_clendrier = html_clendrier + inscrit_cellule(nombre_jours, couleur_cejour, coul_pol_jours, taille_pol_jours, police_jours);
                        else
                            html_clendrier = html_clendrier + inscrit_cellule(nombre_jours, arrplan_jours, coul_pol_jours, taille_pol_jours, police_jours);
                        nombre_jours++;
                    }
                }
            }
            if (nombre_jours > Stop)
                html_clendrier = html_clendrier + inscrit_cellule("&#160;", arrplan_jours, couleur_dim, taille_pol_jours, police_jours);
            else {
                if ((an == cette_annee) && (mois == ce_mois) && (nombre_jours == ce_jour))
                    html_clendrier = html_clendrier + inscrit_cellule(nombre_jours, couleur_cejour, couleur_dim, taille_pol_jours, police_jours);
                else
                    html_clendrier = html_clendrier + inscrit_cellule(nombre_jours, arrplan_jours, couleur_dim, taille_pol_jours, police_jours);
                nombre_jours++;
            }
//            document.write("<\/tr>");
            html_clendrier = html_clendrier + "<\/tr>";
        }
//        document.write("<\/table>");
        html_clendrier = html_clendrier + "<\/table>";
        return html_clendrier;
    }

    function inscrit_entete(titre_mois, couleurAP, couleurpolice, taillepolice, police) {
        var html_entete = "";
//        document.write("<tr>");
        html_entete = "<tr>";
//        document.write('<td align="center" colspan="7" valign="middle" bgcolor="' + couleurAP + '">');
//        document.write('<font size="' + taillepolice + '" color="' + couleurpolice + '" face="' + police + '"><b>');
        html_entete = html_entete + '<td style="padding: 3px" align="center" colspan="7" valign="middle" bgcolor="' + couleurAP + '">'
                + '<font size="' + taillepolice + '" color="' + couleurpolice + '" face="' + police + '"><b>';
        html_entete = html_entete + titre_mois;
        html_entete = html_entete + "<\/b><\/font><\/td><\/tr>" + "<tr>";
//        document.write(titre_mois);
//        document.write("<\/b><\/font><\/td><\/tr>");
//        document.write("<tr>");
        for (var i = 0; i <= 6; i++)
            html_entete = html_entete + inscrit_cellule(jour[i], couleurAP, couleurpolice, taillepolice, police);
//        document.write("<\/tr>");
        html_entete = html_entete + "<\/tr>";
        return html_entete;
    }

    function inscrit_cellule(contenu, couleurAP, couleurpolice, taillepolice, police) {
        var html_cellule = "";
        html_cellule = '<td id="m_' + contenu + '" style="padding: 3px" align="center" valign="middle" bgcolor="' + couleurAP + '">';
        html_cellule = html_cellule + '<font size="' + taillepolice + '" color="' + couleurpolice + '" face="' + police + '"><b>';
        html_cellule = html_cellule + contenu;
        html_cellule = html_cellule + "<\/b><\/font><\/td>";
//        document.write('<td align="center" valign="middle" bgcolor="' + couleurAP + '">');
//        document.write('<font size="' + taillepolice + '" color="' + couleurpolice + '" face="' + police + '"><b>');
//        document.write(contenu);
//        document.write("<\/b><\/font><\/td>");
        return html_cellule;
    }

</script>

<script type="text/javascript">
    jQuery(function ($) {
        $('.modal.aside').ace_aside();
        $(document).one('ajaxloadstart.page', function (e) {
            //in ajax mode, remove before leaving page
            $('.modal.aside').remove();
            $(window).off('.aside')
        });
    })
</script>

<style>

    .bootstrap-duallistbox-container .info {
        font-size: 14px;
    }

</style>