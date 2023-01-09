
<div id="right-menu" class="modal aside" data-body-scroll="false" data-offset="true" data-placement="right" data-fixed="true" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="white">&times;</span>
                    </button>
                    (*) INFORMATIONS 
                    <?php  
//                    $ids = substr($ids, 0, -1);
//                $ids = explode(',', $ids);
//                    die($ids[0].'ppp');
                    ?>
                </div>
            </div>
            <div class="modal-body">
                <h6 class="lighter">(*) Le taux de la retenue est de :</h6>
                <ul style="margin: 0 0 10px 20px;">
                    <li class="info_modal"><span class="grand_point">.</span> 2,5 % pour les honoraires payés aux personnes morales et les personnes physique soumises à l'IR selon le régime réel.</li>
                    <li class="info_modal"><span class="grand_point">.</span> 5 % pour les honoraires servis aux personnes physiques non soumises à l'IR selon le régime réel.</li>
                    <li class="info_modal"><span class="grand_point">.</span> 15 % pour les honoraires payés aux non résidents.</li>
                    <li class="info_modal"><span class="grand_point">.</span> 20 % RCM et jetons.</li>
                    <li class="info_modal"><span class="grand_point">.</span> 1,5 % dans tous les autres cas et si le montant total TVA comprise (3) est >= 1000.</li>
                </ul>
                <hr>
                <h6 class="lighter">(*) Montant Ordonnance :</h6>
                <div style="text-align: justify; margin-top: 15px;">
                    <span style="color: #7EB175;">Net à payer</span> = Montant - ( TVA retenue à la source 25%  + Montant de la retenue )
                </div>
            </div>
        </div><!-- /.modal-content -->

        <button class="aside-trigger btn btn-info btn-app btn-xs ace-settings-btn" data-target="#right-menu" data-toggle="modal" type="button">
            <i data-icon1="fa-plus" data-icon2="fa-minus" class="ace-icon fa fa-plus bigger-110 icon-only"></i>
        </button>
    </div><!-- /.modal-dialog -->
</div>

