<?php if ($pager->count() == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="12">Liste des Fiches Vide</td>
    </tr>
<?php endif; ?>
<?php
$numero_compte = '';
$totalcredit = 0;
$totaldebit = 0;
$totalsoldecredit = 0;
$totalsoldedebit = 0;
$solde = 0;
$soldedebiteur = 0;
$soldecrediteur = 0;
$soldedebiteur_prece = 0;
$soldecrediteur_prece = 0;
$total_solde = 0;
$total_solde_prece = 0;
$totalcredit_prece = 0;
$totaldebit_prece = 0;
$totalsoldecredit_prece = 0;
$totalsoldedebit_prece = 0;
?>
<?php foreach ($etatLivre_precedent as $livre_precedent): ?>
    <?php
    $totalcredit_prece += $livre_precedent->getMontantcredit();
    // die($totalcredit_prece.'dsef');
    $totaldebit_prece += $livre_precedent->getMontantdebit();
    if ($livre_precedent->getMontantdebit() != 0)
        $total_solde_prece = $total_solde_prece + $livre_precedent->getMontantdebit();
    if ($livre_precedent->getMontantcredit() != 0)
        $total_solde_prece = $total_solde_prece - $livre_precedent->getMontantcredit();
    if ($total_solde_prece >= 0) {
        $soldedebiteur_prece = abs($total_solde_prece);
    }
    if ($total_solde_prece < 0) {
        $soldecrediteur_prece = abs($total_solde_prece);
    }
    ?>
    <?php $totalsoldedebit_prece = $soldedebiteur_prece; ?>
    <?php $totalsoldecredit_prece = $soldecrediteur_prece; ?>
<?php endforeach;  ?>
<?php if ($pager->count() != 0 || $toutlivre == 'true'): ?>
    <?php foreach ($pager as $livre): ?>
        <?php if ($numero_compte != $livre->getPlandossiercomptable()->getNumerocompte()):
            ?>
            <?php if ($numero_compte != '') :
                ?>
                <tr>
                    <td colspan="4" style="font-weight: bold;">&nbsp;</td>
                    <td colspan="2" style="font-weight: bold; background-color: #F7F7F7;">Total Période</td>
                    <td style="font-weight: bold; text-align: right; background-color: #fcf8e3;">
                        <?php
                        if ($totaldebit != 0)
                            echo number_format($totaldebit, 3, '.', ' ');
                        ?>
                    </td>
                    <td style="font-weight: bold; text-align: right; background-color: #dff0d8;">
                        <?php
                        if ($totalcredit != 0)
                            echo number_format($totalcredit, 3, '.', ' ');
                        ?>
                    </td>
                    <td style="font-weight: bold; text-align: right; background-color: #fcf8e3;">
                        <?php
                        if ($totalsoldedebit != 0)
                            echo number_format($totalsoldedebit, 3, '.', ' ');
                        ?>
                    </td>
                    <td style="font-weight: bold; text-align: right; background-color: #dff0d8;">
                        <?php
                        if ($totalsoldecredit != 0)
                            echo number_format($totalsoldecredit, 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <?php
                $totalcredit = 0;
                $totaldebit = 0;
                $totalsoldecredit = 0;
                $totalsoldedebit = 0;
                $solde = 0;
                $soldedebiteur = 0;
                $soldecrediteur = 0;
                $total_solde = 0;
                ?>
            <?php endif; ?>
            <tr>
                <td style="font-weight: bold; background-color: #eaf3f7;"><?php echo $livre->getPlandossiercomptable()->getNumerocompte() ?></td>
                <td colspan="4" style="font-weight: bold; text-align: left; background-color: #eaf3f7;"><?php echo $livre->getPlandossiercomptable()->getLibelle() ?></td>
                <td colspan="1" style="font-weight: bold;">Report</td>
                <td style="font-weight: bold; text-align: right; background-color: #fcf8e3;">
                    <?php
                    if ($totaldebit_prece != 0)
                        echo number_format($totaldebit_prece, 3, '.', ' ');
                    ?>
                </td>
                <td style="font-weight: bold; text-align: right; background-color: #dff0d8;">
                    <?php
                    if ($totalcredit_prece != 0 )
                        echo number_format($totalcredit_prece, 3, '.', ' ');
                    ?>
                </td>
                <td style="font-weight: bold; text-align: right; background-color: #fcf8e3;">
                    <?php
                    if ($totalsoldedebit_prece != 0)
                        echo number_format($totalsoldedebit_prece, 3, '.', ' ');
                    ?>
                </td>
                <td style="font-weight: bold; text-align: right; background-color: #dff0d8;">
                    <?php
                    if ($totalsoldecredit_prece != 0)
                        echo number_format($totalsoldecredit_prece, 3, '.', ' ');
                    ?>
                </td>
            </tr>
            <?php
        endif;
        if (($livre->getMontantdebit() != 0) || ($livre->getMontantcredit() != 0)):
            ?>
            <tr>
                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($livre->getPiececomptable()->getDate())) ?></td>
                <td style="text-align: left;"><?php echo $livre->getPiececomptable()->getJournalcomptable()->getCode() . ' ' . $livre->getPiececomptable()->getJournalcomptable()->getLibelle() ?></td>
                <!--<td style="text-align: center;"><?php //echo $livre->getNaturepiece()->getLibelle()              ?></td>-->
                <td style="text-align: center;">
                    <a style="cursor: pointer;" target="_blank" title="Modifier Pièce" href="<?php echo url_for('saisie_pieces/showEdit?id=' . $livre->getPiececomptable()->getId()) ?>">
                        <?php echo $livre->getPiececomptable()->getNumero() ?>
                    </a>
                </td>
                <td style="text-align: center;"><?php echo $livre->getNumeroexterne() ?></td>
                <td style="text-align: left;"><?php echo $livre->getPiececomptable()->getLibelle() ?></td>
                <td style="text-align: center;"><?php echo $livre->getLettrelettrage() ?></td>
                <td style="text-align: right; background-color: #fcf8e3;">
                    <?php
                    if ($livre->getMontantdebit() != 0):
                        $total_solde = $total_solde + $livre->getMontantdebit();
                        if ($livre->getPiececomptable()->getJournalcomptable()->getTypejournal()->getLibelle() != 'RAN')
                            echo $livre->getMontantdebit();
                    endif;
                    ?>
                </td>
                <td style="text-align: right; background-color: #dff0d8;">
                    <?php
                    if ($livre->getMontantcredit() != 0):
                        $total_solde = $total_solde - $livre->getMontantcredit();
                        if ($livre->getPiececomptable()->getJournalcomptable()->getTypejournal()->getLibelle() != 'RAN')
                            echo $livre->getMontantcredit();
                    endif;
                    ?>
                </td>
                <td style="text-align: right; background-color: #fcf8e3;">
                    <?php
                    if ($total_solde >= 0) {
                        echo number_format($total_solde, 3, '.', ' ');
                        $soldedebiteur = abs($total_solde);
                    }
                    ?>
                </td>
                <td style="text-align: right; background-color: #dff0d8;">
                    <?php
                    if ($total_solde < 0) {
                        echo number_format(abs($total_solde), 3, '.', ' ');
                        $soldecrediteur = abs($total_solde);
                    }
                    ?>
                </td>
            </tr>
            <?php $totalcredit += $livre->getMontantcredit(); ?>
            <?php $totaldebit += $livre->getMontantdebit(); ?>
            <?php $totalsoldedebit = $soldedebiteur; ?>
            <?php $totalsoldecredit = $soldecrediteur; ?>
            <?php $numero_compte = $livre->getPlandossiercomptable()->getNumerocompte(); ?>

            <?php
        endif;
    endforeach;
    ?>

    <?php if ($numero_compte != '') :
        ?>
        <tr>
            <td colspan="4" style="font-weight: bold">&nbsp;</td>
            <td colspan="2" style="font-weight: bold; background-color: #F7F7F7;">Total Période</td>
            <td style="font-weight: bold; text-align: right; background-color: #fcf8e3;">
                <?php
                if ($totaldebit != 0)
                    echo number_format($totaldebit, 3, '.', ' ');
                ?>
            </td>
            <td style="font-weight: bold; text-align: right; background-color: #dff0d8;">
                <?php
                if ($totalcredit != 0)
                    echo number_format($totalcredit, 3, '.', ' ');
                ?>
            </td>
            <td style="font-weight: bold; text-align: right; background-color: #fcf8e3;">
                <?php
                if ($totalsoldedebit != 0)
                    echo number_format($totalsoldedebit, 3, '.', ' ');
                ?>
            </td>
            <td style="font-weight: bold; text-align: right; background-color: #dff0d8;">
                <?php
                if ($totalsoldecredit != 0)
                    echo number_format($totalsoldecredit, 3, '.', ' ');
                ?>
            </td>
        </tr>
    <?php endif; ?><?php endif; ?>

<script  type="text/javascript">
    var footer = '';
    $('#listPiece_footer').html('');
<?php if ($pager->haveToPaginate()): ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="11">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12" >' +
                '<div class ="dataTables_paginate paging_simple_numbers" id ="dynamic-table_paginate">' +
                '<ul class ="pagination">' +
    <?php if ($pager->getPage() == 1): ?>
            '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPage(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPage(\'<?php echo $pager->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php endif; ?>
    <?php foreach ($pager->getLinks() as $page): ?>
        <?php if ($page == $pager->getPage()): ?>
                '<li class ="paginate_button active" aria-controls ="dynamic-table" tabindex ="0"> <a href = "#"> <?php echo $page ?> </a></li>' +
        <?php else: ?>
                '<li class ="paginate_button" aria-controls ="dynamic-table" tabindex ="0"> <a onclick="goPage(\'<?php echo $page ?>\')"> <?php echo $page ?> </a></li>' +
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($pager->getPage() == $pager->getLastPage()): ?>
            '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPage(\'<?php echo $pager->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPage(\'<?php echo $pager->getLastPage() ?>\')"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
    <?php endif; ?>
        '</ul>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php else: ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="10">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12">' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php endif; ?>

    $('#listPiece_footer').html(footer);

</script>



