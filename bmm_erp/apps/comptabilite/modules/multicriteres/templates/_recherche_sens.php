<table class="table table-bordered table-hover" style="margin-bottom: 0px;">
    <tr>
        <td style="text-align: center; width: 5%; background-color: #EFEFEF;"><input type="checkbox" id="credit" /></td>
        <td>Crédit</td>
        <td style="text-align: center; width: 5%; background-color: #EFEFEF;"><input type="checkbox" id="debit" /></td>
        <td>Débit</td>
        <td style="text-align: center; width: 5%; background-color: #EFEFEF;"><input type="checkbox" id="creditdebit" /></td>
        <td>Crédit et Débit</td>
        <td style="text-align: center; width: 10%;">
            <button id="button_rechercher" style="min-width: 130px;" class="btn btn-xs btn-primary" onclick="rechercher()"><i class="ace-icon fa fa-search bigger-110"></i> Afficher</button>
        </td>
    </tr>
</table>

<script  type="text/javascript">

    function rechercher() {
        if ($('#credit').is(':checked') || $('#debit').is(':checked') || $('#creditdebit').is(':checked')) {
            $.ajax({
                url: '<?php echo url_for('multicriteres/rechercheSens') ?>',
                data: 'filtre=' + $('#filtre_all').val() + '&credit=' + $('#credit').is(':checked') + '&debit=' + $('#debit').is(':checked') + '&creditdebit=' + $('#creditdebit').is(':checked'),
                success: function (data) {
                    $('#liste_recherche').html(data);
                }
            });
        }
    }

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('multicriteres/rechercheSens'); ?>',
            data: 'filtre=' + $('#filtre_all').val() + '&page=' + page + '&credit=' + $('#credit').is(':checked') + '&debit=' + $('#debit').is(':checked') + '&creditdebit=' + $('#creditdebit').is(':checked'),
            success: function (data) {
                $('#liste_recherche').html(data);
            }
        });
    }

</script>