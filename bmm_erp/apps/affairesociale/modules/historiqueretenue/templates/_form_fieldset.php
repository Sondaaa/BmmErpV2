<div class="row"> 
    <div class="col-xs-12">
        <div class="widget-box" ng-init="intialisermoisannee()">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller"> </h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="min-height: 200px;" >
                    <fieldset>
                        <table>
                            <tr>
                                <td>Retenue Pour </td>
                                <td>
                                    <?php echo $form['typeextraction']->renderError() ?>
                                    <?php echo $form['typeextraction'] ?>
                                </td>
                        </table>
                    </fieldset>

                    <fieldset>
                        <table>
                            <tr>
                                <td id="agents_avance" style="display: none">
                                    <div id="agents_avance">
                                    </div>
                                </td>
                                <td id="agents_pret" style="display: none">
                                    <div id="agents_pret"></div>
                                </td>
                                <td id="agents_retenue" style="display: none">
                                    <div id="agents_retenue"></div>                                    
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>Mois</td>
                                <td > <?php echo $form['mois']->renderError() ?>
                                    <?php echo $form['mois'] ?>
                                </td>
                                <td>Année</td>
                                <td class="disabledbutton"> <?php echo $form['annee']->renderError() ?>
                                    <?php echo $form['annee'] ?>
                                </td>


                                <td id="button_avance" style="display: none"><button id="affiche_button" type="button" class="btn btn-sm btn-success" ng-click="Afficherdetaildemande()">
                                        Afficher Detail demande Avance
                                    </button>
                                </td>
                                <td id="button_pret" style="display: none">
                                    <button id="affiche_button" type="button" class="btn btn-sm btn-success" ng-click="Afficherdetaildemandepret()">
                                        Afficher Detail demande de Pret
                                    </button>
                                </td>
                                <td id="button_retenue" style="display: none">
                                    <button id="affiche_button" type="button" class="btn btn-sm btn-success" ng-click="Afficherdetaildemanderetenue()">
                                        Afficher Detail demande de Retenue sur salaire
                                    </button>  
                                </td>
                            </tr>
                        </table>
                        <table>
                            <thead>
                                <tr style="background: #DCDCDC">
                                    <th style="width: 20% ;display: none"> Id </th>
                                    <th style="width: 20%"> Agents </th>
                                    <th style="width: 20%"> Type </th>
                                    <th style="width: 10%">Montant Total </th>
                                    <th style="width: 10%">Nbr Mois</th>
                                    <th style="width: 10%">Montant Mensuel</th>
                                    <th style="width: 10%">Date Début Retenue</th>
                                    <th style="width: 10%">Date Fin Retenue</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="ligne in Listeavance">
                                    <td style="display: none">{{ligne.id}}</td>
                                    <td>{{ligne.agents}}</td>
                                    <td style="display: none">{{ligne.id_avance}}</td>
                                    <td>{{ligne.typeavance}}</td>
                                    <td style="text-align: center">{{ligne.montanttotal}}</td>
                                    <td style="text-align: center">{{ligne.nbrmois}}</td>
                                    <td style="text-align: center">{{ligne.montantmensielle}}</td>
                                    <td>{{ligne.demandeavance}} </td>
                                    <td>{{ligne.datefinretenue}}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm btn-circle" ng-click="DeleteLigneA(ligne)"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">
    var format = 'setAffichage()';
    $('#historiqueretenue_typeextraction').attr('onchange', format);

    function setAffichage() {
        if ($("#historiqueretenue_typeextraction").val() != "") {
            TesterAvancePretRetenue();
        }
        else {
            $('#pret').hide();
            $('#pret_liste').hide();
            $('#agents_pret').hide();
            $('#button_pret').hide();
            $('#avance').hide();
            $('#avance_liste').hide();
            $('#agents_avance').hide();
            $('#agents_retenue').hide();
            $('#button_retenue').hide();
            $('#button_avance').hide();

            angular.element($('#sf_admin_form')).scope().viderListeavance();
        }
    }

    function TesterAvancePretRetenue() {
        var id_type = $("#historiqueretenue_typeextraction").val();
        //-----avance
        if (id_type == "0") {
            $('#avance').fadeIn();
            $('#avance_liste').fadeIn();
            $('#agents_avance').fadeIn();
            $('#button_avance').fadeIn();
            $('.chosen-container').attr('style', 'width:100%');
            $('.chosen-container').trigger("chosen:updated");
            $('#retenue').hide();
            $('#retenue_liste').hide();
            $('#pret').hide();
            $('#pret_liste').hide();
            $('#agents_pret').hide();
            $('#agents_retenue').hide();
            $('#button_pret').hide();
            $('#button_retenue').hide();
            $.ajax({
                url: '<?php echo url_for('historiqueretenue/afficheDemandeAvanceSelectmulitiple') ?>',
                data: '',
                success: function (data) {
                    $('#agents_avance').html(data);
                    var demo1 = $('#historiqueretenue_id_demandeavance').bootstrapDualListbox({infoTextFiltered: '<span class="label label-purple label-lg">Filtré</span>'});
                    var container1 = demo1.bootstrapDualListbox('getContainer');
                    container1.find('.btn').addClass('btn-white btn-info btn-bold');
                }
            });
        }
        //------------
        //---pret
        if (id_type == "1") {
            $('#pret').fadeIn();
            $('#pret_liste').fadeIn();
            $('#agents_pret').fadeIn();
            $('#button_pret').fadeIn();
            $('.chosen-container').attr('style', 'width:100%');
            $('.chosen-container').trigger("chosen:updated");
            $('#retenue').hide();
            $('#retenue_liste').hide();
            $('#avance').hide();
            $('#avance_liste').hide();
            $('#agents_avance').hide();
            $('#agents_retenue').hide();
            $('#button_retenue').hide();
            $('#button_avance').hide();
            $.ajax({
                url: '<?php echo url_for('historiqueretenue/afficheDemandePretSelectMultiple') ?>',
                data: '',
                success: function (data) {
                    $('#agents_pret').html(data);
                    var demo1 = $('#historiqueretenue_id_demandepret').bootstrapDualListbox({infoTextFiltered: '<span class="label label-purple label-lg">Filtré</span>'});
                    var container1 = demo1.bootstrapDualListbox('getContainer');
                    container1.find('.btn').addClass('btn-white btn-info btn-bold');
                }
            });
        }
        //---
        if (id_type == "2") {
            $('#retenue').fadeIn();
            $('#retenue_liste').fadeIn();
            $('#agents_retenue').fadeIn();
            $('#button_retenue').fadeIn();
            $('.chosen-container').attr('style', 'width:100%');
            $('.chosen-container').trigger("chosen:updated");
            $('#avance').hide();
            $('#avance_liste').hide();
            $('#pret').hide();
            $('#agents_avance').hide();
            $('#agents_pret').hide();
            $('#button_avance').hide();
            $('#button_pret').hide();
            $.ajax({
                url: '<?php echo url_for('historiqueretenue/afficheDemandeRetenueSelectMultiple') ?>',
                data: '',
                success: function (data) {
                    $('#agents_retenue').html(data);
                    var demo1 = $('#historiqueretenue_id_retenue').bootstrapDualListbox({infoTextFiltered: '<span class="label label-purple label-lg">Filtré</span>'});
                    var container1 = demo1.bootstrapDualListbox('getContainer');
                    container1.find('.btn').addClass('btn-white btn-info btn-bold');
                }
            });
            angular.element($('#sf_admin_form')).scope().viderListeavance();
        }
    }

</script>
<style>

    .bootstrap-duallistbox-container .info {
        font-size: 14px;
    }

</style>