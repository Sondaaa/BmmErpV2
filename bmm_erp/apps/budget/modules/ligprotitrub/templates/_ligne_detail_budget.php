<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Résultat de recherche : Titre Budget - <?php echo $titre_budget->getLibelle() ?>
            <a target="_blanc" href="<?php echo url_for('ligprotitrub/ImprimerRapportRubrique?id=' . $titre_budget->getId()) ?>" class="btn btn-sm btn-success" style="float: right; padding: 5px 9px;">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
        </div>
        <div>
            <form>
                <div class="sf_admin_list">
                    <table id="list_rubrique" class="table table-bordered table-hover" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 9%">Code</th>
                                <th style="width: 34%; text-align: left;">Rubrique<br><span style="margin-left: 30px;">Sous Rubrique</span></th>
                                <th style="width: 11%">Montant Eng. Provisoire</th>
                                <th style="width: 11%;">Montant Eng. Définitif</th>
                                <th style="width: 9%;">Ecart Engagement</th>
                                <th style="width: 11%;">Ordonnance de Paiement</th>
                                <th style="width: 11%;">Montant Payé</th>
                                <th style="width: 4%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rubriques = LigprotitrubTable::getInstance()->getFirstParentByTitre($titre_budget->getId());
                            ?>
                            <?php if ($rubriques->count() == 0) : ?>
                                <tr>
                                    <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">Pas de rubriques</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($rubriques as $ldb) : ?>
                                    <?php $rubriques_sous_lignes = LigprotitrubTable::getInstance()->getSousRubrique($ldb->getIdRubrique(), $ldb->getIdTitre()); 
                                    ?>
                                    <?php if ($rubriques_sous_lignes->count() != 0) : ?>
                                        <!--S'il y a des sous rubrique : on fait le total des sous rubrique-->
                                        <?php
                                        $mnt_rapport = calculMontantRapportSousRubrique::getMnt($rubriques_sous_lignes);
                                        if ($mnt_rapport["provisoire"] == 0 && $mnt_rapport["engagement"] > 0):
                                            $ecart = abs($mnt_rapport["provisoire"] - $mnt_rapport["engagement"]);
                                        else:
                                            $ecart = $mnt_rapport["provisoire"] - $mnt_rapport["engagement"];
                                        endif;
                                        //$mnt_rapport["ecart"]
                                        ?>
                                        <tr style="background-color: #e5f1f7;">
                                            <td><?php echo $ldb->getCode(); ?></td>
                                            <td><?php echo $ldb->getRubrique()->getLibelle(); ?></td>
                                            <td style="text-align: right"><?php echo number_format($mnt_rapport["provisoire"], 3, '.', ' '); ?></td>
                                            <td style="text-align: right"><?php echo number_format($mnt_rapport["engagement"], 3, '.', ' '); ?></td>

                                            <td style="text-align: right"><?php echo number_format($ecart, 3, '.', ' '); ?></td>
                                            <td style="text-align: right"><?php echo number_format($mnt_rapport["ordonnance"], 3, '.', ' '); ?></td>
                                            <td style="text-align: right"><?php echo number_format($mnt_rapport["paye"], 3, '.', ' '); ?></td>
                                            <td style="text-align: center;">
                                                <!--Pas de bouton "Détails" s'il y a des sous rubriques-->
                                            </td>
                                        </tr>
                                        <?php include_partial("ligprotitrub/ligne_sous_detail_budget", array("rubriques_sous_lignes" => $rubriques_sous_lignes, "margin_left" => 20, "color" => "#006ea6")) ?>
                                    <?php else : ?>
                                        <?php
                                        $total_provisoire = DocumentbudgetTable::getInstance()->getMntTypeDocBudget($ldb->getId(), 3)->getMnt();
                                        $total_engage = DocumentbudgetTable::getInstance()->getMntTypeDocBudget($ldb->getId(), 1)->getMnt();
                                        $total_ordonnance = DocumentbudgetTable::getInstance()->getMntTypeDocBudget($ldb->getId(), 2)->getMnt();
                                        $total_caisse = LigneoperationcaisseTable::getInstance()->getMntPaye($ldb->getId())->getMnt();
                                        $total_banque = MouvementbanciareTable::getInstance()->getMntPaye($ldb->getId())->getMnt();
                                        $total_paye = $total_caisse + $total_banque;
                                        if ($total_provisoire == 0 && $total_engage > 0) {
                                            $ecar = abs($total_provisoire - $total_engage);
                                        } else {
                                            $ecar = abs($total_provisoire - $total_engage);
                                        }
                                        ?>
                                        <!--S'il n'y a pas des sous rubrique : on affiche directement les attributs de la rubrique-->
                                        <tr style="background-color: #e5f1f7;">
                                            <td  ><?php echo $ldb->getCode(); ?></td>
                                            <td><?php echo $ldb->getRubrique()->getLibelle(); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_provisoire, 3, '.', ' '); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_engage, 3, '.', ' '); ?></td>
                                            <td style="text-align: right"><?php echo number_format($ecar, 3, '.', ' '); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_ordonnance, 3, '.', ' '); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_paye, 3, '.', ' '); ?></td>
                                            <td style="text-align: center;">
                                                <?php if ($total_provisoire != 0) : ?>
                                                    <a target="_blanc" href="<?php echo url_for('ligprotitrub/detailsLigprotitrub?id=' . $ldb->getId()) ?>" class="btn btn-xs btn-primary">
                                                        <i class="ace-icon fa fa-eye"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    #list_rubrique>thead>tr>th {
        text-align: center;
    }
</style>