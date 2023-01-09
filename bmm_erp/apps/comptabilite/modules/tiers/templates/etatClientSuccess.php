<div id="sf_admin_container">
    <h1 id="replacediv"> Tiers
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Extrait Auxiliaire Client
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

                                <th style="text-align:left; padding-left: 1%; width: 40%; font-weight: bold;"></th>
                                <th style="text-align:left; padding-left: 1%; width: 10%; font-weight: bold;">Ordre</th>
                                <th style="text-align:left; padding-left: 1%; width: 20%; font-weight: bold;">Période</th>
                                <!--<th style="text-align:left; padding-left: 1%; width: 15%; font-weight: bold;">Affichage</th>-->
                                <th style="text-align:left; padding-left: 1%; width: 15%; font-weight: bold;">Solde</th>
                                <th style="text-align:left; padding-left: 1%; width: 15%; font-weight: bold;"></th>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                Client
                                <select id="id_client">
                                    <option value=''></option>
                                    <?php foreach ($client as $frs): ?>
                                        <option id="frs_<?php echo $frs->getId(); ?>" value="<?php echo $frs->getId() ?>"> <?php echo $frs->getCodeclt() . ' - ' . $frs->getRs(); ?> </option>
                                    <?php endforeach; ?>
                                </select>

                                <br>

                                Journal Comptable <select id="journal">
                                    <option value=''></option>
                                    <?php foreach ($journals as $journal): ?>
                                        <option value="<?php echo $journal->getId() ?>"><?php echo $journal->getCode() . ' - ' . $journal->getLibelle() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <br>
                                <input type="radio" checked="checked" name="ordre" value="date" /> Date
                                <br><br><br>
<!--                                <input type="radio" name="ordre" value="lettre"/> Lettre-->
                            </td>
                            <td>
                                Du<br>
                                <input type="date" id="date_debut" /> 
                                <br>
                                Au<br>
                                <input type="date" id="date_fin" /> 
                            </td>

                            <td>
                                <br>
                                <input type="checkbox" id="debit_filtrage" /> Débit
                                <br><br><br>
                                <input type="checkbox" id="credit_filtrage"/> Crédit


                            </td>

                            <td style="text-align: center; vertical-align: middle;">
                                <button style="cursor:pointer;" onclick="afficher()" class="btn btn-sm btn-primary">
                                    <i class="ace-icon fa fa-search bigger-110"></i>
                                    <span class="bigger-110 no-text-shadow">Afficher</span>
                                </button>


                            </td>

                        </tr>
                    </table>
                </div>
                <div><span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> Traitement en cours .........................</span></div>
                <div class="mws-panel grid_8" id="liste_etat_fournissuer_compte" style="margin-top: 15px;">

                </div>
            </div>
        </form>
    </div>
</div>
<input type="hidden" id="array_lettre">
<script  type="text/javascript">

    function afficher() {
        $('#loading_save_icon').fadeIn();
        if ($('#id_client').val() == '') {
            bootbox.dialog({
                message: "Veuillez choisir un Client  !",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm",
                                    }
                        }
            });
        } else {
            var order = '';
            $('input[name=ordre]').each(function () {
                if ($(this).is(':checked'))
                    order = $(this).val();
            });
            $.ajax({
                url: '<?php echo url_for('tiers/afficherEtatExtraitCompteClient') ?>',
                data: 'id_client=' + $('#id_client').val() + '&journal=' + $('#journal').val() +
                        '&date_debut=' + $('#date_debut').val() + '&date_fin=' + $('#date_fin').val() +
                        '&order=' + order
                        + '&debit=' + +$('#debit_filtrage').is(':checked') +
                        '&credit=' + $('#credit_filtrage').is(':checked') +
                        '&tout=' + $('#tout').is(':checked'),
                success: function (data) {
                    $('#liste_etat_fournissuer_compte').html(data);
                    $('#loading_save_icon').fadeOut();
//                    lettrer();
//                    $('#array_lettre').val('');
                }
            });
        }
    }
    function lettrer2() {

        if ($('#array_lettre').val() == '') {
            bootbox.dialog({
                message: "Veuillez choisir des lignes equilibrés !",
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
            url: '<?php echo url_for('etat/LettrageLigne') ?>',
            data: 'arrayid=' + $('#array_lettre').val()
                    + '&lettre=' + $('#next_lettre').val(),
            success: function (data) {

//                $('#liste_etat_extrait_compte').html(data);
//                $('#next_lettre').val(data);

                if (data != 0)
                    bootbox.dialog({
                        message: "Les lignes choisis ne sont pas  equilibrés !!!!",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm",
                                            }
                                }
                    });

                afficher();
            }
        });

    }

