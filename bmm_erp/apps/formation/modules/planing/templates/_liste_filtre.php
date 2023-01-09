<div id="my-modalagentsFiltre" class="modal fade" tabindex="-1">
    <div id="sf_admin_container">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="smaller lighter blue no-margin">
                        Liste des Employés Participants à la Formation :<br>
                        <ul style="margin-top: 10px;">
                            <?php if ($idregr != ''): ?>
                                <?php $reg = Doctrine_Core::getTable('regroupementtheme')->findOneById($idregr); ?>
                                <li>"<?php echo $reg->getLibelle(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($ido != ''): ?>
                                <?php $four = Doctrine_Core::getTable('fournisseur')->findOneById($ido); ?>
                                <li>l'organisme "<?php echo $four->getRs(); ?>"</li>
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
                                    <th style="width: 25%">Matricule</th> 
                                    <th style="width: 45%">Nom & Prénom</th>
                                    <th style="width: 20%">Année</th>
                                    <th style="display: none">Code Agents</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $q = Doctrine_Query::create()
                                        ->select('a.*')
                                        ->from('agents a, regroupementtheme r, contrat c, besoinsdeformation b, planing pl, ligneplaning lp, rubriqueformation ru, sousrubrique s, unite u, posterh p')
                                        ->where('lp.id_besoins=b.id and b.id_agents=a.id')
                                        ->andWhere('lp.realise=true');

                                if ($idregr != '')
                                    $q = $q->andWhere('lp.id_regroupement=r.id')
                                            ->andWhere('r.id= ?', $idregr);
                                if ($ido != '')
                                    $q = $q->andWhere('lp.id_fournisseur= ?', $ido);
                                if ($idF != '')
                                    $q = $q->andWhere('lp.id_formateur= ?', $idF);
                                if ($iddebut != '')
                                    $q = $q->andWhere('lp.id_pluning=pl.id')
                                            ->andWhere('pl.annee >= ?', $iddebut);
                                if ($idfin != '')
                                    $q = $q->andWhere('lp.id_pluning=pl.id')
                                            ->andWhere('pl.annee <= ?', $idfin);
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
                                <?php if (sizeof($listes) > 0): ?>
                                    <?php foreach ($listes as $ag): ?>
                                        <tr>
                                            <td style="width: 10%;text-align: center"><?php echo $i; ?></td>
                                            <td style="width: 30%;text-align: center"><?php echo $ag->getIdrh(); ?></td>
                                            <td style="width: 40%;"><?php echo $ag->getNomcomplet() . " " . $ag->getPrenom(); ?></td>
                                            <td style="width: 20%;text-align: center"><?php echo $ag->getBesoinsdeformation()->getFirst()->getAnnee(); ?></td>
                                            <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                        </tr>
                                        <?php $i++; ?>

                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr><td style="text-align: center" colspan="4">Pas D'historique</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="modal-footer">
                        <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAlllisteAllFilter?idreg=' . $idregr . '&ido=' . $ido . '&idf=' . $idF . '&iddebut=' . $iddebut . '&idfin=' . $idfin . '&idd=' . $idd . '&idr=' . $idr . '&ids=' . $ids . '&idu=' . $idu) ?>" class="btn btn-sm btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" id="btn1" class="btn btn-sm pull-left" onclick="fermeragentsFiltre()">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $("table").addClass("table  table-bordered table-hover");
    function fermeragentsFiltre()
    {
        $('#my-modalagentsFiltre').removeClass('in');
        $('#my-modalagentsFiltre').css('display', 'none');
    }

</script>