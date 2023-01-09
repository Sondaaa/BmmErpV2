<?php
if ($id < 10)
    $id = '0' . $id;
?>
<span class="titre_tiers_modal">Cause  d'absence  du Jour  <?php echo $id ?>
    <?php
    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
    echo strftime('%B', strtotime($annee . '-' . $mois . '-' . $id)) . ' ';
    ?>
    <?php echo $annee ?> :</span></br></br><br>

<table class="table table-bordered table-hover">
    <tr>
        <td style="width: 25%">  <label>Choisir Motif : </label></td>

        <td>  <select id="motif_absence" style="width: 541px" >
                <option></option>
                <?php //$motif = MotifTable::getInstance()->findAll(); ?>
                  <?php $motif = MotifTable::getInstance()->findAllSaufConge(); ?>
                <?php foreach ($motif as $m): ?>
                    <option value_code="<?php echo $m->getCode(); ?>" value="<?php echo $m->getId(); ?>"><?php echo $m->getCode() . "  -  " . $m->getLibelle(); ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
</table>
<script>

    $('#motif_absence').attr('class', "chosen-select form-control");
    $('#motif_absence').attr('style', 'width: 100%;');

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