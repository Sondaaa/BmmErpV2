<div id="sf_admin_container">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Edition Etat Récapitulatif</h4>
            </div>
            <div class="modal-body">
                <fieldset class="col-lg-12" style="margin-bottom: 10px; margin-top: 5px; font-size: 14px;">
                    Presser " F1 <i class="ace-icon fa fa-keyboard-o bigger-110"></i> " ou " double click <i class="ace-icon fa fa-mouse-pointer bigger-110"></i> " dans la zone texte pour charger les motifs de recherche.
                </fieldset>
                <fieldset class="col-lg-12" style="margin-bottom: 20px;">
                    <h11><label><i>Mois </i></label></h11>
                    <table class="table table-bordered table-hover"> 
                        <tr>
                            <?php $ligne = Doctrine_Core::getTable('lignesociete')->findAll(); ?>
                            <td colspan="2">
                                <select  id="mois_recap" class="chosen-select form-control" >
                                    <option></option>
                                    <option value="1">Janvier</option>
                                    <option value="2">Février</option>
                                    <option value="3">Mars</option>
                                    <option value="4">Avril</option>
                                    <option value="5">Mai</option>
                                    <option value="6">juin</option>
                                    <option value="7">Juillet</option>
                                    <option  value="8">Août</option>
                                    <option value="9">Septembre</option>
                                    <option  value="10">Octobre</option>
                                    <option value="11">Nouvembre</option>
                                    <option value="12">Décembre</option>
                                    <?php foreach ($ligne as $magSoc) { ?>
                                        <option value="<?php echo $magSoc->getCodemois() ?>"><?php echo $magSoc->getLibelle() ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Année </i></label></h11>
                    <table class="table table-bordered table-hover"> 
                        <tr>
                            <td colspan="2">
                                <select  id="annee_recap" class="chosen-select form-control" >
                                    <option></option>
                                    <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                        <option  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Caisse de Sécurité Sociale  </i></label></h11>
                    <table class="table table-bordered table-hover"> 
                        <input  id="idcodedecl_recap" readonly="true"  style="width: 70px;"type="hidden" >
                        <tr>
                            <td colspan="2">

                                <input id="codesoc_recap" readonly="true" type="text" style="width: 240px" onkeydown="chargerCodeSocialesRecap(event, false)" ondblclick="chargerCodeSocialesRecap(event, true)">
                            </td>
                            <td><input id="tauxcodesoc_recap" style="width: 150px"  type="text" class="disabledbutton">  </td>
                        </tr> 
                    </table>
                </fieldset>
                <div class="row"></div>
                <div class="modal-footer">
                    <fieldset class="col-lg-12">
                        <button type="button" value="Initialiser" class="btn btn-sm btn-primary pull-left " onclick="InitilaiserpaieRecap()">Initialiser</button>
                        <!--                    <button type="button"  value="Imprimer" id="bntimp" class="btn  pull-left" >Imprimer</button>-->
                        <button id="btnfermer" class="btn btn-sm btn-default pull-right" data-dismiss="modal" onclick="annulerpaieRecap()">Fermer</button>
                        <button type="button" value="Filtrer" id="btnfil" class="btn btn-sm btn-primary pull-right" onclick="filtrerAllPaieRecap()">Filtrer</button>
                    </fieldset>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="zone_modal_Recap"></div>
<div id="my-modalCaisSocialeRecap" class="modal fade" tabindex="-1"> 
    <?php include_partial('paie/codesocialerecap', array()); ?>
</div>
<script>
    function chargerCodeSocialesRecap(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modalCaisSocialeRecap').addClass('in');
            $('#my-modalCaisSocialeRecap').css('display', 'block');
        }
    }
    function  filtrerAllPaieRecap() {
        if ($('#mois_recap').val() == "" || $('#annee_recap').val() == "" || $('#idcodedecl_recap').val() == "") {
            alert("Veuillez choisr le mois et l'année et le code sociale pour l'état réacapitulatif");
        }
        $.ajax({
            url: '<?php echo url_for('paie/filtrerEtatRecap') ?>',
            data: 'mois=' + $('#mois_recap').val() + '&annee=' + $('#annee_recap').val() + '&codesoc=' + $('#idcodedecl_recap').val(),
            success: function (data) {
                $('#zone_modal_Recap').html(data);
                $('#my-modalPaieEtatRecap').addClass('in');
                $('#my-modalPaieEtatRecap ').css('display', 'block');
            }
        });
    }
    function annulerpaieRecap() {
        $('#my-modalCaisSocialeRecap ').removeClass('in');
        $('#my-modalCaisSocialeRecap ').css('display', 'none');
        InitilaiserpaieRecap();
    }
    function InitilaiserpaieRecap() {
        $('#mois_recap').val('').trigger("liszt:updated");
        $('#mois_recap').trigger("chosen:updated");
        $('#annee_recap').val('').trigger("liszt:updated");
        $('#annee_recap').trigger("chosen:updated");

        $('#idcodedecl_recap').val('');
        $('#codesoc_recap').val('');
        $('#tauxcodesoc_recap').val('');

    }
</script>
<style>
    .table{margin-bottom: 0px;}
    label{font-weight: bold;}
    .smaller, .lighter, .blue, .no-margin{font-weight: bold;}
</style>