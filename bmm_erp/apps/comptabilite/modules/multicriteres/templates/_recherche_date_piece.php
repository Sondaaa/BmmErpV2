<table class="table table-bordered table-hover" style="margin-bottom: 0px;">
    <tr>
        <td style="width: 12%;">Date Pièce : </td>
        <td style="width: 20%;">
            <select id="filtre_piece" class="form-control">
                <option value="=">Egale à ( = )</option>
                <option value="<>">Comprise entre ( <= , >= )</option>
                <option value=">">Supérieure à ( > )</option>
                <option value="<">Inférieure à ( < )</option>
                <option value=">=">Supérieure ou égale à ( >= )</option>
                <option value="<=">Inférieure ou égale à ( <= )</option>
            </select>
        </td>
        <td style="width: 58%;">
            <div id="champ_piece_defaut" style="width: 100%;">
                <input type="date" id="date" />
            </div>

            <div id="champ_piece_compris" style="display:none;width: 100%;">
                <table style="margin-bottom: 0px;" cellspace="5">
                    <tr>
                        <td style="vertical-align: middle; font-weight: bold; text-align:right; width: 45%;">Du :
                            <input type="date" id="date_debut" />
                        </td>
                        <td style="width: 10%;"></td>
                        <td style="vertical-align: middle; font-weight: bold; width: 45%;"> Au :
                            <input type="date" id="date_fin" />
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
            $('#date').val('');
        } else {
            $('#champ_piece_compris').css('display', 'none');
            $('#champ_piece_defaut').css('display', '');
            $('#date_debut').val('');
            $('#date_fin').val('');
        }
    });

    function rechercher() {
        if ($('#date').val() != '' || $('#date_debut').val() != '' || $('#date_fin').val() != '') {
            $('#date').css('border', '');
            $('#date_debut').css('border', '');
            $('#date_fin').css('border', '');
            $.ajax({
                url: '<?php echo url_for('multicriteres/rechercheDatePiece') ?>',
                data: 'filtre=' + $('#filtre_all').val() + '&operation=' + $('#filtre_piece').val() + '&date=' + $('#date').val() +
                        '&date_debut=' + $('#date_debut').val() + '&date_fin=' + $('#date_fin').val(),
                success: function (data) {
                    $('#liste_recherche').html(data);
                }
            });
        } else {
            $('#date').css('border', '3px solid red');
            $('#date_debut').css('border', '3px solid red');
            $('#date_fin').css('border', '3px solid red');
            $('#liste_recherche').html('');
        }
    }

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('multicriteres/rechercheDatePiece'); ?>',
            data: 'filtre=' + $('#filtre_all').val() + '&page=' + page +
                    '&operation=' + $('#filtre_piece').val() + '&date=' + $('#date').val() +
                    '&date_debut=' + $('#date_debut').val() + '&date_fin=' + $('#date_fin').val(),
            success: function (data) {
                $('#liste_recherche').html(data);
            }
        });
    }
    
</script>