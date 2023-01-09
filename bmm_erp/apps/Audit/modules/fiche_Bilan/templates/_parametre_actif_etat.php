<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline" style="min-height: 250px;">
                <table id="liste_ligne" style="font-weight: bold;">
                    <thead>
                        <tr>
                            <th style="width: 40%;">ACTIFS</th>
                            <th style="width: 20%; text-align: center;">Notes</th>
                            <th style="width: 20%; text-align: center;">31/12/<?php echo $_SESSION['exercice']; ?></th>
                            <th style="width: 20%; text-align: center;">31/12/<?php echo $_SESSION['exercice'] - 1; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td style="padding-left: 2%;" colspan="4">ACTIFS NON COURANTS</td></tr>
                        <tr><td style="padding-left: 4%;" colspan="4">Actifs immobilisés</td></tr>
                        <tr>
                            <td style="padding-left: 6%;">Immobilisations incorporelles</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($actif[1][0]['param_id'] != ''): ?>
                                    <?php
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][0]['param_id']);
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
                                
                                if ($actif[1][0]['solde_courant'] >= 0):
                                    echo number_format($actif[1][0]['solde_courant'], 3, '.', ' ');
                                elseif ($actif[1][0]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif[1][0]['solde_courant']), 3, '.', ' ') . ')';
//                                elseif ($actif[0]['solde_courant'] == 0) :echo '';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[0][0]['solde_prec'] >= 0):
                                    echo number_format($actif[0][0]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][0]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($actif[0][0]['solde_prec']), 3, '.', ' ') . ')';
//                                elseif ($actif[0]['solde_prec'] == 0):echo '';
                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Moins : amortissements</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($actif[1][1]['param_id'] != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][1]['param_id']); ?>
                                    <?php $compte_numero = ''; ?>
                                    <?php
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
                                if ($actif[1][1]['solde_courant'] >= 0):
                                    echo number_format($actif[1][1]['solde_courant'], 3, '.', ' ');
                                elseif ($actif[1][1]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif[1][1]['solde_courant']), 3, '.', ' ') . ')';
//                                elseif ($actif[1]['solde_courant'] == 0):echo '';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[0][1]['solde_prec'] >= 0):
                                    echo number_format($actif[0][1]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][1]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($actif[0][1]['solde_prec']), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;"></td>
                            <td style="text-align: center;">3-1</td>
                            <td style="text-align: center;">
                                <?php
                                $total_incorporel_courant = $actif[1][0]['solde_courant'] - abs($actif[1][1]['solde_courant']);
                                if ($total_incorporel_courant >= 0):
                                    echo number_format($total_incorporel_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_incorporel_courant, 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_incorporel_prec = $actif[0][0]['solde_prec'] - abs($actif[0][1]['solde_prec']);
                                if ($total_incorporel_prec >= 0):
                                    echo number_format($total_incorporel_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_incorporel_prec, 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Immobilisations corporelles</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($actif[1][2]['param_id'] != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][2]['param_id']); ?>
                                    <?php $compte_numero = ''; ?>
                                    <?php
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
                                if ($actif[1][2]['solde_courant'] >= 0):
                                    echo number_format($actif[1][2]['solde_courant'], 3, '.', ' ');
                                elseif ($actif[1][2]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif[1][2]['solde_courant']), 3, '.', ' ') . ')';
//                                elseif ($actif[2]['solde_courant'] == 0):echo '';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[0][2]['solde_prec'] >= 0):
                                    echo number_format($actif[0][2]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][2]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($actif[0][2]['solde_prec']), 3, '.', ' ') . ')';
//                                elseif ($actif[2]['solde_prec'] == 0):echo '';
                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Moins : amortissements</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($actif[1][3]['param_id'] != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][3]['param_id']); ?>
                                    <?php $compte_numero = ''; ?>
                                    <?php
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
                                if ($actif[1][3]['solde_courant'] >= 0):
                                    echo number_format($actif[1][3]['solde_courant'], 3, '.', ' ');
                                else:
                                    echo '(' . number_format(abs($actif[1][3]['solde_courant']), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[0][3]['solde_prec'] >= 0):
                                    echo number_format($actif[0][3]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][3]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($actif[0][3]['solde_prec']), 3, '.', ' ') . ')';
