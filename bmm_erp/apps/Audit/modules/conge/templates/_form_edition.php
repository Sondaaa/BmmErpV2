<div id="sf_admin_container">
    <div class="modal-dialog" style="width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Edition Liste des Suivis Congés</h4>
            </div>
            <div class="modal-body">
                <fieldset class="col-lg-12" style="margin-bottom: 10px; margin-top: 5px; font-size: 14px;">
                    Presser " F1 <i class="ace-icon fa fa-keyboard-o bigger-110"></i> " ou " double click <i class="ace-icon fa fa-mouse-pointer bigger-110"></i> " dans la zone texte pour charger les motifs de recherche.
                </fieldset>
                <fieldset class="col-lg-12" style="margin-bottom: 20px;">
                      <h11><label><i>Agent</i></label></h11>
                    <table> 
                        <tr>
                            <td> <input type="hidden" id="idAg-conge">
                                <input id="idagents-conge" readonly="true" type="text" style="width: 70px" onkeydown="chargerEmployeConge(event, false)" ondblclick="chargerEmployeConge(event, true)">
                            </td>
                            <td>
                                <input id="agents-conge" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table> 
                   <h11><label><i>Type Congé</i></label></h11>
                    <table> 
                        <tr>
                            <td> <input type="hidden" id="idtype">
                                <input id="id" readonly="true" type="text" style="width: 70px" onkeydown="chargerType(event, false)" ondblclick="chargerType(event, true)">
                            </td>
                            <td>
                                <input id="type" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Année </i></label></h11>
                    <table> 
                        <tr>
                            <td colspan="2"><input id="annee_conge" type="text"></td>
                        </tr>
                    </table>
                   
                </fieldset>
                 <div class="row"></div>
                <div class="modal-footer">
                    <fieldset class="col-lg-12">
                        <button type="button" value="Filtrer" id="btnfil" class="btn btn-sm btn-primary pull-left" onclick="filtrerAllConge()">Filtrer</button>
                        <!--                    <button type="button"  value="Imprimer" id="bntimp" class="btn  pull-left" >Imprimer</button>-->
                        <button id="btnfermer" class="btn btn-sm btn-default pull-right" data-dismiss="modal" onclick="annuler2()">Fermer</button>
                        <button type="button" value="Initialiser" class="btn btn-sm btn-primary pull-right" onclick="Initilaiser2()">Initialiser</button>
                    </fieldset>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="zone_modal3"></div>

<div id="my-modalType" class="modal fade" tabindex="-1"> 
    <?php include_partial('typeconge/typeconge', array()); ?>
</div>

<div id="my-modalEmploye-conge" class="modal fade" tabindex="-1"> 
    <?php include_partial('conge/agents', array()); ?>
</div>
<script  type="text/javascript">
    function chargerEmployeConge(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modalEmploye-conge').addClass('in');
            $('#my-modalEmploye-conge').css('display', 'block');
        }
    }
    function chargerType(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modalType').addClass('in');
            $('#my-modalType').css('display', 'block');
        }
    }
    
 
    function  filtrerAllConge() {
        $.ajax({
            url: '<?php echo url_for('conge/filtrerAgents') ?>',
            data: 'idAg=' + $('#idAg-conge').val() +
                    '&idtype=' + $('#idtype').val() +
                    '&annee=' + $('#annee_conge').val() ,
                 
            success: function (data) {
                $('#zone_modal3').html(data);
                $('#my-modalagentsFiltre').addClass('in');
                $('#my-modalagentsFiltre').css('display', 'block');
            }
        });
    }

    function annuler2(){
        $('#my-modaledition ').removeClass('in');
        $('#my-modaledition ').css('display', 'none');
        Initilaiser();
    }
    function Initilaiser2(){ 
        $('#idAg-conge').val('');
        $('#idagents-conge').val('');
        $('#agents-conge').val('');
        
        $('#idtype').val('');
        $('#id').val('');
        $('#type').val('');
        
        $('#annee_conge').val('');

    }
</script>
<style>
    .table{margin-bottom: 0px;}
    label{font-weight: bold;}
    .smaller, .lighter, .blue, .no-margin{font-weight: bold;}
</style>