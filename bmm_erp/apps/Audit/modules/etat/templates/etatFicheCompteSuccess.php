<div id="sf_admin_container">
    <h1 id="replacediv"> Etat
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Etat Fiche de compte
        </small>
    </h1>
</div>

<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding" style="min-height: 400px">
        <form>
            <div class="mws-form-inline">
                <div>
                    <table style="width: 100%">
                        <thead>
                            <tr>
                                <th style="text-align:left; padding-left: 1%; width: 20%; font-weight: bold;">Affichage</th>
                                <th style="text-align:left; padding-left: 1%; width: 50%; font-weight: bold;">Intervalle des Comptes Comptables</th>
                                <th style="text-align:left; padding-left: 1%; width: 20%; font-weight: bold;">Période</th>
                                <th style="text-align:left; padding-left: 1%; width: 10%; font-weight: bold;"></th>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                <input type="checkbox" id="crediteur" /> Créditeur
                                <br><br>
                                <input type="checkbox" id="debiteur"/> Débiteur
                                <br><br>
                                <!--<input type="checkbox" id="solde" /> Soldé-->
                            </td>
                            <td>
                                Du <select id="compte_min">
                                    <?php foreach ($comptes as $compte): ?>
                                        <option value="<?php echo trim($compte->getNumerocompte()) ?>"><?php echo trim($compte->getNumerocompte()) . ' - ' . $compte->getLibelle(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br>
                                Au <select id="compte_max">
                                    <?php foreach ($comptes as $compte): ?>
                                        <option value="<?php echo trim($compte->getNumerocompte()) ?>" selected="selected"><?php echo trim($compte->getNumerocompte()) . ' - ' . $compte->getLibelle(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                Du<br>
                                <input type="date" id="date_debut"/>
                                <br>
                                Au<br>
                                <input type="date" id="date_fin"/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <button style="margin-bottom: 10px;" onclick="afficher()" class="btn btn-sm btn-primary">
                                    <i class="ace-icon fa fa-search bigger-110"></i>
                                    <span class="bigger-110 no-text-shadow">Afficher (Tout)</span>
                                </button>
                                <button onclick="afficherNonVide()" class="btn btn-sm btn-purple">
                                    <i class="ace-icon fa fa-search bigger-110"></i>
                                    <span class="bigger-110 no-text-shadow">Afficher (Sauf Vide)</span>
                                </button>
                            </td>
                        </tr> 
                    </table>
                </div>
                  
              <div><span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> Traitement en cours .........................</span></div>
             
                <div class="mws-panel grid_8" id="liste_etat_fiche_compte" style="margin-top: 20px;">

                </div>
            </div>
        </form>
    </div>
</div>

<script  type="text/javascript">

    $('#compte_min').change(function() {
        var compte_min = $(this).val();
         $('#compte_max').val(compte_min).trigger('chosen:updated');
    });

    function afficher() {
         $('#loading_save_icon').fadeIn();
        $.ajax({
            url: '<?php echo url_for('etat/afficherEtatFicheCompte') ?>',
            data: 'compte_min=' + $('#compte_min').val()+'&compte_max=' + $('#compte_max').val()+
                  '&date_debut=' + $('#date_debut').val()+'&date_fin=' + $('#date_fin').val()+
                  '&crediteur=' + $('#crediteur').is(':checked')+'&debiteur=' + $('#debiteur').is(':checked')+
                  '&solde=' + $('#solde').is(':checked'),
            success: function(data) {
                 $('#loading_save_icon').fadeOut();
                $('#liste_etat_fiche_compte').html(data);
            }
        });
    }
    
    function afficherNonVide() {
    $('#loading_save_icon').fadeIn();
        $.ajax({
            url: '<?php echo url_for('etat/afficherEtatFicheCompteNonVide') ?>',
            data: 'compte_min=' + $('#compte_min').val()+'&compte_max=' + $('#compte_max').val()+
                  '&date_debut=' + $('#date_debut').val()+'&date_fin=' + $('#date_fin').val()+
                  '&crediteur=' + $('#crediteur').is(':checked')+'&debiteur=' + $('#debiteur').is(':checked')+
                  '&solde=' + $('#solde').is(':checked'),
            success: function(data) {
                $('#loading_save_icon').fadeOut();
                $('#liste_etat_fiche_compte').html(data);
            }
        });
    }
</script>
