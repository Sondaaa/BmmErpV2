<div class="page-header">

    <h1>Fiche N° : <?php echo $documentachat->getNumerodocachat() ?></h1>
</div>
<div class="row">
    <div class="col-xs-12">
        <?php

        $aviss = Doctrine_Core::getTable('avis')
            ->createQuery('a')->where('id_poste=5')
            ->orderBy('id asc')->execute();
        //Liste des avis par unité budget
        $id_naturedoc = $documentachat->getIdNaturedoc();
        ?>
        <div class="col-xs-8">

            <div>
                <?php
                $numero = strtoupper($documentachat->getTypedoc());
                $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                ?>
                <table>
                    <thead>
                        <tr>
                            <th colspan="2"><?php echo $numero; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>N° : <?php echo $documentachat->getNumerodocachat() ?></td>
                            <td>Date création : <?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>
                        </tr>
                        <tr>
                            <td>Nature</td>
                            <td><?php echo $documentachat->getNaturedocachat(); ?></td>
                        </tr>
                        <tr>
                            <td>Etat</td>
                            <td><?php echo $documentachat->getEtatdocument(); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <table>
                <thead>
                    <tr>
                        <th colspan="2">Données de base</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>


                        <td style="width: 30%">Nom et Prénom du demandeur</td>
                        <td><?php echo $documentachat->getAgents(); ?></td>


                    </tr>
                    <tr>
                        <td style="width: 30%">Projet</td>
                        <td><?php echo $documentachat->getProjet() ?></td>
                    </tr>
                    <tr>
                        <td style="width: 30%">Date Signature</td>
                        <td><?php echo $documentachat->getDatesignaturebci() ?></td>

                    </tr>

                </tbody>
            </table>



            <table>
                <thead>
                    <tr>
                        <th colspan="10">Liste des articles</th>
                    </tr>
                    <tr>
                        <th>N°</th>
                        <th>Code Article</th>
                        <th>Désignation</th>

                        <th>Quantité (Unité)</th>

                        <th>Caractéristique Article</th>

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
            <div class="col-xs-12">
                <fieldset>
                    <legend>Action</legend>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <a class="btn btn-block btn-xs btn-default" href="<?php echo url_for('Achatdoc/index?idtype=4') ?>">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Liste Demandes Internes
                                </a>
                            </div>

                            <div class="col-xs-4">
                                <a target="_blanc" class="btn btn-block btn-xs btn-primary" href="<?php echo url_for('documentachat/ImprimerdocachatBCIM?iddoc=' . $documentachat->getId()) ?>">
                                    <i class="ace-icon fa fa-print bigger-110"></i> Imprimer & Exporter PDF
                                </a>
                            </div>
                            <?php if(!$documentachat->getDatesignaturebci()):?>
                            <div class="col-xs-4">
                                <a class="btn btn-xs btn-block btn-danger" href="#my-modal_secretaire" role="button" data-toggle="modal">
                                    <i class="fa fa-long-arrow-right"></i>
                                    Ajouter Date Signature
                                </a>

                            </div>
                            <?php endif;?>
                            <div id="my-modal_secretaire" class="modal fade" tabindex="-1">
                                <div class="modal-dialog" style="width: 50%">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h3 class="smaller lighter blue no-margin">
                                                <?php echo $documentachat ?>
                                            </h3>
                                        </div>
                                        <div class="modal-body" style="width: 400px;">
                                            Date Validation:
                                            <input type="date" id="datevalidation">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-sm btn-danger pull-right" style="margin-left:2px" data-dismiss="modal">
                                                <i class="ace-icon fa fa-times"></i>
                                                Fermer
                                            </button>
                                            <button class="btn btn-sm btn-success pull-right" data-dismiss="modal" onclick="validerDocachat('<?php echo $documentachat->getId(); ?>')">
                                                <i class="ace-icon fa fa-save"></i>
                                                Valider
                                            </button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->

                            </div>
                        </div>

                    </div>




                </fieldset>
            </div>

        </div>
        <div class="col-xs-4">
            <div class="col-xs-12">
                <?php
                $id =  $documentachat->getId();

                include_partial('Scan/formscan', array('id' => $id, 'documentachat' => $documentachat));
                ?>
            </div>


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
<script>
    function validerDocachat(id) {
        $.ajax({
            url: '<?php echo url_for('documentachat/validerbci'); ?>',
            data: 'id=' + id + '&date=' + $('#datevalidation').val(),
             headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            },
            success: function(data) {
                bootbox.dialog({
                    message: "<span class='bigger-110' style='margin:20px;'>Mis à jour valide avec success !!!</span>",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                document.location.reload();
            }
        });
    }
</script>