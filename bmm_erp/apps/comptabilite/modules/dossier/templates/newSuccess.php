<div id="sf_admin_container">
    <h1 id="replacediv"> Dossier Comptable 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Ajouter Dossier Comptable
        </small>
    </h1>
</div>

<div>
    <div class="col-sm-8">
        <span class="text-primary">. ( * ) : Champ obligatoire.</span>
        <br>
        <span class="text-primary">. <u>L'exercice comptable</u> et la <u>péroide comptable</u> doivent être dans la même année.</span>
        <br>
<!--        <span class="text-primary">. Longueur du <u>compte d'attente</u> doit être entre 6 et 12 chiffres.</span>-->
        <br><br>
    </div>
</div>

<div class="row" ng-controller="myCtrlPaysVille" ng-init="InialiserChampsSelect()">
    <div class="col-sm-12">
        <div id="accordion" class="accordion-style2">
            <div class="group">
                <h3 class="accordion-header" ng-click="InialiserChampsSelect()">Données de base</h3>
                <div>
                    <table>
                        <tr>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Code * :</label>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Raison Sociale * :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Exercice Comptable * : <?php // echo  $exercices->count();     ?></label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr><input type="hidden" id="id_dossier" value="">
                        <td style="width: 25%">
                            <div class="mws-form-row">
                                <input placeholder="Code dossier comptable" value="" class="large input-mask-code" id="code_dossier" type="text" obligatoire="true" maxlength="3"   onkeydown="chargerlisteDossier(event, false)" ondblclick="chargerlisteDossier(event, true)"><!--ng-model="code" ng-change="TestExistanceDossier()"-->
                            </div>
                        </td>
                        <td colspan="2">
                            <input type="hidden" id ="id_dossier">
                            <div class="mws-form-inline">
                                <div class="mws-form-row" style="margin-left: 0%">
                                    <input value="" id="raison_sociale" type="text" obligatoire="true" placeholder="Raison dossier comptable">
                                </div>
                            </div>
                        </td>
                        <td style="width: 25%">

                            <div class="mws-form-inline">
                                <div class="mws-form-row" style="margin-left: 0%">
                                    <input value="" id="exercice" type="text" obligatoire="true" >  </div>
                            </div>
                        </td>
<!--                        <td style="width: 25%">
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <select id="exercice" class="mws-select2 large" onchange="setMinMaxDate()">
                                        <option value=""></option>
                        <?php //                                        foreach ($exercices as $exercice): ?>
                                            <option value="<?php // echo $exercice->getId()     ?>" annee="<?php // echo date('Y', strtotime($exercice->getDateDebut()))     ?>"><?php // echo $exercice->getLibelle()      ?></option>
                        <?php // endforeach;  ?>
                                    </select>
                                </div>
                            </div>
                        </td>-->
                        </tr>
                        <tr>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Date Création Entreprise * :</label>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2" style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Période Comptable * :</label>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2" style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Etat * :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%;display: none">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Compte d'Attente :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="" id="date_entreprise" type="date" obligatoire="true">
