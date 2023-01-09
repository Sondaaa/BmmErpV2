<fieldset>
    <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
        <table class="disabledbutton">
            <tr>
                <td>
                    <label>Montant global du budget</label>
                    <input type="text" id="mnt" value="<?php echo $formdetail->getObject()->getMntglobal() ?>">
                </td>
                <td>
                    <label>Montant Transfert en TND</label>
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
        <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel Global" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel / Direction & Projet") { ?>
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
                            <input class="disabledbutton" type="text" id="chaine_idp" value="<?php echo $mntglobal ?>">
                            <input type="hidden" id="alimentation_tranche" value="">
                        </td>
                    </tr>
                    <tr>
                        <th>Nom du Tranche</th>
                        <th>Date</th>
                        <th>Mnt.</th>
                        <th>Pourcentage %</th>
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
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php }else { ?>
                            <tr>
                                <td><?php echo $par->getLibelle() ?></td>
                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($tranche->getDatetranche())) ?></td>
                                <td style="text-align: right;"><?php echo number_format($tranche->getMntvaleur(), 3, '.', ' ') ?></td>
                                <td style="text-align: center;"><?php echo $tranche->getMntpourcentage() ?></td>
                            </tr>
                        <?php } ?>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php } ?>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%; display: none;">N° Ordre</th>
                <th style="width: 8%">Code</th>
                <th style="width: 52%">RUBRIQUES</th>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                    <?php if (trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel Global" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel / Direction & Projet"): ?>
                        <th>MONTANT TRANSFERT</th>
                    <?php endif; ?>
                    <th>CREDITS ALLOUES</th>
                <?php } ?>
                <th style="width: 10%" ng-if="etatbudget === '1'">Action</th>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                    <th ng-if="etatbudget === '2'">Mnt. Bloqué</th>
                <?php } ?>
            </tr>
            <tr ng-if="etatbudget === '1'">
                <td style="display: none;"><?php echo $form['nordre'] ?></td>
                <td><?php echo $form['code']->render(array('ng-model' => 'code_rubrique_titre_budget', 'ng-change' => 'getCodeRubrique("#ligprotitrub_code","#rubrique")')) ?></td>
                <td><textarea id="rubrique" style="height: 32px;" ng-model="libelle_rubrique_titre_budget" ng-change="getLibelleRubrique('#rubrique', '#ligprotitrub_code')"></textarea></td>
                <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                    <?php if (trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel Global" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel / Direction & Projet"): ?>
                        <td></td>
                    <?php endif; ?>
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
                <td style="width: 5%; display: none;">{{ligne.nordre}}</td>
                <td style="width: 8%;"><table><tr><th style="height: 35px;">{{ligne.code}}</th></tr></table></td>
                <td style="width: 52%;">
                    <table>
                        <tr>
                            <th <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype"): ?>colspan="6"<?php else: ?>colspan="5"<?php endif; ?>>{{ligne.designation}}</th>
                        </tr>
                        <tr ng-if="ligne.sousrubrique.length > 0" style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                            <th style="width: 6%; display: none;">N°ordre</th>
                            <th style="width: 6%;">Code</th>
                            <th style="width: 38%;">Désignation</th>
                            <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                                <?php if (trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel Global" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel / Direction & Projet"): ?>
                                    <th style="width: 10%;">Mnt. Encais.</th>
                                    <th style="width: 10%;">Mnt. Transfert</th>
                                    <th style="width: 10%;">Montant<br>Enc.+Tra.</th>
                                <?php endif; ?>
                                <th style="width: 10%;">Mnt. Initial</th>
                                <th style="width: 10%;" ng-if="etatbudget === '2'">Mnt. Bloqué</th>
                            <?php } ?>
                            <th style="width: 10%;" ng-if="etatbudget === '1'">Action</th>
                        </tr>
                        <!--<tr ng-if="ligne.sousrubrique.length > 0" ng-repeat="sous in ligne.sousrubrique| orderBy :'idligne'">-->
                        <tr ng-if="ligne.sousrubrique.length > 0" ng-repeat="sous in ligne.sousrubrique| orderBy :'nordre'">
                            <td style="display: none;">{{sous.nordre}}</td>
                            <td>{{sous.code}}</td>
                            <td>{{sous.designation}}</td>
                            <?php if (!$formdetail->getObject()->isNew() && trim($formdetail->getObject()->getTypebudget()) != "Prototype") { ?>
                                <?php if (trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel Global" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel / Direction & Projet"): ?>
                                    <td style="text-align: right;">{{sous.mntencaisser}}</td>
                                    <td style="text-align: right;">{{sous.mntexterne}}</td>
                                    <td style="text-align: right;">{{sous.mntencaisserexterne}}</td>
                                <?php endif; ?>
                                <td style="text-align: right;">{{sous.mnt}}</td>
                                <td ng-if="etatbudget === '2'">
                                    <input type="text" id="mntencaiser_{{sous.idligne}}" value="{{sous.mntencaisser}}">
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
                                                        <td style="width: 75%"><input  value="{{ligne.nordre}}" type="text" id="txts_nordre_rubrique_{{ligne.nordre|tulde}}"></td>
                                                    </tr>
                                                    <tr class="disabledbutton">
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
                    <?php if (trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel Global" && trim($formdetail->getObject()->getTypebudget()) != "Budget Prévisionnel / Direction & Projet"): ?>
                        <td style="width: 8%; text-align: right;">
                            <p ng-if="ligne.mntexterne > 0"> {{ligne.mntexterne}} </p>
                        </td>
                    <?php endif; ?>
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
                                            <tr class="disabledbutton">
                                                <td style="text-align: left;"><label>N°ordre</label></td>
                                                <td><input readonly="true" type="text" id="txt_nordre_{{ligne.nordre|tulde}}"></td>
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
                        <input type="text" id="mntencai_ligne_{{ligne.idligne}}" value="{{ligne.mntencaisserexterne}}">
                    </td>
                <?php } ?>
            </tr>
        </tbody>
    </table>

    <div ng-if="etatbudget === '1' && budgets.length > 0" class="row" style="padding-right: 2%; margin-top: 20px; text-align: right;">
        <input type="button" value="Enregistrer Budget" ng-click="ValiderSousDetail(<?php echo $formdetail->getObject()->getId() ?>, 1)">
        <?php if (!(strpos(trim($typebudget), "Direction") === false) || !(strpos(trim($typebudget), "Global") === false)): ?>
            <input type="button" value="Valider budget" ng-click="ValiderSousDetail(<?php echo $formdetail->getObject()->getId() ?>, 2)">
        <?php endif; ?>
    </div>
    <div ng-if="etatbudget === '3'" class="row" style="padding-right: 2%; margin-top: 20px; text-align: right;">
        <input type="button" ng-if="budgets.length > 0" value="Valider Budget" ng-click="ValiderSousDetail(<?php echo $formdetail->getObject()->getId() ?>, 2)">
    </div>
    <div ng-if="etatbudget === '2'" class="row" style="padding-right: 2%; margin-top: 20px; text-align: right;">
        <?php if (strpos(trim($typebudget), "Direction") === false && strpos(trim($typebudget), "Global") === false): ?>
            <a href="<?php echo url_for('titrebudjet/index?type=Final') ?>" type="button" class="btn btn-white btn-primary">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Retour à la liste</span>
            </a>
        <?php elseif (strpos(trim($typebudget), "Direction") !== false): ?>
            <a href="<?php echo url_for('titrebudjet/index?type=Budget Prévisionnel') ?>" class="btn btn-white btn-primary">
                <i class="ace-icon fa fa-undo bigger-110"></i> 
                Retour à la Liste
            </a>
        <?php else: ?>
            <a href="<?php echo url_for('titrebudjet/index?type=Budget Prévisionnel Global') ?>" class="btn btn-white btn-primary">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Retour à la Liste
            </a>
        <?php endif; ?>
    </div>
</fieldset>

<style>

    table{margin-bottom: 0px!important;}

</style>