<?php
$numero = strtoupper($documentachat->getTypedoc());
$numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
?>
<div id="sf_admin_container">
    <h1><?php echo $numero; ?> N°: <?php echo $documentachat->getNumero() ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $aviss = Doctrine_Core::getTable('avis')
        ->createQuery('a')->where('id_poste=5')
        ->orderBy('id asc')->execute(); //Liste des avis par unité budget
    ?>
    <div id="sf_admin_content">
        <div class="panel-body">
            
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Détail</a></li>
                <li class=""><a href="#annulation" data-toggle="tab" aria-expanded="false">Annulation</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active in" id="home">

                    <?php if ($documentachat->getIdTypedoc() == 6) : ?>
                        <div style=" position: absolute;float: right; margin-left: 80%;margin-top: 1%;" class="disabledbutton">
                            <table>
                                <tr>
                                    <td colspan="2">Avis de l'unité budget</td>
                                </tr>
                                <?php
                                foreach ($aviss as $avis) {
                                    $lgavis = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDocAndIdAvis($documentachat->getId(), $avis->getId());
                                ?>
                                    <tr>
                                        <td><?php
                                            if (strpos($avis->getLibelle(), ":") == 0)
                                                echo $avis->getLibelle();
                                            else
                                                echo "<p style='color: red; margin-bottom:0px;'>" . $avis->getLibelle() . "</p>";
                                            ?></td>
                                        <td>
                                            <?php if (strpos($avis->getLibelle(), ":") == 0) { ?>
                                                <input <?php if ($lgavis) echo 'checked="true"' ?> type="checkbox">
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    <?php endif; ?>
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
                                        <?php if ($documentachat->getIdTypedoc() == 6) : ?>
                                            <tr>
                                                <td>Nature:</td>
                                                <td><?php echo $documentachat->getObjectdocument(); ?></td>
                                            </tr>
                                        <?php else : ?>
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
                    <?php if ($documentachat->getIdTypedoc() == 6) : ?>
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

                </div>

                <div class="tab-pane" style="height: 670px;" id="annulation">

                    <div id="documentscan" class="col-xs-12 col-lg-12">
                        <div id="sf_admin_content" ng-controller="CtrlScan">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <!-- /.panel-heading -->
                                        <div class="panel-body" id="imgmodel" style="height: 600px">

                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="margin-bottom: 25px;">
                                        <!--                                        <table style="margin-bottom: 20px;">
                                            <tr>-->
                                        <!--                                                <td style="width: 10%;">Motif:</td>
                                                <td style="width: 90%;"><textarea id="motif"></textarea></td>-->
                                        <!--<td>-->
                                        <!--Motif:<br>-->
                                        <legend>Motif</legend>
                                        <textarea id="motif"></textarea>
                                        <!--                                                </td>
                                            </tr>
                                        </table>-->
                                    </div>
                                    <div class="panel panel-default">
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <fieldset style="padding: 10px">
                                                <legend>Attacher fiche scannée</legend>
                                                <div class="col-lg-12">
                                                    <div class="content">
                                                        <input type="button" value="SCAN NOUVEAUX DOCUMENT" ng-click="ScanDocDemandeachat();" class="btn btn-info">
                                                        <input ng-click="ValiderAttachementDoucumentachat(detailfrs.demandedeprixid)" type="button" value="VALIDER ATTACHEMENT" ng-click="" class="btn btn-info">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset style="padding: 10px;">
                                                <div class="col-lg-12">
                                                    <div class="content">
                                                        <input type="button" value="AFFICHE LES ATTACHEMENTS" ng-click="AfficheDemandedeprix(detailfrs.demandedeprixid);" class="btn btn-info"><br>
                                                        <table>
                                                            <tr ng-repeat="att in attachements">
                                                                <td>
                                                                    <a target="_blanc" href="<?php echo sfconfig::get('sf_appdir') . "uploads/scanner/" ?>{{att.chemin}}">
                                                                        <img src="<?php echo sfconfig::get('sf_appdir') . "uploads/scanner/" ?>{{att.chemin}}" style="width: 50px">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div>
                                        <a id="annule_button" class="btn btn-outline btn-danger" onclick="AnnulerDocument('<?php echo $documentachat->getId(); ?>')">Annuler --> <?php echo $numero; ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function AnnulerDocument(id) {
        if ($('#motif').val() != '') {
            $.ajax({
                url: '<?php echo url_for('documentachat/validerAnnulation') ?>',
                data: 'motif=' + $('#motif').val() + '&id=' + id + '&url=' + $('#scan_url').val(),
                success: function(data) {
                    $('#annule_button').hide();
                    bootbox.dialog({
                        message: "<span class='bigger-110' style='margin:20px;'>Document d'achat annulé !</span>",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Veuillez saisir le motif d'annulation !</span>",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
</script>