<div id="sf_admin_container" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="smaller lighter blue no-margin">Edition liste des Employés</h4>
            </div>
            <div class="modal-body">
                <fieldset class="col-lg-12" style="margin-bottom: 10px; margin-top: 5px; font-size: 14px;">
                    Presser " F1 <i class="ace-icon fa fa-keyboard-o bigger-110"></i> " ou " double click <i class="ace-icon fa fa-mouse-pointer bigger-110"></i> " dans la zone texte pour charger les motifs de recherche.
                </fieldset>
                <fieldset class="col-lg-6">
                    <table style="width: 100%">
                        <tr>
                        <input type="hidden" id="inpersonne">
                        <label><i>Employé Début</i> </label>
                        <td>
                            <input  readonly="true" id="iddebut" type="text" style="width: 70px" onchange="cahrgernom()" onkeydown="chargerpersonnlle(event, false)" ondblclick="chargerpersonnlle(event, true)"><!--ng-change="ChargerDetailNomByAgent()" -->
                        </td>
                        <td>
                            <input id="nomagentsdebut" type="text" style="width: 50px" class="disabledbutton">
                        </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                        <label><i>Employé Fin</i></label>
                        <input type="hidden" id="idp">
                        <td>
                            <input id="idfin"  readonly="true" type="text" style="width: 70px" onchange="cahrgernomfin()"  onkeydown="chargerpersonnlle2(event, false)" ondblclick="chargerpersonnlle2(event, true)">
                        </td>
                        <td>
                            <input id="nomagentsfin" type="text" style="width: 55px" class="disabledbutton">
                        </td>
                        </tr>
                    </table>
                    <table> 
                        <tr>
                        <h11><label><i>Direction</i></label></h11>

                        <td>
                            <input id="iddirection"  readonly="true" type="text" style="width: 70px" onchange="chargerdirection()"   onkeydown="chargerdi(event, false)" ondblclick="chargerdi(event, true)">
                        </td>
                        <td>
                            <input id="direction" type="text" style="width: 55px" class="disabledbutton">
                        </td>
                        </tr>
                    </table>
                    <table> 
                        <tr>
                        <h11><label><i>Sous Direction</i></label></h11>

                        <td>
                            <input id="idsousdirection"   readonly="true" type="text" style="width: 70px"    onkeydown="chargersousdirection(event, false)" ondblclick="chargersousdirection(event, true)">
                        </td>
                        <td>
                            <input id="libellesousdirection" type="text" style="width: 55px" class="disabledbutton">
                        </td>
                        </tr>
                    </table>



                </fieldset>
                <fieldset class="col-lg-6">
                    <table> 
                        <tr>
                        <h11><label><i>Service</i></label></h11>

                        <td>
                            <input id="idservice"  readonly="true" type="text" style="width: 70px"   onkeydown="chargerservice(event, false)" ondblclick="chargerservice(event, true)">
                        </td>
                        <td>
                            <input id="libelleservice" type="text" style="width: 65px" class="disabledbutton">
                        </td>
                        </tr>
                    </table>
                    <table> 
                        <tr>
                        <h11><label><i>Unité</i></label></h11>

                        <td>
                            <input id="idunite"  readonly="true" type="text" style="width: 70px"  onkeydown="chargerunite(event, false)" ondblclick="chargerunite(event, true)">
                        </td>
                        <td>
                            <input id="libelleunite" type="text" style="width: 65px" class="disabledbutton">
                        </td>
                        </tr>
                    </table>
                    <table> 
                        <tr>
                        <h11><label><i>Poste</i></label></h11>

                        <td>
                            <input id="idposte"  readonly="true" type="text" style="width: 70px"  onkeydown="chargerposte(event, false)" ondblclick="chargerposte(event, true)">
                        </td>
                        <td>
                            <input id="libelleposte" type="text" style="width: 65px" class="disabledbutton">
                        </td>
                        </tr>
                    </table>



                    <table style="margin-bottom: 20px;"> 
                        <tr>
                        <h11><label><i>Fonction</i></label></h11>

                        <td>
                            <input id="idfonction"  readonly="true" type="text" style="width: 70px" onkeydown="chargerfonctionRh(event, false)" ondblclick="chargerfonctionRh(event, true)">
                        </td>
                        <td>
                            <input id="liebllefonction" type="text" style="width: 65px" class="disabledbutton">
                        </td>
                        </tr>

                    </table>


                </fieldset>
                <div class="row"></div>
                <div class="modal-footer" >

                    <button type="button" value="Filtrer" id="btnfil" class="btn btn-sm btn-primary  pull-left" onclick="filtrer()">
                        Filtrer</button>




                    <!--                    <button type="button"  value="Imprimer" id="bntimp" class="btn  pull-left" >
                    
                                            Imprimer</button>-->


                    <button id="btnfermer" class="btn btn-sm  pull-right" data-dismiss="modal" onclick="annulerrh()">
                        Fermer
                    </button>
                    <button type="button" value="Initialiser"  class="btn  btn-sm btn-primary   pull-right" onclick="InitilaiserRH()">
                        Initialiser </button>
                </div>


            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->


