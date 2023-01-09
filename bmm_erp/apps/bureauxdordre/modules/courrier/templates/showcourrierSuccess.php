<div id="sf_admin_container">
    <h1>Courrier: <?php echo $courrier->getTypecourrier()->getPrefix(); ?> <?php echo $courrier->getNumero(); ?> </h1>
    <div id="sf_admin_header">

    </div>
    <div id="sf_admin_content">
        <div>
            <fieldset>
                <legend>Données de base</legend>
                <div class="col-lg-7">
                    <table>
                        <tr>
                            <td><span>Date de Création</span></td>
                            <td><?php echo date('d/m/Y', strtotime($courrier->getDatecreation())); ?></td>
                            <td><span>Numéro</span></td>
                            <td><?php echo $courrier->getTypecourrier()->getPrefix(); ?> <?php echo $courrier->getNumero(); ?></td>
                        </tr>
                        <tr>
                            <td><span>Numéro Correspondance</span></td>
                            <td><?php echo $courrier->getNumeroseq(); ?></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td><span>Expéditeur</span></td>
                            <td><?php if ($mvc) echo $mvc->getExpdest(); ?></td>
                            <td style="color:#c36017;font-size: 18px"><?php if ($mvc && $mvc->getIdAction()) echo $mvc->getActionparcour(); ?> ===>> </td>
                            <td><span>Utilisateur && Bureau</span></td>
                            <td>
                                <?php echo $courrier->getUtilisateur() ?>
                                <?php echo $courrier->getBureaux(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><span>Type</span></td>
                            <td><?php echo $courrier->getTypecourrier(); ?></td>
                            <td><span>Réference Courrier</span></td>
                            <td colspan="2"><?php echo $courrier->getReferencecourrier() ?></td>
                        </tr>
                        <tr>
                            <td><span>Mode ENV.||REC.</span></td>
                            <td><?php echo $courrier->getModescourrier() ?></td>
                            <td><span>Date Correspondance </span></td>
                            <td colspan="2"><?php if ($courrier->getDatecorespondanse()) echo date('d/m/Y', strtotime($courrier->getDatecorespondanse())); ?></td>
                        </tr>
                        <tr>
                            <td><span>Type d'envoi</span></td>
                            <td colspan="4"><?php echo $courrier->getTypeparamcourrier() ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-5">
                    <div class='disabledbutton'>
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2">Notes Courrier</th>
                                </tr>
                            </thead>
                            <?php
                            $listesnotes = Doctrine_Core::getTable('famillecourrier')->findAll();
                            foreach ($listesnotes as $note):
                                ?>
                                <tr>
                                    <td><?php echo $note ?></td>
                                    <td style="text-align: center;">
                                        <input <?php if (!$form->getObject()->isNew() && $form->getObject()->getIdFamille() == $note->getId()) echo 'checked="checked" '; ?>type="checkbox" id="id_note<?php echo $note->getId(); ?>" ng-click="AffecterNoteCourrier(<?php echo $note->getId(); ?>,<?php if (!$form->getObject()->isNew()) echo $form->getObject()->getId(); ?>)">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Données de Contenue</legend>
                <table>
                    <tr>
                        <td><span>Titre</span></td>
                        <td><?php echo $courrier->getTitre() ?></td>
                        <td><span>Objet</span></td>
                        <td><?php echo $courrier->getObject() ?></td>
                    </tr>
                    <tr>
                        <td><span>Sujet</span></td>
                        <td colspan="2" ><?php echo $courrier->getSujet() ?></td>
                    </tr>
                    <tr>
                        <td><span>Description du courrier</span></td>
                        <td colspan="3"><?php echo html_entity_decode($courrier->getDescription()) ?></td>
                    </tr>
                </table>
            </fieldset>
            <fieldset ng-controller="CtrlTransfer">
                <legend>Données de Transfert</legend>
                <ul class="nav nav-tabs">
                    <li <?php
                    if (isset($_REQUEST['idtab']) && $_REQUEST['idtab'] == "1")
                        echo 'class="active"';
                    else
                        echo '';
                    ?> ng-click="InialiserComboTransfert()">
                        <a href="#dtransfert" data-toggle="tab" >Données de Transfert</a>
                    </li>
                    <li <?php
                    if (isset($_REQUEST['idtab']) && $_REQUEST['idtab'] == "3")
                        echo 'class="active"';
                    else
                        echo '';
                    ?>>
                        <a href="#dbscan" data-toggle="tab">Documents Scannés </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div <?php
                    if (isset($_REQUEST['idtab']) && $_REQUEST['idtab'] == "1")
                        echo 'class="tab-pane fade active in"';
                    else
                        echo 'class="tab-pane fade"';
                    ?> id="dtransfert" style="padding: 2%">
                        <table>
                            <tr>
                                <td><span>Envoyer à</span></td>
                                <td style="width: 400px;">
                                    <div id="zone_envoyer_a">
                                        <div class="col-lg-10">
                                            <select id="exp" multiple="multiple">
                                                <option value="0"></option>
                                                <?php
                                                $exp = new Expdest();
                                               
                                                foreach ($parameter_exp as $dest):
                                                    $exp = $dest;
                                                    ?>
                                                    <?php if (!in_array($exp->getDestinationexpdest()->getIdFamille(), array($ids))): ?>
                                                        <option value="<?php echo $exp->getIdDest(); ?>" mode="0"><?php echo $exp->getDestinationexpdest(); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <?php foreach ($famille_expediteur as $famille): ?>
                                                    <option value="<?php echo $famille->getId(); ?>" mode="1"><?php echo $famille->getFamille(); ?></option>
                                                <?php endforeach; ?>
                                            </select> 
                                        </div>
                                        <div class="col-lg-2">
                                            <!--<a href="#my-modal" role="button" ng-click="AfficheExpediteur(<?php //echo $idtype                         ?>);" class="bigger-125 bg-primary white" data-toggle="modal">-->
                                            <a href="#my-modal" role="button" ng-click="AfficheExpediteur();" class="bigger-125 bg-primary white" data-toggle="modal">
                                                &nbsp; + &nbsp;
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <input id="qte_personnes" ng-click="setAffichageEnvoyerA()" type="checkbox" /> 
                                        <a id="button_all" href="#my-modal-tous" data-toggle="modal">
                                            <i class="ace-icon fa fa-hand-o-right"></i>
                                            Tous
                                        </a>
                                        <div id="my-modal-tous" class="modal fade" tabindex="-1">
                                            <div class="modal-dialog" style="width: 50%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="smaller lighter blue no-margin">Envoyer à</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div style="height: 250px; overflow: auto;">
                                                            <table class="fancyTable" id="myTable01">
                                                                <thead>
                                                                    <tr><td>Destination</td></tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $exp = new Expdest();
                                                                    foreach ($parameter_exp as $dest):
                                                                        $exp = $dest;
                                                                        ?>
                                                                        <?php if (!in_array($exp->getDestinationexpdest()->getIdFamille(), array($ids))): ?>
                                                                            <tr><td><?php echo $exp->getDestinationexpdest(); ?></td></tr>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                    <?php foreach ($famille_expediteur as $famille): ?>
                                                                        <tr><td><?php echo $famille->getFamille(); ?></td></tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                                            <i class="ace-icon fa fa-times"></i>
                                                            fermer
                                                        </button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    </div>
                                    <div id="my-modal" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog" style="width: 80%">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="smaller lighter blue no-margin">Nouvel Destinataire</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    $formexp = new ExpdestForm();
                                                    include_partial('expdest/formexpedi', array('form' => $formexp, 'idtype' => $courrier->getIdType(), 'type' => 'envoi'))
                                                    ?>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                                            <i class="ace-icon fa fa-times"></i>
                                                            fermer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                </td>
                                <td><span>Action</span></td>
                                <td style="width: 200px;">
                                    <select id="action">
                                        <option value="0"></option>
                                        <?php foreach ($actions as $act): ?>
                                            <option value="<?php echo $act->getId(); ?>"><?php echo $act; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td><span>Date Max de Réponse</span></td>
                                <td><input type="date" id="datemax" min="<?php echo date('Y-m-d'); ?>"></td>
                                <td style="text-align: center;"><input ng-click="Transfere(<?php echo $courrier->getId() ?>)" type="button" class="btn btn-xs btn-outline btn-success" value="Valider Envoi" style="width: 110px; font-weight: bold;"></td>
                            </tr>
                        </table>
                        <table ng-init="ChargerTransfere(<?php echo $courrier->getId() ?>)">
                            <tr>
                                <td>Expédition</td>
                                <td>Destination</td>
                                <td>Date Max de Réponse</td>
                                <td>Action d'envoi</td>
                            </tr>
                            <tr ng-repeat="transfer in listestransfer">
                                <td>{{transfer.ex}}</td>
                                <td>{{transfer.de}}</td>
                                <td>{{transfer.maxreponse}}</td>
                                <td>{{transfer.action}}</td>
                            </tr>
                        </table>
                    </div>
                    <div <?php
                    if (isset($_REQUEST['idtab']) && $_REQUEST['idtab'] == "3")
                        echo 'class="tab-pane fade  active in"';
                    else
                        echo 'class="tab-pane fade"';
                    ?> id="dbscan" style="padding: 2%;">
                        <?php
                        $id = $form->getObject()->getId();
                        $courrier = $form->getObject();
                        include_partial('Scan/formscan', array('id' => $id, 'courrier' => $courrier));
                        ?>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <style>

        td>span{
            color: #740808;
            font-size: small;
            font-style: italic;
        }

    </style>
    <ul class="sf_admin_actions">
        <li class="sf_admin_action_list" style="display: inline;">
            <a href="<?php echo url_for('courrier/index') . '?idtype=' . $form->getObject()->getIdType() ?>" class="btn btn-outline btn-success">
                Retour à la liste
            </a>
        </li>
    </ul>
</div>