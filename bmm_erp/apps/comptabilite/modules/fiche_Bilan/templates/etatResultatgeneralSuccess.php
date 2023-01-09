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
                    <td style="padding-left: 4%;">Total des produits d'exploitation</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_prod_exploi_courant = -$resultat[1][0]['solde_courant'] - $resultat[1][1]['solde_courant'];
                        if ($total_prod_exploi_courant >= 0):
                            echo number_format($total_prod_exploi_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_prod_exploi_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_prod_exploi_prec = -$resultat[0][0]['solde_prec'] - $resultat[0][1]['solde_prec'];
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
                    <td style="padding-left: 6%;">Variation de Stock de marchadises</td>
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
                        if ($resultat[1][2]['solde_courant'] >= 0):
                            echo number_format($resultat[1][2]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[1][2]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($resultat[0][2]['solde_prec'] >= 0):
                            echo number_format($resultat[0][2]['solde_prec'], 3, '.', ' ');
                        elseif ($resultat[0][2]['solde_prec'] < 0):
                            echo '(' . number_format(abs($resultat[0][2]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Achat de marchandises consommés</td>
                    <td style="text-align: center;">
                        <input value="5-2" type="hidden" name="note_2">
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
                <tr><td style="padding-left: 6%;">Achats d'approvisionnements consommés</td>

                    <td style="text-align: center;">
                        <input value="5-3" type="hidden" name="note_2">
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
                    <td style="padding-left: 6%;">Charges de personnel</td>

                    <td style="text-align: center;">
                        <input value="5-4" type="hidden" name="note_2">
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

                        endif;
                        ?> 
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Dotations aux amortissements et provisions</td>

                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_2">
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
                    <td style="padding-left: 6%;">Autres charges d'exploitation</td>
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
                        if ($resultat[1][7]['solde_courant'] >= 0):
                            echo number_format($resultat[1][7]['solde_courant'], 3, '.', ' ');
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
                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 4%;">Total des charges d'exploitation</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_charge_exploi_courant = $resultat[1][2]['solde_courant'] + $resultat[1][3]['solde_courant'] + $resultat[1][4]['solde_courant'] + $resultat[1][5]['solde_courant'] + $resultat[1][6]['solde_courant'] + $resultat[1][7]['solde_courant'];
                        if ($total_charge_exploi_courant >= 0):
                            echo number_format($total_charge_exploi_courant, 3, '.', ' ');
                        else:
                            echo'(' . number_format(abs($total_charge_exploi_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_charge_exploi_prec = $resultat[0][2]['solde_prec'] + $resultat[0][3]['solde_prec'] + $resultat[0][4]['solde_prec'] + $resultat[0][5]['solde_prec'] + $resultat[0][6]['solde_prec'] + $resultat[0][7]['solde_prec'];
                        if ($total_charge_exploi_prec >= 0):
                            echo number_format($total_charge_exploi_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_charge_exploi_prec), 3, '.', ' ') . ')';
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
                        else:
                            echo '(' . number_format(abs($total_exploi_prec), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Charges financières nettes</td>
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
                    <td style="padding-left: 6%;">Produits financiers</td>
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
                    <td style="padding-left: 6%;">Autres gains ordinaires</td>
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
                <tr>
                    <td style="padding-left: 6%;">Autres pertes ordinaires</td>
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
                        if (-$resultat[1][11]['solde_courant'] >= 0):
                            echo number_format(-$resultat[1][11]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[1][11]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$resultat[0][11]['solde_prec'] >= 0):
                            echo number_format(-$resultat[0][11]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[0][11]['solde_prec']), 3, '.', ' ') . ')';

                        endif;
                        ?> 
                    </td>
                </tr>
                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">Résultat des activités ordinaires avant impôt</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_avant_impot_courant = $total_exploi_courant + $resultat[1][9]['solde_courant'] - $resultat[1][10]['solde_courant'] - $resultat[1][11]['solde_courant'] + $resultat[1][8]['solde_courant'];
                        if ($total_avant_impot_courant >= 0):
                            echo number_format($total_avant_impot_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_avant_impot_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_avant_impot_prec = $total_exploi_prec + $resultat[0][9]['solde_prec'] - $resultat[0][10]['solde_prec'] - $resultat[0][11]['solde_prec'] + $resultat[0][8]['solde_prec'];
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
                        <?php if ($resultat[1][12]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[1][12]['param_id']);
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
                        if (-$resultat[1][12]['solde_courant'] >= 0):
                            echo number_format(-$resultat[1][12]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[1][12]['solde_courant']), 3, '.', ' ') . ')';

                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$resultat[0][12]['solde_prec'] >= 0):
                            echo number_format(-$resultat[0][12]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[0][12]['solde_prec']), 3, '.', ' ') . ')';

                        endif;
                        ?> 
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">CSS 1%</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_2">
                        <?php if ($resultat[1][13]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[1][13]['param_id']);
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
                        if (-$resultat[1][13]['solde_courant'] >= 0):
                            echo number_format(-$resultat[1][13]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[1][13]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$resultat[0][13]['solde_prec'] >= 0):
                            echo number_format(-$resultat[0][13]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($resultat[0][13]['solde_prec']), 3, '.', ' ') . ')';

                        endif;
                        ?> 
                    </td>
                </tr>
                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">Résultat des activités ordinaires après impôt</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_apres_impot_courant = $total_avant_impot_courant - $resultat[1][12]['solde_courant'] - $resultat[1][13]['solde_courant'];
                        if ($total_apres_impot_courant >= 0):
                            echo number_format($total_apres_impot_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_apres_impot_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_apres_impot_prec = $total_avant_impot_prec - $resultat[0][12]['solde_prec'] - $resultat[0][13]['solde_prec'];
                        if ($total_apres_impot_prec >= 0):
                            echo number_format($total_apres_impot_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_apres_impot_prec), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>


                <tr>
                    <td style="padding-left: 6%;">Résultat net de l'exercice</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_1">
                    </td>
                    <?php
                    $exercice_id = $_SESSION['exercice_id'];
                    $dossier_id = $_SESSION['dossier_id'];
                    $planDossierComptable = PlandossiercomptableTable::getInstance()->loadEtatResultatTotaux($dossier_id, $exercice_id);
                    $solde_debit_classe_6_cour = 0;
                    $solde_credit_classe_6_cour = 0;
                    $solde_debit_classe_7_cour = 0;
                    $solde_credit_classe_7_cour = 0;

                    foreach ($planDossierComptable as $p_d_c):
                        $solde = $p_d_c->getSolde();
                        $calcul_mois = LignepiececomptableTable::getInstance()->calculDebitMoisClasse6_7(trim($p_d_c->getNumerocompte()), $exercice_id);

                        if ($p_d_c->getTypesolde() == 1) {
                            $montantDebitMois = $calcul_mois->getTotalDebit() + $solde;
                            $montantCreditMois = 0;
                        }
                        if ($p_d_c->getTypesolde() == 2) {
                            $montantCreditMois = $calcul_mois->getTotalCredit() - $solde;
                            $montantDebitMois = 0;
                        }
                        $soldeDebit = $montantDebitMois;
                        $soldeCredit = $montantCreditMois;
                        if ($p_d_c->getPlancomptable()->getIdClasse() == 6) {
                            $solde_debit_classe_6_cour += $soldeDebit;
                            $solde_credit_classe_6_cour += $soldeCredit;
                        }
                        if ($p_d_c->getPlancomptable()->getIdClasse() == 7) {
                            $solde_debit_classe_7_cour += $soldeDebit;
                            $solde_credit_classe_7_cour += $soldeCredit;
                        }
                    endforeach;
                    $resultat_debit_cour = $solde_debit_classe_7_cour - $solde_debit_classe_6_cour;
                    $resultat_credit_cour = $solde_credit_classe_7_cour - $solde_credit_classe_6_cour;
//                            $resultat = $resultat_debit - $resultat_credit;
                    $resultat_6_cour = $solde_debit_classe_6_cour - $solde_credit_classe_6_cour;
                    $resultat_7_cour = $solde_debit_classe_7_cour - $solde_credit_classe_7_cour;
                    $reultat_exercice_courant = $resultat_7_cour + $resultat_6_cour;

                    /*                     * ********* ********exercice precedent */
                    $solde_debit_classe_6_pre = 0;
                    $solde_credit_classe_6_pre = 0;
                    $solde_debit_classe_7_pre = 0;
                    $solde_credit_classe_7_pre = 0;
                    $dossier_id = $_SESSION['dossier_id'];

                    $exercice_precedent = ExerciceTable::getInstance()->getByLibelle($_SESSION['exercice'] - 1)->getFirst();
                    if (sizeof($exercice_precedent) > 1) {
//                        echo(sizeof($exercice_precedent) . '33' . $_SESSION['exercice'] - 1 . 'mm' );
                        $exercice_id_precedent = $exercice_precedent->getId();
                        $planDossierComptable_prece = PlandossiercomptableTable::getInstance()->loadEtatResultatTotaux($dossier_id, $exercice_id_precedent);
                        if (sizeof($planDossierComptable_prece) > 0) {
                            foreach ($planDossierComptable_prece as $p_d_c):
                                $solde = $p_d_c->getSolde();
                                $calcul_mois = LignepiececomptableTable::getInstance()->calculDebitMoisClasse6_7(trim($p_d_c->getNumerocompte()), $exercice_id);
//                                echo($calcul_mois->getTotalDebit() . 'mm' );
                                if ($p_d_c->getTypesolde() == 1) {
                                    $montantDebitMois = $calcul_mois->getTotalDebit() + $solde;
                                    $montantCreditMois = 0;
                                }
                                if ($p_d_c->getTypesolde() == 2) {
                                    $montantCreditMois = $calcul_mois->getTotalCredit() - $solde;
                                    $montantDebitMois = 0;
                                }
                                $soldeDebit = $montantDebitMois;
                                $soldeCredit = $montantCreditMois;
                                if ($p_d_c->getPlancomptable()->getIdClasse() == 6) {
                                    $solde_debit_classe_6_pre += $soldeDebit;
                                    $solde_credit_classe_6_pre += $soldeCredit;
                                }
                                if ($p_d_c->getPlancomptable()->getIdClasse() == 7) {
                                    $solde_debit_classe_7_pre += $soldeDebit;
                                    $solde_credit_classe_7_pre += $soldeCredit;
                                }
                            endforeach;
                            if ($solde_debit_classe_6_pre < $solde_credit_classe_6_pre) {
                                $resultat_6_credit = $solde_credit_classe_6_pre - $solde_debit_classe_6_pre;
                                $resultat_6_debit = 0;
                            } else {
                                $resultat_6_debit = $solde_debit_classe_6_pre - $solde_credit_classe_6_pre;
                                $resultat_6_credit = 0;
                            }
                            if ($solde_debit_classe_7_pre < $solde_credit_classe_7_pre) {
                                $resultat_7_credit = $solde_credit_classe_7_pre - $solde_debit_classe_7_pre;
                                $resultat_7_debit = 0;
                            } else {
                                $resultat_7_debit = $solde_debit_classe_7_pre - $solde_credit_classe_7_pre;
                                $resultat_7_credit = 0;
                            }
                            $resultat_debit_1 = $solde_debit_classe_7_pre - $solde_debit_classe_6_pre;
                            $resultat_credit_1 = $solde_credit_classe_7_pre - $solde_credit_classe_6_pre;
//                            $resultat = $resultat_debit - $resultat_credit;
                            $resultat_6_pre = $solde_debit_classe_6_pre - $solde_credit_classe_6_pre;
                            $resultat_7_pre = $solde_credit_classe_7_pre - $solde_credit_classe_7_pre;
                            $reultat_exercice_prec = $resultat_7_credit - $resultat_6_debit;
                        }
                    }
                    ?>
                    <td style="text-align: center;">
                        <?php
                        $total_apres_impot_courant = $total_avant_impot_courant - $resultat[1][12]['solde_courant'] - $resultat[1][13]['solde_courant'];
                        if ($total_apres_impot_courant >= 0):
                            echo number_format($total_apres_impot_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_apres_impot_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_apres_impot_prec = $total_avant_impot_prec - $resultat[0][12]['solde_prec'] - $resultat[0][13]['solde_prec'];
                        if ($total_apres_impot_prec >= 0):
                            echo number_format($total_apres_impot_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_apres_impot_prec), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
<!--  <tr style="background-color: #D5D5D5;">
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
                </tr>-->
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
<!--        <input type="hidden" id="resultat_exercice_courant" value="<?php // echo number_format($reultat_exercice_courant, 3, '.', ' ') ?>">
        <input type="hidden" id="resultat_exercice_prec" value="<?php // echo number_format($reultat_exercice_prec, 3, '.', ' ') ?>">-->
        <input type="hidden" id="resultat_exercice_courant_general" value="<?php echo number_format($total_net_courant, 3, '.', ' ') ?>">
        <input type="hidden" id="resultat_exercice_prec_general" value="<?php echo number_format($total_net_prec, 3, '.', ' ') ?>">

        <input type="hidden" value="<?php echo number_format($reultat_exercice_courant, 3, '.', ' ') ?>" id="total_exercie_courant_general">
        <input type="hidden" value="<?php echo number_format($reultat_exercice_prec, 3, '.', ' ') ?>" id="total_exercie_prec_general">

        <table style="margin-bottom: 0px;"><tr><td><a class="btn btn-primary" href="<?php echo url_for('fiche_Bilan/imprimerBilan?type=2'); ?>" target="_blank" style="float: right;"><i class="ace-icon fa fa-print"></i> Imprimer </a></td></tr></table>
    </div>
</div>