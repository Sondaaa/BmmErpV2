<div id="sf_admin_container">
    <h1>Fiche B.C.I Marchés Publics N°:<?php echo $documentachat->getNumero() ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $aviss = Doctrine_Core::getTable('avis')
                    ->createQuery('a')->where('id_poste=5')
                    ->orderBy('id asc')->execute(); //Liste des avis par unité budget
    ?>
    <div id="sf_admin_content">  
        <div style=" position: absolute;float: right;margin-left: 80%;margin-top: 1%;" class="disabledbutton">
            <table>
                <thead>
                    <tr>
                        <td colspan="2" style="font-size: 18px;">Avis de l'unité budget</td>
                    </tr>
                </thead>
                <?php
                foreach ($aviss as $avis) {
                    $lgavis = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDocAndIdAvis($documentachat->getId(), $avis->getId());
                    ?>
                    <tr>
                        <td>
                            <?php
                            if (strpos($avis->getLibelle(), ":") == 0)
                                echo $avis->getLibelle();
                            else
                                echo "<p style='color: red; margin-bottom:0px;'>" . $avis->getLibelle() . "</p>";
                            ?>
                        </td>
                        <td>
                            <?php if (strpos($avis->getLibelle(), ":") == 0) { ?>
                                <input <?php if ($lgavis) echo 'checked="true"' ?> type="checkbox">
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div style="padding: 1%;width: 80%;font-size: 16px">
            <table style="list-style: none" class="table table-striped table-bordered table-hover">
                <tr>
                    <td style="width: 200px; vertical-align: middle; text-align: center;">
                        <p style="border-top: 1px solid silver; border-bottom: 1px solid silver; padding-top: 10px; padding-bottom: 10px;">
                            <strong><?php echo strtoupper($societe); ?></strong>
                        </p>  
                    </td>
                    <td>
                        <?php
                        $numero = strtoupper($documentachat->getTypedoc());
                        $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                        ?>
                        <table style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="2"><?php echo $numero; ?></td>
                            </tr>
                            <tr>
                                <td>N° : <?php echo $documentachat->getNumerodocachat() ?></td>
                                <td>Date création : <?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>
                            </tr>
                            <tr>
                                <td>Montant Estimatif</td>
                                <td><?php if ($documentachat->getMontantestimatif()): ?><?php echo number_format($documentachat->getMontantestimatif(), 3, '.', ' '); ?> TND<?php endif; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table> 
        </div>

        <fieldset style="width: 80%">
            <legend>Données de base</legend>
            <table>
                <tbody>
                    <tr>
                        <td style="width: 30%">Nom et Prénom du demandeur</td>
                        <td><?php echo $documentachat->getAgents(); ?></td>
                        <td>Référence</td>
                        <td><?php echo $documentachat->getReference(); ?></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
        <?php $liste_avis = Doctrine_Core::getTable('ligavisdoc')->findByIdDoc($documentachat->getId()); ?>
        <?php if ($liste_avis->count() != 0): ?>
            <fieldset id="zone_avis_budgetaire">
                <legend>Avis Bugétaire</legend>
                <table>
                    <tbody>
                        <?php foreach ($liste_avis as $lgavis): ?>
                            <tr style="background: repeat-x #F2F2F2;">
                                <td style="width: 20%;">Avis Bugétaire</td>
                                <td style="width: 40%;"><?php echo $lgavis->getAvis(); ?></td>
                                <td style="width: 20%;">Date Création</td>
                                <td style="width: 20%;"><?php echo date('d/m/Y', strtotime($lgavis->getDatecreation())); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;">Budget</td>
                                <td style="width: 80%;" colspan="3"><?php echo $lgavis->getLigprotitrub()->getRubrique(); ?></td>
                            </tr>
                            <tr>
                                <td>Rubrique</td>
                                <td colspan="3"><?php echo $lgavis->getLigprotitrub(); ?></td>
                            </tr>
                            <tr>
                                <td>Reliquat</td>
                                <td colspan="3"><?php echo number_format($lgavis->getMntdisponible(), 3, '.', ' '); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </fieldset>
        <?php endif; ?>
        <fieldset>
            <legend>Liste des articles</legend>
            <table>
                <thead>
                    <tr>
                        <th>N°ordre</th>
                        <th>Désignation</th>
                        <th>Quantité (Unité)</th>
                        <th>Projet</th>
                        <th>Observation</th>
                    </tr>             
                </thead>
                <tbody>
                    <?php
                    $lg = new Lignedocachat();
                    foreach ($listesdocuments as $lignedoc) {
                        $lg = $lignedoc;
                        $qtedemander = 0;
                        $qtees = 0;
                        $qteas = 0;
                        $qteep = 0;
                        $qteap = 0;
                        $qteea = 0;
                        $qteaa = 0;
                        $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lg->getId());
                        if ($qteligne) {
                            $qtedemander = $qteligne->getQtedemander();
                            $qteas = $qteligne->getQteas();
                            $qtees = $qteligne->getQtees();
                            $qteap = $qteligne->getQteap();
                            $qteep = $qteligne->getQteep();
                            if ($qteligne->getQteaachat())
                                $qteaa = $qteligne->getQteaachat();
                            if ($qteligne->getQteeachat())
                                $qteea = $qteligne->getQteeachat();
                        }
                        ?>
                        <tr>
                            <td style="text-align: center;"><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                            <td><?php echo html_entity_decode($lg->getDesignationarticle()); ?></td>
                            <td><?php echo $qtedemander . ' (' . $lg->getUnitedemander() . ')' ?></td>
                            <td><?php echo $lg->getProjet() ?></td>
                            <td><?php echo $lg->getObservation() ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div>
                <?php
                $visaas = Doctrine_Core::getTable('ligavissig')->findByIdDoc($documentachat->getId());
                foreach ($visaas as $visa) {
                    $visaachat = new Visaachat();
                    $vi = Doctrine_Core::getTable('visaachat')->findOneById($visa->getIdVisa());
                    if ($vi) {
                        $visaachat = $vi;
                        ?>
                        <div style="width: 20%;float: left;border-color: #00438a;margin: 1%">
                            <div style="padding: 13%;"><img src="<?php echo sfconfig::get('sf_appdir') . 'uploads/images/' . $visaachat->getChemin() ?>" style="width: 150px;"></div>
                            <div style="padding: 13%;"><?php echo $visaachat ?></div>
                            <div style="position: absolute;margin-top: -11%;margin-left: 2%;font-size: 26px;"><?php echo $visa->getDatevisa() ?></div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </fieldset>
        <fieldset style="margin-left: 50%;">
            <legend>Action Fiche B.C.I Marchés Publics</legend>
            <div>
                <a class="btn btn-outline btn-danger" href="<?php echo url_for('@documentachat') ?>">Liste B.C.I Marchés Publics</a>
                <a target="_blanc" class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId()) ?>">Imprimer & Exporter Pdf</a>
            </div>
        </fieldset>
    </div>
</div>