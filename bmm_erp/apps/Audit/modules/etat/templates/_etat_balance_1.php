<div class="mws-panel-header">
    <span class="mws-i-24 i-table-1">Balance
        <div style="float:right; cursor:pointer; margin-top:-5px">
            <a target="_blank" class="btn" style="float: right; margin-right: 3%; cursor:pointer;" href="<?php echo url_for("@imprimeBalance?date_debut=". $date_debut ."&date_fin=".$date_fin."&compte_min=".$compte_min."&compte_max=".$compte_max."&order=".$order."&comptes_non_solde=".$comptes_non_solde."&chiffre_1=".$chiffre_1."&chiffre_2=".$chiffre_2."&chiffre_3=".$chiffre_3."&chiffre_4=".$chiffre_4."&chiffre_5=".$chiffre_5."&chiffre_6=".$chiffre_6."&chiffre_7=".$chiffre_7); ?>"><i class="icol-printer"></i> Imprimer</a>
        </div>
    </span>
</div>
<div class="mws-panel-body">
    <table id="listBalance" class="mws-datatable-fn mws-table">
        <thead>
            <tr style="border-bottom: 1px solid #000000">
                <th rowspan="2" >Compte</th>
                <th rowspan="2" >Libellé</th>
                <th colspan="2" >Mouvement mois - au -/-/-</th>
                <th colspan="2" >Mouvement période + ouverture</th>
                <th colspan="2" >Soldes</th>
            </tr>
            <tr style="border-bottom: 1px solid #000000">
                <th>Débit</th>
                <th>Crédit</th>
                <th>Débit</th>
                <th>Crédit</th>
                <th>Débiteur</th>
                <th>Créditeur</th>
               </tr>
            <tr style="border-bottom: 1px solid #000000" >
                <th style="width: 7%;"></th>
                <th style="width: 37%;">Report</th>
                <th style="width: 9%;"></th>
                <th style="width: 9%;"></th>
                <th style="width: 9%;"></th>
                <th style="width: 9%;"></th>
                <th style="width: 10%;"></th>
                <th style="width: 10%;"></th>
                
            </tr>

        </thead>

        <tbody>
          <?php // $balance = calculBalance::getBalance($etatBalance); ?>

            <?php
            $i = 0;
            $solde_classe = 0;
            $montantCreditMois =0;
            $montantDebitMois = 0;
            $montantCreditOuv =0;
            $montantDebitOuv = 0;
            $soldeCredit =0;
            $soldeDebit = 0;
            $solde_credit_classe_1_5 = 0;
            $solde_debit_classe_1_5 = 0;
            $solde_credit_classe_6 = 0;
            $solde_debit_classe_6 = 0;
            $solde_credit_classe_7 = 0;
            $solde_debit_classe_7 = 0;
            $solde_classe_1_5 = 0;
            $solde_classe_6 = 0;
            $solde_classe_7 = 0;
            ?>
            <?php foreach ($etatBalance as $fiche): ?>
            <?php $montantCreditMois =0;
            $montantDebitMois = 0;
            $montantCreditOuv =0;
            $montantDebitOuv = 0; 
            $soldeDebit = 0;
            $soldeCredit = 0;?>
            <?php if($fiche->getPlanComptable()->getCompteId() == null) {
                $lignegras = ' font-weight: bold;';
            } else {
                  $lignegras = '';  
            } ?>
           
                <tr style="cursor: pointer;<?php echo $lignegras; ?>" id="ligne_<?php echo $i ?>"  index_ligne="<?php echo $i ?>">

                    <td style="text-align: center;<?php echo $lignegras; ?>"><?php echo $fiche->getNumeroCompte() ?></td>
                    <td style="text-align: left; padding-left: 1%;<?php echo $lignegras; ?>"><?php echo $fiche->getLibelle() ?></td>
                    <td style="text-align: right;padding-right: 1%;<?php echo $lignegras; ?>">
                        
                            <?php if ($fiche->getLignePieceComptable()->count() != 0): ?>
                                <?php
//                                if ($fiche->getLignePieceComptable()->getFirst()->getMontantDebit() == 0) {
//                                    echo '';
//                                    $montantDebitMois = 0;
//                                }else {
//                                    echo number_format($fiche->getLignePieceComptable()->getFirst()->getMontantDebit(), 3, '.', ' ');
//                                    $montantDebitMois = $fiche->getLignePieceComptable()->getFirst()->getMontantDebit();
//                                } 
                                ?>
                            <?php else: ?>
                                <?php echo ''; ?>
                            <?php endif; ?>
                        
                        
                    </td>
                    <td style="text-align: right;padding-right: 1%;<?php echo $lignegras; ?>">
                    
                            <?php if ($fiche->getLignePieceComptable()->count() != 0): ?>
                                <?php