//lettrer 
    function lettrer() {

        $.ajax({
            url: '<?php echo url_for('etat/lettreEnCour') ?>',
            data: '',
            success: function (data) {
//                $('#liste_etat_extrait_compte').html(data);
                $('#next_lettre').val(data);
            }
        });

    }

    function AddIDPiece(id) {

        lettre = '';
        mnt_debit = 0;
        mnt_credit = 0;
        mnt_solde = 0;
        identifient = '';
        if ($('#ligne_' + id).attr('style') && $('#check_' + id).is(':checked') == true) {
            $('#ligne_' + id).removeAttr('style');
            $('#check_' + id).prop("checked", false);
        } else {
            $('#ligne_' + id).attr('style', 'background-color:  #e5e7e9 ;');
            $('#check_' + id).prop("checked", true);

        }
//        console.log('style=' + ($('#ligne_' + id).attr('style') + 'checked=' + $('#check_' + id).is(':checked')));
        if ($('#check_' + id).is(':checked')) {
            $('#ligne_' + id).attr('style', 'background-color:  #e5e7e9 ;');
        } else {
            $('#ligne_' + id).removeAttr('style');
        }
//        console.log('mnt_debit=' + mnt_debit + 'mnt_credit=' + mnt_credit + 'solde=' + mnt_solde);

        $('input[type=checkbox]').each(function () {
            var sThisVal = (this.checked ? "1" : "0");
            if (sThisVal == '1') {
                identifient = $(this).attr('idientifiant');
                if (lettre == '')
                    lettre = $(this).attr('idientifiant');
                else
                    lettre += ',' + $(this).attr('idientifiant');
                console.log(identifient + '=' + lettre);
                if ($('#check_' + identifient).attr('mnt_debit') && $('#check_' + identifient).attr('mnt_debit') != '')
                    mnt_debit = mnt_debit + Number($('#check_' + identifient).attr('mnt_debit'));
                if ($('#check_' + identifient).attr('mnt_credit') && $('#check_' + identifient).attr('mnt_credit') != '')
                    mnt_credit = mnt_credit + Number($('#check_' + identifient).attr('mnt_credit'));
                console.log('mnt_debit=' + mnt_debit + '-' + 'mnt_credit=' + mnt_credit);

            }

        });
        mnt_solde += Number(mnt_debit - mnt_credit);

        $('#debit').html(parseFloat(mnt_debit).toFixed(3));
        $('#credit').html(parseFloat(mnt_credit).toFixed(3));
        $('#solde').html(parseFloat(mnt_solde).toFixed(3));

        $('#solde_lignes').val(parseFloat(mnt_solde).toFixed(3));
        $('#array_lettre').val(lettre);
//        console.log(lettre);


    }
    function Anulerlettrer() {
        $.ajax({
            url: '<?php echo url_for('etat/annulerlettrage') ?>',
            data: 'lettre=' + $('#next_lettre').val(),
            success: function (data) {
//                $('#liste_etat_extrait_compte').html(data);
//                $('#next_lettre').val(data);
                afficher();
            }
        });
    }

</script>