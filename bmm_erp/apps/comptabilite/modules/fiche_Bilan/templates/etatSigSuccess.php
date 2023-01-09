<div id="sf_admin_container" ng-controller="myCtrlPaysVille">
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
                    <td style="padding-left: 4%;">Produits d'exploitation</td>
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
                    <td style="padding-left: 4%;">Production Immobilisée</td>
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
                        if (-$sig[0][1]['solde_prec'] >= 0):
                            echo number_format(-$sig[0][1]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[0][1]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">Production</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_production_courant = -($sig[1][0]['solde_courant'] + $sig[1][1]['solde_courant']);
                        if ($total_production_courant >= 0):
                            echo number_format($total_production_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_production_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_production_prec = -($sig[0][0]['solde_prec'] + $sig[0][1]['solde_prec']);
                        if ($total_production_prec >= 0):
                            echo number_format($total_production_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_production_prec), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Coût des matières consommées</td>
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
                        if ($sig[1][2]['solde_courant'] >= 0):
                            echo number_format($sig[1][2]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][2]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[0][2]['solde_prec'] >= 0):
                            echo number_format($sig[0][2]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[0][2]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>                       
                <tr>
                    <td style="padding-left: 4%;">Déstokage de production</td>
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
                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">Achats consommés</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_consomme_courant = ($sig[1][2]['solde_courant'] + $sig[1][3]['solde_courant']);
                        if ($total_consomme_courant >= 0):
                            echo number_format($total_consomme_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_consomme_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_consomme_prec = ($sig[0][2]['solde_prec'] + $sig[0][3]['solde_prec']);
                        if ($total_consomme_prec >= 0):
                            echo number_format($total_consomme_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_consomme_prec), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">Marge sur coût matières</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_marge_courant = ($total_production_courant - $total_consomme_courant);
                        if ($total_marge_courant >= 0):
                            echo number_format($total_marge_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_marge_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_marge_prec = ($total_production_prec - $total_consomme_prec);
                        if ($total_marge_prec >= 0):
                            echo number_format($total_marge_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_marge_prec), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Autres produits d'exploitation</td>
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
                        if (-$sig[1][4]['solde_courant'] >= 0):
                            echo number_format(-$sig[1][4]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][4]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$sig[0][4]['solde_prec'] >= 0):
                            echo number_format(-$sig[0][4]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format($sig[0][4]['solde_prec'], 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>


                <tr>
                    <td style="padding-left: 4%;">Autres charges d'exploitation</td>
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
                    <td style="padding-left: 2%;">VALEUR AJOUTEE BRUTE</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_activite_courant = $total_marge_courant - ($sig[1][4]['solde_courant']) - $sig[1][5]['solde_courant'];
                        if ($total_activite_courant >= 0):
                            echo number_format($total_activite_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_activite_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_activite_prec = $total_marge_prec - ($sig[0][4]['solde_prec']) - $sig[0][5]['solde_prec'];
                        if ($total_activite_prec >= 0):
                            echo number_format($total_activite_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_activite_prec), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 4%;">Impôts et taxes</td>
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
                    <td style="padding-left: 4%;">Charges de personnel</td>
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
                        if ($sig[0][7]['solde_prec'] >= 0):
                            echo number_format($sig[0][7]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[0][7]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">EXCEDENT BRUT D'EXLOITATION</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_exedent_courant = $total_activite_courant - $sig[1][7]['solde_courant'] - $sig[1][6]['solde_courant'];
                        if ($total_exedent_courant >= 0):
                            echo number_format($total_exedent_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_exedent_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_exedent_prec = $total_activite_prec - $sig[0][6]['solde_prec'] - $sig[0][7]['solde_prec'];
                        if ($total_exedent_prec >= 0):
                            echo number_format($total_exedent_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_exedent_prec), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 4%;">Charges financières</td>
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
                        if (-$sig[1][8]['solde_courant'] >= 0):
                            echo number_format(-$sig[1][8]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format($sig[1][8]['solde_courant'], 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$sig[0][8]['solde_prec'] >= 0):
                            echo number_format(-$sig[0][8]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format($sig[0][8]['solde_prec'], 3, '.', ' ') . ')';
                        endif;
                        ?>

                    </td>
                </tr>


                <tr>
                    <td style="padding-left: 4%;">Dotation aux amortissements et aux provisions  </td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[1][9]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[1][9]['param_id']);
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
                        if ($sig[1][9]['solde_courant'] >= 0):
                            echo number_format($sig[1][9]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][9]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[0][9]['solde_prec'] >= 0):
                            echo number_format($sig[0][9]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[0][9]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Produits Financiers</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[1][10]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[1][10]['param_id']);
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
                        if (-$sig[1][10]['solde_courant'] >= 0):
                            echo number_format(-$sig[1][10]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][10]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$sig[0][10]['solde_prec'] >= 0):
                            echo number_format(-$sig[0][10]['solde_prec'], 3, '.', ' ');
                        else:
                            echo number_format(abs($sig[0][10]['solde_prec']), 3, '.', ' ');
                        endif;
                        ?>
                    </td>
                </tr>


                <tr>
                    <td style="padding-left: 4%;">Autres gains ordinaires </td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[1][11]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[1][11]['param_id']);
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
                        if (-$sig[1][11]['solde_courant'] >= 0):
                            echo number_format(-$sig[1][11]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][11]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$sig[0][11]['solde_prec'] >= 0):
                            echo number_format(-$sig[0][11]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[0][11]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 4%;">Autres pertes ordinaires </td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[1][12]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[1][12]['param_id']);
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
                        if (-$sig[1][12]['solde_courant'] >= 0):
                            echo number_format(-$sig[1][12]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][12]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if (-$sig[0][12]['solde_prec'] >= 0):
                            echo number_format(-$sig[0][12]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[0][12]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">RESULTAT DES ACTIVITES AVANT IMPÔT</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_avantimpot_courant = -( $total_exedent_courant - $sig[1][12]['solde_courant'] - $sig[1][11]['solde_courant'] - $sig[1][10]['solde_courant'] - $sig[1][9]['solde_courant'] - $sig[1][8]['solde_courant']);
                        if ($total_avantimpot_courant >= 0):
                            echo number_format($total_avantimpot_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_avantimpot_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_avantimpot_prec =-($total_exedent_prec - $sig[0][12]['solde_prec'] - $sig[0][11]['solde_prec'] - $sig[0][10]['solde_prec'] - $sig[0][9]['solde_prec'] - $sig[0][8]['solde_prec']);
                        if ($total_avantimpot_prec >= 0):
                            echo number_format($total_avantimpot_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_avantimpot_prec), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>


                <tr>
                    <td style="padding-left: 4%;">Impôt sur le résultat ordinaire</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                        <?php if ($sig[1][13]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[1][13]['param_id']);
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
                        if ($sig[1][13]['solde_courant'] >= 0):
                            echo number_format($sig[1][13]['solde_courant'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[1][13]['solde_courant']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($sig[0][13]['solde_prec'] >= 0):
                            echo number_format($sig[0][13]['solde_prec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($sig[0][13]['solde_prec']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                </tr>
                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">RESULTAT NET APRES IMPÔT</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_apres_impot_courant = $total_avantimpot_courant - $sig[1][13]['solde_courant'];
                        if ($total_apres_impot_courant >= 0):
                            echo number_format($total_apres_impot_courant, 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($total_apres_impot_courant), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_apres_impot_prec = $total_avantimpot_prec - $sig[0][13]['solde_prec'];
                        if ($total_apres_impot_prec >= 0):
                            echo number_format($total_apres_impot_prec, 3, '.', ' ');
                        else:
                            echo '(' . number_format($total_apres_impot_prec, 3, '.', ' ') . ')';
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
                        <input class="align_center" type="text" id="controle_exercice_sig_courant" readonly="true">
                    </td>
                    <td style="text-align: center;">
                        <input class="align_center" type="text" id="controle_exercice_sig_prec" readonly="true">

                    </td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" id="resultat_exercice_sig_courant" value="<?php echo number_format($total_net_courant, 3, '.', ' ') ?>">
        <input type="hidden" id="resultat_exercice_sig_prec" value="<?php echo number_format($total_net_prec, 3, '.', ' ') ?>">
        <?php
        $resultat_exerc_net_courant = -$resultat[1][0]['solde_courant'] - $resultat[1][1]['solde_courant'] - $resultat[1][2]['solde_courant'] - ($resultat[1][3]['solde_courant'] + $resultat[1][4]['solde_courant'] + $resultat[1][5]['solde_courant'] + $resultat[1][6]['solde_courant']) - $resultat[1][9]['solde_courant'] - $resultat[1][10]['solde_courant'] - $resultat[1][8]['solde_courant'] - $resultat[1][7]['solde_courant'] + $resultat[1][11]['solde_courant'];
        $resultat_exerc_net_prec = -$resultat[0][0]['solde_prec'] - $resultat[0][1]['solde_prec'] - $resultat[0][2]['solde_prec'] - ($resultat[0][3]['solde_prec'] + $resultat[0][4]['solde_prec'] + $resultat[0][5]['solde_prec'] + $resultat[0][6]['solde_prec']) - $resultat[0][9]['solde_prec'] - $resultat[0][10]['solde_prec'] - $resultat[0][8]['solde_prec'] - $resultat[0][7]['solde_prec'] + $resultat[0][11]['solde_prec'];
        ?>
        <input type="hidden" value="<?php echo number_format($resultat_exerc_net_courant, 3, '.', ' ') ?>" id="total_exercie_sig_courant">
        <input type="hidden" value="<?php echo number_format($resultat_exerc_net_prec, 3, '.', ' ') ?>" id="total_exercie_sig_prec">

        <table style="margin-bottom: 0px;"><tr><td><a class="btn btn-primary" href="<?php echo url_for('fiche_Bilan/imprimerBilan?type=4'); ?>" target="_blank" style="float: right;"><i class="ace-icon fa fa-print"></i> Imprimer </a></td></tr></table>
    </div>
</div>
