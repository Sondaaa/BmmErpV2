<table class="table table-bordered table-hover" style="margin-bottom: 0px;">
    <tr>
        <td style="width: 12%;">Montant : </td>
        <td style="width: 20%;">
            <select id="filtre_piece" class="form-control">
                <option value="=">Egale à ( = )</option>
                <option value="<>"> Comprise entre ( <= , >= )</option>
                <option value=">"> supérieure à ( > )</option>
                <option value="<"> inférieure à ( < )</option>
                <option value=">="> supérieure ou égale à ( >= )</option>
                <option value="<="> inférieure ou égale à ( <= )</option>
            </select>
        </td>
        <td style="width: 58%;">
            <div id="champ_piece_defaut" style="width: 100%;">
                <input type="text" id="montant" />
            </div>

            <div id="champ_piece_compris" style="display:none;width: 100%;">
                <table style="margin-bottom: 0px; width: 100%;" cellspace="5">
                    <tr>
                        <td style="vertical-align: middle; font-weight: bold; text-align:right; width: 55%;">compris entre : 
                            <input type="text" id="montant_min" />
                        </td>
                        <td style="width: 5%;"></td>
                        <td style="vertical-align: middle; font-weight: bold; width: 40%;"> et :
                            <input type="text" id="montant_max" />
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td style="text-align: center; width: 10%;">
            <button id="button_rechercher" style="min-width: 130px;" class="btn btn-xs btn-primary" onclick="rechercher()"><i class="ace-icon fa fa-search bigger-110"></i> Afficher</button>
        </td>
    </tr>
</table>

<script  type="text/javascript">

    $('#filtre_piece').change(function () {
        if ($(this).val() == '<>') {
            $('#champ_piece_compris').css('display', 'block');
            $('#champ_piece_defaut').css('display', 'none');
            $('#montant').val('');
        } else {
            $('#champ_piece_compris').css('display', 'none');
            $('#champ_piece_defaut').css('display', '');
            $('#montant_min').val('');
            $('#montant_max').val('');
        }
    });

    function rechercher() {
        if ($('#montant').val() != '' || $('#montant_min').val() != '' || $('#montant_max').val() != '') {
            $('#montant').css('border', '');
            $('#montant_min').css('border', '');
            $('#montant_max').css('border', '');
            $.ajax({
                url: '<?php echo url_for('multicriteres/rechercheMontant') ?>',
                data: 'filtre=' + $('#filtre_all').val() + '&operation=' + $('#filtre_piece').val() + '&montant=' + $('#montant').val() +
                        '&montant_min=' + $('#montant_min').val() + '&montant_max=' + $('#montant_max').val(),
                success: function (data) {
                    $('#liste_recherche').html(data);
                }
            });
        } else {
            $('#montant').css('border', '3px solid red');
            $('#montant_min').css('border', '3px solid red');
            $('#montant_max').css('border', '3px solid red');
            $('#liste_recherche').html('');
        }
    }

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('multicriteres/rechercheMontant'); ?>',
            data: 'filtre=' + $('#filtre_all').val() + '&page=' + page +
                    '&operation=' + $('#filtre_piece').val() + '&montant=' + $('#montant').val() +
                    '&montant_min=' + $('#montant_min').val() + '&montant_max=' + $('#montant_max').val(),
            success: function (data) {
                $('#liste_recherche').html(data);
            }
        });
    }

</script>