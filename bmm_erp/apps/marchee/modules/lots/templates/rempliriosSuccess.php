<?php use_helper('I18N', 'Date') ?>
<?php include_partial('lots/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Mise à jour fiche Bénéficiaire', array(), 'messages') ?></h1>
    <div id="sf_admin_content">
        <div class="col-sm-12" ng-controller="myCtrlios">
            <div class="tabbable tabs-left">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            <i class="blue ace-icon fa fa-user bigger-120"></i>
                            Fiche Bénéficiaire
                        </a>
                    </li>
                    <?php
                    $ordres = new Ordredeservice();
                    $array = array();
                    $i = 0;
                    foreach ($OSS as $odsss) {
                        $ordres = $odsss;
                        $array[$i] = $ordres->getId();
                        $i++;
                        ?>
                        <li>
                            <a data-toggle="tab" href="#or<?php echo $ordres->getId() ?>" ng-class="DesigneCheckeditor(<?php echo $ordres->getId() ?>)" >
                                <?php if ($ordres->getIdType() == 1): ?>
                                    <i class="green ace-icon fa fa-circle-o bigger-120"></i>
                                    OS :<br> <?php echo $ordres->getTypeios() ?>
                                <?php elseif ($ordres->getIdType() == 4): ?>
                                    <i class="red ace-icon fa fa-ban bigger-120"></i>
                                    OS :<br> <?php echo $ordres->getTypeios() ?>
                                <?php elseif ($ordres->getIdType() == 5): ?>
                                    <i class="green ace-icon fa fa-adjust bigger-120"></i>
                                    OS :<br> <?php echo $ordres->getTypeios() ?>
                                <?php elseif ($ordres->getIdType() == 6): ?>
                                    <i class="blue ace-icon fa fa-info-circle bigger-120"></i>
                                    OS :<br> <?php echo $ordres->getTypeios() ?>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <fieldset>
                            <legend>Information <?php echo "Bénéficiaire : " . $lots->getFournisseur() . " |=> LOTS : " . $lots->getNordre() ?></legend>
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
                                            <td colspan="3">
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
                                            <td colspan="3">
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
                                <?php include_partial('lots/form_action_ios', array('type' => "ios", 'idlot' => $form->getObject()->getId(), 'formlot' => $form, 'OSARRET' => $OSARRET, 'OSREPISE' => $OSREPISE, 'OSCOMMTRAVAUX' => $OSCOMMTRAVAUX)); ?>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Liste des documents scannés</legend>
                            <?php
                            $formp = new PiecejointForm();
                            if(count($array)>0)
                            $piecejoints = Doctrine_Core::getTable('piecejoint')
                                            ->createQuery('a')
                                            ->whereIn('id_ordreservice', $array)->execute();
                            else
                                $piecejoints=[];
                            //Doctrine_Core::getTable('piecejoint')->findByIdOrdreservice($form->getObject()->getId());
                            //  include_partial('document/formparcourrier', array('form' => $formp, 'ordre' => $ordre, 'piecejoints' => $piecejoints));
                            ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Objet</th>
                                        <th>Chemin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($piecejoints as $piecejoint): ?>
                                        <tr>
                                            <td><?php echo $piecejoint->getObjet() ?></td>
                                            <td>
                                                <a target="_blanc" href="<?php echo sfconfig::get('sf_appdir') . 'uploads/scanner/' . $piecejoint->getChemin() ?>">
                                                    <?php echo $piecejoint->getChemin() ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php echo url_for('document/delete?id=' . $piecejoint->getId() . '&idtab=' . $_REQUEST['idtab']) ?>">Supprimer</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                    <?php
                    foreach ($OSS as $od) {
                        $ordres = Doctrine_Core::getTable('ordredeservice')->findOneById($od->getId());
                        $formios = new OrdredeserviceForm($ordres);
                        ?>
                        <div id="or<?php echo $ordres->getId() ?>" class="tab-pane fade">
                            <?php include_partial('ordredeservice/form_ios_c', array('formlot' => $form, 'ordres' => $ordres, 'formios' => $formios)); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div><!--/.col -->
    </div>

    <div id = "sf_admin_footer">

    </div>
</div>