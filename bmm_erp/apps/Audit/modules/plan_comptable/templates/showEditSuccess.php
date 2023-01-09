<span class="titre_tiers_modal">Modifier Compte : <?php echo $compte->getNumerocompte() . ' - ' . $compte->getLibelle(); ?></span>

<table cellspacing="10" style="margin-top: 20px;">
    <tr>
        <td class="padding_top20" style="width:25%;">
            <div class="mws-form-row">
                <label style="width: 100%">Numéro du Compte :</label>
            </div>
        </td>
        <td class="padding_top20" style="width:75%;">
            <div class="mws-form-row">
                <label style="width: 100%">Intitulé * :</label>
            </div>
        </td>
    </tr>
    <tr>
        <td class="padding_right10">
            <input value="<?php echo $compte->getNumeroCompte(); ?>" id="code" type="text">
            <input value="<?php echo $compte->getId() ?>" id="compte_edit_id" type="hidden" >
        </td>
        <td>
            <input  value="<?php echo $compte->getLibelle() ?>" id="libelle_edit" type="text">
        </td>
    </tr>
<!--    <tr>
        <td style="width: 20%" class="padding_top20">
            <div class="mws-form-row">
                <label style="width: 100%">Nature du Solde :</label>
            </div>
        </td>
        <td style="width: 60%" class="padding_top20">
            <div class="mws-form-row">
                <label style="width: 100%">Devise :</label>
            </div>
        </td>
        <td style="width: 20%" class="padding_top20">
            <div class="mws-form-row">
                <label style="width: 100%">Lettrage :</label>
            </div>
        </td>
    </tr>-->
<!--    <tr>
        <td class="padding_right10">
            <select id="nature_edit">
                <option <?php // if ($compte->getTypeSolde() == '0'): ?> selected="selected" <?php // endif; ?> value="0">Débiteur</option>
                <option <?php // if ($compte->getTypeSolde() == '1'): ?> selected="selected" <?php // endif; ?> value="1">Créditeur</option>
                <option <?php // if ($compte->getTypeSolde() == '2'): ?> selected="selected" <?php // endif; ?> value="2">Soldé</option>
                <option <?php // if ($compte->getTypeSolde() == '3'): ?> selected="selected" <?php // endif; ?> value="3">Libre</option>
            </select>
        </td>
        <td class="padding_right10">
            <select id="devise_edit">
                <option value="-1"></option>
                <?php // foreach ($devises as $devise): ?>
                    <option <?php // if ($compte->getIdDevise() == $devise->getId()): ?> selected="selected" <?php // endif; ?> value="<?php // echo $devise->getId(); ?>"><?php // echo $devise->getLibelle(); ?> (<?php // echo $devise->getSigle(); ?>)</option>
                <?php // endforeach; ?>
            </select>
        </td>
        <td>
            <select id="lettrage_edit">
                <option value="-1"></option>
                <option <?php // if ($compte->getLettrage() == '0'): ?> selected="selected" <?php // endif; ?> value="0">Libre</option>
                <option <?php // if ($compte->getLettrage() == '1'): ?> selected="selected" <?php // endif; ?> value="1">Lettrable</option>
                <option <?php // if ($compte->getLettrage() == '2'): ?> selected="selected" <?php // endif; ?> value="2">Rapprochable</option>
            </select>
        </td>
    </tr>-->
</table>

<script  type="text/javascript">

    $('input:text').attr('style', 'width: 100%;');

    $('#nature_edit').attr('style', 'width: 100%;');
    $('#nature_edit').attr('class', "chosen-select form-control");

    $('#devise_edit').attr('style', 'width: 100%;');
    $('#devise_edit').attr('class', "chosen-select form-control");

    $('#lettrage_edit').attr('style', 'width: 100%;');
    $('#lettrage_edit').attr('class', "chosen-select form-control");

    if (!ace.vars['touch']) {
        $('.chosen-select').chosen({allow_single_deselect: true});
        //resize the chosen on window resize

        $(window)
                .off('resize.chosen')
                .on('resize.chosen', function () {
                    $('.chosen-select').each(function () {
                        var $this = $(this);
                        $this.next().css({'width': $this.parent().width()});
                    });
                }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
            if (event_name != 'sidebar_collapsed')
                return;
            $('.chosen-select').each(function () {
                var $this = $(this);
                $this.next().css({'width': $this.parent().width()});
            });
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

</script>

<style>

    .titre_tiers_modal{font-size: 16px;}
    .padding_top20{padding-top: 20px;}
    .padding_right10{padding-right: 10px;}
    .modal-dialog { width: 800px !important;}

</style>