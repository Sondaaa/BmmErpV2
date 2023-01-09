<div style="margin-bottom: 15px;">
    <table class="table table-bordered table-hover" id="myTable01">
        <thead>
            <tr>
                <th style="text-align: center; width: 9%;">Numéro</th>
                <th style="width: 65%;">Intitulé du Compte</th>
                <th style="width: 13%;">Débiteur </th>
                <th style="width: 13%;">Créditeur</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $dossier_comptable = DossiercomptableTable::getInstance()->findAll()->getFirst();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT CONCAT('<tr><td>', TRIM(plandossiercomptable.numerocompte), '</td><td>', "
                    . "TRIM(plandossiercomptable.libelle), '</td><td>', "
                    . "CASE WHEN  plandossiercomptable.solde>=0 THEN plandossiercomptable.solde ELSE null END, "
                    . "'</td><td>', CASE WHEN plandossiercomptable.solde<0 THEN (-1 *  plandossiercomptable.solde) ELSE null END, "
                    . "'</td></tr>') as ligne"
                    . " FROM plandossiercomptable, plancomptable, classecompte"
                    . " WHERE plandossiercomptable.id_dossier = " . $_SESSION['dossier_id'] . " AND id_exercice = " . $_SESSION['exercice_id']
                    . " AND plandossiercomptable.id_plan = plancomptable.id AND plancomptable.id_classe = classecompte.id"
                    . " AND plancomptable.id_classe <> 6 AND plancomptable.id_classe <> 7"
                    . " AND Length(plandossiercomptable.numerocompte)>= 7"
                    . " ORDER BY plandossiercomptable.numerocompte";
            $compte = $conn->fetchAssoc($query);
            ?>
            <?php
            echo implode('', array_map(function ($entry) {
                        return $entry['ligne'];
                    }, $compte));
            ?>
            <?php
            $debit_6 = 0;
            $credit_6 = 0;
            $debit_7 = 0;
            $credit_7 = 0;
            ?>
            <?php $comptes_6 = PlandossiercomptableTable::getInstance()->loadByInterval('60000000', '69999999', $_SESSION['dossier_id'], $_SESSION['exercice_id']); ?>
            <?php
            $resutat_6_credit = 0;
            $resultat_6_debit = 0;
            foreach ($comptes_6 as $compte_6):
                if ($compte_6->getSolde() > 0):
                    $debit_6 = ($compte_6->getSolde());
                    $resultat_6_debit+=$debit_6;
                endif;
                if ($compte_6->getSolde() < 0):
                    $credit_6 = $compte_6->getSolde();
                    $resutat_6_credit+=$credit_6;
                endif;
                ?>

            <?php endforeach; ?>
            <tr style="background-color: #FEFFD8;">

                <td><?php echo 'Resultat Classe 6' ?></td>
                <td><?php // echo trim($compte_6->getLibelle());            ?></td>

                <?php if ($resultat_6_debit + $resutat_6_credit > 0):
                    ?>
                    <td>
                        <?php echo ''; ?>
                    </td>
                    <td>
                        <?php echo number_format($resultat_6_debit + $resutat_6_credit, 3, '.', ' '); ?>
                    </td>
                <?php else: ?>
                    <td>
                        <?php echo number_format(abs($resultat_6_debit + $resutat_6_credit), 3, '.', ' '); ?>
                    </td>
                    <td>
                        <?php echo ''; ?>
                    </td>
                <?php endif; ?>

            </tr>

            <?php $comptes_7 = PlandossiercomptableTable::getInstance()->loadByInterval('70000000', '79999999', $_SESSION['dossier_id'], $_SESSION['exercice_id']); ?>
            <?php
            $resutat_7_credit = 0;
            $resultat_7_debit = 0;
            foreach ($comptes_7 as $compte_7):
                if ($compte_7->getSolde() > 0):
                    $debit_7 = ($compte_7->getSolde());
                    $resultat_7_debit+=$debit_7;
                endif;
                if ($compte_7->getSolde() <= 0):
                    $credit_7 = $compte_7->getSolde();
                    $resutat_7_credit+=$credit_7;
                endif;
                ?>

            <?php endforeach; ?>
            <tr style="background-color: #FFECC6;">
                <td><?php echo 'Resultat Classe 7'  // echo trim($compte_7->getNumerocompte());            ?></td>
                <td><?php // echo trim($compte_7->getLibelle());            ?></td>

                <?php if ($resultat_7_debit + $resutat_7_credit > 0):
                    ?>
                    <td><?php echo ''; ?></td>
                    <td>
                        <?php echo number_format($resultat_7_debit + $resutat_7_credit, 3, '.', ' '); ?>
                    </td>
                <?php else: ?>
                    <td>
                        <?php echo number_format(abs($resultat_7_debit + $resutat_7_credit), 3, '.', ' '); ?>
                    </td>
                    <td> <?php echo ''; ?> </td>

                <?php endif; ?>
            </tr>
        </tbody>
    </table>
    <?php $total_debit = ''; ?>
    <?php
    $total_credit = '';
    $result7 = $resultat_7_debit + $resutat_7_credit;
    $result6 = $resultat_6_debit + $resutat_6_credit;
    ?>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="width: 74%;">Reporter le solde sous le compte comptable</th>
                <th style="width: 13%;">Débiteur</th>
                <th style="width: 13%;">Créditeur</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select id="compte" style="width: 100%;">
                        <?php
                        $exerci_suiv = $_SESSION['exercice'] + 1;
                        $query_excerci_suiv = "select exercice.id as id "
                                . "from exercice,dossierexercice  "
                                . "WHERE dossierexercice.id_exercice = exercice.id "
                                . "And exercice.libelle='" . trim($exerci_suiv) . "'"
                                . "AND exercice.id in (select id_exercice from dossierexercice where id_dossier =" . $_SESSION['dossier_id'] . ")"
                        ;

                        $resultat_exerice = $conn->fetchAssoc($query_excerci_suiv);
                        $id_eerice_suiv = $resultat_exerice[0]['id'];
                        if ($_SESSION['dossier_id'] == 1)
                            $comptes = PlandossiercomptableTable::getInstance()->findAll();
                        else
                            $comptes = PlandossiercomptableTable::getInstance()->loadReportNouveau($_SESSION['dossier_id'], $id_eerice_suiv);
                        ?>
                        <?php foreach ($comptes as $compte): ?>
                            <option value="<?php echo $compte->getId() ?>"> <?php echo $compte->getNumeroCompte() . ' - ' . $compte->getLibelle() ?> </option>
                        <?php endforeach; ?>
                    </select>

                </td>
                <?php if ($result7 + $result6 >= 0): ?>
                    <td style="text-align: center" id="total_debiteur">
                        <?php echo number_format(($result7 + $result6), 3, '.', ' '); ?>
                    </td>
                    <td style="text-align: center" id="total_crediteur">  <?php echo '0'; ?></td>
                <?php else: ?>
                    <td style="text-align: center" id="total_debiteur">
                        <?php echo '0'; ?>
                    </td>
                    <td style="text-align: center" id="total_crediteur">
                        <?php echo number_format(abs($result7 + $result6), 3, '.', ' '); ?>
                    </td>
                <?php endif; ?>

            </tr>
        </tbody>
    </table>
</div>
<?php
if ($result7 + $result6 > 0) {
    $total_debit = $result7 + $result6;
} else
    $total_credit = $result7 + $result6;
//if (abs($resultat_7_debit - $resultat_6_debit) > abs($resutat_7_credit - $resutat_6_credit)):
//$total_debit =  number_format(abs(abs($resultat_7_debit - $resultat_6_debit) - abs($resutat_7_credit - $resutat_6_credit)), 3, '.', ' ');
//endif;
//if (abs($resultat_7_debit - $resultat_6_debit) <=abs($resutat_7_credit - $resutat_6_credit)):
//$total_credit = abs($resutat_7_credit -$resutat_6_credit);
//endif;
//die($total_debit.'debit'.$total_credit.'credit');
?>
<input type="hidden" id="total_debit" value="<?php echo $total_debit; ?>"/>
<input type="hidden" id="total_credit" value="<?php echo $total_credit; ?>"/>
<div class="row">
    <button style="float: right; margin-right: 1%;" class="btn btn-primary" onclick="saveReport()"><i class="ace-icon fa fa-save"></i> Enregistrer</button>
</div>

<script  type="text/javascript">

    $('#compte').chosen({allow_single_deselect: true});
    $("#myTable01 tr td:nth-child(3)").css('text-align', 'right');
    $("#myTable01 tr td:nth-child(4)").css('text-align', 'right');

</script>