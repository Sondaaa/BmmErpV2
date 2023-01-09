<span class="titre_tiers_modal">Client : <?php echo $clients->getRs() ?></span>

<table id="form_tiers">
    <tr>
        <td>
            <label>Compte comptable :</label>
            <select id="compte">
                <option></option>
                <?php foreach ($comptes as $compte): ?>
                    <option id="compte_<?php echo $compte->getNumerocompte() ?>" <?php if ($clients->getIdPlancomptable() == $compte->getId()): ?> selected="true" <?php endif; ?>  value="<?php echo $compte->getId() ?>"> <?php echo $compte->getNumerocompte() . ' - ' . $compte->getLibelle() ?> </option>
                <?php endforeach; ?>
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