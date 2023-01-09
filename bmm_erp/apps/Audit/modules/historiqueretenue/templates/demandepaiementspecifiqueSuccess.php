<div id="sf_admin_container">
    <h1>Demande Paiement Spécifique</h1>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body" ng-controller="CtrlAffairesociale"> 
            <fieldset style="padding: 10px">
                <table>
                    <td>Extraction pour </td>
                    <td >   
                        <select id='type_paiement'>
                            <option value="0"></option>
                            <option value="1">Demande Avance </option>
                            <option value="2">Demande Prêt </option>
                            <option value="3">Demande Retenue sur salaire </option>
                        </select>
                    </td>
                    <td id='agents' style="display: none">Agents </td>
                    <td id="agents_avance" style="display: none">

                        <?php
//                        $agents = AgentsTable::getInstance()->getAgents();
                        ?>
                        <select id='agents_avance_paiement'>
                            <option value=""></option>
                            <?php // foreach ($agents as $a) { ?>
                                <!--<option  value="<?php // echo $a->getId(); ?>"><?php // echo $a->getIdrh() . "  " . $a->getNomcomplet() . "  " . $a->getPrenom(); ?></option>-->
                            <?php // } ?>
                        </select>
                    </td>
                    <td id="agents_pret" style="display: none">
                        <?php
//                        $agents = AgentsTable::getInstance()->getAgentsPret();
                        ?>
                        <select id="agents_pret_paiement" >
                            <option></option>                           
                        </select>
                    </td>
                    <td id="agents_retenue" style="display: none">
                        <?php
