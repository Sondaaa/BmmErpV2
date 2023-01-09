<div id="sf_admin_container">
    <h1 id="replacediv"> Importation 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Importer Vente : <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div class="widget-box">
    <div class="widget-header widget-header-blue widget-header-flat">
        <h4 class="widget-title lighter">Importation des Factures Ventes</h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div id="import-fuelux-wizard-container">
                <div>
                    <ul class="steps">
                        <li data-step="1" class="active">
                            <span class="step">1</span>
                            <span class="title">Définition de la Période</span>
                        </li>

                        <li data-step="2">
                            <span class="step">2</span>
                            <span class="title">Choix des Factures</span>
                        </li>

                        <li data-step="3">
                            <span class="step">3</span>
                            <span class="title">Confirmation du Choix</span>
                        </li>

                        <li data-step="4">
                            <span class="step">4</span>
                            <span class="title">Validation</span>
                        </li>
                    </ul>
                </div>
                <hr />
                <div class="step-content pos-rel">
                    <div class="step-pane active" data-step="1">
                        <h4 class="lighter block green">Définition de la Période</h4>
                        <table style="width: 80%; margin: 3% 10%;">
                            <tr>
                                <td style="width: 60%;">Dossier Comptable :</td>
                                <td colspan="2">Période :</td>
                            </tr>
                            <tr>
                                <td>
                                    <select id="dossier">
                                        <?php foreach ($dossiers as $dossier): ?>
                                            <option value="<?php echo $dossier->getId(); ?>"><?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonSociale(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td style="width: 20%"><input id="date_debut" min="<?php echo $_SESSION['exercice']; ?>-01-01" max="<?php echo $_SESSION['exercice']; ?>-12-31" type="date"></td>
                                <td style="width: 20%"><input id="date_fin" min="<?php echo $_SESSION['exercice']; ?>-01-01" max="<?php echo $_SESSION['exercice']; ?>-12-31" type="date"></td>
                            </tr>
                        </table>
                    </div>

                    <div class="step-pane" data-step="2">
                        <div id="zone_step_2">
                            <h4 class="lighter block green">Choix des factures ventes à importer.</h4>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10" style="position: unset;">
                                    <div class="mws-form-item" id="list_facture">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step-pane" data-step="3">
                        <div id="zone_radio_2_1">
                            <h4 class="lighter block green">Confirmation de la liste des factures ventes à importer.</h4>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10" style="position: unset;">
                                    <label style="font-size: 18px; font-weight: bold;">Liste des factures ventes à importer :</label>
                                    <div class="mws-form-item">
                                        <div style="height: 260px; overflow: auto;">
                                            <table id="list_facture_import">
                                                <thead>
                                                    <tr style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                                        <th style="font-weight: bold; text-align: center;">#</th>
                                                        <th style="font-weight: bold; text-align: center;">Référence (Numéro)</th>
                                                        <th style="font-weight: bold; text-align: center;">Date</th>
                                                        <th style="font-weight: bold; text-align: left; padding-left: 1%;">Client</th>
                                                        <th style="font-weight: bold; text-align: center;">Montant HT</th>
                                                        <th style="font-weight: bold; text-align: center;">Montant TVA</th>
                                                        <th style="font-weight: bold; text-align: center;">Montant TTC</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col-sm-6">
                                                <p><span class="label label-white middle">Facture payée par <b>Compte Bancaire / CCP</b></span></p>
                                                <p><span class="label label-warning label-white middle">Facture payée par <b>Caisse</b></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step-pane" data-step="4">
                        <div id="progressbar"></div>
                        <div class="center" id="final_success" style="display: none;">
                            <h3 class="green">Importation Terminée !</h3>
                            Facture(s) de vente importée(s) avec succès.
                        </div>
                    </div>
                </div>
            </div>

            <hr />
            <div class="wizard-actions">
                <button class="btn btn-prev">
                    <i class="ace-icon fa fa-arrow-left"></i>
                    Précédant
                </button>

                <button class="btn btn-success btn-next" data-last="Finish">
                    Suivant
                    <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                </button>
            </div>
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
</div>

<script  type="text/javascript">

    function choisirTransfert() {
        var valide = true;
        if ($('#date_debut').val() == '') {
            $('#date_debut').css('border', '1px solid red');
            valide = false;
        } else {
            $('#date_debut').css('border', '');
        }

        if ($('#date_fin').val() == '') {
            $('#date_fin').css('border', '1px solid red');
            valide = false;
        } else {
            $('#date_fin').css('border', '');
        }

        if ($('#dossier').val() == '-1') {
            $('#dossier_chosen').css('border', '1px solid red');
            $('#dossier_chosen').css('border-radius', '2px');
            valide = false;
        } else {
            $('#dossier_chosen').css('border', '');
        }

        if (valide) {
            $.ajax({
                url: '<?php echo url_for('importation/getFactureVente') ?>',
                data: 'date_debut=' + $('#date_debut').val() +
                        '&date_fin=' + $('#date_fin').val(),
                success: function (data) {
                    $('#list_facture').html(data);
                }
            });
        } else {
            e.preventDefault();
        }
    }

    function verifierTransfert() {
        var factures = '';
        $('.list_checbox_compte[type=checkbox]:checked').each(function () {
            factures += $(this).val() + ',';
        });
        if (factures != '') {
            var data = $('#myTable01 > tbody').html();
            $('#list_facture_import > tbody').html(data);

            $('#list_facture_import > tbody > tr').each(function (i) {
                // Only check rows that contain a checkbox
                var $chkbox = $(this).find('input[type="checkbox"]');
                if ($chkbox.length) {
                    var id = $chkbox.attr('id');
                    if ($('#' + id).attr('checked') != "checked")
                        $(this).remove();
                }
            });

            $('#list_facture_import > tbody > tr > td[name=td_checkbox]').each(function () {
                $(this).remove();
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir au moins une facture !",
                buttons: {
                    "success": {
                        "label": "OK",
                        "className": "btn-sm btn-primary"
                    }
                }
            });
            e.preventDefault();
        }
    }

    function validerTransfert() {
        var factures = '';
        $('.list_checbox_compte[type=checkbox]:checked').each(function () {
            factures += $(this).val() + ',';
        });
        if (factures != '') {
            //progressbar
            $("#progressbar").progressbar({
                value: 10,
                create: function (event, ui) {
                    $(this).addClass('progress progress-striped active').children(0).addClass('progress-bar progress-bar-success');
                }
            });

            //Importer les documents d'achat
            $.ajax({
                url: '<?php echo url_for('importation/saveFactureVenteImport') ?>',
                data: 'ids=' + factures,
                success: function (data) {
                    $("#progressbar").progressbar({
                        value: 66,
                        create: function (event, ui) {
                            $(this).addClass('progress progress-striped active').children(0).addClass('progress-bar progress-bar-success');
                        }
                    });

                    $('#progressbar').fadeOut();
                    $("#final_success").fadeIn();
                }
            });
        }
    }

</script>

<script  type="text/javascript">

    function afficher(id) {
        if (id == 'wzd_zone_0') {
            $('#wzd_zone_0').css('display', '');
            $('#li_wzd_zone_0').addClass('current');
            $('#wzd_zone_1').css('display', 'none');
            $('#li_wzd_zone_1').removeClass('current');
            $('#wzd_zone_2').css('display', 'none');
            $('#li_wzd_zone_2').removeClass('current');
        }

        if (id == 'wzd_zone_1') {
            $('#s_dossier').fadeOut();
            var valide = true;
            if ($('#date_debut').val() == '') {

                valide = false;
            }
            if ($('#date_fin').val() == '') {

                valide = false;
            }
            if ($('#dossier').val() == '-1') {

                $('#s_dossier').fadeIn();
                valide = false;
            }

            if (valide) {
                var etranger = 0;
                $.ajax({
                    url: '<?php echo url_for('importation/getFactureVente') ?>',
                    data: 'date_debut=' + $('#date_debut').val() + 
                           '&date_fin=' + $('#date_fin').val()+
                           '&etranger=' + etranger,
                    success: function(data) {
                        $('#list_facture').html(data);
                        $('#wzd_zone_1').css('display', '');
                        $('#li_wzd_zone_1').addClass('current');
                        $('#wzd_zone_0').css('display', 'none');
                        $('#li_wzd_zone_0').removeClass('current');
                        $('#wzd_zone_2').css('display', 'none');
                        $('#li_wzd_zone_2').removeClass('current');
                        $('#myTable01').fixedHeaderTable({footer: true, altClass: 'odd', fixedColumns: 1});
                        $('#selecte_all').change(function() {
                            if ($(this).is(':checked')) {
                                $('.list_checbox_compte[type=checkbox][add=1]').attr('checked', 'checked');
                            } else {
                                $('.list_checbox_compte').removeAttr('checked');

                            }
                        });
                    }
                });
            }
        }

        if (id == 'wzd_zone_2') {
            var factures = '';
            $('.list_checbox_compte[type=checkbox]:checked').each(function() {
                factures += $(this).val() + ',';
            });
      if(factures != ''){
          var etranger = 0;
            $.ajax({
                url: '<?php echo url_for('importation/getFactureVenteImport') ?>',
                data: 'ids=' + factures+'&etranger=' + etranger,
                success: function(data) {
                    $('#list_facture_import').html(data);
                    $('#wzd_zone_2').css('display', '');
                    $('#li_wzd_zone_2').addClass('current');
                    $('#wzd_zone_1').css('display', 'none');
                    $('#li_wzd_zone_1').removeClass('current');
                    $('#wzd_zone_0').css('display', 'none');
                    $('#li_wzd_zone_0').removeClass('current');
                    $('#myTable02').fixedHeaderTable({footer: true, altClass: 'odd', fixedColumns: 1});
                }
            });
           }
        }
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Importer les Ventes");
</script>