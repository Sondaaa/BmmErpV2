<?php
$var = 0;
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query = " SELECT grillepresence.jour as jour , motif.libelle as motif"
        . " FROM grillepresence , motif, presence"
        . " WHERE presence.id_agents=" . $id
        . " and grillepresence.id_presnece = presence.id"
        . " and grillepresence.id_motif=motif.id"
        . " and motif.id IS NOT NULL"
        . " and grillepresence.semaine='" . $var . "'"
;
$resultat = $conn->fetchAssoc($query);
?>
<?php
if ($id < 10)
    $id = '0' . $id;
?>
<span class="titre_tiers_modal">Cause  d'absence  du Jour 
   </span></br></br><br>

<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th style="width: 25%">  Jour  d'Absence  </th>
        <th>  Motif d'absence </th>
    </tr>
    </thead>
    <tbody>
        <tr>
      <?php for ($j = 0; $j < sizeof($resultat); $j++): ?> 
            <td><?php echo $resultat[$j]['motif'] ?></td>
            <?php endfor; ?>
        </tr>
    </tbody>
</table>
<script  type="text/javascript">

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