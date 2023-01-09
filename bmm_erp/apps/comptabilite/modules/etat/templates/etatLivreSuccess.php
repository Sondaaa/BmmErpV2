<div id="sf_admin_container">
    <h1 id="replacediv"> Etat
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Etat Grand Livre - Exercice <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding" style="min-height: 400px">
        <form>
            <div class="mws-form-inline">
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th style="text-align:left; padding-left: 1%; width: 20%; font-weight: bold;">Ordre d'affichage</th>
                                <th style="text-align:left; padding-left: 1%; width: 10%; font-weight: bold;"></th>
                                <th style="text-align:left; padding-left: 1%; width: 40%; font-weight: bold;">Intervalle de comptes</th>
                                <th style="text-align:left; padding-left: 1%; width: 20%; font-weight: bold;">Période</th>
                                <th style="text-align:left; padding-left: 1%; width: 10%; font-weight: bold;"></th>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                <input type="radio" name="ordre" checked="checked" value="chronologique" /> Chronologique
                                <br><br>
<!--                                <input type="radio" name="ordre" value="lettrage"/> Lettrage
                                <br><br>-->
                            </td>
                            <td><input type="checkbox" id="toutlivre" checked="checked"/> Tout</td>
                            <td>
                                Du <select id="compte_min">
                                    <?php foreach ($comptes as $compte): ?>
                                        <option value="<?php echo trim($compte->getNumeroCompte()) ?>"><?php echo trim($compte->getNumeroCompte()) . ' - ' . trim($compte->getLibelle()) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br>
                                Au <select id="compte_max">
                                    <?php foreach ($comptes as $compte): ?>
                                        <option value="<?php echo trim($compte->getNumeroCompte()) ?>" selected="selected"><?php echo trim($compte->getNumeroCompte()) . ' - ' . trim($compte->getLibelle()) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                Du<br>
                                <input type="date" id="date_debut" /> 
                                <br>
                                Au<br>
                                <input type="date" id="date_fin" /> 
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <button onclick="afficher()" class="btn btn-sm btn-primary">
                                    <i class="ace-icon fa fa-search bigger-110"></i>
                                    <span class="bigger-110 no-text-shadow">Afficher</span>
                                </button>
                            </td>
                        </tr> 
                    </table>
                </div>
                <div><span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> Traitement en cours .........................</span></div>

                <div class="mws-panel grid_8" id="liste_etat_livre" style="margin-top: 20px;">

                </div>
            </div>
        </form>
    </div>
</div>

<script  type="text/javascript">

    $('#compte_min').change(function () {
        var compte_min = $(this).val();
        $('#compte_max').val(compte_min).trigger('chosen:updated');
    });

    function afficher() {
        $('#loading_save_icon').fadeIn();
        var order = '';
        $('input[name=ordre]').each(function () {
            if ($(this).is(':checked'))
                order = $(this).val();
        });
        $.ajax({
            url: '<?php echo url_for('etat/afficherEtatLivre') ?>',
            data: 'compte_min=' + $('#compte_min').val() + '&compte_max=' + $('#compte_max').val() +
                    '&date_debut=' + $('#date_debut').val() + '&date_fin=' + $('#date_fin').val() +
                    '&toutlivre=' + $('#toutlivre').is(':checked') + '&order=' + order,
            success: function (data) {
                $('#loading_save_icon').fadeOut();
                $('#liste_etat_livre').html(data);
            }
        });
    }
  
</script>