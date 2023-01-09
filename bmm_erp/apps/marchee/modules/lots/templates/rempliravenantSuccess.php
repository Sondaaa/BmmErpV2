<?php use_helper('I18N', 'Date') ?>
<?php include_partial('lots/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Mise à jour fiche bénéficiaire', array(), 'messages') ?></h1>
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
                    <?php
                    $ordres = new Ordredeservice();
                    foreach ($listesordredeservice as $od) {
                        $ordres = $od;
                        ?>
                        <li>
                            <a data-toggle="tab" href="#or<?php echo $ordres->getId() ?>"  >
                                <i class="green ace-icon fa fa-money bigger-120"></i>
                                <?php echo $ordres->getTypeios() ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <fieldset>
                            <legend>Information <?php echo "Bénéficiaire " . $lots->getNordre(); ?></legend>
                            <div class="col-lg-9">
                                <table class="disabledbutton">
                                    <tbody>
                                        <tr>
                                            <td><label>Fournisseur</label></td>
                                            <td colspan="5">
                                                <?php echo $form->getObject()->getFournisseur() ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>N° Ordre</label></td>
                                            <td>
                                                <?php echo $form['nordre']->renderError() ?>
                                                <?php echo $form['nordre']->render(array('value' => $lots->getNordre(), 'class' => 'disabledbutton')) ?>
                                            </td>
                                            <td><label>Marchés</label></td>
                                            <td>
                                                <?php echo $form['id_marche']->renderError() ?>
                                                <?php echo $form['id_marche'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%;"><label>TOTAL GENERAL HTVA</label></td>
                                            <td style="width: 20%;">
                                                <?php echo $form['totalht']->renderError() ?>
                                                <?php echo $form['totalht'] ?>
                                            </td>
                                            <td style="width: 17%;"><label>TVA</label></td>
                                            <td style="width: 12%;">
                                                <?php echo $form['id_tva']->renderError() ?>
                                                <?php echo $form['id_tva'] ?>
                                            </td>
                                            <td style="width: 10%;"><label>RABAIS</label></td>
                                            <td style="width: 11%;">
                                                <?php echo $form['rrr']->renderError() ?>
                                                <?php echo $form['rrr'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>TOTAL GENERAL HTVA APRES RABAIS</label></td>
                                            <td>
                                                <?php echo $form['totalapresrrr']->renderError() ?>
                                                <?php echo $form['totalapresrrr'] ?>
                                            </td>
                                            <td><label>Net à payer TTC</label></td>
                                            <td>
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
                            </div>
                            <div class="col-lg-3">
                                <?php include_partial('lots/form_action_ios', array('idlot' => $form->getObject()->getId(), 'type' => "date", 'formlot' => $form, 'listesordredeservice' => $listesordredeservice, 'OSARRET' => null, 'OSREPISE' => null, 'OSCOMMTRAVAUX' => null)); ?>
                            </div>
                        </fieldset>
                    </div>
                    <?php
                    foreach ($listesordredeservice as $od) {
                        $ordres = Doctrine_Core::getTable('ordredeservice')->findOneById($od->getId());
                        $formios = new OrdredeserviceForm($ordres);
                        ?>
                        <div id="or<?php echo $ordres->getId() ?>" class="tab-pane fade">
                            <?php include_partial('ordredeservice/form_ios_type_date', array('formlot' => $form, 'ordres' => $ordres, 'formios' => $formios)); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div><!--/.col -->
    </div>

    <div id = "sf_admin_footer">

    </div>
</div>