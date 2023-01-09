<div id="sf_admin_container">
    <div class="modal-dialog" style="width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Edition Liste des Formations</h4>
            </div>
            <div class="modal-body">
                <fieldset class="col-lg-12" style="margin-bottom: 10px; margin-top: 5px; font-size: 14px;">
                    Presser " F1 <i class="ace-icon fa fa-keyboard-o bigger-110"></i> " ou " double click <i class="ace-icon fa fa-mouse-pointer bigger-110"></i> " dans la zone texte pour charger les motifs de recherche.
                </fieldset>
                <fieldset class="col-lg-6" style="margin-bottom: 20px;">
                    <h11><label><i>Regroupement Thème</i></label></h11>
                    <table>
                        <tr>
                            <td>
                                <input id="iddirection_unite6" style="width: 70px" readonly="true" type="text" onkeydown="chargerRegr(event, false)" ondblclick="chargerRegr(event, true)">
                            </td>
                            <td>
                                <input id="direction_unite6" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Organisme de Formation</i></label></h11>
                    <table>
                        <tr>
                            <td>
                                <input id="idorganisme" style="width: 70px" type="text" readonly="true" onkeydown="chargerorganisme(event, false)" ondblclick="chargerorganisme(event, true)">
                            </td>
                            <td>
                                <input id="organisme" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Formateur</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input type="hidden" id="idF">
                                <input id="idFormateur" style="width: 70px" type="text" readonly="true" onkeydown="chargerFormateur(event, false)" ondblclick="chargerFormateur(event, true)">
                            </td>
                            <td>
                                <input id="formateur" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Année Debut</i></label></h11>
                    <table> 
                        <tr>
                            <td colspan="2"><input id="anneedebut" style="width: 70px" type="text"></td>
                        </tr>
                    </table>
                    <h11><label><i>Année Fin</i></label></h11>
                    <table> 
                        <tr>
                            <td colspan="2"><input id="anneeformation" style="width: 70px" type="text"></td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset class="col-lg-6">
                    <h11><label><i>Domaine d'utilisation</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input type="hidden" id="idDomaine">
                                <input id="idfonction" readonly="true" type="text" style="width: 70px" onkeydown="chargerDomaine(event, false)" ondblclick="chargerDomaine(event, true)">
                            </td>
                            <td>
                                <input id="liebllefonction" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Rubrique</i></label></h11>
                    <table>
                        <tr>
                            <td>
                                <input type="hidden" id="idRubrique">
                                <input id="idrubrique" readonly="true" style="width: 70px" type="text" onkeydown="chargerrubrique(event, false)" ondblclick="chargerrubrique(event, true)">
                            </td>
                            <td>
                                <input id="rubrique" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Sous Rubrique</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input type="hidden" id="idSousRubrique">
                                <input id="idsousrubrique" readonly="true" style="width: 70px" type="text" onkeydown="chargersousrubrique(event, false)" ondblclick="chargersousrubrique(event, true)">
                            </td>
                            <td>
                                <input id="sousrubrique" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Unité</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input id="idunite" readonly="true" type="text" style="width: 70px" onkeydown="chargerUnite(event, false)" ondblclick="chargerUnite(event, true)">
                            </td>
                            <td>
                                <input id="unite" type="text" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <div class="modal-footer">
                    <fieldset class="col-lg-12">
                        <button type="button" value="Filtrer" id="btnfil" class="btn btn-sm btn-primary pull-left" onclick="filtrerAll()">Filtrer</button>
                        <!--                    <button type="button"  value="Imprimer" id="bntimp" class="btn  pull-left" >Imprimer</button>-->
                        <button id="btnfermer" class="btn btn-sm btn-default pull-right" data-dismiss="modal" onclick="annuler()">Fermer</button>
                        <button type="button" value="Initialiser" class="btn btn-sm btn-primary pull-right" onclick="Initilaiser()">Initialiser</button>
                    </fieldset>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="zone_modal"></div>

<div id="my-modal-unite6" class="modal fade" tabindex="-1"> 
    <?php include_partial('regroupementtheme/regroupemnet_unite', array()); ?>
</div>

<div id="my-modal2" class="modal fade" tabindex="-1"> 
    <?php include_partial('planing/organisme', array()); ?>
</div>

