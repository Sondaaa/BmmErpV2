<div id="sf_admin_container">
    <div class="modal-dialog" style="width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Edition Liste des Déclarations Trimestrielle  </h4>
            </div>
            <div class="modal-body" id="declaration">
                <fieldset class="col-lg-12" style="margin-bottom: 10px; margin-top: 5px; font-size: 14px;">
                    Presser " F1 <i class="ace-icon fa fa-keyboard-o bigger-110"></i> " ou " double click <i class="ace-icon fa fa-mouse-pointer bigger-110"></i> " dans la zone texte pour charger les motifs de recherche.
                </fieldset>
                <fieldset class="col-lg-12" style="margin-bottom: 20px;">
                    <h11><label><i>Période </i></label></h11>
                    <table class="table table-bordered table-hover"> 
                        <tr>
                            <td colspan="2">
                                <select  id="trimestre" class="chosen-select form-control" >
                                    <option value=""></option>
                                    <option value="1">1ére Trimestre</option>
                                    <option value="2">2éme Trimestre</option>
                                    <option value="3">3éme Trimestre</option>
                                    <option value="4">4éme Trimestre</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Année </i></label></h11>
                    <table class="table table-bordered table-hover"> 
                        <tr>
                            <td colspan="2">
                                <select id="annee_declaration" class="chosen-select form-control">
                                    <option value=""></option>
                                    <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                        <option  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Caisse de Sécurité Sociale  </i></label></h11>
                    <input type="hidden" value="<?php echo $_SESSION['exercice']; ?>" id="annee_session">
                    <input id="idcodedecl" readonly="true"  style="width: 70px;"type="hidden" >
                    <table class="table table-bordered table-hover"> 
                        <tr>
                            <td colspan="2">
                                <input id="codesoc" readonly="true" type="text" style="width: 240px" onkeydown="chargerCodeSociales(event, false)" ondblclick="chargerCodeSociales(event, true)">
                            </td>
                            <td>
                                <input id="tauxcodesoc" style="width: 150px" type="text" class="disabledbutton">
                            </td>
                        </tr>  
                    </table>
                </fieldset>
                <div class="row"></div>
                <div class="modal-footer">
                    <fieldset class="col-lg-12">
                        <button type="button" value="Initialiser" class="btn btn-sm btn-primary pull-left " onclick="InitilaiserDeclaration()">Initialiser</button> 
                        <!--                    <button type="button"  value="Imprimer" id="bntimp" class="btn  pull-left" >Imprimer</button>-->
                        <button id="btnfermer" class="btn btn-sm btn-default pull-right" data-dismiss="modal" onclick="annulerDeclaration()">Fermer</button>
                        <button type="button" value="Filtrer" id="btnfil" class="btn btn-sm btn-primary pull-right" onclick="filtrerAllDeclaration()">Filtrer</button>
                    </fieldset>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="zone_modal_declaartion_Paie"></div>
<div id="my-modalCaisSociale" class="modal fade" tabindex="-1"> 
    <?php include_partial('paie/codesocialedec', array()); ?>
</div>
<script>
    function chargerCodeSociales(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {

            $('#my-modalCaisSociale').addClass('in');
            $('#my-modalCaisSociale').css('display', 'block');
        }
    }
    function  filtrerAllDeclaration() {
        if ($('#trimestre').val() == "" || $('#annee_declaration').val() == "" || $('#idcodedecl').val() == "") {
            alert(" veuillez choisr le Trimestre et l'année Pour le déclaration et le code sociale ");
        }
        $.ajax({
            url: '<?php echo url_for('paie/filtrerDeclaration') ?>',
            data: 'trimestre=' + $('#trimestre').val() + '&annee_declaration=' + $('#annee_declaration').val() + '&codesociale=' + $('#idcodedecl').val()
                    + '&annee_session=' + $('#annee_session').val(),
            success: function (data) {
                if ($('#trimestre').val() != "" && $('#annee_declaration').val() != "" && $('#idcodedecl').val() != "") {
                    $('#zone_modal_declaartion_Paie').html(data);
                    $('#my-modalDecalarationFiltre').addClass('in');
                    $('#my-modalDecalarationFiltre').css('display', 'block');
                }
            }
        });
    }
    function annulerDeclaration() {
        $('#my-modaldeclaration ').removeClass('in');
        $('#my-modaldeclaration ').css('display', 'none');
        InitilaiserDeclaration();
    }
    function InitilaiserDeclaration() {
        $('#trimestre').val('').trigger("liszt:updated");
        $('#trimestre').trigger("chosen:updated");
        $('#annee_declaration').val('').trigger("liszt:updated");
        $('#annee_declaration').trigger("chosen:updated");
        $('#idcodedecl').val('');
        $('#codesoc').val('');
        $('#tauxcodesoc').val('');
    }
</script>
<style>
    .table{margin-bottom: 0px;}
    label{font-weight: bold;}
    .smaller, .lighter, .blue, .no-margin{font-weight: bold;}
</style>