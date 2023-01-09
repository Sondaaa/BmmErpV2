<fieldset>
    <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
        <table class="disabledbutton">
            <tr>
                <td>
                    <label>Montant global du budget</label>
                    <input type="text" id="mnt" value="<?php echo $formdetail->getObject()->getMntglobal() ?>">
                </td>
                <td>
                    <label>Montant Externe en TND</label>
                    <input type="text" id="mnt_externe" value="<?php echo $formdetail->getObject()->getMntexterne() ?>">
                </td>
                <td>
                    <label>Reste du Montant</label>
                    <input type="text" id="restemnt" value="">
                </td>
            </tr>
        </table>
    <?php } ?>
    <div class="col-lg-7" ng-if="etatbudget === '2'" style="float: left; margin-top: 15px; margin-bottom: 15px;">
        <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
            <table>
                <thead>
                    <tr>
                        <td colspan="5"><label>Mnt Reste débloqué</label>
                            <?php
                            $parametrages = Doctrine_Core::getTable('parametragetranche')->findAll();
                            $chaine = "";
                            $mntglobal = $formdetail->getObject()->getMntglobal();
                            foreach ($parametrages as $parametre) {
                                $tranche = Doctrine_Core::getTable('tranchebudget')
                                        ->findOneByIdTitrebudgetAndIdParametragetranche($formdetail->getObject()->getId(), $parametre->getId());
                                if ($tranche)
                                    $mntglobal-=$tranche->getMntvaleur();
                            }
                            ?>
                            <input type="text" id="chaine_idp" value="<?php echo $mntglobal ?>">
                            <input type="hidden" id="alimentation_tranche" value="">
                        </td>
                    </tr>
                    <tr>
                        <th>Nom du Tranche</th>
                        <th>Date</th>
                        <th>Mnt.</th>
                        <th>Pourcentage%</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tranche_ajout_id = '';
                    foreach ($parametrages as $par) {
                        $class = "";
                        $tranche = Doctrine_Core::getTable('tranchebudget')
                                ->findOneByIdTitrebudgetAndIdParametragetranche($formdetail->getObject()->getId(), $par->getId());
                        if ($tranche)
                            $class = "disabledbutton";
                        if (!$tranche) {
                            if ($tranche_ajout_id == '')
                                $tranche_ajout_id = $par->getId();
                            ?>
                            <tr class="<?php echo $class ?>" ng-model="tr_<?php echo $par->getId() ?>">
                                <td><?php echo $par->getLibelle() ?></td>
                                <td>
                                    <input readonly="true" type="date" id="date_tran_<?php echo $par->getId() ?>" value="<?php if ($tranche) echo $tranche->getDatetranche() ?>" > </td>
                                <td>
                                    <input readonly="true" ng-model="mnt_tr_<?php echo $par->getId() ?>" type="text" id="mnt_tr_<?php echo $par->getId() ?>" ng-change="CalculPourcentage(<?php echo $par->getId() ?>)" value="<?php if ($tranche) echo $tranche->getMntvaleur() ?>" ng-value="<?php if ($tranche) echo $tranche->getMntvaleur() ?>"></td>
                                <td>
                                    <input readonly="true" type="text" ng-model="mnt_pour_ence_<?php echo $par->getId() ?>" ng-change="CalculMntParPourcentage(<?php echo $par->getId() ?>)" id="mnt_pour_ence_<?php echo $par->getId() ?>" value="<?php if ($tranche) echo $tranche->getMntpourcentage() ?>" ng-value="<?php if ($tranche) echo $tranche->getMntpourcentage() ?>">
                                </td>
                                <td>
                                    <!--<input type="button" value="Valider" ng-click="ValiderMntEncaisserPourcentage(<?php // echo $formdetail->getObject()->getId()                              ?>,<?php // echo $par->getId()                              ?>)">-->
                                    <input type="button" value="Répartition" href="#mys-modal_tranche" data-toggle="modal" onclick="setParam('<?php echo $par->getId() ?>')">
                                </td>
                            </tr>
                        <?php }else { ?>
                            <tr>
                                <td><?php echo $par->getLibelle() ?></td>
                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($tranche->getDatetranche())) ?></td>
                                <td style="text-align: right;"><?php echo number_format($tranche->getMntvaleur(), 3, '.', ' ') ?></td>
                                <td style="text-align: center;"><?php echo $tranche->getMntpourcentage() ?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <div id="mys-modal_tranche" class="modal fade" tabindex="-1">
                <div class="modal-dialog" style="width: 1000px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="smaller lighter blue no-margin">Encaissement des Rubriques Budgétaires</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    Montant Encaissement :
                                    <input readonly="true" type="text" id="montant_encaisse_rubrique">
                                </div>
                                <div class="col-lg-2">
                                    Taux Encaissement :
                                    <input readonly="true" type="text" id="taux_encaisse_rubrique">
                                </div>
                                <div class="col-lg-3">
                                    Montant Reste :
                                    <input readonly="true" type="text" id="montant_encaisse_rubrique_reste">
                                </div>
                                <div class="col-lg-3">
                                    Action :<br>
                                    <input type="button" value="R. Egale / Taux" class="btn btn-sm btn-success" onclick="repartitionEgalite()">
                                    <input type="button" value="Initialiser" class="btn btn-sm btn-primary" onclick="initialiserRepartition()">
                                </div>
                            </div>
                            <input type="hidden" id="idpara_tranche" value="">
                            <br>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Ordre</th>
                                        <th>Code</th>
                                        <th>Rubrique</th>
                                        <th>Montant</th>
                                        <th>Encaissement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="ligne in budgets| orderBy:sorterFunc">
                                        <td style="width: 5%; text-align: center;">{{ligne.nordre}}</td>
                                        <td style="width: 5%; text-align: center;">{{ligne.code}}</td>
                                        <td style="width: 64%;">
                                            <table>
                                                <tr>
                                                    <td colspan="5">{{ligne.designation}}</td>
                                                </tr>
                                                <tr ng-if="ligne.sousrubrique.length > 0" style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                                    <td>Ordre</td>
                                                    <td>Code</td>
                                                    <td>Sous Rubrique</td>
                                                    <td>Montant</td>
                                                    <td>Encaissement</td>
                                                </tr>
                                                <tr ng-if="ligne.sousrubrique.length > 0" ng-repeat="sous in ligne.sousrubrique| orderBy :'nordre'">
                                                    <td style="width: 10%; text-align: center;">{{sous.nordre}}</td>
                                                    <td style="width: 10%; text-align: center;">{{sous.nordre}}</td>
                                                    <td style="width: 40%; font-size: 12px;">{{sous.designation}}</td>
                                                    <td style="width: 20%;">
                                                        <input type="text" readonly="true" id="hidden_encaissement_mnt_{{sous.idligne}}" value="{{sous.mnt}}">
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <input type="text" value="" nature="montant" ligne_id="{{sous.idligne}}" rubrique="{{ligne.idligne}}" id="encaissement_mnt_{{sous.idligne}}" onkeyup="calculerRubriqueTotal()" onblur="setArrondissement()" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width: 13%;">
                                            <input type="text" readonly="true" id="hidden_encaissement_mnt_{{ligne.idligne}}" value="{{ligne.mnt}}">
                                        </td>
                                        <td style="width: 13%;">
                                            <input type="text" value="" ligne_rubrique="rubrique" ligne_id="{{ligne.idligne}}" id_rubrique="{{ligne.idligne}}" nature="montant" id="encaissement_mnt_{{ligne.idligne}}" onkeyup="calculerResteEncaissement()" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal" style="margin-left: 10px;">
                                <i class="ace-icon fa fa-times"></i>
                                Fermer
                            </button>
                            <button class="btn btn-sm btn-primary pull-right" data-dismiss="modal" ng-click="AlimenterRubriques('<?php echo $formdetail->getObject()->getId() ?>')">
                                <i class="ace-icon fa fa-save"></i>
                                Valider
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="col-lg-5" ng-if="etatbudget === '2'" style="float: right; margin-top: 15px; margin-bottom: 15px;">
        <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
            <?php if ($mntglobal > 0): ?>
                <table id="list_alimentation">
                    <thead>
                        <tr>
                            <th colspan="4" style="text-align: center;">Alimentation des Comptes Bancaires/CCP</th>
                        </tr>
                        <tr>
                            <th style="width: 22%;">Date</th>
                            <th style="width: 47%;">Compte Bancaires/CCP</th>
                            <th style="width: 25%;">Montant</th>
                            <th style="width: 6%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $alimentations = AlimentationcompteTable::getInstance()->getListeByTitreForValide($formdetail->getObject()->getId(), $mntglobal); ?>
                        <?php foreach ($alimentations as $alimentation): ?>
                            <tr id="tr_alimentation_<?php echo $alimentation->getId(); ?>">
                                <td style="text-align: center;">
                                    <?php echo date('d/m/Y', strtotime($alimentation->getDate())) ?>
                                    <input type="hidden" id="alimentation_date_<?php echo $alimentation->getId(); ?>" value="<?php echo $alimentation->getDate(); ?>" />
                                </td>
                                <td><?php echo $alimentation->getCaissesbanques() ?></td>
                                <td style="text-align: right;">
                                    <?php echo number_format($alimentation->getMontant(), 3, '.', ' ') ?>
                                    <input type="hidden" id="alimentation_montant_<?php echo $alimentation->getId(); ?>" value="<?php echo $alimentation->getMontant(); ?>" />
                                </td>
                                <td style="text-align: center;">
                                    <a class="btn btn-xs btn-primary" onclick="setTranche('<?php echo $alimentation->getId(); ?>', '<?php echo $tranche_ajout_id ?>')"><i class="ace-icon fa fa-plus-circle"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php } ?>
    </div>
    <table>
        <thead>
            <tr>
                <th style="width: 5%">N° Ordre</th>
                <th style="width: 8%">Code</th>
                <th style="width: 52%">RUBRIQUES</th>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                    <th>MONTANT EXTERNE EN TND</th>
                    <th>CREDITS ALLOUES EN TND</th>
                <?php } ?>
                <th style="width: 10%" ng-if="etatbudget === '1'">Action</th>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                    <th ng-if="etatbudget === '2'">Mnt. Bloqué</th>
                <?php } ?>
            </tr>
            <tr>
                <td><?php echo $form['nordre'] ?></td>
                <td><?php echo $form['code']->render(array('ng-model' => 'code_rubrique_titre_budget', 'ng-change' => 'getCodeRubrique("#ligprotitrub_code","#rubrique")')) ?></td>
                <td><textarea id="rubrique" style="height: 32px;" ng-model="libelle_rubrique_titre_budget" ng-change="getLibelleRubrique('#rubrique', '#ligprotitrub_code')"></textarea></td>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                    <td></td>
                    <td><?php echo $form['mnt'] ?></td>
                <?php } ?>
                <td style="text-align: center;" ng-if="etatbudget === '1'">
                    <input type="button" value="+" ng-click="AjouterSousdetailPrix()">
                </td>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="ligne in budgets| orderBy:sorterFunc">
            <!--<tr ng-repeat="ligne in budgets| orderBy :'idligne'">-->
                <td style="width: 5%;">{{ligne.nordre}}</td>
                <td style="width: 5%;">{{ligne.code}}</td>
                <td style="width: 60%;">
                    <table>
                        <tr>
                            <th <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>colspan="8"<?php else: ?>colspan="7"<?php endif; ?>>{{ligne.designation}}</th>
                        </tr>
                        <tr ng-if="ligne.sousrubrique.length > 0" style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                            <th style="width: 6%;">N°ordre</th>
                            <th style="width: 6%;">Code</th>
                            <th style="width: 44%;">Désignation</th>
                            <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                                <th style="width: 10%;">Mnt. Enc.</th>    
                                <th style="width: 10%;">Mnt. Ext.</th>
                                <th style="width: 10%;">Enc. + Ext.</th>
                                <th style="width: 10%;">Mnt. Initial</th>
                                <th style="width: 10%;" ng-if="etatbudget === '2'">Mnt. Bloqué</th>
                            <?php } ?>
                            <th style="width: 10%;" ng-if="etatbudget === '1'">Action</th>
                        </tr>
                        <!--<tr ng-if="ligne.sousrubrique.length > 0" ng-repeat="sous in ligne.sousrubrique| orderBy :'idligne'">-->
                        <tr ng-if="ligne.sousrubrique.length > 0" ng-repeat="sous in ligne.sousrubrique| orderBy :'nordre'">
                            <td>{{sous.nordre}}</td>
                            <td>{{sous.code}}</td>
                            <td>{{sous.designation}}</td>
                            <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                                <td style="text-align: right;">{{sous.mntencaisser}}</td>
                                <td style="text-align: right;">{{sous.mntexterne}}</td>
                                <td style="text-align: right;">{{sous.mntencaisserexterne}}</td>
                                <td style="text-align: right;">{{sous.mnt}}</td>
                                <td ng-if="etatbudget === '2'">
                                    <ul>
                                        <li style="float: left; margin: 1%;">
                                            <input type="text" id="mntencaiser_{{sous.idligne}}" value="{{sous.mntencaisser}}">
                                        </li>
                                        <!--<li style="float: left;margin: 1%;"> <input type="button" ng-click="ValiderMntEncaisser(sous.idligne, 'mntencaiser_')" value="+"></li>-->
                                    </ul>
                                </td>
                            <?php } ?>
                            <td ng-if="etatbudget === '1'" style="text-align: center;">
                                <!--Modal modifier sous rubrique-->
                                <div id="mys-modal_{{sous.nordre|tulde}}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="smaller lighter blue no-margin">Sous Rubrique</h3>
                                            </div>
                                            <div class="modal-body">
                                                <table>
                                                    <tr class="disabledbutton">
                                                        <td style="width: 25%; text-align: left;"><label>N°ordre Rubrique</label></td>
                                                        <td style="width: 75%"><input value="{{ligne.nordre}}" type="text" id="txts_nordre_rubrique_{{ligne.nordre|tulde}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;"><label>N°ordre</label></td>
                                                        <td><input readonly="true" type="text" value="{{sous.nordre}}" id="txts_nordre_{{sous.nordre|tulde}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;"><label>Code</label></td>
                                                        <td><input type="text" value="{{sous.code}}" id="txts_code_{{sous.nordre|tulde}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;"><label>Sous Rubrique</label></td>
                                                        <td><textarea id="txts_sousrubrique_{{sous.nordre|tulde}}" >{{sous.designation}}</textarea></td>
                                                    </tr>
                                                    <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                                                        <tr>
                                                            <td style="text-align: left;"><label>Montant</label></td>
                                                            <td style="text-align: right;">
                                                                <input type="hidden" id="hidden_mnts_sousrubrique_{{sous.nordre|tulde}}" value="{{sous.mnt}}">
                                                                <input type="text" id="mnts_sousrubrique_{{sous.nordre|tulde}}" value="{{sous.mnt}}">
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal" style="margin-left: 10px;">
                                                    <i class="ace-icon fa fa-times"></i>
                                                    Fermer
                                                </button>
                                                <button class="btn btn-sm btn-primary pull-right" data-dismiss="modal" ng-click="AjouterSousSousRubrique(sous.nordre, 1)">
                                                    <i class="ace-icon fa fa-plus"></i>
                                                    Ajouter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Fin Modal modifier sous rubrique-->
                                <span class="btn btn-primary btn-xs" href="#mys-modal_{{sous.nordre|tulde}}" data-toggle="modal">
                                    <i class="ace-icon fa fa-wrench bigger-110 icon-only"></i>
                                </span>
                                <span class="btn btn-danger btn-xs" ng-click="DeleteSousRubrique(sous.nordre, sous.idligne)">
                                    <i class="ace-icon fa fa-remove bigger-110 icon-only"></i>
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                    <td style="width: 8%; text-align: right;">
                        <p ng-if="ligne.mntexterne > 0"> {{ligne.mntexterne}} </p>
                    </td>    
                    <td style="width: 12%; text-align: right;">
                        <p ng-if="ligne.mnt > 0"> {{ligne.mnt}} </p>
                        <!--<p ng-if="ligne.mntrubrique > 0">{{ligne.mntrubrique}}</p>-->
                    </td>
                <?php } ?>
                <td style="text-align: center; width: 14%" ng-if="etatbudget === '1'">
                    <div>
                        <div id="my-modal_{{ligne.nordre|tulde}}" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="smaller lighter blue no-margin">Sous Rubrique</h3>
                                    </div>
                                    <div class="modal-body">
                                        <table>
                                            <tr class="disabledbutton">
                                                <td style="width: 25%; text-align: left;"><label>N°ordre Rubrique</label></td>
                                                <td style="width: 75%"><input value="{{ligne.nordre}}" type="text" id="txt_nordre_rubrique_{{ligne.nordre|tulde}}"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;"><label>N°ordre</label></td>
                                                <td><input type="text" id="txt_nordre_{{ligne.nordre|tulde}}"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;"><label>Code</label></td>
                                                <td><input type="text" id="txt_code_{{ligne.nordre|tulde}}"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;"><label>Sous Rubrique</label></td>
                                                <td><textarea id="txt_sousrubrique_{{ligne.nordre|tulde}}"></textarea></td>
                                            </tr>
                                            <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                                                <tr>
                                                    <td style="text-align: left;"><label>Montant</label></td>
                                                    <td><input type="text" id="mnt_sousrubrique_{{ligne.nordre|tulde}}"></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal" style="margin-left: 10px;">
                                            <i class="ace-icon fa fa-times"></i>
                                            Fermer
                                        </button>
                                        <button class="btn btn-sm btn-primary pull-right" data-dismiss="modal" ng-click="AjouterSousSousRubrique(ligne.nordre, 0)">
                                            <i class="ace-icon fa fa-plus"></i>
                                            Ajouter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="btn btn-warning btn-xs">
                            <i class="ace-icon fa bigger-110 icon-only" href="#my-modal_{{ligne.nordre|tulde}}" ng-click="InialiserNordreSousRubrique(ligne.nordre | tulde)" data-toggle="modal">
                                +S.R.
                            </i>
                        </span>
                        <span class="btn btn-primary btn-xs" ng-click="UpdateSousDetail(ligne.nordre)">
                            <i class="ace-icon fa fa-wrench bigger-110 icon-only"></i>
                        </span>
                        <span class="btn btn-inverse btn-xs" ng-click="AddSousDetailUp(ligne.ligne_ordre)">
                            <i class="ace-icon fa fa-arrow-up bigger-110 icon-only"></i>
                        </span>
                        <span class="btn btn-danger btn-xs" ng-click="DeletesousDetail(ligne.nordre, ligne.idligne)">
                            <i class="ace-icon fa fa-remove bigger-110 icon-only"></i>
                        </span>
                    </div>
                </td>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                    <td style="width: 8%;" class="disabledbutton" ng-if="etatbudget === '2'">
                        <!--                        <ul style="width: 65%">
                                                    <li style="float: left; margin: 1%; width: 64%">-->
                                                        <!--<input type="text" id="mntencai_ligne_{{ligne.idligne}}" value="{{ligne.mntencaisser}}">-->
                        <input type="text" id="mntencai_ligne_{{ligne.idligne}}" value="{{ligne.mntencaisserexterne}}">
                        <!--</li>-->
                        <!--                        <li style="float: left;margin: 1%;">
                                                    <input type="button" value="+" ng-click="ValiderMntEncaisser(ligne.idligne, 'mntencai_ligne_')">
                                                </li>-->
                        <!--</ul>-->
                    </td>
                <?php } ?>
            </tr>
        </tbody>
    </table>

    <div ng-if="etatbudget === '1'" class="row" style="padding-right: 2%; margin-top: 20px; text-align: right;">
        <input type="button" ng-if="budgets.length > 0" value="Valider Budget" ng-click="ValiderSousDetail(<?php echo $formdetail->getObject()->getId() ?>, 1)">
        <?php if ($typebudget != 'Prototype'): ?>
            <input ng-if="etatbudget === '1' && budgets.length > 0" type="button" value="Valider & Clôturer Fiche budget" ng-click="ValiderSousDetail(<?php echo $formdetail->getObject()->getId() ?>, 3)">
        <?php endif; ?>
    </div>
    <div ng-if="etatbudget === '2'" class="row" style="padding-right: 2%; margin-top: 20px; text-align: right;">
        <?php if ($typebudget != 'Prototype'): ?>
            <a href="<?php echo url_for('@titrebudjet') ?>" type="button" class="btn btn-sm btn-primary">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Retour à la liste</span>
            </a>
        <?php else: ?>
            <a href="<?php echo url_for('titrebudjet/index?type=prototype') ?>" type="button" class="btn btn-sm btn-primary">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Retour à la liste</span>
            </a>
        <?php endif; ?>
    </div>
