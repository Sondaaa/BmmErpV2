<div id="sf_admin_container">
    <h1 id="replacediv"> Etat
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Etat des journaux Comptables
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
                                <th style="text-align:left; padding-left: 1%; width: 50%; font-weight: bold;">Journal Comptable</th>
                                <th style="text-align:left; padding-left: 1%; width: 30%; font-weight: bold;">Intervalle de Date Pièce Comptable</th>
                                <th style="text-align:left; padding-left: 1%; width: 20%; font-weight: bold;"></th> 
                            </tr>
                        </thead>
                        <tr>
                            <td style="text-align: left;">
                                <select id="journal" class="chosen-select form-control">
                                    <option value=''></option>
                                    <?php foreach ($journals as $journal): ?>
                                        <option  value="<?php echo $journal->getId() ?>"> <?php echo $journal->getCode() . ' - ' . $journal->getLibelle() ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <b>du</b> <input type="date" id="date_debut"/> <b>Au</b> <input type="date" id="date_fin"/>
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

    function afficher() {
         $('#loading_save_icon').fadeIn();
        if ($('#journal').val() != '') {
            $.ajax({
                url: '<?php echo url_for('etat/afficherEtatJournalSeul') ?>',
                data: 'date_debut=' + $('#date_debut').val() +
                        '&date_fin=' + $('#date_fin').val() +
                        '&journal_id=' + $('#journal').val(),
                success: function (data) {
                    $('#liste_etat_journal').html(data);
                     $('#loading_save_icon').fadeOut();
                }
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir un journal comptable !",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm",
                                    }
                        }
            });
        }
    }

</script>