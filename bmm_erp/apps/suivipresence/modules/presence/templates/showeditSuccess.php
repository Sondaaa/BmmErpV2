<div id="sf_admin_container">
    <h1 id="replacediv">Mise à jour Fiche Présence</h1>
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
                            <div id="moisannee">
                                <?php
                                $id = $presence->getId();
                                $presence = Doctrine_Core::getTable('presence')->findOneById($id);
                                ?>
                                <fieldset class="col-lg-12">  
                                    <table class="table  table-bordered table-hover">
                                        <tr>
                                            <td><label>Agents:</label></td>
                                            <td>
                                                <input type="hidden" id="id_ag" value="<?php echo $presence->getAgents()->getId(); ?>">
                                                <input type="text" id="id_agents" value="<?php echo $presence->getAgents()->getNomcomplet() . " " . $presence->getAgents()->getPrenom(); ?>">
                                            </td>
                                        </tr>
                                    </table>
                                </fieldset>
                            </div>
                            <fieldset class="col-lg-12">
                                <table class="table  table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td class="disabledbutton">
                                                <select  name="presence[mois]" id="presence_mois" class="chosen-select form-control" >
                                                    <option <?php if ($form->getObject()->getMois() == 1): ?>selected="true"<?php endif; ?> value="01">Janvier</option>
                                                    <option <?php if ($form->getObject()->getMois() == 2): ?>selected="true"<?php endif; ?> value="02">Février</option>
                                                    <option <?php if ($form->getObject()->getMois() == 3): ?>selected="true"<?php endif; ?> value="03">Mars</option>
                                                    <option  <?php if ($form->getObject()->getMois() == 4): ?>selected="true"<?php endif; ?> value="04">April</option>
                                                    <option <?php if ($form->getObject()->getMois() == 5): ?>selected="true"<?php endif; ?> value="05">Mai</option>
                                                    <option <?php if ($form->getObject()->getMois() == 6): ?>selected="true"<?php endif; ?>  value="06">juin</option>
                                                    <option <?php if ($form->getObject()->getMois() == 7): ?>selected="true"<?php endif; ?>   value="07">Juillet</option>
                                                    <option <?php if ($form->getObject()->getMois() == 8): ?>selected="true"<?php endif; ?>  value="08">Oaut</option>
                                                    <option  <?php if ($form->getObject()->getMois() == 9): ?>selected="true"<?php endif; ?>  value="09">Septembre</option>
                                                    <option <?php if ($form->getObject()->getMois() == 10): ?>selected="true"<?php endif; ?>  value="10">October</option>
                                                    <option <?php if ($form->getObject()->getMois() == 11): ?>selected="true"<?php endif; ?>  value="11">Nouvembre</option>
                                                    <option <?php if ($form->getObject()->getMois() == 12): ?>selected="true"<?php endif; ?>  value="12">Décembre</option>
                                                </select>
                                            </td>
                                            <td class="disabledbutton">
                                                <select name="presence[annee]" id="presence_annee" class="chosen-select form-control">
                                                    <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                                        <option <?php if ($i == $presence->getAnnee()) : ?>selected="true"<?php endif; ?>value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php endfor; ?>
                                                </select>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                            <div ng-init="ShowAffichejourconge()">
                                <fieldset class="col-lg-12"> 
                                    <legend><i>Les Jours du Congé</i></legend>
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
                                </fieldset>
                            </div>

                            <fieldset class="col-lg-12">
                                <legend><i>Les Jours Fériers </i></legend>
                                <table id="magJourF" class="table  table-bordered table-hover">
                                    <thead >
                                        <tr style="background-color: #D3D3D3">
                                            <th style="width: 40%"><label>Jour Férier</label></th>
                                            <th style="width: 40%"><label>Date Jour Férier</label></th>
                                            <th style="width: 10%"><label>Payé</label></th>
                                            <th style="width: 10%"><label>Périodique</label></th>

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
                            </div>
                        </fieldset>
                    </form>

                    <div  ng-init="afficherSemainegrillepresence('<?php echo $presence->getId(); ?>')">
                        <fieldset>

                            <table class="table  table-bordered table-hover" style="width: 100%">
                                <thead style="color: #2E7DB4">
                                    <tr>
                                        <th style="background: #778899" >Mois <?php echo date('M'); ?></th>
                                        <th style="background: #C0C0C0 ;width: 8%">J </th> 
                                        <th style="background: #C0C0C0">Semaine1</th> 
                                        <th style="background: #C0C0C0">Heurs suppl</th> 
                                        <th style="background: #C0C0C0; width: 8%">J </th> 
                                        <th style="background: #C0C0C0">Semaine2</th> 
                                        <th style="background: #C0C0C0">Heurs suppl</th> 
                                        <th style="background: #C0C0C0;width: 8%">J</th>
                                        <th style="background: #C0C0C0">Semaine3</th> 
                                        <th style="background: #C0C0C0">Heurs suppl</th> 
                                        <th style="background: #C0C0C0;width: 8%">J</th>
                                        <th style="background: #C0C0C0">Semaine4</th> 
                                        <th style="background: #C0C0C0">Heurs suppl</th> 
                                        <th style="background: #C0C0C0 ; width: 8%">J</th>
                                        <th style="background: #C0C0C0">Semaine5</th> 
                                        <th style="background: #C0C0C0">Heurs suppl</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $j = 0; ?>
                                    <?php foreach (array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "T.H.Hebdo.") as $ligne): ?>
                                        <tr>
                                            <td style="background: #C0C0C0"><?php echo $ligne; ?></td>

                                            <?php foreach (array(1, 2, 3, 4, 5) as $col): ?>
                                                <td>
                                                    <input  data='fixed' type="text" readonly="true" id="j_<?php echo $j . "_" . $col; ?>" >
                                                </td>
                                                <td>
                                                    <input  data='fixed' type="text"   id="s_<?php echo $j . "_" . $col; ?>"  <?php if ($j == 6 || $j == 7 || $j == 0): ?> readonly="true"  <?php endif; ?> onchange="CalculTotal('<?php echo $col; ?>')">
                                                </td>
                                                <td>
                                                    <input   data='fixed' type="text"  id="h_<?php echo $j . "_" . $col; ?>" <?php if ($j == 7 || $j == 6 || $j == 0) : ?> readonly="true"  <?php endif; ?> onkeyup="CalculTotalHsup('<?php echo $col; ?>')">
                                                </td>

                                            <?php endforeach; ?>
                                        </tr>
                                        <?php $j++; ?>
                                    <?php endforeach; ?>


                                </tbody>
                            </table>
                            <div ng-init="affichergrillepresence('<?php echo $presence->getId(); ?>')">
                                <table class="table  table-bordered table-hover" style="width: 100%">
                                    <tr> <td colspan="1"  style="background: #D3D3D3">
                                            <?php echo date('M'); ?> :Total d'heures norm.</td><td></td>
                                        <td><input type="text" id="totalheurnorma" class="disabledbutton"></td>
                                        <td colspan="6"  style="background: #D3D3D3"><?php echo date('M'); ?> :Total d'heures supp. </td>
                                        <td colspan="6"></td><td><input type="text" id="totalheurehesupp" class="disabledbutton"></td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="form-actions center" style="margin-bottom: 0px; margin-top: 0px;">
                    <a href="<?php echo url_for('@presence') ?>" class="btn btn-white btn-success">Retour à la liste</a>
                    <button type="button" class="btn btn-sm btn-success" ng-click="ModifierEmploye()">
                        Enregistrer
                        <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                    </button>

                </div>
            </div>
        </div>

        <?php //echo date("t"); // $lastDay = \DateTime::createFromFormat("Y-m-d", "2009-11-23")->format("Y-m-t");    ?>
        <script>
            $('document').ready(function () {
                for (var i = 1; i <= 5; i++)
                {
                    CalculTotal(i);
                }
            });




            function CalculTotal(i) {
                var total = 0;
                for (var j = 1; j < 6; j++)
                {
                    if ($("#s_" + j + "_" + i).val() != "")
                    {
                        var nbheure = $("#s_" + j + "_" + i).val();
                    }
                    else
                        nbheure = 0;


                    total = parseFloat(total) + parseFloat(nbheure);

                }
                $('#s_7_' + i).val(total);

                calcultotalhmois();
            }
            function calcultotalhmois()
            {
                var tot = 0;
                for (var j = 1; j <= 5; j++)
                {
                    var nbrh = $("#s_7_" + j).val();
                    tot = parseFloat(tot) + parseFloat(nbrh);
                }
                $('#totalheurnorma').val(tot);
            }

            function CalculTotalHsup(i)
            {
                var total = 0;
                for (var j = 1; j < 6; j++)
                {
                    if ($("#h_" + j + "_" + i).val() != "")
                    {
                        var nbheuresupp = $("#h_" + j + "_" + i).val();
                    }
                    else
                        nbheuresupp = 0;


                    total = parseFloat(total) + parseFloat(nbheuresupp);

                }
                $('#h_7_' + i).val(total);
                calcultotalheuresuppmois();
            }

            function calcultotalheuresuppmois()
            {
                var tot = 0;

                for (var j = 1; j <= 5; j++)
                {
                    if ($("#h_7_" + j).val() != "")
                    {
                        var nbrh = $("#h_7_" + j).val();
                    }
                    else
                        nbrh = 0;
                    tot = parseFloat(tot) + parseFloat(nbrh);

                }
                $('#totalheurehesupp').val(tot);
            }
        </script>

        <style>

            .bootstrap-duallistbox-container .info {
                font-size: 14px;
            }

        </style>