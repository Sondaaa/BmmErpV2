<div id="sf_admin_container">
    <h1 id="replacediv">Etat des Flux de Trésorerie (Flux MA)</h1>
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
                    <td style="padding-left: 2%;" colspan="4">Flux de trésorerie liés à l'exploitation</td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Résultat net</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[0]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[0]['param_id']);
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
                        if ($flux[0]['solde_courant'] != 0)
                            echo number_format($flux[0]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[0]['solde_prec'] != 0)
                            echo number_format($flux[0]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Ajustements pour</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[1]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[1]['param_id']);
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
                        if ($flux[1]['solde_courant'] != 0)
                            echo number_format($flux[1]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[1]['solde_prec'] != 0)
                            echo number_format($flux[1]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Amortissements et provisions</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[2]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[2]['param_id']);
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
                        if ($flux[2]['solde_courant'] != 0)
                            echo number_format($flux[2]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[2]['solde_prec'] != 0)
                            echo number_format($flux[2]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Variation des :</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                </tr>
                <tr>
                    <td style="padding-left: 8%;">- Stocks</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[3]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[3]['param_id']);
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
                        if ($flux[3]['solde_courant'] != 0)
                            echo number_format($flux[3]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[3]['solde_prec'] != 0)
                            echo number_format($flux[3]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 8%;">- Créances</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[4]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[4]['param_id']);
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
                        if ($flux[4]['solde_courant'] != 0)
                            echo number_format($flux[4]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[4]['solde_prec'] != 0)
                            echo number_format($flux[4]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 8%;">- Fournisseurs et autres dettes</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[5]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[5]['param_id']);
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
                        if ($flux[5]['solde_courant'] != 0)
                            echo number_format($flux[5]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[5]['solde_prec'] != 0)
                            echo number_format($flux[5]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Plus ou moins values de cession</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[6]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[6]['param_id']);
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
                        if ($flux[6]['solde_courant'] != 0)
                            echo number_format($flux[6]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[6]['solde_prec'] != 0)
                            echo number_format($flux[6]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 6%;">Transfert de charges</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[7]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[7]['param_id']);
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
                        if ($flux[7]['solde_courant'] != 0)
                            echo number_format($flux[7]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[7]['solde_prec'] != 0)
                            echo number_format($flux[7]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">Flux de trésorerie liés à l'exploitation</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_exploi_courant = $flux[0]['solde_courant'] + $flux[1]['solde_courant'] + $flux[2]['solde_courant'] - $flux[3]['solde_courant'] - $flux[4]['solde_courant'] - $flux[5]['solde_courant'] + $flux[6]['solde_courant'] + $flux[7]['solde_courant'];
                        if ($total_exploi_courant != 0)
                            echo number_format($total_exploi_courant, 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_exploi_prec = $flux[0]['solde_prec'] + $flux[1]['solde_prec'] + $flux[2]['solde_prec'] - $flux[3]['solde_prec'] - $flux[4]['solde_prec'] - $flux[5]['solde_prec'] + $flux[6]['solde_prec'] + $flux[7]['solde_prec'];
                        if ($total_exploi_prec != 0)
                            echo number_format($total_exploi_prec, 3, '.', ' ');
                        ?>
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 2%;">Flux de trésorerie liés aux activités d'investissement</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Acquisitions d'immobilisations</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[8]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[8]['param_id']);
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
                        if ($flux[8]['solde_courant'] != 0)
                            echo number_format($flux[8]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[8]['solde_prec'] != 0)
                            echo number_format($flux[8]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Cessions d'immobilisations</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[9]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[9]['param_id']);
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
                        if ($flux[9]['solde_courant'] != 0)
                            echo number_format($flux[9]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[9]['solde_prec'] != 0)
                            echo number_format($flux[9]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Acquisitions d'immobilisations financières</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[10]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[10]['param_id']);
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
                        if ($flux[10]['solde_courant'] != 0)
                            echo number_format($flux[10]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[10]['solde_prec'] != 0)
                            echo number_format($flux[10]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Cessions d'immobilisations financières</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[11]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[11]['param_id']);
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
                        if ($flux[11]['solde_courant'] != 0)
                            echo number_format($flux[11]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[11]['solde_prec'] != 0)
                            echo number_format($flux[11]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">Flux de trésorerie liés aux activités d'investissement</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <?php
                        $total_activite_courant = $flux[8]['solde_courant'] - $flux[9]['solde_courant'] + $flux[10]['solde_courant'] + $flux[11]['solde_courant'];
                        if ($total_activite_courant != 0)
                            echo number_format($total_activite_courant, 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_activite_prec = $flux[8]['solde_prec'] - $flux[9]['solde_prec'] + $flux[10]['solde_prec'] + $flux[11]['solde_prec'];
                        if ($total_activite_prec != 0)
                            echo number_format($total_activite_prec, 3, '.', ' ');
                        ?>
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 2%;">Flux de trésorerie liés aux activités de financement</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Encaissements suite à l'émission de parts sociales</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[12]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[12]['param_id']);
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
                        if ($flux[12]['solde_courant'] != 0)
                            echo number_format($flux[12]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[12]['solde_prec'] != 0)
                            echo number_format($flux[12]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Distribution dividendes</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[13]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[13]['param_id']);
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
                        if ($flux[13]['solde_courant'] != 0)
                            echo number_format($flux[13]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[13]['solde_prec'] != 0)
                            echo number_format($flux[13]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Encaissements provenant des emprunts</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[14]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[14]['param_id']);
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
                        if ($flux[14]['solde_courant'] != 0)
                            echo number_format($flux[14]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[14]['solde_prec'] != 0)
                            echo number_format($flux[14]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Remboursements d'emprunts</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[15]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[15]['param_id']);
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
                        if ($flux[15]['solde_courant'] != 0)
                            echo number_format($flux[15]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[15]['solde_prec'] != 0)
                            echo number_format($flux[15]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;" colspan="2">Flux de trésorerie liés aux activités de financement</td>
                    <td style="text-align: center;">
                        <?php
                        $total_finance_courant = $flux[12]['solde_courant'] - $flux[13]['solde_courant'] + $flux[14]['solde_courant'] - $flux[15]['solde_courant'];
                        if ($total_finance_courant != 0)
                            echo number_format($total_finance_courant, 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_finance_prec = $flux[12]['solde_prec'] - $flux[13]['solde_prec'] + $flux[14]['solde_prec'] - $flux[15]['solde_prec'];
                        if ($total_finance_prec != 0)
                            echo number_format($total_finance_prec, 3, '.', ' ');
                        ?>
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 4%;">Incidence des variations des taux de change sur les</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[16]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[16]['param_id']);
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
                        if ($flux[16]['solde_courant'] != 0)
                            echo number_format($flux[16]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[16]['solde_prec'] != 0)
                            echo number_format($flux[16]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">liquidités et équivalents de liquidités</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[17]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[17]['param_id']);
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
                        if ($flux[17]['solde_courant'] != 0)
                            echo number_format($flux[17]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[17]['solde_prec'] != 0)
                            echo number_format($flux[17]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;" colspan="2">Variation de trésorerie</td>
                    <td style="text-align: center;">
                        <?php
                        $total_variation_courant = $flux[19]['solde_courant'] - $flux[18]['solde_courant'];
                        if ($total_variation_courant != 0)
                            echo number_format($total_variation_courant, 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_variation_prec = $flux[19]['solde_prec'] - $flux[18]['solde_prec'];
                        if ($total_variation_prec != 0)
                            echo number_format($total_variation_prec, 3, '.', ' ');
                        ?>
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 4%;">Trésorerie au début de l'exercice</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[18]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[18]['param_id']);
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
                        if ($flux[18]['solde_courant'] != 0)
                            echo number_format($flux[18]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[18]['solde_prec'] != 0)
                            echo number_format($flux[18]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Trésorerie à la clôture de l'exercice</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_3">
                        <?php if ($flux[19]['param_id'] != ''): ?>
                            <?php
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[19]['param_id']);
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
                        if ($flux[19]['solde_courant'] != 0)
                            echo number_format($flux[19]['solde_courant'], 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($flux[19]['solde_prec'] != 0)
                            echo number_format($flux[19]['solde_prec'], 3, '.', ' ');
                        ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;" colspan="2">Variation de trésorerie</td>
                    <td style="text-align: center;">
                        <?php
                        $total_variation_courant = $flux[19]['solde_courant'] - $flux[18]['solde_courant'];
                        if ($total_variation_courant != 0)
                            echo number_format($total_variation_courant, 3, '.', ' ');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_variation_prec = $flux[19]['solde_prec'] - $flux[18]['solde_prec'];
                        if ($total_variation_prec != 0)
                            echo number_format($total_variation_prec, 3, '.', ' ');
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <table style="margin-bottom: 0px;"><tr><td><a class="btn btn-primary" href="<?php echo url_for('fiche_Bilan/imprimerBilan?type=3'); ?>" target="_blank" style="float: right;"><i class="ace-icon fa fa-print"></i> Imprimer </a></td></tr></table>
    </div>
</div>