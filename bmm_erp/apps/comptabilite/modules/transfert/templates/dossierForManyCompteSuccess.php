<table style="width: 80%; margin: 20px;">
    <tr>
        <td style="text-align: center; width:70% ">
            <div class="mws-form-row">
                <label>Dossier:</label>
                <div class="mws-form-item small">

                    <select id="dossier" class="mws-select2 large" style="width: 85%">
                        <option value="-1"></option>
                        <?php foreach ($dossiers as $dossier): ?>
                            <option value="<?php echo $dossier->getId(); ?>"><?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonSociale(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="s_dossier" style="  display: none; color: #d11010; margin-left: 10%;  ">
                    <p><b> choisir un dossier  !!</b></p>
                </div>
            </div>

        </td>

    </tr>

</table>
<script  type="text/javascript">

    $(document).ready(function() {
        $('#compte').select2({placeholder: 'Sélectionner un compte'});
        $('#dossier').select2({placeholder: 'Sélectionner un dossier'});
    });
var dossier_courant;
    function listeComptes() {
        $('#image_loading').css('display', 'block');
        $('#s_dossier').fadeOut(500);
        dossier_courant = $('#dossier').val();
        $('#dossier_id').val(dossier_courant);
        $.ajax({
            url: '<?php echo url_for('@listeCompteForDossier') ?>',
            data: 'dossier=' + dossier_courant,
            success: function(data) {
                $("#liste_compte").html(data);
                $('#button_affect').css('display', 'none');
                $('#image_loading').css('display', 'none');
            }
        });

    }
    function initListeCompte() {
    $('#search_numero').val('');
    $('#search_libelle').val('');
    $('#s_dossier').fadeOut(500);
        $('#dossier_id').val(dossier_courant);
        $.ajax({
            url: '<?php echo url_for('@listeCompteForDossier') ?>',
            data: 'dossier=' + dossier_courant,
            success: function(data) {
                $("#liste_compte").html(data);
                $('#button_affect').css('display', 'none');
                $('#image_loading').css('display', 'none');
            }
        });

    }
    function saveDossierForManyCompte() {
        $('#s_dossier').fadeOut(500);
        if ($('#dossier_id').val() != '-1') {

            var comptes = '';

            $('.list_checbox_compte[type=checkbox]:checked').each(function() {
                comptes += $(this).val() + ',';
            });
            $('#image_loading').css('display', 'block');
            $.ajax({
                async: true,
                url: '<?php echo url_for('@saveDossierForManyCompte') ?>',
                data: 'dossier=' + $('#dossier_id').val() + '&comptes=' + comptes,
                success: function(data) {
                    dossierForManyCompte();
                    $('#image_loading').css('display', 'none');
                }
            });
        } else
            $('#s_dossier').fadeIn(1000);
        $('#image_loading').css('display', 'none');
    }

    function searchByNumeroAndLibelle() {
        var libelle = '';
        var numero = '';
        var motiflib = $('#search_libelle').val();
        var motifnum = $('#search_numero').val();
        motiflib = motiflib.toUpperCase();
        $('#myTable01 tbody tr').each(function() {
            libelle = $(this).attr('data_libelle');
            numero = $(this).attr('data_number');
            var indexlib = libelle.indexOf(motiflib);
            var indexnum = numero.indexOf(motifnum);
            if (indexlib >= 0 && indexnum >= 0) {
                $(this).css('display', '');
            }
            else {
                $(this).css('display', 'none');
            }
        });

    }

    function searchByNumero() {
        var numero = '';
        var motif = $('#search_numero').val();
        $('#myTable01 tbody tr').each(function() {
            numero = $(this).attr('data_number');
            var index = numero.indexOf(motif);
            if (index >= 0) {
                $(this).css('display', '');
            }
            else {
                $(this).css('display', 'none');
            }
        });
    }


</script>