</fieldset>

<script  type="text/javascript">

    function setTranche(alimentation_id, tranche_id) {
        $('#list_alimentation tbody tr').each(function () {
            $(this).css('background', '');
        });
        $('#tr_alimentation_' + alimentation_id).css('background-color', '#E2F9EF');
        $('#date_tran_' + tranche_id).val($('#alimentation_date_' + alimentation_id).val());
        $('#mnt_tr_' + tranche_id).val($('#alimentation_montant_' + alimentation_id).val());
        var pourcent_tranche = parseFloat($('#alimentation_montant_' + alimentation_id).val()) / parseFloat($('#chaine_idp').val()) * 100;
        $('#mnt_pour_ence_' + tranche_id).val(parseFloat(pourcent_tranche).toFixed(2));
        $('#alimentation_tranche').val(alimentation_id);
        //Répartition
        $("#montant_encaisse_rubrique").val($('#alimentation_montant_' + alimentation_id).val());
        $("#montant_encaisse_rubrique_reste").val($('#alimentation_montant_' + alimentation_id).val());
        $("#taux_encaisse_rubrique").val(parseFloat(pourcent_tranche).toFixed(2));
    }

    function setParam(id_param) {
        $("#idpara_tranche").val(id_param);
        initialiserRepartition();
    }

    function initialiserRepartition() {
        $('input[nature="montant"]').each(function () {
            $(this).val('');
        });
        $("#montant_encaisse_rubrique_reste").val($('#montant_encaisse_rubrique').val());
    }

    function repartitionEgalite() {
        var pourcent_tranche = $("#taux_encaisse_rubrique").val();
        $('input[nature="montant"]').each(function () {
            var montant = $("#hidden_" + $(this).attr('id')).val();
            montant = parseFloat(montant) * parseFloat(pourcent_tranche) / 100;
            $(this).val(parseFloat(montant).toFixed(3));
        });
        calculerResteEncaissement();
    }

    function calculerRubriqueTotal() {
        $('input[ligne_rubrique="rubrique"]').each(function () {
            var id_rubrique = $(this).attr('id_rubrique');
            var montant = 0;
            var trouve = 0;
            $('input[rubrique="' + id_rubrique + '"]').each(function () {
                trouve = 1;
                if ($(this).val() != '')
                    montant = parseFloat(montant) + parseFloat($(this).val());
            });
//            if (montant != 0)
            if (trouve == 1)
                $("#encaissement_mnt_" + id_rubrique).val(parseFloat(montant).toFixed(3));
//            else
//                $("#encaissement_mnt_" + id_rubrique).val('');
        });
        calculerResteEncaissement();
    }

    function setArrondissement() {
        $('input[nature="montant"]').each(function () {
            if ($(this).val() != '') {
                if (parseFloat($(this).val()) <= parseFloat($("#hidden_" + $(this).attr('id')).val())) {
                    $(this).val(parseFloat($(this).val()).toFixed(3));
                } else {
                    $(this).val('');
                    calculerRubriqueTotal();
                }
            }
        });
    }

    function calculerResteEncaissement() {
        var montant_rubrique = 0;
        $('input[ligne_rubrique="rubrique"]').each(function () {
            if ($(this).val() != '')
                montant_rubrique = parseFloat(montant_rubrique) + parseFloat($(this).val());
        });
        var montant = $("#montant_encaisse_rubrique").val();
        var reste = parseFloat(montant) - parseFloat(montant_rubrique);
        $("#montant_encaisse_rubrique_reste").val(parseFloat(reste).toFixed(3));
    }

</script>

<style>

    input[nature="montant"]{color: #007bb6;text-align: right;}
    input[nature="montant"]:focus{color: #007bb6;}
    table{margin-bottom: 0px!important;}

</style>