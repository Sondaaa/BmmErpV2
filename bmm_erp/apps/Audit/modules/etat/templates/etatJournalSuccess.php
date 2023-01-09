<div id="sf_admin_container">
    <h1 id="replacediv"> Etat
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Etat des Journaux Comptables
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
                                <th style="text-align:left; padding-left: 1%; width: 50%; font-weight: bold;">Sélection</th>
                                <th style="text-align:left; padding-left: 1%; width: 35%; font-weight: bold;">Intervalle de Date Pièce Comptable</th>
                                <th style="text-align:left; padding-left: 1%; width: 15%; font-weight: bold;"></th> 
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                <input type="radio" checked="checked" name="selection" value="intervalle"/>Intervalle de journaux (Date de Clôture) : du <input type="date" id="date_debut_journal"/> Au <input type="date" id="date_fin_journal"/>
                                <br>
                                <input type="radio" name="selection" value="ouverture"/>Journal d'ouverture
                            </td>
                            <td>
                                du <input type="date" id="date_debut"/> Au <input type="date" id="date_fin"/>
                            </td>
                            <td style="text-align: center;">
                                <button style="cursor:pointer;" onclick="afficher()" class="btn btn-sm btn-primary">
                                    <i class="ace-icon fa fa-search bigger-110"></i>
                                    <span class="bigger-110 no-text-shadow">Afficher</span>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                     <div><span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> Traitement en cours .........................</span></div>
             
                <div class="mws-panel grid_8" id="liste_etat_journal">

                </div>
            </div>
        </form>
    </div>
</div>

<script  type="text/javascript">

    $('input[name=selection]').change(function () {
        if ($(this).val() == 'ouverture') {
            $('#date_debut_journal').val('');
            $('#date_fin_journal').val('');
        }
    });

    function afficher() {
         $('#loading_save_icon').fadeIn();
        $.ajax({
            url: '<?php echo url_for('etat/afficherEtatJournal') ?>',
            data: 'date_debut=' + $('#date_debut').val() +
                    '&date_fin=' + $('#date_fin').val() +
                    '&date_debut_journal=' + $('#date_debut_journal').val() +
                    '&date_fin_journal=' + $('#date_fin_journal').val(),
            success: function (data) {
                 $('#loading_save_icon').fadeOut();
                $('#liste_etat_journal').html(data);
            }
        });
    }

</script>

<style type="text/css">
    .header_table th{
        font-weight: bold;
        font-size: 13px;
    }
    .tab_filter tbody td { 
        border-right-color: #ffffff !important;
        border-right-style: solid;
        border-right-width: 2px;
        padding: 5px ;
    }
</style>