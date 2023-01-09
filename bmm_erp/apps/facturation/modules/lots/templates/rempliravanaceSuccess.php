<?php use_helper('I18N', 'Date') ?>
<?php include_partial('lots/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Mise à jour fiche bénéficiaire', array(), 'messages') ?></h1>

    <?php include_partial('lots/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('lots/form_header', array('lots' => $lots, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
            <?php if ('NONE' != $fieldset): ?>
                <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
            <?php endif; ?>
        </fieldset>
        <?php
        if (!$form->getObject()->isNew() && !$lot)
            $lot = $form->getObject()->getNordre();
        ?>
        <div class="col-sm-12" ng-controller="myCtrldecompte">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            <i class="green ace-icon fa fa-user bigger-120"></i>
                            Fiche Bénificiare
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#messages" ng-click="InialiserChamps(); AfficheDetailPrix(<?php echo $form->getObject()->getId() ?>); AfficheSousDetailPrix(<?php echo $form->getObject()->getId() ?>)">
                            <i class="green ace-icon fa fa-money bigger-120"></i>
                            Décompte <?php
                            if ($decompte1)
                                echo $decompte1->getNumero();
                            else
                                echo '1'
                                ?>: Avance
                        </a>
                    </li>
                    <?php
                    $i = 2;
                    foreach ($listesDecompltes as $decom) {
                        ?>
                        <li>
                            <a data-toggle="tab" href="#decompte<?php echo $decom->getId() ?>" ng-click="AfficheSousDetails(<?php echo $decom->getId() ?>)" >
                                <i class="green ace-icon fa fa-money bigger-120"></i>
                                Décompte <?php
                                echo $i;
                                $i++;
                                ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <fieldset class="disabledbutton">
                            <legend>Information <?php echo "Bénéficiaire" ?><?php echo $form->getObject()->getFournisseur() ?></legend>
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="width: 15%"><label>N°Ordre</label></td>
                                        <td style="width: 20%">
                                            <?php echo $form['nordre']->renderError() ?>
                                            <?php echo $form['nordre']->render(array('value' => $lot, 'class' => 'disabledbutton')) ?>
                                        </td>
                                        <td style="width: 10%"><label>Marchés</label></td>
                                        <td style="width: 20%">
                                            <?php echo $form['id_marche']->renderError() ?>
                                            <?php echo $form['id_marche'] ?>
                                        </td>
                                        <td style="width: 10%"><label>Fournisseur</label></td>
                                        <td style="width: 25%">
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
                        <fieldset>
                            <legend>CERTIFICAT DE PAIEMENT</legend>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Indication des ouvrages</th>
                                        <th>Montant du marché</th>
                                        <th>Taux de l'avance</th>
                                        <th>Montant de l'avance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width: 40%">
                                            Conformément à l'article 15 du 
                                            CCAP une avance de <?php echo number_format($marche->getAvance(), 2) ?>% du
                                            montant du marché sera accordée à l'Entrepreneur
                                        </td>
                                        <td>
                                            <?php
                                            $ttcnet = number_format($form->getObject()->getTtcnet(), 3);
                                            echo number_format($form->getObject()->getTtcnet(), 3, ".", ",");
                                            ?> DT
                                        </td>
                                        <td>
                                            <?php
                                            $avaance = number_format($marche->getAvance(), 2);
                                            echo number_format($marche->getAvance(), 2)
                                            ?>%
                                        </td>
                                        <td>
                                            <?php
                                            if (!$decompte1) {
                                                $avance = $form->getObject()->getTtcnet() * ($avaance / 100);
                                                echo number_format($avance, 3, ".", ",");
                                            } else
                                                echo number_format($decompte1->getNetapayer(), 3, ".", ",");
                                            ?> DT
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>
                        <?php
                        if (!$decompte1) {
                            ?>
                            <a class="btn btn-white btn-danger" href="<?php echo url_for('lots/rempliravanace?btn=valide&id=' . $lots->getId()) ?>">Valider Avance</a>
                        <?php } ?>
                        <a class="btn btn-white btn-danger" href="<?php echo url_for('lots/rempliravanace?btn=creedecompte&id=' . $lots->getId()) ?>">Créer Décompte <?php echo $numerodecompte ?></a>
                    </div>
                    <?php foreach ($listesDecompltes as $decom) { ?>
                        <div id="decompte<?php echo $decom->getId() ?>" class="tab-pane fade">
                            <?php
                            $sousdetais = Doctrine_Core::getTable('sousdetailprix')
                                            ->createQuery('a')->where('id_detail=' . $decom->getId())
                                            ->orderBy('id asc')->execute();
                            include_partial('sousdetailprix/form_sousdetail_decompte', array('details' => $decom, 'formlot' => $form, 'SousDetails' => $sousdetais));
                            ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div><!--/.col -->
    </div>
    <div id = "sf_admin_footer">

    </div>
</div>