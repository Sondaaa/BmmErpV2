<div id="sf_admin_container">
    <h1>Plan (Liste des Formations)</h1>
</div>

<fieldset ng-controller="CtrlFormation">
    <div >
        <table class="table table-bordered table-hover">
            <thead style="background: #fef7ec ;">
                <tr>
                    <th style="widows: 1%">N°</th>
                    <th style="widows: 4%">Unité</th>
                    <th style="widows: 4%">Thème</th>
                    <th style="widows: 4%">Agents</th>
                    <th style="widows: 4%">Regroup.</th>
                    <th style="widows: 8%">Formateur</th>
                    <th style="widows: 8%">Organisme</th>
                    <th style="widows: 14%">M.HT</th>
                    <th style="widows: 4%">M.TVA</th>
                    <th style="widows: 4%">M.TTC</th>
                    <th style="widows: 4%">Réalisé</th>
                    <th style="widows: 4%">Date Début</th>
                    <th style="widows: 4%">Date Fin</th>
                    <th style="widows: 8%">Motif</th>
                    <th style="widows: 10%">Action</th>
                </tr>             
            </thead>
            <tbody>
                <?php
                $lg = new Ligneplaning();
                foreach ($listesdocuments as $lignedoc) {
                    $lg = $lignedoc;
                    ?>
                    <tr>
                        <?php if ($lg->getValide() == "1") { ?>
                            <td><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                            <td>
                                <?php if ($lg->getBesoinsdeformation()->getAgents()->getContrat()->getId() != ""): ?>    <?php echo $lg->getBesoinsdeformation()->getAgents()->getContrat()->getLast()->getPosterh()->getUnite()->getLibelle() ?><?php endif; ?>
                            </td>
                            <td><?php echo $lg->getTheme() ?></td>
                            <td><?php echo $lg->getBesoinsdeformation()->getAgents()->getNomcomplet() ?></td>
                            <td><?php echo $lg->getRegroupementtheme()->getLibelle() ?></td>
                            <td><?php echo $lg->getFormateur()->getNom() . " " . $lg->getFormateur()->getPrenom() ?></td> 
                            <td><?php echo $lg->getFournisseur()->getRs(); ?></td> 
                            <td><input data="fixed" class="align_center" style="width: 75px" type="text" id="input_montant_<?php echo $lg->getId() ?>" value="<?php echo number_format(trim($lg->getMontantht()), 3, '.', ''); ?>"</td>
                            <td><?php echo $lg->getMtva() ?></td>
                            <td><input data="fixed" class="align_center" name="ligne_montant_ttc_<?php echo $lg->getId() ?>" style="width: 75px" type="text" id="input_montanttc_<?php echo $lg->getId() ?>" value="<?php echo number_format(trim($lg->getMontantttc()), 3, '.', ''); ?>"</td>
                            <td style="text-align: center;"> 
                                <input name="chekrealise" ligne_id="<?php echo $lg->getId() ?>" type="checkbox" id="realise_<?php echo $lg->getId() ?>" class="check_realise" <?php if ($lg->getDateformation() != ""): ?> checked="true"<?php endif; ?>>
                            </td>
                            <td><input type="date" ligne_id="<?php echo $lg->getId() ?>" value="<?php echo $lg->getDateformation() ?>" id="input_dated_<?php echo $lg->getId() ?>" class="form-control <?php if ($lg->getDateformation() == ""): ?>disabledbutton<?php endif; ?> liste_formation"></td>
                            <td><input type="date" ligne_id="<?php echo $lg->getId() ?>" value="<?php echo $lg->getDatefin() ?>" id="input_datefin_<?php echo $lg->getId() ?>" class="form-control <?php if ($lg->getDateformation() == ""): ?>disabledbutton<?php endif; ?> liste_formation"></td>
                            <td><input type="text" value="<?php echo $lg->getMotif() ?>" id="motif_<?php echo $lg->getId() ?>" class="form-control <?php if ($lg->getDateformation() != ""): ?>disabledbutton<?php endif; ?>" placeholder="Motif"></td>
                            <td style="display: none;"><input type="text" class="align_center" value="<?php echo $lg->getNbrjour() ?>" id="nbrjour_<?php echo $lg->getId() ?>"></td>
                 <!--           <td style="display: none"><input type="text" id="nbrheure_<?php // echo $lg->getId()     ?>"></td>
                            <td style="display: none">
                                <input type="text" id="sousrub_<?php // echo $lg->getId()     ?>" value="<?php // echo $lg->getSousrubrique()->getLibelle()     ?>">
                            </td>
                             <td style="display: none">
                                <input type="text" id="ristourne_<?php // echo $lg->getId()     ?>" value="<?php // echo $lg->getSousrubrique()->getRistourne()->getLast()->getLibelle()     ?>" >
                            </td>
                            <td style="display: none">
                                <input type="text" id="baseri_<?php // echo $lg->getId();     ?>" value="<?php // echo $lg->getSousrubrique()->getBaserustourne()->getLast()->getLibelle()     ?>">
                            </td> 
                            <td style="display: none"><input name="mris_<?php // echo $lg->getId();     ?>" id="mris_<?php // echo $lg->getId();     ?>" type="text" placeholder="M.Ristourne"></td> 
                            <td style="display: none"><input name="msoc_<?php // echo $lg->getId();     ?>" id="msoc_<?php // echo $lg->getId();     ?>" type="text" placeholder="M.Société"></td>-->

                            <td>
                                <button type="button" id="btnvalideplan_<?php echo $lg->getId() ?>" class="btn btn-white btn-success" ng-click="ValiderLigne(<?php echo $lg->getId() ?>)">
                                    valider
                                </button>
                            </td>
                        </tr>
                    <?php } ?>    
                <?php } ?>
            </tbody>
        </table>
    </div>
</fieldset>
<br>
<fieldset style="margin-left: 87%; margin-bottom: 10px;">
    <div>
<!--        <input type="text" value="M.P.TTC : <?php //echo $lg->getMontantttc();               ?>">-->
        <input type="text" class="align_center" id="montanttotaTTCRealise" placeholder="M.T.TTC" value="<?php echo trim($lg->getPlaning()->getMontanttotalht()); ?>" readonly="true">
    </div>
</fieldset>
<fieldset style="width: 100%;">
    <button onclick="document.location.href = '<?php echo url_for('planing/showPlan') . '?iddoc=' . $planing->getId() ?>'" class="btn btn-white btn-success pull-right">
        <i class="ace-icon fa fa-long-arrow-right bigger-110"></i>Voir T.B.Execution Plan Définitif </button>

    <button onclick="document.location.href = '<?php echo url_for('planing/showRealisation') . '?iddoc=' . $planing->getId() ?>'" class="btn btn-white btn-success pull-left">
        <i class="ace-icon fa fa-undo bigger-110"></i>Retour au planning Prévisionnel</button>
</fieldset>