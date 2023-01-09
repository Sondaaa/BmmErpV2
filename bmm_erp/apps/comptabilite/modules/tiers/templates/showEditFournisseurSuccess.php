<div id="sf_admin_container">
    <h1 id="replacediv"> Tiers 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Modifier Client : <?php echo $fournisseur->getRs() ?>
        </small>
    </h1>
</div>
<div class="widget-box">
    <div class="widget-header widget-header-flat">
        <h4 class="widget-title smaller">Fiche Fournisseur</h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <form>
                <fieldset>
                    <table >
                        <tr>
                            <td style="width: 25%;">
                                <label>Référence :</label>
                                <input  type="text" id="reference" value="<?php echo $fournisseur->getReference() ?>">
                            </td>
                            <td style="width: 25%;">
                                <label>Code Fournisseur :</label>
                                <input  type="text" id="code" value="<?php echo $fournisseur->getCodefrs() ?>">
                            </td>
                            <td style="width: 25%;">
                                <label> Nom  :</label>
                                <input  type="text" id="nom" value="<?php echo $fournisseur->getNom() ?>">
                            </td>
                            <td style="width: 25%;">
                                <label>Prénom :</label>
                                <input  type="text" id="prenom" value="<?php echo $fournisseur->getPrenom() ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label>Raison Sociale:</label>
                                <input id="rs"  type="text" value="<?php echo $fournisseur->getRs() ?>" />
                            </td>

                            <td>
                                <label>Téléphone :</label>
                                <input id="telephone" type="text" value="<?php echo $fournisseur->getTel() ?>" />
                            </td>
                            <td>
                                <label>G.S.M:</label>
                                <input id="gsm" type="text" value="<?php echo $fournisseur->getGsm() ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label>E-mail:</label>
                                <input id="mail"  type="text" value="<?php echo $fournisseur->getMail() ?>" />
                            </td>

                            <td colspan="2">
                                <label>Compte comptable :</label>
                                <?php $comptes = PlanComptableTable::getInstance()->findOrderByNumeroSousClasse('40'); ?>
                                <select id="compte">
                                    <option></option>
                                    <?php foreach ($comptes as $compte): ?>
                                        <option id="compte_<?php echo $compte->getNumerocompte() ?>" <?php if ($fournisseur->getIdPlancomptable() == $compte->getId()): ?> selected="true" <?php endif; ?>  value="<?php echo $compte->getId() ?>"> <?php echo $compte->getNumerocompte() . ' - ' . $compte->getLibelle() ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <label>Observation:</label>
                                <textarea  id="observation"><?php echo $fournisseur->getObservation() ?></textarea>
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
        <button class="btn btn-info" type="button" onclick="saveEditFournisseur(<?php echo $fournisseur->getId(); ?>)">
            <i class="ace-icon fa fa-edit bigger-110"></i>
            Modifier
        </button>
        <a type="button" class="btn btn-default" href="<?php echo url_for('@listFournisseur') ?>">Annuler <i class="ace-icon fa fa-undo bigger-110"></i></a>
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