<!--                                        <span class="input-group-addon">
                                            <i class="ace-icon fa fa-calendar"></i>
                                        </span>-->
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="" id="date_debut_ouverture" type="date" obligatoire="true" disabled="true">
<!--                                        <span class="input-group-addon">
                                            <i class="ace-icon fa fa-calendar"></i>
                                        </span>-->
                                    </div>
                                </div>
                            </td>
                           
                            <td style="width: 25%" >
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value=""  min="<?php echo date('Y') ?>-01-01" max="<?php echo date('Y') ?>-12-31" id="date_fin_fermeture" type="date" obligatoire="true" disabled="true">
<!--                                        <span class="input-group-addon">
                                            <i class="ace-icon fa fa-calendar"></i>
                                        </span>-->
                                    </div>
                                </div>
                            </td>
                             <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <select id="etat" class="mws-select2 large">
                                            <option value="true">Actif</option>
                                            <option value="false">Inactif</option>   
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25% ;display: none">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <select id="compte_attente" class="mws-select2 large">
                                            <option value=""></option>
                                            <?php foreach ($compte_attente as $compte): ?>
                                                <option value="<?php echo $compte->getId() ?>" id="option_<?php echo $compte->getId() ?>" data-numero="<?php echo $compte->getNumeroCompte() ?>"><?php echo $compte->getNumeroCompte() . ' - ' . $compte->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr style="display: none">
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Compte de Vente :</label>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Compte de Achat :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr style="display: none">
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <select id="compte_vente" class="mws-select2 large">
                                            <option value=""></option>
                                            <?php foreach ($compte_attente as $compte): ?>
                                                <option value="<?php echo $compte->getId() ?>"><?php echo $compte->getNumeroCompte() . ' - ' . $compte->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <select id="compte_achat" class="mws-select2 large">
                                            <option value=""></option>
                                            <?php foreach ($compte_attente as $compte): ?>
                                                <option value="<?php echo $compte->getId() ?>"><?php echo $compte->getNumeroCompte() . ' - ' . $compte->getLibelle() ?></option>
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
                                        <label class="mws-form-label">Matricule Fiscale * :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Registre Nationale d'entreprise :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Chiffres / Compte :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Chiffres aprés Virgule :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input class="input-mask-matricule-fiscale" placeholder="Matricule fiscale" id="matricule_fiscale" value="" type="text" style="width: 85%; text-transform: uppercase" >
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input class="input-mask-registre-nationale" id="registre_commerce" placeholder="Registre Nationale d'entreprise" value="" type="text" disabled="true">
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input id="chiffre_compte" type="text" value="8" onchange="setChiffreCompte()">
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input id="chiffre_virgule" type="text" value="3" onchange="setChiffreVirgule()">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Forme Juridique :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a style="text-align: right" href="#modal-formejuridique" role="button" class="btn btn-primary" data-toggle="modal"  ><i class="ace-icon fa fa-plus"></i></a>
                                        </label>
                                    </div>

                                </div>

                            </td>





                            <td style="display: none;">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Devise (Monnaie de Saisie) * :</label>
                                    </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Activité :&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a style=" text-align: right" href="#modal-activite" role="button" class="btn btn-primary" data-toggle="modal"  ><i class="ace-icon fa fa-plus"></i></a></label>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Secteur d'Activité : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a style=" text-align: right" href="#modal-secteuractivite" role="button" class="btn btn-primary" data-toggle="modal"  ><i class="ace-icon fa fa-plus"></i></a></label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%">
                                <div class="mws-form-row">
                                    <select style="width: 20%" id="forme_juridique" class="mws-select2 large">
                                        <option value=""></option>
                                        <?php foreach ($forme_juridiques as $jurid): ?>
                                            <option value="<?php echo $jurid->getId() ?>"><?php echo $jurid->getLibelle() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </td>
                            <td style="display: none;">
                                <div class="mws-form-row">
                                    <select id="devise" class="mws-select2 large">
                                        <option value=""></option>
                                        <?php foreach ($devises as $devise): ?>
                                            <option value="<?php echo $devise->getId() ?>"><?php echo $devise->getLibelle() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-row">
                                    <select id="activite" class="mws-select2 large">
                                        <option value=""></option>
                                        <?php foreach ($activites as $activite): ?>
                                            <option value="<?php echo $activite->getId() ?>"><?php echo $activite->getLibelle() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-row">
                                    <select id="secteur_activite" class="mws-select2 large">
                                        <option value=""></option>
                                        <?php foreach ($secteur_activites as $secteur_activite): ?>
                                            <option value="<?php echo $secteur_activite->getId() ?>"><?php echo $secteur_activite->getLibelle() ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
                                        <input placeholder="Téléphone" class="input-mask-phone" value="" id="telephone_1" type="text" >
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input placeholder="Autre téléphone" class="input-mask-phone" id="telephone_2" value="" type="text" >
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input placeholder="Fax" class="input-mask-phone" id="fax" value="" type="text" >
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input placeholder="E-mail" id="email" value="" type="text" >
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
                                    <select id="pays" class="mws-select2 large">
                                        <option value=""></option>
                                        <?php foreach ($payss as $pays): ?>
                                            <option value="<?php echo $pays->getId() ?>"><?php echo $pays->getPays() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </td>
                            <?php $vil = GouverneraTable::getInstance()->findAll() ?>
                            <td style="width: 25%">
                                <div class="mws-form-row">
                                    <select id="ville" class="mws-select2 large">
                                        <option value=""></option>
                                        <?php foreach ($vil as $ville): ?>
                                            <option value="<?php echo $ville->getId() ?>"><?php echo $ville->getGouvernera() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </td>
                            <td >
                                <div class="mws-form-row">
                                    <input placeholder="Code postale" value="" id="code_postal" type="text" >
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 25%" colspan="4">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row" >
                                        <label class="mws-form-label" >Adresse :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%" colspan="4">
                                <div class="mws-form-row">
                                    <input placeholder="Adresse" value="" id="adresse" type="text">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="group" style="display: none">
                <h3 class="accordion-header" >Pièces Juridiques</h3>
                <fieldset ng-controller="CtrlUplaod">
                    <div class="row">
                        <?php foreach ($referentiels as $referenciel): ?>
                            <div class="col-md-2">
                                <div>
                                    <a href="<?php echo sfconfig::get('sf_appdir') . 'uploads/merge/' . $referenciel->getUrl() ?>" target="__blanc"> 
                                        <img src="<?php echo sfconfig::get('sf_appdir') . 'uploads/images/pdf.png' ?> " width="50">
                                    </a><br>
                                    <a href="<?php echo sfconfig::get('sf_appdir') . 'uploads/merge/' . $referenciel->getUrl() ?>" target="__blanc"> <?php echo $referenciel->getLibelle(); ?></a>

                                </div>
                            </div>
                        <?php endforeach ?>
                        <div class="col-md-2" ng-repeat="refe in listeRef">
                            <div>
                                <a href="<?php echo sfconfig::get('sf_appdir') . 'uploads/merge/' ?>{{refe.url}} " target="__blanc"> 
                                    <img src="<?php echo sfconfig::get('sf_appdir') . 'uploads/images/pdf.png' ?> " width="50">
                                </a><br>
                                <a href="<?php echo sfconfig::get('sf_appdir') . 'uploads/merge/' ?>{{refe.url}}" target="__blanc"> {{refe.libelle}}</a>

                            </div>
                        </div>
                    </div>
                    <table>
                        <tr>
                        <div>    <h4>Importer Une Pièce </h4></div>
                        <div class="widget-body col-md-3">
                            <div class="widget-main" >
                                <div class="alert-info">{{msg}}</div>
                                <form  name="form_upload" role="form" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" id="libelle" class="form-control" placeholder="Nom du fichier">
                                        <br>
                                        <input name="lib_fichier" id="lib_fichier" type="file" src='uploads/merge/' >

                                    </div>
                                    <hr style="margin-top: 10px; margin-bottom: 10px;">
                                    <input ng-click="AddFileUpload(<?php echo $id_dossier ?>)" type="button" class="btn btn-success" value="Ajouter fichier Juridique" id="but_upload">
                                </form>
                            </div>
                        </div>
                        </tr>
                    </table>

                </fieldset>

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
            Dossier comptable modifié.
        </p>
    </div>
    <div class="col-md-offset-5 col-md-6">
        <button class="btn btn-info" type="button" onclick="saveEditDossier()">
            <i class="ace-icon fa fa-save bigger-110"></i>
            Enregistrer
        </button>
        <button class="btn btn-default" type="button" onclick="annulerDossier()">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Annuler
        </button>
    </div>
