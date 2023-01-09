<span class="titre_ordre_modal">Ordre de retrait ou de virement N° : <?php echo $ordre->getRepapier() ?></span>

<table style="width: 100%; margin-top: 20px; margin-bottom: 20px;">
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
                    <td style="text-align: center;"></td>
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
                    <td colspan="3" style="text-align: center;"><?php echo $ordre->getCible(); ?></td>
                    <td style="text-align: right;">لفائدة</td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td colspan="4" style="height: 90px; font-size: 12px; text-align: center; letter-spacing: .2rem;">
                        <?php echo $societe->getGouvernera()->getGouvernera(); ?> Le <b><?php echo date('d-m-Y'); ?></b> في  <?php echo $societe->getGouvernera()->getGouvernera(); ?>
                        <br>
                        <i>SIGNATURE</i> <span style="margin-left: 15px;">الإمضاء</span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<div class="row">
    <a target="_blanc" href="<?php echo url_for('papierordrepostal/Imprimer?id=' . $ordre->getId()) ?>" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px;">
        <i class="ace-icon fa fa-print bigger-110"></i>
        <span class="bigger-110 no-text-shadow">Imprimer Ordre</span>
    </a>
</div>

<script  type="text/javascript">

    $("table").addClass("table table-bordered table-hover");

</script>

<style>

    .titre_ordre_modal{font-size: 16px;}
    .modal-dialog {width: 920px;}
    #table_ordre td{vertical-align: top;}
    #table_side td{vertical-align: top;}

</style>