<div id="sf_admin_container">
    <h1 id="replacediv">Certificat de Retenue à la Source</h1>
    <div id="sf_admin_content">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xs-6">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="widget-title smaller">Informations sur la Société</h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main" style="padding-bottom: 0px;">
                                <legend>A/ ORGANISME DEBITEUR</legend>
                                <table>
                                    <tr>
                                        <td style="width: 30%;">Nom ou raison sociale</td>
                                        <td><?php echo $societe->getRs() ?></td>
                                    </tr>
                                    <tr>
                                        <td>Activité</td>
                                        <td><?php echo $societe->getActivite() ?></td>
                                    </tr>
                                    <tr>
                                        <td>Adresse</td>
                                        <td><?php echo $societe->getAdresse() ?></td>
                                    </tr>
                                </table>

                                <?php
                                $matricule_fiscale = trim($societe->getMatfiscal());
                                $matricule_fiscale = str_replace("/", "", $matricule_fiscale);
                                $size_matricule = strlen($matricule_fiscale);
                                ?>
                                <h4 style="text-align: center; font-weight: bold;">IDENTIFIANT</h4>
                                <table style="margin-bottom: 10px;">
                                    <tr style="text-align: center">
                                        <td colspan="8">Matricule fiscal</td>
                                        <td>Code TVA</td>
                                        <td>Code catégorie</td>
                                        <td colspan="3">N° Etablissement secondaire</td>
                                    </tr>
                                    <tr style="text-align: center">
                                        <?php if ($societe->getMatfiscal() != null): ?>
                                            <?php for ($j = 0; $j <= 12; $j++): ?>
                                                <?php if ($size_matricule - $j >= 0): ?>
                                                    <td><?php echo $matricule_fiscale[$j]; ?></td>
                                                <?php else: ?> 
                                                    <td></td>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        <?php else: ?>
                                            <td style="height: 35.8px;"></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            <td></td>
                                            <td></td>

                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="widget-title smaller">Informations du bénéficiaire</h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main" style="padding-bottom: 0px;">
                                <legend>B/ DESIGNATION DU BENEFICIAIRE</legend>
                                <table>
                                    <tr>
                                        <td style="width: 30%;">Nom ou raison sociale</td>
                                        <td><?php echo $fournisseur->getRs() ?></td>
                                    </tr>
                                    <tr>
                                        <td>Activité</td>
                                        <td><?php echo $fournisseur->getActivitetiers() ?></td>
                                    </tr>
                                    <tr>
                                        <td>Adresse</td>
                                        <td><?php echo $fournisseur->getAdr() ?></td>
                                    </tr>
                                </table>

                                <?php
                                $matricule_fiscale = trim($fournisseur->getMatriculefiscale());
                                $matricule_fiscale = str_replace("/", "", $matricule_fiscale);
                                $size_matricule = strlen($matricule_fiscale);
                                ?>

                                <h4 style="text-align: center; font-weight: bold;">IDENTIFIANT</h4>
                                <table style="margin-bottom: 10px;">
                                    <tr style="text-align: center">
                                        <td colspan="8">Matricule fiscal</td>
                                        <td>Code TVA</td>
                                        <td>Code catégorie</td>
                                        <td colspan="3">N° Etablissement secondaire</td>
                                    </tr>
                                    <tr style="text-align: center">
                                        <?php if ($fournisseur->getMatriculefiscale() != null): ?>
                                            <?php for ($j = 0; $j <= 12; $j++): ?>
                                                <?php if ($size_matricule - $j >= 0): ?>
                                                    <td><?php echo $matricule_fiscale[$j]; ?></td>
                                                <?php else: ?>  
                                                    <td></td>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        <?php else: ?>
                                            <td style="height: 35.8px;"></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            <td></td>
                                            <td></td>

                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $ids = substr($ids, 0, -1);
                $ids = explode(',', $ids);
                ?>

                <?php
                $total_doc_ttc = 0;
                $objet_reglement = '';
                $docachats = DocumentachatTable::getInstance()->getByIds($ids);
                foreach ($docachats as $docachat):
                    if ($docachat->getIdTypedoc() == 15) {
                        $objet_reglement = $objet_reglement . $docachat->getNumero() . '+';
                        $total_doc_ttc = $total_doc_ttc + $docachat->getMntttc();
//                        print $docachat->getMntttc();
                    }
                endforeach;
                $objet_reglement = substr($objet_reglement, 0, -1);
                ?>

                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="widget-title smaller">Informations sur le marché</h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main" style="padding-bottom: 0px;">
                                <legend>C/ INFORMATIONS RELATIVES AU MARCHE</legend>
                                <table style="margin-bottom: 10px;">
                                    <tr>
                                        <td style="width: 30%;">Objet du règlement</td>
                                        <td><input id="objet_reglement" type="text" value="<?php echo $objet_reglement; ?>" placeholder="Objet du règlement ..." /></td>
                                    </tr>
                                    <tr>
                                        <td>Montant TTC</td>
                                        <td><input id="montant_document_achat" readonly="true" type="text" value="<?php echo number_format($total_doc_ttc, 3, '.', ' '); ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td>Numéro d'ordonnance</td>
                                        <td><input readonly="true" type="text" value="<?php echo $documentbudget->getNumero(); ?>" /></td>
                                    </tr>
                                    <tr style="background-color: #A4D59C;">
                                        <td>Montant ordonnance Net à payer*</td>
                                        <td><input id="montant_ordonnance_net_payer" readonly="true" type="text" value="" /></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <?php $lignes = TvaTable::getInstance()->getBaseTvaByDocsContrat($ids);
               ?>
                <?php $retenues = RetenuesourceTable::getInstance()->getAll(); ?>

                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="widget-title smaller">Informations sur les montants</h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main" style="padding-bottom: 0px;">
                                <legend>D/ MONTANTS PAYES</legend>
                                <table id="liste_ligne">
                                    <thead>
                                        <tr style="text-align: center; font-weight: bold; background-color: #F0F0F0;">
                                            <td rowspan="2" style="width: 14%;">Montant<br>hors TVA<br>(1)</td>
                                            <td rowspan="2" style="width: 10%;">Taux<br>TVA<br>(2)</td>
                                            <td rowspan="2" style="width: 13%;">TVA<br>due<br>(1) X (2)</td>
                                            <td rowspan="2" style="width: 14%;">Montant total<br>TVA comprise<br>(3)</td>
                                            <td rowspan="2" style="width: 14%;">
                                                TVA retenue<br>à la source 25%<br>(1) X (2) / 4
                                                <?php if (!$fournisseur->getCertificatrs()): ?>
                                                    <br>
                                                    <span style="color: #B52626;">
                                                        (1) X (2) >= 1000.000
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td colspan="2">Retenue à la source IR/IS</td>
                                        </tr>
                                        <tr style="text-align: center; font-weight: bold; background-color: #F0F0F0;">
                                            <td style="width: 12%;">Taux de la retenue (4)*</td>
                                            <td style="width: 18%;">Montant de la retenue (3) X (4)</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total_montant_hors_tva = 0;
                                        $total_tva_due = 0;
                                        $total_montant_tva_comprise = 0;
                                        $total_tva_retenue = 0;
                                        ?>
                                        <?php foreach ($lignes as $ligne):
                                           ?>
                                            <tr style="text-align: center;">
                                                <td><input class="align_right" readonly="true" type="text" value="<?php echo number_format($ligne->getMntht(), 3, '.', ' '); ?>"></td>
                                                <td><input class="align_center" readonly="true" type="text" value="<?php echo number_format($ligne->getValeurtva(), 2, '.', ' '); ?>"></td>
                                                <td><input class="align_right" readonly="true" type="text" value="<?php echo number_format($ligne->getMnttva(), 3, '.', ' '); ?>"></td>
                                                <td><input class="align_right" readonly="true" type="text" value="<?php echo number_format($ligne->getMntttc(), 3, '.', ' '); ?>"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <?php
                                            $total_montant_hors_tva = $total_montant_hors_tva + $ligne->getMntht();
                                            $total_tva_due = $total_tva_due + $ligne->getMnttva();
                                            $total_montant_tva_comprise = $total_montant_tva_comprise + $ligne->getMntttc();
                                            ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <?php
                                        if ($fournisseur->getCertificatrs()):
                                            $total_tva_retenue = $total_tva_due / 4;
                                        else:
                                            if ($total_montant_tva_comprise >= 1000)
                                                $total_tva_retenue = $total_tva_due / 4;
                                            else
                                                $total_tva_retenue = 0;
                                        endif;
                                        ?>
                                        <tr style="background-color: #F0F0F0;">
                                            <td><input class="align_right" readonly="true" type="text" value="<?php echo number_format($total_montant_hors_tva, 3, '.', ' '); ?>"></td>
                                            <td></td>
                                            <td><input class="align_right" readonly="true" type="text" value="<?php echo number_format($total_tva_due, 3, '.', ' '); ?>"></td>
                                            <td><input id="montant_total_tva_comprise" class="align_right" readonly="true" type="text" value="<?php echo number_format($total_montant_tva_comprise, 3, '.', ' '); ?>"></td>
                                            <td><input id="total_tva_retenue" class="align_right" readonly="true" type="text" value="<?php echo number_format($total_tva_retenue, 3, '.', ' '); ?>"></td>
                                            <td>
                                                <select id="taux_retenue" onchange="calculeTotal()">
                                                    <option value="0" valeur="0"></option>
                                                    <?php foreach ($retenues as $retenue): ?>
                                                        <option value="<?php echo $retenue->getId() ?>" valeur="<?php echo $retenue->getValeurretenue() ?>"><?php echo $retenue->getLibelle() ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td><input id="total_montant_retenue" class="align_right" readonly="true" type="text" value="0.000"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="zone_save_button">
        <div class="col-xs-12">
            <hr style="margin-bottom: 10px;">
            <a href="<?php echo url_for('documentbudget/index?idtype=2') ?>" class="btn btn-xs btn-success" style="float: right; margin-right: 1%;">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Retour à la Liste
            </a>
            <button class="btn btn-xs btn-primary" type="button" style="float: right; margin-right: 1%;" onclick="saveCertificat()">
                <i class="ace-icon fa fa-save bigger-110"></i>
                Enregistrer
            </button>
        </div>
    </div>
