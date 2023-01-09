<div class="page-header">
    <h1>Fiche D.I. N° : <?php echo $documentachat->getNumerodocachat() ?></h1>
</div>
<div class="row">


    <div class="col-md-12">

        <div class="col-md-8">
            <table style="list-style: none; margin-bottom: 0px;" class="table table-striped table-bordered table-hover">
                <tr style="background-color: #F0F0F0;">

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
                                <td><?php echo $documentachat->getNaturedocachat(); ?></td>
                            </tr>
                            <tr>
                                <td>Montant Estimatif</td>
                                <td><?php echo number_format($documentachat->getMontantestimatif(), 3, '.', ' '); ?> TND</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <fieldset>
                <legend>Données de base</legend>
                <table>
                    <tbody>
                        <tr>
                            <th>Projet</th>
                            <td><?php echo $documentachat->getProjet(); ?></td>
                            <td style="width: 30%">Nom et Prénom du demandeur</td>
                            <td><?php echo $documentachat->getAgents(); ?></td>
                            <td style="width: 30%">Valide</td>
                            <td><?php if ($documentachat->getValide() == false) {
                                    echo 'Non Validé';
                                }

                                if ($documentachat->getValide() == true) {
                                    echo 'Validé';
                                }
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
                            <th>N°</th>
                            <th>Code Article</th>
                            <th>Désignation</th>
                            <th>Quantité (Unité)</th>
                            
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
                                if ($qteligne->getQteaachat()) {
                                    $qteaa = $qteligne->getQteaachat();
                                }

                                if ($qteligne->getQteeachat()) {
                                    $qteea = $qteligne->getQteeachat();
                                }
                            }
                        ?>
                            <tr>
                                <td><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                                <td><?php echo $lg->getCodearticle() ?></td>
                                <td><?php echo $lg->getDesignationarticle() ?></td>
                                <?php if ($lg->getUnitedemander()) : ?>
                                    <td><?php echo $qtedemander . " (" . trim($lg->getUnitedemander()) . ")" ?></td>
                                <?php else : ?>
                                    <td><?php echo $qtedemander; ?></td>
                                <?php endif; ?>
                            
                                <td><?php echo html_entity_decode($lg->getObservation()) ?></td>
                                
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
                                <div style=""><?php echo $visaachat ?></div>
                                <div style="margin-left: 2%; font-size: 22px;<?php if ($visa->getEtatvalide() == 'true') : ?>color: green;<?php else : ?>color: red;<?php endif; ?>"><?php echo date('d/m/Y', strtotime($visa->getDatevisa())); ?></div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </fieldset>
            <fieldset>
                <legend>Action Fiche BCI</legend>
                <div>
                    <a class="btn btn-outline btn-success" href="<?php echo url_for('documentachat/index?idtype=6') ?>">
                        <i class="ace-icon fa fa-undo bigger-110"></i> Liste D.I.
                    </a>
                    <a target="_blanc" class="btn btn-outline btn-primary" href="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId()) ?>">
                        <i class="ace-icon fa fa-print bigger-110"></i> Imprimer & Exporter PDF
                    </a>
                </div>
            </fieldset>
        </div>
        <div class="col-md-4">
            <!-- <object width="100%" height="500" type="application/pdf" data="<?php //echo sfConfig::get('sf_appdir').'uploads/attachement/'.$documentachat->getAttachement()  
                                                                                ?>"> -->
            <legend>Liste des Piece Joints:</legend>
            <?php

            include_partial('documentachat/formpiecejoint', array('id' => $documentachat->getId(), 'documentachat' => $documentachat));
            ?>
        </div>
    </div>
</div>



<style>
    .etat_valide {
        background-color: #9f9;
    }

    .etat_non_valide {
        background-color: #ffa6a6;
    }
</style>