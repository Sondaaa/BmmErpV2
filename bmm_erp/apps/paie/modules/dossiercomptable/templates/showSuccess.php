<div id="sf_admin_container">
    <h1 id="replacediv"> Dossier Paie 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            <?php if ($dossier->getCode() != null && $dossier->getCode() != ''): ?>
                Dossier  : <?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonSociale(); ?>
            <?php else: ?>
                Dossier  : <?php echo $dossier->getRaisonSociale(); ?>
            <?php endif; ?>
        </small>
    </h1>
</div>

<div>
    <div class="col-sm-12">
        <a href="<?php echo url_for('dossiercomptable/showEdit') ?>" class="btn btn-app btn-primary radius-4">
            <i class="ace-icon fa fa-pencil-square-o bigger-190"></i>
            Modifier 
        </a>
    </div>
</div>

<div class="row" ng-controller="CtrlPaie">
    <div class="col-sm-12">
        <div id="accordion" class="accordion-style2">
            <div class="group">
                <h3 class="accordion-header">Données de base</h3>
                <div>
                    <table>
                        <tr >
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Code :</label>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Raison Sociale :</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"> Année :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mws-form-row">
                                    <input placeholder="Code dossier" value="<?php echo $dossier->getCode(); ?>" class="large input-mask-code" id="code" type="text"  maxlength="3"  readonly="true">
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row" style="margin-left: 0%">
                                        <input value="<?php echo $dossier->getRaisonSociale(); ?>" id="raison_sociale" type="text" readonly="true" >
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <select id="exercice" class="mws-select2 large" onchange="setMinMaxDate()">
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
                                        <label class="mws-form-label">Date Création Entreprise :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Matricule Fiscale :</label>
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
                            <td colspan="2" style="width: 50%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Secteur d'Activité :</label>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2" style="width: 50%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Activité :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width: 50%" class="disabledbutton">
                                <div class="mws-form-row">
                                    <select id="secteur_activite" class="mws-select2 large">
                                        <option value=""></option>
                                        <?php foreach ($secteur_activites as $secteur_activite): ?>
                                            <option <?php if ($dossier->getIdSecteuractivite() == $secteur_activite->getId()): ?> selected="true" <?php endif; ?> value="<?php echo $secteur_activite->getId() ?>"><?php echo $secteur_activite->getLibelle() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </td>
                            <td colspan="2" style="width: 50%" class="disabledbutton">
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
                    <table style="margin-bottom: 0px;">
                        <tr>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">  T.F.P:</label>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">  FOPROLOS :</label>
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
                                    <input type="checkbox" id="tfp" <?php if ($dossier->getTfp() == "true"): ?> checked="true"<?php endif; ?>>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row" style="margin-left: 0%">
                                        <input type="checkbox" id="foprolos" <?php if ($dossier->getFoprolos() == "true"): ?> checked="true"<?php endif; ?>>
                                    </div>
                                </div>
                            </td>
                            <td >
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <select id="id_contribution" class="mws-select2 large">
                                            <option value=""></option>
                                            <?php $contribitions = LignecontribitionsocialeTable::getInstance()->findAll(); ?>
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
                                    <input placeholder="Taux T.F.P" value="<?php echo $dossier->getTauxtfp() . " %"; ?>" class="large input-mask-code" id="tauxtfp" type="text" obligatoire="true" maxlength="3" readonly="true">
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row" style="margin-left: 0%">
                                        <input placeholder="Taux FOPROLOS"value="<?php echo $dossier->getTauxfoprolos() . " % "; ?>" id="tauxfoprolos" type="text" readonly="true">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-row">
                                    <input placeholder="Taux de Cotisation d'Accident de travail" value="<?php echo number_format($dossier->getTauxaccidentcotisation(), 2, '.', ' ') . " %"; ?>" class="large input-mask-code" id="tauxtaccident" type="text"  maxlength="10">
                                </div>
                            </td>
                            <td class="disabledbutton" style="display: none">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <select id="id_typeregime" class="mws-select2 large" >
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
                                        <input value="<?php if ($dossier->getDateentreenproduction() != null) echo date('Y-m-d', strtotime($dossier->getDateentreenproduction())); ?>" id="dateentreenproduction" type="date" disabled="true">

                                    </div>
                                </div>
                            </td>
                            <td colspan="2" style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php if ($dossier->getDatefinavantage() != null) echo date('Y-m-d', strtotime($dossier->getDatefinavantage())); ?>" id="datefinavantage" type="date" disabled="true">
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="text" value="<?php if ($dossier->getNbravantage() != null) echo $dossier->getNbravantage(); ?>" id="nbravantage" readonly="true">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div   ng-init="AfficheListeRegimePrevu(<?php echo $dossier->getId() ?>)">
                        <table style="width: 100%">
                            <thead>
                                <tr> 
                                    <th style="width: 10%">N°ordre</th>
                                    <th style="width: 70%">Régime Horaire</th>
                                    <th style="width: 20%">Régime Par Défaut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="formligneregime">
                                    <td>
                                        <input type="text" value="" ng-model="norgdre.text" id="nordre" class="form-control disabledbutton align_center">
                                    </td>
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
                                    <td style="width: 20px ; text-align: center">  <input type="checkbox"  id="pardefaut" name="check_pardefaut" ></td>
                                </tr>
                                <tr ng-repeat="lignedocRegimehoraire in listedocsRegimehoraire">
                                    <td style="text-align: center">{{lignedocRegimehoraire.norgdre}}</td>
                                    <td >{{lignedocRegimehoraire.regime}}</td>
                                    <td style="width: 20px ;text-align: center">
                                        <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="lignedocRegimehoraire.pardefaut"></i>
                                        <i class="ace-icon fa fa-square-o bigger-170" ng-if="lignedocRegimehoraire.pardefaut == false"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table><br>
                    </div>
                    <table>
                        <tr>
                            <td style="width: 5%; text-align: center; background: #EFEFEF" class="disabledbutton"> 
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
                            <td style="width: 5%; text-align: center; background: #EFEFEF" class="disabledbutton">
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
                            <td style="width: 5%; text-align: center; background: #EFEFEF" class="disabledbutton"> 
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
                            <td style="width: 5%; text-align: center; background: #EFEFEF" class="disabledbutton"> 
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
                            <td style="width: 5%; text-align: center; background: #EFEFEF" class="disabledbutton"> 
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
                            <td style="width: 5%; text-align: center;background: #EFEFEF" class="disabledbutton"> 
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
                            <td style="width: 5%; text-align: center;background: #EFEFEF" class="disabledbutton"> 
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
                            <td style="width: 5%; text-align: center; background: #EFEFEF" class="disabledbutton"> 
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
                            <td style="width: 5%; text-align: center; background: #EFEFEF" class="disabledbutton"> 
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
                            <td style="width: 5%; text-align: center;background: #EFEFEF" class="disabledbutton"> 
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
                            <td style="width: 5%; text-align: center;background: #EFEFEF" class="disabledbutton"> 
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
                            <td style="width: 5%; text-align: center; background: #EFEFEF" class="disabledbutton"> 
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
                            <td style="width: 5%; text-align: center; background: #EFEFEF" class="disabledbutton"> 
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
                            <td style="width: 5%; text-align: center; background: #EFEFEF" class="disabledbutton"> 
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
                                        <input value="<?php echo $dossier->getTelephoneUn(); ?>" type="text" disabled="true">
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php echo $dossier->getTelephoneDeux(); ?>" type="text" disabled="true">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php echo $dossier->getFax(); ?>" type="text" disabled="true">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php echo $dossier->getEmail(); ?>" type="text" disabled="true">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="group" >
                <h3 class="accordion-header">Adresse</h3>
                <?php $adresse = $dossier->getAdresse(); ?>
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
                            <td style="width: 25%"></td>
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
                                    <input <?php if ($adresse != null): ?> value="<?php echo $adresse->getAdresse(); ?>" <?php endif; ?> type="text" disabled="true">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div><!-- #accordion -->
    </div>
</div>

<style>

    .ui-helper-reset {font-size: 14px !important;}

</style>

<script  type="text/javascript">
    document.title = ("BMM - U. Paie : Dossier Paie");
</script>