//                                elseif ($actif[3]['solde_prec'] == 0):echo '';
                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;"></td>
                            <td style="text-align: center;">3-2</td>
                            <td style="text-align: center;">
                                <?php
                                $total_corporel_courant = $actif[1][2]['solde_courant'] - abs($actif[1][3]['solde_courant']);
                                if ($total_corporel_courant >= 0):
                                    echo number_format($total_corporel_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_corporel_courant, 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_corporel_prec = $actif[0][2]['solde_prec'] - abs($actif[0][3]['solde_prec']);
                                if ($total_corporel_prec >= 0):
                                    echo number_format($total_corporel_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_corporel_prec, 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Immobilisations financières</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($actif[1][4]['param_id'] != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][4]['param_id']); ?>
                                    <?php $compte_numero = ''; ?>
                                    <?php
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
                                if ($actif[1][4]['solde_courant'] >= 0):
                                    echo number_format($actif[1][4]['solde_courant'], 3, '.', ' ');
                                elseif ($actif[1][4]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif[1][4]['solde_courant']), 3, '.', ' ') . ')';
//                                elseif ($actif[4]['solde_courant'] == 0):echo '';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[0][4]['solde_prec'] >= 0):
                                    echo number_format($actif[0][4]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][4]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($actif[0][4]['solde_prec']), 3, '.', ' ') . ')';
//                                elseif ($actif[4]['solde_prec'] < 0): echo '';
                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Moins : provisions</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($actif[1][5]['param_id'] != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][5]['param_id']); ?>
                                    <?php $compte_numero = ''; ?>
                                    <?php
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
                                if ($actif[1][5]['solde_courant'] >= 0):
                                    echo number_format($actif[1][5]['solde_courant'], 3, '.', ' ');
                                elseif ($actif[1][5]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif[1][5]['solde_courant']), 3, '.', ' ') . ')';
//                                elseif ($actif[5]['solde_courant'] == 0):echo '';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[0][5]['solde_prec'] >= 0):
                                    echo number_format($actif[0][5]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][5]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($actif[0][5]['solde_prec']), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;"></td>
                            <td style="text-align: center;">3-3</td>
                            <td style="text-align: center;">
                                <?php
                                $total_finance_courant = $actif[1][4]['solde_courant'] - abs($actif[1][5]['solde_courant']);
                                if ($total_finance_courant >= 0):
                                    echo number_format($total_finance_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_finance_courant, 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_finance_prec = $actif[0][4]['solde_prec'] - abs($actif[0][5]['solde_prec']);
                                if ($total_finance_prec >= 0):
                                    echo number_format($total_finance_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_finance_prec, 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;" colspan="2">Total des actifs immobilisés</td>
                            <td style="text-align: center;">
                                <?php
                                $total_immobilise_courant = $total_incorporel_courant + $total_corporel_courant + $total_finance_courant;
                                if ($total_immobilise_courant >= 0):
                                    echo number_format($total_immobilise_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_immobilise_courant), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_immobilise_prec = $total_incorporel_prec + $total_corporel_prec + $total_finance_prec;
                                if ($total_immobilise_prec >= 0):
                                    echo number_format($total_immobilise_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_immobilise_prec), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Autres actifs non courants</td>
                            <td style="text-align: center;">
                                <?php if ($actif[1][6]['param_id'] != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][6]['param_id']); ?>
                                    <?php $compte_numero = ''; ?>
                                    <?php
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
                                if ($actif[1][6]['solde_courant'] >= 0):
                                    echo number_format($actif[1][6]['solde_courant'], 3, '.', ' ');
                                elseif ($actif[1][6]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif[1][6]['solde_courant']), 3, '.', ' ') . ')';
