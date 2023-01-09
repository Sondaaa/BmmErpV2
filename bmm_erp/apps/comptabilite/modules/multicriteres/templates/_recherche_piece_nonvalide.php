<table class="table table-bordered table-hover pull-left" style="margin-bottom: 0px;" >
    <tr>
         <td style="width: 70%;font-size: 18px"> Recherchce des Pièces comptables non validés: </td>
        <td style="text-align: center; width: 30%;">
            <button id="button_rechercher" style="min-width: 130px;" class="btn btn-xs btn-primary" onclick="rechercher()"><i class="ace-icon fa fa-search bigger-110"></i> Afficher</button>
        </td>
    </tr>
</table>

<script  type="text/javascript">

    $('#user').chosen({allow_single_deselect: true});

    function rechercher() {

        $.ajax({
            url: '<?php echo url_for('multicriteres/recherchePiecenonvalide') ?>',
            data: 'filtre=' + $('#filtre_all').val() ,
            success: function (data) {
                $('#liste_recherche').html(data);
            }
        });
    }


    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('multicriteres/recherchePiecenonvalide'); ?>',
            data: 'filtre=' + $('#filtre_all').val() + '&page=' + page ,
            success: function (data) {
                $('#liste_recherche').html(data);
            }
        });
    }

</script>