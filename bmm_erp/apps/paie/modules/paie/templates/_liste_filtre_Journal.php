<div id="my-modalJournalPaieFiltre" class="modal fade" tabindex="-1">
    <div id="sf_admin_container">
        <div class="modal-dialog" style="width: 1200px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="smaller lighter blue no-margin">
                        Liste des Fiches de Journal de Paie :<br>
                        <ul style="margin-top: 10px;">
                            <?php $array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre"); ?>

                            <?php if ($mois_journalepaie != '' && $mois_journalepaie <= 12): ?>
                                <li>En "<?php echo $array[$mois_journalepaie]; ?>"</li>
                            <?php endif; ?>
                            <?php if ($mois_journalepaie != '' && $mois_journalepaie > 12): ?>
                                <?php $ligne = Doctrine_Core::getTable('lignesociete')->findOneByCodemois($mois_journalepaie); ?>
                                <li>En  <?php echo $ligne->getLibelle() . " "; ?> </li>
                            <?php endif; ?>
                            <?php if ($annee_journalpaie != ''): ?>
                                <li>En "<?php echo $annee_journalpaie; ?>"</li>
                            <?php endif; ?>
                            <?php
                            if ($id_codesociale != '' && $id_codesocialeF == ''):
                                $codesociale = Doctrine_Core::getTable('lignecodesociale')->findOneById($id_codesociale);
                                ?>     
                                <li> "<?php echo $codesociale->getLibelle() . " - " . $codesociale->getCodesociale()->getLibelle() . " " . $codesociale->getTaux() . " %"; ?>"</li>
                            <?php endif; ?>
                            <?php
                            if ($id_codesociale == '' && $id_codesocialeF != ''):
                                $codesociale = Doctrine_Core::getTable('lignecodesociale')->findOneById($id_codesocialeF);
                                ?>     
                                <li> "<?php echo $codesociale->getLibelle() . " - " . $codesociale->getCodesociale()->getLibelle() . " " . $codesociale->getTaux() . " %"; ?>"</li>
                            <?php endif; ?>
                            <?php
                            if ($id_codesociale != '' && $id_codesocialeF != ''):
                                $codesocialeF = Doctrine_Core::getTable('lignecodesociale')->findOneById($id_codesocialeF);
                                $codesociale = Doctrine_Core::getTable('lignecodesociale')->findOneById($id_codesociale);
                                ?>     
                                <li> Entre "<?php echo $codesociale->getLibelle() . " - " . $codesociale->getCodesociale()->getLibelle() . ": " . $codesociale->getTaux() . " %"; ?>"
                                    ET "<?php echo $codesocialeF->getLibelle() . " - " . $codesocialeF->getCodesociale()->getLibelle() . ": " . $codesocialeF->getTaux() . " %"; ?>" </li>
                            <?php endif; ?>
                        </ul>
                    </h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%">N°</th>
                                    <th style="width: 5%">Mat.</th>
                                    <th style="width: 15%">Agents</th>
                                    <th style="width: 5%">Png</th> 
                                    <th style="width: 5%">Fér<br></th> 
                                    <th style="width: 5%">Cong</th> 
                                    <th style="width: 7%">Sal.Brut</th> 
                                    <th style="width: 5%">C.Sociale</th> 
                                    <th style="width: 6%">Mnt.Sociale</th>
                                    <th style="width: 7%">Sal.Imp</th>
                                    <th style="width: 6%">I.R.P.P</th>
                                    <th style="width: 6%">CSS1%</th>
                                    <th style="width: 8%">Net à Payer </th> 
                                    <th style="width: 15%">Mois</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ligne_societe = Doctrine_Core::getTable('lignesociete')->findAll();
                                $q = Doctrine_Query::create()
                                        ->select('p.*')
                                        ->from('paie p,agents a')
                                        ->where('p.id_agents=a.id');

                                if ($mois_journalepaie != ''):
                                    $trouve = 0;
                                    foreach ($ligne_societe as $lign) :
                                        if ($mois_journalepaie == $lign->getMoiscalendiarle() && $mois_journalepaie != 12):
                                            $trouve = 1;
                                            $ligne = Doctrine_Core::getTable('lignesociete')->findOneByMoiscalendiarle($mois_journalepaie);
                                            if ($ligne)
                                                $q = $q->andWhere('(p.mois= ' . $ligne->getCodemois() . ' OR p.mois=' . $mois_journalepaie . ')');
                                        endif;
                                    endforeach;
                                    $mois_condition = '';
                                    if ($trouve == 0)
                                        $mois_condition = 'p.mois= ' . $mois_journalepaie;
                                    if ($mois_journalepaie == 12) {
                                        $ligne_2 = Doctrine_Core::getTable('lignesociete')->findByMoiscalendiarle($mois_journalepaie);

                                        foreach ($ligne_2 as $lg):
                                            //$q = $q->orWhere('p.mois= ' . $lg->getCodemois());
                                            if ($mois_condition == '')
                                                $mois_condition = 'p.mois= ' . $lg->getCodemois();
                                            else
                                                $mois_condition = $mois_condition . ' OR ' . 'p.mois= ' . $lg->getCodemois();
                                        endforeach;

                                        if ($mois_condition != '') {
                                            $mois_condition = '(' . $mois_condition . ')';
                                        }
                                    }
                                    if ($mois_condition != '')
                                        $q = $q->andWhere($mois_condition);
                                endif;
                                if ($annee_journalpaie != '')
                                    $q = $q->andWhere('p.annee= ?', $annee_journalpaie);
                                if ($id_codesociale != '' && $id_codesocialeF == '')
                                    $q = $q->andWhere('p.id_lignecodesociale= ?', $id_codesociale);
                                if ($id_codesociale == '' && $id_codesocialeF != '')
                                    $q = $q->andWhere('p.id_lignecodesociale= ?', $id_codesocialeF);


                                if ($id_codesociale != '' && $id_codesocialeF != '') {
                                    $q = $q->andWhere('p.id_lignecodesociale >= ?', $id_codesociale);
                                    $q = $q->andWhere('p.id_lignecodesociale < ?', $id_codesocialeF);
                                }
                                $q = $q->orderBy('p.mois');
                                $listes = $q->execute();
                                ?>
                                <?php if (sizeof($listes) > 0): ?>
                                    <?php $i = 1; ?>
                                    <?php foreach ($listes as $li): ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $li->getAgents()->getIdrh() ?></td>
                                            <td><?php echo $li->getAgents()->getNomcomplet() . " " . $li->getAgents()->getPrenom(); ?></td>
                                            <td style="text-align: right">
                                                <?php
                                                if ($li->getMois() <= 12):
                                                    echo $li->getNbrjtravaille() . " J";
                                                else:
                                                    echo $li->getNbrjtravaille();
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align: right">
                                                <?php
                                                if ($li->getMois() <= 12):
                                                    echo $li->getNbrjf() . " J";
                                                else:
                                                    echo $li->getNbrjf();
                                                endif;
                                                ?>
                                            </td>
                                            <td style="text-align: right"><?php if ($li->getMois() <= 12): ?>
                                                    <?php echo $li->getNbrjconge() . " J"; ?> 
                                                <?php else: ?>
                                                    <?php echo $li->getNbrjconge(); ?> 
                                                <?php endif; ?>
                                            </td>
                                            <?php if ($li->getMois() <= 12): ?>
                                                <td style="text-align: right"><?php echo $li->getSalairebrut(); ?> </td>
                                            <?php else: ?>
                                                <td style="text-align: right"><?php echo $li->getBrutprime(); ?> </td>
                                            <?php endif; ?>
                                            <td><?php echo $li->getCodesociale()->getLibelle(); ?></td>
                                            <td style="text-align: right"><?php echo $li->getMontantsocialemensuel(); ?></td>
                                            <td style="text-align: right"><?php echo $li->getSalaireimposable(); ?></td>
                                            <td style="text-align: right"><?php echo $li->getMontantirpp(); ?></td>
                                            <td style="text-align: right"><?php echo $li->getContribitionsociale(); ?></td>
                                            <td style="text-align: right"><?php echo $li->getNetapayyer(); ?></td>
                                            <td>
                                                <?php
                                                if ($li->getMois() <= 12):
                                                    echo $array[$li->getMois()];
                                                elseif ($li->getMois() > 12):
                                                    $ligne = Doctrine_Core::getTable('lignesociete')->findOneByCodemois($li->getMois());
                                                    if ($ligne)
                                                        echo $ligne->getLibelle();
                                                endif;
                                                ?>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="14" style="text-align: center">Pas d'historique du Journal de paie </td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <a type="button" target="_blanc" style="margin-right: 2px" class="btn btn-success" href="<?php echo url_for('paie/ImprimerAlllisteAllFilterJournalPaie?mois=' . $mois_journalepaie . '&annee=' . $annee_journalpaie . '&id_codesociale=' . $id_codesociale . '&id_codesocialeF=' . $id_codesocialeF) ?>">Imprimer Journal de Paie</a>
                    <a type="button" value="Fermer" id="btn1" class="btn pull-right" onclick="fermerJournalPaieFiltre()">Fermer</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $("table").addClass("table table-bordered table-hover");
    function fermerJournalPaieFiltre() {
        $('#my-modalJournalPaieFiltre').removeClass('in');
        $('#my-modalJournalPaieFiltre').css('display', 'none');
    }

</script>