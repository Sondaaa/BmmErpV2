<div id="sf_admin_container">
    <h1 id="replacediv">
        Rèfèrentiel Comptable
    </h1>
</div>
<div class="row">
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Ajouter Rèfèrentiel Comptable</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">

                    <form method="post" action="<?php echo url_for('@ajouterReferentiel') ?>" enctype="multipart/form-data">
                        <fieldset>
                            <table>
                                <tr>
                                    <td><label>Rèfèrentiel Comptable* :</label></td>
                                    <td> <input id="libelle" name="libelle" type="text" value="" class="form-control" placeholder="Libellé " />
                                    </td>

                                </tr>
                                <tr>
                                    <td><label>Choisir le Rèfèrentiel </label></td>
                                    <td>  
                                        <input name="lib_fichier" id="lib_fichier" type="file">

                                    </td>
                                </tr>
                            </table>

                        </fieldset>
                         <hr />
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="submit" class="btn btn-sm btn-success pull-right" value="Ajouter">
                                
                                
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
                <h4 class="widget-title smaller">Modifier Rèfèrentiel Comptable</h4>
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
            Liste des Rèfèrenteils Comptables
        </div>
        <div>
            <table id="list_forme" class="mws-datatable-fn mws-table">
                <thead>
                    <tr>
                        <th style="width: 40%;">Libellé</th>
                        <th style="width: 40%;">Chemin Rèfèrentiel</th>
                        <th style="width: 20%; text-align: center;">Opérations</th>
                    </tr>
                    <tr>
                        <th><input type="text" id="libelle_filtre" onkeyup="goPage(1);" /></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php include_partial('referentielcomptable/liste_referentiel', array('pager' => $pager)) ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>


<script  type="text/javascript">

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('@referentielcomptable') ?>',
            data: 'page=' + page + '&libelle=' + $("#libelle_filtre").val(),
            success: function (data) {
                $('#list_forme > tbody').html(data);
            }
        });
    }

//    function ajouter() {
//        var filename = $('#lib_fichier').val().replace(/.*(\/|\\)/, '');
//        if ($('#libelle').val() != '' || $('#lib_fichier').val() != '') {
//            $('#libelle').css('border', '');
//            $.ajax({
//                url: '<?php // echo url_for('@ajouterReferentiel') ?>',
//                data: 'new_libelle=' + $('#libelle').val() + '&url=' + filename,
//                success: function (data) {
//                    $('#libelle').val('');
//                    $('#lib_fichier').val('');
//                    $('#list_forme > tbody').html(data);
//                }
//            });
//        }
//        else {
//            $('#libelle').css('border-color', '#f2a696');
//            $('#lib_fichier').css('border-color', '#f2a696');
//        }
//    }

    function deleteForme(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer ce Rèfèrentiel Comptable  ?",
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
            url: '<?php echo url_for('@deleteReferentiel') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#list_forme > tbody').html(data);
            }
        });
    }

    function editForme(id) {
        $.ajax({
            url: '<?php echo url_for('@editReferentiel') ?>',
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

//    function modifier(id) {
//        var filename = $('#lib_fichier_edit').val().replace(/.*(\/|\\)/, '');
//        if ($('#libelle_edit').val() != '') {
//            $('#libelle_edit').css('border', '');
//            $.ajax({
//                url: '<?php // echo url_for('@updateReferentiel') ?>',
//                data: 'id=' + id + '&new_libelle=' + $('#libelle_edit').val() + '&url=' + filename,
//                success: function (data) {
//
//                    $('#list_forme > tbody').html(data);
//                    $('#zone_edit').fadeOut();
//
//                }
//            });
//        }
//        else {
//            $('#libelle_edit').css('border-color', '#f2a696');
//        }
//    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Referentiel Comptable ");
</script>