<?php $piecejointbudget = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($documentachat->getId()); ?>
<?php $document_budget = $piecejointbudget->getDocumentbudget();
$docparent=DocumentachatTable::getInstance()->find($mvt->getIdDocumentachat());

$facture = DocumentachatTable::getInstance()->findOneByIdAndIdTypedoc($docparent->getId(), 15);

if (!$facture) {
    $bcej = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdTypedoc($docparent->getId(), 16);
    if ($bcej)
        $facture = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdTypedoc($bcej->getId(), 15);
    else
        $facture = null;
}
?>
<div id="sf_admin_container">
    <h1 id="replacediv">
        Fiche ordonnance de paiement <?php echo $document_budget->getNumerodocachat() ?>
    </h1>
    <div class="panel-body">
         <div class="row">
            <div class="col-sm-6">
                <div class="tab-content">
                    <p>
                        <i class="green ace-icon fa fa-user bigger-120"></i>
                        Informations d'engagement
                    </p>
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
                                <td style="width: 70%;"><?php echo $_SESSION['exercice_budget']; ?></td>
                            </tr>
                            <tr>
                                <td><label>Titre Budget</label></td>
                                <td><?php echo $document_budget->getLigprotitrub()->getTitrebudjet()->getLibelle(); ?></td>
                            </tr>
                            <tr>
                                <td><label>Rubrique</label></td>
                                <td><?php echo $document_budget->getLigprotitrub()->getRubrique(); ?></td>
                            </tr>

                           <?php if ($document_budget->getLigprotitrub()->getRubrique()->getSousRubriqueBudgetaire()) :
                            $sousrubrique=$document_budget->getLigprotitrub()->getRubrique()->getSousRubriqueBudgetaire();
                            ?>
                                <tr>
                                    <td><label>Sous Rubrique</label></td>
                                    <td><?php echo $sousrubrique->getLibelle(); ?></td>
                                </tr>

                            <?php endif;?>
                            <tr>
                                <td><label>Document(s) Achat(s)</label></td>
                                <td colspan="3"><?php echo str_replace('-', ' - ', $document_budget->getListesDocumentAchatByDocumentBudget()); ?></td>
                            </tr>
                            <tr>
                                <td><label>Mnt.</label></td>
                                <td colspan="3"><?php echo number_format($document_budget->getMnt(), 3, "."," "); ?> TND</td>
                            </tr>
                            <tr>
                                <td><label>Mnt Engagé</label></td>
                                <td colspan="3"><?php echo number_format($document_budget->getMntengage(), 3, "."," "); ?> TND</td>
                            </tr>
                            <tr>
                                <td><label>Reliquat Engagé</label></td>
                                <td><?php echo number_format($document_budget->getMntrelicat(), 3, "."," "); ?> TND</td>
                            </tr>
                        </tbody>
                    </table>


                    <?php if ($facture) : ?>
                        <?php
                        $difference = 0;
                        $mvt_id = '';
                        $type = 'Totale';
                        ?>
                        <?php if (trim($documentachat->getEtatdocachat()) != "Annulé(e)") : ?>
                            <button id="valide_button" class="btn btn-sm btn-success" onclick="validerDocument()">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                <span class="bigger-110 no-text-shadow">Enregistrer Ordonnance</span>
                            </button>
                        <?php else : ?>
                            <h4>Ajuster Engagement :</h4>
                            <?php
                            if ($mvt) :
                                $difference = $mvt->getMontant() - $mvt->getDocumentachat()->getMntttc();
                                $mvt_id = $mvt->getId();
                            endif;
                            ?>
                            <?php if ($difference != 0) : ?>
                                <?php $type = 'Partielle'; ?>
                                <table>
                                    <tr>
                                        <td colspan="2" style="text-align: center; font-size: 16px;">Ajustement Partielle</td>
                                    </tr>
                                    <tr>
                                        <td>Montant Facture</td>
                                        <td><input type="text" class="align_right" value="<?php echo number_format($mvt->getMontant(), 3, "."," "); ?>" readonly="true" /></td>
                                    </tr>
                                    <tr>
                                        <td>Montant <?php echo $mvt->getDocumentachat(); ?></td>
                                        <td><input type="text" class="align_right" value="<?php echo number_format($mvt->getDocumentachat()->getMntttc(), 3, "."," "); ?>" readonly="true" /></td>
                                    </tr>
                                    <tr>
                                        <td>Montant Ecart</td>
                                        <td><input type="text" class="align_right" value="<?php echo number_format($difference, 3, "."," "); ?>" readonly="true" /></td>
                                    </tr>
                                </table>
                                <?php if (($difference < 0) && (date('Y', strtotime($document_budget->getDatecreation())) < date('Y'))) : ?>
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
                                                    ->Where("trim(typebudget) not like trim('Prototype') ")
                                                    ->andWhere("trim(typebudget) not like trim('%Budget Prévisionnel / Direction & Projet%') ")
                                                    ->andWhere("trim(typebudget) not like trim('%Budget Prévisionnel Global%') ")
                                                    ->orWhere("trim(typebudget) like trim('Exercice:" . date('Y') . "') ")
                                                    ->andWhere("id_tranches is not null and id_tranches <>'' ")
                                                    ->orderBy('id asc')->execute();
                                                ?>
                                                <select id="budget">
                                                    <option value="0">Sélectionnez</option>
                                                    <?php foreach ($budgets as $budget) : ?>
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
                                <?php else : ?>
                                    <button id="annule_button" onclick="annulerEngagement()" class="btn btn-sm btn-default" style="margin-top: 10px; float: right;">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">Ajuster Engagement</span>
                                    </button>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php $type = 'Totale'; ?>
                                <?php $difference = $mvt->getMontant(); ?>
                                <table>
                                    <tr>
                                        <td style="text-align: center; font-size: 16px;">Ajustement Total (Annulation Totale)</td>
                                    </tr>
                                </table>
                                <button id="annule_button" onclick="annulerEngagement()" class="btn btn-sm btn-default" style="margin-top: 10px; float: right;">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    <span class="bigger-110 no-text-shadow">Ajuster Engagement</span>
                                </button>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="tab-content">
                    <p>
                        <i class="green ace-icon fa fa-eye bigger-120"></i>
                        Détails
                    </p>
                    <a class="btn btn-xs btn-danger btn-sm" href="<?php echo $documentachat->getLinkDocument() ?>" target="_blanc">
                        <i class="fa fa-file-pdf-o"></i> Exporter PDF <?php echo $documentachat->getTypedoc()?>
                    </a> 
                    <?php if($facture):?>
                    <a class="btn btn-xs btn-danger btn-sm" href="<?php echo  $facture->getLinkDocument() ?>" target="_blanc">
                        <i class="fa fa-file-pdf-o"></i> Exporter PDF <?php echo $facture->getTypedoc()?>
                    </a> 
                    <?php endif;?>           
                    <?php echo html_entity_decode($documentachat->HtmlByType()); ?>
                    <?php if($facture):?> 
                    <?php echo html_entity_decode($facture->HtmlByType()); ?>
                    <?php endif;?>   
                </div>
            </div>

        </div>



    </div>
