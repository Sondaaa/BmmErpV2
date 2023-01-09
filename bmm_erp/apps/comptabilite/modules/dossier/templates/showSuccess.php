<div id="sf_admin_container">
    <h1 id="replacediv"> Dossier Comptable 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            <?php
            if ($dossier->getCode() != null && $dossier->getCode() != ''):
                ?>
                Dossier Comptable :
                <?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonSociale(); ?>
            <?php else: ?>
                Dossier Comptable  <?php // echo $dossier->getRaisonSociale();               ?>
            <?php endif; ?>
        </small>
    </h1>
</div>

<div>
    <div class="col-sm-12">
 <?php if ($permission_profil): ?>
        <a href="<?php echo url_for('dossier/new') ?>" class="btn btn-app btn-success radius-4">
            <i class="ace-icon fa fa-folder-open-o bigger-190"></i>
            Nouveau
        </a>
           <?php endif; ?>
        <a href="<?php echo url_for('dossier/index') ?>" class="btn btn-app btn-purple radius-4">
            <i class="ace-icon fa fa-list bigger-190"></i>
            Liste des Dossiers
        </a>
        <a href="<?php echo url_for('@showEditDossier') . '?id=' . $dossier->getId() ?>" class="btn btn-app btn-primary radius-4">
            <i class="ace-icon fa fa-pencil-square-o bigger-190"></i>
            Modifier
        </a>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div id="accordion" class="accordion-style2">
            <div class="group">
                <h3 class="accordion-header">Données de base</h3>
                <div>
                    <table>
                        <tr>
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
                                        <label class="mws-form-label">Exercice Comptable :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mws-form-row">
                                    <input value="<?php echo $dossier->getCode(); ?>" type="text" disabled="true">
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row" style="margin-left: 0%">
                                        <input value="<?php echo $dossier->getRaisonSociale(); ?>" type="text" disabled="true">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php echo $dossier->getDossierexercice()->getFirst()->getExercice()->getLibelle(); ?>" type="text" disabled="true">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Date Création Entreprise :</label>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2" style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Période Comptable :</label>
                                    </div>
                                </div>
                            </td>
                            <td  style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Etat * :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="display: none">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Compte d'Attente :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php if ($dossier->getDatecreationentreprise() != null) echo date('d/m/Y', strtotime($dossier->getDatecreationentreprise())); ?>" id="date_entreprise" type="text" disabled="true">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php if ($dossier->getDatedebutouverture() != null) echo date('d/m/Y', strtotime($dossier->getDatedebutouverture())); ?>" id="date_debut_ouverture" type="text" disabled="true">
                                    </div>
                                </div>
                            </td>
                            <td >
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php if ($dossier->getDatefinouverture() != null) echo date('d/m/Y', strtotime($dossier->getDatefinouverture())); ?>" id="date_fin_fermeture" type="text" disabled="true">
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php
                                        if ($dossier->getEtat() == 1)
                                            echo 'Actif';
                                        else
                                            echo 'Inactif';
                                        ?>" type="text" disabled="true">
                                    </div>
                                </div>
                            </td>
                            <td style="display: none">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php echo trim($dossier->getCompteAttente()->getNumeroCompte()) . ' - ' . trim($dossier->getCompteAttente()->getLibelle()) ?>" type="text" disabled="true">
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
                                        <input value="<?php echo trim($dossier->getCompteVente()->getNumeroCompte()) . ' - ' . trim($dossier->getCompteVente()->getLibelle()) ?>" type="text" disabled="true">
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php echo trim($dossier->getCompteAchat()->getNumeroCompte()) . ' - ' . trim($dossier->getCompteAchat()->getLibelle()) ?>" type="text" disabled="true">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
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
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php echo $dossier->getMatriculeFiscale(); ?>" type="text" style="text-transform: uppercase" disabled="true">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input value="<?php echo $dossier->getRegistreCommerce(); ?>" type="text" disabled="true" disabled="true">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="text" value="<?php echo $dossier->getNombrechiffrenumerocompte(); ?>" disabled="true">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <input type="text" value="<?php echo $dossier->getNombrechiffreapresvirgule(); ?>" disabled="true">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Forme Juridique :</label>
                                    </div>
                                </div>
                            </td>
                            <td style="display: none;">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Devise (Monnaie de Saisie) :</label>
                                    </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Secteur d'Activité :</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-inline">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Activité :</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mws-form-row">
                                    <input value="<?php echo $dossier->getFormejuridique()->getLibelle(); ?>" type="text" disabled="true">
                                </div>
                            </td>
                            <td style="display: none;">
                                <div class="mws-form-row">
                                    <input value="<?php echo $dossier->getDevise()->getLibelle(); ?>" type="text" disabled="true">
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="mws-form-row">
                                    <input value="<?php echo $dossier->getSecteuractivite()->getLibelle(); ?>" type="text" disabled="true">
                                </div>
                            </td>
                            <td>
                                <div class="mws-form-row">
                                    <input value="<?php echo $dossier->getActivitetiers()->getLibelle(); ?>" type="text" disabled="true">
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

            <div class="group">
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
                            <td >
                                <div class="mws-form-row">
                                    <input value="<?php if ($adresse != null) echo $adresse->getCodePostal(); ?>" type="text" disabled="true">
                                </div>
                            </td>

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
            <div class="group">
                <h3 class="accordion-header" >Pièces Juridiques</h3>
                <fieldset ng-controller="CtrlUplaod">
                    <div>Listes Des Pièces Juridiques</div><br>
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

                        <tr style="display: none">
                        <div style="display: none">    <h4>Importer Une Pièce </h4></div>
                        <div class="widget-body col-md-3" style="display: none">
                            <div class="widget-main" >
                                <div class="alert-info">{{msg}}</div>
                                <form  name="form_upload" role="form" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" id="libelle" class="form-control" placeholder="Nom du fichier">
                                        <br>
                                        <input name="lib_fichier" id="lib_fichier" type="file">

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

<script  type="text/javascript">

    function listePlan(dossier_id) {
        $.ajax({
            url: '<?php echo url_for('@listePlanDossier') ?>',
            data: 'id=' + dossier_id,
            success: function (data) {

            }
        });
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Dossier Comptable");
</script>