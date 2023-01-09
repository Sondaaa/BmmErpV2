<div id="my-modalformationagentsFiltre" class="modal fade" tabindex="-1">
    <div id="sf_admin_container">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="smaller lighter blue no-margin">
                        Liste des Formations :<br>
                        <ul style="margin-top: 10px;">
                            <?php if ($idag != ''): ?>
                                <?php $agents = Doctrine_Core::getTable('agents')->findOneById($idag); ?>
                                <li>"<?php echo $agents->getNomcomplet() . " " . $agents->getPrenom(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($ido != ''): ?>
                                <?php $four = Doctrine_Core::getTable('fournisseur')->findOneById($ido); ?>
                                <li>de l'organisme "<?php echo $four->getRs(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($idF != ''): ?>
                                <?php $for = Doctrine_Core::getTable('formateur')->findOneById($idF); ?>
                                <li>avec le Formateur "<?php echo $for->getNom() . " " . $for->getPrenom(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($iddebut != ''): ?>
                                <li>dés "<?php echo $iddebut; ?>"</li>
                            <?php endif; ?>
                            <?php if ($idfin != ''): ?>
                                <li>Avant "<?php echo $idfin; ?>"</li>
                            <?php endif; ?>
                            <?php if ($idd != ''): ?>
                                <?php $domaine = Doctrine_Core::getTable('domaineuntilisation')->findOneById($idd); ?>
                                <li>du Domaine d'utilisation "<?php echo $domaine->getLibelle(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($idr != ''): ?>
                                <?php $rubrique = Doctrine_Core::getTable('rubriqueformation')->findOneById($idr); ?>
                                <li>du Rubrique "<?php echo $rubrique->getLibelle(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($ids != ''): ?>
                                <?php $sousrubrique = Doctrine_Core::getTable('sousrubrique')->findOneById($ids); ?>
                                <li>du Sous Rubrique "<?php echo $sousrubrique->getLibelle(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($idu != ''): ?>
                                <?php $unite = Doctrine_Core::getTable('unite')->findOneById($idu); ?>
                                <li>de "<?php echo $unite->getLibelle(); ?>"</li>
                            <?php endif; ?>
                        </ul>
                    </h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <table id="dynamic-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 10%">Numéro</th>
                                    <th style="width: 30%">Formation</th> 
                                    <th style="width: 20%">Année</th>

                                </tr>
                            </thead>
                            <tbody><!--,-->
                                <?php
                                $q = Doctrine_Query::create()
                                        ->select('bes.*')
                                        ->from(' besoinsdeformation bes,agents a,ligneplaning lp,planing pl, rubriqueformation ru, sousrubrique s, contrat c,  unite u, posterh p')
                                        ->where('lp.id_besoins=bes.id and bes.id_agents=a.id')
                                        ->andWhere('lp.realise=true');

                                if ($idag != '')
                                    $q = $q->andWhere('a.id= ?', $idag);
                                if ($iddebut != '')
                                    $q = $q->andWhere('lp.id_pluning=pl.id')
                                            ->andWhere('pl.annee >= ?', $iddebut);
                                  if ($idfin != '')
                                    $q = $q->andWhere('lp.id_pluning=pl.id')
                                            ->andWhere('pl.annee <= ?', $idfin);
                                if ($ido != '')
                                    $q = $q->andWhere('lp.id_fournisseur= ?', $ido);
                                if ($idF != '')
                                    $q = $q->andWhere('lp.id_formateur= ?', $idF);
//                               
//                              
                                if ($idd != '')
                                    $q = $q->andWhere('lp.id_sousrubrique=s.id')
                                            ->andWhere('s.id_rubrique=ru.id')
                                            ->andWhere('ru.id_domaine= ?', $idd);
                                if ($idr != '')
                                    $q = $q->andWhere('lp.id_sousrubrique=s.id')
                                            ->andWhere('s.id_rubrique= ?', $idr);
                                if ($ids != '')
                                    $q = $q->andWhere('lp.id_sousrubrique= ?', $ids);
                                if ($idu != '')
                                    $q = $q->andWhere('c.id_agents=a.id and c.id_posterh=p.id and p.id_unite=u.id')
                                            ->andWhere('u.id= ?', $idu);
                                    $listes = $q->execute();
                                ?>
                                <?php $i = 1; ?>
                                <?php foreach ($listes as $ag): ?>
                                    <tr>
                                        <td style="width: 10%"><?php echo $i; ?></td>

                                        <td style="width: 40%"><?php echo $ag->getBesoins() ?></td>
                                        <td style="width: 30%"><?php echo $ag->getAnnee(); ?></td>
    <!--                              <td style="width: 20%"><?php // echo $ag->getBesoinsdeformation()->getFirst()->getAnnee();   ?></td>
                                       <td style="display: none"><?php // echo $ag->getId();   ?> </td>-->
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="modal-footer">
                        <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAlllisteAllFilterFormationParAgents?idag=' . $idag . '&ido=' . $ido . '&idf=' . $idF . '&iddebut=' . $iddebut . '&idfin=' . $idfin . '&idd=' . $idd . '&idr=' . $idr . '&ids=' . $ids . '&idu=' . $idu) ?>" class="btn  btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" id="btn1" class="btn pull-left" onclick="fermeragentsFiltre1()">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">

    $("table").addClass("table  table-bordered table-hover");
    function fermeragentsFiltre1()
    {
        $('#my-modalformationagentsFiltre').removeClass('in');
        $('#my-modalformationagentsFiltre').css('display', 'none');
    }

</script>