<div id="my-modal7" class="modal fade" tabindex="-1"> 
    <?php include_partial('planing/formateur', array()); ?>
</div>

<div id="my-modalBesoins" class="modal fade" tabindex="-1"> 
    <?php include_partial('planing/annee', array()); ?>
</div>

<div id="my-modalDomaine" class="modal fade" tabindex="-1"> 
    <?php include_partial('planing/domaineutilisation', array()); ?>
</div>

<div id="my-modalRubrique" class="modal fade" tabindex="-1"> 
    <?php include_partial('planing/rubrique', array()); ?>
</div>

<div id="my-modalSousRubrique" class="modal fade" tabindex="-1"> 
    <?php include_partial('planing/sousrubrique', array()); ?>
</div>

<div id="my-modalUnite" class="modal fade" tabindex="-1"> 
    <?php include_partial('planing/unite', array()); ?>
</div>

<script  type="text/javascript">
    function chargerRegr(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modal-unite6').addClass('in');
            $('#my-modal-unite6').css('display', 'block');
        }
    }
    function chargerUnite(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modalUnite').addClass('in');
            $('#my-modalUnite').css('display', 'block');
        }
    }
    function chargerorganisme(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modal2').addClass('in');
            $('#my-modal2').css('display', 'block');
        }
    }
    function chargerFormateur(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modal7').addClass('in');
            $('#my-modal7').css('display', 'block');
        }
    }
    function chargerDomaine(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modalDomaine').addClass('in');
            $('#my-modalDomaine').css('display', 'block');
        }
    }
    function chargerrubrique(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            if (($('#idfonction').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('planing/chargerRubriquePardomaine()') ?>',
                    data: 'idd=' + $('#idfonction').val(),
                    success: function (data) {
                        $('#zone_modal').html(data);
                        $('#my-modalrubriquepardomaine').addClass('in');
                        $('#my-modalrubriquepardomaine').css('display', 'block');
                    }
                });
            } else {
                $('#my-modalRubrique').addClass('in');
                $('#my-modalRubrique').css('display', 'block');
            }
        }
    }
    function chargersousrubrique(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            if (($('#idfonction').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('planing/chargerSousRubriquePardomine()') ?>',
                    data: 'idd=' + $('#idfonction').val(),
                    success: function (data) {
                        $('#zone_modal').html(data);
                        $('#my-modalsousrubriquepardomaine').addClass('in');
                        $('#my-modalsousrubriquepardomaine').css('display', 'block');
                    }
                });
            } else if (($('#idRubrique').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('planing/chargerSousRubriqueParRubrique()') ?>',
                    data: 'idd=' + $('#idRubrique').val(),
                    success: function (data) {
                        $('#zone_modal').html(data);
                        $('#my-modalsousrubriqueparrubrique').addClass('in');
                        $('#my-modalsousrubriqueparrubrique').css('display', 'block');
                    }
                });
            } else {
                $('#my-modalSousRubrique').addClass('in');
                $('#my-modalSousRubrique').css('display', 'block');
            }
        }
    }

    function  filtrerAll() {
        $.ajax({
            url: '<?php echo url_for('planing/filtrerAgents') ?>',
            data: 'iddebut=' + $('#anneedebut').val() +
                    '&idfin=' + $('#anneeformation').val() +
                    '&idunite=' + $('#idunite').val() +
                    '&idregr=' + $('#iddirection_unite6').val() +
                    '&idorganisme=' + $('#idorganisme').val() +
                    '&idF=' + $('#idF').val() +
                    '&idSousRubrique=' + $('#idSousRubrique').val() +
                    '&idd=' + $('#idDomaine').val() +
                    '&idRubrique=' + $('#idRubrique').val(),
            success: function (data) {
                $('#zone_modal').html(data);
                $('#my-modalagentsFiltre').addClass('in');
                $('#my-modalagentsFiltre').css('display', 'block');
            }
        });
    }

    function  filtrer()
    {
        if (($('#anneedebut').val() != "") && ($('#anneeformation').val() != "") && ($('#idunite').val() != ""))
        {
            $.ajax({
                url: '<?php echo url_for('planing/chargerAgnetsParAnneeDebutFinUnite()') ?>',
                data: 'idd=' + $('#anneedebut').val() + '&idfin=' + $('#anneeformation').val() + '&idunite=' + $('#idunite').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalagentsParAnneeDebutFinUnite').addClass('in');
                    $('#my-modalagentsParAnneeDebutFinUnite').css('display', 'block');
                }

            });
        }
        else if (($('#anneedebut').val() != "") && ($('#idunite').val() != ""))
        {
            $.ajax({
                url: '<?php echo url_for('planing/chargerAgnetsParAnneeDebutUnite()') ?>',
                data: 'idd=' + $('#anneedebut').val() + '&idunite=' + $('#idunite').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalagentsParAnneeDebutUnite').addClass('in');
                    $('#my-modalagentsParAnneeDebutUnite').css('display', 'block');
                }

            });
        }
        else if (($('#anneeformation').val() != "") && ($('#idunite').val() != ""))
        {
            $.ajax({
                url: '<?php echo url_for('planing/chargerAgnetsParAnneeFinUnite()') ?>',
                data: 'idanne=' + $('#anneeformation').val() + '&idunite=' + $('#idunite').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalagentsParAnneeFinUnite').addClass('in');
                    $('#my-modalagentsParAnneeFinUnite').css('display', 'block');
                }

            });
        }

        else if (($('#anneedebut').val() != "") && ($('#anneeformation').val() != ""))
        {
            $.ajax({
                url: '<?php echo url_for('planing/chargerAgnetsParAnneeDebutFin()') ?>',
                data: 'idd=' + $('#anneedebut').val() + '&idfin=' + $('#anneeformation').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalagentsParAnneeDebutFin').addClass('in');
                    $('#my-modalagentsParAnneeDebutFin').css('display', 'block');
                }

            });
        }

        else if (($('#anneeformation').val() != ""))
        {
            $.ajax({
                url: '<?php echo url_for('planing/chargerAgnetsParAnnee()') ?>',
                data: 'idd=' + $('#anneeformation').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalagentsParAnnee').addClass('in');
                    $('#my-modalagentsParAnnee').css('display', 'block');
                }

            });
        }

        else if (($('#anneedebut').val() != ""))
        {
            $.ajax({
                url: '<?php echo url_for('planing/chargerAgnetsParAnneeDebut()') ?>',
                data: 'idd=' + $('#anneedebut').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalagentsParAnneeDebut').addClass('in');
                    $('#my-modalagentsParAnneeDebut').css('display', 'block');
                }

            });
        }

        else if (($('#idunite').val() != "") && ($('#iddirection_unite6').val() != ""))
        {
            $.ajax({
                url: '<?php echo url_for('planing/chargerAgnetsParUniteRegroupement()') ?>',
                data: 'idd=' + $('#idunite').val() + '&idregr=' + $('#iddirection_unite6').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalagentsUniteRegroupement').addClass('in');
                    $('#my-modalagentsUniteRegroupement').css('display', 'block');
                }

            });
        }

        else if (($('#idunite').val() != "") && ($('#idorganisme').val() != ""))
        {
            $.ajax({
                url: '<?php echo url_for('planing/chargerAgnetsParUniteOrganisme()') ?>',
                data: 'idd=' + $('#idunite').val() + '&idorganisme=' + $('#idorganisme').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalagentsUniteOrganisme').addClass('in');
                    $('#my-modalagentsUniteOrganisme').css('display', 'block');
                }

            });
        }

        else if (($('#idunite').val() != "") && (($('#idF').val() != "")))
        {
            $.ajax({
                url: '<?php echo url_for('planing/chargerAgnetsParUniteFormateur()') ?>',
                data: 'idd=' + $('#idunite').val() + '&idF=' + $('#idF').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalagentsUniteFormateur').addClass('in');
                    $('#my-modalagentsUniteFormateur').css('display', 'block');
                }

            });
        }
        else {
            if (($('#idunite').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('planing/chargerAgnetsParUnite()') ?>',
                    data: 'idd=' + $('#idunite').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modalagentsUnite').addClass('in');
                        $('#my-modalagentsUnite').css('display', 'block');
                    }

                });
            }

            else if (($('#iddirection_unite6').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('planing/chargerAgnetsParRegroppement()') ?>',
                    data: 'idd=' + $('#iddirection_unite6').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modalagentsFormation').addClass('in');
                        $('#my-modalagentsFormation').css('display', 'block');
                    }

                });
            }
            else if (($('#idorganisme').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('planing/chargerAgnetsParOrganisme()') ?>',
                    data: 'idd=' + $('#idorganisme').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modalagentsOrganisme').addClass('in');
                        $('#my-modalagentsOrganisme').css('display', 'block');
                    }

                });
            }
            else if (($('#idF').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('planing/chargerAgnetsParFormateur()') ?>',
                    data: 'idd=' + $('#idF').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modalagentsFormateur').addClass('in');
                        $('#my-modalagentsFormateur').css('display', 'block');
                    }

                });
            }


        }

        if (($('#idDomaine').val() != "") && ($('#idSousRubrique').val() != ""))
        {
            $.ajax({
                url: '<?php echo url_for('planing/chargerAgnetsParDomaineSousrubrique()') ?>',
                data: 'idd=' + $('#idDomaine').val() + '&idSousRubrique=' + $('#idSousRubrique').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalagentPardomaineSousRubrique').addClass('in');
                    $('#my-modalagentPardomaineSousRubrique').css('display', 'block');
                }

            });
        }
        else if (($('#idDomaine').val() != "") && ($('#idRubrique').val() != ""))
        {
            $.ajax({
                url: '<?php echo url_for('planing/chargerAgnetsParDomainerubrique()') ?>',
                data: 'idd=' + $('#idDomaine').val() + '&idRubrique=' + $('#idRubrique').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalagentPardomaineRubrique').addClass('in');
                    $('#my-modalagentPardomaineRubrique').css('display', 'block');
                }
            });
        }
        else if (($('#idSousRubrique').val() != "") && ($('#idRubrique').val() != ""))
        {
            $.ajax({
                url: '<?php echo url_for('planing/chargerAgnetsParSouRunriquerubrique()') ?>',
                data: 'idd=' + $('#idSousRubrique').val() + '&idRubrique=' + $('#idRubrique').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalagentParsousrubriquRubrique').addClass('in');
                    $('#my-modalagentParsousrubriquRubrique').css('display', 'block');
                }
            });
        }

        else {
            if (($('#idSousRubrique').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('planing/chargerAgnetsParSousrubrique()') ?>',
                    data: 'idd=' + $('#idSousRubrique').val(),
                    success: function (data) {
                        $('#zone_modal').html(data);
                        $('#my-modalagentSousrubrique').addClass('in');
                        $('#my-modalagentSousrubrique').css('display', 'block');
                    }

                });
            }
            else if (($('#idRubrique').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('planing/chargerAgnetsParRubrique()') ?>',
                    data: 'idd=' + $('#idRubrique').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modalagentRubrique').addClass('in');
                        $('#my-modalagentRubrique').css('display', 'block');
                    }

                });
            }

            else if (($('#idDomaine').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('planing/chargerAgnetsParDomaine()') ?>',
                    data: 'idd=' + $('#idDomaine').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modalagentPardomaine').addClass('in');
                        $('#my-modalagentPardomaine').css('display', 'block');
                    }

                });
            }
        }
    }
    function annuler(){
        $('#my-modaledition ').removeClass('in');
        $('#my-modaledition ').css('display', 'none');
        Initilaiser();
    }
    function Initilaiser(){
        $('#iddirection_unite6').val('');
        $('#direction_unite6').val('');

        $('#idorganisme').val('');
        $('#organisme').val('');

        $('#idF').val('');
        $('#idFormateur').val('');
        $('#formateur').val('');

        $('#idbesoins').val('');
        $('#besoins').val('');

        $('#idDomaine').val('');
        $('#idfonction').val('');
        $('#liebllefonction').val('');

        $('#idRubrique').val('');
        $('#idrubrique').val('');
        $('#rubrique').val('');

        $('#sousrubrique').val('');
        $('#idsousrubrique').val('');
        $('#idSousRubrique').val('');
        $('#anneedebut').val('');

        $('#anneeformation').val('');
        $('#idunite').val('');
        $('#unite').val('');
    }
</script>
<style>
    .table{margin-bottom: 0px;}
    label{font-weight: bold;}
    .smaller, .lighter, .blue, .no-margin{font-weight: bold;}
</style>