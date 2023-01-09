<div id="sf_admin_container">
    <h1 id="replacediv"> Paramètres Globaux 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            T.V.A
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Ajouter T.V.A</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <label>T.V.A * :</label>
                            <input id="libelle" placeholder="Libellé T.V.A" type="text" value="" class="form-control" />
                        </fieldset>
                        <br>
                        <fieldset>
                            <label>Valeur T.V.A ( en % ) * :</label>
                            <input id="valeur_tva" type="text" value="0" class="form-control" />
                        </fieldset>

                        <hr />
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
                <h4 class="widget-title smaller">Modifier T.V.A</h4>
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
            Liste des T.V.A
        </div>
        <div>
            <table id="list_forme" class="mws-datatable-fn mws-table">
                <thead>
                    <tr>
                        <th style="width: 40%; text-align: center;">T.V.A</th>
                        <th style="width: 20%; text-align: center;">Valeur T.V.A ( en % )</th>
                        <th style="width: 20%; text-align: center;">Opérations</th>
                    </tr>
                    <tr>
                        <th><input style="text-align: center;" type="text" id="libelle_filtre" onkeyup="goPage(1);" /></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php include_partial('parametre/liste_tva', array('pager' => $pager)) ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>


<script  type="text/javascript">

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('@tva') ?>',
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
                url: '<?php echo url_for('@ajouterTva') ?>',
                data: 'new_libelle=' + $('#libelle').val() +
                        '&valeur_tva=' + $("#valeur_tva").val(),
                success: function (data) {
                    if (data == 'existe') {
                        bootbox.dialog({
                            message: "<span class='bigger-110' style='margin:20px;'>Cette T.V.A existe déjà !</span>",
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
                        $("#valeur_tva").val(0);
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
            message: "Voulez-vous supprimer cette T.V.A ?",
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
            url: '<?php echo url_for('@deleteTva') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#list_forme > tbody').html(data);
            }
        });
    }

    function editForme(id) {
        $.ajax({
            url: '<?php echo url_for('@editTva') ?>',
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
                url: '<?php echo url_for('@updateTva') ?>',
                data: 'id=' + id +
                        '&new_libelle=' + $('#libelle_edit').val() +
                        '&valeur_tva=' + $("#valeur_tva_edit").val(),
                success: function (data) {
                    if (data == 'existe') {
                        bootbox.dialog({
                            message: "<span class='bigger-110' style='margin:20px;'>Cette T.V.A existe déjà !</span>",
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
    document.title = ("BMM - G. Compta. : T.V.A");
</script>