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

                            <div class="col-lg-1"></div>
                            <div class="form-group" id="zone_choix_demandeur">
                                <div class="col-sm-12" id="zone_agent">
                                    <legend class="control-label no-padding-top">Liste des Agents </legend>
                                    <table style="margin-bottom: 20px;">
                                        <tr>
                                            <td style="width: 25%;">Choisir Agent </td>
                                            <td style="width: 75%;">
                                                <select id="test" onchange="getListeAgents()">
                                                    <option value="0" selected="true"></option>
                                                    <option value="1"><?php echo "Avec Congé" ?></option>
                                                    <option value="2"><?php echo "Sans Congé" ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>

                                    <div class="panel panel-default" id="listeagentssansconge" style="display: none">
                                        <?php $agents = AgentsTable::getInstance()->getAllByNomComplet(); ?>
                                        <select multiple="multiple" size="12" name="suivipresence[id_agent]" id="suivipresence_id_agent">
                                            <?php foreach ($agents as $a): ?>
                                                <option  value="<?php echo $a->getId(); ?>"><?php echo $a->getIdrh() . "    " . $a->getNomcomplet() . "  " . $a->getPrenom(); ?></option>
                                            <?php endforeach; ?>
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
                                                <td>
                                                    <select name="presence[mois]" id="presence_mois" onchange="IntitialiserGrille()" >
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
                                                <td>
                                                    <select name="presence[annee]" id="presence_annee" onchange="IntitialiserGrille()">
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

<?php //echo date("t"); // $lastDay = \DateTime::createFromFormat("Y-m-d", "2009-11-23")->format("Y-m-t");    ?>
<script>

    for (var i = 1; i <= 5; i++) {
        CalculTotal(i);
        CalculTotalHsup(i);
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
    function IntitialiserGrille() {
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
    function   getListeAgents() {

        if ($('#test').val() == 1)
        {
            $('#listeagentssansconge').hide();
            $('#listeagentsavecconge').show();
            $('.chosen-container').attr('style', 'width:100%');
            $('.chosen-container').trigger("chosen:updated");
        }
        else if ($('#test').val() == 2) {
            $('#listeagentssansconge').show();
            $('#listeagentsavecconge').hide();
        }
    }
</script>

<style>

    .bootstrap-duallistbox-container .info {
        font-size: 14px;
    }

</style>