//                        $agents = AgentsTable::getInstance()->getAgentsRetenue();
                        ?>
                        <select id="agents_retenue_paiement">
                            <option></option>                         
                        </select>
                    </td>
                </table>
                <table>
                    <tr style="background: repeat-x #F2F2F2;background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                        <th style="width: 10%">N°ordre</th>
                        <th style="width: 5% ; display: none">Id</th>
                        <th style="width: 20%" colspan="2">Agent (Demande)</th>
                        <th style="width: 25%">Type</th>
                        <th style="width: 10%">Montant Total</th>
                        <th style="width: 10%">Nbr Mois</th>
                        <th style="width: 10%">Montant Mensuel</th>
                        <th style="width: 10%">Montant Déjà Payé</th>
                    </tr>
                    <tr id="formligne">
                        <td style="width: 10px !important"><input type="text" value="" ng-model="norgdre.text" id="nordre" class="form-control disabledbutton"></td>
                        <td style="display: none"><input type="text" value="" ng-model="id.text" id="id" class="form-control disabledbutton"></td>
                        <td colspan="2" >
                            <select id="avance">
                                <option value=""></option>
                            </select>
                        </td> 
                        <td class="disabledbutton"> 
                            <input type="text" value="" ng-model="type.text" id="type" autocomplete="off" class="form-control" placeholder="Type">
                        </td>
                        <td class="disabledbutton"> 
                            <input type="text" value="" ng-model="montant.text" id="montant" autocomplete="off" class="align_center" placeholder="Montant">
                        </td>
                        <td class="disabledbutton"> 
                            <input type="text" value="" ng-model="nbrmois.text" id="nbrmois" autocomplete="off" class="align_center" placeholder="Nbr Mois">
                        </td>
                        <td class="disabledbutton"> 
                            <input type="text" value="" ng-model="montantmensuel.text" id="montantmensuel" autocomplete="off" class="align_center" placeholder="Montant Mensuel" ng-change="chargeChargerNbrmoispaye()">
                        </td>
                        <td class="disabledbutton"> 
                            <input type="text" value="" ng-model="montantdejapaye.text" id="montantdejapaye" autocomplete="off" class="align_center" placeholder="T.Montant Payé">
                        </td>
                    </tr>
                    <tr style="background: repeat-x #F2F2F2;background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                        <th style="width: 10%">Date début Retenue</th>
                        <th style="width: 10%">Date Fin Retenue</th>
                        <th style="width: 15%">Montant Payé</th>
                        <th style="width: 10%">Nbr mois payé</th>
                        <th style="width: 10%">Montant Restant</th>
                        <th style="width: 10%">Mois</th>
                        <th style="width: 10%">Année</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                    <tr>
                        <td class="disabledbutton"> 
                            <input type="text" value="" ng-model="datedebut.text" id="datedebut" autocomplete="off" class="form-control" placeholder="Date Début Retenue">
                        </td>
                        <td class="disabledbutton"> 
                            <input type="text" value="" ng-model="datefin.text" id="datefin" autocomplete="off" class="form-control" placeholder="Date fin Reteniu">
                        </td>
                        <td> 
                            <input type="text" value="" ng-model="montantpaye.text" id="montantpaye" autocomplete="off" class="align_center" placeholder="Montant Payé" ng-change="chargeChargerNbrmoispaye()">
                        </td>
                        <td> 
                            <input type="text" value="" ng-model="nbrmoispaye.text" id="nbrmoispaye" autocomplete="off" class="align_center" placeholder="Nbr mois à Payer" ng-change="cahrgerMontant()">
                        </td>
                        <td class="disabledbutton"> 
                            <input type="text" value="" ng-model="montantrestant.text" id="montantrestant" autocomplete="off" class="align_center" placeholder="Montant Restant">
                        </td>
                        <td>
                            <select name="mois" id="mois">
                                <option value=""></option>
                                <option <?php if('01' == date('m')): ?>selected="true"<?php endif; ?> value="1">Janvier</option>
                                <option <?php if('02' == date('m')): ?>selected="true"<?php endif; ?> value="2">Février</option>
                                <option <?php if('03' == date('m')): ?>selected="true"<?php endif; ?> value="3">Mars</option>
                                <option <?php if('04' == date('m')): ?>selected="true"<?php endif; ?> value="4">Avril</option>
                                <option <?php if('05' == date('m')): ?>selected="true"<?php endif; ?> value="5">Mai</option>
                                <option <?php if('06' == date('m')): ?>selected="true"<?php endif; ?> value="6">Juin</option>
                                <option <?php if('07' == date('m')): ?>selected="true"<?php endif; ?> value="7">Juillet</option>
                                <option <?php if('08' == date('m')): ?>selected="true"<?php endif; ?> value="8">Août</option>
                                <option <?php if('09' == date('m')): ?>selected="true"<?php endif; ?> value="9">Septembre</option>
                                <option <?php if('10' == date('m')): ?>selected="true"<?php endif; ?> value="10">Octobre</option>
                                <option <?php if('11' == date('m')): ?>selected="true"<?php endif; ?> value="11">Nouvembre</option>
                                <option <?php if('12' == date('m')): ?>selected="true"<?php endif; ?> value="12">Décembre</option>
                            </select>
                        </td>
                        <td>
                            <select name="annee" id="annee" class="chosen-select form-control">
                                <option value=""></option>
                                <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                <option <?php if($i == date('Y')): ?>selected="true"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                        <td style="text-align: center;">
                            <button type="button" class="btn btn-info btn-sm btn-circle" ng-click="AjouterLigne()">+</button>
                            <button type="button" class="btn btn-warning btn-sm btn-ci" ng-click="InaliserLigne()">-</button>
                        </td>
                    </tr>
                    <tbody ng-repeat="ligne in Listepaiement">
                        <tr>
                            <td style="text-align: center;">{{ligne.norgdre}}</td>
                            <td style="display: none">{{ligne.id}}</td>
                            <td colspan="2">{{ligne.avance}}</td>
                            <!--<td>{{ligne.type}}</td>-->
                            <td style="text-align: center;">{{ligne.montant}}</td>
                            <td style="text-align: center;">{{ligne.nbrmois}}</td>
                            <td style="text-align: center;">{{ligne.montantmensuel}}</td>
                            <td style="text-align: center;">{{ligne.montantdejapaye}}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">{{ligne.datedebut}}</td>
                            <td style="text-align: center;">{{ligne.datefin}}</td>
                            <td style="text-align: center;">{{ligne.montantpaye}}</td>
                            <td style="text-align: center;">{{ligne.nbrmoispaye}}</td>
                            <td style="text-align: center;">{{ligne.montantrestant}}</td>
                            <td style="text-align: center;">{{ligne.mois_affiche}}</td>
                            <td style="text-align: center;">{{ligne.annee}}</td>
                            <td style="width: 20px; text-align: center;">
                                <button type="button" class="btn btn-info btn-sm btn-circle" ng-click="MisAJour(ligne)"><i class="fa fa-hospital-o"></i></button>
                                <button type="button" class="btn btn-warning btn-sm btn-circle" ng-click="Delete(ligne)"><i class="fa fa-times"></i></button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr style="background-color: #F2F2F2;"> 
                            <td colspan="1"></td>
                            <td style="text-align: center; font-size: 16px; vertical-align: middle;">Total</td>
                            <td class="disabledbutton">
                                <input type="text" id="montanttotal" class="align_center" style="max-width: 100px;" placeholder="M.TOTAL">
                            </td>
                            <td colspan="5"></td>
                        </tr>
                    </tfoot>
                </table>
            </fieldset>
            <fieldset>
<!--                <table style="width: 18px"  align="right">
                    <tbody>
                        <tr> 
                            <td>  <button type="button" id="btnvalider" ng-click="validerAjout()" class="btn btn-info" >valider</button>
                            </td>
                            
                        </tr> 
                    </tbody>  
                </table>-->

                <div class="form-actions center" style="margin-bottom: 0px; margin-top: 0px;">
                    <button id="button_save" type="button" class="btn btn-sm btn-success" ng-click="validerAjout()">
                        Enregistrer
                        <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                    </button>
                    <a id="print_button" style="display: none;" target="_blank" href="" type="button" class="btn btn-sm btn-primary">
                        Imprimer
                        <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                    </a>
                </div>
            </fieldset>
        </div>
    </div>
</div>