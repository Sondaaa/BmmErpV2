<div class="row" ng-controller="myCtrlPaysVille">
    <div id="sf_admin_container">
        <h1 id="replacediv"> Traitement 
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Liste des pièces comptables
            </small>
        </h1>
    </div>

    <div id="form_show_piece" style="display: none;"  ng-controller="myCtrlCompteComptable">

    </div>

    <div id="form_show_edit_piece" style="display: none;"  ng-controller="myCtrlCompteComptable" >

    </div>



    <div class="mws-panel grid_8" id="form_liste_piece">
        <div id="form_show_propriete_piece" style="display: none;">
            <?php
            $pieces_comptable = PiececomptableTable::getInstance()->findByIdExercice($_SESSION['exercice_id']);
            $journals = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($_SESSION['dossier_id'], $_SESSION['exercice_id']);
            ?>
        </div>
        <div ><!--id="suppression_piese" -->
            <table>
                <tr>
                    <td style="width: 15%">
                        <div class="mws-form-inline">
                            <div class="mws-form-row">
                                <label class="mws-form-label" style="width: 100%;font-size: 14px">Journal Comptable  :</label>
                            </div>
                        </div>
                    </td>
                    <td colspan="2">
                        <select id="journal_comptable" style="width: 66%;margin-left: 29px"  >
                            <option value="-1"></option>
                            <?php foreach ($journals as $j): ?>
                                <option  id="journal_option_<?php echo $j->getId(); ?>" value="<?php echo $j->getId(); ?>">
                                    <?php echo $j->getCode() . '   ' . $j->getLibelle(); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr></table>
            <table>        <tr>
                    <td colspan="2" >
                        <b>Du</b><br>
                        <select id="numero_min">
                            <option value=""></option>
                            <?php // foreach ($pieces_comptable as $piece): ?>
                                <!--<option id="piece_<?php // echo $piece->getId()  ?>" value="<?php // echo $piece->getId()  ?>">-->
                            <?php // echo $piece->getNumero(); ?>
                            <!--</option>-->
                            <?php // endforeach; ?>
                        </select>
                        </br>
                        <b>Au</b>
                        <select id="numero_max">
                            <option value=""></option>
                            <?php // foreach ($pieces_comptable as $piece): ?>
                                <!--<option id="piece_<?php // echo $piece->getId()  ?>" value="<?php // echo $piece->getId()  ?>">-->
                            <?php // echo $piece->getNumero(); ?>
                            <!--</option>-->
                            <?php // endforeach; ?>
                        </select>
                    </td>
                    <td style="text-align: center;">
                        <button style="cursor:pointer;margin-top: 2px;min-width: 118px " onclick="supprimer(1)" class="btn btn-sm btn-danger">
                            <i class="ace-icon fa fa-remove icon-on-right bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Supprimer</span>
                        </button>
                        </br>
                        <button style="cursor:pointer;margin-top: 2px;min-width: 118px " onclick="afficher(1)" class="btn btn-sm btn-primary"> 
                            <i class="ace-icon fa fa-eye bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Afficher</span>
                        </button>
                    </td>
                </tr>
            </table>
        </div>
        <table style="width: 100%;">
            <tr>
                <td style="vertical-align: middle; font-weight: bold;">Numéro du :
                    <input type="text" id="num_deb" onkeyup="goPage(1);"/>
                </td>
                <td style="vertical-align: middle; font-weight: bold;">Au :
                    <input type="text" id="num_fin" onkeyup="goPage(1);"/>
                </td>
                <td style="vertical-align: middle; font-weight: bold;">Date du :<br>
                    <input type="date" id="date_deb" name="date_deb" onchange="goPage(1);"/>
                </td>
                <td style="vertical-align: middle; font-weight: bold;">Au :<br>
                    <input type="date" id="date_fin" name="date_fin" onchange="goPage(1);"/>
                </td>
                <td id="zone_pdf" style="vertical-align: middle; text-align: center;">
                    <a style="cursor:pointer;" target="_blank" href="<?php echo url_for("saisie_pieces/ImprimeListe"); ?>" class="btn btn-sm btn-primary">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a>
                </td>
            </tr> 
        </table>
        <div class="mws-panel-body"  ng-controller="myCtrlCompteComptable">
            <div>
                <input type="hidden" id="type_tri" value="">
                <input type="hidden" id="tri" value="">
                <table id="listPiece">
                    <thead>
                        <tr id="list_tri" style="border-bottom: 1px solid #000000" role="row">
                            <th style="width: 5%;">Détails</th>
                            <th class="sorting" id="tri_journal" name="tri"  onclick="tri('journal')" style="width: 20%;">Journal </th>
                            <th class="sorting" id="tri_date" name="tri" onclick="tri('date')" style="width: 8%;">Date </th>  
                            <th class="sorting" id="tri_numero" name="tri" onclick="tri('numero')" style="width: 9%;">Numéro </th>

                            <th class="sorting" id="tri_serie" name="tri" onclick="tri('serie')" style="width: 5%;">Série </th> 
                            <th class="sorting" id="tri_numero" name="tri" onclick="tri('numero')" style="width: 9%;">Numéro Externe </th>
                            <th style="width: 10%;">Total débit</th>
                            <th style="width: 10%;">Total cédit</th>
                            <th  id="tri_user" name="tri" onclick="tri('user')" style="width: 10%;">Libellé </th>
                            <th style="width: 14%;">Opérations</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th><input type="text" id="journal" onkeyup="goPage(1);" /></th>
                            <th></th>
                            <th><input type="text" class="align_center" id="num" onkeyup="goPage(1);" /></th>
                            <th></th>
                            <th><input type="text" class="align_center" id="num_externe" onkeyup="goPage(1);" /></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot id="listPiece_footer">

                    </tfoot>
                    <tbody>
                        <?php include_partial("saisie_pieces/liste", array("pager" => $pager, "page" => $page, "journal" => $journal, "num" => $num, "statut" => $statut, "date_debut" => $date_debut, "date_fin" => $date_fin, "num_debut" => $num_debut, "num_fin" => $num_fin, "type_tri" => $type_tri, "tri" => $tri)) ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">

    function tri(type) {
        $('#list_tri th[name=tri]').each(function () {

            if ($(this).attr('id') != 'tri_' + type) {
                $(this).attr('class', 'sorting');
            }
        });
        $('#type_tri').val(type);
        var tri = $('#tri_' + type).attr('class');
        if (tri == 'sorting') {
            $('#tri_' + type).attr('class', 'sorting_asc');
            $('#tri').val('asc');
        } else if (tri == 'sorting_asc') {
            $('#tri_' + type).attr('class', 'sorting_desc');
            $('#tri').val('desc');
        } else {
            $('#tri_' + type).attr('class', 'sorting_asc');
            $('#tri').val('asc');
        }
        goPage(1);
    }

    function goPage(page) {
        $('[class="detail-row open"]').each(function () {
            $(this).remove();
        });
        var type = $('#type_tri').val();
        type = 'ligne_' + type;
        $.ajax({
            url: '<?php echo url_for('@goPagePiece'); ?>',
            data: 'page=' + page + '&journal=' + $('#journal').val() + '&num=' + $('#num').val() +
                    '&num_externe=' + $('#num_externe').val() +
                    '&date_debut=' + $('#date_deb').val() + '&date_fin=' + $('#date_fin').val() +
                    '&num_debut=' + $('#num_deb').val() + '&num_fin=' + $('#num_fin').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val() +
                    '&numero_min=' + $('#numero_min').val() + '&numero_max=' + $('#numero_max').val()
                    + '&journal_comptable=' + $('#journal_comptable').val(),
            success: function (data) {
                $('#listPiece tbody').html(data);
            }
        });
    }

    function showPiece(id) {
        $.ajax({
            url: '<?php echo url_for('@showPiece') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#form_show_piece').html(data);
                $('#form_show_edit_piece').fadeOut();
                $('#form_liste_piece').fadeOut();
                $('#suppression_piese').fadeOut();
                $('#form_show_propriete_piece').fadeOut();
                $('#form_show_piece').delay(500).fadeIn();
            }
        });
    }

    function showProprietePiece(id) {
        $.ajax({
            url: '<?php //echo url_for('@showProprietePiece')                                   ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#form_show_propriete_piece').html(data);
                $('#form_show_edit_piece').fadeOut();
                $('#form_liste_piece').fadeOut();
                $('#suppression_piese').fadeOut();
                $('#form_show_piece').fadeOut();
                $('#form_show_propriete_piece').delay(500).fadeIn();
            }
        });
    }

    function showEditPiece(id) {
        $.ajax({
            url: '<?php echo url_for('@showEditPiece') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#form_show_edit_piece').html(data);
                $('#form_show_piece').fadeOut();
                $('#form_liste_piece').fadeOut();
                $('#suppression_piese').fadeOut();
                $('#form_show_propriete_piece').fadeOut();
                $('#form_show_edit_piece').delay(500).fadeIn();
            }
        });
    }

    var piece_id_delete = '';
    function deletePiece(id) {
        $.ajax({
            url: '<?php echo url_for('@deletePiece') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#listPiece tbody').html(data);
            }
        });
    }

    function openPopupSupprimer(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer cette pièce comptable ?",
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {
                if (result) {
                    deletePiece(id);
                }
            }
        });
    }

    function formatLigne(index) {
        $('#listPiece tbody tr').each(function () {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });

        $('#ligne_' + index).css('background', 'repeat-x scroll left bottom #d8d6d6');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
    }

    function imprimeListe() {
        $.ajax({
            url: '<?php //echo url_for('@imprimeListePiece');                                   ?>',
            data: 'journal=' + $('#journal').val() + '&num=' + $('#num').val() +
                    '&date_debut=' + $('#date_deb').val() + '&date_fin=' + $('#date_fin').val() +
                    '&num_debut=' + $('#num_deb').val() + '&num_fin=' + $('#num_fin').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val(),
            success: function (data) {
                $('#zone_pdf').html(data);
            }
        });
    }
    function afficher(page) {
        $.ajax({
            url: '<?php echo url_for('saisie_pieces/afficherListPiece') ?>',
            data: 'numero_min=' + $('#numero_min').val() + '&numero_max=' + $('#numero_max').val() +
                    '&page=' + page + '&journal=' + $('#journal').val() + '&num=' + $('#num').val() +
                    '&date_debut=' + $('#date_deb').val() + '&date_fin=' + $('#date_fin').val() +
                    '&num_debut=' + $('#num_deb').val() + '&num_fin=' + $('#num_fin').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val(),
            success: function (data) {
                $('#listPiece tbody').html(data);
            }
        });
    }
    function supprimer(page) {
        var message_text = "Voulez-vous supprimer ces Pieces Comptables ? ";
        bootbox.confirm({
            message: message_text,
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {
                if (result) {
                    validerAllSuppression(page);
                }
            }
        });
    }

    function validerAllSuppression(page) {

        $.ajax({
            url: '<?php echo url_for('saisie_pieces/supprimerPiececomptable') ?>',
            data: 'numero_min=' + $('#numero_min').val() + '&numero_max=' + $('#numero_max').val()
                    + '&journal=' + $('#journal').val() + '&num=' + $('#num').val() +
                    '&date_debut=' + $('#date_deb').val() + '&date_fin=' + $('#date_fin').val() +
                    '&num_debut=' + $('#num_deb').val() + '&num_fin=' + $('#num_fin').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val(),
            success: function (data) {
                if (data != null) {
                    $('#listPiece tbody').html(data);
//                    $('#numero_min').val('');
//                    $('#numero_max').val('');
//                    $('#numero_min').trigger("chosen:updated");
//                    $('.chosen-container').trigger("chosen:updated");
//                    $('#numero_max').trigger("chosen:updated");
//                    $('.chosen-container').trigger("chosen:updated");
                }
//              document.location.reload();
            }
        });
    }

</script>

<script  type="text/javascript">

    function setAffichageDetail(index, id) {
        if (!$('#ligne_' + index).closest('tr').next().attr('class')) {
            var count_ligne = 0;
            $('#listPiece tbody tr').each(function () {
                count_ligne++;
            });
            $.ajax({
                url: '<?php echo url_for('saisie_pieces/detailRow') ?>',
                data: 'id=' + id,
                success: function (data) {
                    $('#ligne_' + index).after(data);

                    $('#ligne_' + index).closest('tr').next().toggleClass('open');
                    $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
                }
            });
        } else {
            $('#ligne_' + index).closest('tr').next().toggleClass('open');
            $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
        }
    }

    $("table").addClass("table table-bordered table-hover");

</script>

<script  type="text/javascript">
    document.title = ('BMM - G. Compta. : Liste des pièces');
</script>

<style>

    .sorting{
        color: #307ECC;
        cursor: pointer;
    }

</style>