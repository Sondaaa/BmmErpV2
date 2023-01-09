<?php
$url = '';
$resultat_debit = '';
$resultat_credit = '';
$url.= 'id=';
//        . $journal->getId();
if ($date_debut != '')
    $url.= '&date_debut=' . $date_debut;
if ($date_fin != '')
    $url.= '&date_fin=' . $date_fin;
?>
<div class="row">
    <div class="col-md-8">
        <fieldset style="border:solid 1px #003300;padding: 1%" >
            <legend>Réimpiter le compte comptable !!!</legend>
            <table  id="table_comptes">
                <?php $compte = PlandossiercomptableTable::getInstance()->getByDossierAndExercice($_SESSION['exercice_id'], $_SESSION['dossier_id']); ?>
                <tr>
                    <td style="text-align: left;">
                        <!--<label>Compte comptable :</label>-->
                        <select id="id_compte_select" class="chosen-select form-control">
                            <option value=""></option>
                            <?php foreach ($compte as $cc): ?>
                                <option value="<?php echo $cc->getId(); ?>"><?php echo $cc->getNumerocompte() . ' - ' . $cc->getLibelle(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td > <label></label>
                        <button id="btn_lettrer" style="cursor:pointer;" onclick="reimputer()" class="btn btn-sm btn-primary">
                            <span class="bigger-110 no-text-shadow"><label style="font-size: 12px;">Affecter</label></span>
                        </button>

                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>

        <!--        <div class="table-header">
                    Journal Comptable : <?php // echo $journal->getCode() . ' - ' . $journal->getLibelle()   ?>
                    <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;margin-left: 5px" href="<?php echo url_for("etat/imprimeJournalSeul?" . $url); ?>">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a>
                    <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px; margin-left: 3px" href="<?php echo url_for("etat/exporterJournalSeulExcel?" . $url); ?>">
                        <i class="ace-icon fa fa-file-excel-o"></i>
                        <span class="bigger-110 no-text-shadow">Exporter</span>
                    </a>
                </div>-->

        <div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>  <th></th>
                        <th style="width: 2%;">LE<br><input type="checkbox" id="selecte_all_compte"></th>
                        <th style="width: 10%;">Date</th>
                        <th style="width: 10%;">Pièce Comptable</th>
                        <th style="width: 8%;">Numèro de Compte</th>
                        <th style="width: 7%;">Référence</th>
                        <th style="width: 7%;">Nature Pièce</th>
                        <th style="width: 7%;">N° Externe</th>
                        <th style="width: 25%;">Libellé</th>
                        <th style="width: 12%;">Débit</th>
                        <th style="width: 12%;">Crédit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $color1 = "#e6ecff";
                    $color2 = "#b3c6ff;";
                    $numero_piece = '';
                    $Str_Row_Color = '';
                    ?>
                    <?php if ($etatJournal->count() != 0): ?>
                        <?php foreach ($etatJournal as $key => $fiche): ?>
                            <?php
                            if ($numero_piece != $fiche->getPiececomptable()->getNumero() && $numero_piece != ''):
                                $numero_piece = $fiche->getPiececomptable()->getNumero();
                                if ($Str_Row_Color == $color1)
                                    $Str_Row_Color = $color2;
                                else
                                    $Str_Row_Color = $color1;
                                $border = 'border:solid 1px #000000';
                            else:
                                $numero_piece = $fiche->getPiececomptable()->getNumero();
                                $border = '';
                            endif;
                            ?>
                            <tr style="background: <?php echo $Str_Row_Color ?>" onclick="AddIDPiece(<?php echo $fiche->getId() ?>)" class="row_facture">
                                <td><?php echo $key + 1; ?></td>
                                <td><input  type="checkbox" onclick="AddIDPiece(<?php echo $fiche->getId() ?> ? > )" id="check_<?php echo $fiche->getId() ?>" idientifiant="<?php echo $fiche->getId() ?>" class="list_checbox_facture"></td>
                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($fiche->getPiececomptable()->getDate())) ?></td>
                                <td style="text-align: center;">
                                    <a style="cursor: pointer;" target="_blank" title="Modifier Pièce" href="<?php echo url_for('saisie_pieces/showEdit?id=' . $fiche->getPiececomptable()->getId()) ?>">
                                        <?php echo $fiche->getPiececomptable()->getNumero() ?>
                                    </a>
                                </td>
                                <td style="text-align: center;"> <?php echo $fiche->getPlandossiercomptable()->getNumerocompte() ?></td>
                                <td style="text-align: center;"><?php echo $fiche->getReference() ?></td>
                                <td style="text-align: center;"><?php echo $fiche->getNaturepiece()->getLibelle() ?></td>
                                <td style="text-align: center;"><?php echo $fiche->getNumeroexterne() ?></td>
                                <td style="text-align: left;">
                                    <?php if ($fiche->getLibelle()): ?>
                                        <?php echo $fiche->getLibelle(); ?>
                                    <?php else: ?>
                                        <?php echo $fiche->getPiececomptable()->getLibelle(); ?>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php
                                    if ($fiche->getMontantdebit() == 0):
                                        echo '';
                                    else:
                                        echo number_format($fiche->getMontantdebit(), 3, '.', ' ');
                                        $resultat_debit = $resultat_debit + $fiche->getMontantdebit();
                                    endif;
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php
                                    if ($fiche->getMontantcredit() == 0):
                                        echo '';
                                    else:
                                        echo number_format($fiche->getMontantcredit(), 3, '.', ' ');
                                        $resultat_credit = $resultat_credit + $fiche->getMontantcredit();

                                    endif;
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td style="text-align:center; font-weight: bold; font-size: 16px !important; height: 100px; vertical-align: middle;" colspan="11">Pas de Pièces Comptables dans ce Journal Comptable</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <?php if ($etatJournal->count() != 0): ?>
                    <tfoot>
                        <tr style="background: repeat-x #F2F2F2;">
                            <td style="text-align: center; font-weight: bold; font-size: 18px" colspan="3" class="fixed-side" scope="col">Total</td>
                            <td colspan="6"></td>
                            <td style="text-align: right; font-weight: bold;font-size: 16px">
                                <?php
                                echo number_format($resultat_debit, 3, '.', ' ');
                                ?>
                            </td>
                            <td style="text-align: right; font-weight: bold;font-size: 16px">
                                <?php
                                echo number_format($resultat_credit, 3, '.', ' ');
                                ?>
                            </td>
                        </tr>

                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>

        </div>
    </div>
