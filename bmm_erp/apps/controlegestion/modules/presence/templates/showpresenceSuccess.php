<div id="sf_admin_container">
    <h1>Mise à jour Fiche Présence</h1>
</div>

<div class="row" ng-controller="CtrlPresence" >
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
                                <div id="moisannee" >
                                  
                                    <?php
                                    $id = $presence->getId();
                                    
                                    $presence = Doctrine_Core::getTable('presence')->findOneById($id);
                                    ?>
                                    
                                    <input type="hidden" value="<?php echo $presence->getId();?>" id="id_presence">
                                    
                                    <fieldset class="col-lg-12">  
                                        <table class="table  table-bordered table-hover">
                                            <tr>
                                                <td><label>Agents:</label></td>
                                                <td><label>  <?php echo $presence->getAgents()->getNomComplet(); ?></label></td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </div>

                                <fieldset class="col-lg-12">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="disabledbutton" >
                                                    <select  name="presence[mois]" id="presence_mois" class="chosen-select form-control" onchange="IntitialiserGrille()" >
                                                        <option <?php if ($form->getObject()->getMois() == 1): ?>selected="true"<?php endif; ?> value="01">Janvier</option>
                                                        <option <?php if ($form->getObject()->getMois() == 2): ?>selected="true"<?php endif; ?> value="02">Février</option>
                                                        <option <?php if ($form->getObject()->getMois() == 3): ?>selected="true"<?php endif; ?> value="03">Mars</option>
                                                        <option  <?php if ($form->getObject()->getMois() == 4): ?>selected="true"<?php endif; ?> value="04">April</option>
                                                        <option <?php if ($form->getObject()->getMois() == 5): ?>selected="true"<?php endif; ?> value="05">Mai</option>
                                                        <option <?php if ($form->getObject()->getMois() == 6): ?>selected="true"<?php endif; ?>  value="06">juin</option>
                                                        <option <?php if ($form->getObject()->getMois() == 7): ?>selected="true"<?php endif; ?>   value="07">Juillet</option>
                                                        <option <?php if ($form->getObject()->getMois() == 8): ?>selected="true"<?php endif; ?>  value="08">Août</option>
                                                        <option  <?php if ($form->getObject()->getMois() == 9): ?>selected="true"<?php endif; ?>  value="09">Septembre</option>
                                                        <option <?php if ($form->getObject()->getMois() == 10): ?>selected="true"<?php endif; ?>  value="10">October</option>
                                                        <option <?php if ($form->getObject()->getMois() == 11): ?>selected="true"<?php endif; ?>  value="11">Nouvembre</option>
                                                        <option <?php if ($form->getObject()->getMois() == 12): ?>selected="true"<?php endif; ?>  value="12">Décembre</option>
                                                    </select>
                                                </td>
                                                <td class="disabledbutton" >

                                                    <select name="presence[annee]" id="presence_annee" class="chosen-select form-control" onchange="IntitialiserGrille()">
                                                        <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                                            <option <?php if ($i == $presence->getAnnee()) : ?>selected="true"<?php endif; ?>value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php endfor; ?>
                                                    </select>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                                <fieldset class="col-lg-12">

                                    <table id="magJourF">
                                        <thead >
                                            <tr style="background-color: #D3D3D3">
                                                <th style="width: 40%"><label>Jour Férier</label></th>
                                                <th style="width: 40%"><label>Date.J.F</label></th>
                                                <th style="width: 10%"><label>Payé/Non</label></th>
                                                <th style="width: 10%"><label>Périodique/Non</label></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="ligne in listesJourFerier">

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
                    <fieldset id="grille_edit" >

                    </fieldset>
                    <!--********************************************************-->

                </div>
                <div class="form-actions center" style="margin-bottom: 0px; margin-top: 0px;">
                    <a href="<?php echo url_for('@presence') ?>" class="btn btn-white btn-success">Retour à la liste</a>
                    <button type="button" class="btn btn-sm btn-success" ng-click="ModifierEmploye('<?php echo $presence->getId(); ?>','<?php echo $presence->getAgents()->getId()?>')">
                        Enregistrer
                        <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>
<?php //echo date("t"); // $lastDay = \DateTime::createFromFormat("Y-m-d", "2009-11-23")->format("Y-m-t");     ?>
<script>
    for (var i = 1; i <= 5; i++)
        {
            CalculTotal(i);
            CalculTotalHsup(i);
        }
//    $('document').ready(function () {
//        for (var i = 1; i <= 5; i++)
//        {
//            CalculTotal(i);
//        }
//    });
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
//        alert($('#id_presence').val() );
        if ($('#presence_mois').val() != '' && $('#presence_annee').val() != '') {
            $.ajax({
                url: '<?php echo url_for('presence/affichegrilleedit') ?>',
                data: 'idpresence_mois=' + $('#presence_mois').val() + '&idpresence_annee=' + $('#presence_annee').val()+'&id='+$('#id_presence').val() ,
                success: function (data) {
                    $('#grille_edit').html(data);
                }
            });
        }

    }


</script>

<style>

    .bootstrap-duallistbox-container .info {
        font-size: 14px;
    }

</style>