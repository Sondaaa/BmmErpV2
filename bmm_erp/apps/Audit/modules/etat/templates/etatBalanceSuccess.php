<div id="sf_admin_container">
    <h1 id="replacediv"> Etat
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Etat des Balances générales (simples) - Exercice <?php echo $_SESSION['exercice']; ?>
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
                            <tr style="font-size: 14px;">
                                <th style="text-align:left; padding-left: 1%; width: 50%; font-weight: bold;">Intervalle de comptes</th>
                                <!--<th style="text-align:left; padding-left: 1%; width: 20%; font-weight: bold;">Sous totaux à</th>-->
                                <th style="text-align:left; padding-left: 1%; width: 20%; font-weight: bold;">Balance</th>
                                <th style="text-align:left; padding-left: 1%; width: 10%; font-weight: bold;"></th>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                <b>De</b>
                                <select id="compte_min">
                                    <?php foreach ($comptes as $compte): ?>
                                        <option id="compte_<?php echo $compte->getNumeroCompte() ?>" value="<?php echo $compte->getNumeroCompte() ?>"> <?php echo trim($compte->getNumeroCompte()) . ' - ' . trim($compte->getLibelle()) ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <b>A</b>
                                <select id="compte_max">
                                    <?php foreach ($comptes as $compte): ?>
                                        <option  value="<?php echo $compte->getNumeroCompte() ?>" selected="selected"> <?php echo trim($compte->getNumeroCompte()) . ' - ' . trim($compte->getLibelle()) ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td style="display: none">
                                <div>
                                    <div style="float:left; margin-right:3%; width: 45%;">
                                        <input disabled type="checkbox" checked="checked" class="chiffre" name="chiffre" id="chiffre_1" /> 1 Chifffre
                                        <br>
                                        <input type="checkbox" class="chiffre" name="chiffre" id="chiffre_2"/> 2 Chifffres
                                        <br>
                                        <input type="checkbox" class="chiffre" name="chiffre" id="chiffre_3"/> 3 Chifffres
                                        <br>
                                        <input type="checkbox" class="chiffre" name="chiffre" id="chiffre_4" /> 4 Chifffres
                                    </div>
                                    <div style="float:left;">
                                        <input type="checkbox" class="chiffre" name="chiffre" id="chiffre_5"/> 5 Chifffres
                                        <br>
                                        <input type="checkbox" class="chiffre" name="chiffre" id="chiffre_6"/> 6 Chifffres
                                        <br>
                                        <input type="checkbox" class="chiffre" name="chiffre" id="chiffre_7"/> 7 Chifffres

                                    </div>
                                </div>    
                            </td>
                            <td>
                                <input type="checkbox" id="comptes_non_solde"/> Comptes soldés
                                <br>
                                <b>Du</b><br>
                                <input type="date" id="date_debut" />
                                <br>
                                <b>Au</b><br>
                                <input type="date" id="date_fin"/>
                            </td>
                            <td style="text-align: center;">
                                <button onclick="afficher()" class="btn btn-sm btn-primary">
                                    <i class="ace-icon fa fa-search bigger-110"></i>

                                    <span class="bigger-110 no-text-shadow">Afficher</span>
                                </button>
                            </td>
                        </tr> 

                    </table>
                    <div class="col-xs-12 col-sm-12">
                        <span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> affichage en cours  ...</span>
                    </div>
                    <div id="liste_etat_balance" style="margin-top: 20px;">

                    </div>
                </div>
        </form>
    </div>
</div>

<script  type="text/javascript">

    $('#compte_min').change(function () {
        var compte_min = $(this).val();
        var compte_min_lib = $('#compte_' + compte_min).text();
        $("#compte_max").select2("data", {id: compte_min, text: compte_min_lib});
    });


    function afficher() {
        $('#loading_save_icon').fadeIn();
        $.ajax({
            url: '<?php echo url_for('etat/afficherEtatBalance') ?>',
            data: 'compte_min=' + $('#compte_min').val() + '&compte_max=' + $('#compte_max').val() +
                    '&date_debut=' + $('#date_debut').val() + '&date_fin=' + $('#date_fin').val() +
                    '&comptes_non_solde=' + $('#comptes_non_solde').is(':checked') +
                    '&chiffre_1=' + $('#chiffre_1').is(':checked') + '&chiffre_2=' + $('#chiffre_2').is(':checked') +
                    '&chiffre_3=' + $('#chiffre_3').is(':checked') + '&chiffre_4=' + $('#chiffre_4').is(':checked') +
                    '&chiffre_5=' + $('#chiffre_5').is(':checked') + '&chiffre_6=' + $('#chiffre_6').is(':checked') +
                    '&chiffre_7=' + $('#chiffre_7').is(':checked')
            ,
            success: function (data) {
                $('#liste_etat_balance').html(data);
                $('#loading_save_icon').fadeOut();
            }
        });
    }

</script>

<style>

    .chiffre { margin: 10px 0 0 !important; }

</style>