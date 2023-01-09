<?php

$typebudget = "Exercice:" . date('Y');

$tranches=null;
if (!$form->getObject()->isNew()) {
    $typebudget = trim($form->getObject()->getTypebudget());
    $prototype = trim($form->getObject()->getTypebudget());
    $tranches = TranchebudgetTable::getInstance()->findByIdTitrebudget($form->getObject()->getId());
    
}
?>
<div id="sf_admin_container">
    <div id="sf_admin_content">
        <div class="col-sm-12">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab" ng-click="InialiserChampsTitres()">
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            <i class="green ace-icon fa fa-usb bigger-120"></i>
                            Entête Fiche Budget
                        </a>
                    </li>
                    <?php if ($tranches && $tranches->count() > 0) : ?>
                        <?php foreach ($tranches as $tranche) : ?>
                            <li>
                                <a data-toggle="tab" href="#tranche_<?php echo $tranche->getId() ?>">
                                    <i class="green ace-icon fa fa-pencil-square-o bigger-120"></i>
                                    <?php echo $tranche->getLibelle() ?>
                                </a>
                            </li>
                        <?php endforeach ?>
                    <?php endif ?>

                    <li <?php if ($form->getObject()->isNew()) echo "style='display:none'" ?>>
                        <a data-toggle="tab" href="#scan">
                            <i class="green ace-icon fa fa-print bigger-120"></i>
                            Scan Documents
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active" ng-init="Inialisation(<?php echo $sf_user->getAttribute('userB2m')->getId() ?>)">

                        <fieldset class="disabledbutton">
                            <blockquote style="padding: 0px 0px 0px 10px;">
                                <legend>Identification du responsable suivi Budget</legend>
                            </blockquote>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget-box">
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <div class="row alert alert-info">
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            <label>Date de Création</label>
                                                            <?php echo $form['datecreation']->renderError() ?>
                                                            <?php echo $form['datecreation']->render() ?>
                                                            <br>
                                                            <label>Utilisateur unité Budget</label>
                                                            <?php echo $form['id_user']->renderError() ?>
                                                            <?php echo $form['id_user'] ?>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Nom & Prénom</label>
                                                            <p><?php
                                                                $user = new Utilisateur();
                                                                $user = $sf_user->getAttribute('userB2m');
                                                                echo $user->getAgents()->getNomcomplet()
                                                                ?></p>
                                                            <label>E-mail / Gsm / Poste</label>
                                                            <p><?php echo $user->getAgents()->getMail() . '/' . $user->getAgents()->getGsm(); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset style="margin-top: 20px;">
                            <blockquote style="padding: 0px 0px 0px 10px;">
                                <legend>Informations sur le Budget</legend>
                            </blockquote>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget-box">
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <div class="row alert alert-success">
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label>Date d'overture</label>

                                                            <?php echo $form['date_opened']->renderError() ?>
                                                            <?php echo $form['date_opened']->render() ?>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Date de clôture provisoire </label>

                                                            <?php echo $form['date_closedp']->renderError() ?>
                                                            <?php echo $form['date_closedp']->render() ?>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Date de clôture définitive</label>

                                                            <?php echo $form['date_closed']->renderError() ?>
                                                            <?php echo $form['date_closed']->render() ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget-box">
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <div class="row alert alert-danger">
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label>Catégorie</label>
                                                            <?php if ($form->getObject()->isNew()) : ?>


                                                                <?php echo $form['id_cat']->renderError() ?>
                                                                <?php echo $form['id_cat'] ?>
                                                            <?php else : ?>
                                                                <input readonly type="text" value="<?php echo $form->getObject()->getCategorietitre() ?>" class="form-control">
                                                            <?php endif ?>

                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Nom Budget</label>

                                                            <?php echo $form['libelle']->renderError() ?>
                                                            <?php echo $form['libelle'] ?>


                                                        </div>
                                                        <div class="col-md-4 disabledbutton">
                                                            <label>Type Budget</label>

                                                            <?php echo $form['typebudget']->renderError() ?>
                                                            <?php echo $form['typebudget']->render(array('value' => $typebudget)) ?>

                                                        </div>
                                                        <div class="col-md-4  <?php if (!$form->getObject()->isNew()) : echo 'disabledbutton'; endif; ?>">
                                                            <label>Projet</label>

                                                            <?php echo $form['id_projet']->renderError() ?>
                                                            <?php echo $form['id_projet'] ?>


                                                        </div>
                                                        <div class="col-md-4 <?php if (!$form->getObject()->isNew()) : echo 'disabledbutton'; endif; ?>">
                                                            <label>Origine</label>

                                                            <?php echo $form['id_source']->renderError() ?>
                                                            <?php echo $form['id_source'] ?>


                                                        </div>
                                                        <div class="col-md-4 <?php if (!$form->getObject()->isNew()) : echo 'disabledbutton'; endif; ?>">
                                                            <label>Prototype Ou Transfert Fiche Budget</label>

                                                            <?php
                                                            $budget_titre = new Titrebudjet();
                                                            $prototype = Doctrine_Core::getTable('titrebudjet')
                                                                ->createQuery('a')
                                                                ->AndWhere("trim(typebudget) like trim('" . "Prototype" . "')")
                                                                ->orderBy("a.libelle")
                                                                ->execute();
                                                            ?>
                                                            <select name="prototypebudget" id="prototypebudget">
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
                                                                    <option value="<?php echo $budget_titre->getId() ?>" <?php if ($id_titre_budget == $budget_titre->getId()) echo $selected; ?>><?php echo $budget_titre ?></option>
                                                                <?php } ?>
                                                            </select>


                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                        <div class="widget-body  ">
                                            <div class="widget-main">
                                                <div class="row alert alert-danger">
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label>Montant Global en TND</label>
                                                            <?php if ($form->getObject()->isNew()) : ?>
                                                                <?php echo $form['mntglobal']->renderError() ?>
                                                                <?php echo $form['mntglobal'] ?>
                                                            <?php else : ?>
                                                                <input readonly type="text" value="<?php echo $form->getObject()->getMntglobal() ?>" class="form-control">
                                                            <?php endif ?>

                                                        </div>
                                                        <div class="col-md-4 disabledbutton">
                                                            <label>Montant Externe en TND</label>

                                                            <?php echo $form['mntexterne']->renderError() ?>
                                                            <?php echo $form['mntexterne'] ?>


                                                        </div>
                                                        <div class="col-md-4 disabledbutton">
                                                            <label>Montant Reste des engagement en TND</label>

                                                            <?php echo $form['mnt_restant']->renderError() ?>
                                                            <?php echo $form['mnt_restant'] ?>


                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget-box">

                                        <div class="widget-body">
                                            <div class="row alert alert-warning">
                                                <div class="col-md-12">
                                                    
                                                    <a href="<?php echo url_for('@titrebudjet') ?>" type="button" class="btn btn-xs btn-default">
                                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                                        <span class="bigger-110 no-text-shadow">Retour à la liste</span>
                                                    </a>
                                                    <!-- <button  class="btn btn-xs btn-success" type="submit">
                                                        <i class="ace-icon fa fa-save bigger-110"></i> Mettre à jour
                                                    </button> -->
                                                    <?php if (!$form->getObject()->isNew()) : ?>
                                                        <?php 
                                                            $sum_tranche=TranchebudgetTable::getInstance()->getSumTranche($form->getObject()->getId());
                                                            $tranches_not_cheked=TranchebudgetTable::getInstance()->getTranchesNotChecked($form->getObject()->getId());
                                                            $tranches_count=TranchebudgetTable::getInstance()->findByIdTitrebudget($form->getObject()->getId())->count();
                                                            $diff=0;
                                                            if(!$form->getObject()->isNew())
                                                                $diff=$form->getObject()->getMntglobal()-$sum_tranche;
                                                            if($tranches_count==0 || $tranches_not_cheked->getFirst()&& $diff>0):
                                                            ?>
                                                        <!-- <a data-target="#modal-addtranche" role="button" data-toggle="modal" class="btn btn-xs btn-primary">
                                                            <i class="fa fa-plus"></i> Ajouter Tranche
                                                        </a> -->
                                                        <?php endif;?>

                                                    <?php endif ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="modal-addtranche" class="modal fade" tabindex="-1" style="width: 1200px;display: none">
                                <?php include_partial('titrebudjet/add_tranche', array('form' => $form)); ?>
                            </div>
                        </fieldset>


                    </div>
                    <?php if ($tranches && $tranches->count() > 0) : ?>
                        <?php foreach ($tranches as $tranche) : ?>
                            <div id="tranche_<?php echo $tranche->getId() ?>" class="tab-pane fade">
                                <?php
                                $form_ligne = new LigprotitrubForm();
                                $ligne = new Ligprotitrub();
                                if(!$tranche->getEtattranche())
                                include_partial('ligprotitrub/form_ligne_budget', array('tranche' => $tranche, 'lignebudget' => $ligne, 'form' => $form_ligne, 'formdetail' => $form, 'prototype' => $prototype, 'typebudget' => $typebudget));
                                else
                                include_partial('ligprotitrub/form_ligne_tranchefinal', array('tranche' => $tranche, 'lignebudget' => $ligne, 'form' => $form_ligne, 'formdetail' => $form, 'prototype' => $prototype, 'typebudget' => $typebudget));
                                ?>
                            </div>

                        <?php endforeach ?>
                    <?php endif ?>
                    <div id="scan" class="tab-pane fade">
                        <?php
                        if (!$form->getObject()->isNew()) {
                            $id = $form->getObject()->getId();
                            $budget = $form->getObject();
                            include_partial('Scan/formscan', array('id' => $id, 'budget' => $budget));
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
        <!--/.col -->
    </div>
</div>
<?php if ($form->getObject()->isNew()) : ?>
    <script type="text/javascript">
        $('#titrebudjet_id_cat').change(function() {
            if (!isNaN($('#titrebudjet_id_cat').val())) {
                datasource = {
                    id_categorie: $('#titrebudjet_id_cat').val()
                }
                $.ajax({
                    url: '<?php echo url_for('titrebudjet/SearchBudgetPrototype') ?>',
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify(datasource),
                    success: function(response) {
                        data = response.data;
                        json = data[data.length - 1];
                        $('#prototypebudget').val(json.id);
                        $('#titrebudjet_id_projet').val(json.id_projet);
                        $('#titrebudjet_responsable_id').val(json.responsable_id);
                        $('#titrebudjet_id_source').val(json.id_source);
                        $('#prototypebudget').trigger("chosen:updated");
                        $('#titrebudjet_id_projet').trigger("chosen:updated");
                        $('#titrebudjet_responsable_id').trigger("chosen:updated");
                        $('#titrebudjet_id_source').trigger("chosen:updated");
                        $('#titrebudjet_libelle').val($('#titrebudjet_id_cat option:selected').text() + '  ' + '<?php echo $_SESSION['exercice_budget']  ?>')
                    }
                });
            }

        });
    </script>

<?php endif; ?>
<script type="text/javascript">
    <?php if ($typebudget != 'Prototype') : ?>
        <?php if ($form->getObject()->isNew()) : ?>
            $('#titrebudjet_datecreation').val('<?php echo $_SESSION['exercice_budget'] . date('-m-d'); ?>');
            setTypeBudget();
        <?php else : ?>
            $('#titrebudjet_datecreation').val('<?php echo $form->getObject()->getDatecreation(); ?>');
        <?php endif; ?>
    <?php endif; ?>

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