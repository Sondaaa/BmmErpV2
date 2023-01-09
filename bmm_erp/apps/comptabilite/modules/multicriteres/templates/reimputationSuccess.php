<div id="sf_admin_container">
    <h1 id="replacediv"> Traitement
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Réimputation des Pièces comptables
        </small>
    </h1>
</div>
<input type="hidden" id="array_id">
<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding" style="min-height: 400px">
        <form>
            <div class="mws-form-inline">
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th style="text-align:left; padding-left: 1%; width: 30%; font-weight: bold;">Compte Comptable</th>
                                <th style="text-align:left; padding-left: 1%; width: 30%; font-weight: bold;">Journal Comptable</th>
                                <th style="text-align:left; padding-left: 1%; width: 30%; font-weight: bold;">Intervalle de Date Pièce Comptable</th>
                                <th style="text-align:left; padding-left: 1%; width: 10%; font-weight: bold;"></th> 
                            </tr>
                        </thead>
                        <tr>  <?php $compte = PlandossiercomptableTable::getInstance()->getByDossierAndExercice($_SESSION['exercice_id'], $_SESSION['dossier_id']); ?>

                            <td style="text-align: left;">
                                <select id="id_compte_comptable" class="chosen-select form-control">
                                    <option value=""></option>
                                    <?php foreach ($compte as $cc): ?>
                                        <option value="<?php echo $cc->getId(); ?>"><?php echo $cc->getNumerocompte() . ' - ' . $cc->getLibelle(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
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

        $('#array_id').val('');
        if ($('#id_compte_comptable').val() != '') {
            $('#loading_save_icon').fadeIn();
            $.ajax({
                url: '<?php echo url_for('multicriteres/afficherEtatJournalSeul') ?>',
                data: 'date_debut=' + $('#date_debut').val() +
                        '&date_fin=' + $('#date_fin').val() +
                        '&journal_id=' + $('#journal').val() +
                        '&compte_id=' + $('#id_compte_comptable').val(),
                success: function (data) {
                    $('#liste_etat_journal').html(data);
                    $('#loading_save_icon').fadeOut();
                }
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir un comptable comptable !",
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
    function AddIDPiece(id) {
        lettre = '';
        identifient = '';
        if ($('#ligne_' + id).attr('style') && $('#check_' + id).is(':checked') == true) {
            $('#ligne_' + id).removeAttr('style');
            $('#check_' + id).prop("checked", true);
            $('#check_' + id).removeClass("disabledbutton");
            console.log($('#check_' + id).is(':checked'));
        } else if ($('#check_' + id).is(':checked') == false) {
            $('#ligne_' + id).attr('style', 'background-color:  #e5e7e9 ;');
            $('#check_' + id).prop("checked", false);
            $('#check_' + id).removeClass("disabledbutton");


        }
//        $('.list_checbox_facture[type=checkbox]:checked').each(function () {
//            var sThisVal = (this.checked ? "1" : "0");
//            if (sThisVal == '1') {
//                identifient = $(this).attr('idientifiant');
//                if (lettre == '')
//                    lettre = $(this).attr('idientifiant');
//                else
//                    lettre += ',' + $(this).attr('idientifiant');
//                console.log(identifient + '=' + lettre);
//
//            }
//
//
//        });
        $('input[type=checkbox]').each(function () {
            var sThisVal = (this.checked ? "1" : "0");
            if (sThisVal == '1') {
                identifient = $(this).attr('idientifiant');
//                if (identifient != 'undefined') {
                if (lettre == '')
                    lettre = $(this).attr('idientifiant');
                else
                    lettre += ',' + $(this).attr('idientifiant');
//                    console.log(identifient + '=' + lettre);
//                }
            }
        });
        $('#array_id').val(lettre);
    }

    function reimputer() {
//        alert('44');
        if (($('#id_compte_select').val() == '')) {
            bootbox.dialog({
                message: "Veuillez choisir Le Nouveau compte  !",
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
        if ($('#array_id').val() == '') {
            bootbox.dialog({
                message: "Veuillez choisir des lignes à réimpitées !",
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

        $.ajax({
            url: '<?php echo url_for('multicriteres/reimpiter') ?>',
            data: 'arrayid=' + $('#array_id').val() +
                    '&id_compte=' + $('#id_compte_select').val()
            ,
            success: function (data) {

                bootbox.dialog({
                    message: "Les lignes choisis  sont  modifiées avec succées !!!!",
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm",
                                        }
                            }
                });
                document.location.reload();

            }
        });

    }


</script>