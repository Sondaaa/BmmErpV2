<div id="sf_admin_container"   >    
    <h1>Fiche N°:<?php echo $documentachat->getNumerodocachat() ?></h1> 
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $aviss = Doctrine_Core::getTable('avis')
                    ->createQuery('a')->where('id_poste=5')
                    ->orderBy('id asc')->execute();
    $visas = Doctrine_Core::getTable('visaachat')->findAll();
    $piecjoint = PiecejointbudgetTable::getInstance()->findByIdDocachat($documentachat->getId());

    if ($documentachat->getIdDocparent() != null)
        $docparent = DocumentachatTable::getInstance()->find($documentachat->getIdDocparent());
    if ($documentachat->getIdDocparent() != null && $docparent->getIdDocparent() != null)
        $docparent_docparent = DocumentachatTable::getInstance()->find($docparent->getIdDocparent());
//    die($docparent_docparent->getLigavisdoc()->count() . 'fe' . $docparent_docparent->getId());
    ?>
    <div id="sf_admin_content" ng-controller="CtrlFormEngagement">
        <div style=" position: absolute; float: right; margin-left: 80%; margin-top: 1%;">
            <?php if ($documentachat->getIdTypedoc() != 9): ?>
                <?php if ($docparent->getLigavisdoc()->count() == 1 && $documentachat->getLigavisdoc()->count() == 0 ): ?>
                    <table >
                        <thead>
                            <tr>
                                <th colspan="2">Avis de l'unité budget</th>
                            </tr>
                        </thead>
                        <tbody class="disabledbutton">
                            <?php
                            foreach ($aviss as $avis) {
                                $lgavis = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDocAndIdAvis($documentachat->getId(), $avis->getId());
                                if ($lgavis)
                                    $count_checked++;
                                ?>
                                <tr >
                                    <td >
                                        <?php
                                        if (strpos($avis->getLibelle(), ":") == 0)
                                            echo $avis->getLibelle();
                                        else
                                            echo "<p style='color: red; margin-bottom:0px;'>" . $avis->getLibelle() . "</p>";
                                        ?>
                                    </td>
                                    <td >
                                        <?php if (strpos($avis->getLibelle(), ":") == 0) { ?>
                                            <input <?php if ($lgavis) echo 'checked="true"' ?> type="checkbox" >
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th colspan="2" style="font-size: 16px; text-align: center;">Avis de l'unité budget</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($aviss as $avis) {
                        $lgavis = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDocAndIdAvis($documentachat->getId(), $avis->getId());
                        $count_checked = 0;
                        ?>
                        <tr>
                            <?php if (strpos($avis->getLibelle(), ":") == 0): ?>
                                <td><?php echo $avis->getLibelle(); ?></td>

                                <td>

                                    <input name="avis_checkbox" ng-click="ValiderChoix('<?php echo $avis->getId() ?>', '<?php echo $documentachat->getId() ?>')" type="checkbox" <?php
                                    if ($lgavis) {
                                        $count_checked++;
                                        echo 'checked="true"';
                                    }
                                    ?> id="check1_<?php echo $avis->getId() ?>"></td></td>
                                       <?php else: ?>
                                <td><p style="color: red; margin-bottom:0px;"><?php echo $avis->getLibelle() ?></p></td>
                                <td></td>
                            <?php endif; ?>

                        </tr>
                    <?php } ?>
                </table>
            <?php endif; ?>
        </div>
        <?php
        $numero = strtoupper($documentachat->getTypedoc());
        $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
        ?>
        <div style="padding: 1%;width: 80%;font-size: 16px">
            <table style="list-style: none; margin-bottom: 10px;">
                <tr style="background-color: #F5F5F5">
                    <td style="width: 200px; vertical-align: middle; text-align: center;">
                        <p style="border-top: 1px solid silver; border-bottom: 1px solid silver; padding-top: 10px; padding-bottom: 10px;">
                            <strong><?php echo strtoupper($societe); ?></strong>
                        </p>  
                    </td>
                    <td>
                        <table style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="2"><?php echo $numero; ?></td>
                            </tr>
                            <tr>
                                <td>N° : <?php echo $documentachat->getNumerodocachat() ?></td>
                                <td>Date création : <?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>
                            </tr>
                            <?php if ($documentachat->getIdTypedoc() != 9): ?>
                                <tr>
                                    <td>Nature</td>
                                    <td><?php echo $documentachat->getObjectdocument(); ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td>Montant Estimatif</td>
                                <td><?php if ($documentachat->getMontantestimatif()): ?><?php echo number_format($documentachat->getMontantestimatif(), 3, '.', ' '); ?> TND<?php endif; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table> 
        </div>
        <fieldset style="width: 80%">
            <legend>Données de base</legend>
            <table>
                <tbody>
                    <tr>
                        <td style="width: 25%">Nom et Prénom du demandeur</td>
                        <td style="width: 50%"><?php echo $documentachat->getAgents(); ?></td>
                        <td style="width: 10%">Référence</td>
                        <td style="width: 15%"><?php echo $documentachat->getReference(); ?></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
            <?php  if($docparent_docparent): if ($documentachat->getIdEtatdoc() != 9 && $docparent_docparent->getLigavisdoc()->count() == 1 ): ?>
            <fieldset id="zone_avis_budgetaire" style="display: none;">
                <legend>Avis Bugétaire (Crédit Disponible)</legend>
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 20%;">Budget</td>
                            <td style="width: 80%;"><input type="text" id="details_budget" readonly="true" /></td>
                        </tr>
                        <tr>
                            <td>Rubrique</td>
                            <td><input type="text" id="details_rubrique" readonly="true" /></td>
                        </tr>
                        <tr>
                            <td>Reliquat</td>
                            <td><input type="text" id="details_reliquat" readonly="true" /></td>
                        </tr>

                    </tbody>
                </table>
            </fieldset>
            <?php endif;?>
            <fieldset id="zone_avis_budgetaire">
                <legend>Avis Budgétaire 
                    <?php 
                    if ($documentachat->getIdEtatdoc() == 52 || $documentachat->getIdEtatdoc() == 53 || $documentachat->getIdEtatdoc() == 51 || $documentachat->getIdEtatdoc() == 52 || $documentachat->getIdEtatdoc() == 66 || $documentachat->getIdEtatdoc() == 71 || $documentachat->getIdEtatdoc() == 75):
                        ?>
                        <a  class="btn btn-sm btn-success pull-right" 
                            href="#my-modal_rubrique_edit" ng-click="setAffichageRubrique()"
                            role="button" data-toggle="modal">
                            Modifier l'imputation Budgétaire</a>
                    <?php endif; ?>
                </legend>
                <?php if (sizeof($piecjoint) >= 1) { ?>    
                    <fieldset>  <table style="list-style: none; margin-bottom: 10px;" class="table table-bordered table-hover">
                            <tbody>  <tr style="background-color: #F5F5F5"><td>
                                        <?php
                                        $doc_budget = $piecjoint->getFirst()->getIdDocumentbudget();
                                        $documentbudegt = DocumentbudgetTable::getInstance()->find($doc_budget);
                                        if (sizeof($documentbudegt) >= 1):
                                            ?>
                                            <?php echo $documentbudegt->getLigprotitrub()->getRubrique(); ?>
                                        <?php endif; ?>
                                    </td>  
                                </tr>
                            </tbody>

                        </table>     
                    </fieldset>
                <?php } ?>
                <?php $liste_avis = Doctrine_Core::getTable('ligavisdoc')->findByIdDoc($documentachat->getId()); ?>
                <table style="width: 80%; float: left;" >
                    <tbody>
                        <?php foreach ($liste_avis as $lgavis): ?>
                            <tr>
                                <td style="width: 13%; background: repeat-x #F2F2F2;">Avis Bugétaire</td>
                                <td style="width: 60%;"><?php echo $lgavis->getAvis(); ?></td>
                                <td style="width: 12%; background: repeat-x #F2F2F2;">Date Création</td>
                                <td style="width: 15%;"><?php echo date('d/m/Y', strtotime($lgavis->getDatecreation())); ?></td>
                            </tr>
                            <?php if ($lgavis->getIdLigprotitrub() != null): ?>
                                <tr>
                                    <td style="background: repeat-x #F2F2F2;">Budget</td>
                                    <td colspan="3"><?php echo $lgavis->getLigprotitrub()->getRubrique(); ?></td>
                                </tr>
                                <tr>
                                    <td style="background: repeat-x #F2F2F2;">Rubrique</td>
                                    <td colspan="3"><?php echo $lgavis->getLigprotitrub(); ?></td>
                                </tr>
                                <tr>
                                    <td style="background: repeat-x #F2F2F2;">Reliquat</td>
                                    <td colspan="3"><?php if ($lgavis->getMntdisponible()) echo number_format($lgavis->getMntdisponible(), 3, '.', ' ') . ' TND'; ?></td>


                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php
                $visaas = Doctrine_Core::getTable('ligavissig')->findByIdDoc($documentachat->getId());
                foreach ($visaas as $visa) {
                    $visaachat = new Visaachat();
                    $vi = Doctrine_Core::getTable('visaachat')->findOneById($visa->getIdVisa());
                    if ($vi) {
                        $visaachat = $vi;
                        ?>
                        <div style="width: 20%; float: right; border-color: #00438a; margin-top: -15px;">
                            <div style="text-align: center;"><img src="<?php echo sfconfig::get('sf_appdir') . 'uploads/images/' . $visaachat->getChemin() ?>" style="width: 150px;" ></div>
                            <div style="text-align: center;"><?php echo $visaachat ?></div>
                            <div style="text-align: center; font-size: 18px;<?php if ($visa->getEtatvalide() == 'true'): ?> color: green;<?php else: ?> color: red;<?php endif; ?>"><?php echo $visa->getDatevisa() ?></div>
                        </div>
                        <?php
                    }
                }
                ?>
            </fieldset>
            <div id="my-modal_rubrique_edit" class="modal fade" tabindex="-1">
                <div class="modal-dialog" style="width: 75%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Modifier rubrique budgétaire </h3>
                            <input type="hidden" id="budget_avis_id" />
                        </div>
                        <div class="modal-body">
                            <table style="margin-bottom: 0px;">
                                <tbody>
                                    <?php $liste_avis = Doctrine_Core::getTable('ligavisdoc')->findByIdDoc($documentachat->getId()); ?>
                                    <?php foreach ($liste_avis as $lgavis): ?>
                                        <?php if ($lgavis->getIdLigprotitrub() != null): ?>
                                            <tr>
                                                <td style="background: repeat-x #F2F2F2;color: red">Rubrique Alloué</td>
                                                <td colspan="5" style="background: repeat-x #F2F2F2; color: red"><?php echo $lgavis->getLigprotitrub(); ?></td>
                                            </tr>
                                            <?php
                                        endif;
                                    endforeach;
                                    ?>
                                    <tr>
                                        <td style="width: 20%;">Exercice :</td>
                                        <td style="width: 80%;" colspan="5">
                                            <?php // echo date('Y');       ?>
                                            <?php echo $_SESSION['exercice_budget']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Budget :</td>
                                        <td colspan="5">
                                            <?php
//                                                $annees = date('Y');
                                            $annees = $_SESSION['exercice_budget'];
                                            $budgets = Doctrine_Query::create()
                                                            ->select("*")
                                                            ->from('titrebudjet')
                                                            ->where("Etatbudget=2")
                                                            ->andwhere("trim(typebudget) not like trim('Prototype')  ")
                                                            ->andwhere("trim(typebudget) like trim('Exercice:" . $annees . "')  ")
                                                            ->orderBy('id asc')->execute();
                                            ?>
                                            <select id="budget_param_compte">
                                                <option value="0">Sélectionnez</option>
                                                <?php foreach ($budgets as $budget) { ?>
                                                    <option value="<?php echo $budget->getId() ?>">
                                                        <?php echo $budget->getLibelle() ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rubrique / Sous Rubrique :</td>
                                        <td colspan="5">
                                            <select id="numeroengaement">

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rubrique :</td>
                                        <td colspan="5">
                                            <input type="text" class="form-control" readonly="true" id="rubrique" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Crédits alloués :</td>
                                        <td>
                                            <input type="text" class="align_right" readonly="true" value="" id="mnt">
                                        </td>
                                        <td>Crédits consommés:</td>
                                        <td>
                                            <input type="text" class="align_right" readonly="true" value="" id="credit">
                                        </td>
                                        <td>Reliquat:</td>
                                        <td>
                                            <input type="text" class="align_right" readonly="true" value="" id="reliq">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button ng-click="AnnulerChoixDisponible('<?php echo $documentachat->getId() ?>')" style="float: left;" class="btn btn-sm btn-danger" data-dismiss="modal">
                                <i class="ace-icon fa fa-undo"></i>
                                Annuler
                            </button>
                            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Fermer
                            </button>
                            <?php if ($documentachat->getIdEtatdoc() != 71): ?>
                                <button ng-click="ValiderChoixDisponibleProvioire('<?php echo $documentachat->getId() ?>')" class="btn btn-sm btn-success pull-right" data-dismiss="modal">
                                    <i class="ace-icon fa fa-check"></i>
                                    Valider
                                </button>
                            <?php endif; ?>
                            <?php if ($documentachat->getIdEtatdoc() == 71 || $documentachat->getIdEtatdoc() == 75): ?>
                                <button ng-click="ValiderChoixDisponibleDef('<?php echo $documentachat->getId() ?>')" class="btn btn-sm btn-success pull-right" data-dismiss="modal">
                                    <i class="ace-icon fa fa-check"></i>
                                    Valider
                                </button>
                            <?php endif; ?>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <?php $ligavissig = LigavissigTable::getInstance()->findByIdDoc($docparent->getId()); ?>
        <?php  endif; ?>        
    
        <?php if ($documentachat->getIdEtatdoc() != 9 && $documentachat->getLigavisdoc()->count() == 0 && $docparent->getLigavisdoc()->count() == 1 ): ?>
            <fieldset id="zone_avis_budgetaire" style="display: none;">
                <legend>Avis Bugétaire (Crédit Disponible)</legend>
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 20%;">Budget</td>
                            <td style="width: 80%;"><input type="text" id="details_budget" readonly="true" /></td>
                        </tr>
                        <tr>
                            <td>Rubrique</td>
                            <td><input type="text" id="details_rubrique" readonly="true" /></td>
                        </tr>
                        <tr>
                            <td>Reliquat</td>
                            <td><input type="text" id="details_reliquat" readonly="true" /></td>
                        </tr>

                    </tbody>
                </table>
            </fieldset>
            <?phpendif;?>
            <fieldset id="zone_avis_budgetaire">
                <legend>Avis Budgétaire 
                    <?php 
                    if ($documentachat->getIdEtatdoc() == 52 ||$documentachat->getIdEtatdoc() == 53 || $documentachat->getIdEtatdoc() == 51 || $documentachat->getIdEtatdoc() == 52 || $documentachat->getIdEtatdoc() == 66 || $documentachat->getIdEtatdoc() == 71 || $documentachat->getIdEtatdoc() == 75):
                        ?>
                        <a  class="btn btn-sm btn-success pull-right" 
                            href="#my-modal_rubrique_edit" ng-click="setAffichageRubrique()"
                            role="button" data-toggle="modal">
                            Modifier l'imputation Budgétaire</a>
                    <?php endif; ?>
                </legend>
                <?php if (sizeof($piecjoint) >= 1) { ?>    
                    <fieldset>  <table style="list-style: none; margin-bottom: 10px;" class="table table-bordered table-hover">
                            <tbody>  <tr style="background-color: #F5F5F5"><td>
                                        <?php
                                        $doc_budget = $piecjoint->getFirst()->getIdDocumentbudget();
                                        $documentbudegt = DocumentbudgetTable::getInstance()->find($doc_budget);
                                        if (sizeof($documentbudegt) >= 1):
                                            ?>
                                            <?php echo $documentbudegt->getLigprotitrub()->getRubrique(); ?>
                                        <?php endif; ?>
                                    </td>  
                                </tr>
                            </tbody>

                        </table>     
                    </fieldset>
                <?php } ?>
                <?php $liste_avis = Doctrine_Core::getTable('ligavisdoc')->findByIdDoc($documentachat->getId()); ?>
                <table style="width: 80%; float: left;" >
                    <tbody>
                        <?php foreach ($liste_avis as $lgavis): ?>
                            <tr>
                                <td style="width: 13%; background: repeat-x #F2F2F2;">Avis Bugétaire</td>
                                <td style="width: 60%;"><?php echo $lgavis->getAvis(); ?></td>
                                <td style="width: 12%; background: repeat-x #F2F2F2;">Date Création</td>
                                <td style="width: 15%;"><?php echo date('d/m/Y', strtotime($lgavis->getDatecreation())); ?></td>
                            </tr>
                            <?php if ($lgavis->getIdLigprotitrub() != null): ?>
                                <tr>
                                    <td style="background: repeat-x #F2F2F2;">Budget</td>
                                    <td colspan="3"><?php echo $lgavis->getLigprotitrub()->getRubrique(); ?></td>
                                </tr>
                                <tr>
                                    <td style="background: repeat-x #F2F2F2;">Rubrique</td>
                                    <td colspan="3"><?php echo $lgavis->getLigprotitrub(); ?></td>
                                </tr>
                                <tr>
                                    <td style="background: repeat-x #F2F2F2;">Reliquat</td>
                                    <td colspan="3"><?php if ($lgavis->getMntdisponible()) echo number_format($lgavis->getMntdisponible(), 3, '.', ' ') . ' TND'; ?></td>


                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php
                $visaas = Doctrine_Core::getTable('ligavissig')->findByIdDoc($documentachat->getId());
                foreach ($visaas as $visa) {
                    $visaachat = new Visaachat();
                    $vi = Doctrine_Core::getTable('visaachat')->findOneById($visa->getIdVisa());
                    if ($vi) {
                        $visaachat = $vi;
                        ?>
                        <div style="width: 20%; float: right; border-color: #00438a; margin-top: -15px;">
                            <div style="text-align: center;"><img src="<?php echo sfconfig::get('sf_appdir') . 'uploads/images/' . $visaachat->getChemin() ?>" style="width: 150px;" ></div>
                            <div style="text-align: center;"><?php echo $visaachat ?></div>
                            <div style="text-align: center; font-size: 18px;<?php if ($visa->getEtatvalide() == 'true'): ?> color: green;<?php else: ?> color: red;<?php endif; ?>"><?php echo $visa->getDatevisa() ?></div>
                        </div>
                        <?php
                    }
                }
                ?>
            </fieldset>
            <div id="my-modal_rubrique_edit" class="modal fade" tabindex="-1">
                <div class="modal-dialog" style="width: 75%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Modifier rubrique budgétaire </h3>
                            <input type="hidden" id="budget_avis_id" />
                        </div>
                        <div class="modal-body">
                            <table style="margin-bottom: 0px;">
                                <tbody>
                                    <?php $liste_avis = Doctrine_Core::getTable('ligavisdoc')->findByIdDoc($documentachat->getId()); ?>
                                    <?php foreach ($liste_avis as $lgavis): ?>
                                        <?php if ($lgavis->getIdLigprotitrub() != null): ?>
                                            <tr>
                                                <td style="background: repeat-x #F2F2F2;color: red">Rubrique Alloué</td>
                                                <td colspan="5" style="background: repeat-x #F2F2F2; color: red"><?php echo $lgavis->getLigprotitrub(); ?></td>
                                            </tr>
                                            <?php
                                        endif;
                                    endforeach;
                                    ?>
                                    <tr>
                                        <td style="width: 20%;">Exercice :</td>
                                        <td style="width: 80%;" colspan="5">
                                            <?php // echo date('Y');       ?>
                                            <?php echo $_SESSION['exercice_budget']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Budget :</td>
                                        <td colspan="5">
                                            <?php
//                                                $annees = date('Y');
                                            $annees = $_SESSION['exercice_budget'];
                                            $budgets = Doctrine_Query::create()
                                                            ->select("*")
                                                            ->from('titrebudjet')
                                                            ->where("Etatbudget=2")
                                                            ->andwhere("trim(typebudget) not like trim('Prototype')  ")
                                                            ->andwhere("trim(typebudget) like trim('Exercice:" . $annees . "')  ")
                                                            ->orderBy('id asc')->execute();
                                            ?>
                                            <select id="budget_param_compte">
                                                <option value="0">Sélectionnez</option>
                                                <?php foreach ($budgets as $budget) { ?>
                                                    <option value="<?php echo $budget->getId() ?>">
                                                        <?php echo $budget->getLibelle() ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rubrique / Sous Rubrique :</td>
                                        <td colspan="5">
                                            <select id="numeroengaement">

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rubrique :</td>
                                        <td colspan="5">
                                            <input type="text" class="form-control" readonly="true" id="rubrique" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Crédits alloués :</td>
                                        <td>
                                            <input type="text" class="align_right" readonly="true" value="" id="mnt">
                                        </td>
                                        <td>Crédits consommés:</td>
                                        <td>
                                            <input type="text" class="align_right" readonly="true" value="" id="credit">
                                        </td>
                                        <td>Reliquat:</td>
                                        <td>
                                            <input type="text" class="align_right" readonly="true" value="" id="reliq">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button ng-click="AnnulerChoixDisponible('<?php echo $documentachat->getId() ?>')" style="float: left;" class="btn btn-sm btn-danger" data-dismiss="modal">
                                <i class="ace-icon fa fa-undo"></i>
                                Annuler
                            </button>
                            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Fermer
                            </button>
                            <?php if ($documentachat->getIdEtatdoc() != 71): ?>
                                <button ng-click="ValiderChoixDisponibleProvioire('<?php echo $documentachat->getId() ?>')" class="btn btn-sm btn-success pull-right" data-dismiss="modal">
                                    <i class="ace-icon fa fa-check"></i>
                                    Valider
                                </button>
                            <?php endif; ?>
                            <?php if ($documentachat->getIdEtatdoc() == 71 || $documentachat->getIdEtatdoc() == 75): ?>
                                <button ng-click="ValiderChoixDisponibleDef('<?php echo $documentachat->getId() ?>')" class="btn btn-sm btn-success pull-right" data-dismiss="modal">
                                    <i class="ace-icon fa fa-check"></i>
                                    Valider
                                </button>
                            <?php endif; ?>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <?php $ligavissig = LigavissigTable::getInstance()->findByIdDoc($docparent->getId()); ?>
        <?php endif; ?>        
        <fieldset>
            <legend>Liste des articles</legend>
            <table>
                <thead>
                    <tr>
                        <th style="text-align: center;">N° Ordre</th>
                        <?php if ($documentachat->getIdTypedoc() != 9) { ?>
                            <th style="text-align: center;">Code Article</th>
                        <?php } ?>
                        <th>Désignation</th>
                        <th style="text-align: center;">Quantité</th>
                        <th>Projet</th>
                        <th>Observation</th>       
                        <?php if ($documentachat->getIdTypedoc() != 9) { ?>
                            <th>P.E.</th>
                            <th>P.A.</th>
                        <?php } ?>
                    </tr>             
                </thead>
                <tbody>
                    <?php
                    $lg = new Lignedocachat();
                  if ($documentachat->getIdTypedoc() != 20 && $documentachat->getIdTypedoc() != 19):
//                    die(sizeof($listesdocuments).'vd'.$documentachat->getId());
                    foreach ($listesdocuments as $lignedoc) {
                        $lg = $lignedoc;
                        $qtedemander = 0;
                        $qtees = 0;
                        $qteas = 0;
                        $qteep = 0;
                        $qteap = 0;
                        $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lg->getId());
                        if ($qteligne) {
                            $qtedemander = $qteligne->getQtedemander();
                            $qteas = $qteligne->getQteas();
                            $qtees = $qteligne->getQtees();
                            $qteap = $qteligne->getQteap();
                            $qteep = $qteligne->getQteep();
                        }
                        ?>
                        <tr>
                            <td style="text-align: center;"><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                            <?php if ($documentachat->getIdTypedoc() != 9) { ?><td style="text-align: center;"><?php echo $lg->getCodearticle() ?></td> <?php } ?>
                            <td><?php echo html_entity_decode($lg->getDesignationarticle()) ?></td>
                            <td style="text-align: center;">
                                <?php echo $qtedemander ?>
                                <?php if ($lg->getUnitedemander() != null): ?>
                                    (<?php echo $lg->getUnitedemander() ?>)
                                <?php endif; ?>
                            </td>
                            <td><?php echo $lg->getProjet() ?></td>
                            <td><?php echo $lg->getObservation() ?></td>
                            <?php if ($documentachat->getIdTypedoc() != 9) { ?>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td><?php echo $qtees ?></td>
                                            <td><?php echo $qteep ?> </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td><?php echo $qteas ?></td>
                                            <td><?php echo $qteap ?> </td>
                                        </tr>
                                    </table>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php }else : ?>
                        <?php // die(sizeof($listesdocuments).'f');
                                $lg = new Lignedocachat();
                                foreach ($listesdocuments as $lignedoc) {
                                    $lg = $lignedoc;
                                    ?>
                                    <tr>
                                        <td><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                                        <td><?php echo $lg->getCodearticle() ?></td>
                                        <td><?php echo $lg->getDesignationartcile() ?></td>
                                        <td><?php echo $lg->getQte() . " (" . trim($lg->getUnitemarche()) . ")" ?></td>
                                        <td><?php echo $lg->getProjet() ?></td>
                                        <td><?php echo $lg->getObservation() ?></td>
                                    </tr>
                                    <?php
                                    $liste_ligne_contrat = Doctrine_Core::getTable('lignecontrat')->findByIdDocparent($lg->getId());
                                }
                                ?>
                     <?php     endif;?>
                </tbody>
            </table>
            
             <?php if ($documentachat->getIdTypedoc() == 20): if (sizeof($liste_ligne_contrat) >= 1): ?>
                            <table>
                                <legend>Sous détail du Ligne de contrat</legend>
                                <thead>
                                <th>N°Ordre</th>
                                <th>Designatioon Article</th>
                                <th>Type Pièce </th>
                                <th>Taux de Pourcentage</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($liste_ligne_contrat as $ligne_lg) { ?>
                                        $html.='       <tr>
                                            <td><?php echo sprintf('%02d', $ligne_lg->getNordre() + 1); ?></td>

                                            <td><?php echo $ligne_lg->getDesignationartcile(); ?></td>
                                            <td ><?php echo $ligne_lg->getTypepiececontrat()->getLibelle(); ?></td>
                                            <td style="text-align: right"><?php echo $ligne_lg->getTauxpourcentage() . ' %'; ?></td></tr> 
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php endif;endif;  ?>
        </fieldset>
        <fieldset style="margin-left: 50%;">
            <?php if ($documentachat->getIdTypedoc() == 6): ?>
                <legend>Action Fiche B.C.I</legend>
            <?php elseif ($documentachat->getIdTypedoc() == 9): ?>
                <legend>Action Fiche B.C.I.M.P</legend>
            <?php endif; ?>
            <div>
                <?php if ($documentachat->getIdTypedoc() == 6): ?>
                    <a class="btn btn-sm btn-success" href="<?php echo url_for('documentachat/index?idtype=6') ?>">
                        <i class="ace-icon fa fa-undo bigger-110"></i> Liste B.C.I
                    </a>
                <?php elseif ($documentachat->getIdTypedoc() == 9): ?>
                    <a class="btn btn-outline btn-success" href="<?php echo url_for('documentachat/index?idtype=9') ?>">
                        <i class="ace-icon fa fa-undo bigger-110"></i> Liste B.C.I.M.P
                    </a>
                <?php endif; ?>
                <?php if ($documentachat->getIdEtatdoc() == 1 && $documentachat->getLigavisdoc()->count() != 0): ?>
                    <a id="btn_enoyer-avis" style="<?php if ($count_checked == 0): ?>display: none;<?php endif; ?>" class="btn btn-white btn-primary" href="<?php echo url_for('documentachat/valideretenvoyer') . '?iddoc=' . $documentachat->getId() . '&btn=envoyer' ?>">
                        <i class="ace-icon fa fa-send-o bigger-110"></i> Envoyer à l'unité contrôle budgétaire
                    </a>
                <?php endif; ?>
            </div>
        </fieldset>
    </div>
</div>