</div>

<div id="my-modal6" class="modal fade" tabindex="-1" > 
    <?php
    include_partial('agents/agentstype', array());
    ?>
</div>
<div id="my-modal2" class="modal body" tabindex="1" > 
    <?php
    include_partial('agents/agentstype2', array());
    ?>
</div>
<div id="my-modal7" class="modal fade" tabindex="-1" > 
    <?php
    include_partial('direction/direction', array());
    ?>
</div>
<div id="my-modalsousdirection1" class="modal fade" tabindex="-1" > 
    <?php
    include_partial('sousdirection/sousdirection1', array());
    ?>
</div>
<div id="my-modalservice" class="modal fade" tabindex="-1" > 
    <?php
    include_partial('servicerh/service', array());
    ?>
</div>

<div id="my-modalunite" class="modal fade" tabindex="-1" > 
    <?php
    include_partial('unite/unite', array());
    ?>
</div>
<div id="my-modalposte" class="modal fade" tabindex="-1" > 
    <?php
    include_partial('posterh/poste', array());
    ?>
</div>
<div id="my-modalfonction" class="modal fade" tabindex="-1" > 
    <?php
    include_partial('fonction/fonction', array());
    ?>
</div>
<div id="zone_modal"> 
</div>

<script  type="text/javascript">
    function cahrgernom()
    {
        $.ajax({
            url: '<?php echo url_for('agents/AffichedetailNom') ?>',
            data: 'id=' + $('#iddebut').val(),
            success: function (data) {

                $('#nomagentsdebut').val(data);
            }
        });
    }

    function cahrgernomfin()
    {
        $.ajax({
            url: '<?php echo url_for('agents/AffichedetailNomFin') ?>',
            data: 'id=' + $('#idfin').val(),
            success: function (data) {

                $('#nomagentsfin').val(data);
            }
        });
    }

    function chargerdirection()
    {
        $.ajax({
            url: '<?php echo url_for('agents/Affichedetaildirection') ?>',
            data: 'id=' + $('#iddirection').val(),
            success: function (data) {

                $('#direction').val(data);
            }
        });
    }
    function chargerpersonnlle(e, dbclick)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modal6').addClass('in');
            $('#my-modal6').css('display', 'block');
        }
    }
    function chargerpersonnlle2(e, dbclick)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modal2').addClass('in');
            $('#my-modal2').css('display', 'block');
        }

    }
    function  chargerdi(e, dbclick)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112 || dbclick) {


            $('#my-modal7').addClass('in');
            $('#my-modal7').css('display', 'block');
//             "#my-modal" data-toggle="modal"
        }

    }
    function  chargersousdirection(e, dbclick)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            if ($('#iddirection').val() != "")
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargersousdirectionparDirection()') ?>',
                    data: 'idd=' + $('#iddirection').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modalsousdirectionpardirection').addClass('in');
                        $('#my-modalsousdirectionpardirection').css('display', 'block');
                    }

                });
            }
            else
            {
                $('#my-modalsousdirection1').addClass('in');
                $('#my-modalsousdirection1').css('display', 'block');
            }

        }

    }
    function  chargerservice(e, dbclick)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112 || dbclick) {

            if (($('#idsousdirection').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargerserviceDirectionorsousdirection()') ?>',
                    data: 'idd=' + $('#idsousdirection').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modalservicedirectionorsous').addClass('in');
                        $('#my-modalservicedirectionorsous').css('display', 'block');
                    }

                });
            }

            else if (($('#iddirection').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargerservicepardirection()') ?>',
                    data: 'idd=' + $('#iddirection').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modalservicepardirection').addClass('in');
                        $('#my-modalservicepardirection').css('display', 'block');
                    }

                });
            }

            else {
                $('#my-modalservice').addClass('in');
                $('#my-modalservice').css('display', 'block');
            }
        }

    }
    function  chargerunite(e, dbclick)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            if (($('#iddirection').val() != "") && ($('#idservice').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargerunitepardireactionetservice()') ?>',
                    data: 'idd=' + $('#iddirection').val() + '&id1=' + $('#idservice').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modalunitepardirectionetservice').addClass('in');
                        $('#my-modalunitepardirectionetservice').css('display', 'block');
                    }

                });
            }
            else if (($('#idsousdirection').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargeruniteparsousdireaction()') ?>',
                    data: 'idd=' + $('#idsousdirection').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modaluniteparsousdirection').addClass('in');
                        $('#my-modaluniteparsousdirection').css('display', 'block');
                    }

                });
            }
            else {
                if ($('#idservice').val() != "")
                {
                    $.ajax({
                        url: '<?php echo url_for('agents/chargeruniteparservice()') ?>',
                        data: 'idd=' + $('#idservice').val(),
                        success: function (data) {

                            $('#zone_modal').html(data);
                            $('#my-modaluniteparservice').addClass('in');
                            $('#my-modaluniteparservice').css('display', 'block');
                        }

                    });
                }
                if (($('#iddirection').val() != ""))
                {
                    $.ajax({
                        url: '<?php echo url_for('agents/chargerunitepardireaction()') ?>',
                        data: 'idd=' + $('#iddirection').val(),
                        success: function (data) {

                            $('#zone_modal').html(data);
                            $('#my-modalunitepardirection').addClass('in');
                            $('#my-modalunitepardirection').css('display', 'block');
                        }

                    });
                }
                else if (($('#iddirection').val() == "") && ($('#idservice').val() == ""))
                {
                    $('#my-modalunite').addClass('in');
                    $('#my-modalunite').css('display', 'block');
                }
            }
