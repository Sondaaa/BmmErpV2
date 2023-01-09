<div id="sf_admin_container">
    <h1><?php echo'Mise à jour fiche Ordre de Service'; ?></h1>
    <div id="sf_admin_content">
        <div class="col-sm-12" ng-controller="myCtrlioscontrat" >
            <div class="tabbable tabs-left">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            <i class="blue ace-icon fa fa-user bigger-120"></i>
                            Fiche Contrat  
                        </a>
                    </li>
                    <?php
                    $ordres = new Ordredeservicecontratachat();
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
                            <legend>Information Contrat<br> <?php echo "Fournisseur : " . $contratachat->getFournisseur() ?></legend>
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
                                            <td><label>Contrat </label></td>
                                            <td>
                                                <?php echo $form->getObject()->getReference() . '   N°: ' . $form->getObject()->getNumero() ?>
                                            </td>
                                            <td><label>Document achat </label></td>
                                            <td colspan="3">
                                                <?php echo $form->getObject()->getDocumentachat()->getFirst()->getNumerodocumentachat() ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Date de création</td>
                                            <td style="text-align: cenetr"><?php echo date('d/m/Y', strtotime($form->getObject()->getDatecreation())); ?></td>

                                            <td>Date de Signature</td>
                                            <td style="text-align: cenetr">
                                                <?php if ($form->getObject()->getDatesigntaure()): ?>
                                                <?php echo date('d/m/Y', strtotime($form->getObject()->getDatesigntaure())); 
                                                  endif;?></td>
                                        </tr>
                                        <tr>
                                            <td>Type</td>
                                            <td >
                                                <?php
                                                if ($form->getObject()->getType() == 0)
                                                    echo 'Livraison Total ';
                                                else
                                                    echo 'Livraison Partiel';
                                                ?>
                                            </td>

                                            <td>Date Fin</td>
                                            <td><?php if ($form->getObject()->getDatefin()): ?>
                                                    <?php
                                                    echo date('d/m/Y', strtotime($form->getObject()->getDatefin()));
                                                endif;
                                                ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-3">
                                <?php
                                include_partial('contratachat/form_action_ios', array('type' => "ios",
                                    'iddocachat' => $documentachat->getId(), 'idcontrat' => $form->getObject()->getId(),
                                    'formcontrat' => $form, 'OSARRET' => $OSARRET, 'OSREPISE' => $OSREPISE,
                                    'OSCOMMTRAVAUX' => $OSCOMMTRAVAUX));
                                ?>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Liste des documents scannés</legend>
                            <?php
                            $formp = new PiecejointForm();
                            if (count($array) > 0)
                                $piecejoints = Doctrine_Core::getTable('piecejoint')
                                                ->createQuery('a')
                                                ->whereIn('id_orderservicecontrat', $array)->execute();
                            else
                                $piecejoints = [];
                            Doctrine_Core::getTable('piecejoint')->findByIdOrderservicecontrat($form->getObject()->getId());
//                            include_partial('contratachat/formparcourrier', array('form' => $formp, 'ordre' => $ordre, 'piecejoints' => $piecejoints));
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
                                                <a href="<?php // echo url_for('document/delete?id=' . $piecejoint->getId() . '&idtab=' . $_REQUEST['idtab'])       ?>">Supprimer</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                    <?php
                    foreach ($OSS as $od) {
                        $ordres = Doctrine_Core::getTable('ordredeservicecontratachat')->findOneById($od->getId());
                        $formios = new OrdredeservicecontratachatForm($ordres);
                        ?>
                        <div id="or<?php echo $ordres->getId() ?>" class="tab-pane fade">
                            <?php include_partial('ordredeservicecontratachat/form_ios_c', array('formlot' => $form, 'ordres' => $ordres, 'formios' => $formios)); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div><!--/.col -->
    </div>

    <div id = "sf_admin_footer">

    </div>
</div>