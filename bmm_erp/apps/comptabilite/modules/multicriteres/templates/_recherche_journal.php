<table class="table table-bordered table-hover" style="margin-bottom: 0px;">
    <tr>
        <td>
            <table style="margin-bottom: 0px; width: 100%;">
                <tr>
                    <td style="width: 15%; vertical-align: middle; font-weight: bold;">Journal du : </td>
                    <td style="width: 40%;"><input type="date" id="date_debut" /></td>
                    <td style="width: 5%;"> </td>
                    <td style="width: 5%; vertical-align: middle; font-weight: bold;">au : </td>
                    <td style="width: 35%;"><input type="date" id="date_fin" /></td>
                </tr>
            </table>
        </td>
        <td style="text-align: center; width: 10%;">
            <button id="button_rechercher" style="min-width: 130px;" class="btn btn-xs btn-primary" onclick="rechercher()"><i class="ace-icon fa fa-search bigger-110"></i> Afficher</button>
        </td>
    </tr>
</table>

<script  type="text/javascript">

    function rechercher() {
        if ($('#date_debut').val() != '' || $('#date_fin').val() != '') {
            $('#date_debut').css('border', '');
            $('#date_fin').css('border', '');
            $.ajax({
                url: '<?php echo url_for('multicriteres/rechercheJournal') ?>',
                data: 'filtre=' + $('#filtre_all').val() + '&date_debut=' + $('#date_debut').val() + '&date_fin=' + $('#date_fin').val(),
                success: function (data) {
                    $('#liste_recherche').html(data);
                }
            });
        } else {
            $('#date_debut').css('border', '3px solid red');
            $('#date_fin').css('border', '3px solid red');
            $('#liste_recherche').html('');
        }
    }

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('multicriteres/rechercheJournal'); ?>',
            data: 'filtre=' + $('#filtre_all').val() + '&page=' + page + '&date_debut=' + $('#date_debut').val() + '&date_fin=' + $('#date_fin').val(),
            success: function (data) {
                $('#liste_recherche').html(data);
            }
        });
    }

</script>