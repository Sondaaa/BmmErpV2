<div id="sf_admin_container" ng-controller="myCtrlPaysVille">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="smaller lighter blue no-margin">Ajouter Activité</h3>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <label>Activité * :</label>
                            <input id="libelleA" placeholder=" Libellé Activite" type="text" value="" class="form-control" />
                        </fieldset>
                        <hr />
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                 <button style="margin-left: 2px" class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    fermer
                </button>
                <button  class="btn btn-sm btn-primary pull-right" data-dismiss="modal" onclick="ajouterActivite()">
                    <i class="ace-icon fa fa-plus"></i>
                    Ajouter
                </button>

               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script  type="text/javascript">
    function ajouterActivite() {
        if ($('#libelleA').val() != '') {
            $('#libelleA').css('border', '');
            $.ajax({
                url: '<?php echo url_for('@ajouterActiviteForDossier') ?>',
                data: 'new_libelle=' + $('#libelleA').val(),
                success: function (data) {
                    if (data == 'existe') {
                        bootbox.dialog({
                            message: "<span class='bigger-110' style='margin:20px;'>Cette Activité existe déjà !</span>",
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
                        $('#libelleA').val('');
                        $('#activite').html(data);
                        $('.chosen-container').attr("style", "width: 100%;");
                        $('#activite').val('').trigger("liszt:updated");
                        $('#activite').trigger("chosen:updated");
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
    .table{margin-bottom: 1px;}
</style>