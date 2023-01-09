<div id="sf_admin_container">
    <h1 id="replacediv">Recherche par date, fournisseur ou document d'achat</h1>
</div>
<div id="sf_admin_bar" id="myCtrldoc" ng-controller="myCtrldoc" ng-init="AfficheBCE()">
    <div class="sf_admin_filter col-xs-8">
        <form action="" method="post">
            <table cellspacing="0" style="margin-bottom: 0px;">
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo url_for('Documents/indexfrs') ?>">Effacer</a>
                            <input type="submit" value="Filtrer" />
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <input type="hidden" name="idtype" value="<?php echo $idtype ?>">
                    <tr>
                        <td><label>Date</label></td>
                        <td>
                            <?php $start = date('Y-m-d', strtotime($_SESSION['exercice_budget'] . '/01/01'));
                            $end = date('Y-m-d', strtotime($_SESSION['exercice_budget'] . '/12/31')) ?>
                            De <input type="date" min="<?php echo $start ?>" max="<?php echo $end; ?>" value="<?php echo $datedebut ?>" name="debut"> à
                            <input type="date" min="<?php echo $start ?>" max="<?php echo $end; ?>" name="fin" value="<?php echo $datefin ?>">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Fournisseur</label></td>
                        <td><input type="hidden" value="<?php echo $idfrs ?>" id="idfrsselcet">
                            <?php echo $formfiletr['id_frs']->render(array('name' => 'idfrs')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Bon Commande Interne<br>(documents sources)</label></td>
                        <td>
                            <?php echo $formfiletr['id_docparent']->render(array('name' => 'id_bci')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Demandeur</label></td>
                        <td>
                            <?php echo $formfiletr['id_demandeur']->render(array('name' => 'id_dem')); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <div class="row">
        <div class="col-xs-10">
            <h3 class="header smaller lighter blue"></h3>

            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>

            <div class="row">
                <div class="col-xs-12">

                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date création</th>
                                <th class="center">Numéro&Type</th>
                                <th>Numéro BCIS</th>
                                <th>Rubrique budgétaire</th>
                                <th>Fournisseur</th>
                                <th>Mnt.HT</th>
                                <th>Mnt.TVA</th>
                                <th>Mnt.TTC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $boncomm = new Documentachat();

                            foreach ($boncommandeexterne as $bcex) {
                                $boncomm = $bcex;
                                //                                die(sizeof($boncomm->getDocumentparent()->getLigavisdoc()).'mp');
                                if ($boncomm->getDocumentparent()->getLigavisdoc()->getFirst())
                                    $ligprotitrub = $boncomm->getDocumentparent()->getLigavisdoc()->getFirst()->getLigprotitrub();
                            ?>
                                <?php
//                                if ($boncomm->getDroittimbre() == 1)
//                                    $mntttc = $boncomm->getMntttc() + 0.600;
//                                else
                                    $mntttc = $boncomm->getMntttc(); ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <input type="checkbox" id="check_<?php echo $boncomm->getId() ?>" ng-click="ValiderChoisir(<?php echo $boncomm->getId() ?>, '<?php echo $mntttc ?>', '<?php if ($ligprotitrub) echo $ligprotitrub->getId() ?>', '<?php if ($ligprotitrub) echo $ligprotitrub->getIdTitre() ?>')">
                                    </td>
                                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($boncomm->getDatecreation())) ?></td>
                                    <td style="text-align: center;">
                                        <a href="#my-modal<?php echo $boncomm->getId() ?>" role="button" data-toggle="modal">
                                            <?php echo $boncomm->getNumerodocachat() ?>
                                        </a>
                                        <div id="my-modal<?php echo $boncomm->getId() ?>" class="modal fade" tabindex="-1">
                                            <div class="modal-dialog" style="width: 84%;">
                                                <div class="modal-content">
                                                    <?php
                                                    $numero = strtoupper($boncomm->getTypedoc());
                                                    $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                                                    ?>
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h3 class="smaller lighter blue no-margin" style="text-align: left;">Détail <?php echo $numero . ' N° : ' . $boncomm ?></h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo html_entity_decode($boncomm->ReadHtmlBondeponseForm()); ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                                            <i class="ace-icon fa fa-times"></i>
                                                            Fermer
                                                        </button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                    <?php
                                    $numero = strtoupper($boncomm->getDocumentparent()->getTypedoc());
                                    $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                                    ?>
                                    <td style="text-align: center;">
                                        <a href="#bci_model<?php echo $boncomm->getId() ?>" role="button" data-toggle="modal">
                                            <?php echo $boncomm->getDocumentparent()->getNumerodocachat() ?>
                                        </a>
                                        <div id="bci_model<?php echo $boncomm->getId() ?>" class="modal fade" tabindex="-1">
                                            <div class="modal-dialog" style="width: 84%;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h3 class="smaller lighter blue no-margin" style="text-align: left;">Détail <?php echo $numero ?> N° : <?php echo $boncomm->getDocumentparent()->getNumerodocachat(); ?> </h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo html_entity_decode($boncomm->getDocumentparent()->getBonCommandeInterneForm()); ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                                            <i class="ace-icon fa fa-times"></i>
                                                            Fermer
                                                        </button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="#my-modal_<?php echo $ligprotitrub->getId(); ?>" role="button" data-toggle="modal">
                                            <?php echo $ligprotitrub->getCode() . ' ' . $ligprotitrub->getRubrique(); ?>
                                        </a>
                                        <div id="my-modal_<?php echo $ligprotitrub->getId(); ?>" class="modal fade" tabindex="-1">
                                            <div class="modal-dialog" style="width: 84%;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h3 class="smaller lighter blue no-margin" style="text-align: left;">Détail Rubrique Budgétaire => <?php echo $ligprotitrub->getCode(); ?> : <?php echo $ligprotitrub->getRubrique()->getLibelle(); ?> </h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            <table style="margin-bottom: 0px; margin-top: 6px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="5">Rubrique budgétaire</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width:20%; text-align: left; background-color: #F0F0F0;"><span>Exercice :</span></td>
                                                                        <td style="text-align: left;" colspan="4"><?php echo date('Y', strtotime($ligprotitrub->getTitrebudjet()->getDatecreation())); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: left; background-color: #F0F0F0;"><span>Budget :</span></td>
                                                                        <td style="text-align: left;" colspan="4"><?php echo $ligprotitrub->getTitrebudjet(); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: left; background-color: #F0F0F0;"><span>Rubrique budgétaire :</span></td>
                                                                        <td style="text-align: left;" colspan="4"><?php echo $ligprotitrub->getCode() . ' : ' . $ligprotitrub->getRubrique()->getLibelle(); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: left; background-color: #F0F0F0;"><span>Crédit Réservé :</span></td>
                                                                        <td style="text-align: left; width:15%; background-color: #F0F0F0;">Alloué :</td>
                                                                        <td style="text-align: right; width:25%;"><?php echo number_format($ligprotitrub->getMnt(), 3, '.', ' '); ?></td>
                                                                        <td style="text-align: left; width:15%; background-color: #F0F0F0;">Débloqué :</td>
                                                                        <td style="text-align: right; width:25%;"><?php echo number_format($ligprotitrub->getMntencaisse(), 3, '.', ' '); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: left; background-color: #F0F0F0;"><span>Crédit Engagé :</span></td>
                                                                        <td style="text-align: left; background-color: #F0F0F0;">Définitive :</td>
                                                                        <td style="text-align: right;"><?php echo number_format($ligprotitrub->getMntengage(), 3, '.', ' '); ?></td>
                                                                        <td style="text-align: left; background-color: #F0F0F0;">Provisoire :</td>
                                                                        <td style="text-align: right;"><?php echo number_format($ligprotitrub->getMntprovisoire(), 3, '.', ' '); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: left; background-color: #F0F0F0;"><span>Reliquat :</span></td>
                                                                        <td style="text-align: left; background-color: #F0F0F0;">Définitive :</td>
                                                                        <td style="text-align: right;"><?php echo number_format($ligprotitrub->getMnt() - $ligprotitrub->getMntengage(), 3, '.', ' '); ?></td>
                                                                        <td style="text-align: left; background-color: #F0F0F0;">Provisoire :</td>
                                                                        <td style="text-align: right;"><?php echo number_format($ligprotitrub->getMnt() - $ligprotitrub->getMntprovisoire(), 3, '.', ' '); ?></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                                            <i class="ace-icon fa fa-times"></i>
                                                            Fermer
                                                        </button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                    <td><?php echo $boncomm->getFournisseur()->getRs(); ?></td>
                                    <td style="width: 9%; text-align: right;"><?php if ($boncomm->getMht()) echo number_format($boncomm->getMht(), 3, '.', ' '); ?></td>
                                    <td style="width: 9%; text-align: right;"><?php echo number_format($boncomm->getMnttva(), 3, '.', ' '); ?></td>
                                    <?php
//                                    if ($boncomm->getDroittimbre() == 1)
//                                        $mntttc = $boncomm->getMntttc() + 0.600;
//                                    else
                                        $mntttc = $boncomm->getMntttc();
                                    ?>
                                    <td style="width: 9%; text-align: right;">
                                        <?php echo number_format($mntttc, 3, '.', ' '); ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-2">
            <h3 class="header smaller lighter blue"></h3>
            <div class="table-header">
                Total Doc. Sélectionnés
            </div>
            <div class="tab-content" style="padding: 10px;">
                <label style="text-align: center;">Total:</label>
                <input type="text" id="total" class="form-control disabledbutton align_right">
                <hr>
                <button class="btn btn-success btn-sm" ng-click="InialiserPreengagment()">
                    Affectation du rubrique budgétaire
                </button>

            </div>

            <div id="fiche" class="modal fade" tabindex="-1">
                <div class="modal-dialog" style="width: 50%">
                    <div class="modal-content">
                        <div class="row" id="modal_fiche"></div>

                        <div class="modal-footer">
                            <button ng-click="AjouterParDocPreengagement()" class="btn btn-sm btn-success pull-right" style="margin-left: 1%">
                                <i class="ace-icon fa fa-save"></i>
                                Valider Engagement
                            </button>
                            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Fermer
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </div>
    </div>
</div>