<div id="my-modalPaieFiltre" class="modal fade" tabindex="-1">
    <div id="sf_admin_container">
        <div class="modal-dialog" style="width: 900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="smaller lighter blue no-margin">
                        Liste des Fiches de Paie :<br>
                        <ul style="margin-top: 10px;">
                            <?php
                            $array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai"
                                , "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre",
                                "11" => "Nouvembre", "12" => "Décembre");
                            ?>
                            <?php if ($idAg != ''): ?>
                                <?php $agents = Doctrine_Core::getTable('agents')->findOneById($idAg); ?>
                                <li>De  "<?php echo $agents->getNomcomplet() . " " . $agents->getPrenom(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($idAgF != ''): ?>
                                <?php $ag = Doctrine_Core::getTable('agents')->findOneById($idAgF); ?>
                                <li> Au "<?php echo $ag->getNomcomplet() . " " . $ag->getPrenom(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($mois != '' && $mois <= 12): ?>
                                <li>En "<?php echo $array[$mois]; ?>"</li>
                            <?php endif; ?>
                            <?php if ($mois != '' && $mois > 12): ?>
                                <?php $ligne = Doctrine_Core::getTable('lignesociete')->findOneByCodemois($mois); ?>
                                <li>En  <?php echo $ligne->getLibelle() . " "; ?> </li>
                            <?php endif; ?>
                            <?php if ($annee != ''): ?>
                                <li>En "<?php echo $annee; ?>"</li>
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
                                    <th>Agents</th>
                                    <th>S. Base</th> 
                                    <th>S. Brut<br></th> 
                                    <th>S. Imposable</th> 
                                    <th>Net à Payer </th> 
                                    <th>Mois</th> 
                                    <th>Année</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $q = Doctrine_Query::create()
                                        ->select('p.*')
                                        ->from('paie p,agents a')
                                        ->where('p.id_agents=a.id');

                                if ($idAg != '' && $idAgF == null)
                                    $q = $q->andWhere('a.id= ?', $idAg)
                                    ;
                                if ($idAgF != '' && $idAg == null)
                                    $q = $q->andWhere('a.id= ?', $idAgF);
                                if ($idAgF != '' && $idAg != '') {
                                    $q = $q->andWhere('a.id >= ?', $idAg);
                                    $q = $q->andWhere('a.id < ?', $idAgF);
                                }
                                if ($mois != '')
                                    $q = $q->andWhere('p.mois= ?', $mois);
                                if ($annee != '')
                                    $q = $q->andWhere('p.annee= ?', $annee);
                                $q = $q->orderBy('p.mois');
                                $listes = $q->execute();
                                ?>
                                <?php if (sizeof($listes) > 0): ?>
                                    <?php $i = 1; ?>
                                    <?php foreach ($listes as $li): ?>
                                        <tr>
                                            <td style="width: 5%"><?php echo $i; ?></td>
                                            <td><?php echo $li->getAgents()->getNomcomplet() . " " . $li->getAgents()->getPrenom(); ?></td>
                                            <td style="width: 10%"><?php echo $li->getSalairedebase(); ?></td>
                                            <?php if ($li->getMois() <= 12): ?>
                                                <td style="width: 10%"><?php echo $li->getSalairebrut(); ?></td>
                                            <?php else: ?>
                                                <td style="width: 10%"><?php echo $li->getBrutprime(); ?></td>
                                            <?php endif; ?>
                                            <td style="width: 10%"><?php echo $li->getSalaireimposable(); ?></td>
                                            <td><?php echo $li->getNetapayyer(); ?></td>
                                            <td>
                                                <?php
                                                if ($li->getMois() <= 12):
                                                    echo $array[$li->getMois()];
                                                elseif ($li->getMois() > 12):
                                                    $ligne = Doctrine_Core::getTable('lignesociete')->findOneByCodemois($li->getMois());
                                                    echo $ligne->getLibelle();
                                                endif;
                                                ?>
                                            </td>
                                            <td style="width: 10%"><?php echo $li->getAnnee(); ?></td>

                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="8" style="text-align: center">Pas d'historique de Paie</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" style="margin-right: 2px">
                                Imprimer Fiches 
                                <i class="ace-icon fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-success dropdown-menu-right">
                                <li>
                                    <a target="_blanc" href="<?php echo url_for('paie/ImprimerAlllisteAllFilterFichesX2?idag=' . $idAg . '&idAgF=' . $idAgF . '&mois=' . $mois . '&annee=' . $annee) ?>">Imprimer X2 en A4</a>
                                </li>
                                <li>
                                    <a target="_blanc" href="<?php echo url_for('paie/ImprimerAlllisteAllFilterFiches?idag=' . $idAg . '&idAgF=' . $idAgF . '&mois=' . $mois . '&annee=' . $annee) ?>">Imprimer Fiche Paie En A4</a>
                                </li>
                                <li>
                                    <a id="button_print" target="_blanc" href="<?php echo url_for('paie/ImprimerAlllisteAllFilter?idag=' . $idAg . '&idAgF=' . $idAgF . '&mois=' . $mois . '&annee=' . $annee . '&annee_session=' . $annee_session) ?>">Imprimer Liste</a>
                                </li>
                            </ul>
                            <a type="button" value="Fermer" id="btn1" class="btn pull-right" onclick="fermerPaieFiltre()">Fermer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $("table").addClass("table  table-bordered table-hover");
    function fermerPaieFiltre()
    {
        $('#my-modalPaieFiltre').removeClass('in');
        $('#my-modalPaieFiltre').css('display', 'none');
    }

</script>