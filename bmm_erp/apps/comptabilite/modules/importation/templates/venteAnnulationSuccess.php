<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-magic"></i> Annuler Importation des Factures Vente</span>
    </div>
    <div class="mws-panel-body no-padding">
        <div class="wizard-nav wizard-nav-horizontal">
            <ul>
                <li class="current" id="li_wzd_zone_0" data-wzd-id="wzd_zone_0" onclick="afficher('wzd_zone_0')"><span><i class="icol-accept"></i> Définition de la Période</span></li>
                <li id="li_wzd_zone_1" data-wzd-id="wzd_zone_1" onclick="afficher('wzd_zone_1')"><span><i class="icol-delivery"></i> Liste des Factures Import</span></li>
                <li id="li_wzd_zone_2" data-wzd-id="wzd_zone_2" onclick="afficher('wzd_zone_2')"><span><i class="icol-user"></i> Confirmation de l'annulation</span></li>
            </ul>
        </div>
        <form class="mws-form wzd-ajax wizard-form wizard-form-horizontal" novalidate="novalidate">

            <fieldset class="wizard-step mws-form-inline" data-wzd-id="wzd_zone_0" id='wzd_zone_0' style="min-height: 200px;">
                <legend class="wizard-label" style="display: none;"><i class="icol-accept"></i>Définition de la Période</legend>
                <table style="margin-top: 20px;">
                    <tr>
                        <td colspan="2">
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Dossier Comptable :</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="mws-form-inline">
                                <div class="mws-form-row" style="width: 100%">
                                    <select id="dossier" class="mws-select2 large" style="width: 93%">
                                        <option value="-1"></option>
                                        <?php foreach ($dossiers as $dossier): ?>
                                            <option value="<?php echo $dossier->getId(); ?>"><?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonSociale(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div id="s_dossier" style="  display: none; color: #d11010; margin-left: 10%;  ">
                                    <p><b> choisissez un dossier  !</b></p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Période :</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="mws-form-inline">
                                <div class="mws-form-row" style="width: 100%">
                                    <input id="date_debut" type="text"  style="width: 85%">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mws-form-inline">
                                <div class="mws-form-row" style="width: 100%">
                                    <input id="date_fin" type="text"  style="width: 85%">
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </fieldset>

            <fieldset class="wizard-step mws-form-inline" style="display: none;" data-wzd-id="wzd_zone_1" id="wzd_zone_1" style="min-height: 200px;">
                <legend class="wizard-label" style="display: none;"><i class="icol-delivery"></i> Liste des Factures</legend>
                <div class="mws-panel grid_8" style="margin-top: 20px;" id="list_facture">

                </div>
            </fieldset>

            <fieldset class="wizard-step mws-form-inline" style="display: none;" data-wzd-id="wzd_zone_2" id="wzd_zone_2" style="min-height: 200px;">
                <legend class="wizard-label" style="display: none;"><i class="icol-user"></i> Confirmation de l'importation</legend>
                <div class="mws-panel grid_8" style="margin-top: 20px;" id="list_facture_import">

                </div>
            </fieldset>
        </form>
    </div>
</div>

<div id="loading" class="pp_loaderIcon"></div>

<script  type="text/javascript">

    $(document).ready(function() {
        $('#date_debut').datepicker();
        $('#date_fin').datepicker();
        
        $('#date_debut').mask("99/99/9999");
        $('#date_fin').mask("99/99/9999");
        $('#dossier').select2({placeholder: 'Sélectionner un dossier'});

    });

    function afficher(id) {
        $('#loading').fadeIn();
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
                $('#date_debut').css('border', '3px solid red');
                valide = false;
            } else {
                $('#date_debut').css('border', '');
            }

            if ($('#date_fin').val() == '') {
                $('#date_fin').css('border', '3px solid red');
                valide = false;
            } else {
                $('#date_fin').css('border', '');
            }

            if ($('#dossier').val() == '-1') {
                $('#s2id_dossier').css('border', '3px solid red');
                $('#s2id_dossier').css('border-radius', '7px');
                valide = false;
                $('#s_dossier').fadeIn();
            } else {
                $('#s2id_dossier').css('border', '');
            }

//            if ($('#dossier').val() == '-1') {
//
//                $('#s_dossier').fadeIn();
//                valide = false;
//            }

            if (valide) {
                var etranger = 0;
                $.ajax({
                    url: '<?php echo url_for('@getFactureVenteImportForAnnuler') ?>',
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
                url: '<?php echo url_for('@getFactureVenteAnnuler') ?>',
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

<style>

    .pp_loaderIcon{
        background:url(/images/icon/loading.gif) center center no-repeat
    }

    #loding{
        z-index: 99999999;
    }

</style>