//                                elseif ($actif[6]['solde_courant'] == 0):echo '';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[0][6]['solde_prec'] >= 0):
                                    echo number_format($actif[0][6]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][6]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($actif[0][6]['solde_prec']), 3, '.', ' ') . ')';
//                                elseif ($actif[6]['solde_prec'] == 0):
                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;" colspan="2">TOTAL DES ACTIFS NON COURANTS</td>
                            <td style="text-align: center;">
                                <?php
                                $total_actif_non_courant_courant = $total_immobilise_courant + $actif[1][6]['solde_courant'];
                                if ($total_actif_non_courant_courant >= 0):
                                    echo number_format($total_actif_non_courant_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_actif_non_courant_courant), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_actif_non_courant_prec = $total_immobilise_prec + $actif[0][6]['solde_prec'];
                                if ($total_actif_non_courant_prec >= 0):
                                    echo number_format($total_actif_non_courant_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_actif_non_courant_prec), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 2%;" colspan="4">ACTIFS COURANTS</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Stocks</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($actif[1][7]['param_id'] != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][7]['param_id']); ?>
                                    <?php $compte_numero = ''; ?>
                                    <?php
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
                                if ($actif[1][7]['solde_courant'] >= 0):
                                    echo number_format($actif[1][7]['solde_courant'], 3, '.', ' ');
                                elseif ($actif[1][7]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif[1][7]['solde_courant']), 3, '.', ' ') . ')';
//                                elseif ($actif[7]['solde_courant'] == 0):
//                                    echo '';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[0][7]['solde_prec'] >= 0):
                                    echo number_format($actif[0][7]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][7]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($actif[0][7]['solde_prec']), 3, '.', ' ') . ')';
//                                elseif ($actif[7]['solde_prec'] == 0):
//                                    echo '';
                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Moins : provisions</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($actif[1][8]['param_id'] != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][8]['param_id']); ?>
                                    <?php $compte_numero = ''; ?>
                                    <?php
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
                                if ($actif[1][8]['solde_courant'] >= 0):
                                    echo number_format($actif[1][8]['solde_courant'], 3, '.', ' ');
                                elseif ($actif[1][8]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif[1][8]['solde_courant']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[0][8]['solde_prec'] >= 0):
                                    echo number_format($actif[0][8]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][8]['solde_prec'] < 0):
                                    echo'(' . number_format(abs($actif[0][8]['solde_prec']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;"></td>
                            <td style="text-align: center;">3-4</td>
                            <td style="text-align: center;">
                                <?php
                                $total_stock_courant = $actif[1][7]['solde_courant'] - abs($actif[1][8]['solde_courant']);
                                if ($total_stock_courant >= 0):
                                    echo number_format($total_stock_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_stock_courant), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_stock_prec = $actif[0][7]['solde_prec'] - abs($actif[0][8]['solde_prec']);
                                if ($total_stock_prec >= 0):
                                    echo number_format($total_stock_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_stock_prec), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Clients et comptes rattachés</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($actif[1][9]['param_id'] != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][9]['param_id']); ?>
                                    <?php $compte_numero = ''; ?>
                                    <?php
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
                                if ($actif[1][9]['solde_courant'] >= 0):
                                    echo number_format($actif[1][9]['solde_courant'], 3, '.', ' ');
                                elseif ($actif[1][9]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif[1][9]['solde_courant']), 3, '.', ' ') . ')';
//                                 elseif ($actif[9]['solde_courant'] == 0):
//                                     echo '';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[0][9]['solde_prec'] >= 0):
                                    echo number_format($actif[0][9]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][9]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($actif[0][9]['solde_prec']), 3, '.', ' ') . ')';
