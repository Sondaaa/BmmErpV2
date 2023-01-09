<div id="sf_admin_container" ng-controller="myCtrlPaysVille">
    <h1 id="replacediv">Etat du Résultat</h1>
</div>

<div class="row">
    <div class="col-sm-12">
        <table style="font-weight: bold;">
            <thead>
                <tr>
                    <th style="width: 40%;"></th>
                    <th style="width: 20%; text-align: center;">Notes</th>
                    <th style="width: 20%; text-align: center;">31/12/<?php echo $_SESSION['exercice']; ?></th>
                    <th style="width: 20%; text-align: center;">31/12/<?php echo $_SESSION['exercice'] - 1; ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding-left: 2%;" colspan="4">PRODUITS D'EXPLOITATION</td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Revenus</td>
                    <td style="text-align: center;">
                        <input value="5-1" type="hidden" name="note_2">
                        <?php if ($resultat[1][0]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[1][0]['param_id']);
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
                        <br>5-1
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$resultat[1][0]['solde_courant'] >= 0):
                            echo number_format(-$resultat[1][0]['solde_courant'], 3, '.', ' ');
                        else:
                            echo'(' . number_format(abs(-$resultat[1][0]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$resultat[0][0]['solde_prec'] >= 0):
                            echo number_format(-$resultat[0][0]['solde_prec'], 3, '.', ' ');
                        elseif (-$resultat[0][0]['solde_prec'] < 0):
                            echo '(' . number_format(abs(-$resultat[0][0]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Autres produits d'exploitation</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_2">
                        <?php if ($resultat[1][1]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[1][1]['param_id']);
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
                        if (-$resultat[1][1]['solde_courant'] >= 0):
                            echo number_format(-$resultat[1][1]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs(-$resultat[1][1]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$resultat[0][1]['solde_prec'] >= 0):
                            echo number_format(-$resultat[0][1]['solde_prec'], 3, '.', ' ');
                        elseif (-$resultat[0][1]['solde_prec'] < 0):
                            echo number_format(abs($resultat[0][1]['solde_prec']), 3, '.', ' ');
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Production immobilisée</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_2">
                        <?php if ($resultat[1][2]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[1][2]['param_id']);
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
                        if (-$resultat[1][2]['solde_courant'] >= 0):
                            echo number_format(-$resultat[1][2]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[1][2]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$resultat[0][2]['solde_prec'] >= 0):
                            echo number_format(-$resultat[0][2]['solde_prec'], 3, '.', ' ');
                        elseif (-$resultat[0][2]['solde_prec'] < 0):
                            echo '(' . number_format(abs($resultat[0][2]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?> 
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 4%;">Total des produits d'exploitation</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_prod_exploi_courant = -$resultat[1][0]['solde_courant'] - $resultat[1][1]['solde_courant'] - $resultat[1][2]['solde_courant'];
                        if ($total_prod_exploi_courant >= 0):
                            echo number_format($total_prod_exploi_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_prod_exploi_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_prod_exploi_prec = -$resultat[0][0]['solde_prec'] - $resultat[0][1]['solde_prec'] - $resultat[0][2]['solde_prec'];
                        if ($total_prod_exploi_prec >= 0):
                            echo number_format($total_prod_exploi_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_prod_exploi_prec), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 2%;" colspan="4">CHARGES D'EXPLOITATION</td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Achats d'approvisionnements consommés</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_2">
                        <?php if ($resultat[1][3]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[1][3]['param_id']);
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
                        <br>5-2
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($resultat[1][3]['solde_courant'] >= 0):
                            echo number_format($resultat[1][3]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[1][3]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($resultat[0][3]['solde_prec'] >= 0):
                            echo number_format($resultat[0][3]['solde_prec'], 3, '.', ' ');
                        elseif ($resultat[0][3]['solde_prec'] < 0):
                            echo '(' . number_format(abs($resultat[0][3]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>  
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Charges de personnel</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_2">
                        <?php if ($resultat[1][4]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[1][4]['param_id']);
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
                        <br>5-3
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($resultat[1][4]['solde_courant'] >= 0):
                            echo number_format($resultat[1][4]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[1][4]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($resultat[0][4]['solde_prec'] >= 0):
                            echo number_format($resultat[0][4]['solde_prec'], 3, '.', ' ');
                        elseif ($resultat[0][4]['solde_prec'] < 0):
                            echo '(' . number_format(abs($resultat[0][4]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Dotation aux amortissements et aux provisions</td>
                    <td style="text-align: center;">
                        <input value="5-2" type="hidden" name="note_2">
                        <?php if ($resultat[1][5]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[1][5]['param_id']);
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
                        <br>5-4
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($resultat[1][5]['solde_courant'] >= 0):
                            echo number_format($resultat[1][5]['solde_courant'], 3, '.', ' ');
                        else:
                            echo'(' . number_format(abs($resultat[1][5]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($resultat[0][5]['solde_prec'] >= 0):
                            echo number_format($resultat[0][5]['solde_prec'], 3, '.', ' ');
                        elseif ($resultat[0][5]['solde_prec'] < 0):
                            echo '(' . number_format(abs($resultat[0][5]['solde_prec']), 3, '.', ' ') . ')';
                            echo '';
                        endif;
                        ?> 
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Autres charges d'exploitation</td>
                    <td style="text-align: center;">
                        <input value="5-4" type="hidden" name="note_2">
                        <?php if ($resultat[1][6]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[1][6]['param_id']);
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
                        if ($resultat[1][6]['solde_courant'] >= 0):
                            echo number_format($resultat[1][6]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[1][6]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($resultat[0][6]['solde_prec'] >= 0):
                            echo number_format($resultat[0][6]['solde_prec'], 3, '.', ' ');
                        elseif ($resultat[0][6]['solde_prec'] < 0):
                            echo '(' . number_format(abs($resultat[0][6]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?> 
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 4%;">Total des charges d'exploitation</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_charge_exploi_courant = $resultat[1][3]['solde_courant'] + $resultat[1][4]['solde_courant'] + $resultat[1][5]['solde_courant'] + $resultat[1][6]['solde_courant'];
                        if ($total_charge_exploi_courant >= 0):
                            echo number_format($total_charge_exploi_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_charge_exploi_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_charge_exploi_prec = $resultat[0][3]['solde_prec'] + $resultat[0][4]['solde_prec'] + $resultat[0][5]['solde_prec'] + $resultat[0][6]['solde_prec'];
                        if ($total_charge_exploi_prec >= 0):
                            echo number_format($total_charge_exploi_prec, 3, '.', ' ');
                        elseif ($total_charge_exploi_prec < 0):
                            echo '(' . number_format(abs($total_charge_exploi_prec), 3, '.', ' ') . ')';
//                        elseif($total_charge_exploi_prec==0):
//                              echo '';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">Résultat d'exploitation</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_exploi_courant = $total_prod_exploi_courant - $total_charge_exploi_courant;
                        if ($total_exploi_courant >= 0):
                            echo number_format($total_exploi_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_exploi_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_exploi_prec = $total_prod_exploi_prec - $total_charge_exploi_prec;
                        if ($total_exploi_prec >= 0):
                            echo number_format($total_exploi_prec, 3, '.', ' ');
                        elseif ($total_exploi_prec < 0):
                            echo '(' . number_format(abs($total_exploi_prec), 3, '.', ' ') . ')';
//                        elseif($total_exploi_prec == 0):
//                            echo '';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Charges financières nettes</td>
                    <td style="text-align: center;">
                        <input value="5-4" type="hidden" name="note_2">
                        <?php if ($resultat[1][7]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[1][7]['param_id']);
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
                        if (-$resultat[1][7]['solde_courant'] >= 0):
                            echo number_format(-$resultat[1][7]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[1][7]['solde_courant']), 3, '.', ' ') . ')';

                        endif;
                        ?> 
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($resultat[0][7]['solde_prec'] >= 0):
                            echo number_format($resultat[0][7]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[0][7]['solde_prec']), 3, '.', ' ') . ')';

                        endif;
                        ?> 
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Produits des placements</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_2">
                        <?php if ($resultat[1][8]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[1][8]['param_id']);
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
                        if (-$resultat[1][8]['solde_courant'] >= 0):
                            echo number_format(-$resultat[1][8]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[1][8]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?> 
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$resultat[0][8]['solde_prec'] >= 0):
                            echo number_format(-$resultat[0][8]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[0][8]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?> 
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Autres gains ordinaires</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_2">
                        <?php if ($resultat[1][9]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[1][9]['param_id']);
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
                        if (-$resultat[1][9]['solde_courant'] >= 0):
                            echo number_format(-$resultat[1][9]['solde_courant'], 3, '.', ' ');
                        else:
                            echo'(' . number_format(abs($resultat[1][9]['solde_courant']), 3, '.', ' ') . ')';

                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$resultat[0][9]['solde_prec'] >= 0):
                            echo number_format(-$resultat[0][9]['solde_prec'], 3, '.', ' ');
                        else:
                            echo'(' . number_format(abs($resultat[0][9]['solde_prec']), 3, '.', ' ') . ')';

                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Autres pertes ordinaires</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_2">
                        <?php if ($resultat[1][10]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[1][10]['param_id']);
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
                        if (-$resultat[1][10]['solde_courant'] >= 0):
                            echo number_format(-$resultat[1][10]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[1][10]['solde_courant']), 3, '.', ' ') . ')';

                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$resultat[0][10]['solde_prec'] >= 0):
                            echo number_format(-$resultat[0][10]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[0][10]['solde_prec']), 3, '.', ' ') . ')';

                        endif;
                        ?> 
                    </td>
                </tr>
                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">Résultat des activités ordinaires avant impôt</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_avant_impot_courant = $total_exploi_courant - $resultat[1][9]['solde_courant'] - $resultat[1][10]['solde_courant'] - $resultat[1][8]['solde_courant'] - $resultat[1][7]['solde_courant'];
                        if ($total_avant_impot_courant >= 0):
                            echo number_format($total_avant_impot_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_avant_impot_courant), 3, '.', ' ') . ')';

                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_avant_impot_prec = $total_exploi_prec - $resultat[0][9]['solde_prec'] - $resultat[0][10]['solde_prec'] - $resultat[0][8]['solde_prec'] - $resultat[0][7]['solde_prec'];
                        if ($total_avant_impot_prec >= 0):
                            echo number_format($total_avant_impot_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_avant_impot_prec), 3, '.', ' ') . ')';

                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Impôt sur les bénéfices</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_2">
                        <?php if ($resultat[1][11]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[1][11]['param_id']);
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
                        if ($resultat[1][11]['solde_courant'] >= 0):
                            echo number_format($resultat[1][11]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[1][11]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($resultat[0][11]['solde_prec'] >= 0):
                            echo number_format($resultat[0][11]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[0][11]['solde_prec']), 3, '.', ' ') . ')';

                        endif;
                        ?> 
                    </td>
                </tr>
                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">Résultat des activités ordinaires après impôt</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_apres_impot_courant = $total_avant_impot_courant + $resultat[1][11]['solde_courant'];
                        if ($total_apres_impot_courant >= 0):
                            echo number_format($total_apres_impot_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_apres_impot_courant), 3, '.', ' ') . ')';

                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_apres_impot_prec = $total_avant_impot_prec + $resultat[0][11]['solde_prec'];
                        if ($total_apres_impot_prec >= 0):
                            echo number_format($total_apres_impot_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_apres_impot_prec), 3, '.', ' ') . ')';

                        endif;
                        ?>
                    </td>
                </tr>
                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;" colspan="2">Résultat net de l'exercice</td>
                    <td style="text-align: center;">
                        <?php
                        $total_net_courant = $total_apres_impot_courant;
                        if ($total_net_courant >= 0):
                            echo number_format($total_net_courant, 3, '.', ' ');
                        else:
                            echo'(' . number_format(abs($total_net_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_net_prec = $total_apres_impot_prec;
                        if ($total_net_prec >= 0):
                            echo number_format($total_net_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format($total_net_prec, 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;" colspan="2">Contrôle Résultat net de l'exercice</td>
                    <td style="text-align: center;">
                        <input class="align_center" type="text" id="controle_exercice_courant" readonly="true">
                    </td>
                    <td style="text-align: center;">
                        <input class="align_center" type="text" id="controle_exercice_prec" readonly="true">

                    </td>
                </tr>

            </tbody>
        </table>
        <input type="hidden" id="resultat_exercice_courant" value="<?php echo number_format($total_net_courant, 3, '.', ' ') ?>">
        <input type="hidden" id="resultat_exercice_prec" value="<?php echo number_format($total_net_prec, 3, '.', ' ') ?>">

        <input type="hidden" value="<?php echo number_format($passif[1][3]['solde_courant'], 3, '.', ' ') ?>" id="total_exercie_courant">
        <input type="hidden" value="<?php echo number_format($passif[0][3]['solde_prec'], 3, '.', ' ') ?>" id="total_exercie_prec">

        <table style="margin-bottom: 0px;"><tr><td><a class="btn btn-primary" href="<?php echo url_for('fiche_Bilan/imprimerBilan?type=2'); ?>" target="_blank" style="float: right;"><i class="ace-icon fa fa-print"></i> Imprimer </a></td></tr></table>
    </div>
</div>
<style>

    .align_center{text-align: center;}

</style>