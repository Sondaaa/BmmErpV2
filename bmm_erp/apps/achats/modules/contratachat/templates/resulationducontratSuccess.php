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
    /*     * *******les factures**************** */
    $doc_factures = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_docparent=' . $documentachat->getId())
                    ->andWhere('id_contrat=' . $contratachat->getId())
                    ->andWhere('id_typedoc=15')
                    ->orderBy('id asc')->execute();
    ?>
    <div id="sf_admin_content">
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Détail</a></li>
                <li class=""><a href="#facture" data-toggle="tab" aria-expanded="true">Détail Factures</a></li>
                <li class=""><a href="#annulation" data-toggle="tab" aria-expanded="false">Resiliation</a></li>
            
              <li class=""><a href="#documentscan" data-toggle="tab" aria-expanded="false">Scan</a></li>
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

                <div class="tab-pane" style="height:1000pt;overflow:auto" id="facture">

                    <div class=" col-lg-12">
                        <?php
                        $resultat_fin = 0;
                        if (sizeof($doc_factures) >= 1):
                            foreach ($doc_factures as $fac):
                                ?>
                                <?php echo html_entity_decode($documentachat->ReadHtmlListeFactureImression($fac->getId())); ?> 
                                <?php
                                $resultat_fin+=$fac->getMntttc();
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
                <div class="tab-pane" style="height: 670px;" id="annulation">
                    <div  class="col-xs-12 col-lg-12">
                        <div id="sf_admin_content" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div style="margin-bottom: 25px;">
                                        <legend>Motif</legend>
                                        <textarea id="motif"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="margin-bottom: 25px;">
                                        <legend>Engagement Budget</legend>
                                        <table style="margin-bottom: 0px;">
                                            <thead>
                                                <tr ><th colspan="3">Montant Contrat</th> </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Montant Total Contrat: <input type="text" class="form-control align_right disabledbutton" 
                                                                                      value="<?php
                                                                                      echo number_format($contratachat->getMontantcontrat(), 3, ".", " ")
                                                                                      ?>" 
                                                                                      id="mnt_contrat" >
                                                    </td>
                                                    <td>
                                                        Montant Consommé du Contrat: <input type="text" class="form-control align_right disabledbutton" 
                                                                                            value="<?php
                                                                                            echo number_format($resultat_fin, 3, ".", " ")
                                                                                            ?>" 
                                                                                            id="montant_contrat_consomme" >
                                                        <input type="hidden" value="<?php echo $resultat_fin; ?>" id="mnt_contrat_consomme">
                                                    </td>
                                                    <td><?php $rest_contrat = $contratachat->getMontantcontrat() - $resultat_fin; ?>
                                                        Montant Restant du Contrat: <input type="text" class="form-control align_right disabledbutton" 
                                                                                           value="<?php
                                                                                           echo number_format($rest_contrat, 3, ".", " ")
                                                                                           ?>" 
                                                                                           id="montant_contrat_restant" >
                                                        <input type="hidden"  value="<?php echo $rest_contrat; ?>"  id="mnt_contrat_restant" >
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table>
                                            <tr>
                                                <td colspan="2">

                                                    <table style="margin-bottom: 2px;">
                                                        <thead>
                                                            <tr>
                                                                <th>Crédit Réservé</th>
                                                                <th>Crédit Engagé</th>
                                                                <th>Reliquat</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        $piecejointbudget = PiecejointbudgetTable::getInstance()->findOneByIdDocachatAndIdType($documentachat->getId(), 1);
                                                        if (sizeof($piecejointbudget) >= 1) {
                                                            $doc_budget = DocumentbudgetTable::getInstance()->find($piecejointbudget->getIdDocumentbudget());
                                                            $ligne = LigprotitrubTable::getInstance()->find($doc_budget->getIdBudget());
                                                        }
                                                        ?>
                                                        <tr class="disabledbutton">
                                                            <td>
                                                                <ul>
                                                                    <li>Alloué: <input type="text" class="form-control align_right" 
                                                                                       value="<?php
                                                                                       if ($ligne && $ligne->getIdTitre())
                                                                                           echo number_format($ligne->getMnt(), 3, ',', '.');
                                                                                       ?>" 
                                                                                       id="mnt" >
                                                                    </li>

                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <ul>
                                                                    <li>Définitive: <input type="text" class="form-control align_right"
                                                                                           value="<?php
                                                                                           if ($ligne && $ligne->getIdTitre() && $ligne->getMntengage())
                                                                                               echo number_format($ligne->getMntengage(), 3, ',', '.');
                                                                                           ?>" 
                                                                                           id="mnt_engage">

                                                                    </li>

                                                                </ul>
                                                            </td>
                                                            <td>

                                                                <ul>
                                                                    <li>Définitive: <input type="text" class="form-control align_right"
                                                                                           value="<?php echo number_format($ligne->getRelicaengager(), 3, ',', '.'); ?>"
                                                                                           id="mnt_reliq">
                                                                    </li>

                                                                </ul>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </td>
                                            </tr>
                                        </table>

                                        <table>
                                            <tr>
                                                <td colspan="2">
                                            <legend>Résiliation Contrat</legend>
                                            <table style="margin-bottom: 2px;">
                                                <thead>
                                                    <tr>
                                                        <th>Crédit Réservé</th>
                                                        <th>Crédit Engagé</th>
                                                        <th>Reliquat</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $piecejointbudget = PiecejointbudgetTable::getInstance()->findOneByIdDocachatAndIdType($documentachat->getId(), 1);
                                                if (sizeof($piecejointbudget) >= 1) {
                                                    $doc_budget = DocumentbudgetTable::getInstance()->find($piecejointbudget->getIdDocumentbudget());
                                                    $ligne = LigprotitrubTable::getInstance()->find($doc_budget->getIdBudget());
                                                }
                                                ?>
                                                <tr class="disabledbutton">
                                                    <td>
                                                        <ul>
                                                            <li>Alloué: <input type="text" class="form-control align_right" 
                                                                               value="<?php
                                                                               if ($ligne && $ligne->getIdTitre())
                                                                                   echo number_format($ligne->getMnt(), 3, ',', '.');
                                                                               ?>" 
                                                                               id="mnt" >
                                                            </li>

                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <?php $reste_eng_definitif = floatval($ligne->getMntengage() - ($contratachat->getMontantcontrat() - $resultat_fin)); ?>
                                                            <li>Définitive: <input type="text" class="form-control align_right"
                                                                                   value="<?php
                                                                                   echo number_format($reste_eng_definitif, 3, ',', '.');
                                                                                   ?>" 
                                                                                   id="credit_contrat">

                                                                <input type="hidden"  value="<?php echo $reste_eng_definitif; ?>" id="credit">        
                                                            </li>

                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <?php $reliquat_eng_definitif = $ligne->getRelicaengager() + ($contratachat->getMontantcontrat() - $resultat_fin); ?>
                                                        <ul>
                                                            <li>Définitive: <input type="text" class="form-control align_right"
                                                                                   value="<?php echo number_format($reliquat_eng_definitif, 3, ',', '.'); ?>"
                                                                                   id="reliq_contrat">
                                                                <input type="hidden"  value="<?php echo $reliquat_eng_definitif; ?>"  id="reliq">

                                                            </li>

                                                        </ul>
                                                    </td>
                                                </tr>

                                            </table>
                                            </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div>
                                    <a id="annule_button" class="btn btn-outline btn-danger" 
                                       onclick="ResilierContratDefinitif('<?php echo $contratachat->getId(); ?>', '<?php echo $documentachat->getId() ?>')">
                                        Résilier   ==> <?php echo $numero; ?></a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
               

                    <div id="documentscan"  style="height: 500pt;"class="tab-pane"  >
                        <div id="sf_admin_content" class="col-xs-12 col-lg-12" ng-controller="CtrlScan">
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

    function ResilierContratDefinitif(idcontrat, iddocachat) {
        if ($('#motif').val() != '') {
            $.ajax({
                url: '<?php echo url_for('contratachat/validerResiliationContratdefinitif') ?>',
                data: 'motif=' + $('#motif').val() + '&id=' + idcontrat +
                        '&id_docachat=' + iddocachat
                        + '&reliq=' + $('#reliq').val() + '&credit=' + $('#credit').val()
                        + '&mnt_contrat_restant=' + $('#mnt_contrat_restant').val()
                        + '&mnt_contrat_consomme=' + $('#mnt_contrat_consomme').val()
                ,
                success: function (data) {
//                    $('#annule_button').hide();
                    bootbox.dialog({
                        message: "<span class='bigger-110' style='margin:20px;'>Contrat Achat Définitif annulé !!!!</span>",
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