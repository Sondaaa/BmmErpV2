<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" id="cmd" class="btn btn-xs btn-success" onclick="exportTableToPdf('PDFcontent', 'note')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter Note
        </button>
    </div>
    <h1 id="replacediv"> 

        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Note</small>
    </h1>


</div>
 <?php
//                $contenue= $param->getContenue();
////                  $content = content.replace(/&nbsp;/g, " ");
//                  $contenue = str_replace("&nbsp;", " ", $contenue);?>
<div class="row">
    <div class="col-sm-12" id="PDFcontent">
         <?php $contenue= $param->getContenue();  
         $contenue1 = str_replace("&nbsp;", " ", $contenue);
                echo $contenue1; ?>
<!--        <table style="margin-bottom: 0px; margin-top: 2px" id="table_plan" border="1">
            <thead><?php $ancien_exercice = $_SESSION['exercice'] - 1;?>
                <tr style="background-color: #0075b0;" class="table-tr">
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
                </tr>
            </thead>
            <tbody id="tblData">-->
               
                
<!--                <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline">
 <legend>Paramétrage : Notes aux Etats Financiers</legend>
                <?php $param = ParametrenoteTable::getInstance()->findByIdDossier($_SESSION['dossier_id'])->getFirst(); ?>
                <div class="wysiwyg-editor" id="editor1">
                    <?php if ($param != null): ?>
                        <?php // echo $param->getContenue(); ?>
                    <?php endif; ?>

                    <h3 class="center"> \\ NOTES AU BILAN //</h3>
                    <?php
                    $annee_prec = $_SESSION['exercice'] - 1;
                    $exerice_prec = ExerciceTable::getInstance()->findOneByLibelle($annee_prec);
                    if (sizeof($exerice_prec) > 1)
                        $id_exercice_prece = $exerice_prec->getId();
                    $strat_from = 1;
                    $actif_1 = calculParametrebilan::getBilan(0);
                    $resultat = calculParametrebilan::getBilan(2);
                    $sig = calculParametrebilan::getBilan(4);
                    $actif = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(0, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
                    $ancien_exercice = $_SESSION['exercice'] - 1;
                    ?>

            <table style=" border: 1px; width: 100%" >
                <tr style="width: 100%">
                    <td> <h1>ACTIF</h1>
                        <h1><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
                            <u>ACTIFS NON COURANTS</u> :
                            <?php $strat_from++; ?>
                        </h1>
                    </td>
                </tr>
                <tr style="width: 100%">
                    <td><h1>  Actifs immobilisés</h1></td>
                </tr>
            </table>
                    <table style=" border: 1px; width: 100%" >
                        <tr style="width: 100%">
                            <td> <h1>ACTIF</h1>
                                <h1><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
                                   <u>ACTIFS NON COURANTS</u> :
                                    <?php $strat_from++; ?>
                                </h1>
                            </td>
                        </tr>
                        <tr style="width: 100%">
                            <td><h1>  Actifs immobilisés</h1></td>
                        </tr>
                    </table>
                    <table style=" border: 1px; width: 100%" border="1">
                        <tr style="width: 100%">
                            <td style="width:70%;height:25px;">&nbsp;</td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
                        </tr>
                        <?php
                        $reg = array();
                        $trouve = 0;
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][0]['param_id']);
                        foreach ($params as $param_compte):
                            $solde_reg = 0;
                            $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][0]['param_id'], $param_compte->getIdCompte());
                            if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                if (count($params_avecregro) == 0) {
                                    ?>
                                    <tr style="width: 100%">
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {
                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }
                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }
                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr style="width: 100%">
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if ($solde_reg >= 0):
                                                    echo number_format($solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if ($solde_reg >= 0):
                                                    echo number_format($solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>
                        <tr>
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif_1[1][0]['solde_courant'] >= 0):
                                    echo number_format($actif_1[1][0]['solde_courant'], 3, '.', ' ');
                                elseif ($actif_1[1][0]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif_1[1][0]['solde_courant']), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                            <td style="text-align:right">
                                <?php
                                $total_incorporel_prec = $actif_1[0][0]['solde_prec'];
                                if ($total_incorporel_prec >= 0):
                                    echo number_format($total_incorporel_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_incorporel_prec, 3, '.', ' ') . ')';
                                endif;
                                ?>    
                            </td>
                        </tr>
                        <tr>
                            <td style="height:25px;"><h3>Moins : amortissements</h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                        </tr>

                        <?php
                        $reg = array();
                        $trouve = 0;
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][1]['param_id']);

                        foreach ($params as $param_compte):
                            if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                $solde_reg = 0;
                                $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][1]['param_id'], $param_compte->getIdCompte());
                                if (count($params_avecregro) == 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {

                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }



                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }

                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if ($solde_reg >= 0):
                                                    echo number_format($solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if ($solde_reg >= 0):
                                                    echo number_format($solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>
                        <tr style="background-color:#F3F3F3;">
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_incorporel_courant = $actif_1[1][0]['solde_courant'] - abs($actif_1[1][1]['solde_courant']);
                                if ($total_incorporel_courant >= 0):
                                    echo number_format($total_incorporel_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_incorporel_courant), 3, '.', ' ') . ')';
                                endif;
                                ?> 
                            </td>
                            <td style="text-align:right">
                                <?php
                                $total_incorporel_prec = $actif_1[0][0]['solde_prec'] - abs($actif_1[0][1]['solde_prec']);

                                if ($total_incorporel_prec >= 0):
                                    echo number_format($total_incorporel_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_incorporel_prec, 3, '.', ' ') . ')';

                                endif;
                                ?> 
                            </td>
                        </tr>
                    </table>
                    <table style=" border: 1px; width: 100%"  border="1">

                        <tr style="background-color: #0075b0;" class="table-tr">
                            <td style="width:70%;height:25px;">&nbsp;</td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
                        </tr>
                        <tr>
                            <td style="height:25px;"><h3>Immobilisations corporelles</h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                        </tr>
                        <?php
                        $reg = array();
                        $trouve = 0;
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][2]['param_id']);

                        foreach ($params as $param_compte):
                            if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                $solde_reg = 0;
                                $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][2]['param_id'], $param_compte->getIdCompte());
                                if (count($params_avecregro) == 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {

                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }



                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }

                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if ($solde_reg >= 0):
                                                    echo number_format($solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if ($solde_reg >= 0):
                                                    echo number_format($solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>

                        <tr>
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif_1[1][2]['solde_courant'] >= 0):
                                    echo number_format($actif_1[1][2]['solde_courant'], 3, '.', ' ');
                                elseif ($actif_1[1][2]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif_1[1][2]['solde_courant']), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                            <td style="text-align:right">
                                <?php
                                $total_incorporel_prec = $actif_1[0][2]['solde_prec'];
                                if ($total_incorporel_prec >= 0):
                                    echo number_format($total_incorporel_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_incorporel_prec, 3, '.', ' ') . ')';
                                endif;
                                ?>    
                            </td>
                        </tr>

                        <tr>
                            <td style="height:25px;"><h3>Amortissement</h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                        </tr>
                        <?php
                        $reg = array();
                        $trouve = 0;
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][3]['param_id']);

                        foreach ($params as $param_compte):
                            if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                $solde_reg = 0;
                                $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][3]['param_id'], $param_compte->getIdCompte());
                                if (count($params_avecregro) == 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {

                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }



                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }

                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if ($solde_reg >= 0):
                                                    echo number_format($solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if ($solde_reg >= 0):
                                                    echo number_format($solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>
                        <tr style="background-color:#F3F3F3;">
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_corporel_courant = $actif_1[1][2]['solde_courant'] - abs($actif_1[1][3]['solde_courant']);
                                if ($total_corporel_courant >= 0):
                                    echo number_format($total_corporel_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_corporel_courant, 3, '.', ' ') . ')';

                                endif;
                                ?> 
                            </td>
                            <td style="text-align:right">
                                <?php
                                $total_corporel_prec = $actif_1[0][2]['solde_prec'] - abs($actif_1[0][3]['solde_prec']);
                                if ($total_corporel_prec >= 0):
                                    echo number_format($total_corporel_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_corporel_prec, 3, '.', ' ') . ')';

                                endif;
                                ?> 
                            </td>
                        </tr>
                    </table>
                    <table style=" border: 1px; width: 100%"  border="1">

                        <tr style="background-color: #0075b0;" class="table-tr">
                            <td style="width:70%;height:25px;">&nbsp;</td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
                        </tr>
                        <tr>
                            <td style="height:25px;"><h3>Immobilisations financières</h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                        </tr>
                        <?php
                        $reg = array();
                        $trouve = 0;
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][4]['param_id']);

                        foreach ($params as $param_compte):
                            if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                $solde_reg = 0;
                                $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][4]['param_id'], $param_compte->getIdCompte());
                                if (count($params_avecregro) == 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {

                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }



                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }

                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if ($solde_reg >= 0):
                                                    echo number_format($solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if ($solde_reg >= 0):
                                                    echo number_format($solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>
                        <tr>
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
                            <td style="text-align: center;">
                                <?php
                                if ($actif_1[1][4]['solde_courant'] >= 0):
                                    echo number_format($actif_1[1][4]['solde_courant'], 3, '.', ' ');
                                elseif ($actif_1[1][4]['solde_courant'] < 0):
                                    echo '(' . number_format(abs($actif_1[1][4]['solde_courant']), 3, '.', ' ') . ')';
                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_incorporel_prec = $actif_1[0][4]['solde_prec'];
                                if ($total_incorporel_prec >= 0):
                                    echo number_format($total_incorporel_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_incorporel_prec, 3, '.', ' ') . ')';
                                endif;
                                ?>    
                            </td>
                        </tr>
                        <tr>
                            <td style="height:25px;"><h3>Provisions</h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                        </tr>
                        <?php
                        $reg = array();
                        $trouve = 0;
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][5]['param_id']);

                        foreach ($params as $param_compte):
                            if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                $solde_reg = 0;
                                $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][5]['param_id'], $param_compte->getIdCompte());
                                if (count($params_avecregro) == 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {

                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }



                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }

                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if ($solde_reg >= 0):
                                                    echo number_format($solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if ($solde_reg >= 0):
                                                    echo number_format($solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>
                        <tr style="background-color:#F3F3F3;">
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_finance_courant = $actif_1[1][4]['solde_courant'] - abs($actif_1[1][5]['solde_courant']);
                                if ($total_finance_courant >= 0):
                                    echo number_format($total_finance_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_finance_courant), 3, '.', ' ') . ')';

                                endif;
                                ?> 
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_finance_prec = $actif_1[0][4]['solde_prec'] - abs($actif_1[0][5]['solde_prec']);
                                if ($total_finance_prec >= 0):
                                    echo number_format($total_finance_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_finance_prec, 3, '.', ' ') . ')';

                                endif;
                                ?> 
                            </td>
                        </tr>

                        <tr  style="background-color:#F3F3F3;">
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total des actifs immobilisés</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_immobilise_courant = $total_incorporel_courant + $total_corporel_courant + $total_finance_courant;
                                if ($total_immobilise_courant >= 0):
                                    echo number_format($total_immobilise_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_immobilise_courant, 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_immobilise_prec = $total_incorporel_prec + $total_corporel_prec + $total_finance_prec;
                                if ($total_immobilise_prec >= 0):
                                    echo number_format($total_immobilise_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_immobilise_prec, 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                    </table>
                    <table style=" border: 1px; width: 100%"  border="1">

                        <tr style="background-color: #0075b0;" class="table-tr">
                            <td style="width:70%;height:25px;">&nbsp;</td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
                        </tr>
                        <tr>
                            <td style="height:25px;"><h3>Autres actifs non courants</h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                        </tr>

                        <?php
                        $reg = array();
                        $trouve = 0;
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][6]['param_id']);

                        foreach ($params as $param_compte):
                            if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                $solde_reg = 0;
                                $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][6]['param_id'], $param_compte->getIdCompte());
                                if (count($params_avecregro) == 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {

                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }



                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }

                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>
                        <tr>
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>TOTAL AUTRES ACTIFS NON COURANTS</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_actif_non_courant_courant = $actif_1[1][6]['solde_courant'];
                                if ($total_actif_non_courant_courant >= 0):
                                    echo number_format($total_actif_non_courant_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_actif_non_courant_courant), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_actif_non_courant_prec = $actif_1[0][6]['solde_prec'];
                                if ($total_actif_non_courant_prec >= 0):
                                    echo number_format($total_actif_non_courant_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_actif_non_courant_prec), 3, '.', ' ') . ')';

                                endif;
                                ?>    
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>TOTAL DES ACTIFS NON COURANTS</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_actif_non_courant_courant = $total_immobilise_courant + $actif_1[1][6]['solde_courant'];
                                if ($total_actif_non_courant_courant >= 0):
                                    echo number_format($total_actif_non_courant_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_actif_non_courant_courant), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_actif_non_courant_prec = $total_immobilise_prec + $actif_1[0][6]['solde_prec'];
                                if ($total_actif_non_courant_prec >= 0):
                                    echo number_format($total_actif_non_courant_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_actif_non_courant_prec), 3, '.', ' ') . ')';

                                endif;
                                ?>    
                            </td>
                        </tr>
                    </table>
                    <table class="center"  >
                        <tr>
                            <td>
                                <h1><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
                                        <u>ACTIFS COURANTS</u> :
                                    <?php $strat_from++; ?>
                                </h1>
                            </td>
                        </tr>
                    </table>
                    <table style=" border: 1px; width: 100%"  border="1">

                        <tr style="background-color: #0075b0;" class="table-tr">
                            <td style="width:70%;height:25px;">&nbsp;</td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
                        </tr>
                        <tr>
                            <td style="height:25px;"><h3>Stocks</h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                        </tr>
                        <?php
                        $reg = array();
                        $trouve = 0;
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][7]['param_id']);

                        foreach ($params as $param_compte):
                            if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                $solde_reg = 0;
                                $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][7]['param_id'], $param_compte->getIdCompte());
                                if (count($params_avecregro) == 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {

                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }



                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }

                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>   
                        <tr>
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_stock_courant_burt = $actif_1[1][7]['solde_courant'];
                                if ($total_stock_courant_burt >= 0):
                                    echo number_format($total_stock_courant_burt, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_stock_courant_burt), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_stock_prec_burt = $actif_1[0][7]['solde_prec'];
                                if ($total_stock_prec_burt >= 0):
                                    echo number_format($total_stock_prec_burt, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_stock_prec_burt), 3, '.', ' ') . ')';

                                endif;
                                ?>    
                            </td>
                        </tr>
                        <tr>
                            <td style="height:25px;"><h3>Provisions</h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                        </tr>
                        <?php
                        $reg = array();
                        $trouve = 0;
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][8]['param_id']);

                        foreach ($params as $param_compte):
                            if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                $solde_reg = 0;
                                $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][8]['param_id'], $param_compte->getIdCompte());
                                if (count($params_avecregro) == 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {

                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }



                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }

                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>  

                        <tr style="background-color:#F3F3F3;">
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_stock_courant = $actif_1[1][7]['solde_courant'] - abs($actif_1[1][8]['solde_courant']);
                                if ($total_stock_courant >= 0):
                                    echo number_format($total_stock_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_stock_courant, 3, '.', ' ') . ')';

                                endif;
                                ?> 
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_stock_prec = $actif_1[0][7]['solde_prec'] - abs($actif_1[0][8]['solde_prec']);
                                if ($total_stock_prec >= 0):
                                    echo number_format($total_stock_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_stock_prec, 3, '.', ' ') . ')';

                                endif;
                                ?> 
                            </td>
                        </tr>
                    </table>
                    <table style=" border: 1px; width: 100%"  border="1">

                        <tr style="background-color: #0075b0;" class="table-tr">
                            <td style="width:70%;height:25px;">&nbsp;</td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
                        </tr>
                        <tr>
                            <td style="height:25px;"><h3>Clients et comptes rattachés</h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                            <?php
                            $reg = array();
                            $trouve = 0;
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][9]['param_id']);

                            foreach ($params as $param_compte):
                                if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                    $solde_reg = 0;
                                    $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][9]['param_id'], $param_compte->getIdCompte());
                                    if (count($params_avecregro) == 0) {
                                        ?>
                                    <tr>
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {

                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }



                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }

                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>  

                        <tr>
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_client_courant_burt = $actif_1[1][9]['solde_courant'];
                                if ($total_client_courant_burt >= 0):
                                    echo number_format($total_client_courant_burt, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_client_courant_burt), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_client_prec_burt = $actif_1[0][9]['solde_prec'];
                                if ($total_client_prec_burt >= 0):
                                    echo number_format($total_client_prec_burt, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_client_prec_burt), 3, '.', ' ') . ')';

                                endif;
                                ?>    
                            </td>
                        </tr>
                        <tr>
                            <td style="height:25px;"><h3>Provisions</h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                        </tr>
                        <?php
                        $reg = array();
                        $trouve = 0;
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][10]['param_id']);

                        foreach ($params as $param_compte):
                            if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                $solde_reg = 0;
                                $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][10]['param_id'], $param_compte->getIdCompte());
                                if (count($params_avecregro) == 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {

                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }



                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }

                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>  
                        <tr style="background-color:#F3F3F3;">
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_client_courant = $actif_1[1][9]['solde_courant'] - abs($actif_1[1][10]['solde_courant']);
                                if ($total_client_courant >= 0):
                                    echo number_format($total_client_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_client_courant, 3, '.', ' ') . ')';

                                endif;
                                ?> 
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_client_prec = $actif_1[0][9]['solde_prec'] - abs($actif_1[0][10]['solde_prec']);
                                if ($total_client_prec >= 0):
                                    echo number_format($total_client_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_client_prec, 3, '.', ' ') . ')';

                                endif;
                                ?> 
                            </td>
                        </tr>
                    </table>
                    <table style=" border: 1px; width: 100%"  border="1">

                        <tr style="background-color: #0075b0;" class="table-tr">
                            <td style="width:70%;height:25px;">&nbsp;</td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
                        </tr>
                        <tr>
                            <td style="height:25px;"><h3>Autres actifs courants</h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                        </tr>
                        <?php
                        $reg = array();
                        $trouve = 0;
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][11]['param_id']);

                        foreach ($params as $param_compte):
                            if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                $solde_reg = 0;
                                $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][11]['param_id'], $param_compte->getIdCompte());
                                if (count($params_avecregro) == 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {

                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }



                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }

                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>  

                        <tr>
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_stock_courant_burt = $actif_1[1][11]['solde_courant'];
                                if ($total_stock_courant_burt >= 0):
                                    echo number_format($total_stock_courant_burt, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_stock_courant_burt), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_stock_prec_burt = $actif_1[0][11]['solde_prec'];
                                if ($total_stock_prec_burt >= 0):
                                    echo number_format($total_stock_prec_burt, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_stock_prec_burt), 3, '.', ' ') . ')';

                                endif;
                                ?>    
                            </td>
                        </tr>
                        <tr>
                            <td style="height:25px;"><h3>Provisions</h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                        </tr>
                        <?php
                        $reg = array();
                        $trouve = 0;
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][12]['param_id']);

                        foreach ($params as $param_compte):
                            if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                $solde_reg = 0;
                                $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][12]['param_id'], $param_compte->getIdCompte());
                                if (count($params_avecregro) == 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {

                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }



                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }

                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>  
                        <tr>
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_stock_courant_burt = $actif_1[1][11]['solde_courant'] - $actif_1[1][12]['solde_courant'];
                                if ($total_stock_courant_burt >= 0):
                                    echo number_format($total_stock_courant_burt, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_stock_courant_burt), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_stock_prec_burt = $actif_1[0][11]['solde_prec'] - $actif_1[0][12]['solde_prec'];
                                if ($total_stock_prec_burt >= 0):
                                    echo number_format($total_stock_prec_burt, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_stock_prec_burt), 3, '.', ' ') . ')';

                                endif;
                                ?>    
                            </td>
                        </tr>
                    </table>
                    <table style=" border: 1px; width: 100%"  border="1">

                        <tr style="background-color: #0075b0;" class="table-tr">
                            <td style="width:70%;height:25px;">&nbsp;</td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
                            <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
                        </tr>
                        <tr>
                            <td style="height:25px;"><h3>Placements et Autres Actifs Financiers</h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                        </tr>
                        <?php
                        $reg = array();
                        $trouve = 0;
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][13]['param_id']);

                        foreach ($params as $param_compte):
                            if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                $solde_reg = 0;
                                $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][13]['param_id'], $param_compte->getIdCompte());
                                if (count($params_avecregro) == 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {

                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }



                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }

                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>  
                        <tr>
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_stock_courant_burt = $actif_1[1][13]['solde_courant'];
                                if ($total_stock_courant_burt >= 0):
                                    echo number_format($total_stock_courant_burt, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_stock_courant_burt), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_stock_prec_burt = $actif_1[1][13]['solde_prec'];
                                if ($total_stock_prec_burt >= 0):
                                    echo number_format($total_stock_prec_burt, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_stock_prec_burt), 3, '.', ' ') . ')';

                                endif;
                                ?>    
                            </td>
                        </tr>
                        <tr>
                            <td style="height:25px;"><h3>Liquidités et équivalents de liquidités</h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                        </tr>
                        <?php
                        $reg = array();
                        $trouve = 0;
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][14]['param_id']);

                        foreach ($params as $param_compte):
                            if ($param_compte->getPlandossiercomptable()->getSolde() != 0):
                                $solde_reg = 0;
                                $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupementbycompte($actif_1[1][14]['param_id'], $param_compte->getIdCompte());
                                if (count($params_avecregro) == 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                        <td style="text-align:right;height:25px;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                            endif;
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                } else {

                                    $chaine_regroupement = '';
                                    $solde_reg = 0;
                                    $trouve = 0;

                                    foreach ($params_avecregro as $params_avecregro_compte):
                                        $solde_reg += $params_avecregro_compte->getPlandossiercomptable()->getSolde();
                                        for ($i = 0; $i < sizeof($reg); $i++) {
                                            if ($reg[$i] == trim($params_avecregro_compte->getRegrouppement())) {
                                                $trouve = 1;
                                            }
                                        }



                                        if ($trouve == 0) {
                                            $chaine_regroupement = $params_avecregro_compte->getRegrouppement();
                                            $reg[sizeof($reg)] = trim($params_avecregro_compte->getRegrouppement());
                                        }

                                    endforeach;

                                    if ($trouve == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo trim($params_avecregro_compte->getRegrouppement()); ?>  </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if (-$solde_reg >= 0):
                                                    echo number_format(-$solde_reg, 3, '.', ' ');
                                                else:
                                                    echo '(' . number_format(abs($solde_reg), 3, '.', ' ') . ')';
                                                endif;
                                                ?>
                                            </td>

                                        </tr>    
                                        <?php
                                    }
                                }
                            endif;
                        endforeach;
                        ?>  
                        <tr style="background-color:#F3F3F3;">
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_liqu_courant = $actif_1[1][13]['solde_courant'] - abs($actif_1[1][14]['solde_courant']);
                                if ($total_liqu_courant >= 0):
                                    echo number_format($total_liqu_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_liqu_courant), 3, '.', ' ') . ')';

                                endif;
                                ?> 
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_liqu_prec = $actif_1[0][13]['solde_prec'] - abs($actif_1[0][14]['solde_prec']);
                                if ($total_liqu_prec >= 0):
                                    echo number_format($total_liqu_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format(abs($total_liqu_prec), 3, '.', ' ') . ')';

                                endif;
                                ?> 
                            </td>
                        </tr>
                        <tr style="background-color: #D5D5D5;">
                            <td   style="text-align:center;font-weight:bold;height:25px;" ><h3>TOTAL DES ACTIFS COURANTS</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_actif_courant_courant = $total_stock_courant + $total_client_courant + $actif_1[1][13]['solde_courant'] + $actif_1[1][14]['solde_courant'];
                                if ($total_actif_courant_courant >= 0):
                                    echo number_format($total_actif_courant_courant, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_actif_courant_courant, 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_actif_courant_prec = $total_stock_prec + $total_client_prec + $actif_1[0][13]['solde_prec'] + $actif_1[0][14]['solde_prec'];
                                if ($total_actif_courant_prec >= 0):
                                    echo number_format($total_actif_courant_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_actif_courant_prec, 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr style="background-color: #D5D5D5;">
                            <td style="text-align:center;font-weight:bold;height:25px;"><h3>TOTAL DES ACTIFS</h3></td>
                            <td style="text-align: center;">
                                <?php
                                $total_courant_1 = $total_actif_courant_courant + $total_actif_non_courant_courant;
                                if ($total_courant_1 >= 0):
                                    echo number_format($total_courant_1, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_courant_1, 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $total_prec = $total_actif_courant_prec + $total_actif_non_courant_prec;
                                if ($total_prec >= 0):
                                    echo number_format($total_prec, 3, '.', ' ');
                                else:
                                    echo'(' . number_format($total_prec, 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>

                        </tr>
                    </table>
                    </div>-->
            <!--</tbody>-->

        <!--</table>-->
    </div>
</div>
<!--<script type="text/javascript">
    function exportTableToPdf() {
        $(function () {
            var specialElementHandlers = {
                '#editor': function (element,renderer) {
                    return true;
                }
            };
         $('#cmd').click(function () {
                var doc = new jsPDF();
                doc.fromHTML($('#PDFcontent').html(), 15, 15, {
                    'width': 170,'elementHandlers': specialElementHandlers
                });
                doc.save('sample-file.pdf');
            });  
        }); 
    }
</script>-->
<script type="text/javascript">
//     function printDiv({PDFcontent, test}) {
//  let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');
//
//  mywindow.document.write(`<html><head><title>${title}</title>`);
//  mywindow.document.write('</head><body >');
//  mywindow.document.write(document.getElementById(divId).innerHTML);
//  mywindow.document.write('</body></html>');
//
//  mywindow.document.close(); // necessary for IE >= 10
//  mywindow.focus(); // necessary for IE >= 10*/
//
//  mywindow.print();
//  mywindow.close();
//
//  return true;
//}
        function exportTableToPdf() {
            var content = $("#PDFcontent").html();
//           content = content.replace("&nbsp;", '');
            content.innerHTML = content;
            content = content.textContent;
            content.textContent = '';
            var pdf = new jsPDF('p', 'pt', 'letter');
            // source can be HTML-formatted string, or a reference
            // to an actual DOM element from which the text will be scraped.
            source = content;

            // we support special element handlers. Register them with jQuery-style 
            // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
            // There is no support for any other type of selectors 
            // (class, of compound) at this time.
            specialElementHandlers = {
                // element with id of "bypass" - jQuery style selector
                '#bypassme': function(element, renderer) {
                    // true = "handled elsewhere, bypass text extraction"
                    return true
                }
            };
            margins = {
                top: 80,
                bottom: 60,
                left: 20,
                width: 522
            };
            // all coords and widths are in jsPDF instance's declared units
            // 'inches' in this case
            pdf.fromHTML(
                    source, // HTML string or DOM elem ref.
                    margins.left, // x coord
                    margins.top, {// y coord
                        'width': margins.width, // max width of content on PDF
                        'elementHandlers': specialElementHandlers
                    },
            function(dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }
            , margins);
        }
    </script>