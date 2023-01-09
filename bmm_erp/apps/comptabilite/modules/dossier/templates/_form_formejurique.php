<div id="sf_admin_container" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="smaller lighter blue no-margin">Ajouter forme juridique</h3>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <label>Forme juridique * :</label>
                            <input id="libelle" placeholder="Forme juridique" type="text" value="" class="form-control" />
                        </fieldset>

                        <hr />
                    </form>
                </div>
            </div>
            <div class="row"></div>
            <div class="modal-footer">
                <button style="margin-left: 2px" class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    fermer
                </button>
                <button   class="btn btn-sm btn-primary pull-right" data-dismiss="modal"  onclick="ajouterFormeJu()">
                    <i class="ace-icon fa fa-plus"></i>
                    Ajouter
                </button>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script  type="text/javascript">
    function ajouterFormeJu() {
        if ($('#libelle').val() != '') {
            $('#libelle').css('border', '');
            $.ajax({
                url: '<?php echo url_for('@ajouterFormeForDossier') ?>',
                data: 'new_libelle=' + $('#libelle').val(),
                success: function (data) {
                    if (data == 'existe') {
                        bootbox.dialog({
                            message: "<span class='bigger-110' style='margin:20px;'>Cette forme juridique existe déjà !</span>",
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
                        $('#forme_juridique').html(data);
                        $('.chosen-container').attr("style", "width: 100%;");
                        $('#forme_juridique').val('').trigger("liszt:updated");
                        $('#forme_juridique').trigger("chosen:updated");
                        //    document.location.reload(true);
                    }
                }
            });
        }
        else {
            $('#libelle').css('border-color', '#f2a696');
        }
    }
</script>
<style>
    .table{margin-bottom: 0px;}
</style>