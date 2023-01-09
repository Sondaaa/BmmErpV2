<table class="table table-bordered table-hover" style="margin-bottom: 0px;">
    <tr>
        <td>
            <table style="margin-bottom: 0px; width: 100%;">
                <tr>
                    <td style="width: 15%; vertical-align: middle; font-weight: bold;">Compte du : </td>
                    <td style="width: 40%;"><input type="text" id="compte_debut" style=" width: 100%;" /></td>
                    <td style="width: 5%;"> </td>
                    <td style="width: 5%; vertical-align: middle; font-weight: bold;">au : </td>
                    <td style="width: 35%;">
                        <input type="text" id="compte_fin" style=" width: 100%;" />
                    </td>
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
        if ($('#compte_debut').val() != '') {
            $('#compte_debut').css('border', '');
            $.ajax({
                url: '<?php echo url_for('multicriteres/rechercheCompte') ?>',
                data: 'filtre=' + $('#filtre_all').val() + '&compte_debut=' + $('#compte_debut').val() + '&compte_fin=' + $('#compte_fin').val(),
                success: function (data) {
                    $('#liste_recherche').html(data);
                }
            });
        } else {
            $('#compte_debut').css('border', '3px solid red');
            $('#liste_recherche').html('');
        }
    }

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('multicriteres/rechercheCompte'); ?>',
            data: 'filtre=' + $('#filtre_all').val() + '&page=' + page + '&compte_debut=' + $('#compte_debut').val() + '&compte_fin=' + $('#compte_fin').val(),
            success: function (data) {
                $('#liste_recherche').html(data);
            }
        });
    }

</script>