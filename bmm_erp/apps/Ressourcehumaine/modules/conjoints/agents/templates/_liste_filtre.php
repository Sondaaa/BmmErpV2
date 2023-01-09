<div id="my-modalagentsFiltre" class="modal fade" tabindex="-1">
    <div id="sf_admin_container">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="smaller lighter blue no-margin">
                        Liste des Suivis Congés :<br>
                        <ul style="margin-top: 10px;">
                            <?php if ($idcorps != ''): ?>
                                <?php $corps = Doctrine_Core::getTable('corps')->findOneById($idcorps); ?>
                                <li>Corps "<?php echo $corps->getLibelle(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($idechelle != ''): ?>
                                <?php $echelle = Doctrine_Core::getTable('echelle')->findOneById($idechelle); ?>
                                <li> Echelle "<?php echo $echelle->getLibelle(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($idechelon != ''): ?>
                                <?php $echelon = Doctrine_Core::getTable('echelon')->findOneById($idechelon); ?>
                                <li>Echelon "<?php echo $echelon->getLibelle(); ?>"</li>
                            <?php endif; ?>

                            <?php if ($idcategorie != ''): ?>
                                <?php $categorie = Doctrine_Core::getTable('categorierh')->findOneById($idcategorie); ?>
                                <li>Catégorie "<?php echo $categorie->getLibelle(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($idgrade != ''): ?>
                                <?php $grade = Doctrine_Core::getTable('grade')->findOneById($idgrade); ?>
                                <li>Grade "<?php echo $grade->getLibelle(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($idsituation != ''): ?>
                                <?php $situation = Doctrine_Core::getTable('typecontrat')->findOneById($idsituation); ?>
                                <li>Situation Administrative "<?php echo $situation->getLibelle(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($idprime != ''): ?>
                                <?php $prime = Doctrine_Core::getTable('titreprimes')->findOneById($idprime); ?>
                                <li>Prime "<?php echo $prime->getLibelle(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($idlieu != ''): ?>
                                <?php $lieu = Doctrine_Core::getTable('lieutravail')->findOneById($idlieu); ?>
                                <li>Lieu de Travail "<?php echo $lieu->getLibelle(); ?>"</li>
                            <?php endif; ?>

                            <?php if ($idposition != ''): ?>
                                <?php $position = Doctrine_Core::getTable('posititionadministrative')->findOneById($idposition); ?>
                                <li>Position Administrative "<?php echo $position->getLibelle(); ?>"</li>
                            <?php endif; ?>
                            <?php if ($idprojet != ''): ?>
                                <?php $projet = Doctrine_Core::getTable('projet')->findOneById($idprojet); ?>
                                <li>Projet "<?php echo $projet->getLibelle(); ?>"</li>
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
                                    <th style="width: 30%">Matricule</th>  
                                    <th style="width: 40%">Agent</th>  

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $q = Doctrine_Query::create()
                                        ->select('a.*')
                                        ->from('contrat c,agents a,salairedebase s, corps cor,echelle e,echelon ech,'
                                                . 'categorierh cat,grade g,typecontrat t, primes p, titreprimes titrep,'
                                                . 'ligneprimecontrat lignecp'
                                                . 'lieutravail l,positionadministratif pos,projet pro')
                                        ->where('c.id_agents=a.id');

                                ;
                                if ($idcorps != '')
                                    $q = $q->Andwhere(' c.id_salairedebase=s.id and s.id_corps=cor.id')
                                            ->andWhere('c.id_salaire= ?', $idcorps)

                                    ;
                                if ($idechelle != '')
                                    $q = $q->andwhere(' c.id_salairedebase=s.id and s.id_echelle=e.id')
                                            ->andWhere('e.id= ?', $idechelle);

                                if ($idechelon != '')
                                    $q = $q->andwhere('and c.id_salairedebase=s.id and s.id_echelon=ech.id')
                                            ->andWhere('ech.id= ?', $idechelon);


                                if ($idcategorie != '')
                                    $q = $q->andwhere(' c.id_salairedebase=s.id and s.id_categorie=cat.id')
                                            ->andWhere('cat.id= ?', $idcategorie);


                                if ($idgrade != '')
                                    $q = $q->andwhere('c.id_salairedebase=s.id and s.id_grade=g.id')
                                            ->andWhere('g.id= ?', $idgrade);


                                if ($idsituation != '')
                                    $q = $q->andwhere('c.id_typecontrat=t.id')
                                            ->andWhere('t.id= ?', $idsituation);


                                if ($idprime != '')
                                    $q = $q->andwhere('lignecp.id_contrat=c.id and lignecp.id_prime=p.id and  c.id_agents=a.id and p.id_titreprime=titrep.id')
                                            ->andWhere('titrep.id= ?', $idprime);
                                if ($idlieu != '')
                                    $q = $q->andwhere('c.id_lieu=l.id')
                                            ->andWhere('l.id= ?', $idlieu);
                                if ($idposition != '')
                                    $q = $q->andwhere('c.id_positionadmini=pos.id')
                                            ->andWhere('pos.id= ?', $idposition);
                                if ($idprojet != '')
                                    $q = $q->andwhere('c.id_projet=pro.id')
                                            ->andWhere('pro.id= ?', $idprojet);

                                $listes = $q->execute();
                                ?>
                                <?php $i = 1; ?>
                                <?php foreach ($listes as $li): ?>
                                    <tr>
                                        <td style="width: 5%"><?php echo $i; ?></td>
                                        <td><?php echo $li->getAgents()->getNomcomplet() . " " . $li->getAgents()->getPrenom(); ?></td>
                                        <td style="width: 10%" ><?php echo $li->getNbrcongeralise(); ?></td>
                                        <td style="width: 10%" ><?php echo $li->getDatedebutvalide(); ?></td>
                                        <td style="width: 10%" ><?php echo $li->getDatefinvalide(); ?></td>
                                        <td style="width: 10%"><?php echo $li->getNbrcongerestant(); ?> </td>
                                        <td ><?php echo $li->getTypeconge()->getLibelle(); ?></td>
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