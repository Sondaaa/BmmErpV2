
<div id="sf_admin_container" ng-init="InialiserBtn()" >


    <div id="sf_admin_content">  
        <div  class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li  class="active"><a href="#home" data-toggle="tab" aria-expanded="true" ng-click="initialChampsPersonnelle();">
                        <i class="green ace-icon fa fa-usb bigger-120"></i>Données de base
                    </a>
                </li>
                <li><a  id="profilesociale" href="#sociale" data-toggle="tab" aria-expanded="false"  ng-click="initialChampsSociale();">
                        <i class="green ace-icon fa fa-money bigger-120"></i>      
                        Situation familiale
                    </a>
                </li>
            </ul>



            <div class="tab-content">  
                <div class="tab-pane fade active in" id="home">
                    <fieldset >
                        <div class="col-lg-6"> <legend><i> Données de base</i></legend>
                            <input type="hidden" id="agents"  value="<?php echo $agents->getId(); ?> ">

                            <table>
                                <tbody>
                                    <tr>
                                <input type="hidden" id="idagents">
                                <td><label>Matricule</label></td>

                                <td class="disabledbutton"> 
                                    <?php echo $form['idrh']->renderError() ?>
                                    <?php echo $form['idrh'] ?>
                                </td>

                                <td><label>CIN</label></td>
                                <td class="disabledbutton">
                                    <?php echo $form['cin']->renderError() ?>
                                    <?php echo $form['cin'] ?>

                                </td>
                                </tr>
                                <tr>
                                    <td><label>Nom </label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['nomcomplet']->renderError() ?>
                                        <?php echo $form['nomcomplet'] ?>
                                    </td>
                                    <td><label>Prénom </label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['prenom']->renderError() ?>
                                        <?php echo $form['prenom'] ?>
                                    </td></tr>
                                <tr>      <td><label>Date Naissance</label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['datenaissance']->renderError() ?>
                                        <?php echo $form['datenaissance'] ?>
                                    </td> <td><label> Age</label></td>
                                    <td class="disabledbutton"> 
                                        <!--<input id="age" type="text"  placeholder="age" class="disabledbutton" ></td>-->
                                        <?php echo $form['age']->renderError() ?>
                                        <?php echo $form['age'] ?>
                                    </td>
                                </tr> <tr>    <td><label>Lieu Naissacance</label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['lieun']->renderError() ?>
                                        <?php echo $form['lieun'] ?>
                                    </td> 
                                    <td><label> Sexe</label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['id_sexe']->renderError() ?>
                                        <?php echo $form['id_sexe'] ?>
                                    </td>
                                </tr><tr>   
                                    <td><label> Adresse </label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['adresse']->renderError() ?>
                                        <?php echo $form['adresse'] ?>
                                    </td>  
                                    <td><label> Regroupement </label></td>
                                    <td >
                                        <?php echo $form['id_regrouppement']->renderError() ?>
                                        <?php echo $form['id_regrouppement'] ?>
                                    </td>  
                                </tr>
                                <tr>  
                                    <td><label> Ville </label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['id_gouvn']->renderError() ?>
                                        <?php echo $form['id_gouvn'] ?>
                                    </td>   
                                    <td><label> Situation familiale</label></td>
                                    <td class="disabledbutton">
                                        <?php echo $form['id_etatcivil']->renderError() ?>
                                        <?php echo $form['id_etatcivil'] ?>
                                    </td>   

                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-6">  
                            <legend>
                                <i> Informations supplémentaires </i>
                            </legend>
                            <table>
                                <tbody>
                                    <tr>
                                        <td><label>Identifiant carte professionnelle</label> </td> 
                                        <td class="disabledbutton">
                                            <?php echo $form['idpersonnel']->renderError() ?>
                                            <?php echo $form['idpersonnel'] ?></td> 

                                        <td>     <label>Etat mulitaire</label></td> 

                                        <td class="disabledbutton"> 
                                            <?php echo $form['etatmulitaire']->renderError() ?>
                                            <?php echo $form['etatmulitaire'] ?>

                                        </td>
                                    </tr>
                                    <tr>    
                                        <td><label> Code Postal</label></td>
                                        <td class="disabledbutton">
                                            <?php echo $form['codepostal']->renderError() ?>
                                            <?php echo $form['codepostal'] ?>
                                        </td> 

                                        <td><label> Pays </label></td>
                                        <td class="disabledbutton">
                                            <?php echo $form['id_pays']->renderError() ?>
                                            <?php echo $form['id_pays'] ?>
                                        </td>    
                                    </tr>
                                    <tr>
                                        <td><label> GSM</label></td>
                                        <td class="disabledbutton">
                                            <?php echo $form['gsm']->renderError() ?>
                                            <?php echo $form['gsm'] ?>
                                        </td>  
