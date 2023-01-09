<div id="my-modalagentsFiltre" class="modal fade" tabindex="-1">
    <div id="sf_admin_container">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="smaller lighter blue no-margin">
                        Liste des Congés Consommés :<br>
                        <ul style="margin-top: 10px;">
                            <?php if ($idAg != ''): ?>
                                <?php $agents = Doctrine_Core::getTable('agents')->findOneById($idAg); ?>
                                <li>"<?php echo $agents->getNomcomplet() . " " . $agents->getPrenom(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($idtype != ''): ?>
                                <?php $type = Doctrine_Core::getTable('typeconge')->findOneById($idtype); ?>
                                <li>de Type "<?php echo $type->getLibelle(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($annee != ''): ?>
                                <li>En "<?php echo $annee; ?>"</li>
                            <?php endif; ?>
                        </ul>
                    </h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <table id="dynamic-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%">N°</th>

                                    <th  <?php if ($idAg != ''): ?>style="width: 20%;display: none"<?php endif; ?>>Agents</th>
                                    <th style="width: 10%">Nbr.J.<br>Consommé</th> 
                                    <th style="width: 10%">Date Début<br></th> 
                                    <th style="width: 10%">Date Fin</th> 
                                    <th style="width: 10%">Nbr.J.<br>Restant</th> 
                                    <th <?php if ($idtype != ''): ?>style="width: 20%;display: none"<?php endif; ?>>T.Congé</th> 
                                    <th style="width: 10%">Année</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $q = Doctrine_Query::create()
                                        ->select('c.*')
                                        ->from('conge c,agents a')
                                        ->where('c.id_agents=a.id');

//                                ->orderBy('c.datedebutvalide,c.id_type', 'ASC')
//                              ->  addOrderBy('c.datedebutvalide', 'ASC')
//                              ->addOrderBy('c.id_type', 'DESC')
                                ;
                                if ($idAg != '')
                                    $q = $q->andWhere('a.id= ?', $idAg);
                                if ($idtype != '')
                                    $q = $q->andWhere('c.id_type= ?', $idtype);
                                if ($annee != '')
                                    $q = $q->andWhere ('c.annee= ?', $annee);
                                $q = $q->orderBy('c.id_type, c.datedebutvalide');
                                $listes = $q->execute();
                                ?>
                                <?php $i = 1; ?>
                                <?php foreach ($listes as $li): ?>
                                    <tr>
                                        <td style="width: 10%"><?php echo $i; ?></td>
                                        <td <?php if ($idAg != ''): ?>style="width: 20%;display: none"<?php endif; ?>><?php echo $li->getAgents()->getNomcomplet() . " " . $li->getAgents()->getPrenom(); ?></td>
                                        <td style="width: 10%" ><?php echo $li->getNbrcongeralise(); ?></td>
                                        <td style="width: 10%" ><?php echo $li->getDatedebutvalide(); ?></td>
                                        <td style="width: 10%" ><?php echo $li->getDatefinvalide(); ?></td>
                                        <td style="width: 10%"><?php echo $li->getNbrcongerestant(); ?> </td>
                                        <td <?php if ($idtype != ''): ?>style="width: 20%;display: none"<?php endif; ?>><?php echo $li->getTypeconge()->getLibelle(); ?></td>
                                        <td style="width: 10%"><?php echo $li->getAnnee(); ?></td>

                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="modal-footer">
                        <a id="button_print" target="_blanc" href="<?php echo url_for('conge/ImprimerAlllisteAllFilter?idag=' . $idAg . '&idtype=' . $idtype . '&annee=' . $annee) ?>" class="btn  btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" id="btn1" class="btn pull-left" onclick="fermeragentsFiltre()">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">

    $("table").addClass("table  table-bordered table-hover");
    function fermeragentsFiltre()
    {
        $('#my-modalagentsFiltre').removeClass('in');
        $('#my-modalagentsFiltre').css('display', 'none');
    }

</script>