</div>
<div class="clearfix" style="font-size: 16px; margin-top: 20px;">
    <span id="nombre_facture" style="margin-left: 20px;">0 </span> Ligne(s) sélectionné(s)
</div>
<script type="text/javascript">
    $('#selecte_all_compte').change(function () {
        var id = '';
        $('#loading_select_icon').fadeIn();
        if ($('#selecte_all_compte').is(':checked')) {

            $('.list_checbox_facture[type=checkbox]').prop('checked', true);
            $('.list_checbox_facture[type=checkbox]:checked').each(function () {
                id = $(this).attr('idientifiant');
                $('#ligne_' + id).removeAttr('style');
                $('#check_' + id).prop("checked", true);
                $('#check_' + id).removeClass("disabledbutton");
                $('.row_facture').css('background', '#E7E7E7');
                $('.row_facture').css('border-bottom', '1px solid #000000');
                $('.row_facture').css('border-top', '1px solid #000000');
                AddIDPiece(id);
            });
            $('#loading_select_icon').fadeOut();
        }
        else {
            $('.list_checbox_facture[type=checkbox]').prop('checked', false);
            id = $(this).val();
            $('.row_facture').css('background', '');
            $('.row_facture').css('border-bottom', '');
            $('.row_facture').css('border-top', '');
            AddIDPiece(id);
        }
        $('#nombre_facture').html($('.list_checbox_facture[type=checkbox]:checked').length);
    });
</script>
<script  type="text/javascript">
    $('#id_compte_select').attr('class', "chosen-select form-control");
    $('#id_compte_select').attr('style', 'width: 100%;');
   



    if (!ace.vars['touch']) {
        $('.chosen-select').chosen({allow_single_deselect: true});
        //resize the chosen on window resize

        $(window)
                .off('resize.chosen')
                .on('resize.chosen', function () {
                    $('.chosen-select').each(function () {
                        var $this = $(this);
                        $this.next().css({'width': $this.parent().width()});
                    })
                }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
            if (event_name != 'sidebar_collapsed')
                return;
            $('.chosen-select').each(function () {
                var $this = $(this);
                $this.next().css({'width': $this.parent().width()});
            })
        });


        $('#chosen-multiple-style .btn').on('click', function (e) {
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if (which == 2)
                $('#form-field-select-4').addClass('tag-input-style');
            else
                $('#form-field-select-4').removeClass('tag-input-style');
        });
    }

    $('.chosen-container').attr("style", "width: 100%;");
    $('.chosen-container').trigger("chosen:updated");

</script>
<style>

     td > label{font-size: 18px;}
    #table_comptes{width: 100%; margin: 0% 0% 0% 0%;}
    #table_comptes tbody tr td{padding: 0px;}

</style>