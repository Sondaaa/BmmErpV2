<?php if ($cheque->getCarnetcheque()->getCaissesbanques()->getIdNature() == 1): ?>
    <span class="titre_chèque_modal">Chèque N°</span><span><input style="float: right; text-align: right;" disabled="true" value="<?php echo $cheque->getMntcheque(); ?>" type="text"/></span> <span class="titre_chèque_modal" style="margin-left: 260px;"><?php echo $cheque->getRefpapier() ?></span><span class="titre_chèque_modal" style="float: right; margin-right: 50px;"> رقم الشيك</span>

    <table style="width: 100%; margin-top: 20px; margin-bottom: 20px;">
        <tr>
            <td style="width: 25%; padding: 5px;">
                <table id="table_side" style="width: 100%; margin-bottom: 0px;">
                    <tr>
                        <td style="height: 31px;">Chèque N°</td>
                        <td style="text-align: center;"><?php echo $cheque->getRefpapier() ?></td>
                        <td style="float: right;"> رقم الشيك</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; height: 50px;">...... <?php echo $cheque->getDatesignature(); ?> ...... التاريخ<br>Date</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; height: 50px;"><?php echo $cheque->getCible(); ?> المستفيد<br>Bénéficiaire</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; height: 50px;">.......................... الرصيد السابق<br>Solde antérieur</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; height: 50px;">... <?php echo $cheque->getMntcheque(); ?> ... مبلغ الشيك<br>Montant du chèque</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; height: 50px;">......................... الرصيد الجديد<br>Nouveau solde</td>
                    </tr>
                </table>
            </td>
            <td style="width: 75%; border-left: 2px solid #000000; padding: 5px; vertical-align: top;">
                <table id="table_cheque" style="width: 100%; margin-bottom: 0px;">
                    <tr>
                        <td style="height: 31px;">Chèque N°</td>
                        <td style="text-align: center;"><?php echo $cheque->getRefpapier(); ?></td>
                        <td style="float: right;"> رقم الشيك</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-size: 15px; height: 25px;"><span>Payez contre ce chèque non endossable</span><span style="float: right;">ادفعوا مقابل هذا الشيك الغير قابل للتضهير</span></td>
                    </tr>
                    <tr>
                        <td style="width: 30%; height: 65px;">Somme<br>(en toutes lettres)</td>
                        <td style="width: 40%; text-align: center;"><?php echo chiffreToLettre::cvnbst($cheque->getMntcheque()) ?></td>
                        <td style="width: 30%; text-align: right;">المبلغ بلسان القلم</td>
                    </tr>
                    <tr>
                        <td style="width: 30%; height: 31px;">Au Bénéfice de</td>
                        <td style="width: 40%; text-align: center;"><?php echo $cheque->getCible(); ?>
                        </td>
                        <td style="width: 30%; text-align: right;">لفائدة</td>
                    </tr>
                    <tr>
                        <td style="height: 131px; font-size: 12px; text-align: center;">
                            <i>Payable à</i> <span style="margin-left: 15px;"> يدفع ب</span>
                        </td>
                        <td style="height: 131px; font-size: 12px; text-align: center;">
                            Titulaire du compte <span style="margin-left: 15px;"> صاحب الحساب</span>
                            <br>
                            <?php echo $cheque->getCarnetcheque()->getCaissesbanques()->getRib(); ?>
                            <br><br>
                            <?php echo $societe->getRs(); ?>
                            <br>
                            <?php echo $societe->getAdresse(); ?>
                        </td>
                        <td style="height: 131px; font-size: 12px; text-align: center;">
                            <?php echo $societe->getGouvernera()->getGouvernera(); ?> Le <b><?php echo date('d-m-Y'); ?></b> في  <?php echo $societe->getGouvernera()->getGouvernera(); ?>
                            <br>
                            <i>SIGNATURE</i> <span style="margin-left: 15px;">إمضاء</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
