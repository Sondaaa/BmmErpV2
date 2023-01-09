<span class="titre_tiers_modal">Situation Fiscale Fournisseur : <?php
    if ($mvt->getIdFournisseur())
        echo $mvt->getFournisseur()->getRs()
        ?></span>

<table id="form_tiers">
    <tr>
        <td>
            <label>Situation Fiscale : </label>
            <select id="etat_frs">
                <option></option>

                <option  <?php if ($mvt->getEtatfrs() == '1'): ?>
                        selected="true" <?php endif; ?>  value="<?php echo '1'; ?>" > <?php echo 'En Régle' ?>
                </option>
                <option  <?php if ($mvt->getEtatfrs() == '0'): ?>
                        selected="true" <?php endif; ?>  value="<?php echo '0'; ?>" >  <?php echo 'En Défaut' ?>
                </option>
            </select>
        </td>
    </tr>
</table>

<script  type="text/javascript">

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