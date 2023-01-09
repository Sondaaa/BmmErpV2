<div id="sf_admin_container">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Edition Liste des Fiches de Paie</h4>
            </div>
            <div class="modal-body">
                <fieldset class="col-lg-12" style="margin-bottom: 10px; margin-top: 5px; font-size: 14px;">
                    Presser " F1 <i class="ace-icon fa fa-keyboard-o bigger-110"></i> " ou " double click <i class="ace-icon fa fa-mouse-pointer bigger-110"></i> " dans la zone texte pour charger les motifs de recherche.
                </fieldset>
                <fieldset class="col-lg-12" style="margin-bottom: 20px;">
                    <h11><label><i>Agents Début</i></label></h11>
                    <table class="table table-bordered table-hover"> 
                        <tr><input type="hidden" id="idAg">
                        <td style="width: 10%">  <input id="idagents" readonly="true" type="text" style="width: 100px" onkeydown="chargerEmploye(event, false)" ondblclick="chargerEmploye(event, true)">
                        </td>
                        <td> <input id="agents" style="width: 390px" type="text" class="disabledbutton">
                        </td>
                        </tr>
                    </table> 
                    <h11><label><i>Agents Fin </i></label></h11>
                    <table class="table table-bordered table-hover"> 
                        <tr>
                            <td style="width: 10%"> <input type="hidden" id="idAgF">
                                <input id="idagentsF" readonly="true" type="text" style="width: 100px" onkeydown="chargerEmployeF(event, false)" ondblclick="chargerEmployeF(event, true)">
                            </td>
                            <td>
                                <input id="agentsF" style="width: 390px"  type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Mois </i></label></h11>
                    <table class="table table-bordered table-hover"> 
                        <tr>
                            <!--<td colspan="2"><input id="mois"  style="width: 430px" type="text"></td>-->

                            <?php $ligne = Doctrine_Core::getTable('lignesociete')->findByAnnee(2019); ?>
                            <td colspan="2">
                                <select  id="mois" class="chosen-select form-control" >
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
                                <select id="annee" class="chosen-select form-control">
                                    <option></option>
                                    <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                        <option  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" value="<?php echo $_SESSION['exercice']; ?>" id="annee_session">
                </fieldset>
                <div class="row"></div>
                <div class="modal-footer">
                    <fieldset class="col-lg-12">
                        <button type="button" value="Initialiser" class="btn btn-sm btn-primary pull-left" onclick="Initilaiserpaie()">Initialiser</button>
                        <!--                    <button type="button"  value="Imprimer" id="bntimp" class="btn  pull-left" >Imprimer</button>-->
                        <button id="btnfermer" class="btn btn-sm btn-default pull-right" data-dismiss="modal" onclick="annulerpaie()">Fermer</button>
                        <button type="button" value="Filtrer" id="btnfil" class="btn btn-sm btn-primary pull-right" onclick="filtrerAllPaie()">Filtrer</button>
                    </fieldset>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="zone_modal_Paie"></div>
<div id="my-modalEmployeF" class="modal fade" tabindex="-1"> 
    <?php include_partial('paie/agentsF', array()); ?>
</div>

<div id="my-modalEmploye" class="modal fade" tabindex="-1"> 
    <?php include_partial('paie/agents', array()); ?>
</div>
<script>
    function chargerEmploye(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modalEmploye').addClass('in');
            $('#my-modalEmploye').css('display', 'block');
        }
    }

    function chargerEmployeF(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modalEmployeF').addClass('in');
            $('#my-modalEmployeF').css('display', 'block');
        }
    }
    function  filtrerAllPaie() {
        $.ajax({
            url: '<?php echo url_for('paie/filtrerPaie') ?>',
            data: 'idAg=' + $('#idAg').val() + '&idAgF=' + $('#idAgF').val()
                    + '&mois=' + $('#mois').val() + '&annee=' + $('#annee').val() + '&annee_session=' + $('#annee_session').val(),
            success: function (data) {
                $('#zone_modal_Paie').html(data);
                $('#my-modalPaieFiltre').addClass('in');
                $('#my-modalPaieFiltre').css('display', 'block');
            }
        });
    }
    function annulerpaie() {
        $('#my-modalpaie ').removeClass('in');
        $('#my-modalpaie ').css('display', 'none');
        Initilaiserpaie();
    }
    function Initilaiserpaie() {
        $('#idAg').val('');
        $('#idagents').val('');
        $('#agents').val('');
        $('#idAgF').val('');
        $('#idagentsF').val('');
        $('#agentsF').val('');
        $('#mois').val('');
        $('#annee').val('');
        $('#mois').val('').trigger("liszt:updated");
        $('#mois').trigger("chosen:updated");
        $('#annee').val('').trigger("liszt:updated");
        $('#annee').trigger("chosen:updated");
    }
</script>
<style>
    .table{margin-bottom: 0px;}
    label{font-weight: bold;}
    .smaller, .lighter, .blue, .no-margin{font-weight: bold;}
</style>