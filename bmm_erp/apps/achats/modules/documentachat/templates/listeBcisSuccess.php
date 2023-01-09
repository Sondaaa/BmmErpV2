<div class="row">
    <div id="sf_admin_container">
        <h1 id="replacediv">
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Liste des Bons de Commandes Internes (D.I.)
            </small>
        </h1>
    </div>
    <form id='liste_bci' action="<?php echo url_for('documentachat/ExporterDAregroupe') ?>" method="POST">
        <input type="hidden" id="array_bci_1" name="array_bci_1" value="10">
    </form>
    <div class="mws-panel-body">
        <div>
            <input type="hidden" id="type_tri" value="">
            <input type="hidden" id="tri" value="">
            <table id="listPiece">
                <thead>
                    <tr id="list_tri" style="border-bottom: 1px solid #000000" role="row">
                        <th style="width: 2%;"><input type="checkbox" class="form_control" id="selecte_all_compte"></th>

                        <th class="sorting" name="tri" style="width: 10%;">Date création </th>
                        <th class="sorting" id="tri_numero" name="tri" style="width: 12%;">Numéro </th>
                        <th class="sorting" id="tri_serie" name="tri" style="width: 10%;">Référence </th>
                        <th class="sorting" id="tri_numero" name="tri" style="width: 20%;">Demandeur</th>
                        <th class="sorting" id="tri_numero" name="tri" style="width: 20%;">Nature Document</th>
                        <th class="sorting" id="tri_numero" name="tri" style="width: 9%;">Montant Estimatif</th>
                        <th id="tri_user" name="tri" onclick="tri('user')" style="width: 25%;">Etat </th>
                        <th style="width: 14%;">Opérations</th>
                    </tr>
                    <tr>

                        <th></th>
                        <th></th>

                        <th><input type="text" class="align_center" id="numero_bci" onkeyup="goPage(1);" /></th>

                        <th><input type="text" class="align_center" id="reference_bci" onkeyup="goPage(1);" /></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot id="listPiece_footer">

                </tfoot>
                <tbody>
                    <?php include_partial("documentachat/liste", array("pager" => $pager, "page" => $page)) ?>
                </tbody>

            </table>
        </div>
    </div>
    <input type="hidden" id="array_bci" name="array_bci">
    <?php if ( $pager->getResults()->count() >0 && $pager->getResults()->getFirst()->getIdEtatdoc() == 1) { ?>
        <?php if ($pager->getResults()->getFirst()->getIdNaturedoc() == 2 || $pager->getResults()->getFirst()->getIdNaturedoc() == 1) { ?>

            <div class="pull-right">
                <a type="button" value="Exporter D/Achat Regroupe" class="btn btn-primary" onclick="ExporterDARegrouppe()">Exporter D/Achat Regroupe</a>
            </div>
    <?php }
    } ?>
</div>
<script type="text/javascript">
    function setAffichageDetail(index, id) {
        if (!$('#ligne_' + index).closest('tr').next().attr('class')) {
            var count_ligne = 0;
            $('#listPiece tbody tr').each(function() {
                count_ligne++;
            });
            $.ajax({
                url: '<?php echo url_for('documentachat/detailRow') ?>',
                data: 'id=' + id,
                success: function(data) {
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

    // $("table").addClass("table table-bordered table-hover");

    function AddIdDocachat(id) {

        if (id != 'undefined') {
            ids_bci = '';
            if ($('#ligne_' + id).attr('style') && $('#check_' + id).is(':checked') == true) {
                $('#ligne_' + id).removeAttr('style');
                $('#check_' + id).prop("checked", true);
                $('#check_' + id).removeClass("disabledbutton");
                console.log($('#check_' + id).is(':checked'));
            } else if ($('#check_' + id).is(':checked') == false) {
                $('#ligne_' + id).attr('style', 'background-color:  #e5e7e9 ;');
                $('#check_' + id).prop("checked", false);
                $('#check_' + id).removeClass("disabledbutton");
            }
            if ($('#check_' + id).is(':checked')) {
                $('#ligne_' + id).attr('style', 'background-color:  #e5e7e9 ;');
            } else {
                $('#ligne_' + id).removeAttr('style');
            }
            $('input[type=checkbox]').each(function() {
                var sThisVal = (this.checked ? "1" : "0");
                if (sThisVal == '1') {
                    identifient = $(this).attr('idientifiant');
                    if (ids_bci != 'undefined') {
                        if (ids_bci == '')
                            ids_bci = $(this).attr('idientifiant');
                        else
                            ids_bci += ',' + $(this).attr('idientifiant');
                    }
                }
            });
            $('#array_bci').val(ids_bci);

        }
    }
</script>
<script>
    $('#selecte_all_compte').change(function() {
        var id = '';
        $('#loading_select_icon').fadeIn();
        if ($('#selecte_all_compte').is(':checked')) {
            $('.list_checbox_facture[type=checkbox]').prop('checked', true);
            $('.list_checbox_facture[type=checkbox]:checked').each(function() {
                id = $(this).attr('idientifiant');

                AddIdDocachat(id);
            });
            $('#loading_select_icon').fadeOut();
        } else {
            $('.list_checbox_facture[type=checkbox]').prop('checked', false);
            $('#array_bci').val('');
        }
    });


    function ExporterDARegrouppe() {
        if ($('#array_bci').val() == '') {
            bootbox.dialog({
                message: "Veuillez choisir des BCIS !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm",
                    }
                }
            });
        } else {

            console.log($('#array_bci').val(), 'fr');
            $('#liste_bci').empty();
            $('#liste_bci').append(`<input type="hidden" value="${$('#array_bci').val()}" name="ids">`);
            $('#liste_bci').submit();
            console.log($('#array_bci').val(), 'vv');
        }

    }

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('documentachat/goPage'); ?>',
            data: 'page=' + page + '&numero_bci=' + $('#numero_bci').val() + '&reference_bci=' + $('#reference_bci').val(),
            success: function(data) {
                $('#listPiece tbody').html(data);
            }
        });
    }
</script>
<style>
    table thead{
        height: 10px !important;
    }
</style>