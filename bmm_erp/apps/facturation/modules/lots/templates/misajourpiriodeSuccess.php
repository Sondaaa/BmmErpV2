<?php use_helper('I18N', 'Date') ?>
<?php include_partial('lots/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Mise à jour fiche Bénéficiaire', array(), 'messages') ?></h1>
    <div id="sf_admin_content">
        <div class="col-sm-12" ng-controller="myCtrlios">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            <i class="green ace-icon fa fa-user bigger-120"></i>
                            Fiche Bénéficiaire
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <fieldset>
                            <div class="col-lg-6" >
                                <fieldset >
                                    <legend>Information <?php echo "Bénéficiaire" . $lots ?></legend>
                                    <table class="disabledbutton">
                                        <tbody>
                                            <tr>
                                                <td ><label>Fournisseur</label></td>
                                                <td >
                                                    <?php echo $form->getObject()->getFournisseur() ?>
                                                </td>
                                                <td ><label>RABAIS</label></td>
                                                <td >
                                                    <?php echo $form['rrr']->renderError() ?>
                                                    <?php echo $form['rrr'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td ><label>N°Ordre</label></td>
                                                <td style="width: 50px">
                                                    <?php echo $form['nordre']->renderError() ?>
                                                    <?php echo $form['nordre']->render(array('value' => $lot, 'class' => 'disabledbutton')) ?>
                                                </td>

                                                <td ><label>Marchés</label></td>
                                                <td >
                                                    <?php echo $form['id_marche']->renderError() ?>
                                                    <?php echo $form['id_marche'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>TOTAL GENERAL HTVA</label></td>
                                                <td style="width: 30%">
                                                    <?php echo $form['totalht']->renderError() ?>
                                                    <?php echo $form['totalht'] ?>
                                                </td>
                                                <td ><label>TVA</label></td>
                                                <td>
                                                    <?php echo $form['id_tva']->renderError() ?>
                                                    <?php echo $form['id_tva'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>TOTAL GENERAL HTVA APRES RABAIS</label></td>
                                                <td>
                                                    <?php echo $form['totalapresrrr']->renderError() ?>
                                                    <?php echo $form['totalapresrrr'] ?>
                                                </td>
                                                <td ><label>Net à payer TTC</label></td>
                                                <td style="width: 30%">
                                                    <?php echo $form['ttcnet']->renderError() ?>
                                                    <?php echo $form['ttcnet'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Objet</label></td>
                                                <td colspan="5">
                                                    <?php echo $form['objet']->renderError() ?>
                                                    <?php echo $form['objet'] ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset>
                                    <legend>Délai & Période </legend>
                                    <table >
                                        <tbody>
                                            <tr>
                                                <td><label>Date ordre de service</label></td>
                                                <td class="disabledbutton">
                                                    <?php echo $form['dateoservice']->renderError() ?>
                                                    <?php echo $form['dateoservice'] ?>
                                                </td>
                                                <td><label>Date réception provisoire</label></td>
                                                <td>
                                                    <?php echo $form['datereceptionprevesoire']->renderError() ?>
                                                    <?php echo $form['datereceptionprevesoire'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Délai d'exécution</label></td>
                                                <td class="disabledbutton">
                                                    <?php echo $form['delaidexucution']->renderError() ?>
                                                    <?php echo $form['delaidexucution'] ?>
                                                </td>
                                                <td ><label>Période d'arrêt justifiée</label></td>
                                                <td >
                                                    <?php echo $form['periodejustifier']->renderError() ?>
                                                    <?php echo $form['periodejustifier'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td ><label>Délai contractuelle</label></td>
                                                <td >
                                                    <?php echo $form['delaicontractuelle']->renderError() ?>
                                                    <?php echo $form['delaicontractuelle'] ?>
                                                </td>
                                                <td ><label>Période réel d'execution</label></td>
                                                <td>
                                                    <?php echo $form['pireodereelexecution']->renderError() ?>
                                                    <?php echo $form['pireodereelexecution'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td ><label>Période de reatard</label></td>
                                                <td >
                                                    <?php echo $form['pirioderetard']->renderError() ?>
                                                    <?php echo $form['pirioderetard'] ?>
                                                </td>
                                                <td><label>Pénalité de retard</label></td>
                                                <td>
                                                    <input type="hidden" id="mntp1" value="<?php echo $marche->getPenalite() ?>">
                                                    <input type="hidden" id="mntp2" value="<?php echo $marche->getMaxpinalite() ?>">
                                                    <input type="text" id="mnt_pinaliter" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td ><label>Action</label></td>
                                                <td colspan="5">
                                                    <input type="button" value="Mettre à jour" ng-click="Misajourfichebinificiare(<?php echo $form->getObject()->getId() ?>)">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div><!--/.col -->
    </div>
    <div id = "sf_admin_footer">

    </div>
</div>