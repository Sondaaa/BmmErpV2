<div id="sf_admin_container">
    <h1 id="replacediv">Etat du Solde Intermediaire de Gestion (SIG)</h1>
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
                    <td style="padding-left: 4%;">Ventes de marchandises et autres produits d'exploitation</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[1][0]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[1][0]['param_id']);
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
                        if (-$sig[1][0]['solde_courant'] >= 0):
                            echo number_format(-$sig[1][0]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][0]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$sig[0][0]['solde_prec'] >= 0):
                            echo number_format(-$sig[0][0]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[0][0]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Coût d'achat des marchandises vendus</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[1][1]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[1][1]['param_id']);
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
                        if (-$sig[1][1]['solde_courant'] >= 0):
                            echo number_format(-$sig[1][1]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][1]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$sig[1][1]['solde_prec'] >= 0):
                            echo number_format(-$sig[1][1]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][1]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">MARGE COMMERCIALE</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_commercial_courant = -($sig[1][0]['solde_courant'] + $sig[1][1]['solde_courant']);
                        if ($total_commercial_courant >= 0):
                            echo number_format($total_commercial_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_commercial_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_commercial_prec = -($sig[0][0]['solde_prec'] + $sig[0][1]['solde_prec']);
                        if ($total_commercial_prec >= 0):
                            echo number_format($total_commercial_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_commercial_prec), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 4%;">Revenus et autres produits d'exploitation</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[1][2]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[1][2]['param_id']);
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
                        if (-$sig[1][2]['solde_courant'] >= 0):
                            echo number_format(-$sig[1][2]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][2]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$sig[1][2]['solde_prec'] >= 0):
                            echo number_format($sig[2]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[2]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>                       
                <tr>
                    <td style="padding-left: 4%;">Production stockée</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[1][3]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[1][3]['param_id']);
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
                        if ($sig[1][3]['solde_courant'] >= 0):
                            echo number_format($sig[1][3]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][3]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[0][3]['solde_prec'] >= 0):
                            echo number_format($sig[0][3]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[0][3]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Production immobilisée</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[1][4]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[1][4]['param_id']);
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
                        if ($sig[1][4]['solde_courant'] >= 0):
                            echo number_format($sig[1][4]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][4]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[0][4]['solde_prec'] >= 0):
                            echo number_format($sig[0][4]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format($sig[0][4]['solde_prec'], 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">PRODUCTION DE L'EXERCICE</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_production_courant = $total_commercial_courant - ($sig[1][2]['solde_courant'] + $sig[1][3]['solde_courant'] + $sig[1][4]['solde_courant']);
                        if ($total_production_courant >= 0):
                            echo number_format($total_production_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_production_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_production_prec = $total_commercial_prec - ($sig[0][2]['solde_prec'] + $sig[0][3]['solde_prec'] + $sig[0][4]['solde_prec']);
                        if ($total_production_prec >= 0):
                            echo number_format($total_production_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_production_prec), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 4%;">Achats consommés</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[1][5]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[1][5]['param_id']);
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
                        if ($sig[1][5]['solde_courant'] >= 0):
                            echo number_format($sig[1][5]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][5]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[0][5]['solde_prec'] >= 0):
                            echo number_format($sig[0][5]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[0][5]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">ACTIVITE TOTALE</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_activite_courant = $total_production_courant - $sig[1][5]['solde_courant'];
                        if ($total_activite_courant >= 0):
                            echo number_format($total_activite_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_activite_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_activite_prec = $total_production_prec - $sig[0][5]['solde_prec'];
                        if ($total_activite_prec >= 0):
                            echo number_format($total_activite_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_activite_prec), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 4%;">Marge brute totale</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[1][6]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[1][6]['param_id']);
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
                        if ($sig[1][6]['solde_courant'] >= 0):
                            echo number_format($sig[1][6]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format($sig[1][6]['solde_courant'], 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[0][6]['solde_prec'] >= 0):
                            echo number_format($sig[0][6]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[0][6]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Subvention d'éxploitation</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[1][7]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[1][7]['param_id']);
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
                        if ($sig[1][7]['solde_courant'] >= 0):
                            echo number_format($sig[1][7]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][7]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sigc[7]['solde_prec'] >= 0):
                            echo number_format($sig[1][7]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][7]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Autres charges externes</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[1][8]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[1][8]['param_id']);
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
                        if ($sig[1][8]['solde_courant'] >= 0):
                            echo number_format($sig[1][8]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format($sig[1][8]['solde_courant'], 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[0][8]['solde_prec'] >= 0):
                            echo number_format($sig[0][8]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format($sig[0][8]['solde_prec'], 3, '.', ' ') . ')';
                        endif;
                        ?>
                        ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">VALEUR AJOUTEE BRUTE</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_ajoute_courant = $sig[1][6]['solde_courant'] - $sig[1][7]['solde_courant'] - $sig[1][8]['solde_courant'];
                        if ($total_ajoute_courant >= 0):
                            echo number_format($total_ajoute_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_ajoute_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_ajoute_prec = $sig[0][6]['solde_prec'] - $sig[0][7]['solde_prec'] - $sig[0][8]['solde_prec'];
                        if ($total_ajoute_prec >= 0):
                            echo number_format($total_ajoute_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_ajoute_prec), 3, '.', ' ') . ')';

                        endif;
                        ?>
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 4%;">Cessions d'immobilisations Impôts et taxes</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[9]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[9]['param_id']);
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
                        if ($sig[9]['solde_courant'] != 0)
                            echo number_format($sig[9]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[9]['solde_prec'] != 0)
                            echo number_format($sig[9]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Charges de personnel</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[10]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[10]['param_id']);
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
                        if ($sig[10]['solde_courant'] != 0)
                            echo number_format($sig[10]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[10]['solde_prec'] != 0)
                            echo number_format($sig[10]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">EXCEDENT BRUT D'EXLOITATION</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_exedent_courant = $total_ajoute_courant - $sig[9]['solde_courant'] - $sig[10]['solde_courant'];
                        if ($total_exedent_courant != 0)
                            echo number_format($total_exedent_courant, 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_exedent_prec = $total_ajoute_prec - $sig[9]['solde_prec'] - $sig[10]['solde_prec'];
                        if ($total_exedent_prec != 0)
                            echo number_format($total_exedent_prec, 3, '.', ' ');
                        ?>
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 4%;">Produits financièrs nets</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[11]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[11]['param_id']);
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
                        if ($sig[11]['solde_courant'] != 0)
                            echo number_format($sig[11]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[11]['solde_prec'] != 0)
                            echo number_format($sig[11]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Produits des placements</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[12]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[12]['param_id']);
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
                        if ($sig[12]['solde_courant'] != 0)
                            echo number_format($sig[12]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[12]['solde_prec'] != 0)
                            echo number_format($sig[12]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Autres gains ordinaires</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[13]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[13]['param_id']);
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
                        if ($sig[13]['solde_courant'] != 0)
                            echo number_format($sig[13]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[13]['solde_prec'] != 0)
                            echo number_format($sig[13]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Autres pertes ordinaires</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[14]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[14]['param_id']);
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
                        if ($sig[14]['solde_courant'] != 0)
                            echo number_format($sig[14]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[14]['solde_prec'] != 0)
                            echo number_format($sig[14]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Transfert et reprise de charges</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[15]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[15]['param_id']);
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
                        if ($sig[15]['solde_courant'] != 0)
                            echo number_format($sig[15]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[15]['solde_prec'] != 0)
                            echo number_format($sig[15]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Dotation aux amortissements et aux provisions</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[16]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[16]['param_id']);
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
                        if ($sig[16]['solde_courant'] != 0)
                            echo number_format($sig[16]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[16]['solde_prec'] != 0)
                            echo number_format($sig[16]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Impôt sur le résultat ordinaire</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[17]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[17]['param_id']);
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
                        if ($sig[17]['solde_courant'] != 0)
                            echo number_format($sig[17]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[17]['solde_prec'] != 0)
                            echo number_format($sig[17]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">RESULTAT DES ACTIVITES ORDINAIRES</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_ordinaire_courant = $total_exedent_courant + $sig[13]['solde_courant'] - $sig[11]['solde_courant'] - $sig[12]['solde_courant'] - $sig[14]['solde_courant'] - $sig[15]['solde_courant'] - $sig[16]['solde_courant'] - $sig[17]['solde_courant'];
                        if ($total_ordinaire_courant != 0)
                            echo number_format($total_ordinaire_courant, 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_ordinaire_prec = $total_exedent_prec + $sig[13]['solde_prec'] - $sig[11]['solde_prec'] - $sig[12]['solde_prec'] - $sig[14]['solde_prec'] - $sig[15]['solde_prec'] - $sig[16]['solde_prec'] - $sig[17]['solde_prec'];
                        if ($total_ordinaire_prec != 0)
                            echo number_format($total_ordinaire_prec, 3, '.', ' ');
                        ?>
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 4%;">Eléments extraordinaires net d'impôt</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[18]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[18]['param_id']);
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
                        if ($sig[18]['solde_courant'] != 0)
                            echo number_format($sig[18]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[18]['solde_prec'] != 0)
                            echo number_format($sig[18]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Effets des modifications comptables net d'impôt</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[19]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[19]['param_id']);
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
                        if ($sig[19]['solde_courant'] != 0)
                            echo number_format($sig[19]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[19]['solde_prec'] != 0)
                            echo number_format($sig[19]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;" colspan="2">Résultat net après modifications comptables</td>
                    <td style="text-align: center;">
                        <?php
                        $total_net_courant = $total_ordinaire_courant + $sig[18]['solde_courant'] + $sig[19]['solde_courant'];
                        if ($total_net_courant != 0)
                            echo number_format($total_net_courant, 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_net_prec = $total_ordinaire_prec + $sig[18]['solde_prec'] + $sig[19]['solde_prec'];
                        if ($total_net_prec != 0)
                            echo number_format($total_net_prec, 3, '.', ' ');
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="margin-bottom: 0px;"><tr><td><a class="btn btn-primary" href="<?php echo url_for('fiche_Bilan/imprimerBilan?type=4'); ?>" target="_blank" style="float: right;"><i class="ace-icon fa fa-print"></i> Imprimer </a></td></tr></table>
    </div>
</div>