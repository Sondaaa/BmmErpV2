<div id="sf_admin_container"   >
    <h1>Fiche BCI N°:<?php echo $documentachat->getNumero() ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $aviss = Doctrine_Core::getTable('avis')
                    ->createQuery('a')->where('id_poste=5')
                    ->orderBy('id asc')->execute();
    // Doctrine_Core::getTable('avis')->findByIdPoste(5); //Liste des avis par unité budget
    ?>
    <div id="sf_admin_content" ng-controller="myCtrlbudget">  
        <div style=" position: absolute;float: right;margin-left: 80%;margin-top: 1%;">
            <table>
                <tr>
                    <td colspan="2" style="font-size: 16px;">Avis de l'unité budget</td>
                </tr>
                <?php
                foreach ($aviss as $avis) {
                    $lgavis = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDocAndIdAvis($documentachat->getId(), $avis->getId());
                    $count_checked = 0;
                    ?>
                    <tr>
                        <?php if (strpos($avis->getLibelle(), ":") == 0): ?>
                            <td>
                                <a href="#my-modal_rubrique" ng-click="setAffichageRubrique(<?php echo $avis->getId(); ?>)" role="button" data-toggle="modal"><?php echo $avis->getLibelle(); ?></a>
                            </td>
                            <td><input class="disabledbutton" name="avis_checkbox" type="checkbox" <?php
                                if ($lgavis){
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
            <div id="my-modal_rubrique" class="modal fade" tabindex="-1">
                <div class="modal-dialog" style="width: 75%">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Choisir rubrique budgétaire </h3>
                            <input type="hidden" id="budget_avis_id" />
                        </div>
                        <div class="modal-body">
                            <table style="margin-bottom: 0px;">
                                <tbody>
                                    <tr>
                                        <td style="width: 20%;">Exercice :</td>
                                        <td style="width: 80%;" colspan="5"><?php echo date('Y'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Budget :</td>
                                        <td colspan="5">
                                            <?php
                                            $annees = date('Y');
                                            $budgets = Doctrine_Query::create()
                                                            ->select("*")
                                                            ->from('titrebudjet')
                                                            ->where("Etatbudget=2")
                                                            ->andwhere("trim(typebudget) not like trim('Prototype')  ")
                                                            ->andwhere("trim(typebudget) like trim('Exercice:" . $annees . "')  ")
                                                            ->orderBy('id asc')->execute();
                                            ?>
                                            <select id="budget">
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
                            <button ng-click="ValiderChoixDisponible('<?php echo $documentachat->getId() ?>')" class="btn btn-sm btn-success pull-right" data-dismiss="modal">
                                <i class="ace-icon fa fa-check"></i>
                                Valider
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </div>
        <?php
        $numero = strtoupper($documentachat->getTypedoc());
        $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
        ?>
        <div style="padding: 1%;width: 80%;font-size: 16px">
            <table style="list-style: none; margin-bottom: 10px;">
                <tr>
                    <td style="width: 200px; vertical-align: middle;">
                        <p><strong><?php echo strtoupper($societe); ?></strong></p>  
                    </td>
                    <td>
                        <table style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="2"><?php echo $numero; ?></td>
                            </tr>
                            <tr>
                                <td>N°: <?php echo $documentachat->getNumerodocachat() ?></td>
                                <td>Date création : <?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>
                            </tr>
                            <tr>
                                <td>Nature</td>
                                <td><?php echo $documentachat->getObjectdocument(); ?></td>
                            </tr>
                            <tr>
                                <td>Montant Estimatif</td>
                                <td><?php echo $documentachat->getMontantestimatif(); ?> TND</td>
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
                        <td style="width: 30%"><label>Nom et Prénom du demandeur</label></td>
                        <td><?php echo $documentachat->getAgents(); ?></td>
                        <td><label>Référence</label></td>
                        <td><?php echo $documentachat->getReference(); ?></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
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
        <fieldset>
            <legend>Liste des articles</legend>
            <table>
                <thead>
                    <tr>
                        <th>N°ordre</th>
                        <?php if ($documentachat->getIdTypedoc() != 9) { ?>
                            <th>Code Article</th>
                        <?php } ?>
                        <th>Désignation</th>
                        <th>Quantité</th>
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
                            <td><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                            <?php if ($documentachat->getIdTypedoc() != 9) { ?> <td><?php echo $lg->getCodearticle() ?></td> <?php } ?>
                            <td><?php echo $lg->getDesignationarticle() ?></td>
                            <td><?php echo $qtedemander ?></td>
                            <td><?php echo $lg->getProjet() ?></td>
                            <td><?php echo $lg->getObservation() ?></td>
                            <?php if ($documentachat->getIdTypedoc() != 9) { ?>
                                <td>
                                    <table>
                                        <tr>
                                            <td><?php echo $qtees ?></td>
                                            <td><?php echo $qteep ?> </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td><?php echo $qteas ?></td>
                                            <td><?php echo $qteap ?> </td>
                                        </tr>
                                    </table>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </fieldset>
        <fieldset style="margin-left: 50%;">
            <legend>Action Fiche B.C.I</legend>
            <div>
                <a class="btn btn-sm btn-danger" href="<?php echo url_for('documentachat/index?idtype=6') ?>">Liste B.C.I</a>
                <a id="btn_enoyer-avis" style="<?php if ($count_checked == 0): ?>display: none;<?php endif; ?>" class="btn btn-white btn-primary" href="<?php echo url_for('documentachat/valideretenvoyer') . '?iddoc=' . $documentachat->getId() . '&btn=envoyer' ?>">Enregistrer</a>
            </div>
        </fieldset>
    </div>
</div>