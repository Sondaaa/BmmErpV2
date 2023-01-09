<div id="sf_admin_container">
    <h1 id="replacediv"> Dossier Paie 
        <small>
            <i class="ace-icassurancehouralpaieon fa fa-angle-double-right"></i> 
            <?php if ($dossier->getCode() != null && $dossier->getCode() != ''): ?>
                Modifier Dossier  : <?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonSociale(); ?>
            <?php else: ?>
                Modifier Dossier  : <?php echo $dossier->getRaisonSociale(); ?>
            <?php endif; ?>
        </small>
    </h1>
</div>

<div class="row" ng-controller="CtrlPaie" ng-init="InialiserChampsSelect()">
    <div class="col-sm-12">
        <div id="accordion" class="accordion-style2">
            <div class="group">
                <h3 class="accordion-header" ng-click="InialiserChampsSelect()">Données de base</h3>
                <div>
                    <table>
                        <tr>
                            <td>
                                <input type="hidden" id="id_dossier" value="<?php echo $dossier->getId(); ?>"
                                       <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Code  :</label>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Raison Sociale  :</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"> Année   :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mws-form-row">
                                    <input placeholder="Code dossier " value="<?php echo $dossier->getCode(); ?>" class="large input-mask-code" id="code" type="text"  maxlength="3"  readonly="true">
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row" style="margin-left: 0%">
                                        <input value="<?php echo $dossier->getRaisonSociale(); ?>" id="raison_sociale" type="text" readonly="true" >
                                    </div>
                                </div>
                            </td>
                            <td class="disabledbutton">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <select id="exercice" class="mws-select2 large" onchange="setMinMaxDate()">
                                            <option value=""></option>
                                            <?php foreach ($exercices as $exercice): ?>
                                                <option <?php if ($dossier->getIdExercice() == $exercice->getId()): ?> selected="true" <?php endif; ?> value="<?php echo $exercice->getId() ?>" annee="<?php echo date('Y', strtotime($exercice->getDateDebut())) ?>"><?php echo $exercice->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Date Création Entreprise  :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Matricule Fiscale  :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Registre de Commerce :</label>
                                    </div>
                                </div>
                            </td>

                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Forme Juridique :</label>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php if ($dossier->getDatecreationentreprise() != null) echo date('d/m/Y', strtotime($dossier->getDatecreationentreprise())); ?>" id="date_entreprise" type="date" readonly="true">
                                        <span class="input-group-addon">
                                            <i class="ace-icon fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input class="input-mask-matricule-fiscale" placeholder="Matricule fiscale" id="matricule_fiscale" value="<?php echo $dossier->getMatriculeFiscale(); ?>" type="text"  style="width: 85%; text-transform: uppercase"  readonly="true">
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input id="registre_commerce" placeholder="Registre de commerce " value="<?php echo $dossier->getRegistreCommerce(); ?>" type="text" readonly="true" >
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%" class="disabledbutton">
                                <div class="mws-form-row">
                                    <select id="forme_juridique" class="mws-select2 large">
                                        <option value=""></option>
                                        <?php foreach ($forme_juridiques as $jurid): ?>
                                            <option <?php if ($dossier->getIdFormejuridique() == $jurid->getId()): ?> selected="true" <?php endif; ?> value="<?php echo $jurid->getId() ?>"><?php echo $jurid->getLibelle() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>

                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Secteur d'Activité :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Activité :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%" class="disabledbutton">
                                <div class="mws-form-row">
                                    <select id="secteur_activite" class="mws-select2 large">
                                        <option value=""></option>
                                        <?php foreach ($secteur_activites as $secteur_activite): ?>
                                            <option <?php if ($dossier->getIdSecteuractivite() == $secteur_activite->getId()): ?> selected="true" <?php endif; ?> value="<?php echo $secteur_activite->getId() ?>"><?php echo $secteur_activite->getLibelle() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </td>
                            <td style="width: 25%" class="disabledbutton">
                                <div class="mws-form-row">
                                    <select id="activite" class="mws-select2 large">
                                        <option value=""></option>
                                        <?php foreach ($activites as $activite): ?>
                                            <option <?php if ($dossier->getIdActivite() == $activite->getId()): ?> selected="true" <?php endif; ?> value="<?php echo $activite->getId() ?>"><?php echo $activite->getLibelle() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="group">
                <h3 class="accordion-header" ng-click="InialiserChampsSelect()">Option du Dossier</h3>
                <div>
                    <table>
                        <tr>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"> T.F.P:</label>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"> FOPROLOS :</label>
                                    </div>
                                </div>
                            </td>
                            <td >
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"> Contribition Patronale :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mws-form-row">
                                    <input id="tfp" type="checkbox" <?php if ($dossier->getTfp() == "true"): ?>checked="true"<?php endif; ?>>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row" style="margin-left: 0%">
                                        <input id="foprolos" type="checkbox" <?php if ($dossier->getFoprolos() == "true"): ?>checked="true" <?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td >
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <select id="id_contribution" class="mws-select2 large">
                                            <option value=""></option>
                                            <?php $contribitions = LignecontribitionsocialeTable ::getInstance()->findAll(); ?>
                                            <?php foreach ($contribitions as $contribition): ?>
                                                <option <?php if ($dossier->getIdLignecontribition() == $contribition->getId()): ?> selected="true" <?php endif; ?> value="<?php echo $contribition->getId() ?>"><?php echo $contribition->getLibelle() . " " . $contribition->getTaux() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"> Taux T.F.P:</label>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"> Taux FOPROLOS :</label>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"> Taux de Cotisation d'Accident de travail  :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="display: none">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"> Type Régime :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="mws-form-row">
                                    <input placeholder="Taux T.F.P" value="<?php echo $dossier->getTauxtfp(); ?>" class="large input-mask-code" id="tauxtfp" type="text"  maxlength="10">
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row" style="margin-left: 0%">
                                        <input placeholder="Taux FOPROLOS"value="<?php echo $dossier->getTauxfoprolos(); ?>" id="tauxfoprolos" type="text" >
                                    </div>
                                </div>
                            </td>


                            <td>
                                <div class="mws-form-row">
                                    <input placeholder="Taux de Cotisation d'Accident de travail" value="<?php echo number_format($dossier->getTauxaccidentcotisation(), 2, '.', ' '); ?>" class="large input-mask-code" id="tauxtaccident" type="text"  maxlength="10">
                                </div>
                            </td>

                            <td style="display: none">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <select id="id_typeregime" class="mws-select2 large">
                                            <option value=""></option>
                                            <?php $typeregimes = RegimehoraireTable::getInstance()->findAll(); ?>
                                            <?php foreach ($typeregimes as $typeregime): ?>
                                                <option <?php if ($dossier->getIdTyperegime() == $typeregime->getId()): ?> selected="true" <?php endif; ?> value="<?php echo $typeregime->getId() ?>"><?php echo $typeregime->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Date Entrée En Production  :</label>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2"  style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Date Fin Avantage  :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"> Nbr Années Avantage :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php if ($dossier->getDateentreenproduction() != null) echo date('Y-m-d', strtotime($dossier->getDateentreenproduction())); ?>" min="<?php echo date('Y') ?>-01-01" max="<?php echo date('Y') ?>-12-31" id="dateentreenproduction" type="date" >

                                        <span class="input-group-addon">
                                            <i class="ace-icon fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2" style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php if ($dossier->getDatefinavantage() != null) echo date('Y-m-d', strtotime($dossier->getDatefinavantage())); ?>"   id="datefinavantage" type="date" >
                                        <span class="input-group-addon">
                                            <i class="ace-icon fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%" class="disabledbutton">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="text" value="<?php if ($dossier->getNbravantage() != null) echo $dossier->getNbravantage(); ?>" id="nbravantage">
                                    </div>
                                </div>
                            </td>

                        </tr>
                    </table>
                    <div ng-init="AfficheListeRegimePrevu('<?php echo $dossier->getId() ?>')">
                        <table style="width: 100%;">
                            <thead>
                                <tr> 
                                    <th style="width: 10%">N°ordre</th>
                                    <th style="width: 60%">Régime Horaire</th>
                                    <th style="width: 20%">Régime Par Défaut</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="formligneregime">
                                    <td><input type="text" value="" ng-model="norgdre.text" id="nordre" class="form-control disabledbutton align_center"></td>
                                    <?php
                                    $regime = Doctrine_Core::getTable('regimehoraire')->findAll();
                                    ?>
                                    <td>
                                        <div>
                                            <select id="regime">
                                                <option></option>
                                                <?php foreach ($regime as $reg) { ?>
                                                    <option value="<?php echo $reg->getId() ?>">
                                                        <?php echo $reg->getLibelle() ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td> 
                                    <td style="width: 20px; text-align: center;"><input type="checkbox" id="pardefaut" name="check_pardefaut"></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-info btn-circle btn-sm" ng-click="AjouterLigneRegime()"><b>+</b></button>
                                        <button type="button" class="btn btn-warning btn-circle btn-sm" ng-click="InaliserChampsRegime()"><b>-</b></button>
                                    </td>  
                                </tr>
                                <tr ng-repeat="lignedocRegimehoraire in listedocsRegimehoraire">
                                    <td style="text-align: center">{{lignedocRegimehoraire.norgdre}}</td>
                                    <td >{{lignedocRegimehoraire.regime}}</td>
                                    <td style="width: 20px ;text-align: center">
                                        <i class="ace-icon fa fa-check-square-o bigger-150" ng-if="lignedocRegimehoraire.pardefaut"></i>
                                        <i class="ace-icon fa fa-square-o bigger-150" ng-if="lignedocRegimehoraire.pardefaut == false"></i>
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-info btn-circle btn-xs" ng-click="MisAJourRegime(lignedocRegimehoraire)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-circle btn-xs" ng-click="DeleteRegime(lignedocRegimehoraire)">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <fieldset style="margin-top: 10px;">
                        <div class="col-lg-12">
                            <button type="button" id="btnvaliderRegime" class="btn btn-info pull-right" ng-click="ValidersaveRegime()"><i class="ace-icon fa fa-save bigger-110"></i>valider</button>
                        </div>
                    </fieldset>
                    <table>
                        <tr>
                            <td style="width: 5%; text-align: center; background: #EFEFEF" > 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="checkbox" id="calculheuresupp" <?php if ($dossier->getCalculheuresupp() == "true"): ?>checked="true" <?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%;">

                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Calcul proportionnel des Hr.Sup :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 5%; text-align: center; background: #EFEFEF" >
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="checkbox" id="qualificationcnss" <?php if ($dossier->getQualificationcnss() == "true"): ?> checked="true"<?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%;">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Editer Qualification dans la Déclaration CNSS :</label>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 5%; text-align: center; background: #EFEFEF" > 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="checkbox" id="situationprofess" <?php if ($dossier->getSituationprofess() == "true"): ?> checked="true"<?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%;">

                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Editer Situation Professionnelle Sur Fiche de Paye    :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 5%; text-align: center; background: #EFEFEF" > 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="checkbox" id="dateembauche" <?php if ($dossier->getDateembauche() == "true"): ?> checked="true"<?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%;">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Editer Date Embauche Sur Fiche de Paye   :</label>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 5%; text-align: center; background: #EFEFEF"> 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="checkbox" id="rib" <?php if ($dossier->getRib() == "true"): ?> checked="true"<?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%;">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Editer RIB Sur Fiche de Paye :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 5%; text-align: center;background: #EFEFEF" > 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="checkbox" id="soldeconge" <?php if ($dossier->getSoldeconge() == "true"): ?> checked="true"<?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%;">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Editer Solde Congé Sur Fiche de Paye :</label>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 5%; text-align: center;background: #EFEFEF" > 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="checkbox" id="periode" <?php if ($dossier->getPeriode() == "true"): ?> checked="true"<?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%;"> 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Editer Période Sur Fiche de Paye :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 5%; text-align: center; background: #EFEFEF" > 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="checkbox" id="mntlibelleprime" <?php if ($dossier->getMntlibelleprime() == "true"): ?> checked="true"<?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%;"> 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Afficher Mnt.Prime avec son Libellé dans la Fiche de Paye :</label>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 5%; text-align: center; background: #EFEFEF" > 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="checkbox" id="lignessp" <?php if ($dossier->getLignessp() == "true"): ?> checked="true"<?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%;"> 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Editer Ligne S.S.P  Sur Fiche de Paye :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 5%; text-align: center;background: #EFEFEF" > 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="checkbox" id="editgrille" <?php if ($dossier->getEditgrille() == "true"): ?> checked="true"<?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%;"> 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">M.à.jour Automatique des Salaire Par Grille des Salaires :</label>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 5%; text-align: center;background: #EFEFEF" > 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="checkbox" id="reparation" <?php if ($dossier->getReparation() == "true"): ?> checked="true"<?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%;"> 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Utiliser Réparations des Employés :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 5%; text-align: center; background: #EFEFEF" > 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="checkbox" id="controlerevenue" <?php if ($dossier->getControlerevenue() == "true"): ?> checked="true"<?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%; "> 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Utiliser le Contrôle du Revenus <5000 :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 5%; text-align: center; background: #EFEFEF"> 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="checkbox" id="journalpaie" <?php if ($dossier->getJournalpaie() == "true"): ?> checked="true"<?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%;"> 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Editer Employés dans une Page dans le Journal de Paye :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 5%; text-align: center; background: #EFEFEF"> 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="checkbox" id="assurancejouralpaie" <?php if ($dossier->getAssurancejouralpaie() == "true"): ?> checked="true"<?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%;"> 
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Editer Assurance Groupe dans le Journal de Paye :</label>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    </table>
                </div>
            </div>
            <div class="group">
                <h3 class="accordion-header">Contact</h3>
                <div>
                    <table>
                        <tr>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Téléphone 1 :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Téléphone 2 :</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Fax :</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Email :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input placeholder="Téléphone" class="input-mask-phone" value="<?php echo $dossier->getTelephoneUn(); ?>" id="telephone_1" type="text" readonly="true">
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input placeholder="Autre téléphone" class="input-mask-phone" id="telephone_2" value="<?php echo $dossier->getTelephoneDeux(); ?>" type="text"  readonly="true">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input placeholder="Fax" class="input-mask-phone" id="fax" value="<?php echo $dossier->getFax(); ?>" type="text" readonly="true" >
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input placeholder="E-mail" id="email" value="<?php echo $dossier->getEmail(); ?>" type="text"  readonly="true">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="group">
                <h3 class="accordion-header" ng-click="InialiserChampsSelect()">Adresse</h3>
                <div>
                    <table>
                        <tr>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Pays :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Ville :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Code Postale :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%">
                                <div class="mws-form-row">
                                    <?php
                                    if ($adresse->getIdCouvernera() != null)
                                        $ville = GouverneraTable::getInstance()->find($adresse->getIdCouvernera());
                                    else
                                        $ville = null;
                                    ?>
                                    <input value="<?php if ($ville != null) echo $ville->getPays()->getPays(); ?>" type="text" disabled="true">
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-row">
                                    <input value="<?php if ($ville != null) echo $ville->getGouvernera(); ?>" type="text" disabled="true">
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-row">
                                    <input value="<?php if ($adresse != null) echo $adresse->getCodePostal(); ?>" type="text" disabled="true">
                                </div>
                            </td>
                            <td style="width: 25%"></td>
                        </tr>
                        <tr>
                            <td style="width: 25%" colspan="4">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Adresse :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%" colspan="4">
                                <div class="mws-form-row">
                                    <input placeholder="Adresse" <?php if ($adresse != null): ?> value="<?php echo $adresse->getAdresse(); ?>" <?php endif; ?> id="adresse" type="text" readonly="true">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div><!-- #accordion -->
    </div>
</div>

<div class="clearfix form-actions">
    <div class="alert alert-block alert-success" id="alert_succes" style="display: none;">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <p>
            <strong>
                <i class="ace-icon fa fa-check"></i>
                Succès!
            </strong>
            Dossier paie modifié.
        </p>
    </div>
    <div class="col-md-offset-5 col-md-6">
        <button class="btn btn-info" type="button" onclick="saveEditDossierPaie()">
            <i class="ace-icon fa fa-edit bigger-110"></i>
            Modifier
        </button>
        <button class="btn btn-default" type="button" onclick="annulerDossier()">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Annuler
        </button>
    </div>
</div>


<script>

    function saveEditDossierPaie() {
        $('#alert_succes').hide();
        $.ajax({
            url: '<?php echo url_for('dossiercomptable/saveEdit') ?>',
            data: 'code=' + $('#code').val() +
                    '&id=<?php echo $dossier->getId(); ?>' +
                    '&tfp=' + $('#tfp').is(':checked') +
                    '&foprolos=' + $('#foprolos').is(':checked') +
                    '&id_contribution=' + $('#id_contribution').val() +
                    '&raison_sociale=' + $('#raison_sociale').val() +
                    '&telephone_1=' + $('#telephone_1').val() +
                    '&telephone_2=' + $('#telephone_2').val() +
                    '&fax=' + $('#fax').val() +
                    '&email=' + $('#email').val() +
                    '&matricule_fiscale=' + $('#matricule_fiscale').val() +
                    '&registre_commerce=' + $('#registre_commerce').val() +
                    '&forme_juridique=' + $('#forme_juridique').val() +
                    '&secteur_activite=' + $('#secteur_activite').val() +
                    '&activite=' + $('#activite').val() +
                    '&code_postal=' + $('#code_postal').val() +
                    '&ville=' + $('#ville').val() +
                    '&exercice=' + $('#exercice').val() +
                    '&tauxtfp=' + $('#tauxtfp').val() +
                    '&tauxfoprolos=' + $('#tauxfoprolos').val() +
                    '&id_typeregime=' + $('#id_typeregime').val() +
                    '&dateentreenproduction=' + $('#dateentreenproduction').val() +
                    '&datefinavantage=' + $('#datefinavantage').val() +
                    '&nbravantage=' + $('#nbravantage').val() +
                    '&calculheuresupp=' + $('#calculheuresupp').is(':checked') +
                    '&qualificationcnss=' + $('#qualificationcnss').is(':checked') +
                    '&situationprofess=' + $('#situationprofess').is(':checked') +
                    '&dateembauche=' + $('#dateembauche').is(':checked') +
                    '&rib=' + $('#rib').is(':checked') +
                    '&soldeconge=' + $('#soldeconge').is(':checked') +
                    '&periode=' + $('#periode').is(':checked') +
                    '&mntlibelleprime=' + $('#mntlibelleprime').is(':checked') +
                    '&lignessp=' + $('#lignessp').is(':checked') +
                    '&editgrille=' + $('#editgrille').is(':checked') +
                    '&reparation=' + $('#reparation').is(':checked') +
                    '&controlerevenue=' + $('#controlerevenue').is(':checked') +
                    '&journalpaie=' + $('#journalpaie').is(':checked') +
                    '&assurancejouralpaie=' + $('#assurancejouralpaie').is(':checked') +
                    '&adresse=' + $('#adresse').val() + '&tauxtaccident=' + $('#tauxtaccident').val(),
            success: function (data) {
                $('#alert_succes').show();
                document.location.href = "<?php echo sfconfig::get('sf_appdir') . 'paie.php/dossiercomptable/show' ?>";
            }
        });
    }

    function annulerDossier() {
        document.location.href = "<?php echo sfconfig::get('sf_appdir') . 'paie.php/dossiercomptable/show' ?>";
    }

</script>

<style>

    .ui-helper-reset {font-size: 14px !important;}

</style>

<script  type="text/javascript">
    document.title = ("BMM - U. Paie : Modifier Dossier Paie");
</script>