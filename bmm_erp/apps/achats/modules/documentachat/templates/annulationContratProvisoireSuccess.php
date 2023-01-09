<?php
$numero = strtoupper($documentachat->getTypedoc());
$numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
?>
<div id="sf_admin_container">
    <h1><?php echo $numero; ?> N°: <?php echo $contratachat->getNumero() ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $aviss = Doctrine_Core::getTable('avis')
                    ->createQuery('a')->where('id_poste=5')
                    ->orderBy('id asc')->execute(); //Liste des avis par unité budget
    ?>
    <div id="sf_admin_content">
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Détail</a></li>
                <li class=""><a href="#annulation" data-toggle="tab" aria-expanded="false">Annulation</a></li>
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
                                    <?php $frs = Doctrine_Core::getTable('fournisseur')->findOneById($contratachat->getIdFrs()); ?>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2" style="text-align: center"><?php echo $numero; ?></td>
                                        </tr>
                                        <tr>
                                            <td>N°: <?php echo $contratachat->getNumero() ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nom Contrat: <?php echo $contratachat->getReference() ?></td>
                                        </tr>
                                        <tr>
                                            <td>Date création: <?php echo date('d/m/Y', strtotime($contratachat->getDatecreation())); ?></td>
                                        </tr>

                                        <tr>
                                            <td>Montant Contrat :
                                                <?php echo number_format($contratachat->getMontantcontrat(), 3, ".", " "); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Fournisseur :
                                                <?php echo $frs->getRs(); ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table> 
                    </div>

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
                                foreach ($listesdocumentscontrat as $lignedoc) {
                                    $lg = $lignedoc;
//                                    $qtedemander = 0;
//                                    $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lg->getId());
//                                    if ($qteligne) {
//                                        $qtedemander = $qteligne->getQtedemander();
//                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                                        <td><?php echo $lg->getCodearticle() ?></td>
                                        <td><?php echo $lg->getDesignationartcile() ?></td>
                                        <td><?php echo $lg->getQte() . " (" . trim($lg->getUnitemarche()) . ")" ?></td>
                                        <td><?php echo $lg->getProjet() ?></td>
                                        <td><?php echo $lg->getObservation() ?></td>
                                    </tr>

                                    <?php
                                    $liste_ligne_contrat = Doctrine_Core::getTable('lignecontrat')->findByIdDocparent($lg->getId());
                              }
                                ?>
                            </tbody>
                        </table> 
                        <?php if (sizeof($liste_ligne_contrat) >= 1): ?>
                            <table>
                                <legend>Sous détail du Ligne de contrat</legend>
                                <thead>
                                <th>N°Ordre</th>
                                <th>Designatioon Article</th>
                                <th>Type Pièce </th>
                                <th>Taux de Pourcentage</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($liste_ligne_contrat as $ligne_lg) { ?>
                                    <tr>
                                            <td><?php echo sprintf('%02d', $ligne_lg->getNordre() + 1); ?></td>
                                            <td><?php echo $ligne_lg->getDesignationartcile(); ?></td>
                                            <td ><?php echo $ligne_lg->getTypepiececontrat()->getLibelle(); ?></td>
                                            <td style="text-align: right"><?php echo $ligne_lg->getTauxpourcentage() . ' %'; ?></td>
                                    </tr> 
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                        <div>
                            <?php
                            $visaas = Doctrine_Core::getTable('ligavissig')->findByIdDoc($documentachat->getIdDocparent());

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
                                    <div class="panel panel-default" style="display: none">
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <fieldset style="padding: 10px ;" >
                                                <legend>Attacher fiche scannée</legend>
                                                <div class="col-lg-12">
                                                    <div class="content">
                                                        <input type="button" value="SCAN NOUVEAUX DOCUMENT" ng-click="ScanDocDemandeachat();" class="btn btn-info">
                                                        <input ng-click="ValiderAttachementDoucumentachat(detailfrs.demandedeprixid)" type="button" value="VALIDER ATTACHEMENT" ng-click="" class="btn btn-info">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset style="padding: 10px;">
                                                <div class="col-lg-12" >
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
                                        <a id="annule_button" class="btn btn-outline btn-danger" 
                                           onclick="AnnulerContrat('<?php echo $contratachat->getId(); ?>', '<?php echo $documentachat->getId() ?>')">
                                            Annuler ==> <?php echo $numero; ?></a>
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

<script  type="text/javascript">

    function AnnulerContrat(idcontrat, iddocachat) {
        if ($('#motif').val() != '') {
            $.ajax({
                url: '<?php echo url_for('documentachat/validerAnnulationContratprovisoire') ?>',
                data: 'motif=' + $('#motif').val() + '&id=' + idcontrat + '&url=' + $('#scan_url').val() + '&id_docachat=' + iddocachat,
                success: function (data) {
                    $('#annule_button').hide();
                    bootbox.dialog({
                        message: "<span class='bigger-110' style='margin:20px;'>Contrat Achat Provisoire annulé !</span>",
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
        } else {
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Veuillez saisir le motif d'annulation !</span>",
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
    }

</script>