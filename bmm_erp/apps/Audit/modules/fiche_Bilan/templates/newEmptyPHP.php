<!--  <?php // if ($param_compte->getRegrouppement() != ''): ?>
                                        <tr><td>
                                                <?php echo $param_compte->getRegrouppement(); ?>
                                            </td>
                                            <td style="text-align:right;height:25px;">
                                                <?php
                                                if (-$passif[1][0]['solde_courant'] >= 0):
                                                    echo number_format(-$passif[1][0]['solde_courant'], 3, '.', ' ');
                                                elseif (-$passif[1][0]['solde_courant'] < 0):
                                                    echo '(' . number_format(abs(-$passif[1][0]['solde_courant']), 3, '.', ' ') . ')';

                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php
                                                if (-$passif[0][0]['solde_prec'] >= 0):
                                                    echo number_format(-$passif[0][0]['solde_prec'], 3, '.', ' ');
                                                elseif (-$passif[0][0]['solde_prec'] < 0):
                                                    echo '(' . number_format(abs(-$passif[0][0]['solde_prec']), 3, '.', ' ') . ')';

                                                endif;
                                                ?>

                                            </td>
                                        </tr>
                                    <?php // else: ?>
                                  -->
                                   <?php
                        $passif = calculParametrebilan::getBilan(1);
                        if ($passif[1][0]['param_id'] != ''):
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[1][0]['param_id']);
                            foreach ($params as $param_compte):
                                if ($param_compte->getType() == 1):
                                    ?>
                                    <?php // if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                                    <?php // if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>
                                    <tr>
                                        <td>
                                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                                        </td>
                                        <td style="text-align:right;height:25px;">

                                            <?php
                                            if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                                echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                                            endif;
                                            ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php
                                            if ((-$param_compte->getPlandossiercomptable()->getSoldeouv() ) >= 0):
                                                echo number_format(- $param_compte->getPlandossiercomptable()->getSoldeouv(), 3, '.', ' ');
                                            else:
                                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSoldeouv()), 3, '.', ' ') . ')';

                                            endif;
                                            ?>

                                        </td>

                                    </tr>

                                <?php endif; ?>
                                <?php // endif; ?>
                                <?php // endif; ?>     
                                <?php // endif; ?>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </table>