<?php else: ?>

    <span class="titre_chèque_modal">Chèque N°</span><span><input style="float: right; text-align: right;" disabled="true" value="<?php echo $cheque->getMntcheque(); ?>" type="text"/></span> <span class="titre_chèque_modal" style="margin-left: 260px;"><?php echo $cheque->getRefpapier() ?></span><span class="titre_chèque_modal" style="float: right; margin-right: 50px;"> رقم الشيك</span>

    <table style="width: 100%; margin-top: 20px; margin-bottom: 20px;">
        <tr>
            <td style="width: 25%; padding: 5px;">
                <table id="table_side" style="width: 100%; margin-bottom: 0px;">
                    <tr>
                        <td style="height: 31px;">Chèque N°</td>
                        <td style="text-align: center;" colspan="2"><?php echo $cheque->getRefpapier() ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; height: 50px;">.........................................  المحول<br>Report</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; height: 50px;">...... <?php echo $cheque->getMntcheque(); ?> ......  المبلغ<br>Montant</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; height: 50px;">...........<?php echo $cheque->getCible(); ?> لأمر<br>A l'ordre</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; height: 50px;">.......... <?php echo $cheque->getDatesignature(); ?> .......... التاريخ<br>Date</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; height: 50px;">........................................ الرصيد <br>Solde</td>
                    </tr>
                </table>
            </td>
            <td style="width: 75%; border-left: 2px solid #000000; padding: 5px; vertical-align: top;">
                <table id="table_cheque" style="width: 100%; margin-bottom: 0px;">
                    <tr>
                        <td colspan="3" style="font-size: 15px; height: 25px;"><span>Payez contre ce chèque non endossable</span><span style="float: right;">ادفعوا مقابل هذا الشيك الغير قابل للتضهير</span></td>
                    </tr>
                    <tr>
                        <td style="width: 40%; text-align: center; height: 52px;" colspan="3"><?php echo chiffreToLettre::cvnbst($cheque->getMntcheque()) ?></td>
                    </tr>
                    <tr>
                        <td style="width: 30%; height: 31px;">A l'ordre de</td>
                        <td style="width: 40%; text-align: center;"><?php echo $cheque->getCible(); ?>
                        </td>
                        <td style="width: 30%; text-align: right;">لأمر</td>
                    </tr>
                    <tr>
                        <td style="height: 131px; font-size: 12px; text-align: center;">
                            <i>Payable à</i> <span style="margin-left: 15px;"> يدفع ب</span>
                        </td>
                        <td style="height: 131px; font-size: 12px; text-align: center;">
                            Titulaire du compte <span style="margin-left: 15px;"> صاحب الحساب</span>
                            <br>
                            <?php echo $cheque->getCarnetcheque()->getCaissesbanques()->getRib(); ?>
                            <br><br>
                            <?php echo $societe->getRs(); ?>
                            <br>
                            <?php echo $societe->getAdresse(); ?>
                        </td>
                        <td style="height: 131px; font-size: 12px; text-align: center;">
                            <i>SIGNATURE</i> <span style="margin-left: 15px;">إمضاء</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: center; height: 49px;">
                            A <?php echo $societe->getGouvernera()->getGouvernera(); ?> Le <b><?php echo date('d-m-Y'); ?></b> في  <?php echo $societe->getGouvernera()->getGouvernera(); ?> ب
                        </td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

<?php endif; ?>

<?php if (!$cheque->getAnnule()): ?>
    <div class="row">
        <a target="_blanc" href="<?php echo url_for('papiercheque/ImprimerCheque?id=' . $cheque->getId()) ?>" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px;">
            <i class="ace-icon fa fa-print bigger-110"></i>
            <span class="bigger-110 no-text-shadow">Imprimer Chèque</span>
        </a>
    </div>
<?php endif; ?>

<script  type="text/javascript">

    $("table").addClass("table table-bordered table-hover");

</script>

<style>

    .titre_chèque_modal{font-size: 16px;}
    .modal-dialog {width: 920px;}
    #table_cheque td{vertical-align: top;}
    #table_side td{vertical-align: top;}

</style>