//                                  elseif ($actif[9]['solde_prec'] == 0):
//                                      echo '';
                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Moins : provisions</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($actif[1][10]['param_id'] != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][10]['param_id']); ?>
                                    <?php $compte_numero = ''; ?>
                                    <?php
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
                                if ($actif[1][10]['solde_courant'] >= 0):
                                    echo number_format($actif[1][10]['solde_courant'], 3, '.', ' ');
                                elseif ($actif[1][10]['solde_courant'] < 0):
                                    echo'(' . number_format(abs($actif[1][10]['solde_courant']), 3, '.', ' ') . ')';
//                                  elseif ($actif[10]['solde_courant'] ==0):
//                                      echo '';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[0][10]['solde_prec'] >= 0):
                                    echo number_format($actif[0][10]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][10]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($actif[0][10]['solde_prec']), 3, '.', ' ') . ')';
//                                elseif ($actif[10]['solde_prec'] == 0):
//                                    echo '';
                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;"></td>
                            <td style="text-align: center;">3-5</td>
                            <td style="text-align: center;">
                                <?php
                                $total_client_courant = $actif[1][9]['solde_courant'] - abs($actif[1][10]['solde_courant']);
                                if ($total_client_courant >= 0):
                                    echo number_format($total_client_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_client_courant), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_client_prec = $actif[0][9]['solde_prec'] - abs($actif[0][10]['solde_prec']);
                                if ($total_client_prec >= 0):
                                    echo number_format($total_client_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_client_prec), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Autres actifs courants</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($actif[1][11]['param_id'] != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][11]['param_id']); ?>
                                    <?php $compte_numero = ''; ?>
                                    <?php
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
                                if ($actif[1][11]['solde_courant'] >= 0):
                                    echo number_format($actif[1][11]['solde_courant'], 3, '.', ' ');
                                elseif ($actif[1][11]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif[1][11]['solde_courant']), 3, '.', ' ') . ')';
//                                 elseif ($actif[11]['solde_courant'] == 0):
//                                     echo '';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[0][11]['solde_prec'] >= 0):
                                    echo number_format($actif[0][11]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][11]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($actif[0][11]['solde_prec']), 3, '.', ' ') . ')';
//                                 elseif ($actif[11]['solde_prec'] ==0):
//                                     echo '';
                                endif;
                                ?>
                            </td>
                        </tr>


                        <tr>
                            <td style="padding-left: 6%;">Moins : provisions</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($actif[1][12]['param_id'] != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][12]['param_id']); ?>
                                    <?php $compte_numero = ''; ?>
                                    <?php
                                    foreach ($params as $param_compte):
                                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
                                        if ($param_compte->getType() == 1) {
                                            $numero = '<b>' . $numero . '</b>';
                                        }
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
                                if ($actif[1][12]['solde_courant'] >= 0):
                                    echo number_format($actif[1][12]['solde_courant'], 3, '.', ' ');
                                elseif ($actif[1][12]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif[1][12]['solde_courant']), 3, '.', ' ') . ')';
//                                  elseif ($actif[12]['solde_courant'] == 0):
//                                      echo '';
                                endif;
                                ?>
                            </td><td style="text-align: center;">
                                <?php
                                if ($actif[0][12]['solde_prec'] >= 0):
                                    echo number_format($actif[0][12]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][12]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($actif[0][12]['solde_prec']), 3, '.', ' ') . ')';
//                                   elseif ($actif[12]['solde_prec'] == 0):
//                                       echo '';
                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;"></td>
                            <td style="text-align: center;">3-6</td>
                            <td style="text-align: center;">
                                <?php
                                $total_autre_courant = $actif[1][11]['solde_courant'] - abs($actif[1][12]['solde_courant']);
                                if ($total_autre_courant >= 0):
                                    echo number_format($total_autre_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_autre_courant), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_autre_prec = $actif[0][11]['solde_prec'] - abs($actif[0][12]['solde_prec']);
                                if ($total_autre_prec >= 0):
                                    echo number_format($total_autre_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_autre_prec), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Placements et Autres Actifs Financiers</td>
                            <td style="text-align: center;">
                                <input value="3-7" type="hidden" name="note">
                                <?php if ($actif[1][13]['param_id'] != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][13]['param_id']); ?>
                                    <?php $compte_numero = ''; ?>
                                    <?php
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
                                <br>3-7
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[1][13]['solde_courant'] >= 0):
                                    echo number_format($actif[1][13]['solde_courant'], 3, '.', ' ');
                                elseif ($actif[1][13]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif[1][13]['solde_courant']), 3, '.', ' ') . ')';
