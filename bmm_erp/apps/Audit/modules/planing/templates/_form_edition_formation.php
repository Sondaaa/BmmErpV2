<div id="sf_admin_container">
    <div class="modal-dialog" style="width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Edition Liste des Formations / Agent</h4>
            </div>
            <div class="modal-body">
                <fieldset class="col-lg-12" style="margin-bottom: 10px; margin-top: 5px; font-size: 14px;">
                    Presser " F1 <i class="ace-icon fa fa-keyboard-o bigger-110"></i> " ou " double click <i class="ace-icon fa fa-mouse-pointer bigger-110"></i> " dans la zone texte pour charger les motifs de recherche.
                </fieldset>
                <fieldset class="col-lg-6" style="margin-bottom: 20px;">
                    <h11><label><i>Agents</i></label></h11>
                    <table> 
                        <tr>
                            <td> <input type="hidden" id="idAg">
                                <input id="idagents" readonly="true" type="text" style="width: 70px" onkeydown="chargerEmploye(event, false)" ondblclick="chargerEmploye(event, true)">
                            </td>
                            <td>
                                <input id="agents" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Organisme de Formation</i></label></h11>
                    <table>
                        <tr>
                            <td>
                                <input id="idorg" style="width: 70px" type="text" readonly="true" onkeydown="chargerorganisme1(event, false)" ondblclick="chargerorganisme1(event, true)">
                            </td>
                            <td>
                                <input id="organismef" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Formateur</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input type="hidden" id="idFor">
                                <input id="idFormat" style="width: 70px" type="text" readonly="true" onkeydown="chargerFormateur1(event, false)" ondblclick="chargerFormateur1(event, true)">
                            </td>
                            <td>
                                <input id="formateur1" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Année Début</i></label></h11>
                    <table> 
                        <tr>
                            <td colspan="2"><input  id="anneedebut1" style="width: 70px" type="text"></td>
                        </tr>
                    </table>
                    <h11><label><i>Année Fin</i></label></h11>
                    <table> 
                        <tr>
                            <td colspan="2"><input  id="anneeformation1" style="width: 70px" type="text"></td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset class="col-lg-6">
                    <h11><label><i>Domaine d'utilisation</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input type="hidden" id="idDomaine1">
                                <input id="iddoma" data="fixe" readonly="true" type="text" style="width: 70px" onkeydown="chargerDomaine1(event, false)" ondblclick="chargerDomaine1(event, true)">
                            </td>
                            <td>
                                <input id="lieblledomine"  type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Rubrique</i></label></h11>
                    <table>
                        <tr>
                            <td>
                                <input type="hidden" id="idRub">
                                <input id="idrubrique1" data="fixe" readonly="true" style="width: 70px" type="text" onkeydown="chargerrubrique1(event, false)" ondblclick="chargerrubrique1(event, true)">
                            </td>
                            <td>
                                <input id="rubrique1" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Sous Rubrique</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input type="hidden" id="idSousRubrique1">
                                <input id="idsousrubrique1" data="fixe" readonly="true" style="width: 70px" type="text" onkeydown="chargersousrubrique1(event, false)" ondblclick="chargersousrubrique1(event, true)">
                            </td>
                            <td>
                                <input id="sousrubrique1" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Unité</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input id="idunite1" data="fixe" readonly="true" type="text" style="width: 70px" onkeydown="chargerUnite1(event, false)" ondblclick="chargerUnite1(event, true)">
                            </td>
                            <td>
                                <input id="unite1" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>

                </fieldset>
                 <div class="row"></div>
                <div class="modal-footer">
                    <fieldset class="col-lg-12">
                        <button type="button" value="Filtrer" id="btnfil" class="btn btn-sm btn-primary pull-left" onclick="filtrerAll1()">Filtrer</button>
                        <!--                    <button type="button"  value="Imprimer" id="bntimp" class="btn  pull-left" >Imprimer</button>-->
                        <button id="btnfermer" class="btn btn-sm btn-default pull-right" data-dismiss="modal" onclick="annuler1()">Fermer</button>
                        <button type="button" value="Initialiser" class="btn btn-sm btn-primary pull-right" onclick="InitilaiserFormation1()">Initialiser</button>
                    </fieldset>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="zone_modal1"></div>

<div id="my-modalorganisme" class="modal fade" tabindex="-1"> 
    <?php include_partial('planing/organisme1', array()); ?>
</div>

<div id="my-modaformateur" class="modal fade" tabindex="-1"> 
    <?php include_partial('planing/formateur1', array()); ?>
</div>

<div id="my-modalUnite1" class="modal fade" tabindex="-1"> 
    <?php include_partial('planing/unite1', array()); ?>
</div>