</div>

<script  type="text/javascript">

    var montant_retenue = 0;
    var montant_net = 0;
    function calculeTotal() {
        var option = {
            minimumFractionDigits: 3
        };
        var locale = 'fr-FR';
        var formatter = new Intl.NumberFormat(locale, option);
        var taux_retenue = $('#taux_retenue option:selected').attr("valeur");
        if (taux_retenue == '1.50') {
            if (parseFloat('<?php echo $total_montant_tva_comprise ?>') >= 1000)
                montant_retenue = parseFloat(parseFloat('<?php echo $total_montant_tva_comprise ?>') * parseFloat(taux_retenue)) / 100;
            else
                montant_retenue = 0;
        } else {
            montant_retenue = parseFloat(parseFloat('<?php echo $total_montant_tva_comprise ?>') * parseFloat(taux_retenue)) / 100;
        }
        $('#total_montant_retenue').val(formatter.format(parseFloat(montant_retenue)));
        var total_retenue = parseFloat(parseFloat('<?php echo $total_tva_retenue ?>') + parseFloat(montant_retenue));
        montant_net = parseFloat(parseFloat('<?php echo $total_doc_ttc; ?>') - parseFloat(total_retenue));
        $('#montant_ordonnance_net_payer').val(formatter.format(parseFloat(montant_net)));
    }

    function saveCertificat() {
        if (($('#taux_retenue').val() != '0')) {
            $.ajax({
                url: '<?php echo url_for('documentbudget/saveCertificatRetenue') ?>',
                data: 'fournisseur_id=' + '<?php echo $fournisseur->getId(); ?>' +
                        '&ordonnance_id=' + '<?php echo $documentbudget->getId(); ?>' +
                        '&objet_reglement=' + $('#objet_reglement').val() +
                        '&montant=' + '<?php echo $total_doc_ttc; ?>' +
                        '&montant_net_ttc=' + parseFloat(montant_net).toFixed(3) +
                        '&montant_ht=' + '<?php echo $total_montant_hors_tva; ?>' +
                        '&tva_due=' + '<?php echo $total_tva_due; ?>' +
                        '&tva_comprise=' + '<?php echo $total_montant_tva_comprise; ?>' +
                        '&tva_retenue=' + '<?php echo $total_tva_retenue; ?>' +
                        '&retenu_id=' + $('#taux_retenue').val() +
                        '&montant_retenue=' + parseFloat(montant_retenue).toFixed(3),
                success: function (data) {
//                    $('#zone_save_button').hide();
                    bootbox.dialog({
                        message: "<span class='bigger-160' style='margin:20px;color:#15b365;'>Certificat enregistré avec succès !</span>",
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
                message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Il faut choisir le taux de la retenue !</span>",
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

<style>

    .align_right{text-align: right !important;}
    .align_center{text-align: center !important;}
    .info_modal{text-align: justify; margin-top: 5px; font-weight: normal;}
    .lighter{font-weight: bold;}
    .grand_point{font-size: 22px;}
    h6{font-size: 14px;}


</style>