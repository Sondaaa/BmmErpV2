<div id="sf_admin_container">
    <div id="sf_admin_content">  
        <div  class="panel-body" >
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true" ng-click="initialChampsDonnedebase();" ><!--ng-click="initialChampsDonnedebase();" -->
                        <i class="green ace-icon fa fa-usb bigger-120"></i>Données de base </a>
                </li>
                <li><a  href="#enfants" data-toggle="tab" aria-expanded="false"  >
                        <i class="green ace-icon fa fa-money bigger-120"></i>
                        Données Sociales</a>
                </li>
                <li><a  href="#primes" data-toggle="tab" aria-expanded="false"  >
                        <i class="green ace-icon fa fa-money bigger-120"></i>
                        Primes</a>
                </li>

                <li><a href="#retenue" data-toggle="tab" aria-expanded="false"  >
                        <i class="green ace-icon fa fa-money bigger-120"></i>
                        Retenues</a>
                </li>
            </ul>
            <div class="tab-content" >  
                <div class="tab-pane fade active in" id="home"  ng-init="affichenbrjourferier()" >
                    <fieldset>
                        <fieldset>
                            <fieldset>
                                <legend><i> Données de base</i> </legend>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><label>Agent</label></td>
                                            <td><input type="hidden" value="<?php echo $paie->getIdContrat(); ?>" id="contrat_id">
                                                <?php echo $form['id_agents']->renderError() ?>
                                                <?php echo $form['id_agents'] ?>
                                            </td>

                                            <td>
                                                <select name="paie[mois]" id="paie_mois">
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
                                                <select name="paie[annee]" id="paie_annee" >
                                                    <?php
                                                    for ($i = 2018; $i <= date('Y'); $i++):
                                                        ?>
                                                        <option <?php if ($i == date('Y')): ?>selected="true"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr><input type="hidden" id="id_contrat">
                                    <td class="disabledbutton">
                                        <input type="text"  id="direction"   class="form-control" value="<?php echo $paie->getContrat()->getPosterh()->getUnite()->getServicerh()->getSousdirection()->getDirection() ?>">
                                        <input type="text"  id="grade" placeholder="Grade"  value="<?php echo $paie->getContrat()->getSalairedebase()->getGrade()->getLibelle() ?>" class="form-control">
                                    </td>
                                    <td class="disabledbutton">
                                        <input type="text"  id="categorie" placeholder="Catégorie"  class="form-control" value="<?php echo $paie->getContrat()->getSalairedebase()->getCategorierh()->getLibelle() ?>">
                                        <input type="text"  id="echelle" placeholder="Echelle"   class="form-control" value="<?php echo "Echelle " . $paie->getContrat()->getSalairedebase()->getEchelle()->getLibelle() ?>">
                                    </td>
                                    <td class="disabledbutton">
                                        <input type="text"  id="echelon" placeholder="Echelon"   class="form-control" value="<?php echo "Echelon " . $paie->getContrat()->getSalairedebase()->getEchelon()->getLibelle() ?>">
                                        <input type="text"  id="situation" placeholder="Situation Administrative"  class="form-control" value="<?php echo $paie->getContrat()->getTypecontrat()->getLibelle() ?>">
                                    </td>
                                    <td class="disabledbutton">
                                        <input type="text"  id="salaire" placeholder="Salaire de Base"   class="form-control" value="<?php echo $paie->getSalairedebase() ?>">
                                        <label>Chef Famille  </label>
                                        <input type="checkbox"  id="chef" <?php if ($paie->getAgents()->getCheffamille() == true): ?>
                                                   value="checked"
                                               <?php endif; ?> >
                                    </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </fieldset>
                            <fieldset>
                                <legend>Pointage </legend>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><label>Nbr Jour Travalllée</label></td>
                                            <td><input type="text"  id="nbrjourt" placeholder="Nbr de Jour Travaillée" style="text-align: center"
                                                       class="form-control" readonly="true" value="<?php echo $paie->getNbrjtravaille() . " J" ?>"></td>
                                            <td><label>Nbr.J.Absence I.R</label></td>
                                            <td><input type="text"  id="nbrjoura" placeholder="Nbr de Jour Absence"   class="form-control" readonly="true"
                                                       value="<?php
                                                       if ($paie->getNbabscenceir() != ""):
                                                           echo $paie->getNbabscenceir() . " J";
                                                       else:
                                                           echo "0 J";
                                                       endif;
                                                       ?>" ></td>
                                            <td><label>Nbr Jour Congé</label></td>
                                            <td><input type="text"  id="nbrjourc" placeholder="Nbr de Jour Congé"   
                                                       class="form-control" readonly="true"
                                                       value="<?php echo $paie->getNbrjconge() . " J" ?>"></td>
                                            <td><label>Nbr Jour Férier</label></td>
                                            <td><input type="text"  id="nbrjourf" placeholder="Nbr de Jour Férier"   
                                                       class="form-control" readonly="true"
                                                       value="<?php
                                                       if ($paie->getNbrjf() != ""):
                                                           echo $paie->getNbrjf() . " J";
                                                       else:
                                                           echo "0 J";
                                                       endif;
                                                       ?>"> </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>

                            <!--                            <fieldset class="col-lg-12" >
                                                            <legend><i>Donnée Fiscale</i></legend>
                                                            <table>
                                                                <tr>
                                                                <tr>
                                                                    <td style="width:  45%">T.F.P</td>
                                                                    <td  style="width:  5% ; text-align: center">
                            <?php // echo $form['tfp']->renderError()    ?>
                            <?php // echo $form['tfp']       ?>
                            
                                                                    </td>
                                                                    <td  style="width:  45%">Foprolos</td>
                                                                    <td  style="width:  5% ;text-align: center">
                            <?php // echo $form['foprolos']->renderError()    ?>
                            <?php // echo $form['foprolos']       ?>
                            
                                                                    </td>
                                                                </tr>
                                                                </tr>
                                                            </table>
                                                        </fieldset>-->
                            <fieldset class="col-lg-12">
                                <legend><i>Donnée Sociale</i></legend>
                                <table style="width: 100%">

                                    <input type="hidden" id="tauxsociale">
                                    <input type="hidden" id="annuel_tauxsociale">
                                    <input type="hidden" id="netfp">
                                    <input type="hidden" id="imposable">
                                    <input type="hidden" id="pourcentage">
                                    <input type="hidden" id="montantdebutbareme">
                                    <input type="hidden" id="montantfinalbareme">
                                    <tr>
                                    <input type="hidden" id="id_codesociale" >
                                    <td style="width: 10%">Contribution Salariale</td>
                                    <td style="width: 20%;text-align: rigth" > 
                                        <input class="rigth" type="text" id="paie_montantsocialemensuel" value="<?php echo $paie->getMontantsocialemensuel() ?>"  readonly="true">
                                    </td>
                                    <td style="width: 10%">Net Sociale</td>
                                    <td style="width: 20%" class="disabledbutton">
                                        <input type="text"class="rigth" id="paie_netsociale" value="<?php echo $paie->getNetsociale() ?>"  readonly="true">               
                                    </td>
                                    <td style="width: 10%">Salaire  Imposable</td>
                                    <td style="width: 20%" class="disabledbutton">
                                        <input type="text" class="rigth" id="paie_salaireimposable" value="<?php echo $paie->getSalaireimposable() ?>"  readonly="true">               
                                    </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 10%">Abattemet</td>
                                        <td style="width: 20">
                                            <input type="text" class="rigth" id="paie_abattement" value="<?php echo $paie->getAbattement() ?>"  readonly="true">               
                                        </td>
                                        <td style="width: 10%">Abattemet (Frais Professionels)</td>
                                        <td style="width: 20%">
                                            <input type="text" class="rigth" id="paie_abattementfraaisprof" value="<?php echo $paie->getAbattementfraaisprof() ?>"  readonly="true">               
                                        </td>
                                        <td style="width: 10%">Retenue Impôt</td>
                                        <td style="width: 20%">
                                            <input type="text" class="rigth" id="paie_retenueimposable" value="<?php echo $paie->getRetenueimposable() ?>"  readonly="true">               
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="width: 10%"> Salaire Net </td>
                                        <td style="width: 20%">
                                            <input type="text"class="rigth" id="paie_salairenet" value="<?php echo $paie->getSalairenet() ?>"  readonly="true">               
                                        </td>