</div>

<script type="text/javascript">
    function annulerEngagement() {
        $.ajax({
            url: '<?php echo url_for('documentbudget/annulerEngagement') ?>',
            data: 'id_ligprotitrub=<?php echo $document_budget->getLigprotitrub()->getId(); ?>' +
                '&iddoc=<?php echo $documentachat->getId(); ?>' +
                '&montantecart=<?php echo $difference; ?>' +
                '&totale=<?php echo $type; ?>' +
                '&id_lignemouvement=<?php echo $mvt_id; ?>',
            success: function(data) {
                $('#annule_button').hide();
                bootbox.dialog({
                    message: "<span class='bigger-160' style='margin:20px;color:#15b365;'>Engagement annulé avec succès !</span>",
                    buttons: {
                        "button": {
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
                    '&iddoc=<?php echo $documentachat->getId(); ?>' +
                    '&montantecart=<?php echo $difference; ?>' +
                    '&totale=<?php echo $type; ?>' +
                    '&id_lignemouvement=<?php echo $mvt_id; ?>' +
                    '&idtype=2',
                success: function(data) {
                    $('#ecart_button').hide();
                    bootbox.dialog({
                        message: "<span class='bigger-160' style='margin:20px;color:#15b365;'>Ecart engagé avec succès !<br>l'ordonnance de paiement est passé avec succès !</span>",
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
                message: "<span class='bigger-160' style='margin:20px;color:#b31515;'>Veuillez choisir un N° D'engagement !</span>",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    function validerDocument() {
        $.ajax({
            url: '<?php echo url_for('documentbudget/validerOrdonnance') ?>',
            data: 'idbudget=<?php echo $document_budget->getLigprotitrub()->getId(); ?>' +
                '&iddoc=<?php echo $documentachat->getId(); ?>' +
                '&idtype=2' +
                '&idpreengagement=<?php echo $document_budget->getId(); ?>',
            success: function(data) {
                $('#valide_button').hide();
                bootbox.dialog({
                    message: "<span class='bigger-160' style='margin:20px;color:#15b365;'>Engagement validé avec succès !</span>",
                    buttons: {
                        "button": {
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
    .table,
    .table-bordered table-hover {
        margin-bottom: 0px;
    }

    h3 {
        text-align: center;
    }
</style>