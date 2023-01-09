<div id="sf_admin_container">
    <h1 id="replacediv"> Paramètres Globaux  
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Exercice Comptable
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Ajouter exercice comptable</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <label>Exercice Comptable * :</label>
                            <input id="libelle" placeholder="Libellé exercice comptable" readonly="true" type="text" value="" />
                        </fieldset>
                        <br>
                        <fieldset>
                            <div class="col-xs-6">
                                <label style="width: 100%;">Date Ouverture :</label>
                                <input id="date_debut" type="date" value="" onchange="setLibelle()" style="width: 100%"/>
                            </div>
                            <div class="col-xs-6">
                                <label style="width: 100%;">Date Clôture :</label>
                                <input id="date_fin" type="date" value="" style="width: 100%"/>
                            </div>
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
                <h4 class="widget-title smaller">Modifier exercice comptable</h4>
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
            Liste des exercices comptables
        </div>
        <div>
            <table id="list_forme" class="mws-datatable-fn mws-table">
                <thead>
                    <tr>
                        <th style="width: 40%; text-align: center;">Exercice Comptable</th>
                        <th style="width: 20%; text-align: center;">Date Ouverture</th>
                        <th style="width: 20%; text-align: center;">Date Clôture</th>
                        <th style="width: 20%; text-align: center;">Opérations</th>
                    </tr>
                    <tr>
                        <th><input style="text-align: center;" type="text" id="libelle_filtre" onkeyup="goPage(1);" /></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php include_partial('parametre/liste_exercice', array('pager' => $pager)) ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>


<script  type="text/javascript">

    function setLibelle() {
        var input = $('#date_debut').val();
        var d = new Date(input);
        if (!!d.valueOf()) { // Valid date
            var year = d.getFullYear();
            var month = d.getMonth();
            var day = d.getDate();
            $('#libelle').val(year);
            var min_date = year + '-' + month + '-' + day;
            var max_date = year + '-12-31';
            $('#date_fin').attr('min', min_date);
            $('#date_fin').attr('max', max_date);
            $('#date_fin').val(max_date);
        } else { /* Invalid date */
            $('#libelle').val('');
        }
    }

    function setMinMaxDate() {
        var annee_exercice = $('#exercice option:selected').attr('annee');
        var min_date = annee_exercice + '-01-01';
        var max_date = annee_exercice + '-12-31';
        $('#date_debut_ouverture').attr('min', min_date);
        $('#date_debut_ouverture').attr('max', max_date);
        $('#date_fin_fermeture').attr('min', min_date);
        $('#date_fin_fermeture').attr('max', max_date);
    }

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('@exercice') ?>',
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
                url: '<?php echo url_for('@ajouterExercice') ?>',
                data: 'new_libelle=' + $('#libelle').val() +
                        '&date_debut=' + $("#date_debut").val() +
                        '&date_fin=' + $("#date_fin").val(),
                success: function (data) {
                    if (data == 'existe') {
                        bootbox.dialog({
                            message: "<span class='bigger-110' style='margin:20px;'>Cet exercice comptable existe déjà !</span>",
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
                        $("#date_debut").val('');
                        $("#date_fin").val('');
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
            message: "Voulez-vous supprimer cet exercice comptable ?",
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
            url: '<?php echo url_for('@deleteExercice') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#list_forme > tbody').html(data);
            }
        });
    }

    function editForme(id) {
        $.ajax({
            url: '<?php echo url_for('@editExercice') ?>',
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
                url: '<?php echo url_for('@updateExercice') ?>',
                data: 'id=' + id +
                        '&new_libelle=' + $('#libelle_edit').val() +
                        '&date_debut=' + $("#date_debut_edit").val() +
                        '&date_fin=' + $("#date_fin_edit").val(),
                success: function (data) {
                    if (data == 'existe') {
                        bootbox.dialog({
                            message: "<span class='bigger-110' style='margin:20px;'>Cet exercice comptable existe déjà !</span>",
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
    document.title = ("BMM - G. Compta. : Exercice comptable");
</script>