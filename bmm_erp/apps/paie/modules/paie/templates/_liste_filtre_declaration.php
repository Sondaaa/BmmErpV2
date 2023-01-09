<div id="my-modalDecalarationFiltre" class="modal fade" tabindex="-1">
    <div id="sf_admin_container">
        <div class="modal-dialog" style="width: 900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="smaller lighter blue no-margin">
                        Liste de Fiche De Déclaration Trimestrielle :<br>
                        <?php $societe = Doctrine_Core::getTable('societe')->findOneById(1); ?>
                        <ul style="margin-top: 10px;">
                            <?php $trimestre_table = array("1" => "1ére Trimestre ", "2" => "2éme Trimestre", "3" => "3éme Trimestre", "4" => "4éme Trimestre", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre"); ?>
                            <?php if ($trimestre != ''): ?>
                                <li>Période "<?php echo $trimestre_table[$trimestre]; ?>"</li>
                            <?php endif; ?>
                            <?php if ($annee_declaration != ''): ?>
                                <li>En "<?php echo $annee_declaration; ?>"</li>
                            <?php endif; ?>
                            <?php if ($codesociale != ''): ?>
                                <?php $lignecodesoc = LignecodesocialeTable::getInstance()->findOneById($codesociale); ?>
                                <li> "<?php echo $lignecodesoc->getCodesociale()->getLibelle() . ": " . $lignecodesoc->getTaux() . " %"; ?>"</li>
                            <?php endif; ?>
                        </ul>
                    </h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <table class="dynamic-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%">N°</th>
                                    <?php // if ($societe->getTypecotisation() == 1): ?>
                                        <!--<th style="width: 10%">N° CNSS</th>-->
                                    <?php // endif; ?>
                                    <?php // if ($societe->getTypecotisation() == 2): ?>
                                        <!--<th style="width: 10%">N° CNRPS</th>-->
                                    <?php // endif; ?>
                                    <?php
                                    if ($codesociale != ''):
                                        $Csociale = Doctrine_Core::getTable('lignecodesociale')->findOneById($codesociale);
                                        ?>
                                        <th style="width: 10%">N° <?php echo $Csociale->getCodesociale()->getLibelle() ?></th>
                                    <?php endif; ?>
                                    <th style="width: 20%" >Agents</th>
                                    <th style="width: 5%">Matricule</th>
                                    <th style="width: 20%">Qualification<br></th> 
                                    <th style="width: 5% ; text-align: center">1° Mois</th> 
                                    <th style="width: 5% ;text-align: center">2°Mois</th> 
                                    <th style="width: 5% ;text-align: center">3° Mois</th>
                                    <th style="width: 20%; text-align: center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ligne_societe = Doctrine_Core::getTable('lignesociete')->findAll();
                                $ligne_societe_3 = Doctrine_Core::getTable('lignesociete')->findByMoiscalendiarle('3');
                                if ($ligne_societe_3) {
                                    $code_mois_attache_3 = '';
                                    foreach ($ligne_societe_3 as $ligne):
                                        $code_mois_attache_3 = $code_mois_attache_3 . ' OR p.mois = ' . $ligne->getCodemois();
                                    endforeach;
                                }
                                $ligne_societe_6 = Doctrine_Core::getTable('lignesociete')->findByMoiscalendiarle('6');
                                if ($ligne_societe_6) {
                                    $code_mois_attache_6 = '';
                                    foreach ($ligne_societe_6 as $ligne):
                                        $code_mois_attache_6 = $code_mois_attache_6 . ' OR p.mois = ' . $ligne->getCodemois();
                                    endforeach;
                                }
                                $ligne_societe_9 = Doctrine_Core::getTable('lignesociete')->findByMoiscalendiarle('9');
                                if ($ligne_societe_9) {
                                    $code_mois_attache_9 = '';
                                    foreach ($ligne_societe_9 as $ligne):
                                        $code_mois_attache_9 = $code_mois_attache_9 . ' OR p.mois = ' . $ligne->getCodemois();
                                    endforeach;
                                }
                                $ligne_societe_12 = Doctrine_Core::getTable('lignesociete')->findByMoiscalendiarle('12');
                                if ($ligne_societe_12) {
                                    $code_mois_attache_12 = '';
                                    foreach ($ligne_societe_12 as $ligne):
                                        $code_mois_attache_12 = $code_mois_attache_12 . ' OR p.mois = ' . $ligne->getCodemois();
                                    endforeach;
                                }
                                $min_mois = 0;
                                $max_mois = 0;
                                $q = Doctrine_Query::create()
                                        ->select('p.*')
                                        ->from('paie p,agents a')
                                        ->where('p.id_agents=a.id');
                                if ($annee_declaration != '')
                                    $q = $q->andWhere('p.annee= ?', $annee_declaration);
                                if ($codesociale != '')
                                    $q = $q->andWhere('p.id_lignecodesociale= ?', $codesociale);

                                if ($trimestre == '1' && sizeof($ligne_societe_3) > 0):
                                    $q = $q->andWhere('(p.mois=1 OR p.mois=2 OR p.mois=3)');
                                    $min_mois = 0;
                                    $max_mois = 3;
                                elseif ($trimestre == '1' && sizeof($ligne_societe_3) == 0):
                                    $q = $q->andWhere('(p.mois=1 OR p.mois=2 OR p.mois=3 ' . $code_mois_attache_3 . ')');
                                    $min_mois = 0;
                                    $max_mois = 3;
                                endif;
                                if ($trimestre == '2' && sizeof($ligne_societe_6) > 0):
                                    $q = $q->andWhere('(p.mois=4 OR p.mois=5 OR p.mois=6 ' . $code_mois_attache_6 . ')');
                                    $min_mois = 3;
                                    $max_mois = 6;
                                elseif ($trimestre == '2' && sizeof($ligne_societe_6) == 0):
                                    $q = $q->andWhere('(p.mois=4 OR p.mois=5 OR p.mois=6)');
                                    $min_mois = 3;
                                    $max_mois = 6;
                                endif;
                                if ($trimestre == '3' && sizeof($ligne_societe_9) > 0):
                                    $q = $q->andWhere('(p.mois=7 OR p.mois=8 OR p.mois=9 ' . $code_mois_attache_9 . ')');
                                    $min_mois = 6;
                                    $max_mois = 9;
                                elseif ($trimestre == '3' && sizeof($ligne_societe_9) == 0):
                                    $q = $q->andWhere('(p.mois=7 OR p.mois=8 OR p.mois=9 )');
                                    $min_mois = 6;
                                    $max_mois = 9;
                                endif;
                                if ($trimestre == '4'):
                                    $q = $q->andWhere('(p.mois=10 OR p.mois=11 OR p.mois=12 ' . $code_mois_attache_12 . ')');
                                    $min_mois = 9;
                                    $max_mois = 12;
                                endif;
                                $q->orderBy('p.id_agents, p.mois');
                                $listes = $q->execute();
                                ?>
                                <?php
                                $i = 1;
                                $mois = $min_mois;
                                $id_agents = '';
                                $total_agent = 0;
                                ?>
                                <?php if (sizeof($listes) > 0): ?>
                                    <?php foreach ($listes as $li): ?>
                                        <?php if ($id_agents != $li->getIdAgents()): ?>
                                            <?php if ($id_agents != ""): ?>
                                                <?php if ($mois < $max_mois): ?>
                                                    <?php while ($mois < $max_mois): ?>
                                                    <td style="width: 10%"  id="total_<?php echo $li->getIdAgents(); ?>_<?php echo $mois ?>"></td>
                                                    <?php $mois++; ?>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                            <td>
                                                <?php echo number_format($total_agent, 3, '.', ' '); ?>
                                                <input type="hidden" name="total_agent" value="<?php echo number_format($total_agent, 3, '.', ' ') ?>">
                                            </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endif; ?>
                                        <?php $id_agents = $li->getIdAgents(); ?>
                                        <?php $total_agent = 0; ?>
                                        <?php $mois = $min_mois; ?>
                                        <tr>
                                            <td style="width: 5%"><?php echo $i; ?></td>
                                            <td><?php echo $li->getContrat()->getIdunique(); ?></td>
                                            <td>
                                                <?php echo $li->getAgents()->getNomcomplet() . " " . $li->getAgents()->getPrenom(); ?>
                                                <input type="hidden" name="agent_id" value="<?php echo $li->getAgents()->getId() ?>">
                                                <input type="hidden" name="contrat_agent_id" value="<?php echo $li->getContrat()->getId() ?>">
                                            </td>
                                            <td><?php echo $li->getAgents()->getIdrh() ?></td>
                                            <td style="width: 10%"><?php echo $li->getContrat()->getSalairedebase()->getGrade(); ?></td>

                                            <?php while ($mois < $li->getMois() - 1): ?>
                                                <td id="total_<?php echo $li->getIdAgents(); ?>_<?php echo $mois ?>"></td>
                                                <?php $mois++; ?>
                                            <?php endwhile; ?>
                                            <?php if ($li->getMois() <= $max_mois): ?>
                                                <td style="width: 10%" id="total_<?php echo $li->getIdAgents(); ?>_<?php echo $li->getMois() ?>"><?php echo $li->getSalairebrut(); ?> </td>
                                                <?php $total_agent = $total_agent + $li->getSalairebrut(); ?>
                                            <?php else: ?>
                                            <script>
                                                var total = parseFloat($("#total_<?php echo $li->getIdAgents(); ?>_<?php echo $max_mois ?>").html()) + parseFloat('<?php echo $li->getBrutprime(); ?>');
                                                $("#total_<?php echo $li->getIdAgents(); ?>_<?php echo $max_mois ?>").html(parseFloat(total).toFixed(3));</script>
                                            <?php $total_agent = $total_agent + $li->getBrutprime(); ?>
                                        <?php endif; ?>

                                    <?php else: ?>
                                        <?php
                                        if ($max_mois > $li->getMois()):
                                            $vide_td = $li->getMois() - 1;
                                        else:
                                            $vide_td = $max_mois - 1;
                                        endif;
                                        ?>
                                        <?php while ($mois < $vide_td): ?>
                                            <td id="total_<?php echo $li->getIdAgents(); ?>_<?php echo $mois ?>"></td>
                                            <?php $mois++; ?>
                                        <?php endwhile; ?>


                                        <?php if ($li->getMois() <= $max_mois): ?>
                                            <td id="total_<?php echo $li->getIdAgents(); ?>_<?php echo $li->getMois() ?>" style="width: 10%"><?php echo $li->getSalairebrut(); ?> </td>
                                            <?php $total_agent = $total_agent + $li->getSalairebrut(); ?>
                                        <?php else: ?>
                                            <script>
                                                var total = parseFloat($("#total_<?php echo $li->getIdAgents(); ?>_<?php echo $max_mois ?>").html()) + parseFloat('<?php echo $li->getBrutprime(); ?>');
                                                $("#total_<?php echo $li->getIdAgents(); ?>_<?php echo $max_mois ?>").html(parseFloat(total).toFixed(3));</script>
                                            <?php $total_agent = $total_agent + $li->getBrutprime(); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php $mois++; ?>
                                <?php endforeach; ?>
                                <?php if ($mois < $max_mois): ?>
                                    <?php while ($mois < $max_mois): ?>
                                        <td style="width: 10%" id="total_<?php echo $li->getIdAgents(); ?>_<?php echo $mois ?>"></td>

                                        <?php $mois++; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>

                                <td id="total_<?php echo $li->getIdAgents(); ?>">
                                    <?php echo number_format($total_agent, 3, '.', ' '); ?>
                                    <input type="hidden" name="total_agent" value="<?php echo number_format($total_agent, 3, '.', ' ') ?>">
                                </td>
                                </tr>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <table><tbody><tr><td style="text-align: center">Pas d'historique de Déclaration Trimestrielle</td></tr></tbody></table>
                        <?php endif; ?>
                    </fieldset>

                    <div class="modal-footer">
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" style="margin-right: 2px">
                                Imprimer Fiches 
                                <i class="ace-icon fa fa-angle-down"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-success dropdown-menu-left">
                                <li>
                                    <a target="_blanc" href="<?php echo url_for('paie/ImprimerAlllisteAllFilterDeclaration?trimestre=' . $trimestre . '&annee_declaration=' . $annee_declaration . '&codesociale=' . $codesociale) ?>">Imprimer Déclaration Trimestrielle</a>
                                </li>
                                <?php if ($lignecodesoc->getIdCodesoc() == 1): ?>
                                    <li>
                                        <a target="_blanc" href="<?php echo url_for('paie/ImprimerAlllisteAllFilterEtatrecap?trimestre=' . $trimestre . '&annee_declaration=' . $annee_declaration . '&codesociale=' . $codesociale . '&annee_session=' . $annee_session) ?>">ETAT RECAPITULATIF CNSS</a>
                                    </li>
                                <?php endif; ?>
                            </ul>

                            <a type="button" value="Save Fichier.txt" style="margin-right: 3px"id="btnfil" style="margin-right: 8px" class="btn btn-success" onclick="savetxt()">Save Fichier.txt</a>
                            <a type="button" value="Fermer" id="btn1" class="btn pull-right"   onclick="fermerJournalPaieFiltre()">Fermer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("table").addClass("table  table-bordered table-hover");
    function fermerJournalPaieFiltre()
    {
        $('#my-modalDecalarationFiltre').removeClass('in');
        $('#my-modalDecalarationFiltre').css('display', 'none');
    }
    //save Fichier  txt 

    function  savetxt() {
        var ids = '';
        $('[name="agent_id"]').each(function () {
            ids = ids + $(this).val() + ',,';
        });
        var totaux = '';
        $('[name="total_agent"]').each(function () {
            totaux = totaux + $(this).val() + ';';
        });
        $.ajax({
            url: '<?php echo url_for('paie/savetxt') ?>',
            data: 'ids=' + ids + '&totaux=' + totaux +
                    '&trimestre=<?php echo $trimestre ?>' +
                    '&annee=<?php echo $annee_declaration ?>',
            success: function (data) {
//                $('#zone_modal_Paie').html(data);
//                $('#my-modalPaieFiltre').addClass('in');
//                $('#my-modalPaieFiltre').css('display', 'block');
            }
        });
    }

</script>