<div id="my-modalDomaineutilisation" class="modal fade" tabindex="-1"> 
    <?php include_partial('planing/domaineutilisation1', array()); ?>
</div>

<div id="my-modalRubrique1" class="modal fade" tabindex="-1"> 
    <?php include_partial('planing/rubrique1', array()); ?>
</div>

<div id="my-modalSousRubrique1" class="modal fade" tabindex="-1"> 
    <?php include_partial('planing/sousrubrique1', array()); ?>
</div>

<div id="my-modalEmploye" class="modal fade" tabindex="-1"> 
    <?php include_partial('planing/agents', array()); ?>
</div>

<script  type="text/javascript">

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
    function chargerorganisme1(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modalorganisme').addClass('in');
            $('#my-modalorganisme').css('display', 'block');
        }
    }
    function chargerFormateur1(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modaformateur').addClass('in');
            $('#my-modaformateur').css('display', 'block');
        }
    }
    function chargerDomaine1(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modalDomaineutilisation').addClass('in');
            $('#my-modalDomaineutilisation').css('display', 'block');
        }
    }
    function chargerrubrique1(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            if (($('#iddoma').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('planing/chargerRubriquePardomaine1()') ?>',
                    data: 'idd=' + $('#iddoma').val(),
                    success: function (data) {
                        $('#zone_modal1').html(data);
                        $('#my-modalrubriquepardomaine1').addClass('in');
                        $('#my-modalrubriquepardomaine1').css('display', 'block');
                    }
                });
            } else {
                $('#my-modalRubrique1').addClass('in');
                $('#my-modalRubrique1').css('display', 'block');
            }
        }
    }
    function chargersousrubrique1(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            if (($('#iddoma').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('planing/chargerSousRubriquePardomine1()') ?>',
                    data: 'idd=' + $('#iddoma').val(),
                    success: function (data) {
                        $('#zone_modal1').html(data);
                        $('#my-modalsousrubriquepardomaine1').addClass('in');
                        $('#my-modalsousrubriquepardomaine1').css('display', 'block');
                    }
                });
            } else if (($('#idrubrique1').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('planing/chargerSousRubrique_ParRubrique1()') ?>',
                    data: 'idd=' + $('#idrubrique1').val(),
                    success: function (data) {


                        $('#zone_modal1').html(data);
                        $('#my-modalsousrubriqueparrubrique_2').addClass('in');
                        $('#my-modalsousrubriqueparrubrique_2').css('display', 'block');
                    }
                });
            } else {
                $('#my-modalSousRubrique1').addClass('in');
                $('#my-modalSousRubrique1').css('display', 'block');
            }
        }
    }

    function chargerUnite1(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modalUnite1').addClass('in');
            $('#my-modalUnite1').css('display', 'block');
        }
    }
    function  filtrerAll1() {
        $.ajax({
            url: '<?php echo url_for('planing/filtrerFormationPArAgents') ?>',
            data: 'iddebut=' + $('#anneedebut1').val() +
                    '&idfin=' + $('#anneeformation1').val() +
                    '&idunite=' + $('#idunite1').val() +
                    '&idag=' + $('#idAg').val() +
                    '&idorganisme=' + $('#idorg').val() +
                    '&idF=' + $('#idFor').val() +
                    '&idSousRubrique=' + $('#idSousRubrique1').val() +
                    '&idd=' + $('#idDomaine1').val() +
                    '&idRubrique=' + $('#idRub').val(),
            success: function (data) {
                $('#zone_modal1').html(data);
                $('#my-modalformationagentsFiltre').addClass('in');
                $('#my-modalformationagentsFiltre').css('display', 'block');
            }
        });
    }

    function annuler1() {
        $('#my-modaleditionformation ').removeClass('in');
        $('#my-modaleditionformation ').css('display', 'none');
        Initilaiser();
    }
    function InitilaiserFormation1() {

        $('#idAg').val('');
        $('#idagents').val('');
        $('#agents').val('');

        $('#idorg').val('');
        $('#organismef').val('');

        $('#idFor').val('');
        $('#idFormat').val('');
        $('#formateur1').val('');



        $('#idDomaine1').val('');
        $('#iddoma').val('');
        $('#lieblledomine').val('');

        $('#idRub').val('');
        $('#idrubrique1').val('');
        $('#rubrique1').val('');

        $('#sousrubrique1').val('');
        $('#idsousrubrique1').val('');
        $('#idSousRubrique1').val('');
        $('#anneedebut1').val('');

        $('#anneeformation1').val('');
        $('#idunite1').val('');
        $('#unite1').val('');
    }

</script>
<style>
    .table{margin-bottom: 0px;}
    label{font-weight: bold;}
    .smaller, .lighter, .blue, .no-margin{font-weight: bold;}
</style>