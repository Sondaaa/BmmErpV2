<div class="mws-panel grid_8" >
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline" style="min-height: 250px;">
                <table id="liste_ligne" style="font-weight: bold;">
                    <thead>
                        <tr>
                            <th style="width: 40%;">CAPITAUX PROPRES ET PASSIFS</th>
                            <th style="width: 20%; text-align: center;">Notes</th>
                            <th style="width: 20%; text-align: center;">31/12/<?php echo $_SESSION['exercice']; ?></th>
                            <th style="width: 20%; text-align: center;">31/12/<?php echo $_SESSION['exercice'] - 1; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding-left: 2%;" colspan="4">CAPITAUX PROPRES ET PASSIFS</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;" colspan="4">Capitaux propres</td>

                        </tr>
                        <tr>
                            <?php if ($_SESSION['dossier_id'] == 1): ?>
                                <td style="padding-left: 6%;">Subventions d'investissements amortissables</td>
                            <?php else: ?>
                                <td style="padding-left: 6%;">Capital social</td>
                            <?php endif; ?>         

                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_1">
                                <?php if ($passif[1][0]['param_id'] != ''): ?>
                                    <?php
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[1][0]['param_id']);
                                    $compte_numero = '';
                                    foreach ($params as $param_compte):
                                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        if ($param_compte->getType() == 1)
                                            $numero = '<b>' . $numero . '</b>';
                                        if ($compte_numero == '') {
                                            $compte_numero = $numero;
                                        } else {
                                            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        }
                                    endforeach;
                                    ?>
                                    <span class="btn btn-info btn-sm popover-info" data-rel="popover" data-placement="bottom" title="Comptes Comptables (Numéro) :" data-content="<?php echo $compte_numero; ?>">Comptes Comptables</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ((-$passif[1][0]['solde_courant']) >= 0):
                                    echo number_format((-$passif[1][0]['solde_courant']), 3, '.', ' ');
                                elseif ($passif[1][0]['solde_courant'] < 0):
                                    echo '(' . number_format(abs(-$passif[0]['solde_courant']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if (-$passif[0][0]['solde_prec'] >= 0):
                                    echo number_format(-$passif[0][0]['solde_prec'], 3, '.', ' ');
                                elseif (-$passif[0][0]['solde_prec'] < 0):
                                    echo '(' . number_format(abs(-$passif[0][0]['solde_prec']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;"> Subventions d'investissements non amortissables</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_1">
                                <?php if ($passif[1][1]['param_id'] != ''): ?>
                                    <?php
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[1][1]['param_id']);
                                    $compte_numero = '';
                                    foreach ($params as $param_compte):
                                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        if ($param_compte->getType() == 1)
                                            $numero = '<b>' . $numero . '</b>';
                                        if ($compte_numero == '') {
                                            $compte_numero = $numero;
                                        } else {
                                            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        }
                                    endforeach;
                                    ?>
                                    <span class="btn btn-info btn-sm popover-info" data-rel="popover" data-placement="bottom" title="Comptes Comptables (Numéro) :" data-content="<?php echo $compte_numero; ?>">Comptes Comptables</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if (-$passif[1][1]['solde_courant'] >= 0):
                                    echo number_format(-$passif[1][1]['solde_courant'], 3, '.', ' ');
                                elseif (-$passif[1][1]['solde_courant'] < 0):
                                    echo '(' . number_format(abs(-$passif[1][1]['solde_courant']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if (-$passif[0][1]['solde_prec'] >= 0):
                                    echo number_format(-$passif[0][1]['solde_prec'], 3, '.', ' ');
                                elseif (-$passif[0][1]['solde_prec'] < 0):
                                    echo '(' . number_format(abs(-$passif[0][1]['solde_prec']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Subvention à affecter</td>

                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_1">
                                <?php if ($passif[1][2]['param_id'] != ''): ?>
                                    <?php
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[1][2]['param_id']);
                                    $compte_numero = '';
                                    foreach ($params as $param_compte):
                                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        if ($param_compte->getType() == 1)
                                            $numero = '<b>' . $numero . '</b>';
                                        if ($compte_numero == '') {
                                            $compte_numero = $numero;
                                        } else {
                                            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        }
                                    endforeach;
                                    ?>
                                    <span class="btn btn-info btn-sm popover-info" data-rel="popover" data-placement="bottom" title="Comptes Comptables (Numéro) :" data-content="<?php echo $compte_numero; ?>">Comptes Comptables</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if (-$passif[1][2]['solde_courant'] >= 0):
                                    echo number_format(-$passif[1][2]['solde_courant'], 3, '.', ' ');
                                elseif (-$passif[1][2]['solde_courant'] < 0):
                                    echo '(' . number_format(abs(-$passif[1][2]['solde_courant']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if (-$passif[0][2]['solde_prec'] >= 0):
                                    echo number_format(-$passif[0][2]['solde_prec'], 3, '.', ' ');
                                elseif (-$passif[0][2]['solde_prec'] < 0):
                                    echo '(' . number_format(abs(-$passif[0][2]['solde_prec']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left: 4%;">Total capitaux propres avant résultat</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;">
                                <?php
                                $total_avant_courant = -$passif[1][0]['solde_courant'] - $passif[1][1]['solde_courant'] + abs($passif[1][2]['solde_courant']);
                                if ($total_avant_courant >= 0):
                                    echo number_format($total_avant_courant, 3, '.', ' ');
                                elseif ($total_avant_courant < 0):
                                    echo '(' . number_format(abs($total_avant_courant), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_avant_prec = -$passif[0][0]['solde_prec'] - $passif[0][1]['solde_prec'] + abs($passif[0][2]['solde_prec']);
                                if ($total_avant_prec >= 0):
                                    echo number_format($total_avant_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_avant_prec), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Résultat de l'exercice</td>


                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_1">
                                <?php if ($passif[1][3]['param_id'] != ''): ?>
                                    <?php
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[1][3]['param_id']);
                                    $compte_numero = '';
                                    foreach ($params as $param_compte):
                                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        if ($param_compte->getType() == 1)
                                            $numero = '<b>' . $numero . '</b>';
                                        if ($compte_numero == '') {
                                            $compte_numero = $numero;
                                        } else {
                                            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        }
                                    endforeach;
                                    ?>
                                    <span class="btn btn-info btn-sm popover-info" data-rel="popover" data-placement="bottom" title="Comptes Comptables (Numéro) :" data-content="<?php echo $compte_numero; ?>">Comptes Comptables</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if (-$passif[1][3]['solde_courant'] >= 0):
                                    echo number_format(-$passif[1][3]['solde_courant'], 3, '.', ' ');
                                elseif (-$passif[1][3]['solde_courant'] < 0):
                                    echo '(' . number_format(abs(-$passif[1][3]['solde_courant']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if (-$passif[0][3]['solde_prec'] >= 0):
                                    echo number_format(-$passif[0][3]['solde_prec'], 3, '.', ' ');
                                elseif (-$passif[0][3]['solde_prec'] < 0):
                                    echo '(' . number_format(abs(-$passif[0][3]['solde_prec']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;">TOTAL CAPITAUX PROPRES</td>
                            <td style="text-align: center;">4-1</td>
                            <td style="text-align: center;">
                                <?php
                                $total_propre_courant = ($total_avant_courant + $passif[1][3]['solde_courant']);
                                if ($total_propre_courant >= 0):
                                    echo number_format($total_propre_courant, 3, '.', ' ');
                                elseif ($total_propre_courant < 0):
                                    echo '(' . number_format(abs($total_propre_courant), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_propre_prec = ($total_avant_prec + $passif[0][3]['solde_prec']);
                                if ($total_propre_prec >= 0):
                                    echo number_format($total_propre_prec, 3, '.', ' ');
                                else:
                                    echo '(' . number_format(abs($total_propre_prec), 3, '.', ' ' ).')';
                                endif;
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left: 2%;" colspan="4">PASSIFS</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;" colspan="4">Passifs non courants</td>
                        </tr>

                        <tr>
                            <td style="padding-left: 6%;">Provisions</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_1">
                                <?php if ($passif[1][4]['param_id'] != ''): ?>
                                    <?php
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[1][4]['param_id']);
                                    $compte_numero = '';
                                    foreach ($params as $param_compte):
                                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        if ($param_compte->getType() == 1)
                                            $numero = '<b>' . $numero . '</b>';
                                        if ($compte_numero == '') {
                                            $compte_numero = $numero;
                                        } else {
                                            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        }
                                    endforeach;
                                    ?>
                                    <span class="btn btn-info btn-sm popover-info" data-rel="popover" data-placement="bottom" title="Comptes Comptables (Numéro) :" data-content="<?php echo $compte_numero; ?>">Comptes Comptables</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if (-$passif[1][4]['solde_courant'] >= 0):
                                    echo number_format(-$passif[1][4]['solde_courant'], 3, '.', ' ');
                                elseif (-$passif[1][4]['solde_courant'] < 0):
                                    echo '(' . number_format(abs(-$passif[1][4]['solde_courant']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if (-$passif[0][4]['solde_prec'] >= 0):
                                    echo number_format(-$passif[0][4]['solde_prec'], 3, '.', ' ');
                                elseif (-$passif[0][4]['solde_prec'] < 0):
                                    echo '(' . number_format(abs(-$passif[0][4]['solde_prec']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Total passifs non courants</td>
                            <td style="text-align: center;">4-2</td>
                            <td style="text-align: center;">
                                <?php
                                $total_non_courant_courant = -$passif[1][4]['solde_courant'];
                                if ($total_non_courant_courant >= 0):
                                    echo number_format($total_non_courant_courant, 3, '.', ' ');
                                else:
                                    echo '(' . number_format(abs($total_non_courant_courant), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_non_courant_prec = -$passif[0][4]['solde_prec'];
                                if ($total_non_courant_prec >= 0):
                                    echo number_format($total_non_courant_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_non_courant_prec, 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>


                        <tr>
                            <td style="padding-left: 4%;" colspan="4">Passifs courants</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Fournisseurs et comptes rattachés</td>
                            <td style="text-align: center;">
                                <input value="4-3" type="hidden" name="note_1">
                                <?php if ($passif[1][5]['param_id'] != ''): ?>
                                    <?php
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[1][5]['param_id']);
                                    $compte_numero = '';
                                    foreach ($params as $param_compte):
                                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        if ($param_compte->getType() == 1)
                                            $numero = '<b>' . $numero . '</b>';
                                        if ($compte_numero == '') {
                                            $compte_numero = $numero;
                                        } else {
                                            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        }
                                    endforeach;
                                    ?>
                                    <span class="btn btn-info btn-sm popover-info" data-rel="popover" data-placement="bottom" title="Comptes Comptables (Numéro) :" data-content="<?php echo $compte_numero; ?>">Comptes Comptables</span>
                                <?php endif; ?>
                                <br>4-3
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if (-$passif[1][5]['solde_courant'] >= 0):
                                    echo number_format(-$passif[1][5]['solde_courant'], 3, '.', ' ');
                                elseif (-$passif[1][5]['solde_courant'] < 0):
                                    echo '(' . number_format(abs(-$passif[1][5]['solde_courant']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if (-$passif[0][5]['solde_prec'] >= 0):
                                    echo number_format(-$passif[0][5]['solde_prec'], 3, '.', ' ');
                                elseif (-$passif[0][5]['solde_prec'] < 0):
                                    echo number_format(-$passif[0][5]['solde_prec'], 3, '.', ' ');

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Autres passifs Courants</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_1">
                                <?php if ($passif[1][6]['param_id'] != ''): ?>
                                    <?php
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[1][6]['param_id']);
                                    $compte_numero = '';
                                    foreach ($params as $param_compte):
                                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        if ($param_compte->getType() == 1)
                                            $numero = '<b>' . $numero . '</b>';
                                        if ($compte_numero == '') {
                                            $compte_numero = $numero;
                                        } else {
                                            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        }
                                    endforeach;
                                    ?>
                                    <span class="btn btn-info btn-sm popover-info" data-rel="popover" data-placement="bottom" title="Comptes Comptables (Numéro) :" data-content="<?php echo $compte_numero; ?>">Comptes Comptables</span>
                                <?php endif; ?>
                                <br>4-4
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if (-$passif[1][6]['solde_courant'] >= 0):
                                    echo number_format(-$passif[1][6]['solde_courant'], 3, '.', ' ');
                                elseif (-$passif[1][6]['solde_courant'] < 0):
                                    echo '(' . number_format(abs(-$passif[1][6]['solde_courant']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if (-$passif[0][6]['solde_prec'] >= 0):
                                    echo number_format(-$passif[0][6]['solde_prec'], 3, '.', ' ');
                                elseif (-$passif[0][6]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($passif[0][6]['solde_prec']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Total passifs courants</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;">
                                <?php
                                $total_courant_courant = -($passif[1][5]['solde_courant'] + $passif[1][6]['solde_courant']);
                                if ($total_courant_courant >= 0):
                                    echo number_format($total_courant_courant, 3, '.', ' ');
                                else:
                                    echo '(' . number_format(abs($total_courant_courant), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_courant_prec = -($passif[0][5]['solde_prec'] + $passif[0][6]['solde_prec']);
                                if ($total_courant_prec >= 0):
                                    echo number_format($total_courant_prec, 3, '.', ' ');
                                else:
                                    echo '(' . number_format(abs($total_courant_prec), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>

                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;" colspan="2">TOTAL DES PASSIFS</td>
                            <td style="text-align: center;">
                                <?php
                                $total_passif_courant = ($total_courant_courant + $total_non_courant_courant);
                                if ($total_passif_courant >= 0):
                                    echo number_format($total_passif_courant, 3, '.', ' ');
                                else:
                                    echo '(' . number_format(abs($total_passif_courant), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_passif_prec = ($total_courant_prec + $total_non_courant_prec);
                                if ($total_passif_prec >= 0):
                                    echo number_format($total_passif_prec, 3, '.', ' ');
                                else:
                                    echo '(' . number_format(abs($total_passif_prec), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;" colspan="2">TOTAL DES CAPITAUX PROPRES ET PASSIFS</td>
                            <td style="text-align: center;">

                                <?php
                                $total_courant = -(-$total_passif_courant - $total_propre_courant);
                                if ($total_courant >= 0):
                                    echo number_format($total_courant, 3, '.', ' ');
                                else:
                                    echo '(' . number_format(abs($total_courant), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_prec = -(-$total_passif_prec + $total_propre_prec);
                                if ($total_prec >= 0):
                                    echo number_format($total_prec, 3, '.', ' ');
                                else:
                                    echo '(' . number_format(abs($total_prec), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                        </tr>
                         <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;" colspan="2">Contrôle Total Bilan </td>
                            <td style="text-align: center;">
                                <input  class="align_center" type="text" id="controle_courant" readonly="true">
                            </td>
                            <td style="text-align: center;">
                                <input  class="align_center" type="text" id="controle_prec" readonly="true">
                            </td>
                        </tr>
                  
                    </tbody>
                </table>
                <input type="hidden" value="<?php echo  $total_courant  ; ?>" id="total_courant_passif">
                <input type="hidden" value="<?php echo $total_prec ; ?>" id="total_prec_passif">
            
                <table style="margin-bottom: 0px;"><tr><td><a class="btn btn-primary" href="<?php echo url_for('fiche_Bilan/imprimerBilan?type=1'); ?>" target="_blank" style="float: right;"><i class="ace-icon fa fa-print"></i> Imprimer </a></td></tr></table>
            </div>
        </form>
    </div>
</div>
<style>
    
    .align_center{text-align: center;}
    
</style>