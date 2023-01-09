<div id="sf_admin_container">
    <h1>Fiche D.I. N° : <?php echo $documentachat->getNumerodocachat() ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $aviss = Doctrine_Core::getTable('avis')
                    ->createQuery('a')->where('id_poste=5')
                    ->orderBy('id asc')->execute();
//Liste des avis par unité budget
    ?>
    <div id="sf_admin_content">  
        <div style="position: absolute; float: right; margin-left: 80%; margin-top: 1%;" class="disabledbutton">
            <table>
                <thead>
                    <tr>
                        <th colspan="2" style="font-size: 16px;">Avis de l'unité budget</th>
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
        <div style="padding: 1%; width: 80%; font-size: 16px">
            <table style="list-style: none; margin-bottom: 0px;" class="table table-striped table-bordered table-hover">
                <tr style="background-color: #F0F0F0;">
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
                                <td>Nature</td>
                                <td><?php echo $documentachat->getObjectdocument(); ?></td>
                            </tr>
                             <tr>
                                <td> Contrat associé</td>
                                <td><?php echo $documentachat->getContratachat(); ?> </td>
                            </tr>
                            <tr>
                                <td>Montant Estimatif</td>
                                <td><?php echo number_format($documentachat->getMontantestimatif(), 3, '.', ' '); ?> TND</td>
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
                        <td>Référence</td>
                        <td><?php echo $documentachat->getReference(); ?></td>
                        <td style="width: 30%">Nom et Prénom du demandeur</td>
                        <td><?php echo $documentachat->getAgents(); ?></td>
                        <td style="width: 30%">Valide</td>
                        <td><?php
                            if ($documentachat->getValide() == false)
                                echo 'Non Validé';
                            if ($documentachat->getValide() == true)
                                echo 'Validé';
                            ?></td>

                    </tr>
                </tbody>
            </table>
        </fieldset>
        <fieldset>
            <legend>Liste des articles</legend>
            <table>
                <thead>
                    <tr>
                        <th>N°ordre</th>
                        <th>Code Article</th>
                        <th>Désignation</th>
                        <th>Quantité (Unité)</th>

                        <th style="text-align:center;width: 10%">P.Unit.<br>H.T</th>
                        <th style="text-align:center;width: 10%">Total<br>H.T</th> 

                        <?php
                        $fodec = 0.000;
                        foreach ($listesdocuments as $lignedoc) {
                            $fodec = $fodec + $lignedoc->getMntfodec();
                        }
                        if ($fodec != 0.000):
                            ?>
                            <th style="text-align:center;width: 10%">Fodec</th>
                        <?php endif; ?>
                        <th style="text-align:center;width: 10%">Total<br>H.TVA</th>

                        <th style="text-align:center;width: 10%">Taux<br>T.V.A</th>
                        <th style="text-align:center;width: 10%">M.TTC</th>              

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
                            <td><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                            <td><?php echo $lg->getCodearticle() ?></td>
                            <td><?php echo $lg->getDesignationarticle() ?></td>
                            <?php if ($lg->getUnitedemander()): ?>
                                <td><?php echo $qtedemander . " (" . trim($lg->getUnitedemander()) . ")" ?></td>
                            <?php else: ?>
                                <td><?php echo $qtedemander; ?></td>
                            <?php endif; ?>
                            <td><?php echo number_format(($lignedoc->getMntht() / $lignedoc->getQte()), 3, ',', ' ') ?></td>
                            <td><?php echo number_format(($lignedoc->getMntht()), 3, ',', ' ') ?></td>
                            <?php if ($fodec != 0.000): ?>
                                <td>
                                    <?php echo number_format(($lignedoc->getMntfodec()), 3, ',', ' ') ?>

                                </td>
                            <?php endif; ?>
                            <td><?php echo number_format(($lignedoc->getMntthtva()), 3, ',', ' ') ?>

                            </td>
                            <td><?php echo $lignedoc->getTva() ?></td>
                            <td><?php echo number_format((($lignedoc->getMntht()) + $lignedoc->getMnttva()), 3, ',', ' ') ?></td>
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
                        <div style="width: 20%; float: left; border-color: #00438a;margin: 1%; text-align: center">
                            <div style="padding: 2%;"><img src="<?php echo sfconfig::get('sf_appdir') . 'uploads/images/' . $visaachat->getChemin() ?>" style="width: 150px;"></div>
                            <div style=""><?php echo $visaachat ?></div>
                            <div style="margin-left: 2%; font-size: 22px;<?php if ($visa->getEtatvalide() == 'true'): ?>color: green;<?php else: ?>color: red;<?php endif; ?>"><?php echo date('d/m/Y', strtotime($visa->getDatevisa())); ?></div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </fieldset>
        <fieldset style="margin-left: 50%;">
            <legend>Action Fiche BCI</legend>
            <div>
                <a class="btn btn-outline btn-success" href="<?php echo url_for('documentachat/index?idtype=6') ?>">
                    <i class="ace-icon fa fa-undo bigger-110"></i> Liste D.I.
                </a>
                <a target="_blanc" class="btn btn-outline btn-primary" href="<?php echo url_for('documentachat/ImprimerdocachatBCIContrat?iddoc=' . $documentachat->getId()) ?>">
                    <i class="ace-icon fa fa-print bigger-110"></i> Imprimer & Exporter PDF
                </a>
            </div>
        </fieldset>
    </div>
</div>

<style>

    .etat_valide {background-color: #9f9;}
    .etat_non_valide {background-color: #ffa6a6;}

</style>