//                                if ($fiche->getLignePieceComptable()->getFirst()->getMontantCredit() == 0) {
//                                    echo '';
//                                    $montantCreditMois = 0;
//                                } else {
//                                    echo number_format($fiche->getLignePieceComptable()->getFirst()->getMontantCredit(), 3, '.', ' ');
//                                    $montantCreditMois = $fiche->getLignePieceComptable()->getFirst()->getMontantCredit();
//                                }  
                                ?>
                            <?php else: ?>
                                <?php echo ''; ?>
                            <?php endif; ?>
                        
                    </td>
                    <td style="text-align: right;padding-right: 1%;<?php echo $lignegras; ?>">
                         <?php if ($fiche->getLignePieceComptable()->count() != 0): ?>
                            
                                <?php
                                if ($fiche->getLignePieceComptable()->getFirst()->getMontantDebit() == 0) {
                                    echo '';
                                    $montantDebitOuv = 0;
                                $valideDebit = 0;
                               } else {
                                    echo number_format($fiche->getLignePieceComptable()->getFirst()->getMontantDebit(), 3, '.', ' ');
                                  $montantDebitOuv = $fiche->getLignePieceComptable()->getFirst()->getMontantDebit();
                                    $valideDebit = 1;
                                    
                               } ?>
                            <?php else: ?>
                                <?php echo '';  ?>
                            <?php endif; ?>
                        
                    </td>
                    <td style="text-align: right;padding-right: 1%;<?php echo $lignegras; ?>">
                    <?php if ($fiche->getLignePieceComptable()->count() != 0): ?>
                                <?php
                                if ($fiche->getLignePieceComptable()->getFirst()->getMontantCredit() == 0){
                                    echo '';
                                    $montantCreditOuv = 0;
                                    $valideCredit = 0;
                                } else {
                                    echo number_format($fiche->getLignePieceComptable()->getFirst()->getMontantCredit(), 3, '.', ' ');
                                    $montantCreditOuv = $fiche->getLignePieceComptable()->getFirst()->getMontantCredit();
                                    $valideCredit = 1;
                                    
                                }  ?>
                            <?php else: ?>
                                <?php echo ''; ?>
                            <?php endif; ?>
                      
                    </td>
                    <?php
                     
//                    $solde = solde::totalSolde($fiche->getNumeroCompte());
                    ?>
                    <td style="text-align: right;padding-right: 1%;<?php echo $lignegras; ?>">
                         <?php
                        if($valideDebit != 0)
                                $soldeDebit = $montantDebitOuv + $montantDebitMois ; 
                            if ($soldeDebit <= 0 || $valideDebit == 0 ) 
                                echo '';
                            else
                                echo number_format($soldeDebit, 3, '.', ' ');
                           
                               ?>
                        </td>
                    <td style="text-align: right;padding-right: 1%;<?php echo $lignegras; ?>">
                     <?php
                        if($valideCredit != 0) 
                            $soldeCredit = $montantCreditOuv + $montantCreditMois ; 
                            if ($soldeCredit <= 0 || $valideCredit == 0 )
                                echo '';
                            else
                                echo number_format($soldeCredit, 3, '.', ' ');
                              ?>
                       
                    </td>
                </tr>
                <?php
                if (($fiche->getPlanComptable()->getClasseId() >= 1 && $fiche->getPlanComptable()->getClasseId() <= 5 ) || ($fiche->getPlanComptable()->getNumeroCompte() >= 1 && $fiche->getPlanComptable()->getNumeroCompte() <= 5 )) {
                    $solde_debit_classe_1_5 += $soldeDebit;
                    $solde_credit_classe_1_5 += $soldeCredit;
                    $solde_classe_1_5 = 1;
                }
                if ($fiche->getPlanComptable()->getClasseId() == 6 || $fiche->getPlanComptable()->getNumeroCompte() == 6) {
                    $solde_debit_classe_6 += $soldeDebit;
                    $solde_credit_classe_6 += $soldeCredit;
                     $solde_classe_6 = 1;
                }
                if ($fiche->getPlanComptable()->getClasseId() == 7 || $fiche->getPlanComptable()->getNumeroCompte() == 7) {
                    $solde_debit_classe_7 += $soldeDebit;
                    $solde_credit_classe_7 += $soldeCredit;
                    $solde_classe_7 = 1;
                }

                ?>

                <?php $i++; ?>
            <?php endforeach; ?>
            <?php if ($solde_classe_1_5 != 0): ?>
                <tr style="cursor: pointer; font-weight: bold;" id="ligne_<?php echo $i ?>" index_ligne="<?php echo $i ?>">

                    <td colspan="6" style="text-align: center; font-weight: bold;">Total Classes ( 1 -> 5 )</td>

                    <td style="text-align: right;padding-right: 1%; font-weight: bold;">
                        <?php
//                            if ($solde_debit_classe_1_5 <= 0)
//                                echo '';
//                            else
                                echo number_format($solde_debit_classe_1_5, 3, '.', ' ');?>
                        </td> 
                      <td style="text-align: right;padding-right: 1%; font-weight: bold;">
                          <?php
