<div id="sf_admin_container">
    <h1 id="replacediv"> 
        Détails <?php echo $documentachat->getNumerodocachat() ?>
    </h1>
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#accuelbci" data-toggle="tab" aria-expanded="true">Détails</a>
            </li>
            <li class=""><a href="#engagement" data-toggle="tab" aria-expanded="false" onclick="setAffichage()">Engagement</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="accuelbci">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo html_entity_decode($documentachat->ReadHtmlFactureImressionBDCG($id_docparent)); ?> 
                        <a style="float: right; margin-right: 2%;" class="btn btn-white btn-default" href="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=') . $documentachat->getId() ?>" target="_blanc">Exporter PDF</a>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="engagement">
                <?php  
                $piecejointbudget = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($documentachat->getId()); ?>
                <?php $document_budget = $piecejointbudget->getDocumentbudget(); ?>
                <?php 
                //Charger facture d'aprés BCE Système
                $facture = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdTypedoc($mvt->getDocumentachat()->getId(), 15);
                if (!$facture) {
                    //Carger facture d'aprés BCEJ
                    $bcej = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdTypedoc($mvt->getDocumentachat()->getId(), 16);
                    if ($bcej)
                        $facture = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdTypedoc($bcej->getId(), 15);
                    else
                        $facture = null;
                }
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-md-12">
                            <div id="sf_admin_content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <!-- /.panel-heading -->
                                            <div class="panel-body">
                                                <legend>Informations d'engagement</legend>
                                                <div class="col-lg-12">
                                                    <div class="content">
                                                        <?php $date = date('Y', strtotime($document_budget->getLigprotitrub()->getTitrebudjet()->getDatecreation())); ?>
                                                        <table border="1" style="padding:1%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 30%;"><label>Numéro</label></td>
                                                                    <td style="width: 70%;"><?php echo $document_budget->getNumerodocachat(); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Date Création</label></td>
                                                                    <td><?php echo date('d/m/Y', strtotime($document_budget->getDatecreation())); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Etat || Type Document </label></td>
                                                                    <td><?php echo $document_budget->getTypedocbudget(); ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <h3>Informations sur le Budget</h3>
                                                        <table border="1" style="padding:1%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 30%;"><label>Exercice</label></td>
                                                                    <td style="width: 70%;"><?php echo $_SESSION['exercice_budget'];
                                                                    //date('Y', strtotime($document_budget->getDatecreation())); ?></td>                    
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Titre Budget</label></td>
                                                                    <td><?php echo $document_budget->getLigprotitrub()->getTitrebudjet()->getLibelle(); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Rubrique</label></td>
                                                                    <td><?php echo $document_budget->getLigprotitrub()->getRubrique(); ?></td>
                                                                </tr>

                                                                <?php $sousrubrique = Doctrine_Core::getTable('rubrique')->findOneByIdRubrique($document_budget->getLigprotitrub()->getIdRubrique()); ?>
                                                                <?php if ($sousrubrique): ?>
                                                                    <tr>
                                                                        <td><label>Sous Rubrique</label></td>
                                                                        <td><?php echo $sousrubrique->getLibelle(); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label>Document(s) Achat(s)</label></td>
                                                                        <td colspan="3"><?php echo str_replace('-', ' - ', $document_budget->getListesDocumentAchatByDocumentBudget()); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label>Mnt.</label></td>
                                                                        <td colspan="3"><?php echo number_format($document_budget->getMnt(), 3, ",", "."); ?> TND</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label>Mnt Engagé</label></td>
                                                                        <td colspan="3"><?php echo number_format($document_budget->getMntengage(), 3, ",", "."); ?> TND</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label>Reliquat  Engagé</label></td>
                                                                        <td><?php echo number_format($document_budget->getMntrelicat(), 3, ",", "."); ?> TND</td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.panel-body -->
                                        </div>
                                    </div>
                                    <?php if ($facture != null): ?>
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <!-- /.panel-heading -->
                                                <div class="panel-body">
                                                    <fieldset style="padding: 10px">
                                                        <legend>Actions</legend>
                                                        <div class="col-lg-12">
                                                            <div class="content">
                                                                <?php
                                                                $difference = 0;
                                                                $mvt_id = '';
                                                                $type = 'Totale';
                                                                ?>
                                                                <?php if (trim($documentachat->getEtatdocachat()) != "Annulé(e)"): ?>
                                                                    <button id="valide_button" class="btn btn-sm btn-success" onclick="validerDocumentFacturebdcg()">
                                                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                                                        <span class="bigger-110 no-text-shadow">Enregistrer Ordonnance</span>
                                                                    </button>
                                                                <?php else: ?>
                                                                    <h4>Ajuster Engagement :</h4>
                                                                    <?php
                                                                    if ($mvt):
                                                                        $difference = $mvt->getMontant() - $mvt->getDocumentachat()->getMntttc();
                                                                        $mvt_id = $mvt->getId();
                                                                    endif;
                                                                    ?>
                                                                    <?php if ($difference != 0): ?>
                                                                        <?php $type = 'Partielle'; ?>
                                                                        <table>
                                                                            <tr>
                                                                                <td colspan="2" style="text-align: center; font-size: 16px;">Ajustement Partielle</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Montant Facture</td>
                                                                                <td><input type="text" class="align_right" value="<?php echo number_format($mvt->getMontant(), 3, ",", "."); ?>" readonly="true" /></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Montant <?php echo $mvt->getDocumentachat(); ?></td>
                                                                                <td><input type="text" class="align_right" value="<?php echo number_format($mvt->getDocumentachat()->getMntttc(), 3, ",", "."); ?>" readonly="true" /></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Montant Ecart</td>
                                                                                <td><input type="text" class="align_right" value="<?php echo number_format($difference, 3, ",", "."); ?>" readonly="true" /></td>
                                                                            </tr>
                                                                        </table>
                                                                        <?php if (($difference < 0) && (date('Y', strtotime($document_budget->getDatecreation())) < date('Y'))): ?>
                                                                            <h3>Fiche Ordonnance de paiement</h3>
                                                                            <h4 style="text-align: center;">Imputation Budgetaire</h4>
                                                                            <table border="1" style="padding:1%" ng-controller="CtrlFormOrdonnance" ng-init="InialiserOrdonnance()">
                                                                                <tr>
                                                                                    <td><label>Date Création</label></td>
                                                                                    <td>
                                                                                        <input value="<?php echo date('Y-m-d') ?>" type="date" id="documentbudget_datecreation" readonly="true" min="<?php echo date('Y') ?>-01-01" max="<?php echo date('Y') ?>-12-31">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><label>Numéro</label></td>
                                                                                    <td>
                                                                                        <?php $documentbudget = new Documentbudget(); ?>
                                                                                        <input type="text" value="<?php echo $documentbudget->NumeroSeqDocumentAchat(2) ?>" id="documentbudget_numero" readonly="true">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><label>Exercice</label></td>
                                                                                    <td><?php echo $_SESSION['exercice_budget']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><label>Budget</label></td>
                                                                                    <td>
                                                                                        <?php
                                                                                        $annees = $_SESSION['exercice_budget'];
                                                                                        $budgets = Doctrine_Query::create()
                                                                                                        ->select("*")
                                                                                                        ->from('titrebudjet')
                                                                                                        ->where("Etatbudget=2")
                                                                                                        ->andwhere("trim(typebudget) not like trim('Prototype')  ")
                                                                                                        ->andwhere("trim(typebudget)  like trim('Exercice:" . $annees . "')  ")
                                                                                                        ->orderBy('id asc')->execute();
                                                                                        ?>
                                                                                        <select id="budget">
                                                                                            <option value="0">Sélectionnez</option>
                                                                                            <?php foreach ($budgets as $budget): ?>
                                                                                                <option value="<?php echo $budget->getId(); ?>"><?php echo $budget->getLibelle() ?></option>
                                                                                            <?php endforeach; ?>
                                                                                        </select>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><label>N° D'engagement*</label></td>
                                                                                    <td>
                                                                                        <input type="hidden" id="id_budget" value="">
                                                                                        <select id="numeroengaement" name="numeroengaement">

                                                                                        </select>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><label>Rubrique</label></td>
                                                                                    <td>
                                                                                        <input type="text" id="rubrique" value="">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><label>Crédits alloués</label></td>
                                                                                    <td>
                                                                                        <input type="text" class="align_right" readonly="true" value="" id="mnt">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><label>Crédits consommés</label></td>
                                                                                    <td>
                                                                                        <input type="text" class="align_right" readonly="true" value="" id="credit">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><label>Reliquat</label></td>
                                                                                    <td>
                                                                                        <input type="text" class="align_right" readonly="true" value="" id="reliq">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                            <button id="ecart_button" class="btn btn-sm btn-primary" onclick="validerEcartDocument()" style="float: right; margin-top: 15px;">
                                                                                <i class="ace-icon fa fa-lightbulb-o bigger-110"></i>
                                                                                <span class="bigger-110 no-text-shadow">Passer & Valider Ecart Engagement</span>
                                                                            </button>
                                                                        <?php else: ?>
                                                                            <button id="annule_button" onclick="annulerEngagement()" class="btn btn-sm btn-default" style="margin-top: 10px; float: right;">
                                                                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                                                                <span class="bigger-110 no-text-shadow">Ajuster Engagement</span>
                                                                            </button>
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        <?php $type = 'Totale'; ?>
                                                                        <?php $difference = $mvt->getMontant(); ?>
                                                                        <table>
                                                                            <tr><td style="text-align: center; font-size: 16px;">Ajustement Total (Annulation Totale)</td></tr>
                                                                        </table>
                                                                        <button id="annule_button" onclick="annulerEngagement()" class="btn btn-sm btn-default" style="margin-top: 10px; float: right;">
                                                                            <i class="ace-icon fa fa-undo bigger-110"></i>
                                                                            <span class="bigger-110 no-text-shadow">Ajuster Engagement</span>
                                                                        </button>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
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

