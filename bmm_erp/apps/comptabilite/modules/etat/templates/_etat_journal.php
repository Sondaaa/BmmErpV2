<?php
$first_journal = $etatJournal->getFirst();

$index = 0;
$fermeture = 1;
?>

<?php
$url = '';
if ($date_debut_journal != '')
    $url.= '&date_debut_journal=' . $date_debut_journal;
if ($date_fin_journal != '')
    $url.= '&date_fin_journal=' . $date_fin_journal;
if ($date_debut != '')
    $url.= '&date_debut=' . $date_debut;
if ($date_fin != '')
    $url.= '&date_fin=' . $date_fin;

if ($url != '')
    $url = substr($url, 1);
?>

<?php if ($etatJournal->count() != 0): ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="table-header" style="margin-bottom: 0px;">
                Journaux Comptables :
                <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px; margin-left: 3px" href="<?php echo url_for("etat/imprimeEtatJournal?" . $url); ?>">
                    <i class="ace-icon fa fa-print bigger-110"></i>
                    <span class="bigger-110 no-text-shadow">Imprimer Tout</span>
                </a>
                <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px; margin-right: 1%;" href="<?php echo url_for("etat/exporterEtatJournalExcel_1?" . $url); ?>">
                       <i class="ace-icon fa fa-file-excel-o"></i>
                    <span class="bigger-110 no-text-shadow">Exporter Tout </span>
                </a>
            </div>
            <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;">
                <?php for ($j = 0; $j < count($journals); $j++): ?>
                    <?php if ($journals[$j]['code'] == $first_journal->getPiececomptable()->getJournalcomptable()->getCode()): ?>
                        <?php break; ?>
                    <?php else: ?>
                        <div class="table-header" style="color: #855D10 !important; border-color: #E8B10D; background: #FFDD9C;">
                            Journal Comptable : <?php echo $journals[$j]['code'] . ' - ' . $journals[$j]['libelle']; ?>
                        </div>
                        <div>
                            <table id="listJournal" class="table table-bordered table-hover">
                                <thead>
                                    <tr style="border-bottom: 1px solid #000000">
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
                                    <tr>
                                        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="8">Liste des Fiches Vide</td>
                                    </tr>
                                </tbody>
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
                                </tfoot>
                            </table>
                        </div>
                        <?php $index++; ?>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php foreach ($etatJournal as $fiche): ?>
                    <?php if ($fermeture == 1): ?>
                        <div class="table-header" style="background: #82AF6F; border-color: #82AF6F;">
                            Journal Comptable : <?php echo $fiche->getPiececomptable()->getJournalcomptable()->getCode() . ' - ' . $fiche->getPiececomptable()->getJournalcomptable()->getLibelle() ?>
                            <?php
                            $resultat_debit = '';
                            $resultat_credit = '';
                            $sous_url = '';
                            $sous_url.= 'id=' . $fiche->getPiececomptable()->getJournalcomptable()->getId();
                            if ($date_debut != '')
                                $sous_url.= '&date_debut=' . $date_debut;
                            if ($date_fin != '')
                                $sous_url.= '&date_fin=' . $date_fin;
                            ?>
                            <a target="_blank" class="btn btn-sm btn-primary" style="float: right; padding: 5px 12px; margin-left: 5px" href="<?php echo url_for("etat/imprimeJournalSeul?" . $sous_url); ?>">
                                <i class="ace-icon fa fa-print bigger-110"></i>
                                <span class="bigger-110 no-text-shadow">Imprimer</span>
                            </a>
                            <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px;" href="<?php echo url_for("etat/exporterJournalSeulExcel?" . $sous_url); ?>">
                                  <i class="ace-icon fa fa-file-excel-o"></i>
                                <span class="bigger-110 no-text-shadow">Exporter</span>
                            </a>
                        </div>
                        <div>
                            <table id="listJournal" class="table table-bordered table-hover">
                                <thead>
                                    <tr style="border-bottom: 1px solid #000000">
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


                                <?php
                                $fermeture = 0;
                                $resultat_debit = '';
                                $resultat_credit = '';
                                ?>
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($fiche->getPiececomptable()->getDate())) ?></td>
                                        <td style="text-align: center;">
                                            <a style="cursor: pointer;" target="_blank" title="Imprimer" href="<?php echo url_for('saisie_pieces/imprimePiece?id=' . $fiche->getPiececomptable()->getId()) ?>">
                                                <?php echo $fiche->getPiececomptable()->getNumero() ?>
                                            </a>
                                        </td>
                                        <td style="text-align: center;"> <?php echo $fiche->getPlandossiercomptable()->getNumerocompte() ?></td>
                                        <td style="text-align: center;"><?php echo $fiche->getReference() ?></td>
                                        <td style="text-align: center;"><?php echo $fiche->getNaturepiece()->getLibelle() ?></td>
                                        <td style="text-align: center;"><?php echo $fiche->getNumeroexterne() ?></td>
                                        <td style="text-align: left;">
                                            <?php if ($fiche->getLibelle() != '' && $fiche->getLibelle() != null): ?>
                                                <?php // echo $fiche->getLibelle(); ?>
                                            <?php else: ?>
                                                <?php // echo $fiche->getPiececomptable()->getLibelle();  ?>
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php
                                            if ($fiche->getMontantDebit() == 0):
                                                echo '';
                                            else:
                                                echo $fiche->getMontantDebit();
                                                $resultat_debit = $resultat_debit + $fiche->getMontantdebit();
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php
                                            if ($fiche->getMontantCredit() == 0):
                                                echo '';
                                            else:
                                                echo $fiche->getMontantCredit();
                                                $resultat_credit = $resultat_credit + $fiche->getMontantcredit();

                                            endif;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php $index++; ?>
                                <?php else: ?>
                                    <?php $index--; ?>
                                    <?php if ($journals[$index]['code'] == $fiche->getPiececomptable()->getJournalcomptable()->getCode()): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($fiche->getPiececomptable()->getDate())) ?></td>
                                            <td style="text-align: center;">
                                                <a style="cursor: pointer;" target="_blank" title="Imprimer" href="<?php echo url_for('saisie_pieces/imprimePiece?id=' . $fiche->getPiececomptable()->getId()) ?>">
                                                    <?php echo $fiche->getPiececomptable()->getNumero() ?>
                                                </a>
                                            </td>
                                            <td style="text-align: center;"> <?php echo $fiche->getPlandossiercomptable()->getNumerocompte() ?></td>

                                            <td style="text-align: center;"><?php echo $fiche->getReference() ?></td>
                                            <td style="text-align: center;"><?php echo $fiche->getNaturepiece()->getLibelle() ?></td>
                                            <td style="text-align: center;"><?php echo $fiche->getNumeroexterne() ?></td>
                                            <td style="text-align: left;">
                                                <?php if ($fiche->getLibelle() != '' && $fiche->getLibelle() != null): ?>
                                                    <?php echo $fiche->getLibelle(); ?>
                                                <?php else: ?>
                                                    <?php echo $fiche->getPiececomptable()->getLibelle(); ?>
                                                <?php endif; ?>
                                            </td>
                                            <td style="text-align: right;">
                                                <?php
                                                if ($fiche->getMontantDebit() == 0):
                                                    echo '';
                                                else:
                                                    echo $fiche->getMontantDebit();
                                                    $resultat_debit = $resultat_debit + $fiche->getMontantDebit();
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align: right;">
                                                <?php
                                                if ($fiche->getMontantCredit() == 0):
                                                    echo '';
                                                else:
                                                    echo $fiche->getMontantCredit();
                                                    $resultat_credit = $resultat_credit + $fiche->getMontantcredit();
                                                endif;
                                                ?>
                                            </td>
                                        </tr>
                                        <?php $index++; ?>
                                    <?php else: ?>
                                    </tbody>
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


                                    </tfoot>
                                </table>
                            </div>
                            <?php $fermeture = 1; 
                            $resultat_debit = '';
                            $resultat_credit = '';?>
                            <?php $index++; ?>
                            <?php $index_sup = $index; ?>
                            <?php for ($j = $index; $j < count($journals); $j++): ?>
                                <?php if ($journals[$j]['code'] == $fiche->getPiececomptable()->getJournalcomptable()->getCode()): ?>
                                    <div class="table-header" style="background: #82AF6F; border-color: #82AF6F;">
                                        <?php
                                        $url_journal = '';
                                        $url_journal.= 'id=' . $fiche->getPiececomptable()->getJournalcomptable()->getId();
                                        if ($date_debut != '')
                                            $url_journal.= '&date_debut=' . $date_debut;
                                        if ($date_fin != '')
                                            $url_journal.= '&date_fin=' . $date_fin;
                                        ?>
                                        Journal Comptable : <?php echo $fiche->getPiececomptable()->getJournalcomptable()->getCode() . ' - ' . $fiche->getPiececomptable()->getJournalcomptable()->getLibelle() ?>
                                        <a target="_blank" class="btn btn-sm btn-primary" style="float: right; padding: 5px 12px;" href="<?php echo url_for("etat/imprimeJournalSeul?" . $url_journal); ?>">
                                            <i class="ace-icon fa fa-print bigger-110"></i>
                                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                                        </a>
                                    </div>
                                    <div>
                                        <table id="listJournal" class="table table-bordered table-hover">
                                            <thead>
                                                <tr style="border-bottom: 1px solid #000000">
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
                                                <?php $fermeture = 0; ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($fiche->getPiececomptable()->getDate())) ?></td>
                                                    <td style="text-align: center;">
                                                        <a style="cursor: pointer;" target="_blank" title="Imprimer" href="<?php echo url_for('saisie_pieces/imprimePiece?id=' . $fiche->getPiececomptable()->getId()) ?>">
                                                            <?php echo $fiche->getPiececomptable()->getNumero() ?>
                                                        </a>
                                                    </td>
                                                    <td style="text-align: center;"> <?php echo $fiche->getPlandossiercomptable()->getNumerocompte() ?></td>

                                                    <td style="text-align: center;"><?php echo $fiche->getReference() ?></td>
                                                    <td style="text-align: center;"><?php echo $fiche->getNaturepiece()->getLibelle() ?></td>
                                                    <td style="text-align: center;"><?php echo $fiche->getNumeroexterne() ?></td>
                                                    <td style="text-align: left;">
                                                        <?php if ($fiche->getLibelle() != '' && $fiche->getLibelle() != null): ?>
                                                            <?php echo $fiche->getLibelle(); ?>
                                                        <?php else: ?>
                                                            <?php echo $fiche->getPiececomptable()->getLibelle(); ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <?php
                                                        if ($fiche->getMontantDebit() != 0):
                                                            echo $fiche->getMontantDebit();
                                                            $resultat_debit = $resultat_debit + $fiche->getMontantDebit();

                                                        endif;
                                                        ?>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <?php
                                                        if ($fiche->getMontantCredit() != 0):
                                                            echo $fiche->getMontantCredit();
                                                            $resultat_credit = $resultat_credit + $fiche->getMontantcredit();

                                                        endif;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php $index_sup++; ?>
                                                <?php break; ?>
                                            <?php else: ?>
                                            <div class="table-header" style="color: #855D10 !important; border-color: #E8B10D; background: #FFDD9C;">
                                                Journal Comptable : <?php echo $journals[$j]['code'] . ' - ' . $journals[$j]['libelle']; ?>
                                            </div>
                                            <div>
                                                <table id="listJournal" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr style="border-bottom: 1px solid #000000">
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
                                                        <tr>
                                                            <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="8">Liste des Fiches Vide</td>
                                                        </tr>
                                                    </tbody>
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


                                                    </tfoot>
                                                </table>
                                            </div>
                                            <?php $index_sup++; ?>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    <?php $index = $index_sup; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody> 
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


                        </tfoot>

                        <?php if ($fermeture == 0): ?>

                        </table>
                    </div>
                    <?php $fermeture = 1; ?>

                    <?php for ($j = $index; $j < count($journals); $j++): ?>
                        <div class="table-header" style="color: #855D10 !important; border-color: #E8B10D; background: #FFDD9C;">
                            Journal Comptable : <?php echo $journals[$j]['code'] . ' - ' . $journals[$j]['libelle']; ?>
                        </div>
                        <div>
                            <table id="listJournal" class="table table-bordered table-hover">
                                <thead>
                                    <tr style="border-bottom: 1px solid #000000">
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
                                    <tr>
                                        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="8">Liste des Fiches Vide</td>
                                    </tr>
                                </tbody>
            <!--                                <tfoot>
                                    <tr style="background: repeat-x #F2F2F2;">
                                        <td style="text-align: center; font-weight: bold; font-size: 18px" colspan="2" class="fixed-side" scope="col">Total</td>
                                        <td colspan="4"></td>
                                        <td style="text-align: right; font-weight: bold;font-size: 16px">
                                <?php
