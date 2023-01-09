<?php foreach ($rubriques_sous_lignes as $ligne_sous_rubrique): ?>
    <?php $rub_sous_lignes = LigprotitrubTable::getInstance()->getSousRubrique($ligne_sous_rubrique->getIdRubrique(), $ligne_sous_rubrique->getIdTitre()); ?>

    <?php if ($rub_sous_lignes->count() != 0): ?>
        <?php $style_td = "text-align: left; padding-left: " . $margin_left . "px;"; ?>
        <?php $mnt_rapport = calculMontantRapportSousRubrique::getMnt($rub_sous_lignes); ?>
        <tr>
            <td style="padding-left: <?php echo $margin_left ?>px; color: <?php echo $color; ?>;"><?php echo $ligne_sous_rubrique->getCode(); ?></td>
            <td style="padding-left: <?php echo $margin_left ?>px; color: <?php echo $color; ?>;"><?php echo $ligne_sous_rubrique->getRubrique()->getLibelle(); ?></td>
            <td style="<?php echo $style_td ?>"><?php echo number_format($mnt_rapport["provisoire"], 3, '.', ' '); ?></td>
            <td style="<?php echo $style_td ?>"><?php echo number_format($mnt_rapport["engagement"], 3, '.', ' '); ?></td>
            <td style="<?php echo $style_td ?>"><?php echo number_format($mnt_rapport["ecart"], 3, '.', ' '); ?></td>
            <td style="<?php echo $style_td ?>"><?php echo number_format($mnt_rapport["ordonnance"], 3, '.', ' '); ?></td>
            <td style="<?php echo $style_td ?>"><?php echo number_format($mnt_rapport["paye"], 3, '.', ' '); ?></td>
            <td style="text-align: center;">
                <?php if ($total_provisoire != 0): ?>
                    <a target="_blanc" href="<?php echo url_for('ligprotitrub/detailsLigprotitrub?id=' . $ligne_sous_rubrique->getId()) ?>" class="btn btn-xs btn-primary">
                        <i class="ace-icon fa fa-eye"></i>
                        <span class="bigger-110 no-text-shadow">Détails</span>
                    </a>
                <?php endif; ?>
            </td>
        </tr>

        <?php $m_left = $margin_left + 20; ?>
        <?php
        switch ($color) {
            case '#006ea6':
                $s_color = "#338703";
                break;
            case '#338703':
                $s_color = "#870360";
                break;
            case '#870360':
                $s_color = "#873b03";
                break;
            case '#873b03':
                $s_color = "#006ea6";
                break;
            default :
                $s_color = "#006ea6";
                break;
        }
        ?>
        <?php include_partial("ligprotitrub/ligne_sous_detail_budget", array("rubriques_sous_lignes" => $rub_sous_lignes, "margin_left" => $m_left, "color" => $s_color)) ?>
    <?php else: ?>
        <?php
        $style_td = "text-align: right;";
        //Calcul des Totaux
        $total_provisoire = DocumentbudgetTable::getInstance()->getMntTypeDocBudget($ligne_sous_rubrique->getId(), 3)->getMnt();
        $total_engagement = DocumentbudgetTable::getInstance()->getMntTypeDocBudget($ligne_sous_rubrique->getId(), 1)->getMnt();
        $total_ordonnance = DocumentbudgetTable::getInstance()->getMntTypeDocBudget($ligne_sous_rubrique->getId(), 2)->getMnt();
        $total_caisse = LigneoperationcaisseTable::getInstance()->getMntPaye($ligne_sous_rubrique->getId())->getMnt();
        $total_banque = MouvementbanciareTable::getInstance()->getMntPaye($ligne_sous_rubrique->getId())->getMnt();
        $total_paye = $total_caisse + $total_banque;
        ?>
        <tr>
            <td style="padding-left: <?php echo $margin_left ?>px; color: <?php echo $color; ?>;"><?php echo $ligne_sous_rubrique->getCode(); ?></td>
            <td style="padding-left: <?php echo $margin_left ?>px; color: <?php echo $color; ?>;"><?php echo $ligne_sous_rubrique->getRubrique()->getLibelle(); ?></td>
            <td style="<?php echo $style_td ?>"><?php echo number_format($total_provisoire, 3, '.', ' '); ?></td>
            <td style="<?php echo $style_td ?>"><?php echo number_format($total_engagement, 3, '.', ' '); ?></td>
            <td style="<?php echo $style_td ?>"><?php echo number_format($total_provisoire - $total_engagement, 3, '.', ' '); ?></td>
            <td style="<?php echo $style_td ?>"><?php echo number_format($total_ordonnance, 3, '.', ' '); ?></td>
            <td style="<?php echo $style_td ?>"><?php echo number_format($total_paye, 3, '.', ' '); ?></td>
            <td style="text-align: center; padding: 4px;">
                <?php if ($total_provisoire != 0): ?>
                    <a target="_blanc" href="<?php echo url_for('ligprotitrub/detailsLigprotitrub?id=' . $ligne_sous_rubrique->getId()) ?>" class="btn btn-xs btn-primary">
                        <i class="ace-icon fa fa-eye"></i>
                    </a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endif; ?>
<?php endforeach; ?>