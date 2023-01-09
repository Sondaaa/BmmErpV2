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

    function listeComptes() {
        $('#image_loading').css('display', 'block');
        $('#s_dossier').fadeOut(500);
        $('#dossier_id').val($('#dossier').val());
        $.ajax({
            url: '<?php echo url_for('@listeCompteForDossierSelect') ?>',
            data: 'dossier=' + $('#dossier').val(),
            success: function(data) {
                $("#liste_compte").html(data);
                $('#image_loading').css('display', 'none');
            }
        });

    }

    function saveDossierForCompte() {
        if ($('#dossier_id').val() != '-1' && $('#compte').val() != '-1') {
            $('#image_loading').css('display', 'block');
            $.ajax({
                url: '<?php echo url_for('@saveDossierForCompte') ?>',
                data: 'dossier=' + $('#dossier_id').val() + '&compte=' + $('#compte').val(),
                success: function(data) {
                    $('#compte').select2('data', null);
                    $('#dossier').select2('data', null);
                    dossierForCompte();
                    $('#image_loading').css('display', 'none');
                }
            });
        }
    }

</script>