//                                            echo number_format($resultat_debit, 3, '.', ' ');
                                ?>
                                        </td>
                                        <td style="text-align: right; font-weight: bold;font-size: 16px">
                                <?php
//                                            echo number_format($resultat_credit, 3, '.', ' ');
                                ?>
                                        </td>
                                    </tr>


                                </tfoot>-->
                            </table>
                        </div>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
        </div>

    <?php else: ?>
        <div class="row">
            <div class="col-xs-12">
                <?php for ($j = 0; $j < count($journals); $j++): ?>
                    <?php $index++; ?>
                    <div class="col-xs-12">
                        <div class="table-header" style="color: #855D10 !important; border-color: #E8B10D; background: #FFDD9C;">
                            Journal Comptable : <?php echo $journals[$j]['code'] . ' - ' . $journals[$j]['libelle']; ?>
                        </div>
                        <div>
                            <table id="listJournal" class="table table-bordered table-hover">
                                <thead>
                                    <tr style="border-bottom: 1px solid #000000">
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
                                    <tr>
                                        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="8">Liste des Fiches Vide</td>
                                    </tr>
                                </tbody>
        <!--                                <tfoot>
                                    <tr style="background: repeat-x #F2F2F2;">
                                        <td style="text-align: center; font-weight: bold; font-size: 18px" colspan="2" class="fixed-side" scope="col">Total</td>
                                        <td colspan="5"></td>
                                        <td style="text-align: right; font-weight: bold;font-size: 16px">
                                <?php
//                                            echo number_format($resultat_debit, 3, '.', ' ');
                                ?>
                                        </td>
                                        <td style="text-align: right; font-weight: bold;font-size: 16px">
                                <?php
//                                            echo number_format($resultat_credit, 3, '.', ' ');
                                ?>
                                        </td>
                                    </tr>


                                </tfoot>-->
                            </table>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>    
    <?php endif; ?>