<!--                                        <td style="width: 10%"> Prime.N.Cot.N.Impo  </td>
                                        <td><input type="text"  id="primenoncotisablenonimpo" placeholder=""   class="form-control" readonly="true"></td>-->
                                        <td style="width: 10%">  Net Â Payer </td>
                                        <td style="width: 20%">
                                            <input type="text" class="rigth" id="paie_netapayyer" value="<?php echo $paie->getNetapayyer() ?>"  readonly="true">               
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </fieldset>
                </div>
                <div class="tab-pane" id="enfants"  ng-init="inititaliserlisteEnfants('<?php echo $paie->getIdAgents() ?>')">
                    <fieldset>
                        <legend>Liste des Enfants</legend>
                        <fieldset>
                            <table id="enfants" class="table  table-bordered table-hover"  > 
                                <thead>
                                    <tr>
                                        <th style="width: 5%">N°ordre</th>
                                        <th style="width: 12%">Nom</th>
                                        <th style="width: 12%">Prénom</th>
                                        <th style="width: 10%">Date Naissance</th>
                                        <th style="width: 7%">Age</th>
                                        <th style="width: 7%">Etudiant</th>
                                        <th style="width: 7%">Boursier</th>
                                        <th style="width: 10%">Rang</th>
                                        <th style="width: 5%">Décè </th>
                                        <th style="width: 10%">Abattement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="lignedocE in listedocsE">
                                        <td style="text-align: center">{{lignedocE.norgdre}}</td>
                                        <td>{{lignedocE.nome}}</td>
                                        <td>{{lignedocE.prenome}}</td>
                                        <td>{{lignedocE.datenai}}</td>
                                        <td>{{lignedocE.age}}</td>
                                        <td style="width: 20px ;text-align: center">
                                            <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="lignedocE.etudiant"></i>
                                            <i class="ace-icon fa fa-square-o bigger-170" ng-if="lignedocE.etudiant == false"></i>
                                        </td>

                                        <td style="width: 20px ;text-align: center">
                                            <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="lignedocE.boursier"></i>
                                            <i class="ace-icon fa fa-square-o bigger-170" ng-if="lignedocE.boursier == false"></i>
                                        </td>
                                        <td>{{lignedocE.deduction}}</td>


                                        <td style="width: 20px ;text-align: center">
                                            <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="lignedocE.dece"></i>
                                            <i class="ace-icon fa fa-square-o bigger-170" ng-if="lignedocE.dece == false"></i>
                                        </td>
                                        <td>{{lignedocE.montant}}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr style="background-color: #F2F2F2;">
                                        <td colspan="2" style="text-align: center; font-size: 16px; vertical-align: middle;">Abattement Enfants</td>
                                        <td colspan="3" class="disabledbutton">
                                            <input type="text"  id="abatement_enfants" placeholder="Abatement Enfant"  class="form-control rigth" value="<?php echo $paie->getAbattementenfant() ?>">
                                        </td>
                                        <td colspan="2" style="text-align: center; font-size: 16px; vertical-align: middle;">Abattement Chef et Enfants</td>
                                        <td colspan="3" class="disabledbutton">
                                            <input type="text"  id="abatement_enfants_parents" placeholder="Abatement Enfant & Parent"  class="form-control rigth" value="<?php echo number_format($paie->getAbattementenfant() + $paie->getAbatementcheffamille(), 3, '.', ' ') ?>">
                                        </td>
                                    </tr>

                                </tfoot>
                            </table>
                        </fieldset>

                        <legend>Liste des Parents Â Charger</legend>
                        <fieldset>
                            <table >

                                <thead>
                                    <tr> 
                                        <th style="width: 5%">N°ordre</th>
                                        <th style="width: 25%">Nom</th>
                                        <th style="width: 25%">Prénom</th>
                                        <th style="width: 20%">Date Naissance</th>
                                        <th style="width: 10%">Décè</th>

                                    </tr>             

                                </thead>
                                <tbody>

                                    <tr id="formligne">
                                        <td style="width: 10px !important">
                                            <input type="text" value="" ng-model="norgdre.text" id="nordre6"  class="form-control  disabledbutton "></td>
                                        <td style="width: 20px"> <input type="text" ng-value=""  id="nom"  autocomplete="off"   placeholder="NOM" ></td>
                                        <td style="width: 20px">  <input type="text" value=""  id="prenom"  class="form-control" placeholder="PRENOM" ></td>
                                        <td style="width: 20px">  <input type="date" value=""  id="daten"  class="form-control" placeholder="Date" ></td>
                                        <td style="width: 20px ; text-align: center">  <input type="checkbox"  id="deceparent" name="check_valide" ></td>



                                    </tr>
                                    <tr ng-repeat="lignedocP in listedocsP">
                                        <td style="text-align: center">{{lignedocP.norgdre}}</td>
                                        <td>{{lignedocP.nom}}</td>
                                        <td>{{lignedocP.prenom}}</td>
                                        <td>{{lignedocP.daten}}</td>

                                        <td style="width: 20px ;text-align: center">
                                            <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="lignedocP.deceparent"></i>
                                            <i class="ace-icon fa fa-square-o bigger-170" ng-if="lignedocP.deceparent == false"></i>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>
                    </fieldset>
                </div>
                <div class="tab-pane" id="primes"  >
                    <legend><i>Liste des Primes </i></legend>
                    <fieldset>
                        <table id="prime" class="table  table-bordered table-hover"  > 
                            <thead>
                                <tr>
                                    <th style="width: 10%">N°</th>
                                    <th style="width: 50%">Prime</th>
                                    <th style="width: 10%">Montant</th>
                                    <th style="width: 10%">Imposable</th>
                                    <th style="width: 10%">Cotisable</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="ligne in listesPrimes" ng-if="ligne.imposable == true && ligne.cotisable == true || ligne.imposable != ligne.cotisable">
                                    <td style="text-align: center">{{ligne.norgdre}}</td>
                                    <td>{{ligne.libelle}}</td>
                                    <td style="text-align: center">{{ligne.montant}}</td>
                                    <td style="width: 20px ;text-align: center">
                                        <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="ligne.imposable"></i>
                                        <i class="ace-icon fa fa-square-o bigger-170" ng-if="ligne.imposable == false"></i>
                                    </td>
                                    <td style="width: 20px ;text-align: center">
                                        <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="ligne.cotisable"></i>
                                        <i class="ace-icon fa fa-square-o bigger-170" ng-if="ligne.cotisable == false"></i>
                                    </td>
                                </tr>

                                <tr style="background-color: #F2F2F2;">
                                    <td style="text-align: center; font-size: 16px; vertical-align: middle;">Salaire De Base</td>
                                    <td class="disabledbutton">  <input type="text"  id="salairedebase" placeholder="Salaire de Base"   class="form-control rigth" value="<?php echo $paie->getSalairedebase() ?>"></td>
                                    <td   style="text-align: center;"> 
                                        <input type="text"  id="totalp" placeholder="T.Primes Cotisable/Imposable"  readonly="true" class="form-control rigth"></td>
                                    <td style="text-align: center; font-size: 16px; vertical-align: middle;">Salaire Brut</td>
                                    <td colspan="2"  style="text-align: center;" class="disabledbutton rigth" >

                                        <?php echo $form['salairebrut']->renderError() ?>
                                        <?php echo $form['salairebrut'] ?>
                                    </td>
                                </tr>
                                <tr ng-repeat="ligne in listesPrimes" ng-if="ligne.imposable == false && ligne.cotisable == false">
                                    <td style="text-align: center">{{ligne.norgdre}}</td>
                                    <td>{{ligne.libelle}}</td>
                                    <td style="text-align: center">{{ligne.montant}}</td>
                                    <td style="width: 20px ;text-align: center">
                                        <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="ligne.imposable"></i>
                                        <i class="ace-icon fa fa-square-o bigger-170" ng-if="ligne.imposable == false"></i>
                                    </td>
                                    <td style="width: 20px ;text-align: center">
                                        <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="ligne.cotisable"></i>
                                        <i class="ace-icon fa fa-square-o bigger-170" ng-if="ligne.cotisable == false"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>

                <div class="tab-pane " id="retenue" ng-init="InitialierListesRetenues(<?php echo $paie->getIdAgents() ?>)" >
                    <fieldset>
                        <legend><i>Liste des Retenues</i></legend>

                        <table>
                            <thead>
                                <tr>  
                                    <th style="width: 20% ;display: none"> Id </th>
                                    <th style="width: 20%"> Type  </th>

                                    <th style="width: 10%">Montant Total </th>
                                    <th style="width: 10%">Nbr Mois</th>
                                    <th style="width: 10%">Montant Mensielle</th>
                                    <th style="width: 10%">Date Début Retenue</th>
                                    <th style="width: 10%">Date Fin Retenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="ligne_a_p_r in ListeRetenue">
                                    <td style="display: none">{{ligne_a_p_r.idd}}</td>
                                    <td>{{ligne_a_p_r.type}}</td>
                                    <td>{{ligne_a_p_r.montanttotal}}</td>
                                    <td>{{ligne_a_p_r.nbrmois}} Mois</td>
                                    <td>{{ligne_a_p_r.montantmensielle}}</td>
                                    <td>{{ligne_a_p_r.datedebut}}</td>
                                    <td>{{ligne_a_p_r.datefin}}</td>

                                </tr>
                            </tbody>
                            <tfoot>
                                <tr style="background-color: #F2F2F2;">
                                    <td colspan="2"></td>
                                    <td colspan="1" style="text-align: center; font-size: 16px; vertical-align: middle;"> Total Retenue</td>
                                    <td colspan="1" class="disabledbutton" style="text-align: right">
                                        <?php echo $form['totalretenue']->renderError() ?>
                                        <?php echo $form['totalretenue'] ?>
                                    </td>
                                    <td colspan="3"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </fieldset>
                </div>
            </div>
            </fieldset>
        </div>
    </div>
</div>


<style>
    .rigth{
        text-align: right;width: 100%
    }
</style>