//           



        }

    }
    function  chargerposte(e, dbclick)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            if (($('#idunite').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargerposteparunite()') ?>',
                    data: 'idd=' + $('#idunite').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modalposteparunite').addClass('in');
                        $('#my-modalposteparunite').css('display', 'block');
                    }

                });
            }
            else if (($('#iddirection').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargerpostepardirection()') ?>',
                    data: 'idd=' + $('#iddirection').val(),
                    success: function (data) {
                        $('#zone_modal').html(data);
                        $('#my-modalpostepardirection').addClass('in');
                        $('#my-modalpostepardirection').css('display', 'block');
                    }

                });
            }
            else if (($('#idsousdirection').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargerposteparsousdirection()') ?>',
                    data: 'idd=' + $('#idsousdirection').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modalposteparsousdirection').addClass('in');
                        $('#my-modalposteparsousdirection').css('display', 'block');
                    }

                });
            }
            else if ($('#idservice').val() != "")
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargerposteparservice()') ?>',
                    data: 'idd=' + $('#idservice').val(),
                    success: function (data) {
                        $('#zone_modal').html(data);
                        $('#my-modalposteparservice').addClass('in');
                        $('#my-modalposteparservice').css('display', 'block');
                    }

                });
            }
            else
            {
                $('#my-modalposte').addClass('in');
                $('#my-modalposte').css('display', 'block');
            }
        }

    }
    function  chargerfonctionRh(e, dbclick)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modalfonction').addClass('in');
            $('#my-modalfonction').css('display', 'block');
        }

    }

    function  filtrer()
    {
        if (($('#inpersonne').val() == "" && $('#idp').val() != "") || ($('#idp').val() == "" && $('#inpersonne').val() != "")) {
            alert(" choisir les deux employés!!");
        }

        if ($('#idservice').val() == "" && $('#inpersonne').val() == "" && $('#idp').val() == "" && $('#idsousdirection').val() == ""
                && $('#iddirection').val() == "" && $('#idunite').val() == "" && $('#idposte').val() == "" && $('#idfonction').val() == ""
                ) {
            alert(" choisir au mois un champs de recherche !!");
        }

        if (($('#idservice').val() != "") && ($('#inpersonne').val() != "") && ($('#idp').val() != "")) {

            $.ajax({
                url: '<?php echo url_for('agents/chargerserviceetagents()') ?>',
                data: 'idd=' + $('#idservice').val() + '&id1=' + $('#inpersonne').val() + '&id2=' + $('#idp').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalagentsserviceetagents').addClass('in');
                    $('#my-modalagentsserviceetagents').css('display', 'block');
                }

            });
        }

        else if (($('#idsousdirection').val() != "") && ($('#inpersonne').val() != "") && ($('#idp').val() != ""))
        {
            $.ajax({
                url: '<?php echo url_for('agents/chargersousdirectionetagents()') ?>',
                data: 'idd=' + $('#idsousdirection').val() + '&id1=' + $('#inpersonne').val() + '&id2=' + $('#idp').val(),
                success: function (data) {
                    $('#zone_modal').html(data);
                    $('#my-modalagentssousdirectionetagents').addClass('in');
                    $('#my-modalagentssousdirectionetagents').css('display', 'block');
                }

            });
        }
        else if (($('#iddirection').val() != "") && ($('#inpersonne').val() != "") && ($('#idp').val() != ""))
        {

            $.ajax({
                url: '<?php echo url_for('agents/chargerdirectiondebutfin()') ?>',
                data: 'idd=' + $('#iddirection').val() + '&id1=' + $('#inpersonne').val() + '&id2=' + $('#idp').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalagentsdirectionetagents').addClass('in');
                    $('#my-modalagentsdirectionetagents').css('display', 'block');
                }
            });
        }

        else if (($('#inpersonne').val() != "") && ($('#idp').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrId()') ?>',
                data: 'id1=' + $('#inpersonne').val() + '&id2=' + $('#idp').val(),
                success: function (data) {

                    $('#zone_modal').html(data);
                    $('#my-modalfiltrage').addClass('in');
                    $('#my-modalfiltrage').css('display', 'block');
                }

            });
        }
        else {
            if (($('#idunite').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('agents/chargerunite()') ?>',
                    data: 'idd=' + $('#idunite').val(),
                    success: function (data) {
                        $('#zone_modal').html(data);
                        $('#my-modalagentsunite').addClass('in');
                        $('#my-modalagentsunite').css('display', 'block');
                    }

                });
            }
            else if (($('#idposte').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargerposte()') ?>',
                    data: 'idd=' + $('#idposte').val(),
                    success: function (data) {
                        $('#zone_modal').html(data);
                        $('#my-modalagentsposte').addClass('in');
                        $('#my-modalagentsposte').css('display', 'block');
                    }

                });
            }
            else if (($('#idfonction').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('agents/chargerfonction()') ?>',
                    data: 'idd=' + $('#idfonction').val(),
                    success: function (data) {
                        $('#zone_modal').html(data);
                        $('#my-modalagentsfonction').addClass('in');
                        $('#my-modalagentsfonction').css('display', 'block');
                    }

                });
            }
            else if (($('#idservice').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('agents/chargerservice()') ?>',
                    data: 'idd=' + $('#idservice').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modalagentsservice').addClass('in');
                        $('#my-modalagentsservice').css('display', 'block');
                    }

                });
            }
            else if (($('#iddirection').val() != ""))
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargerdirection()') ?>',
                    data: 'idd=' + $('#iddirection').val(),
                    success: function (data) {

                        $('#zone_modal').html(data);
                        $('#my-modalagentsdirection').addClass('in');
                        $('#my-modalagentsdirection').css('display', 'block');
                    }

                });
            }
            else if ($('#idsousdirection').val() != "")
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargersousdirection()') ?>',
                    data: 'idd=' + $('#idsousdirection').val(),
                    success: function (data) {
                        $('#zone_modal').html(data);
                        $('#my-modalagentssousdirection').addClass('in');
                        $('#my-modalagentssousdirection').css('display', 'block');
                    }

                });
            }
        }







    }

    function annulerrh()
    {

        $('#my-modal ').removeClass('in');
        $('#my-modal ').css('display', 'none');
        Initilaiser();
    }
    function InitilaiserRH()
    {
        $('#iddebut').val('');
        $('#inpersonne').val('');
        $('#nomagentsdebut').val('');

        $('#idp').val('');
        $('#idfin').val('');
        $('#nomagentsfin').val('');

        $('#iddirection').val('');
        $('#direction').val('');

        $('#idsousdirection').val('');
        $('#libellesousdirection').val('');

        $('#idservice').val('');
        $('#libelleservice').val('');

        $('#idunite').val('');
        $('#libelleunite').val('');
        $('#idposte').val('');
        $('#libelleposte').val('');

        $('#idfonction').val('');
        $('#liebllefonction').val('');


    }
</script>
<style>
    .table{margin-bottom: 0px;}
</style>