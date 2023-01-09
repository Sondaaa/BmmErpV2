<div class="row" >
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller"> </h4>
            </div>
            <div class="widget-body" ng-init="InitialiserSociete()">
                <div class="widget-main" style="min-height: 200px;">
                    <fieldset>
                        <table>
                            <tr>
                                <td>Agents </td>
                                <td>
                                    <?php echo $form['id_agents']->renderError() ?>
                                    <?php echo $form['id_agents'] ?>
                                </td>

                                <td class="disabledbutton">
                                    <input type="text" ng-model="idrh.text" id="idrh" placeholder="Matricule"  class="form-control">
                                    <input type="text" ng-model="nom.text" id="nom" placeholder="Nom"   class="form-control">
                                </td>
                                <td colspan="2" class="disabledbutton">
                                    <input type="text" ng-model="prenom.text" id="prenom" placeholder="Prénom"   class="form-control">
                                    <input type="text" ng-model="adresse.text" id="adresse" placeholder="Adresse"  class="form-control">


                                </td>
                                <td class="disabledbutton">
                                    <input type="text" ng-model="codepostal.text" id="codepostal" placeholder="Code Postal"   class="form-control">
                                    <input type="text" ng-model="email.text" id="email" placeholder="Email"   class="form-control">
                                </td>

                            </tr>
                            <tr>

                                <td>Fournisseur </td>
                                <td  id="fournisseur" colspan="5">
                                    <input type="hidden" id="id_fournisseur" value="<?php echo $retenuesursalaire->getIdFournisseur() ?>">
                                    <?php echo $form['id_fournisseur']->renderError() ?>
                                    <?php echo $form['id_fournisseur'] ?>
                                </td>
                            <tr>
                                <td>Date Demande Retenue Sur Salaire</td>
                                <td>
                                    <?php echo $form['datedemande']->renderError() ?>
                                    <?php echo $form['datedemande'] ?>
                                </td>
                                <td>Date début Retenue </td>
                                <td>
                                    <?php echo $form['datedebut']->renderError() ?>
                                    <?php echo $form['datedebut'] ?>
                                </td>
                                <td>Date Fin  Retenue </td>
                                <td>
                                    <?php echo $form['datefin']->renderError() ?>
                                    <?php echo $form['datefin'] ?>
                                </td>

                            </tr>
                            <tr>
                                <td>Montant de Prêt</td>
                                <td>
                                    <?php echo $form['montantpret']->renderError() ?>
                                    <?php echo $form['montantpret'] ?>
                                </td>
                                <td>Période</td>
                                <td class="disabledbutton">
                                    <?php echo $form['nbrmois']->renderError() ?>
                                    <?php echo $form['nbrmois'] ?>
                                </td>
                                <td>Retenue Mensuel</td>
                                <td>
                                    <?php echo $form['retenuesursalaire']->renderError() ?>
                                    <?php echo $form['retenuesursalaire'] ?>
                                </td>
                                <td style="display: none">
                                    <?php echo $form['mois']->renderError() ?>
                                    <?php echo $form['mois'] ?>
                                </td>
                                <td style="display: none">
                                    <?php echo $form['annee']->renderError() ?>
                                    <?php echo $form['annee'] ?>
                                </td>

                            </tr>
                        </table>
                    </fieldset>


                </div>

            </div>
        </div>
    </div>
</div>



<style>

    .bootstrap-duallistbox-container .info {
        font-size: 14px;
    }

</style>