<table style="width: 80%; margin: 20px;">
    <tr>
        <td style="text-align: center; width:70% ">
            <div class="mws-form-row">
                <label>Dossier:</label>
                <div class="mws-form-item small">
                    <select id="dossier" class="mws-select2 large" style="width: 85%">
                        <option value="-1"></option>
                        <?php foreach ($dossiers as $dossier): ?>
                            <?php if ($dossier->getPlanComptable()->count() != 0): ?>
                                <option value="<?php echo $dossier->getId(); ?>"><?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonSociale(); ?></option>
                            <?php endif; ?>
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
        $('#dossier_destin').select2({placeholder: 'Sélectionner un dossier'});
        $('#dossier').select2({placeholder: 'Sélectionner un dossier'});

    });
   var dossier_courant;
    function listeComptes() {
        $('#image_loading').css('display', 'block');
        $('#s_dossier').fadeOut(500);
        dossier_courant = $('#dossier').val();
        $.ajax({
            url: '<?php echo url_for('@listeDossierForDossier') ?>',
            data: 'dossier=' + dossier_courant,
            success: function(data) {
                $("#liste_compte").html(data);
                $('#image_loading').css('display', 'none');
            }
        });

    }
    
    function initListeCompte() {
    $('#search_numero').val('');
    $('#search_libelle').val('');
    $('#image_loading').css('display', 'block');
        $('#s_dossier').fadeOut(500);
        $.ajax({
            url: '<?php echo url_for('@listeDossierForDossier') ?>',
            data: 'dossier=' + dossier_courant,
            success: function(data) {
                $("#liste_compte").html(data);
                $('#image_loading').css('display', 'none');
            }
        });

    }

    function saveDossierForDossier() {
        if ($('#dossier_id').val() != '-1' && $('#dossier_destin').val() != '-1') {
            var comptes = '';

            $('.list_checbox_compte[type=checkbox]:checked').each(function() {
                comptes += $(this).val() + ',';
            });
            $('#image_loading').css('display', 'block');
            $.ajax({
                url: '<?php echo url_for('@saveDossierForDossier') ?>',
                data: 'dossier=' + $('#dossier_id').val() + '&dossier_destin=' + $('#dossier_destin').val() + '&comptes=' + comptes,
                success: function(data) {
                    $('#dossier_destin').select2('data', null);
                    $('#dossier').select2('data', null);
                    dossierForDossier();
                    $('#image_loading').css('display', 'none');
                }
            });
        }
    }


</script>