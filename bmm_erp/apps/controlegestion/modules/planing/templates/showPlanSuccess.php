<div id="sf_admin_container">
    <h1>Plan Définitif</h1>
</div>
<fieldset ng-controller="CtrlFormation">
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
                <th style="widows: 10%">M.HT</th>
                <th style="widows: 4%">M.TVA</th>
                <th style="widows: 4%">M.TTC</th>
                <th style="widows: 4%">Réalisé</th>
                <th style="widows: 4%">Date Début</th>
                <th style="widows: 4%">Date Fin</th>
                <th style="widows: 4%">Motif</th>
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
                        <td><?php echo $lg->getRegroupementtheme()->getLibelle() ?> </td>
                        <td><?php echo $lg->getFormateur()->getNom() ?></td>
                        <td><?php echo $lg->getFournisseur()->getRs() ?></td> 
                        <td><?php echo $lg->getMontantht() ?></td>
                        <td><?php echo $lg->getMtva() ?></td> 
                        <td><?php echo $lg->getMontantttc() ?></td>
                        <td style="text-align: center;">
                            <?php if ($lg->getRealise() == "TRUE"): ?>
                                <i class="ace-icon fa fa-check bigger-110"></i>
                            <?php else: ?>
                                <!--Rien à afficher-->
                            <?php endif; ?>
                        </td>
                        <td><?php echo date('d/m/Y', strtotime($lg->getDateformation())); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($lg->getDatefin())); ?></td>
                        <td><?php echo $lg->getMotif() ?></td>
                    <?php } ?>             
                </tr>
            <?php } ?>
        </tbody>
    </table>

</fieldset>
<br>
<fieldset style="margin-left: 85%; margin-bottom: 10px;">
    <div>
        <input type="text" class="align_center" value="M.T.TTC : <?php echo trim($lg->getPlaning()->getMontantttc()); ?>" readonly="true">
    </div>
<!--    <button type="button"  onclick="document.location.href = '<?php // echo url_for('planing/tableaudebordformation') . '?iddoc=' . $planing->getId()         ?>'" class="btn btn-white btn-success pull-right">
      <i class="fa fa-long-arrow-right"></i>Voir  Tableau de Bord de Formation </button>-->
</fieldset>
<fieldset style="width: 100%;">
    <button onclick="document.location.href = '<?php echo url_for('planing/facturation') . '?iddoc=' . $planing->getId() ?>'" class="btn btn-white btn-success pull-right">
        <i class="ace-icon fa fa-long-arrow-right bigger-110"></i>Suivi de Règlement</button>
</fieldset>