<script  type="text/javascript">

    function annulerEngagement() {
        $.ajax({
            url: '<?php echo url_for('documentbudget/annulerEngagement') ?>',
            data: 'id_ligprotitrub=<?php echo $document_budget->getLigprotitrub()->getId(); ?>' +
                    '&iddoc=<?php echo $id_docparent; ?>' +
                    '&montantecart=<?php echo $difference; ?>' +
                    '&totale=<?php echo $type; ?>' +
                    '&id_lignemouvement=<?php echo $mvt_id; ?>',
            success: function (data) {
                $('#annule_button').hide();
                bootbox.dialog({
                    message: "<span class='bigger-160' style='margin:20px;color:#15b365;'>Engagement annulé avec succès !</span>",
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

    function validerEcartDocument() {
        if ($('#numeroengaement').val() != '' && $('#numeroengaement').val() != '0' && $('#numeroengaement').val() != null) {
            $.ajax({
                url: '<?php echo url_for('documentbudget/validerEcartEngagement') ?>',
                data: 'id_ligprotitrub=' + $('#numeroengaement').val() +
                        '&iddoc=<?php echo $id_docparent; ?>' +
                        '&montantecart=<?php echo $difference; ?>' +
                        '&totale=<?php echo $type; ?>' +
                        '&id_lignemouvement=<?php echo $mvt_id; ?>' +
                        '&idtype=2',
                success: function (data) {
                    $('#ecart_button').hide();
                    bootbox.dialog({
                        message: "<span class='bigger-160' style='margin:20px;color:#15b365;'>Ecart engagé avec succès !<br>l'ordonnance de paiement est passé avec succès !</span>",
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
                message: "<span class='bigger-160' style='margin:20px;color:#b31515;'>Veuillez choisir un N° D'engagement !</span>",
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

    function validerDocumentFacturebdcg() {
        $.ajax({
            url: '<?php echo url_for('documentbudget/validerOrdonnanceFacBDCG') ?>',
            data: 'idbudget=<?php echo $document_budget->getLigprotitrub()->getId(); ?>' +
                    '&iddoc=<?php echo $id_docparent; ?>' +
                    '&idtype=2' +
                    '&idpreengagement=<?php echo $document_budget->getId(); ?>',
            success: function (data) {
                $('#valide_button').hide();
                bootbox.dialog({
                    message: "<span class='bigger-160' style='margin:20px;color:#15b365;'>Ordonnace validé avec succès !</span>",
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

    function setAffichage() {
        $('.chosen-container').attr("style", "width: 100%;");
        $('.chosen-container').trigger("chosen:updated");
    }

</script>

<style>
    .table, .table-bordered table-hover{margin-bottom: 0px;}
    h3{text-align: center;}
</style>