//                            if ($solde_credit_classe_1_5 <= 0)
//                                echo '';
//                            else
                                echo number_format($solde_credit_classe_1_5, 3, '.', ' '); ?>
                        
                    </td>
                </tr>
            <?php endif; ?>
            <?php if ($solde_classe_6 != 0): ?>
                <tr style="cursor: pointer; font-weight: bold;" id="ligne_<?php echo $i ?>" onclick="//ajouterLigne(<?php echo $i; ?> , <?php echo $fiche->getPlanComptable()->getId() ?>)" index_ligne="<?php echo $i ?>">

                    <td colspan="6" style="text-align: center; font-weight: bold;">Total Classes ( 6 )</td>

                    <td style="text-align: right;padding-right: 1%; font-weight: bold;">
                         <?php
//                            if ($solde_debit_classe_6 <= 0)
//                                echo '';
//                            else
                                echo number_format($solde_debit_classe_6, 3, '.', ' '); ?>
                        </td> 
                      <td style="text-align: right;padding-right: 1%; font-weight: bold;">
                          <?php
//                            if ($solde_credit_classe_6 <= 0)
//                                echo '';
//                            else
                                echo number_format($solde_credit_classe_6, 3, '.', ' ');?>
                       
                    </td>
                </tr>
            <?php endif; ?>
            <?php if ($solde_classe_7 != 0): ?>
                <tr style="cursor: pointer; font-weight: bold;" id="ligne_<?php echo $i ?>" onclick="//ajouterLigne(<?php echo $i; ?> , <?php echo $fiche->getPlanComptable()->getId() ?>)" index_ligne="<?php echo $i ?>">

                    <td colspan="6" style="text-align: center; font-weight: bold;">Total Classes ( 7 )</td>

                    <td style="text-align: right;padding-right: 1%; font-weight: bold;">
                        <?php
//                            if ($solde_debit_classe_7 <= 0)
//                                echo '';
//                            else
                                echo number_format($solde_debit_classe_7, 3, '.', ' ');?>
                    </td>
                    <td style="text-align: right;padding-right: 1%; font-weight: bold;">
                        <?php
//                            if ($solde_credit_classe_7 <= 0)
//                                echo '';
//                            else
                                echo number_format($solde_credit_classe_7, 3, '.', ' '); ?>
                        
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td style="padding: 0px; " colspan="8">
                    <div style="background: none repeat scroll 0 0 #444444; width: 100%; float: left">
                        <div class="dataTables_paginate paging_full_numbers">


                        </div>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
    <div class="mws-panel-toolbar">
        <div class="btn-toolbar">
            <div class="btn-group" style="width: 100%;">
                <a target="_blank" class="btn" style="float: right; margin-right: 3%; cursor:pointer;" href="<?php echo url_for("@imprimeBalance?date_debut=". $date_debut ."&date_fin=".$date_fin."&compte_min=".$compte_min."&compte_max=".$compte_max."&order=".$order."&comptes_non_solde=".$comptes_non_solde."&chiffre_1=".$chiffre_1."&chiffre_2=".$chiffre_2."&chiffre_3=".$chiffre_3."&chiffre_4=".$chiffre_4."&chiffre_5=".$chiffre_5."&chiffre_6=".$chiffre_6."&chiffre_7=".$chiffre_7); ?>"><i class="icol-printer"></i> Imprimer</a>
           </div>
        </div>
    </div>

</div>

<script  type="text/javascript">
    var index_ligne;
    function ajouterLigne(index, compte) {
        formatLigne(index);
        $.ajax({
            url: '<?php echo url_for('@addLigneClasseCompte') ?>',
            async: true,
            data: 'compte=' + compte + '&date_debut=' + $('#date_debut').val() + '&date_fin=' + $('#date_fin').val() +
                    '&comptes_non_solde=' + $('#comptes_non_solde').is(':checked') +
                    '&chiffre_1=' + $('#chiffre_1').is(':checked') + '&chiffre_2=' + $('#chiffre_2').is(':checked') +
                    '&chiffre_3=' + $('#chiffre_3').is(':checked') + '&chiffre_4=' + $('#chiffre_4').is(':checked') +
                    '&chiffre_5=' + $('#chiffre_5').is(':checked') + '&chiffre_6=' + $('#chiffre_6').is(':checked') +
                    '&chiffre_7=' + $('#chiffre_7').is(':checked'),
            success: function(data) {
//                    if (count_ligne > 0) {

                $('#listBalance > tbody > tr').eq(index).before(data);
                ligneNumber();
                index_ligne++;
                index = index + 1;

                $('#ligne_' + index).attr('onclick', '');


//                    } else {
//                        $('#liste_ligne tbody').append(data);
//                        index_ligne = 0;
//                    }
//                    $('#numero_externe').attr('readonly', 'readonly');
//                    $('#reference').attr('readonly', 'readonly');
            }
        });

    }

    function formatLigne(index) {
        $('#listBalance tbody tr').each(function() {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });
        $('#ligne_' + index).css('background', 'repeat-x scroll left bottom #d8d6d6');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
        index_ligne = $('#ligne_' + index).attr('index_ligne');
    }

    function ligneNumber() {
        var i = 0;
        $('#listBalance tbody tr').each(function() {
            var id = 'ligne_' + i;
            $(this).attr('id', id);
            $(this).attr('index_ligne', i);
//            var format = 'formatLigne("' + i + '")';
//            $(this).attr('onclick', format);
            i++;
        });
    }

</script>