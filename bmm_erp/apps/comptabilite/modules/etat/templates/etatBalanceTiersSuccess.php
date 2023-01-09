<div id="sf_admin_container">
    <h1 id="replacediv"> Etat
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Etat des Balances Tiers - Exercice <?php echo $_SESSION['exercice']; ?>
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
                                <th style="text-align:left; padding-left: 1%; width: 30%; font-weight: bold;">Balance</th>
                                <th style="text-align:left; padding-left: 1%; width: 20%; font-weight: bold;"></th>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                <b>De</b> <select id="compte_min">
                                    <?php foreach ($comptes as $compte): ?>
                                        <option value="<?php echo $compte->getId() ?>"><?php echo trim($compte->getNumerocompte()) . ' - ' . trim($compte->getLibelle()) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" id="comptes_non_solde"/> Comptes Soldés
                                <br>
                                <b>Balance du</b> <input type="date" id="date_debut"/> 
                                <b>au</b> <input type="date" id="date_fin"/> 
                            </td>
                            <td style="text-align: center;">
                                <button onclick="afficher()" class="btn btn-sm btn-primary">
                                    <i class="ace-icon fa fa-search bigger-110"></i>
                                    <span class="bigger-110 no-text-shadow">Afficher</span>
                                </button>
                            </td>
                        </tr> 

                    </table>
                </div>
                <div id="liste_etat_balance" style="margin-top: 20px;">

                </div>
            </div>
        </form>
    </div>
</div>

<script  type="text/javascript">

    function afficher() {
        $.ajax({
            url: '<?php echo url_for('etat/afficherEtatBalanceTiers') ?>',
            data: 'compte_min=' + $('#compte_min').val() +
                    '&date_debut=' + $('#date_debut').val() + '&date_fin=' + $('#date_fin').val() +
                    '&comptes_non_solde=' + $('#comptes_non_solde').is(':checked'),
            success: function (data) {
                $('#liste_etat_balance').html(data);
            }
        });
    }

</script>