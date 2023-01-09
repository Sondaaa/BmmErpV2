<div id="sf_admin_container" ng-init="InialiserBtn()">
    <div id="sf_admin_content">  
        <div  class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#home" data-toggle="tab" aria-expanded="true" ng-click="initialChampsPersonnelle();">
                        <i class="green ace-icon fa fa-usb bigger-120"></i> Données de Base
                    </a>
                </li>
                <li>
                    <a id="profileNiveaueducatif" href="#profile" data-toggle="tab" aria-expanded="false" ng-click="initialChampsNiveauxEducatif();">
                        <i class="green ace-icon fa fa-money bigger-120"></i> Niveau Educatif
                    </a>
                </li>
                <li>
                    <a id="profilesociale" href="#sociale" data-toggle="tab" aria-expanded="false" ng-click="initialChampsSociale();">
                        <i class="green ace-icon fa fa-money bigger-120"></i> Situation Familiale
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <fieldset>
                        <div class="col-lg-6">
                            <legend>
                                <i>Données de Base</i>
                            </legend>
                            <input type="hidden" id="agents" value="<?php echo $agents->getidagents(); ?>">
                            <input type="hidden" id="idagents">
                            <table class="disabledbutton">
                                <tbody>
                                    <tr>
                                        <td><label>Matricule</label></td>
                                        <td> 
                                            <?php echo $form['idrh']->renderError() ?>
                                            <?php echo $form['idrh'] ?>
                                        </td>
                                        <td><label>CIN</label></td>
                                        <td>
                                            <?php echo $form['cin']->renderError() ?>
                                            <?php echo $form['cin'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Nom</label></td>
                                        <td>
                                            <?php echo $form['nomcomplet']->renderError() ?>
                                            <?php echo $form['nomcomplet'] ?>
                                        </td>
                                        <td><label>Prénom </label></td>
                                        <td>
                                            <?php echo $form['prenom']->renderError() ?>
                                            <?php echo $form['prenom'] ?>
                                        </td>
                                    </tr>
                                    <tr> 
                                        <td><label>Date Naissance</label></td>
                                        <td>
                                            <?php echo $form['datenaissance']->renderError() ?>
                                            <?php echo $form['datenaissance'] ?>
                                        </td>
                                        <td><label>Age</label></td>
                                        <td class="disabledbutton">
                                            <?php echo $form['age']->renderError() ?>
                                            <?php echo $form['age'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Lieu Naissance</label></td>
                                        <td>
                                            <?php echo $form['lieun']->renderError() ?>
                                            <?php echo $form['lieun'] ?>
                                        </td> 
                                        <td><label> Sexe</label></td>
                                        <td>
                                            <?php echo $form['id_sexe']->renderError() ?>
                                            <?php echo $form['id_sexe'] ?>
                                        </td>
                                    </tr>
                                    <tr>   
                                        <td><label> Adresse </label></td>
                                        <td>
                                            <?php echo $form['adresse']->renderError() ?>
                                            <?php echo $form['adresse'] ?>
                                        </td>  
                                        <td><label> Regroupement </label></td>
                                        <td>
                                            <?php echo $form['id_regrouppement']->renderError() ?>
                                            <?php echo $form['id_regrouppement'] ?>
                                        </td>  
                                    </tr>
                                    <tr>
                                        <td><label> Ville </label></td>
                                        <td>
                                            <?php echo $form['id_gouvn']->renderError() ?>
                                            <?php echo $form['id_gouvn'] ?>
                                        </td>   
                                        <td><label> Situation familiale</label></td>
                                        <td>
                                            <?php echo $form['id_etatcivil']->renderError() ?>
                                            <?php echo $form['id_etatcivil'] ?>
                                        </td>   
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <legend>
                                <i>Informations Supplémentaires</i>
                                <a style="float: right;" target="_blank" href="<?php echo url_for('agents/ImprimerFicheDonneeBase') . '?id=' . $agents->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                            </legend>
                            <table class="disabledbutton">
                                <tbody>
                                    <tr>
                                        <td><label>Identifiant carte professionnelle</label> </td> 
                                        <td>
                                            <?php echo $form['idpersonnel']->renderError() ?>
                                            <?php echo $form['idpersonnel'] ?>
                                        </td> 
                                        <td><label>Etat militaire</label></td> 
                                        <td> 
                                            <?php echo $form['etatmulitaire']->renderError() ?>
                                            <?php echo $form['etatmulitaire'] ?>
                                        </td>
                                    </tr>
                                    <tr>    
                                        <td><label> Code Postal</label></td>
                                        <td>
                                            <?php echo $form['codepostal']->renderError() ?>
                                            <?php echo $form['codepostal'] ?>
                                        </td> 
                                        <td><label> Pays </label></td>
                                        <td>
                                            <?php echo $form['id_pays']->renderError() ?>
                                            <?php echo $form['id_pays'] ?>
                                        </td>    
                                    </tr>
                                    <tr>
                                        <td><label> GSM</label></td>
                                        <td>
                                            <?php echo $form['gsm']->renderError() ?>
                                            <?php echo $form['gsm'] ?>
                                        </td>  
                                        <td><label>Identifiant unique(CNRPS)</label></td>
                                        <td>
                                            <?php echo $form['idcnss']->renderError() ?>
                                            <?php echo $form['idcnss'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Date d'affiliation  </label></td>
                                        <td>
                                            <?php echo $form['dateaffiliation']->renderError() ?>
                                            <?php echo $form['dateaffiliation'] ?>
                                        </td>
                                        <td><label>RIP/B</label></td> 
                                        <td>
                                            <?php echo $form['rib']->renderError() ?>
                                            <?php echo $form['rib'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Niveau Scolaire</label></td> 
                                        <td> <?php echo $form['id_niveaueducatif']->renderError() ?>
                                            <?php echo $form['id_niveaueducatif'] ?>
                                        </td>
                                        <td><label>Chef Famille</label></td>
                                        <td>
                                            <?php echo $form['cheffamille']->renderError() ?>
                                            <?php echo $form['cheffamille'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Nombres d'enfants</label></td>
                                        <td>
                                            <?php echo $form['nbrenfants']->renderError() ?>
                                            <?php echo $form['nbrenfants'] ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                    </fieldset>
                </div>

                <div class="tab-pane fade" id="profile" ng-init="AfficheLignedocDiplome(<?php echo $agents->getId() ?>);">
                    <fieldset>
                        <legend style="margin-bottom: 0px;">
                            <i>Informations Educatives</i>
                            <a style="float: right;" target="_blank" href="<?php echo url_for('agents/ImprimerFicheEducative') . '?id=' . $agents->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                        </legend>
                        <div class="col-lg-10">
                            <h1>Liste des Diplômes</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 10%">N°ordre</th>
                                        <th style="width: 22%">Diplôme</th>
                                        <th style="width: 20%">Année</th>
                                        <th style="width: 25%">Mention</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="lignedocD in listedocsD">
                                        <td>{{lignedocD.norgdre}}</td>
                                        <td id="magd_{{lignedocD.norgdre}}">{{lignedocD.magd}}</td>
                                        <td>{{lignedocD.annee}}</td>
                                        <td>{{lignedocD.libelle}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="col-lg-6" ng-init="AfficheLigneSpecialite(<?php echo $agents->getId() ?>);">
                            <h1>Liste des Spécialités</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 5%">N°ordre</th>
                                        <th style="width: 40%">Spécialité</th>
                                        <th style="width: 30%">Description</th>
                                    </tr>             
                                </thead>
                                <tbody>
                                    <tr ng-repeat="lignedocS in listedocsS">
                                        <td>{{lignedocS.norgdre}}</td>
                                        <td id="mag1_{{lignedocS.norgdre}}">{{lignedocS.mag1}}</td>
                                        <td>{{lignedocS.descriptions}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" ng-init="AfficheLigneLangues(<?php echo $agents->getId() ?>);">
                            <h1>Liste des Langues</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 5%">N°ordre</th>
                                        <th style="width: 20%">Langue</th>
                                        <th style="width: 30%">Description</th>
                                    </tr>             
                                </thead>
                                <tbody>
                                    <tr ng-repeat="lignedocL in listedocsL">
                                        <td>{{lignedocL.norgdre}}</td>
                                        <td id="mag2_{{lignedocL.norgdre}}">{{lignedocL.mag2}}</td>
                                        <td>{{lignedocL.descriptionl}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="col-lg-12" ng-init="AfficheLigneFormations(<?php echo $agents->getId() ?>);">
                            <h1>Formation Continue</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 5%">N°ordre</th>
                                        <th style="width: 15%">Description</th>
                                        <th style="width: 15%">Organistaion</th>
                                        <th style="width: 15%">Durée</th>
                                        <th style="width: 15%">Date</th>
                                        <th style="width: 15%">Type Formation Continue</th>
                                    </tr>             
                                </thead>
                                <tbody>
                                    <tr ng-repeat="lignedocF in listedocsF">
                                        <td>{{lignedocF.norgdre}}</td>
                                        <td>{{lignedocF.description}}</td>
                                        <td>{{lignedocF.organistaion}}</td>
                                        <td>{{lignedocF.duree}}</td>
                                        <td>{{lignedocF.date}}</td>
                                        <td id="mag_{{lignedocF.norgdre}}">{{lignedocF.mag}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </div>

                <div class="tab-pane fade" id="sociale">
                    <fieldset>
                        <legend style="margin-bottom: 0px;">
                            <i>Informations Sociales</i>
                            <a style="float: right;" target="_blank" href="<?php echo url_for('agents/ImprimerFicheSociale') . '?id=' . $agents->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                        </legend>
                        <div class="col-lg-6" ng-init="AfficheLigneConjoints(<?php echo $agents->getId() ?>);">
                            <h1> Conjoint</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 10%">N°ordre</th>
                                        <th style="width: 20%">Nom</th>
                                        <th style="width: 20%">Prénom</th>
                                        <th style="width: 20%">Etat de travail</th>
                                    </tr>             
                                </thead>
                                <tbody>
                                    <tr ng-repeat="lignedocC in listedocsC" ><!--ng-click="cbClicked(etattravail)"-->
                                        <td>{{lignedocC.norgdre}}</td>
                                        <td>{{lignedocC.nomc}}</td>
                                        <td>{{lignedocC.prenomc}}</td>
                                        <td>{{lignedocC.etattravail}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="col-lg-12" ng-init="AfficheLigneEnfants(<?php echo $agents->getId() ?>);">
                            <h1>Liste des Enfants en Charge</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 10%">N°ordre</th>
                                        <th style="width: 20%">Nom</th>
                                        <th style="width: 20%">Prénom</th>
                                        <th style="width: 20%">Date Naissance</th>
                                        <th style="width: 20%">Age</th>
                                    </tr>             
                                </thead>
                                <tbody>
                                    <tr ng-repeat="lignedocE in listedocsE">
                                        <td>{{lignedocE.norgdre}}</td>
                                        <td>{{lignedocE.nome}}</td>
                                        <td>{{lignedocE.prenome}}</td>
                                        <td>{{lignedocE.datenai}}</td>
                                        <td>{{lignedocE.datema}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-8" ng-init="AfficheLigneParents(<?php echo $agents->getId() ?>);"> 
                            <h1>Liste des Parents en Charge</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 10%">N°ordre</th>
                                        <th style="width: 25%">Nom</th>
                                        <th style="width: 25%">Prénom</th>
                                        <th style="width: 25%">Date Naissance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="lignedocP in listedocsP">
                                        <td>{{lignedocP.norgdre}}</td>
                                        <td>{{lignedocP.nom}}</td>
                                        <td>{{lignedocP.prenom}}</td>
                                        <td>{{lignedocP.daten}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>  
    </div>      
</div>