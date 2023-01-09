<div id="sf_admin_container">
    <h1>Courrier:<?php echo $courrier->getNumerocourrierstring(); ?> </h1>
    <div id="sf_admin_header">

    </div>
    <div id="sf_admin_content">
        <div>
            <fieldset>
                <legend>Données de base</legend>
                <div class="col-lg-7">
                    <table>
                        <tr>
                            <td><span> Date de Création</span></td>
                            <td><?php echo $courrier->getDatecreation(); ?></td>
                            <td><span>Numéro</span></span></td>
                            <td><?php echo $courrier->getNumerocourrierstring(); ?></td>
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
                            <td ><?php echo $courrier->getTypecourrier(); ?></td>
                            <td><span>Réference Courrier</span></td>
                            <td colspan="2"><?php echo $courrier->getReferencecourrier() ?></td>
                        </tr>
                        <tr>
                            <td><span>Mode ENV.||REC.</span></td>
                            <td><?php echo $courrier->getModescourrier() ?></td>
                            <td><span>Date Correspondance </span></td>
                            <td colspan="2"><?php echo $courrier->getDatecorespondanse() ?></td>
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
                            <tr>
                                <td colspan="2"><span>Notes Courrier</span></td>
                            </tr>
                            <?php
                            $listesnotes = Doctrine_Core::getTable('famillecourrier')->findAll();
                            foreach ($listesnotes as $note) {
                                ?>
                                <tr>
                                    <td><?php echo $note ?></td>
                                    <td><input <?php if (!$form->getObject()->isNew() && $form->getObject()->getIdFamille() == $note->getId()) echo 'checked="checked" '; ?>  type="checkbox" id="id_note<?php echo $note->getId(); ?>" ng-click="AffecterNoteCourrier(<?php echo $note->getId(); ?>,<?php if (!$form->getObject()->isNew()) echo $form->getObject()->getId(); ?>)" ></td>
                                </tr>
                            <?php } ?>
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
                        <td><span>Object</span></td>
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
                <legend>Données de Transfert </legend>
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
                        <a href="#dbscan" data-toggle="tab">Documents Scannées </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div <?php
                    if (isset($_REQUEST['idtab']) && $_REQUEST['idtab'] == "1")
                        echo 'class="tab-pane fade  active in"';
                    else
                        echo 'class="tab-pane fade"';
                    ?> id="dtransfert" style="padding: 2%">
                        <table>
                            <tr>
                                <td><span>Envoyer à</span></td>
                                <td style="width: 400px;">
                                    <div class="col-lg-10">
                                        <select id="exp" class="chosen-select">
                                            <option value="0">Sélectionez...</option>
                                            <?php
                                            $exp = new Expdest();
                                            foreach ($parameter_exp as $dest) {
                                                $exp = $dest;
                                                ?>
                                                <option value="<?php echo $exp->getIdDest(); ?>"><?php echo $exp->getDestinationexpdest(); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select> 
                                    </div>
                                    <div class="col-lg-2" >
                                        <a href="#my-modal" role="button" ng-click="AfficheExpediteur(<?php echo $idtype ?>);" class="bigger-125 bg-primary white" data-toggle="modal">
                                            &nbsp; + &nbsp;
                                        </a>
                                    </div>
                                    <div id="my-modal" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog" style="width: 80%">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="smaller lighter blue no-margin">Nouvel expéditeur</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    $formexp = new ExpdestForm();
                                                    include_partial('expdest/formlist', array('form' => $formexp, 'idtype' => $courrier->getIdType(), 'type' => 'envoi'))
                                                    ?>
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
                                <td>
                                    <span>Action</span>
                                </td>
                                <td style="width: 200px;">
                                    <select id="action">
                                        <option value="0">Sélectionez...</option>
                                        <?php foreach ($actions as $act) { ?>
                                            <option value="<?php echo $act->getId(); ?>"><?php echo $act; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><span>Date Max de réponse</span></td>
                                <td><input type="date" id="datemax" ></td>
                                <td><input ng-click="Transfere(<?php echo $courrier->getId() ?>)" type="button" class="btn btn-outline btn-success" value="Valider Envoi"></td>
                            </tr>
                        </table>
                        <table ng-init="Transfere(<?php echo $courrier->getId() ?>)">
                            <tr>
                                <td>Expédition</td>
                                <td>Déstination</td>
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
                    ?> id="dbscan" style="padding: 2%">
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