//                                elseif ($actif[13]['solde_courant'] == 0):
//                                    echo '';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[0][13]['solde_prec'] >= 0):
                                    echo number_format($actif[0][13]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][13]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($actif[0][13]['solde_prec']), 3, '.', ' ') . ')';
//                                elseif ($actif[13]['solde_prec'] == 0):
//                                    echo '';
                                endif;
                                ?>
                            </td>
                        </tr>  

                        <tr>
                            <td style="padding-left: 6%;">Liquidités et équivalents de liquidités</td>
                            <td style="text-align: center;">
                                <input value="3-8" type="hidden" name="note">
                                <?php if ($actif[1][14]['param_id'] != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[1][14]['param_id']); ?>
                                    <?php $compte_numero = ''; ?>
                                    <?php
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
                                <br>3-8
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[1][14]['solde_courant'] >= 0):
                                    echo number_format($actif[1][14]['solde_courant'], 3, '.', ' ');
                                elseif ($actif[1][14]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif[1][14]['solde_courant']), 3, '.', ' ') . ')';
//                                 elseif ($actif[14]['solde_courant'] == 0):
//                                     echo '';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif[0][14]['solde_prec'] >= 0):
                                    echo number_format($actif[0][14]['solde_prec'], 3, '.', ' ');
                                elseif ($actif[0][14]['solde_prec'] < 0):
                                    echo '(' . number_format(abs($actif[0][14]['solde_prec']), 3, '.', ' ') . ')';
//                                 elseif ($actif[14]['solde_prec'] == 0):
//                                     echo '';
                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;" colspan="2">TOTAL DES ACTIFS COURANTS</td>
                            <td style="text-align: center;">
                                <?php
                                $total_actif_courant_courant = $total_stock_courant + $total_client_courant + $total_autre_courant + $actif[1][13]['solde_courant'] + $actif[1][14]['solde_courant'];
                                if ($total_actif_courant_courant >= 0):
                                    echo number_format($total_actif_courant_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_actif_courant_courant), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_actif_courant_prec = $total_stock_prec + $total_client_prec + $total_autre_prec + $actif[0][13]['solde_prec'] + $actif[0][14]['solde_prec'];
                                if ($total_actif_courant_prec >= 0):
                                    echo number_format($total_actif_courant_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_actif_courant_prec), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;" colspan="2">TOTAL DES ACTIFS</td>
                            <td style="text-align: center;">
                                <?php
                                $total_courant_1 = $total_actif_courant_courant + $total_actif_non_courant_courant;
                                if ($total_courant_1 >= 0):
                                    echo number_format($total_courant_1, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_courant_1), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_prec = $total_actif_courant_prec + $total_actif_non_courant_prec;
                                if ($total_prec >= 0):
                                    echo number_format($total_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_prec), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>

                        </tr>
                    </tbody>
                </table>
                <input type="hidden" value="<?php echo $total_courant_1; ?>" id="total_courant_actif">
                <input type="hidden" value="<?php echo $total_prec; ?>" id="total_prec_actif">
                <table style="margin-bottom: 0px;"><tr><td><a class="btn btn-primary" href="<?php echo url_for('fiche_Bilan/imprimerBilan?type=0'); ?>" target="_blank" style="float: right;"><i class="ace-icon fa fa-print"></i> Imprimer </a></td></tr></table>
            </div>
        </form>
    </div>
</div>