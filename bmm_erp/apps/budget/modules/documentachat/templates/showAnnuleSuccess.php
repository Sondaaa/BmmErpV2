<?php
$documentachat = $document_annule->getDocumentachat();
$listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($documentachat->getId());
$numero = strtoupper($documentachat->getTypedoc());
$numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
?>
<div id="sf_admin_container">
    <h1><?php echo $numero; ?> N°: <?php echo $documentachat->getNumero() ?></h1>
    <?php $societe = Doctrine_Core::getTable('societe')->findOneById(1); ?>
    <div id="sf_admin_content">
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Détails Document</a></li>
                <li class=""><a href="#annulation" data-toggle="tab" aria-expanded="false">Détails Annulation</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <div style="padding: 1%;width: 80%;font-size: 16px">
                        <table style="list-style: none; margin-bottom: 0px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="width: 200px; vertical-align: middle;">
                                    <p><strong><?php echo strtoupper($societe); ?></strong></p>  
                                </td>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2"><?php echo $numero; ?></td>
                                        </tr>
                                        <tr>
                                            <td>N°: <?php echo $documentachat->getNumerodocachat() ?></td>
                                            <td>Date création: <?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>
                                        </tr>
                                        <?php if ($documentachat->getIdTypedoc() == 6): ?>
                                            <tr>
                                                <td>Nature:</td>
                                                <td><?php echo $documentachat->getObjectdocument(); ?></td>
                                            </tr>
                                        <?php else: ?>
                                            <tr>
                                                <td>Référence:</td>
                                                <td><?php echo $documentachat->getReference(); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>
                                </td>
                            </tr>
                        </table> 
                    </div>
                    <?php if ($documentachat->getIdTypedoc() == 6): ?>
                        <fieldset style="width: 80%">
                            <legend>Données de base</legend>
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="width: 30%"><label>Nom et Prénom du demandeur</label></td>
                                        <td><?php echo $documentachat->getAgents(); ?></td>
                                        <td><label>Référence</label></td>
                                        <td><?php echo $documentachat->getReference(); ?></td>
                                    </tr>
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
                                    <th>Code Article</th>
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
                                    $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lg->getId());
                                    if ($qteligne) {
                                        $qtedemander = $qteligne->getQtedemander();
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                                        <td><?php echo $lg->getCodearticle() ?></td>
                                        <td><?php echo $lg->getDesignationarticle() ?></td>
                                        <td><?php echo $qtedemander . " (" . trim($lg->getUnitedemander()) . ")" ?></td>
                                        <td><?php echo $lg->getProjet() ?></td>
                                        <td><?php echo $lg->getObservation() ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </fieldset>
                </div>

                <div class="tab-pane" style="height: 610px;" id="annulation">
                    <?php
//                    $addr = "C:\Program Files (x86)\Microsoft\SetupFormanet2018/AutoScan.exe";
//                    $results = exec($addr);
//                    echo $results; // prints out nothing
//                    exec($addr, $output, $return);
                    ?>
                    <div id="documentscan" class="col-xs-12 col-lg-12">
                        <div id="sf_admin_content" ng-controller="CtrlScan">
                            <div class="row">
                                <div  class="col-md-6">
                                    <div class="panel panel-default">
                                        <!-- /.panel-heading -->
                                        <div class="panel-body" id="imgmodel" style="height: 600px">

                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="margin-bottom: 25px;">
                                        <table style="margin-bottom: 20px;">
                                            <?php
                                            $utilisateur = $document_annule->getUtilisateur();
                                            $agent = $utilisateur->getAgents();
                                            ?>
                                            <tr>
                                                <td style="width: 20%;">Utilisateur :</td>
                                                <td style="width: 80%;"><?php echo $agent; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Date :</td>
                                                <td><?php echo date('d/m/Y', strtotime($document_annule->getDateannulation())); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Motif :</td>
                                                <td><?php echo html_entity_decode($document_annule->getMotifannulation()); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <?php
                                    $piecejointbudget = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($documentachat->getId());
                                    if ($piecejointbudget):
                                        $document_budget = $piecejointbudget->getDocumentbudget();
                                        if ($piecejointbudget):
                                            ?>
                                            <div>
                                                <legend>Engagement Budgétaire</legend>
                                                <label><b><?php echo $document_budget->getTypedocbudget(); ?></b></label><br>
                                                <label><?php echo $document_budget->getLigprotitrub()->getTitreEtRubrique(); ?></label><br>
                                                <label><?php echo $document_budget; ?></label><br>
                                                <label><b>Montant engagé :</b> <?php echo $document_budget->getMnt(); ?> TND</label><br><br>
                                                <a id="annule_button" class="btn btn-outline btn-danger" onclick="validerAnnulationEngagement('<?php echo $document_annule->getId(); ?>')">Annuler --> Engagement Budgétaire</a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($piecejointbudget): ?>
    <script  type="text/javascript">

        function validerAnnulationEngagement(id) {
            $.ajax({
                url: '<?php echo url_for('documentachat/validerAnnulationEngagement') ?>',
                data: 'id=' + id +
                        '&id_documentbudget=<?php echo $document_budget->getId(); ?>',
                success: function (data) {
                    $('#annule_button').hide();
                    bootbox.dialog({
                        message: "<span class='bigger-110' style='margin:20px;'>Engagement annulé !</span>",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                }
            });
        }

    </script>
<?php endif; ?>