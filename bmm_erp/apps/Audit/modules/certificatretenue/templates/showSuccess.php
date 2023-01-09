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
                                        <td colspan="7">Matricule fiscal</td>
                                        <td>Code TVA</td>
                                        <td>Code catégorie</td>
                                        <td colspan="3">N° Etablissement secondaire</td>
                                    </tr>
                                    <tr style="text-align: center">
                                        <?php if ($societe->getMatfiscal() != null): ?>
                                            <?php for ($j = 12; $j >= 1; $j--): ?>
                                                <?php if ($size_matricule - $j >= 0): ?>
                                                    <td><?php echo $matricule_fiscale[$size_matricule - $j]; ?></td>
                                                <?php else: ?>  
                                                    <td></td>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        <?php else: ?>
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
                                        <td colspan="7">Matricule fiscal</td>
                                        <td>Code TVA</td>
                                        <td>Code catégorie</td>
                                        <td colspan="3">N° Etablissement secondaire</td>
                                    </tr>
                                    <tr style="text-align: center">
                                        <?php if ($fournisseur->getMatriculefiscale() != null): ?>
                                            <?php for ($j = 12; $j >= 1; $j--): ?>
                                                <?php if ($size_matricule - $j >= 0): ?>
                                                    <td><?php echo $matricule_fiscale[$size_matricule - $j]; ?></td>
                                                <?php else: ?>  
                                                    <td></td>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        <?php else: ?>
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
                                            <td></td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

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
                                        <td><input readonly="true" type="text" value="<?php echo trim($certificat->getObjetreglement()); ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td>Montant TTC</td>
                                        <td><input id="montant_document_achat" readonly="true" type="text" value="<?php echo number_format($certificat->getMontantordonnance(), 3, '.', ' '); ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td>Numéro d'ordonnance</td>
                                        <td><input readonly="true" type="text" value="<?php echo $documentbudget->getNumero(); ?>" /></td>
                                    </tr>
                                    <tr style="background-color: #A4D59C;">
                                        <td>Montant ordonnance Net à payer</td>
                                        <td><input id="montant_ordonnance_net_payer" readonly="true" type="text" value="<?php echo number_format($certificat->getMontantordonnancenet(), 3, '.', ' '); ?>" /></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

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
                                        <tr style="text-align: center; font-weight: bold;">
                                            <td rowspan="2" style="width: 14%;">Montant<br>hors TVA<br>(1)</td>
                                            <td rowspan="2" style="width: 10%;">Taux<br>TVA<br>(2)</td>
                                            <td rowspan="2" style="width: 13%;">TVA<br>due<br>(1) X (2)</td>
                                            <td rowspan="2" style="width: 14%;">Montant total<br>TVA comprise<br>(3)</td>
                                            <td rowspan="2" style="width: 14%;">TVA retenue<br>à la source 25%<br>(1) X (2) / (4)</td>
                                            <td colspan="2">Retenue à la source IR/IS</td>
                                        </tr>
                                        <tr style="text-align: center; font-weight: bold;">
                                            <td style="width: 12%;">Taux de la retenue (4)</td>
                                            <td style="width: 18%;">Montant de la retenue (3) X (4)</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="background-color: #dbdbdb;">
                                            <td><input class="align_right" readonly="true" type="text" value="<?php echo number_format($certificat->getMontantht(), 3, '.', ' '); ?>"></td>
                                            <td></td>
                                            <td><input class="align_right" readonly="true" type="text" value="<?php echo number_format($certificat->getTvadue(), 3, '.', ' '); ?>"></td>
                                            <td><input class="align_right" readonly="true" type="text" value="<?php echo number_format($certificat->getTvacomprise(), 3, '.', ' '); ?>"></td>
                                            <td><input class="align_right" readonly="true" type="text" value="<?php echo number_format($certificat->getTvaretenue(), 3, '.', ' '); ?>"></td>
                                            <td><input class="align_center" readonly="true" type="text" value="<?php echo $certificat->getRetenuesource()->getValeurretenue(); ?> %"></td>
                                            <td><input class="align_right" readonly="true" type="text" value="<?php echo number_format($certificat->getMontantretenue(), 3, '.', ' '); ?>"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <a class="btn btn-default" href="<?php echo url_for('certificatretenue') ?>" type="button" style="float: left; margin-top: 20px; margin-left: 1%;">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Retour à la Liste
            </a>
            <a class="btn btn-primary" target="__blanc" href="<?php echo url_for('certificatretenue/ImprimerCertificat?id=' . $certificat->getId()) ?>" type="button" style="float: right; margin-top: 20px; margin-right: 1%;">
                <i class="ace-icon fa fa-print bigger-110"></i>
                Imprimer Certificat
            </a>
            <a class="btn btn-primary" target="__blanc" href="<?php echo url_for('certificatretenue/ImprimerRecap?id=' . $certificat->getId()) ?>" type="button" style="float: right; margin-top: 20px; margin-right: 1%;">
                <i class="ace-icon fa fa-print bigger-110"></i>
                Recap. de Règlement
            </a>
        </div>
    </div>
</div>

<style>

    .align_right{text-align: right !important;}
    .align_center{text-align: center !important;}

</style>