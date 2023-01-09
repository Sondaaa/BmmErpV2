<div id="sf_admin_container">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="smaller lighter blue no-margin">Ajouter Secteur d'activité</h3>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <label>Secteur d'activité * :</label>
                            <input id="libelleS" placeholder="Secteur d'activité" type="text" value="" class="form-control" />
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
                <button  class="btn btn-sm btn-primary pull-right" data-dismiss="modal" onclick="ajouterSecteurActivite()">
                    <i class="ace-icon fa fa-plus"></i>
                    Ajouter
                </button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script  type="text/javascript">
    function ajouterSecteurActivite() {
        if ($('#libelleS').val() != '') {
            $('#libelleS').css('border', '');
            $.ajax({
                url: '<?php echo url_for('@ajouterSecteurForDossier') ?>',
                data: 'new_libelle=' + $('#libelleS').val(),
                success: function (data) {
                    if (data == 'existe') {
                        bootbox.dialog({
                            message: "<span class='bigger-110' style='margin:20px;'>Cette Secteur d'activite existe déjà !</span>",
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
                        $('#libelleS').val('');
                        $('#secteur_activite').html(data);
                        $('.chosen-container').attr("style", "width: 100%;");
                        $('#secteur_activite').val('').trigger("liszt:updated");
                        $('#secteur_activite').trigger("chosen:updated");
                    }
                }
            });
        }
        else {
            $('#libelleS').css('border-color', '#f2a696');
        }
    }
</script>