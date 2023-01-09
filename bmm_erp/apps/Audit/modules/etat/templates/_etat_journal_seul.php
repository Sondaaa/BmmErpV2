<?php
$url = '';
$resultat_debit = '';
$resultat_credit = '';
$url.= 'id=' . $journal->getId();
if ($date_debut != '')
    $url.= '&date_debut=' . $date_debut;
if ($date_fin != '')
    $url.= '&date_fin=' . $date_fin;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Journal Comptable : <?php echo $journal->getCode() . ' - ' . $journal->getLibelle() ?>
            <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;margin-left: 5px" href="<?php echo url_for("etat/imprimeJournalSeul?" . $url); ?>">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
            <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px; margin-left: 3px" href="<?php echo url_for("etat/exporterJournalSeulExcel?" . $url); ?>">
                <i class="ace-icon fa fa-file-excel-o"></i>
                <span class="bigger-110 no-text-shadow">Exporter</span>
            </a>
        </div>

        <div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 10%;">Date</th>
                        <th style="width: 10%;">Pièce Comptable</th>
                        <th style="width: 10%;">Numèro de Compte</th>
                        <th style="width: 7%;">Référence</th>
                        <th style="width: 7%;">Nature Pièce</th>
                        <th style="width: 7%;">N° Externe</th>
                        <th style="width: 25%;">Libellé</th>
                        <th style="width: 12%;">Débit</th>
                        <th style="width: 12%;">Crédit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $color1 = "#e6ecff";
                    $color2 = "#b3c6ff;";
                    $numero_piece = '';
                    $Str_Row_Color = '';
                    ?>
                    <?php if ($etatJournal->count() != 0): ?>
                        <?php foreach ($etatJournal as $fiche): ?>
                            <?php
                            if ($numero_piece != $fiche->getPiececomptable()->getNumero() && $numero_piece != ''):
                                $numero_piece = $fiche->getPiececomptable()->getNumero();
                                if ($Str_Row_Color == $color1)
                                    $Str_Row_Color = $color2;
                                else
                                    $Str_Row_Color = $color1;
                                $border = 'border:solid 1px #000000';
                            else:
                                $numero_piece = $fiche->getPiececomptable()->getNumero();
                                $border = '';
                            endif;
                            ?>
                            <tr style="background: <?php echo $Str_Row_Color ?>">
                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($fiche->getPiececomptable()->getDate())) ?></td>
                                <td style="text-align: center;">
                                    <a style="cursor: pointer;" target="_blank" title="Modifier Pièce" href="<?php echo url_for('saisie_pieces/showEdit?id=' . $fiche->getPiececomptable()->getId()) ?>">
                                        <?php echo $fiche->getPiececomptable()->getNumero() ?>
                                    </a>
                                </td>
                                <td style="text-align: center;"> <?php echo $fiche->getPlandossiercomptable()->getNumerocompte() ?></td>
                                <td style="text-align: center;"><?php echo $fiche->getReference() ?></td>
                                <td style="text-align: center;"><?php echo $fiche->getNaturepiece()->getLibelle() ?></td>
                                <td style="text-align: center;"><?php echo $fiche->getNumeroexterne() ?></td>
                                <td style="text-align: left;">
                                    <?php if ($fiche->getLibelle()): ?>
                                        <?php echo $fiche->getLibelle(); ?>
                                    <?php else: ?>
                                        <?php echo $fiche->getPiececomptable()->getLibelle(); ?>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php
                                    if ($fiche->getMontantdebit() == 0):
                                        echo '';
                                    else:
                                        echo number_format($fiche->getMontantdebit(), 3, '.', ' ');
                                        $resultat_debit = $resultat_debit + $fiche->getMontantdebit();
                                    endif;
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php
                                    if ($fiche->getMontantcredit() == 0):
                                        echo '';
                                    else:
                                        echo number_format($fiche->getMontantcredit(), 3, '.', ' ');
                                        $resultat_credit = $resultat_credit + $fiche->getMontantcredit();

                                    endif;
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td style="text-align:center; font-weight: bold; font-size: 16px !important; height: 100px; vertical-align: middle;" colspan="9">Pas de Pièces Comptables dans ce Journal Comptable</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <?php if ($etatJournal->count() != 0): ?>
                    <tfoot>
                        <tr style="background: repeat-x #F2F2F2;">
                            <td style="text-align: center; font-weight: bold; font-size: 18px" colspan="2" class="fixed-side" scope="col">Total</td>
                            <td colspan="5"></td>
                            <td style="text-align: right; font-weight: bold;font-size: 16px">
                                <?php
                                echo number_format($resultat_debit, 3, '.', ' ');
                                ?>
                            </td>
                            <td style="text-align: right; font-weight: bold;font-size: 16px">
                                <?php
                                echo number_format($resultat_credit, 3, '.', ' ');
                                ?>
                            </td>
                        </tr>

                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>

        </div>
    </div>
</div>