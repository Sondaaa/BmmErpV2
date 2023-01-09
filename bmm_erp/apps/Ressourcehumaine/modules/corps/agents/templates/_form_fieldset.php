<div id="sf_admin_container"  ng-init="InialiserBtn()">
    <div id="sf_admin_content">
        <div class="row">
            <div class="col-sm-12">
                <span class="text-primary">( * ) : Champ obligatoire.</span>
            </div>
        </div>
        <div  class="panel-body" ng-controller="CtrlRessourcehumaine">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li  class="active"><a href="#home" data-toggle="tab" aria-expanded="true" ng-click="initialChampsPersonnelle();">
                        <i class="green ace-icon fa fa-usb bigger-120"></i>Données de base
                    </a>
                </li>
                <?php if (!$form->getObject()->isNew()) { ?>
                    <li><a id="profileNiveaueducatif" href="#profile" data-toggle="tab" aria-expanded="false" ng-click="initialChampsNiveauxEducatif();">
                            <i class="green ace-icon fa fa-money bigger-120"></i>Niveau Educatif
                        </a>
                    </li>
                    <li><a id="profilesociale" href="#sociale" data-toggle="tab" aria-expanded="false" ng-click="initialChampsSociale();">
                            <i class="green ace-icon fa fa-money bigger-120"></i>      
                            Situation familiale
                        </a>
                    </li>
                <?php } ?>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <fieldset>
                        <div class="col-lg-6">
                            <legend><i> Données de base</i></legend>
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="width: 20%;">
                                            <input type="hidden" id="agents" value="<?php echo $agents->getidagents(); ?> ">
                                            <input type="hidden" id="idagents">
                                            <input type="hidden" id="id_regroupement" value="<?php echo $id_regerouppement; ?>">
                                            <label>Matricule <span class="required">*</span><br>(8 caractères)</label></td>
                                        <td style="width: 30%;"> 
                                            <?php echo $form['idrh']->renderError() ?>
                                            <?php echo $form['idrh'] ?>
                                        </td>
                                        <td style="width: 20%;"><label>CIN <span class="required">*</span></label></td>
                                        <td style="width: 30%;">
                                            <?php echo $form['cin']->renderError() ?>
                                            <?php echo $form['cin'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Nom <span class="required">*</span></label></td>
                                        <td>
                                            <?php echo $form['nomcomplet']->renderError() ?>
                                            <?php echo $form['nomcomplet'] ?>
                                        </td>
                                        <td><label>Prénom  </label></td>
                                        <td>
                                            <?php echo $form['prenom']->renderError() ?>
                                            <?php echo $form['prenom'] ?>
                                        </td>
                                    </tr>
                                    <tr>     
                                        <td><label>Date Naissance <span class="required">*</span></label></td>
                                        <td>
                                            <?php echo $form['datenaissance']->renderError() ?>
                                            <?php echo $form['datenaissance'] ?>
                                        </td>
                                        <td><label>Age <span class="required">*</span></label></td>
                                        <td class="disabledbutton"> 
                                            <!--<input id="age" type="text" placeholder="age" class="disabledbutton" ></td>-->
                                            <?php echo $form['age']->renderError() ?>
                                            <?php echo $form['age'] ?>
                                        </td>
                                    </tr>
                                    <tr>  
                                        <td><label>Lieu Naissance <span class="required">*</span></label></td>
                                        <td>
                                            <?php echo $form['lieun']->renderError() ?>
                                            <?php echo $form['lieun'] ?>
                                        </td> 
                                        <td><label>Sexe <span class="required">*</span></label></td>
                                        <td>
                                            <?php echo $form['id_sexe']->renderError() ?>
                                            <?php echo $form['id_sexe'] ?>
                                        </td>
                                    </tr>
                                    <?php if($_SESSION['dossier_id'] == 1):?>
                                    <tr>
                                        <td><label>Regroupement <span class="required">*</span></label></td>
                                        <td <?php if ($id_regerouppement != ''): ?>class="disabledbutton"<?php endif; ?>>
                                            <?php echo $form['id_regrouppement']->renderError() ?>
                                            <?php echo $form['id_regrouppement'] ?>
                                        </td>
                                        <td><label>Ville <span class="required">*</span></label></td>
                                        <td>
                                            <?php echo $form['id_gouvn']->renderError() ?>
                                            <?php echo $form['id_gouvn'] ?>
                                        </td>   
                                    </tr>
                                    <?php endif;?>
                                    <tr>   
                                        <td><label>Adresse <span class="required">*</span></label></td>
                                        <td colspan="3">
                                            <?php echo $form['adresse']->renderError() ?>
                                            <?php echo $form['adresse'] ?>
                                        </td>  
                                    </tr>
                                    <tr>
                                        <td><label>Situation familiale <span class="required">*</span></label></td>
                                        <td>
                                            <?php echo $form['id_etatcivil']->renderError() ?>
                                            <?php echo $form['id_etatcivil'] ?>
                                        </td>
                                        <?php if($_SESSION['dossier_id'] != 1): ?>
                                        <td><label>Ville <span class="required">*</span></label></td>
                                        <td>
                                            <?php echo $form['id_gouvn']->renderError() ?>
                                            <?php echo $form['id_gouvn'] ?>
                                        </td>  
                                         <?php endif;?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-6">  
                            <legend> <i> Informations supplémentaires </i>
                                <a style="float: right;  <?php if ($form->getObject()->isNew()): ?>display: none<?php endif; ?>" target="_blank" href="<?php echo url_for('agents/ImprimerFicheDonneeBase') . '?id=' . $agents->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                            </legend>
                            <table>
                                <tbody>
                                    <tr>
                                        <td><label>Identifiant carte professionnelle</label> </td> 
                                        <td> <?php echo $form['idpersonnel']->renderError() ?>
                                            <?php echo $form['idpersonnel'] ?>
                                        </td> 
                                        <td><label>Etat mulitaire</label></td> 
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
                                        <td><label>Active </label></td>
                                        <td>
                                            <?php echo $form['active']->renderError() ?>
                                            <?php echo $form['active'] ?>
                                        </td>
                                    </tr>
<!--                                    <tr>
                                        <td><label>Identifiant unique(CNRPS)</label></td>
                                        <td>
                                    <?php // echo $form['idcnss']->renderError() ?>
                                    <?php // echo $form['idcnss'] ?>
                                        </td>
                                        <td><label>Date d'affiliation  </label></td>
                                        <td>
                                    <?php // echo $form['dateaffiliation']->renderError() ?>
                                    <?php // echo $form['dateaffiliation'] ?>
                                        </td>
                                    </tr>-->
                                    <tr>
                                        <td><label>RIP/B</label></td> 
                                        <td>
                                            <?php echo $form['rib']->renderError() ?>
                                            <?php echo $form['rib'] ?>
                                        </td>
                                        <td><label>Type Pérmis </label></td>
                                        <td>
                                            <?php echo $form['id_typepermis']->renderError() ?>
                                            <?php echo $form['id_typepermis'] ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td><label>Niveau Scolaire</label></td> 
                                        <td colspan="3"> <?php echo $form['id_niveaueducatif']->renderError() ?>
                                            <?php echo $form['id_niveaueducatif'] ?>
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td><label>Chef Famille</label></td>
                                        <td>
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

                                </tbody>
                            </table>
                        </div> 
                    </fieldset>        
                </div>
                <?php if (!$form->getObject()->isNew()) { ?>
                    <div class="tab-pane fade" id="profile" ng-init="AfficheLignedocDiplome(<?php echo $agents->getId() ?>);">
                        <fieldset>  
                            <legend style="margin-bottom: 0px;">
                                <i>Informations Educatives</i>
                                <a style="float: right;  <?php if ($form->getObject()->isNew()): ?>display: none<?php endif; ?>" target="_blank" href="<?php echo url_for('agents/ImprimerFicheEducative') . '?id=' . $agents->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
                            </legend>
                            <div class="col-lg-10">
                                <h1>Liste des Diplômes</h1>
                                <table>
                                    <thead>
                                        <tr> <th style="width: 10%">N°ordre</th>
                                            <th style="width: 22%">Diplôme</th>
                                            <th style="width: 20%">Année</th>
                                            <th style="width: 25%">Mention</th>
                                            <th style="width: 10">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="formligne">
                                            <td style="width: 10px !important">
                                                <input type="text" value="" ng-model="norgdre.text" id="nordre1" class="form-control disabledbutton">
                                            </td>
                                            <td style="width: 20px"><?php
                                                $mags = Doctrine_Core::getTable('diplome')->findAll();
                                                ?>
                                                <select id="magd">
                                                    <option></option>
                                                    <?php foreach ($mags as $magd) { ?>
                                                        <option value="<?php echo $magd->getId() ?>"><?php echo $magd ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td> 
                                            <td style="width: 20px">  <input type="date" value="" ng-model="annee.text" id="annee" autocomplete="off"  class="form-control" placeholder="annee" ng-change="()"></td>
                                            <td style="width: 20px"> 
                                                <select id="libelle" name="libelle">
                                                    <option value="T.Bien">T.Bien</option>
                                                    <option value="Bien">Bien</option>
                                                    <option value="Passable">Passable</option>
                                                </select>
                                            </td>
                                            <td style="width: 20px">
                                                <button type="button" class="btn btn-info btn-circle"  ng-click="AjouterLigneDiplome()">+</button>
                                                <button type="button" class="btn btn-warning btn-ci" ng-click="InaliserChampsDiplome()">-</button>
                                            </td>
                                        </tr>
                                        <tr ng-repeat="lignedocD in listedocsD">
                                            <td>{{lignedocD.norgdre}}</td>
                                            <td id="magd_{{lignedocD.norgdre}}">{{lignedocD.magd}}</td>
                                            <td>{{lignedocD.annee}}</td>
                                            <td>{{lignedocD.libelle}}</td>
                                            <td style="width: 20px">
                                                <button type="button" class="btn btn-info btn-circle" ng-click="MisAJourD(lignedocD)"><i class="fa fa-hospital-o"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning btn-circle" ng-click="DeleteD(lignedocD)"><i class="fa fa-times"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table style="width: 18px" align="right"><tbody><tr><td><button type="button" id="btnvalider"  class="btn btn-info" ng-click="valiedeAjout()">valider</button></td></tr></tbody></table>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="col-lg-6" ng-init="AfficheLigneSpecialite(<?php echo $agents->getId() ?>);">
                                <h1>Liste des spécialités</h1>
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">N°ordre</th>
                                            <th style="width: 40%">Spécialité</th>
                                            <th style="width: 20%">Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="formligne">
                                            <td style="width: 10px !important"><input type="text" value="" ng-model="norgdre.text" id="nordre2"  class="form-control disabledbutton"></td>
                                            <td style="width: 40px">
                                                <?php $mags = Doctrine_Core::getTable('specialite')->findAll(); ?>
                                                <select id="mag1">
                                                    <option></option>
                                                    <?php foreach ($mags as $mag1) { ?>
                                                        <option value="<?php echo $mag1->getId() ?>"><?php echo $mag1 ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>    
                                            <td style="width: 40px !important"><input type="text" value="" ng-model="descriptions.text" id="descriptions" autocomplete="off" class="form-control" ></td>

                                            <td style="width: 10px">
                                                <button type="button" class="btn btn-info btn-circle" ng-click="AjouterLigneSpecialite()">+</button>
                                                <button type="button" class="btn btn-warning btn-ci" ng-click="InaliserChampsSpecialite()">-</button>
                                            </td>
                                        </tr>
                                        <tr ng-repeat="lignedocS in listedocsS">
                                            <td>{{lignedocS.norgdre}}</td>
                                            <td id="mag1_{{lignedocS.norgdre}}">{{lignedocS.mag1}}</td>
                                            <td>{{lignedocS.descriptions}}</td>
                                            <td>
                                                <button type="button" class="btn btn-info  btn-circle" ng-click="MisAJourS(lignedocS)"><i class="fa fa-hospital-o"></i></button>
                                                <button type="button" class="btn btn-warning btn-circle" ng-click="DeleteS(lignedocS)"><i class="fa fa-times"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table style="width: 18px"  align="right"><tbody><tr> <td>  <button type="button" id="btnvaliderS" class="btn btn-info" ng-click="valiedeAjoutSpecialite()">valider</button></td></tr></tbody></table>
                            </div>
                            <div class="col-lg-6" ng-init="AfficheLigneLangues(<?php echo $agents->getId() ?>);">
                                <h1>Liste des Langues</h1>
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">N°ordre</th>
                                            <th style="width: 10%">Langue</th>
                                            <th style="width: 30%">Description</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="formligne">
                                            <td style="width: 10px !important"><input type="text" value="" ng-model="norgdre.text" id="nordre3" class="form-control disabledbutton "></td>
                                            <td style="width: 30%">
                                                <?php $mags = Doctrine_Core::getTable('langues')->findAll(); ?>
                                                <select id="mag2">
                                                    <option></option>
                                                    <?php foreach ($mags as $mag2) { ?>
                                                        <option value="<?php echo $mag2->getId() ?>"><?php echo $mag2 ?></option>
                                                    <?php } ?>
                                                </select></td>     
                                            <td style="width: 70px"><input type="text" value="" ng-model="descriptionl.text" id="descriptionl" class="form-control" placeholder="Description" ng-change="()"></td>
                                            <td style="width: 10px">
                                                <button type="button" class="btn btn-info btn-circle"  ng-click="AjouterLigneLangue()">+</button>
                                                <button type="button" class="btn btn-warning btn-ci" ng-click="InaliserChampsLangue()">-</button>
                                            </td>
                                        </tr>
                                        <tr ng-repeat="lignedocL in listedocsL">
                                            <td>{{lignedocL.norgdre}}</td>
                                            <td id="mag2_{{lignedocL.norgdre}}">{{lignedocL.mag2}}</td>
                                            <td>{{lignedocL.descriptionl}}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-circle" ng-click="MisAJourL(lignedocL)"><i class="fa fa-hospital-o"></i></button>
                                                <button type="button" class="btn btn-warning btn-circle" ng-click="DeleteL(lignedocL)"><i class="fa fa-times"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table style="width: 18px" align="right"><tbody><tr><td><button type="button" id="btnvaliderL" class="btn btn-info" ng-click="valiedeAjoutLangue()">valider</button></td></tr></tbody></table>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="col-lg-12" ng-init="AfficheLigneFormations(<?php echo $agents->getId() ?>);">
                                <h1>Formation Continue</h1>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>N°ordre</th>
                                            <th style="width: 15%">Description</th>
                                            <th style="width: 15%">Organistaion</th>
                                            <th style="width: 15%">Durée</th>
                                            <th style="width: 15%">Date</th>
                                            <th style="width: 15%">Type Formation Continue</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="formligne">
                                            <td style="width: 10px !important"><input type="text" value="" ng-model="norgdre.text" id="nordreF" class="form-control disabledbutton"></td>
                                            <td style="width: 150px">  <input type="text" ng-value="" ng-model="description.text" id="description" autocomplete="off" placeholder="Description" ng-change="()"></td>
                                            <td style="width: 150px">  <input type="text" value="" ng-model="organistaion.text" id="organistaion" class="form-control" placeholder="Organistaion" ng-change="()"></td>
                                            <td style="width: 150px">  <input type="text" value="" ng-model="duree.text" id="duree" class="form-control" placeholder="Durèe" ng-change="()"></td>
                                            <td style="width: 150px">  <input type="date" value="" ng-model="date.text" id="date" class="form-control" placeholder="Date" ng-change="()"></td>
                                            <td style="width: 150px">
                                                <?php $mags = Doctrine_Core::getTable('typeexperience')->findAll(); ?>
                                                <select id="mag">
                                                    <option></option>
                                                    <?php foreach ($mags as $mag) { ?>
                                                        <option value="<?php echo $mag->getId() ?>"><?php echo $mag ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>     
                                            <td style="width: 30px">
                                                <button type="button" class="btn btn-info btn-circle" ng-click="AjouterLigneF()">+</button>
                                                <button type="button" class="btn btn-warning btn-ci" ng-click="InaliserChampsF()">-</button>
                                            </td>
                                        </tr>
                                        <tr ng-repeat="lignedocF in listedocsF">
                                            <td>{{lignedocF.norgdre}}</td>
                                            <td>{{lignedocF.description}}</td>
                                            <td>{{lignedocF.organistaion}}</td>
                                            <td>{{lignedocF.duree}}</td>
                                            <td>{{lignedocF.date}}</td>
                                            <td id="mag_{{lignedocF.norgdre}}">{{lignedocF.mag}}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-circle" ng-click="MisAJourF(lignedocF)"><i class="fa fa-hospital-o"></i></button>
                                                <button type="button" class="btn btn-warning btn-circle" ng-click="DeleteF(lignedocF)"><i class="fa fa-times"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table style="width: 18px" align="right"><tbody><tr><td><button type="button" id="btnvaliderF" class="btn btn-info" ng-click="valiedeAjoutFormations()">valider</button></td></tr></tbody></table>
                            </div>
                        </fieldset>
                    </div>

                    <div class="tab-pane fade" id="sociale">
                        <fieldset >
                            <legend style="margin-bottom: 0px;">
                                <i>Informations Sociales</i>
                                <a style="float: right;  <?php if ($form->getObject()->isNew()): ?>display: none<?php endif; ?>" target="_blank" href="<?php echo url_for('agents/ImprimerFicheSociale') . '?id=' . $agents->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
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
                                            <th>Action</th>
                                        </tr>             
                                    </thead>
                                    <tbody>
                                        <tr id="formligne">
                                            <td style="width: 10px !important"><input type="text" value="" ng-model="norgdre.text" id="nordre4" class="form-control disabledbutton"></td>
                                            <td style="width: 20px"><input type="text" ng-value="" ng-model="nomc.text" id="nomc" autocomplete="off" placeholder="NOM" ng-change=""></td>
                                            <td style="width: 20px"><input type="text" value="" ng-model="prenomc.text" id="prenomc" class="form-control" placeholder="PRENOM" ng-change=""></td>
                                            <td style="width: 20px;text-align: center"><input type="checkbox" value="" ng-model="etattravail.text" id="etattravail" ng-value="true" ng-true-value='true' ng-false-value='false' ng-change="change();"></td>
                                            <td style="width: 100px">
                                                <button type="button" class="btn btn-info btn-circle"  ng-click="AjouterLigneConjoints()">+</button>
                                                <button type="button" class="btn btn-warning btn-ci" ng-click="InaliserChampsConjoints()">-</button>
                                            </td>
                                        </tr>
                                        <tr ng-repeat="lignedocC in listedocsC" ><!--ng-click="cbClicked(etattravail)"-->
                                            <td>{{lignedocC.norgdre}}</td>
                                            <td>{{lignedocC.nomc}}</td>
                                            <td>{{lignedocC.prenomc}}</td>
                                            <td>{{lignedocC.etattravail}}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-circle" ng-click="MisAJourC(lignedocC)"><i class="fa fa-hospital-o"></i></button>
                                                <button type="button" class="btn btn-warning btn-circle" ng-click="DeleteC(lignedocC)"><i class="fa fa-times"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table style="width: 18px" align="right"><tbody><tr><td><button type="button" id="btnvaliderC" class="btn btn-info" ng-click="valiedeAjoutConjoint()">valider</button></td></tr></tbody></table>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="col-lg-12" ng-init="AfficheLigneEnfants(<?php echo $agents->getId() ?>);">
                                <h1>Liste des Enfants à charge</h1>
                                <table>
                                    <thead>
                                        <tr> <th style="width: 4%">N°ordre</th>
                                            <th style="width: 11%">Nom</th>
                                            <th style="width: 11%">Prénom</th>
                                            <th style="width: 7%">Date Naissance</th>
                                            <th style="width: 4%">Age</th>
                                            <th style="width: 6%">Etudiant</th>
                                            <th style="width: 6%">Boursier</th>
                                            <th style="width: 28%">Rang</th>
                                            <th style="width: 4%">Décè </th>
                                            <th style="width: 9%">Action</th>
                                        </tr>             
                                    </thead>
                                    <tbody>
                                        <tr id="formligne">
                                            <td><input type="text" value="" ng-model="norgdre.text" id="nordre5"  class="form-control disabledbutton" ></td>
                                            <td><input type="text" ng-value="" ng-model="nome.text" id="nome"  autocomplete="off"   placeholder="NOM" ng-change=""></td>
                                            <td><input type="text" value="" ng-model="prenome.text" id="prenome"  class="form-control" placeholder="PRENOM" ng-change=""></td>
                                            <td><input type="date" value="" ng-model="datenai.text" id="datenai"  class="form-control" placeholder="Date"></td>
                                            <td><input type="text" value="" ng-model="age.text" id="age"  class="form-control" placeholder="Age" ng-change="()"></td>
                                            <td style="text-align: center"><input type="checkbox" value="" id="etudiant"  ></td>
                                            <td style="text-align: center"><input type="checkbox" value=""  id="boursier"  ></td>
                                            <td>
                                                <?php $mags = Doctrine_Core::getTable('deductioncommune')->findAll(); ?>
                                                <select id="deduction">
                                                    <option></option>
                                                    <?php foreach ($mags as $mag) { ?>
                                                        <option value="<?php echo $mag->getId() ?>"><?php echo $mag ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>    
                                            <td style="text-align: center"><input type="checkbox" value="" ng-model="dece.text" id="dece" ng-value="true" ng-true-value='true' ng-false-value='false' ng-change="change();"></td>
                                            <td style="text-align: center;">
                                                <button type="button" id="btnajoutE" class="btn btn-info btn-circle"  ng-click="AjouterLigneEnfants()">+</button>
                                                <button type="button" class="btn btn-warning btn-ci" ng-click="InaliserChampsEnfants()">-</button>
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
                                                <button type="button" class="btn btn-info btn-circle" ng-click="MisAJourE(lignedocE)"><i class="fa fa-hospital-o"></i></button>
                                                <!-- class="btn btn-info btn-circle" -->
                                                <button type="button" class="btn btn-warning btn-circle" ng-click="DeleteE(lignedocE)"><i class="fa fa-times"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table style="width: 18px"  align="right">
                                    <tbody>
                                        <tr> 
                                            <td><button type="button" id="btnvaliderE" class="btn btn-info" ng-click="validerAjoutEnfants()">valider</button></td>
                                            <td><button type="button" id="btnvaliderScan" class="btn btn-info" ng-click="scan()">Scan</button></td>
                                        </tr>
                                    </tbody>
                                </table>
    <!--                                <table style="width: 18px"  align="right">
                                    <td style="width: 18px">
                                <?php // echo $form['photo']->renderError() ?>
                                <?php // echo $form['photo'] ?>
                                    </td>
                                </table>-->
                            </div>
                            <div class="col-lg-8" ng-init="AfficheLigneParents(<?php echo $agents->getId() ?>);"> 
                                <h1>Liste des Parents à charge</h1>
                                <table>
                                    <thead>
                                        <tr>  <tr>
                                            <th style="width: 10%">N°ordre</th>
                                            <th style="width: 25%">Nom</th>
                                            <th style="width: 25%">Prénom</th>
                                            <th style="width: 25%">Date Naissance</th>
                                            <th>Action</th>
                                        </tr>             
                                    </thead>
                                    <tbody>
                                        <tr id="formligne">
                                            <td style="width: 10px !important">
                                                <input type="text" value="" ng-model="norgdre.text" id="nordre6"  class="form-control  disabledbutton "></td>
                                            <td style="width: 20px"> <input type="text" ng-value="" ng-model="nom.text" id="nom"  autocomplete="off"   placeholder="NOM" ng-change=""></td>
                                            <td style="width: 20px">  <input type="text" value="" ng-model="prenom.text" id="prenom"  class="form-control" placeholder="PRENOM" ng-change=""></td>
                                            <td style="width: 20px">  <input type="date" value="" ng-model="daten.text" id="daten"  class="form-control" placeholder="Date" ng-change="()"></td>

                                            <td style="width: 100px">
                                                <button type="button" class="btn btn-info btn-circle"  ng-click="AjouterLigneParents()">+</button>
                                                <button type="button" class="btn btn-warning btn-ci" ng-click="InaliserChampsParents()">-</button>
                                            </td>
                                        </tr>
                                        <tr ng-repeat="lignedocP in listedocsP">
                                            <td>{{lignedocP.norgdre}}</td>
                                            <td>{{lignedocP.nom}}</td>
                                            <td>{{lignedocP.prenom}}</td>
                                            <td>{{lignedocP.daten}}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-circle" ng-click="MisAJourP(lignedocP)"><i class="fa fa-hospital-o"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning btn-circle" ng-click="DeleteP(lignedocP)"><i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table  style="width: 18px"  align="right">
                                    <tbody>
                                        <tr> 
                                            <td> 
                                                <button type="button" id="btnvaliderP"  class="btn btn-info" ng-click="valiedeAjoutParents()">valider</button>
                                            </td> 
                                        </tr> 
                                    </tbody>   
                                </table>
                            </div>
                        </fieldset>
                    </div>
                <?php } ?>
            </div>
        </div>  
    </div>      
</div>

<script  type="text/javascript">
            $(document).ready(function () {

    $('#autoristation_moyen option').each(function () {
    if ($(this).text().trim() == $('#moyendetransport').val().trim()){
    $(this).attr('selected', 'selected');
    }
    });
//            $('#agents_id_regrouppement option').each(function () {
//    if ($(this).text().trim() == $('#id_regroupement').val().trim()) {
//    $(this).attr('selected', 'selected');
//    }
//    });
    });
            $("#agents_idrh").attr('maxlength', '8');
//    $(document).ready(function () {
//    $('#agents_id_regrouppement option[value=' + $('#id_regroupement').val() + ']').attr('selected', 'selected');
//            $('#agents_id_regrouppement').trigger("chosen:updated");
//    });
//    })

</script>