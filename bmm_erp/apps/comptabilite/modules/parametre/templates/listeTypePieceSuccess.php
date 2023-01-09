<div id="sf_admin_container">
    <h1 id="replacediv"> Paramètres Globaux 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Type Pièce
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Ajouter type de pièce</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <label>Type Pièce * :</label>
                            <input id="libelle" placeholder="Libellé type de pièce" type="text" value="" class="form-control" />
                        </fieldset>

                        <hr/>
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-sm btn-success pull-right" onclick="ajouter()">
                                    Ajouter
                                    <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6" id="zone_edit" style="display: none;">
        <div class="widget-box widget-color-grey">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Modifier type pièce</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main" id="zone_form_edit">

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Liste des types des pièces
        </div>
        <div>
            <table id="list_forme" class="mws-datatable-fn mws-table">
                <thead>
                    <tr>
                        <th style="width: 80%;">Type pièce</th>
                        <th style="width: 20%; text-align: center;">Opérations</th>
                    </tr>
                    <tr>
                        <th><input type="text" id="libelle_filtre" onkeyup="goPage(1);" /></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php include_partial('parametre/liste_type_piece', array('pager' => $pager)) ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>


<script  type="text/javascript">

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('@typePiece') ?>',
            data: 'page=' + page + '&libelle=' + $("#libelle_filtre").val(),
            success: function (data) {
                $('#list_forme > tbody').html(data);
            }
        });
    }

    function ajouter() {
        if ($('#libelle').val() != '') {
            $('#libelle').css('border', '');
            $.ajax({
                url: '<?php echo url_for('@ajouterTypePiece') ?>',
                data: 'new_libelle=' + $('#libelle').val(),
                success: function (data) {
                    if (data == 'existe') {
                        bootbox.dialog({
                            message: "<span class='bigger-110' style='margin:20px;'>Ce type de pièce existe déjà !</span>",
                            buttons:
                                    {
                                        "button":
                                                {
                                                    "label": "Ok",
                                                    "className": "btn-sm"
                                                }
                                    }
                        });
                        return false;
                    } else {
                        $('#libelle').val('');
                        $('#list_forme > tbody').html(data);
                    }
                }
            });
        }
        else {
            $('#libelle').css('border-color', '#f2a696');
        }
    }

    function deleteForme(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer ce type de pièce ?",
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
                    validerSuppression(id);
                }
            }
        });
    }

    function validerSuppression(id) {
        $.ajax({
            url: '<?php echo url_for('@deleteTypePiece') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#list_forme > tbody').html(data);
            }
        });
    }

    function editForme(id) {
        $.ajax({
            url: '<?php echo url_for('@editTypePiece') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#zone_form_edit').html(data);
                $('#zone_edit').fadeIn();
            }
        });
    }

    function annuler() {
        $('#zone_edit').fadeOut();
    }

    function modifier(id) {
        if ($('#libelle_edit').val() != '') {
            $('#libelle_edit').css('border', '');
            $.ajax({
                url: '<?php echo url_for('@updateTypePiece') ?>',
                data: 'id=' + id + '&new_libelle=' + $('#libelle_edit').val(),
                success: function (data) {
                    if (data == 'existe') {
                        bootbox.dialog({
                            message: "<span class='bigger-110' style='margin:20px;'>Ce type de pièce existe déjà !</span>",
                            buttons:
                                    {
                                        "button":
                                                {
                                                    "label": "Ok",
                                                    "className": "btn-sm"
                                                }
                                    }
                        });
                        return false;
                    } else {
                        $('#list_forme > tbody').html(data);
                        $('#zone_edit').fadeOut();
                    }
                }
            });
        }
        else {
            $('#libelle_edit').css('border-color', '#f2a696');
        }
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Type de pièce");
</script>