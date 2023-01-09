<div id="my-modalPaieEtatRecap" class="modal fade" tabindex="-1">
    <div id="sf_admin_container">
        <div class="modal-dialog" style="width: 900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="smaller lighter blue no-margin">
                        ETAT RECAPITULATIF DES SALAIRES ET APPOINTEMENTS :<br>
                        <?php $societe = Doctrine_Core::getTable('societe')->findOneById(1); ?>
                        <ul style="margin-top: 10px;">
                            <?php $array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre"); ?>
                            <?php if ($mois != ''): ?>
                                <li>Mois "<?php echo $array[$mois]; ?>"</li>
                            <?php endif; ?>
                            <?php if ($annee != ''): ?>
                                <li>En "<?php echo $annee; ?>"</li>
                            <?php endif; ?>
                            <?php if ($codesociale != ''): ?>
                                <?php $lignecodesoc = LignecodesocialeTable::getInstance()->findOneById($codesociale); ?>
                                <li> "<?php echo $lignecodesoc->getCodesociale()->getLibelle() . " " . $lignecodesoc->getTaux(); ?>"</li>
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
                                    <?php
                                    if ($codesociale != ''):
                                        $Csociale = Doctrine_Core::getTable('lignecodesociale')->findOneById($codesociale);
                                        ?>
                                        <th style="width: 10%">N° <?php echo $Csociale->getCodesociale()->getLibelle() ?></th>
                                    <?php endif; ?>
                                    <th style="width: 20%" >Agents</th>
                                    <th style="width: 5%">Matricule</th>
                                    <th style="width: 20%">Qualification<br></th> 
                                    <th style="width: 10% ">Salaire Brut</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $q = Doctrine_Query::create()
                                        ->select('p.*')
                                        ->from('paie p,agents a')
                                        ->where('p.id_agents=a.id');
                                if ($annee != '')
                                    $q = $q->andWhere('p.annee= ?', $annee);
                                if ($codesociale != '')
                                    $q = $q->andWhere('p.id_lignecodesociale= ?', $codesociale);
                                if ($mois != '')
                                    $q = $q->andWhere('p.mois= ?', $mois);
                                $q->orderBy('p.id_agents, p.mois');
                                $listes = $q->execute();
                                ?>
                                <?php if (sizeof($listes) > 0): ?>
                                    <?php $i = 1; ?>
                                    <?php foreach ($listes as $li): ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $li->getContrat()->getIdunique() ?></td>
                                            <td><?php echo $li->getAgents()->getNomcomplet() . " " . $li->getAgents()->getPrenom(); ?></td>
                                            <td> <?php echo $li->getAgents()->getIdrh(); ?>  </td>
                                            <td style="width: 10%" ><?php echo $li->getContrat()->getSalairedebase()->getGrade(); ?></td>

                                            <td style="text-align: right"><?php echo $li->getSalairebrut(); ?> </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>


                                <?php else : ?>
                                    <tr><td style="text-align: center">Pas d'historique</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <a type="button" target="_blanc" class="btn btn-success" style="margin-right: 2px" href="<?php echo url_for('paie/ImprimerAlllisteAllFilterEtatrecapcnrps?mois=' . $mois . '&annee=' . $annee . '&codesociale=' . $codesociale) ?>">ETAT RECAPITULATIF CNSS</a>
                    <a type="button" value="Fermer" id="btn1" class="btn pull-right" onclick="fermerEtatrecap()">Fermer</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("table").addClass("table  table-bordered table-hover");
    function fermerEtatrecap()
    {
        $('#my-modalPaieEtatRecap').removeClass('in');
        $('#my-modalPaieEtatRecap').css('display', 'none');
    }

</script>