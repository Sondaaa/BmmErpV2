<?php $mvt = $bordereau->getMouvementbanciare()->getFirst(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Bordereau - <?php  if($mvt->getCaissesbanques())echo $mvt->getCaissesbanques()->getLibelle(); ?>
            <a id="button_print" target="_blanc" href="<?php echo url_for('mouvementbanciare/ImprimerBordereau?ids=' . $ids) ?>" class="btn btn-sm btn-success" style="float: right; padding: 5px 9px; display: none;">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
        </div>
        <div>
            <form>
                <div class="sf_admin_list">
                    <?php if ($mvt->getCaissesbanques()->getIdNature() == 1): ?>
                        <table id="list_mouvements" class="table table-bordered table-hover" cellspacing="0">
                            <thead>
                                <tr style="font-size: 16px;">
                                    <th style="width: 10%; text-align: center;">سبب التحويل<br>Motif du Virement</th>
                                    <th style="width: 10%; text-align: center;">مبلغ التحويل<br>Montant du Virement</th>
                                    <th style="width: 20%; text-align: center;">إسم المستفيد<br>Nom du Bénéficiaire</th>
                                    <th style="width: 20%; text-align: center;">رقم معرف الهوية البريدية أو البنكية للمستفيد<br>N° RIP/RIB du Bénéficiaire</th>
                                    <th style="width: 5%; text-align: center;">الرقم<br>Numéro</th>
                                </tr>
                            </thead>
                            <tfoot>
                            </tfoot>
                            <tbody>
                                <?php $total = 0; ?>
                                <?php $i = 1; ?>
                                <?php foreach ($bordereau->getMouvementbanciare() as $mvt): ?>
                                    <tr>
                                        <td></td>
                                        <td style="text-align: right;">
                                            <?php echo number_format($mvt->getDebit(), 3, '.', ' '); ?>
                                        </td>
                                        <td><?php echo $mvt->getRefbenifi(); ?></td>
                                        <td style="text-align: center;">
                                            <table style="width: 100%;">
                                                <tr><td style="border-left: 1px solid #000; border-right: 1px solid #000; height: 5px;" colspan="<?php echo strlen(trim($mvt->getRibbeni())); ?>"></td></tr>
                                                <tr>
                                                    <?php for ($j = 0; $j < strlen(trim($mvt->getRibbeni())); $j++): ?>
                                                        <td class="td_rib"><?php echo $mvt->getRibbeni()[$j]; ?></td>
                                                    <?php endfor; ?>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="text-align: center;"><?php echo $i ?></td>
                                    </tr>
                                    <?php $total = $total + $mvt->getDebit(); ?>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                                <tr style="font-size: 16px; background-color: #ECECED;">
                                    <td style="text-align: center;">Total</td>
                                    <td style="text-align: right;"><?php echo number_format($total, 3, '.', ' '); ?></td>
                                    <td style="text-align: center;">المجموع</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                        </table>
                    <?php else: ?>
                        <table id="list_mouvements" class="table table-bordered table-hover" cellspacing="0" style="margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">N°</th>
                                    <th style="width: 20%"><span style="float: left;">Bénéficiaire</span> <span style="float: right;">المستفيد</span></th>
                                    <th style="width: 20%"><span style="float: left;">RIB</span> <span style="float: right;">البنكي المعرف</span></th>
                                    <th style="width: 10%"><span style="float: left;">Montant</span> <span style="float: right;">المبلغ</span></th>
                                </tr>
                            </thead>
                            <tfoot>
                            </tfoot>
                            <tbody>
                                <?php $total = 0; ?>
                                <?php $i = 1; ?>
                                <?php foreach ($bordereau->getMouvementbanciare() as $mvt): ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $mvt->getRefbenifi(); ?></td>
                                        <td style="text-align: center;">
                                            <?php echo FormatRib::Show($mvt->getRibbeni()); ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php echo number_format($mvt->getDebit(), 3, '.', ' '); ?>
                                        </td>
                                    </tr>
                                    <?php $total = $total + $mvt->getDebit(); ?>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                                <tr style="font-size: 16px;">
                                    <td colspan="3" style="text-align: right;">Total <span style="margin-left: 30px;">الجملة</span></td>
                                    <td style="text-align: right;"><?php echo number_format($total, 3, '.', ' '); ?></td>
                                </tr>
                        </table>
                        <table class="table table-bordered table-hover" cellspacing="0">
                            <tr style="font-size: 14px; background-color: #ECECED;">
                                <td style="width: 25%;">Montant total en lettres</td>
                                <td style="width: 50%; text-align: center;" colspan="2">
                                    <?php echo chiffreToLettre::cvnbst($total); ?></td>
                                <td style="width: 25%; text-align: right;">المبلغ الجملي بالأحرف</td>
                            </tr>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <button class="btn btn-default" type="button" style="float: right;" onclick="fermerBordereau()">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Retour à liste
            </button>

            <?php if ($bordereau->getValide() == false): ?>
                <button class="btn btn-primary" type="button" style="float: right; margin-right: 1%;" onclick="validerBordereau('<?php echo $bordereau->getId() ?>', '<?php echo $bordereau->getIdCompte() ?>', '<?php echo $bordereau->getCaissesbanques()->getIdNature() ?>')">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Valider
                </button>

                <button class="btn btn-danger" type="button" style="float: right; margin-right: 1%;" onclick="supprimerBordereau(<?php echo $bordereau->getId(); ?>)">
                    <i class="ace-icon fa fa-trash bigger-110"></i>
                    Supprimer
                </button>
            <?php endif; ?>

            <a target="_blanc" href="<?php echo url_for('bordereauvirement/ImprimerBordereau?id=' . $bordereau->getId()) ?>" class="btn btn-sm btn-default">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
        </div>
    </div>
</div>

<?php if ($bordereau->getValide() == true): ?>
    <?php $ordre = $bordereau->getPapierordrepostal(); ?>

    <div id="zone_ordre" class="well" style="margin-top: 20px; margin-bottom: 0px;">                
        <h4 class="green smaller lighter">
            <a onclick="showOrdre('<?php echo $ordre->getId(); ?>')" style="cursor: pointer;">
                <i class="ace-icon fa fa-hand-o-right"></i> Ordre de retrait ou de virement N° : <?php echo $ordre->getRepapier() ?>
            </a>
        </h4>
        <table id="table_detail_ordre" style="width: 100%; margin-top: 20px; margin-bottom: 20px; display: none;">
            <tr>
                <td style="width: 43%; padding: 5px;">
                    <table id="table_side" style="width: 100%; margin-bottom: 0px;">
                        <tr>
                            <td style="height: 31px;">Ordre N°</td>
                            <td style="text-align: center;"><?php echo $ordre->getRepapier() ?></td>
                            <td style="text-align: right;">إذن رقم</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left; padding-left: 10px;">
                                <?php echo $societe->getRs(); ?>
                                <br>
                                <?php echo $societe->getAdresse(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: center;">
                                <?php echo FormatRib::ShowZone($ordre->getCarnetordrepostal()->getCaissesbanques()->getRib()); ?>
                                <span style="float: left;">RIP</span><span style="float: right;">معرف الهوية البريدية لصاحب الحساب</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left">Montant en chiffres</td>
                            <td style="text-align: center;"><?php echo number_format($ordre->getMnt(), 3, '.', ' ') ?></td>
                            <td style="text-align: right;">المبلغ بالأرقام</td>
                        </tr>
                        <tr>
                            <td style="text-align: left">Objet du virement</td>
                            <td></td>
                            <td style="text-align: right;">موضوع التحويل</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: center;"><?php echo $ordre->getObjet() ?></td>
                        </tr>
                        <tr>
                            <td style="height: 31px;">Au profit de</td>
                            <td style="text-align: center;">
                                <?php echo $mvt->getRefbenifi() . '  ' . FormatRib::Show($mvt->getRibbeni()); ?>
                            </td>
                            <td style="text-align: right;">لفائدة</td>
                        </tr>
                        <tr>
                            <td colspan="5" style="height: 90px;"></td>
                        </tr>
                    </table>
                </td>
                <td style="width: 57%; padding: 5px; vertical-align: top;">
                    <table id="table_ordre" style="width: 100%; margin-bottom: 0px;">
                        <tr>
                            <td style="height: 31px; width: 19%;">CCP N°</td>
                            <td style="text-align: center; width: 24%;"><?php echo $ordre->getCarnetordrepostal()->getCaissesbanques()->getCodecb(); ?></td>
                            <td style="width: 21%;">Ordre N°</td>
                            <td style="text-align: center; width: 22%;"><?php echo $ordre->getRepapier(); ?></td>
                            <td style="text-align: right; width: 14%;">إذن رقم</td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: left; padding-left: 10px;">
                                <?php echo $societe->getRs(); ?>
                                <br>
                                <?php echo $societe->getAdresse(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center;">
                                <?php echo FormatRib::ShowZone($ordre->getCarnetordrepostal()->getCaissesbanques()->getRib()); ?>
                                <span style="float: left;">RIP</span><span style="float: right;">معرف الهوية البريدية لصاحب الحساب</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">A payer / virer <span style="font-size: 9px;">(Montant en chiffres)</span></td>
                            <td style="text-align: center;"><?php echo number_format($ordre->getMnt(), 3, '.', ' ') ?></td>
                            <td colspan="2" style="text-align: right;"><span style="font-size: 9px;">(المبلغ بالأرقام) </span>يدفع / يحول</td>
                        </tr>
                        <tr>
                            <td colspan="2">Montant en toutes lettres</td>
                            <td></td>
                            <td colspan="2" style="text-align: right;">المبلغ بالأحرف</td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center;"><?php echo chiffreToLettre::cvnbst($ordre->getMnt()) ?></td>
                        </tr>
                        <tr>
                            <td style="height: 31px;">Au profit de</td>
                            <td colspan="3" style="text-align: center;">
                                <?php echo $mvt->getRefbenifi() . '  ' . FormatRib::Show($mvt->getRibbeni()); ?></td>
                            <td style="text-align: right;">لفائدة</td>
                        </tr>
                        <tr>

                            <td colspan="5" style="height: 90px; font-size: 12px; text-align: center; letter-spacing: .2rem;">
                                <?php echo $societe->getGouvernera()->getGouvernera(); ?> Le <b><?php echo date('d-m-Y'); ?></b> في  <?php echo $societe->getGouvernera()->getGouvernera(); ?>
                                <br>
                                <i>SIGNATURE</i> <span style="margin-left: 15px;">الإمضاء</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="row" id="action_ordre" style="display: none;">
            <a target="_blanc" href="<?php echo url_for('papierordrepostal/Imprimer?id=' . $ordre->getId()) ?>" class="btn btn-sm btn-danger" style="float: left; margin-left: 20px;">
                <i class="ace-icon fa fa-fire bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Annuler Ordre</span>
            </a>
             <a target="_blanc" href="<?php echo url_for('papierordrepostal/Imprimerretrait?id=' . $ordre->getId().'&id_mvt='.$mvt->getId()) ?>" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px;">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer Ordre (Vide)</span>
            </a>
            <a target="_blanc" href="<?php echo url_for('papierordrepostal/Imprimer?id=' . $ordre->getId()) ?>" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px;">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer Ordre</span>
            </a>
        </div>

        <script>

            $("#table_detail_ordre").addClass("table table-bordered table-hover");
            $("#table_side").addClass("table table-bordered table-hover");
            $("#table_ordre").addClass("table table-bordered table-hover");

            function showOrdre(id) {
                $('#table_detail_ordre').fadeIn();
                $('#action_ordre').fadeIn();
                window.scrollTo(0, document.body.scrollHeight || document.documentElement.scrollHeight);
            }

        </script>

        <style>

            #table_ordre td{vertical-align: top;}
            #table_side td{vertical-align: top;}

        </style>
    </div>
<?php endif; ?>

<script>

    function fermerBordereau() {
        $('#show_bordereau').html('');
        $('#show_bordereau').fadeOut();
        $('#sf_admin_container').fadeIn();

        $('.chosen-container').attr("style", "width: 100%;");
        $('.chosen-container').trigger("chosen:updated");
    }

</script>