<!--                                        <td><label>Code Sociale </label></td>
                                        <td>
                                        <?php // echo $form['id_codesociale']->renderError() ?>
                                        <?php // echo $form['id_codesociale'] ?>
                                        </td>-->
                                        <td><label>RIP/B</label></td> 
                                        <td>
                                            <?php echo $form['rib']->renderError() ?>
                                            <?php echo $form['rib'] ?></td>
                                    </tr>
<!--                                    <tr>

                                        <td><label>Identifiant unique(CNRPS)</label></td>
                                        <td >
                                    <?php // echo $form['idcnss']->renderError() ?>
                                    <?php // echo $form['idcnss'] ?>
                                        </td>
                                        <td><label>Date d'affiliation  </label></td>
                                        <td>
                                    <?php // echo $form['dateaffiliation']->renderError() ?>
                                    <?php // echo $form['dateaffiliation'] ?></td>
                                    </tr>-->
                                    <tr>


                                        <td><label>Niveau Scolaire</label></td> 
                                        <td class="disabledbutton"> 
                                            <?php echo $form['id_niveaueducatif']->renderError() ?>
                                            <?php echo $form['id_niveaueducatif'] ?>
                                        </td> 
                                        <td><label>Type Pérmis </label></td>
                                        <td class="disabledbutton">
                                            <?php echo $form['id_typepermis']->renderError() ?>
                                            <?php echo $form['id_typepermis'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Chef Famille</label></td>
                                        <td >
                                            <?php echo $form['cheffamille']->renderError() ?>
                                            <?php echo $form['cheffamille'] ?>
                                        </td>
                                        <td><label>Nombres d'enfants</label></td>
                                        <td>
                                            <?php echo $form['nbrenfants']->renderError() ?>
                                            <?php echo $form['nbrenfants'] ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label>Motif d'Absence</label></td>
                                        <td>
                                            <?php echo $form['id_motifabsence']->renderError() ?>
                                            <?php echo $form['id_motifabsence'] ?>
                                        </td>
                                        <td><label>Date Sortie </label></td>
                                        <td>
                                            <?php echo $form['datesortie']->renderError() ?>
                                            <?php echo $form['datesortie'] ?>
                                        </td>

                                    </tr>
                                    <tr>

                                        <td><label>Active </label></td>
                                        <td>
                                            <?php echo $form['active']->renderError() ?>
                                            <?php echo $form['active'] ?>
                                        </td>

                                    </tr>
                                </tbody></table>
                        </div> 
                    </fieldset>        

                </div>
                <?php if (!$form->getObject()->isNew()) { ?>


                    <div class="tab-pane  fade" id="sociale">
                        <fieldset >

                            <legend style="margin-bottom: 0px;">
                                <i>Informations Sociales</i>
                            </legend>

                        </fieldset>
                        <fieldset>
                            <div class="col-lg-12" ng-init="AfficheLigneEnfants(<?php echo $agents->getId() ?>);">

                                <h1>Liste des Enfants à charge</h1>
                                <table>
                                    <thead>
                                        <tr> <th style="width: 5%">N°ordre</th>
                                            <th style="width: 12%">Nom</th>
                                            <th style="width: 12%">Prénom</th>
                                            <th style="width: 10%">Date Naissance</th>
                                            <th style="width: 7%">Age</th>
                                            <th style="width: 7%">Etudiant</th>
                                            <th style="width: 7%">Boursier</th>
                                            <th style="width: 10%">Rang</th>
                                            <th style="width: 5%">Décè </th>
                                            <th style="width: 10%">Action</th>

                                        </tr>             

                                    </thead>
                                    <tbody>

                                        <tr id="formligne">
                                            <td style="width: 10px !important"><input type="text" value="" ng-model="norgdre.text" id="nordre5"  class="form-control disabledbutton" ></td>
                                            <td style="width: 30px" > <input type="text" ng-value="" ng-model="nome.text" id="nome"  autocomplete="off"   placeholder="NOM" ></td>
                                            <td style="width: 30px" >  <input type="text" value="" ng-model="prenome.text" id="prenome"  class="form-control" placeholder="PRENOM" ></td>
                                            <td style="width: 30px">  <input type="date" value="" ng-model="datenai.text" id="datenai"  class="form-control" placeholder="Date"></td>
                                            <td style="width: 30px">  <input type="text" value="" ng-model="age.text" id="age"  class="form-control" placeholder="Age"  readonly="true"></td>
                                            <td style="width: 20px ; text-align: center">  <input type="checkbox" value="" id="etudiant"  ></td>
                                            <td style="width: 20px ; text-align: center">  <input type="checkbox" value=""  id="boursier"  ></td>

                                            <td style="width: 150px"><?php
                                                $mags = Doctrine_Core::getTable('deductioncommune')->findAll();
                                                ?>
                                                <select id="deduction">
                                                    <option></option>
                                                    <?php foreach ($mags as $mag) { ?>
                                                        <option value="<?php echo $mag->getId() ?>"><?php echo $mag ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>    
                                            <td style="width: 20px ; text-align: center">  <input type="checkbox" value="" ng-model="dece.text" id="dece"  ng-value="true" ng-true-value='true' ng-false-value='false' ng-change="change();" ></td>


                                            <td style="width: 60px">
                                                <button type="button" id="btnajoutE" class=" btn btn-info  btn-circle btn-sm"  ng-click="AjouterLigneEnfants()">+</button>
                                                <button type="button" class="btn btn-warning btn-circle btn-sm" ng-click="InaliserChampsEnfants()">-</button>
                                            </td>

                                        </tr>
                                        <tr ng-repeat="lignedocE in listedocsE">
                                            <td>{{lignedocE.norgdre}}</td>
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

                                            <td>
                                                <button type="button" class="btn btn-info btn-circle btn-sm" ng-click="MisAJourE(lignedocE)"><i class="fa fa-hospital-o"></i>
                                                </button>
                                                <!-- class="btn btn-info btn-circle" -->
                                                <button type="button" class="btn btn-warning btn-circle btn-sm" ng-click="DeleteE(lignedocE)"><i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table style="width: 18px"  align="right">
                                    <tbody>
                                        <tr> 
                                            <td>  <button type="button" id="btnvaliderE"  class="btn btn-info" ng-click="validerAjoutEnfants()">valider</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                            <div class="col-lg-8" ng-init="AfficheLigneParents('<?php echo $agents->getId() ?>');"> 

                                <h1>Liste des Parents à charge</h1>


                                <table >

                                    <thead>
                                        <tr> 
                                            <th style="width: 5%">N°ordre</th>
                                            <th style="width: 25%">Nom</th>
                                            <th style="width: 25%">Prénom</th>
                                            <th style="width: 20%">Date Naissance</th>
                                            <th style="width: 10%">Décè</th>
                                            <th style="width: 15%">Action</th>
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


                                            <td style="width: 100px">
                                                <button type="button" class="btn btn-info btn-circle btn-sm"  ng-click="AjouterLigneParents()">+</button>
                                                <button type="button" class="btn btn-warning btn-circle btn-sm" ng-click="InaliserChampsParents()">-</button>
                                            </td>
                                        </tr>
                                        <tr ng-repeat="lignedocP in listedocsP">
                                            <td>{{lignedocP.norgdre}}</td>
                                            <td>{{lignedocP.nom}}</td>
                                            <td>{{lignedocP.prenom}}</td>
                                            <td>{{lignedocP.daten}}</td>

                                            <td style="width: 20px ;text-align: center">
                                                <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="lignedocP.deceparent"></i>
                                                <i class="ace-icon fa fa-square-o bigger-170" ng-if="lignedocP.deceparent == false"></i>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm btn-circle" ng-click="MisAJourP(lignedocP)"><i class="fa fa-hospital-o"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning btn-sm btn-circle" ng-click="DeleteP(lignedocP)"><i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table  style="width: 18px"  align="right">
                                    <tbody>
                                        <tr> 
                                            <td> 
                                                <button type="button" id="btnvaliderP"  class="btn btn-info" ng-click="valiedeAjoutParents(<?php echo $agents->getId() ?>)">valider</button>
                                            </td> 
                                        </tr> 
                                    </tbody>   
                                </table>
                            </div>
                        </fieldset>
                    </div>


                </div>
            <?php } ?>
        </div>
    </div>  
</div>      
</div>


