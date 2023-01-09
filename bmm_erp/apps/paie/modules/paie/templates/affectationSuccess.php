<div id="sf_admin_container">
    <h1 id="replacediv"> Fiche Affectation des Paies Mois > 12</h1>
</div>

<div class="row" ng-controller="CtrlPaie">
    <div class="col-sm-12">
        <div id="accordion" class="accordion-style2">
            <div class="group">
                <h3 class="accordion-header">Données de base</h3>
                <?php $agents = AgentsTable::getInstance()->getAllByNomCompletAndPaye(); ?>
                <!--                <?php // $societe = SocieteTable::getInstance()->findOneById(1);     ?>
                                <input id="id_societe" type="hidden" value="<?php // echo $societe->getId()     ?>"-->

                <table>
                    <tr>
<!--                        <td >Triméstre</td>
                        <td> 
                            <select id="numeotrimestre" >
                                <option value=""> </option>
                                <option value="1">1ére Trimestre</option>
                                <option value="2">2éme Trimestre</option>
                                <option value="3">3éme Trimestre</option>
                                <option value="4">4éme Trimestre</option>

                            </select>
                        </td>-->
                        <td style="width: 10%">Mois</td>
                        <td style="width: 10%">
                            <select name="paie[mois]" id="p_mois">
                                <option value=""></option>
                                <option value="1">Janvier</option>
                                <option value="2">Février</option>
                                <option value="3">Mars</option>
                                <option value="4">Avril</option>
                                <option value="5">Mai</option>
                                <option value="6">juin</option>
                                <option value="7">Juillet</option>
                                <option value="8">Août</option>
                                <option value="9">Septembre</option>
                                <option value="10">Octobre</option>
                                <option value="11">Nouvembre</option>
                                <option value="12">Décembre</option>
                            </select>
                        </td>
                        <td style="width: 25%;">Prime Attaché à ce Mois </td>
                        <td id="prim_soc" class="disabledbutton" style="width: 25%">
                            <select id="prime_Societe">
                                <option value=""></option>
                            </select>
                        </td>
                        <td style="width: 10%">Année</td>
                        <td style="width: 10%">
                            <select id="annee_paie">
                                <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                    <option <?php if ($i == date('Y')): ?>selected="true"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                    </tr>
                </table>

                <div style="display: none" id="agents_div">
                    <table>
                        <tr><td style="width: 25%;">Liste des agents</td></tr>
                        <tr>
                            <td style="width: 75%;" id="liste_agents">
                                <select multiple="multiple" size="6" name="p[id_agents]" id="p_idagents">

                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row" style="display: none; margin-top: 20px;" id="btn_aff">
                    <button id="affiche_button" type="button" class="btn btn-sm btn-success pull-right" ng-click="AfficherdetailPaieAgents()">
                        Afficher Détails Agents
                    </button>
                </div>
                
                <div style="display: none; margin-top: 20px;" id="affiche_detail">
                    <table style="width: 100%;">
                        <thead>
                            <tr style="background: #DFF2FF;">
                                <th style="width: 7%; font-size: 13px; text-align: center;"> Matricule</th>
                                <th style="display: none;">Id_agents</th>
                                <th style="width: 15%;font-size: 13px;"> Agents </th>
                                <th style="width: 10%;font-size: 13px; text-align: center;"> Salaire Brut<br>(Dr mois) </th>
                                <th style="width: 5%;font-size: 13px; text-align: center;">Code Sociale</th>
                                <th style="width: 5%;font-size: 13px; text-align: center;">M. Sociale</th>
                                <th style="width: 8%;font-size: 13px; text-align: center;">Base Calcul Prime</th>
                                <th style="width: 8%;font-size: 13px; text-align: center;">Note Rendement </th>
                                <th style="width: 8%;font-size: 13px; text-align: center;">Note Présence</th>
                                <th style="width: 8%;font-size: 13px; text-align: center;">Brut Prime</th>
                                <th style="width: 7%;font-size: 13px; text-align: center;">IRPP</th>
                                <th style="width: 7%;font-size: 13px; text-align: center;">CSS 1%</th>
                                <th style="width: 12%;font-size: 13px; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="ligne in listePaie">
                                <td style="display: none">{{ligne.id}}</td>
                                <td style="display: none;" id="id_agents_{{ligne.id}}" ng-value="{{ligne.id_agents}}"> {{ligne.id_agents}} </td>
                                <td style="font-size: 12px; text-align: center;">{{ligne.idrh}}</td>
                                <td style="font-size: 12px;">{{ligne.agents}}</td>
                                <td style="font-size: 12px; text-align: right;" id="sbrut_{{ligne.id}}">{{ligne.sbrut}}</td>
                                <td style="display: none;">{{ligne.id_codesociale}}</td>
                                <td style="display: none;">{{ligne.abattenfant}}</td>
                                <td style="display: none;">{{ligne.abattcheffamille}}</td>
                                <td style="display: none;">{{ligne.salairetheorique}}</td>
                                <td style="font-size: 12px; text-align: center;">{{ligne.codesociale}}</td>
                                <td style="font-size: 12px; text-align: center;" id="taux_{{ligne.id}}" ng-value="{{ligne.taux}}">{{ligne.taux}}%</td>
                                <td style="font-size: 12px; text-align: right;" id="base_calculprime_{{ligne.id}}" ng-value="{{ligne.base_calculprime}}" >{{ligne.base_calculprime}}</td>
                                <td style="font-size: 12px;"><input type="text" id="noterednement_{{ligne.id}}" ng-model="noterednement" ng-value="{{ligne.noterednement}}" value="{{ligne.noterednement}}" ng-change="setCalcule('{{ligne.id}}', '{{ligne.id_agents}}')" style="text-align: center"></td>
                                <td style="font-size: 12px;"><input type="text" id="notepresence_{{ligne.id}}" ng-model="notepresence" ng-value="{{ligne.notepresence}}" value="{{ligne.notepresence}}/{{ligne.total_jour}}" style="text-align: center" readonly="true"></td><!-- ng-change="setCalcule('{{ligne.id}}')" !-->
                                <td style="font-size: 12px;"><input type="text" id="brut_prime_{{ligne.id}}" ng-value="{{ligne.brut_prime}}" readonly="true" style="text-align: center"></td>
                                <td style="display: none;"><input type="text" id="mntsocialmensuelle_{{ligne.id}}" value="{{ligne.mntsocialmensuelle}}" readonly="true" style="text-align: center">{{ligne.mntsocialmensuelle}}</td>
                                <td style="display: none;"><input type="text" id="montantsociale_{{ligne.id}}" value="{{ligne.montantsociale}}" readonly="true" style="text-align: center">{{ligne.montantsociale}}</td>
                                <td style="display: none;"><input type="text" id="brutanuuel_{{ligne.id}}" value="{{ligne.brutanuuel}}" readonly="true" style="text-align: center"></td>
                                <td style="display: none;"><input type="text" id="netsociale_{{ligne.id}}"  ng-value="" readonly="true" style="text-align: center" value="{{ligne.netsociale}}"></td>
                                <td style="display: none;"><input type="text" id="abattement_{{ligne.id}}" ng-value="{{ligne.abattement}}" readonly="true" style="text-align: center" value="{{ligne.abattement}}"></td>
                                <td style="display: none;"><input type="text" id="abattementfrpro_{{ligne.id}}" ng-value="{{ligne.abattementfrpro}}"  readonly="true"  style="text-align: center" value="{{ligne.abattementfrpro}}"></td>
                                <td style="display: none;"><input type="text" id="salaireimpo_{{ligne.id}}" ng-value="{{ligne.salaireimpo}}"  readonly="true" style="text-align: center" value="{{ligne.salaireimpo}}"></td>
                                <td style="display: none;"><input type="text" id="retenueimosable_{{ligne.id}}" ng-value="{{ligne.retenueimosable}}" value="{{ligne.retenueimosable}}" readonly="true" style="text-align: center"></td>
                                <td style="display: none;"><input type="text" id="salairenet_{{ligne.id}}" ng-value="{{ligne.salairenet}}" value="{{ligne.salairenet}}" readonly="true"style="text-align: center"></td>
                                <td style="display: none;"><input type="text" id="netapayyer_{{ligne.id}}" ng-value="{{ligne.netapayyer}}" value="{{ligne.netapayyer}}" readonly="true" style="text-align: center"></td>
                                <td><input type="text" id="irpp_{{ligne.id}}" ng-value="{{ligne.irpp}}" readonly="true" style="text-align: center"></td>
                                <td><input type="text" id="css_{{ligne.id}}" ng-value="{{ligne.css}}" readonly="true" style="text-align: center"></td>
                                <td style="text-align: center;">
                                    <button type="button" class="btn btn-success btn-xs" ng-click="ValiderLigneA(ligne.id, ligne.id_agents, ligne.id_codesociale, ligne.sbrut, ligne.abattenfant, ligne.abattcheffamille, ligne.salairetheorique)"><i class="ace-icon fa fa-check"></i></button>
                                    <button type="button" class="btn btn-warning btn-xs" ng-click="InitialiserLigne(ligne.id)"><i class="ace-icon fa fa-remove"></i></button>
                                    <button type="button" class="btn btn-danger btn-xs" ng-click="SuppresiionLigne(ligne.id)"><i class="ace-icon fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">
            document.title = ("BMM - U. Paie. : Affectation des Paies Mois > 12");
</script>