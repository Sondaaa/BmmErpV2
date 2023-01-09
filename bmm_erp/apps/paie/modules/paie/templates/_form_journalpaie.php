<div id="sf_admin_container">
    <div class="modal-dialog" style="width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Edition Liste des Fiches de Journal de Paie</h4>
            </div>
            <div class="modal-body" id="journal">
                <fieldset class="col-lg-12" style="margin-bottom: 10px; margin-top: 5px; font-size: 14px;">
                    Presser " F1 <i class="ace-icon fa fa-keyboard-o bigger-110"></i> " ou " double click <i class="ace-icon fa fa-mouse-pointer bigger-110"></i> " dans la zone texte pour charger les motifs de recherche.
                </fieldset>
                <fieldset class="col-lg-12" style="margin-bottom: 20px;">
                    <h11><label><i>Mois </i></label></h11>
                    <table class="table table-bordered table-hover"> 
                        <tr>
                            <!--<td colspan="2"><input id="mois"  style="width: 430px" type="text"></td>-->
                            <td colspan="2">
                                <?php $ligne = Doctrine_Core::getTable('lignesociete')->findAll(); ?>
                                <select  id="mois_journalepaie" class="chosen-select form-control" >
                                    <option value=""></option>
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
                                    <?php // foreach ($ligne as $magSoc) { ?>
                                        <!--<option value="<?php // echo $magSoc->getCodemois()           ?>"><?php // echo $magSoc->getLibelle()           ?></option>-->
                                    <?php // } ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Année </i></label></h11>
                    <table class="table table-bordered table-hover"> 
                        <tr>
                            <td colspan="2">
                                <select id="annee_journalpaie" class="chosen-select form-control">
                                    <option value=""></option>
                                    <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                        <option <?php if ($i == date('Y')): ?>selected="true"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Caisse de Sécurité Sociale Début </i></label></h11>
                    <table class="table table-bordered table-hover"> 
                        <input  id="idcode" readonly="true"  style="width: 240px;"type="hidden" >
                        <tr>
                            <td colspan="2">
                                <input id="code" readonly="true" type="text" style="width: 200px" onkeydown="chargerCodeSociale(event, false)" ondblclick="chargerCodeSociale(event, true)">
                            </td>
                            <td><input id="tauxcode" style="width: 150px"  type="text" class="disabledbutton">  </td>
                        </tr> 
                    </table>
                    <h11><label><i>Caisse de Sécurité Sociale Fin </i></label></h11>
                    <table class="table table-bordered table-hover"> 
                        <input  id="idcodeF" readonly="true"  style="width: 240px;"type="hidden" >
                        <tr>
                            <td colspan="2">
                                <input id="codeF" readonly="true" type="text" style="width: 240px" onkeydown="chargerCodeSocialeF(event, false)" ondblclick="chargerCodeSocialeF(event, true)">
                            </td>
                            <td><input id="tauxcodeF" style="width: 150px"  type="text" class="disabledbutton">  </td>
                        </tr> 
                    </table>
                </fieldset>
                <div class="row"></div>
                <div class="modal-footer">
                    <fieldset class="col-lg-12">
                        <button type="button" value="Initialiser" class="btn btn-sm btn-primary pull-left" onclick="InitilaiserJournalpaie()">Initialiser</button>

                        <!--                    <button type="button"  value="Imprimer" id="bntimp" class="btn  pull-left" >Imprimer</button>-->
                        <button id="btnfermer" class="btn btn-sm btn-default pull-right" data-dismiss="modal" onclick="annulerJournalpaie()">Fermer</button>
                        <button type="button" value="Filtrer" id="btnfil" class="btn btn-sm btn-primary pull-right " onclick="filtrerAllJournalPaie()">Filtrer</button>

                    </fieldset>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div id="my-modalCaisseSociale" class="modal fade" tabindex="-1"> 
    <?php include_partial('paie/codesociale', array()); ?>
</div>

<div id="my-modalCaisseSocialeF" class="modal fade" tabindex="-1"> 
    <?php include_partial('paie/codesocialeF', array()); ?>
</div>
<div id="zone_modal_Journal_Paie"></div>

<script>

    function  filtrerAllJournalPaie() {
        var code_1 = $('#code').val();
        var code_2 = $('#codeF').val();
//tester si nont pas dans le meme code cnss ou les deux cnrps alert 
        $.ajax({
            url: '<?php echo url_for('paie/filtrerJournalPaie') ?>',
            data: 'mois_journalepaie=' + $('#mois_journalepaie').val() + '&annee_journalpaie=' + $('#annee_journalpaie').val()
                    + '&id_codesociale=' + $('#idcode').val() + '&id_codesocialeF=' + $('#idcodeF').val(),
            success: function (data) {
                $('#zone_modal_Journal_Paie').html(data);
                $('#my-modalJournalPaieFiltre').addClass('in');
                $('#my-modalJournalPaieFiltre').css('display', 'block');
            }
        });
    }
    function annulerJournalpaie() {
        $('#my-modaljournalpaie ').removeClass('in');
        $('#my-modaljournalpaie ').css('display', 'none');
        $('#mois_journalepaie').val('').trigger("liszt:updated");
        $('#mois_journalepaie').trigger("chosen:updated");
        $('#code').val('');
        $('#tauxcode').val('');
        $('#idcode').val('');
        $('#codeF').val('');
        $('#tauxcodeF').val('');
        $('#idcodeF').val('');
//        InitilaiserJournalpaie();
    }
    function InitilaiserJournalpaie() {
        $('#mois_journalepaie').val('').trigger("liszt:updated");
        $('#mois_journalepaie').trigger("chosen:updated");
        $('#annee_journalpaie').val('').trigger("liszt:updated");
        $('#annee_journalpaie').trigger("chosen:updated");
        $('#code').val('');
        $('#tauxcode').val('');
        $('#idcode').val('');
        $('#codeF').val('');
        $('#tauxcodeF').val('');
        $('#idcodeF').val('');
    }

    function chargerCodeSociale(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {

            $('#my-modalCaisseSociale').addClass('in');
            $('#my-modalCaisseSociale').css('display', 'block');
        }
    }
    function chargerCodeSocialeF(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {

            $('#my-modalCaisseSocialeF').addClass('in');
            $('#my-modalCaisseSocialeF').css('display', 'block');
        }
    }
</script>
<style>
    .table{margin-bottom: 0px;}
    label{font-weight: bold;}
    .smaller, .lighter, .blue, .no-margin{font-weight: bold;}
</style>