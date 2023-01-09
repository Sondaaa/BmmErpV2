<div id="sf_admin_container">
    <h1 id="replacediv"> Opération  
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Modifier Fiche Mouvement : 
        </small>
    </h1>
</div>
<div class="widget-box">
    <div class="widget-header widget-header-flat">
        <h4 class="widget-title smaller">Fiche Mouvement</h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <form>
                <fieldset>
                    <table >
                        <tr>
                            <td style="width: 25%;">
                                <label>Numéro Mouvement :</label>
                                <input  type="text" id="reference" value="<?php echo $mvt->getNumerofacture() ?>">
                            </td>

                        </tr>

                        <tr>

                            <td colspan="2">
                                <label>Etat Fournisseur :</label>
                                <select id="">                                    
                                    <option value="<?php echo '1'; ?>" <?php if ($mvt->getEtatfrs() == '1') { ?>selected="true"<?php } ?>>
                                        <?php echo 'En Régle'; ?> 
                                    </option>
                                    <option value="<?php echo '0'; ?>" <?php if ($mvt->getEtatfrs() == '1') { ?>selected="true"<?php } ?>>
                                        <?php echo 'En Défaut'; ?> 
                                    </option>
                                </select>
                            </td>
                        </tr>

                    </table>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<div class="clearfix form-actions">
    <div class="col-md-offset-5 col-md-6">
        <button class="btn btn-info" type="button" onclick="saveEditFournisseur(<?php // echo $fournisseur->getId(); ?>)">
            <i class="ace-icon fa fa-edit bigger-110"></i>
            Modifier
        </button>
        <a type="button" class="btn btn-default" href="<?php // echo url_for('@listFournisseur') ?>">Annuler <i class="ace-icon fa fa-undo bigger-110"></i></a>
    </div>
</div>
<script  type="text/javascript">
    function saveEditFournisseur(id) {
        $.ajax({
            url: '<?php echo url_for('@saveEditFournisseur') ?>',
            data: 'reference=' + $('#reference').val() +
                    '&id=' + id +
                    '&code=' + $('#code').val() +
                    '&nom=' + $('#nom').val() +
                    '&prenom=' + $('#prenom').val() +
                    '&rs=' + $('#rs').val() +
                    '&telephone=' + $('#telephone').val() +
                    '&gsm=' + $('#gsm').val() +
                    '&mail=' + $('#mail').val() +
                    '&compte=' + $('#compte').val() +
                    '&observation=' + $('#observation').val(),
            success: function (data) {
                if (data != '')
                    bootbox.dialog({
                        message: "<span class='bigger-160' style='margin:20px;color:#b31531;'></span><br><span class='bigger-110' style='margin:20px;color:#9c33ff  ;'>Modfication avec succées !!</span>",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                location.href = '<?php echo url_for('@listFournisseur') ?>';
            }
        });

    }


    $('#compte').attr('class', "chosen-select form-control");
    $('#compte').attr('style', 'width: 100%;');

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

    .modal-dialog {width: 740px;}
    td > label{font-size: 18px;}
    .titre_tiers_modal{font-size: 16px; color: #2679b5;}
    #form_tiers{width: 90%; margin: 5% 5% 0% 5%;}
    #form_tiers tbody tr td{padding: 5px;}

</style>