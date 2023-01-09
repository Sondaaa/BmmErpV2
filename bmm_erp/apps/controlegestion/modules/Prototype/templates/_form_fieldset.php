<?php
$typebudget = "Prototype";
$prototype="Prototype";

?>
<div id="sf_admin_container" ng-controller="myCtrlbudget">
    <div id="sf_admin_content">
        <div class="col-sm-12">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab" ng-click="InialiserChampsTitres()">
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            <i class="green ace-icon fa fa-usb bigger-120"></i>
                            Entête Fiche Prototype
                        </a>
                    </li>
                    <li <?php if ($form->getObject()->isNew()) echo "style='display:none'" ?>>
                        <input type="hidden" id="detailprixid" value="<?php echo $form->getObject()->getId() ?>">
                        <a data-toggle="tab" href="#messages" ng-click="InialiserChamps();
                            AfficheSousDetailPrix('<?php echo $form->getObject()->getId() ?>')">
                            <i class="green ace-icon fa fa-money bigger-120"></i>
                            Détails Budget
                        </a>
                    </li>
                    
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active" ng-init="Inialisation(<?php echo $sf_user->getAttribute('userB2m')->getId() ?>)">
                        <fieldset class="disabledbutton">
                            <blockquote style="padding: 0px 0px 0px 10px;">
                                <legend>Identification du responsable</legend>
                            </blockquote>
                            <table>
                                <tbody>
                                    <tr>
                                        <td><label>Responsable unité</label></td>
                                        <td colspan="3">
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
                                  
                                    <tr>
                                        <td><label>Nom du prototype</label></td>
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
                                        <td>
                                            <?php echo $form['id_projet']->renderError() ?>
                                            <?php echo $form['id_projet'] ?>
                                        </td>
                                        <td><label>Origine</label></td>
                                        <td>
                                            <?php echo $form['id_source']->renderError() ?>
                                            <?php echo $form['id_source'] ?>
                                        </td>
                                        <td><label>Catégorie</label></td>
                                        <td>
                                            <?php echo $form['id_cat']->renderError() ?>
                                            <?php echo $form['id_cat'] ?>
                                        </td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                            <?php include_partial('Prototype/form_actions', array('titrebudjet' => $titrebudjet, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  
                        </fieldset>
                     
                        
                       
                    </div>
                    <div id="messages" class="tab-pane fade">
                        <?php
                        $form_ligne = new LigprotitrubForm();
                        $ligne = new Ligprotitrub();
                        include_partial('ligprotitrub/form_ligne_prototype', array('lignebudget' => $ligne, 'form' => $form_ligne, 'formdetail' => $form, 'prototype' => $prototype, 'typebudget' => $typebudget));
                        ?>
                    </div>
                   
                </div>
            </div>
        </div>
        <!--/.col -->
    </div>
</div>

<script>
    <?php if ($form->getObject()->isNew()) : ?>
        $('#titrebudjet_datecreation').val('<?php echo $_SESSION['exercice_budget'] . date('-m-d'); ?>');
    <?php else : ?>
        $('#titrebudjet_datecreation').val('<?php echo $form->getObject()->getDatecreation(); ?>');
    <?php endif; ?>
</script>

<style>
    label {
        font-weight: bold;
    }
</style>