</div>

<div id="modal-formejuridique" class="modal fade" tabindex="-1">
    <?php
    include_partial('dossier/form_formejurique', array());
    ?>
</div>
<div id="modal-activite" class="modal fade" tabindex="-1">
    <?php
    include_partial('dossier/form_activite', array());
    ?>
</div>
<div id="modal-secteuractivite" class="modal fade" tabindex="-1">
    <?php
    include_partial('dossier/form_secteuractivite', array());
    ?>
</div>
<div id="my-modalListedossier" class="modal body" tabindex="1" > 
    <?php
    include_partial('dossier/listedossier', array());
    ?>
</div>
<script  type="text/javascript">

    function saveEditDossier() {
        $('#alert_succes').hide();
        if (champsObligatoires() && champsTailles()) {
            $.ajax({
                url: '<?php echo url_for('@saveEditDossierComptable') ?>',
                data: 'code=' + $('#code_dossier').val() +
//                        '&id=0' +
                        '&raison_sociale=' + $('#raison_sociale').val() +
                        '&date_entreprise=' + $('#date_entreprise').val() +
                        '&date_debut_ouverture=' + $('#date_debut_ouverture').val() +
                        '&date_fin_fermeture=' + $('#date_fin_fermeture').val() +
                        '&telephone_1=' + $('#telephone_1').val() +
                        '&telephone_2=' + $('#telephone_2').val() +
                        '&fax=' + $('#fax').val() +
                        '&email=' + $('#email').val() +
                        '&matricule_fiscale=' + $('#matricule_fiscale').val() +
                        '&registre_commerce=' + $('#registre_commerce').val() +
                        '&chiffre_compte=' + $('#chiffre_compte').val() +
                        '&chiffre_virgule=' + $('#chiffre_virgule').val() +
                        '&forme_juridique=' + $('#forme_juridique').val() +
                        '&devise=' + $('#devise').val() +
                        '&secteur_activite=' + $('#secteur_activite').val() +
                        '&activite=' + $('#activite').val() +
                        '&code_postal=' + $('#code_postal').val() +
                        '&ville=' + $('#ville').val() +
                        '&exercice=' + $('#exercice').val() +
                        '&id_attente=' + $('#compte_attente').val() +
                        '&id_vente=' + $('#compte_vente').val() +
                        '&id_achat=' + $('#compte_achat').val() +
                        '&adresse=' + $('#adresse').val()
                        + '&lib_fichier=' + $('#lib_fichier').val()
                        + '&libelle=' + $('#libelle').val()
                        + '&description=' + $('#description').val()+
                         + '&etat=' + $('#etat').val(),
                success: function (data) {
                    $('#alert_succes').show();
                    document.location.href =
//                            "<?php // echo url_for('@listePlanDossier')      ?>"
                            "<?php echo sfconfig::get('sf_appdir') . 'comptabilite.php/dossier' ?>";
                    document.location.reload();
                }
            });
        }
    }

    function champsObligatoires() {
        var valide = true;
        $('input[type="text"][obligatoire=true]').each(function () {
            if ($(this).val() !== '')
                $(this).css('border', '');
            else {
                $(this).css('border-color', '#f2a696');
                valide = false;
            }
        });
        $('input[type="date"][obligatoire=true]').each(function () {
            if ($(this).val() !== '')
                $(this).css('border', '');
            else {
                $(this).css('border-color', '#f2a696');
                valide = false;
            }
        });
        $('#exercice').each(function () {
            if ($(this).val() !== '')
                $('#exercice_chosen > .chosen-single').css('border', '');
            else {
                $('#exercice_chosen > .chosen-single').css('border-color', '#f2a696');
                valide = false;
            }
        });

        if (valide == false) {
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Attention !</span><br><span class='bigger-110' style='margin:20px;color:#b31531;'>Veuillez remplir les champs obligatoires ( * ) !</span>",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                        }
            });
        }

        return valide;
    }

    function setMinMaxDate() {
        var annee_exercice = $('#exercice option:selected').attr('annee');
        var min_date = annee_exercice + '-01-01';
        var max_date = annee_exercice + '-12-31';
        $('#date_debut_ouverture').attr('min', min_date);
        $('#date_debut_ouverture').attr('max', max_date);
        $('#date_fin_fermeture').attr('min', min_date);
        $('#date_fin_fermeture').attr('max', max_date);
    }

    function champsTailles() {
        var valide = true;
        if ($('#compte_attente').val() != '') {
            var id_option = '#option_' + $('#compte_attente').val();
            var compte = $(id_option).attr('data-numero');
            var reg = /[a-zA-Z0-9]/;
            var reglength = /[a-zA-Z0-9]{6,12}/;
            if (reglength.test(compte) === false) {
                $('#compte_attente_chosen > .chosen-single').css('border-color', '#f2a696');
                valide = false;
            } else {
                $('#compte_attente_chosen > .chosen-single').css('border', '');
            }
        }
        return valide;
    }

    function setChiffreCompte() {
        if ($('#chiffre_compte').val() != '') {
            if (isNaN(parseInt($('#chiffre_compte').val())))
                $('#chiffre_compte').val('6');
            else
                $('#chiffre_compte').val(parseInt($('#chiffre_compte').val()));
            if (parseInt($('#chiffre_compte').val()) < 6) {
                $('#chiffre_compte').val('6');
            }
            if (parseInt($('#chiffre_compte').val()) > 12) {
                $('#chiffre_compte').val('12');
            }
        } else {
            $('#chiffre_compte').val('6');
        }
    }

    function setChiffreVirgule() {
        if ($('#chiffre_virgule').val() != '') {
            if (isNaN(parseInt($('#chiffre_virgule').val())))
                $('#chiffre_virgule').val('0');
            else
                $('#chiffre_virgule').val(parseInt($('#chiffre_compte').val()));
            if (parseInt($('#chiffre_virgule').val()) < 0) {
                $('#chiffre_virgule').val('0');
            }
            if (parseInt($('#chiffre_virgule').val()) > 7) {
                $('#chiffre_virgule').val('7');
            }
        } else {
            $('#chiffre_virgule').val('0');
        }
    }
    function chargerlisteDossier(e, dbclick)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modalListedossier').addClass('in');
            $('#my-modalListedossier').css('display', 'block');
        }
    }




    function annulerDossier() {
        document.location.href = "<?php echo sfconfig::get('sf_appdir') . 'comptabilite.php/dossier/index' ?>";
    }









    
</script>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Modifier Dossier Comptable");
</script>
