<?php use_helper('I18N', 'Date') ?>
<?php include_partial('lots/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Détail fiche bénéficiaire '. $form->getObject()->getFournisseur()  , array(), 'messages') ?></h1>

    <?php include_partial('lots/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('lots/form_header', array('lots' => $lots, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php
        if (!$form->getObject()->isNew())
            $lot = $form->getObject()->getNordre();
        ?>
        <div class="col-sm-12" ng-controller="CtrlSousdetail">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            <i class="green ace-icon fa fa-user bigger-120"></i>
                            Fiche Bénéficiaire 
                        </a>
                    </li>
                    <li>
                        <input type="hidden" id="detailprixid" value="<?php echo $form->getObject()->getId() ?>">
                        <a data-toggle="tab" href="#messages" ng-click="InialiserChamps();AfficheDetailPrix(<?php echo $form->getObject()->getId() ?>);AfficheSousDetailPrix(<?php echo $form->getObject()->getId() ?>)">
                            <i class="green ace-icon fa fa-money bigger-120"></i>
                            Sous Détail de prix
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <fieldset class="disabledbutton">
                            <legend>Information <?php echo "Bénéficiaire " .  $form->getObject()->getFournisseur() ?></legend>
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="width: 15%"><label>N° Ordre</label></td>
                                        <td style="width: 15%">
                                            <?php echo $form['nordre']->renderError() ?>
                                            <?php echo $form['nordre']->render(array('value' => $lot, 'class' => 'disabledbutton')) ?>
                                        </td>
                                        <td style="width: 15%"><label>Marchés</label></td>
                                        <td style="width: 15%">
                                            <?php echo $form['id_marche']->renderError() ?>
                                            <?php echo $form['id_marche'] ?>
                                        </td>
                                        <td style="width: 10%"><label>Fournisseur</label></td>
                                        <td style="width: 30%">
                                            <?php echo $form['id_frs']->renderError() ?>
                                            <?php echo $form['id_frs'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>TOTAL GENERAL HTVA</label></td>
                                        <td>
                                            <?php echo $form['totalht']->renderError() ?>
                                            <?php echo $form['totalht'] ?>
                                        </td>
                                        <td><label>TVA</label></td>
                                        <td>
                                            <?php echo $form['id_tva']->renderError() ?>
                                            <?php echo $form['id_tva'] ?>
                                        </td>
                                        <td><label>RABAIS</label></td>
                                        <td>
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
                        </fieldset>
                    </div>
                    <div id="messages" class="tab-pane fade">
                        <?php
                        $formsousdetail = new SousdetailprixForm();
                        $sousdetailprix = new Sousdetailprix();
                        include_partial('sousdetailprix/form_detail_sous_detail', array('sousdetailprix' => $sousdetailprix, 'form' => $formsousdetail,'formlot'=>$form));
                        ?>
                    </div>
                </div>
            </div>
        </div><!--/.col -->
    </div>
    <div id ="sf_admin_footer">
        <?php include_partial('lots/form_footer', array('lots' => $lots, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>