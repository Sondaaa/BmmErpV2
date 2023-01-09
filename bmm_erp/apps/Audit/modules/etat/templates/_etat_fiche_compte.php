<?php
$first_fiche = $etatFicheCompte->getFirst();
$totalcredit = 0;
$totaldebit = 0;
$solde = 0;
$index = 0;
$fermeture = 1;
?>

<?php
$url = '';
if ($compte_min != '')
    $url.= '&compte_min=' . trim($compte_min);
if ($compte_max != '')
    $url.= '&compte_max=' . trim($compte_max);
if ($date_debut != '')
    $url.= '&date_debut=' . $date_debut;
if ($date_fin != '')
    $url.= '&date_fin=' . $date_fin;
if ($crediteur != '')
    $url.= '&crediteur=' . $crediteur;
if ($debiteur != '')
    $url.= '&debiteur=' . $debiteur;
if ($solde != '')
    $url.= '&solde=' . $solde;

if ($url != '')
    $url = substr($url, 1);
?>

<?php if ($etatFicheCompte->count() != 0): ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="table-header" style="margin-bottom: 0px;">
                Comptes Comptables :
                <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" href="<?php echo url_for("etat/imprimeEtatFiche?" . $url); ?>">
                    <i class="ace-icon fa fa-print bigger-110"></i>
                    <span class="bigger-110 no-text-shadow">Imprimer Tout</span>
                </a>
                <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px; margin-right: 1%;" href="<?php echo url_for("etat/imprimeEtatFicheNonVide?" . $url); ?>">
                    <i class="ace-icon fa fa-print bigger-110"></i>
                    <span class="bigger-110 no-text-shadow">Imprimer Tout Sauf Vides</span>
                </a>
            </div>
            <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;">
                <?php for ($j = 0; $j < count($comptes); $j++): ?>
                    <?php if ($comptes[$j]['numero'] == $first_fiche->getPlandossiercomptable()->getNumerocompte()): ?>
                        <?php break; ?>
                    <?php else: ?>
                        <div class="table-header" style="color: #855D10 !important; border-color: #E8B10D; background: #FFDD9C;">
                            Fiche Compte Comptable : <?php echo $comptes[$j]['numero'] . ' - ' . $comptes[$j]['libelle']; ?>
                        </div>
                        <div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Date</th>
                                        <th style="text-align: left;">Journal</th>
                                        <th style="width: 10%;">Nature Pièce</th>
                                        <th style="width: 10%;">N° Pièce</th>
                                        <th style="width: 10%;">N° Externe</th>
                                        <th style="width: 10%;">Libellé</th>
                                        <th style="width: 5%;">Contre Partie</th>   
                                        <th style="width: 2%;">Lettre</th> 
                                        <th style="width: 10%;">Débit</th> 

                                        <th style="width: 10%;">Crédit</th>
                                        <th style="width: 10%;">Solde</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="11">Pas de pièces comptables</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php $index++; ?>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php foreach ($etatFicheCompte as $fiche): ?>
                    <?php if ($fermeture == 1): ?>
                        <div class="table-header" style="background: #82AF6F; border-color: #82AF6F;">
                            <?php
                            $url_compte = '';
                            $url_compte.= 'id=' . $fiche->getPlandossiercomptable()->getId();
                            if ($date_debut != '')
                                $url_compte.= '&date_debut=' . $date_debut;
                            if ($date_fin != '')
                                $url_compte.= '&date_fin=' . $date_fin;
                            ?>
                            Fiche Compte Comptable : <?php echo $fiche->getPlandossiercomptable()->getNumerocompte() . ' - ' . $fiche->getPlandossiercomptable()->getLibelle() ?>
                            <a target="_blank" class="btn btn-sm btn-primary" style="float: right; padding: 5px 12px;" href="<?php echo url_for("etat/imprimeEtatFicheOne?" . $url_compte); ?>">
                                <i class="ace-icon fa fa-print bigger-110"></i>
                                <span class="bigger-110 no-text-shadow">Imprimer</span>
                            </a>
                        </div>
                        <div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Date</th>
                                        <th style="text-align: left;">Journal</th>
                                        <th style="width: 10%;">Nature Pièce</th>
                                        <th style="width: 10%;">N° Pièce</th>
                                        <th style="width: 10%;">N° Externe</th>
                                        <th style="width: 10%;">Libellé</th>
                                        <th style="width: 5%;">Contre Partie</th> 
                                        <th style="width: 2%;">Lettre</th> 
                                        <th style="width: 10%;">Débit</th> 

                                        <th style="width: 10%;">Crédit</th>
                                        <th style="width: 10%;">Solde</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $fermeture = 0; ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($fiche->getPiececomptable()->getDate())) ?></td>
                                        <td style="text-align: left;"><?php echo $fiche->getPiececomptable()->getJournalcomptable()->getLibelle() ?></td>
                                        <td style="text-align: center;"><?php echo $fiche->getNaturepiece()->getLibelle() ?></td>
                                        <td style="text-align: center;">
                                            <a style="cursor: pointer;" target="_blank" title="Imprimer" href="<?php echo url_for('saisie_pieces/imprimePiece?id=' . $fiche->getPiececomptable()->getId()) ?>">
                                                <?php echo $fiche->getPiececomptable()->getNumero() ?>
                                            </a>
                                        </td>
                                        <td style="text-align: center;"><?php echo $fiche->getNumeroexterne() ?></td>
                                        <td style="text-align: center;"><?php echo $fiche->getPiececomptable()->getLibelle() ?></td>
                                        <td style="text-align: center;"><?php echo $fiche->getPlandossiercomptablecontre()->getNumerocompte() ?></td>
                                        <td style="text-align: center;"><?php echo $fiche->getLettrelettrage() ?></td>
                                        <td style="text-align: right;">
                                            <?php
                                            if ($fiche->getMontantdebit() != 0)
                                                echo $fiche->getMontantdebit()
                                                ?>
                                        </td>

                                        <td style="text-align: right;">
                                            <?php
                                            if ($fiche->getMontantcredit() != 0)
                                                echo $fiche->getMontantcredit()
                                                ?>
                                        </td>
                                        <td style="text-align: right;"><?php echo number_format($fiche->getMontantdebit() - $fiche->getMontantcredit(), 3, '.', ' ') ?></td>
                                    </tr>
                                    <?php $totalcredit += $fiche->getMontantcredit(); ?>
                                    <?php $totaldebit += $fiche->getMontantdebit(); ?>
                                    <?php $solde = $totaldebit - $totalcredit; ?>
                                    <?php $index++; ?>
                                <?php else: ?>
                                    <?php $index--; ?>
                                    <?php if ($comptes[$index]['numero'] == $fiche->getPlandossiercomptable()->getNumerocompte()): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($fiche->getPiececomptable()->getDate())) ?></td>
                                            <td style="text-align: left;"><?php echo $fiche->getPiececomptable()->getJournalcomptable()->getLibelle() ?></td>
                                            <td style="text-align: center;"><?php echo $fiche->getNaturepiece()->getLibelle() ?></td>
                                            <td style="text-align: center;">
                                                <a style="cursor: pointer;" target="_blank" title="Imprimer" href="<?php echo url_for('saisie_pieces/imprimePiece?id=' . $fiche->getPiececomptable()->getId()) ?>">
                                                    <?php echo $fiche->getPiececomptable()->getNumero() ?>
                                                </a>
                                            </td>
                                            <td style="text-align: center;"><?php echo $fiche->getNumeroexterne() ?></td>
                                            <td style="text-align: center;"><?php echo $fiche->getPiececomptable()->getLibelle() ?></td>
                                            <td style="text-align: left;"><?php echo $fiche->getPlandossiercomptablecontre()->getLibelle() ?></td>
                                            <td style="text-align: center;"><?php echo $fiche->getLettrelettrage() ?></td>

                                            <td style="text-align: right;">
                                                <?php
                                                if ($fiche->getMontantdebit() != 0)
                                                    echo $fiche->getMontantdebit()
                                                    ?>
                                            </td>
                                            <td style="text-align: right;">
                                                <?php
                                                if ($fiche->getMontantcredit() != 0)
                                                    echo $fiche->getMontantcredit()
                                                    ?>
                                            </td>
                                            <td style="text-align: right;"><?php echo number_format($fiche->getMontantdebit() - $fiche->getMontantcredit(), 3, '.', ' ') ?></td>
                                        </tr>
                                        <?php $totalcredit += $fiche->getMontantcredit(); ?>
                                        <?php $totaldebit += $fiche->getMontantdebit(); ?>
                                        <?php $solde = $totaldebit - $totalcredit; ?>
                                        <?php $index++; ?>
                                    <?php else: ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" style="font-weight: bold">&nbsp;</td>
                                            <td style="font-weight: bold; text-align: center; background-color: #ECECEC;" colspan="3">Total</td>
                                            <td style="font-weight: bold; text-align: right;">
                                                <?php
                                                if ($totaldebit != 0)
                                                    echo number_format($totaldebit, 3, '.', ' ');
                                                ?>
                                            </td>
                                         
                                            <td style="font-weight: bold; text-align: right;">
                                                <?php
                                                if ($totalcredit != 0)
                                                    echo number_format($totalcredit, 3, '.', ' ');
                                                ?>
                                            </td>
                                            <td style="font-weight: bold; text-align: right;">
                                                <?php
                                                if ($solde != 0)
                                                    echo number_format($solde, 3, '.', ' ');
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $totalcredit = 0;
                                        $totaldebit = 0;
                                        $solde = 0;
                                        ?>
                                    </tfoot>
                                </table>
                            </div>
                            <?php $fermeture = 1; ?>
                            <?php $index++; ?>
                            <?php for ($j = $index; $j < count($comptes); $j++): ?>
                                <?php if ($fermeture == 0): ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" style="font-weight: bold">&nbsp;</td>
                                            <td style="font-weight: bold; text-align: center; background-color: #ECECEC;" colspan="3">Total</td>
                                            <td style="font-weight: bold; text-align: right;">
                                                <?php
                                                if ($totaldebit != 0)
                                                    echo number_format($totaldebit, 3, '.', ' ');
                                                ?>
                                            </td>
                                            <td></td>
                                            <td style="font-weight: bold; text-align: right;">
                                                <?php
                                                if ($totalcredit != 0)
                                                    echo number_format($totalcredit, 3, '.', ' ');
                                                ?>
                                            </td>
                                            <td style="font-weight: bold; text-align: right;">
                                                <?php
                                                if ($solde != 0)
                                                    echo number_format($solde, 3, '.', ' ');
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $totalcredit = 0;
                                        $totaldebit = 0;
                                        $solde = 0;
                                        ?>
                                    </tfoot>
                                    </table>
                                </div>
                                <?php $fermeture = 1; ?>
                            <?php endif; ?>
                            <?php if ($comptes[$j]['numero'] == $fiche->getPlandossiercomptable()->getNumerocompte()): ?>
                                <div class="table-header" style="background: #82AF6F; border-color: #82AF6F;">
                                    <?php
                                    $url_compte = '';
                                    $url_compte.= 'id=' . $fiche->getPlandossiercomptable()->getId();
                                    if ($date_debut != '')
                                        $url_compte.= '&date_debut=' . $date_debut;
                                    if ($date_fin != '')
                                        $url_compte.= '&date_fin=' . $date_fin;
                                    ?>
                                    Fiche Compte Comptable : <?php echo $fiche->getPlandossiercomptable()->getNumerocompte() . ' - ' . $fiche->getPlandossiercomptable()->getLibelle() ?>
                                    <a target="_blank" class="btn btn-sm btn-primary" style="float: right; padding: 5px 12px;" href="<?php echo url_for("etat/imprimeEtatFicheOne?" . $url_compte); ?>">
                                        <i class="ace-icon fa fa-print bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                                    </a>
                                </div>
                                <div>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 10%;">Date</th>
                                                <th style="text-align: left;">Journal</th>
                                                <th style="width: 10%;">Nature Pièce</th>
                                                <th style="width: 10%;">N° Pièce</th>
                                                <th style="width: 10%;">N° Externe</th>
                                                <th style="width: 10%;">Libellé</th>
                                                <th style="width: 5%;">Contre Partie</th>    
                                                <th style="width: 2%;">Lettre</th> 
                                                <th style="width: 10%;">Débit</th> 

                                                <th style="width: 10%;">Crédit</th>
                                                <th style="width: 10%;">Solde</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $fermeture = 0; ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($fiche->getPiececomptable()->getDate())) ?></td>
                                                <td style="text-align: left;;"><?php echo $fiche->getPiececomptable()->getJournalcomptable()->getLibelle() ?></td>
                                                <td style="text-align: center;"><?php echo $fiche->getNaturepiece()->getLibelle() ?></td>
                                                <td style="text-align: center;">
                                                    <a style="cursor: pointer;" target="_blank" title="Imprimer" href="<?php echo url_for('saisie_pieces/imprimePiece?id=' . $fiche->getPiececomptable()->getId()) ?>">
                                                        <?php echo $fiche->getPiececomptable()->getNumero() ?>
                                                    </a>
                                                </td>
                                                <td style="text-align: center;"><?php echo $fiche->getNumeroexterne() ?></td>
                                                <td style="text-align: center;"><?php echo $fiche->getPiececomptable()->getLibelle() ?></td>
                                                <td style="text-align: center;"><?php echo $fiche->getPlandossiercomptablecontre()->getNumerocompte() ?></td>
                                                <td style="text-align: center;"><?php echo $fiche->getLettrelettrage() ?></td>
                                                <td style="text-align: right;">
                                                    <?php
                                                    if ($fiche->getMontantdebit() != 0)
                                                        echo $fiche->getMontantdebit()
                                                        ?>
                                                </td>

                                                <td style="text-align: right;">
                                                    <?php
                                                    if ($fiche->getMontantcredit() != 0)
                                                        echo $fiche->getMontantcredit()
                                                        ?>
                                                </td>
                                                <td style="text-align: right;"><?php echo number_format($fiche->getMontantdebit() - $fiche->getMontantcredit(), 3, '.', ' ') ?></td>
                                            </tr>
                                            <?php $totalcredit += $fiche->getMontantcredit(); ?>
                                            <?php $totaldebit += $fiche->getMontantdebit(); ?>
                                            <?php $solde = $totaldebit - $totalcredit; ?>
                                            <?php $index++; ?>
                                            <?php break; ?>
                                        <?php else: ?>
                                            <?php if ($fermeture == 0): ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" style="font-weight: bold">&nbsp;</td>
                                                    <td style="font-weight: bold; text-align: center; background-color: #ECECEC;" colspan="3">Total</td>
                                                    <td style="font-weight: bold; text-align: right;">
                                                        <?php
                                                        if ($totaldebit != 0)
                                                            echo number_format($totaldebit, 3, '.', ' ');
                                                        ?>
                                                    </td>
                                                   
                                                    <td style="font-weight: bold; text-align: right;">
                                                        <?php
                                                        if ($totalcredit != 0)
                                                            echo number_format($totalcredit, 3, '.', ' ');
                                                        ?>
                                                    </td>
                                                    <td style="font-weight: bold; text-align: right;">
                                                        <?php
                                                        if ($solde != 0)
                                                            echo number_format($solde, 3, '.', ' ');
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $totalcredit = 0;
                                                $totaldebit = 0;
                                                $solde = 0;
                                                ?>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <?php $fermeture = 1; ?>
                                <?php endif; ?>
                                <div class="table-header" style="color: #855D10 !important; border-color: #E8B10D; background: #FFDD9C;">
                                    Fiche Compte Comptable : <?php echo $comptes[$j]['numero'] . ' - ' . $comptes[$j]['libelle']; ?>
                                </div>
                                <div>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 10%;">Date</th>
                                                <th style="text-align: left;">Journal</th>
                                                <th style="width: 10%;">Nature Pièce</th>
                                                <th style="width: 10%;">N° Pièce</th>
                                                <th style="width: 10%;">N° Externe</th>
                                                <th style="width: 10%;">Libellé</th>
                                                <th style="width: 5%;">Contre partie</th> 
                                                <th style="width: 2%;">Lettre</th> 
                                                <th style="width: 10%;">Débit</th> 

                                                <th style="width: 10%;">Crédit</th>
                                                <th style="width: 10%;">Solde</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="11">Pas de pièces comptables</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?php $index++; ?>
                            <?php endif; ?>
                        <?php endfor; ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if ($fermeture == 0): ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="font-weight: bold">&nbsp;</td>
                        <td style="font-weight: bold; text-align: center; background-color: #ECECEC;" colspan="3">Total</td>
                        <td style="font-weight: bold; text-align: right;">
                            <?php
                            if ($totaldebit != 0)
                                echo number_format($totaldebit, 3, '.', ' ');
                            ?>
                        </td>
                       
                        <td style="font-weight: bold; text-align: right;">
                            <?php
                            if ($totalcredit != 0)
                                echo number_format($totalcredit, 3, '.', ' ');
                            ?>
                        </td>
                        <td style="font-weight: bold; text-align: right;">
                            <?php
                            if ($solde != 0)
                                echo number_format($solde, 3, '.', ' ');
                            ?>
                        </td>
                    </tr>
                    <?php
                    $totalcredit = 0;
                    $totaldebit = 0;
                    $solde = 0;
                    ?>
                </tfoot>
                </table>
            </div>
            <?php $fermeture = 1; ?>
        <?php endif; ?>              
    <?php else: ?>
        <?php for ($j = 0; $j < count($comptes); $j++): ?>
            <?php $index++; ?>
            <div class="table-header" style="background: #82AF6F; border-color: #82AF6F;">
                Fiche Compte Comptable : <?php echo $comptes[$j]['numero'] . ' - ' . $comptes[$j]['libelle']; ?>
            </div>
            <div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Date</th>
                            <th style="text-align: left;">Journal</th>
                            <th style="width: 10%;">Nature Pièce</th>
                            <th style="width: 10%;">N° Pièce</th>
                            <th style="width: 10%;">N° Externe</th>
                            <th style="width: 10%;">Libellé</th>
                            <th style="width: 5%;">Contre Partie</th>  
                            <th style="width: 2%;">Lettre</th> 
                            <th style="width: 10%;">Débit</th> 

                            <th style="width: 10%;">Crédit</th>
                            <th style="width: 10%;">Solde</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="11">Pas de pièces comptables</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endfor; ?>
    <?php endif; ?>

    <?php for ($j = $index; $j < count($comptes); $j++): ?>
        <div class="table-header" style="color: #855D10 !important; border-color: #E8B10D; background: #FFDD9C;">
            Fiche Compte Comptable : <?php echo $comptes[$j]['numero'] . ' - ' . $comptes[$j]['libelle']; ?>
        </div>
        <div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 10%;">Date</th>
                        <th style="text-align: left;">Journal</th>
                        <th style="width: 10%;">Nature Pièce</th>
                        <th style="width: 10%;">N° Pièce</th>
                        <th style="width: 10%;">N° Externe</th>
                        <th style="width: 10%;">Libellé</th>
                        <th style="width: 5%;">Contre Partie</th>  
                        <th style="width: 2%;">Lettre</th> 
                        <th style="width: 10%;">Débit</th> 

                        <th style="width: 10%;">Crédit</th>
                        <th style="width: 10%;">Solde</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="11">Pas de pièces comptables</td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endfor; ?>
</div>
</div>
</div>