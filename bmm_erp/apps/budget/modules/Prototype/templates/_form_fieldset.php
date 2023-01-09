<?php

$typebudget = "Prototype";

if (!$form->getObject()->isNew()) {
    $typebudget = trim($form->getObject()->getTypebudget());
    $prototype = trim($form->getObject()->getTypebudget());
}
?>
<div id="sf_admin_container">
    <div id="sf_admin_content">
        <div class="col-sm-12">
            <div class="tabbable" >
                <ul class="nav nav-tabs" id="myTab" ng-click="InialiserChampsTitres()"
                >
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            <i class="green ace-icon fa fa-usb bigger-120"></i>
                            Entête Fiche Budget prototype
                        </a>
                    </li>
                    <li <?php if ($form->getObject()->isNew()) {
    echo "style='display:none'";
}
?>>
                        <input type="hidden" id="detailprixid" value="<?php echo $form->getObject()->getId() ?>">
                        <a data-toggle="tab" href="#messages" ng-click="InialiserChamps();
                            AfficheSousDetailPrix('<?php echo $form->getObject()->getId() ?>')">
                            <i class="green ace-icon fa fa-money bigger-120"></i>
                            Détails Budget
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active" ng-init="Inialisation(<?php echo $sf_user->getAttribute('userB2m')->getId() ?>);InialiserChampspopup()" >
                        <?php if (trim($form->getObject()->getTypebudget()) == "Prototype" || $form->getObject()->isNew() || $form->getObject()->getEtatbudget() != 2): ?>
                            <fieldset class="disabledbutton">
                                <blockquote style="padding: 0px 0px 0px 10px;">
                                    <legend>Identification du responsable suivi Budget</legend>
                                </blockquote>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><label>Utilisateur unité Budget</label></td>
                                            <td colspan="3">
                                                <?php echo $form['id_user']->renderError() ?>
                                                <?php echo $form['id_user'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Nom & Prénom</label></td>
                                            <td>
                                                <?php
$user = new Utilisateur();
$user = $sf_user->getAttribute('userB2m');
echo $user->getAgents()->getNomcomplet()
?>
                                            </td>
                                            <td><label>E-mail / Gsm / Poste</label></td>
                                            <td><?php echo $user->getAgents()->getMail() . '/' . $user->getAgents()->getGsm(); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                            <fieldset style="margin-top: 20px;">
                                <blockquote style="padding: 0px 0px 0px 10px;">
                                    <legend>Informations sur le Budget</legend>
                                </blockquote>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nom Budget</label>
                                                <?php echo $form['libelle']->renderError() ?>
                                                <?php echo $form['libelle'] ?>
                                            </div>
                                            <div class="col-md-4">

                                                <label>Catégorie</label>
                                                <a href="#my-modal" role="button" class="label label-danger" data-toggle="modal">
                                    <i class="fa fa-plus"></i> Ajouter Catégorie
                                </a></label>
                                                <?php echo $form['id_cat']->renderError() ?>
                                                <?php echo $form['id_cat'] ?>
                                            </div>
                                            <div id="my-modal" class="modal fade" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="smaller lighter blue no-margin">Nouvelle Catégorie</h3>
                                        </div>
                                        <div class="modal-body">
                                            <table>
                                                <tr>
                                                    <td><label>Nom du Catégorie</label></td>
                                                    <td><input type="text" id="categorie_libelle"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal" style="margin-left: 1%;">
                                                <i class="ace-icon fa fa-times"></i>
                                                fermer
                                            </button>
                                            <button class="btn btn-sm btn-primary pull-right" data-dismiss="modal" ng-click="Ajouterategorie()">
                                                <i class="ace-icon fa fa-plus"></i>
                                                Ajouter
                                            </button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                                            <div class="col-md-4">
                                                <label>Type Budget</label>
                                                <?php echo $form['typebudget']->renderError() ?>
                                                <?php echo $form['typebudget']->render(array('value' => $typebudget)) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Projet</label>
                                                <a href="#my-modalprojet" role="button" class="label label-danger" data-toggle="modal">
                                    <i class="fa fa-plus"></i> Ajouter Projet
                                </a></label>
                                                <?php echo $form['id_projet']->renderError() ?>
                                                <?php echo $form['id_projet'] ?>
                                            </div>
                                            <div id="my-modalprojet" class="modal fade" tabindex="-1">
                              <?php
$sites = Doctrine_Core::getTable('site')->findAll();
$sous_sites = Doctrine_Core::getTable('etage')->findAll();
?>
                                            <div class="modal-dialog" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="smaller lighter blue no-margin">Nouvelle Projet</h3>
                                        </div>
                                        <div class="modal-body">
                                            <table>
                                            <tr>
                                                    <td><label>Site</label></td>
                                                    <td>
                                                    <select id="site">
                                            <option></option>
                                            <?php foreach ($sites as $site) {?>
                                                <option value="<?php echo $site->getId() ?>"><?php echo $site ?></option>
                                            <?php }?>
                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Sous Site</label></td>
                                                    <td>
                                                    <select id="sous_site">
                                            <option></option>
                                            <?php foreach ($sous_sites as $sous_site) {?>
                                                <option value="<?php echo $sous_site->getId() ?>"><?php echo $sous_site ?></option>
                                            <?php }?>
                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Nom du Projet</label></td>
                                                    <td><input type="text" id="projet_libelle"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal" style="margin-left: 1%;">
                                                <i class="ace-icon fa fa-times"></i>
                                                fermer
                                            </button>
                                            <button class="btn btn-sm btn-primary pull-right" data-dismiss="modal" ng-click="AjouterProjet()">
                                                <i class="ace-icon fa fa-plus"></i>
                                                Ajouter
                                            </button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                                            <div class="col-md-4">
                                                <label>Responsable budget</label>
                                                <?php echo $form['responsable_id']->renderError() ?>
                                                <?php echo $form['responsable_id'] ?>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Origine</label>
                                                <?php echo $form['id_source']->renderError() ?>
                                                <?php echo $form['id_source'] ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                            <?php //if ($form->getObject()->isNew()) {
?>
                            <fieldset style="margin-top: 20px;">
                                <blockquote style="padding: 0px 0px 0px 10px;">
                                    <legend>Action</legend>
                                </blockquote>
                                <button ng-if="etatbudget !== '2'" class="btn btn-xs btn-success" type="submit">
                                    <i class="ace-icon fa fa-save bigger-110"></i> Mettre à jour
                                </button>
                                <?php $user = $sf_user->getAttribute('userB2m');?>


                                    <a href="<?php echo url_for('@titrebudjet_Prototype') ?>" type="button" class="btn btn-white btn-primary">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">Retour à la liste</span>
                                    </a>

                            </fieldset>
                            <?php //}
?>
                        <?php else: ?>
                            <fieldset>
                                <blockquote style="padding: 0px 0px 0px 10px;">
                                    <legend>Identification du responsable suivi Budget</legend>
                                </blockquote>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><label>Utilisateur unité Budget</label></td>
                                            <td colspan="3" class="disabledbutton">
                                                <?php echo $form['id_user']->renderError() ?>
                                                <?php echo $form['id_user'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Nom & Prénom</label></td>
                                            <td>
                                                <?php
$user = new Utilisateur;
$user = $sf_user->getAttribute('userB2m');
echo $user->getAgents()->getNomcomplet()
?>
                                            </td>
                                            <td><label>E-mail / Gsm / Poste</label></td>
                                            <td><?php echo $user->getAgents()->getMail() . '/' . $user->getAgents()->getGsm(); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                            <fieldset style="margin-top: 20px;">
                                <blockquote style="padding: 0px 0px 0px 10px;">
                                    <legend>Informations sur le Budget</legend>
                                </blockquote>
                                <table>
                                    <tbody>
                                        <?php if (strcmp($prototype, "Prototype") != 0) {?>
                                            <tr>
                                                <td><label>Date de Création</label></td>
                                                <td>
                                                    <?php echo $form['datecreation']->renderError() ?>
                                                    <?php echo $form['datecreation']->render(array("onchange" => "setTypeBudget()")) ?>
                                                </td>
                                                <td colspan="5"></td>
                                            </tr>
                                        <?php }?>
                                        <tr>
                                            <td><label>Nom Budget</label></td>
                                            <td colspan="3">
                                                <?php echo $form['libelle']->renderError() ?>
                                                <?php echo $form['libelle'] ?>
                                            </td>
                                            <td><label>Type Budget</label></td>
                                            <td class="disabledbutton">
                                                <?php echo $form['typebudget']->renderError() ?>
                                                <?php echo $form['typebudget']->render(array('value' => $typebudget)) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Projet</label></td>
                                            <td class="disabledbutton">
                                                <?php echo $form['id_projet']->renderError() ?>
                                                <?php echo $form['id_projet'] ?>
                                            </td>
                                            <td><label>Origine</label></td>
                                            <td class="disabledbutton">
                                                <?php echo $form['id_source']->renderError() ?>
                                                <?php echo $form['id_source'] ?>
                                            </td>
                                            <td><label>Catégorie</label></td>
                                            <td class="disabledbutton">
                                                <?php echo $form['id_cat']->renderError() ?>
                                                <?php echo $form['id_cat'] ?>
                                            </td>
                                        </tr>
                                        <?php if (strcmp($prototype, "Prototype") != 0) {?>
                                            <tr>
                                                <td><label>Montant Global en TND</label></td>
                                                <td class="disabledbutton">
                                                    <?php echo $form['mntglobal']->renderError() ?>
                                                    <?php echo $form['mntglobal'] ?>
                                                </td>
                                                <td colspan="2"><label>Montant Externe en TND</label></td>
                                                <td colspan="2" class="disabledbutton">
                                                    <?php echo $form['mntexterne']->renderError() ?>
                                                    <?php echo $form['mntexterne'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Prototype Ou Transfert Fiche Budget</label></td>
                                                <td colspan="5" class="disabledbutton">
                                                    <?php
//                                                $annees_mois_un = date('Y') - 1;
    $budget_titre = new Titrebudjet();
    $prototype = Doctrine_Core::getTable('titrebudjet')
        ->createQuery('a')
    //                                                        ->where('etatbudget=2')
        ->AndWhere("trim(typebudget) like trim('" . "Prototype" . "')")
    //                                                        ->orwhere("trim(typebudget) like trim('Exercice:" . $annees_mois_un . "')")
        ->orderBy("a.libelle")
        ->execute();
    ?>
                                                    <select name="prototypebudget">
                                                        <option value="0">Sélectionnez</option>
                                                        <?php
$selected = "";
    $id_titre_budget = -1;
    if (!$form->getObject()->isNew() && $form->getObject()->getIdTitrebudget()) {
        $selected = 'selected="selected"';
        $id_titre_budget = $form->getObject()->getIdTitrebudget();
    }
    foreach ($prototype as $titre) {
        $budget_titre = $titre;
        ?>
                                                            <option value="<?php echo $budget_titre->getId() ?>" <?php if ($id_titre_budget == $budget_titre->getId()) {
            echo $selected;
        }
        ?>><?php echo $budget_titre ?></option>
                                                        <?php }?>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </fieldset>
                            <fieldset style="margin-top: 20px;">
                                <blockquote style="padding: 0px 0px 0px 10px;">
                                    <legend>Action</legend>
                                </blockquote>
                                <?php if ($typebudget != 'Prototype'): ?>
                                    <a href="<?php echo url_for('@titrebudjet') ?>" type="button" class="btn btn-white btn-primary">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">Retour à la liste</span>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo url_for('titrebudjet/index?type=prototype') ?>" type="button" class="btn btn-white btn-primary">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">Retour à la liste</span>
                                    </a>
                                <?php endif;?>
                            </fieldset>
                        <?php endif;?>
                    </div>
                    <div id="messages" class="tab-pane fade">
                        <?php
$form_ligne = new LigprotitrubForm();
$ligne = new Ligprotitrub();
include_partial('ligprotitrub/form_ligne_budget_prototype', array('lignebudget' => $ligne, 'form' => $form_ligne, 'formdetail' => $form, 'prototype' => $prototype, 'typebudget' => $typebudget));
?>
                    </div>

                </div>
            </div>
        </div>
        <!--/.col -->
    </div>
</div>

<script type="text/javascript">
    <?php if ($typebudget != 'Prototype'): ?>
        <?php if ($form->getObject()->isNew()): ?>
            $('#titrebudjet_datecreation').val('<?php echo $_SESSION['exercice_budget'] . date('-m-d'); ?>');
            setTypeBudget();
        <?php else: ?>
            $('#titrebudjet_datecreation').val('<?php echo $form->getObject()->getDatecreation(); ?>');
        <?php endif;?>
    <?php endif;?>

    function setTypeBudget() {
        var input = $('#titrebudjet_datecreation').val();
        var d = new Date(input);
        if (!!d.valueOf()) { // Valid date
            var year = d.getFullYear();
            year = 'Exercice:' + year;
            $('#titrebudjet_typebudget').val(year);
        } else {
            /* Invalid date */
            $('#titrebudjet_typebudget').val('Exercice:<?php echo date('Y'); ?>');
        }
    }
</script>

<style>
    label {
        font-weight: bold;
    }
</style>