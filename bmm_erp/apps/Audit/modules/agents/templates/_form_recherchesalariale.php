<div id="sf_admin_container" ng-controller="CtrlRessourcehumaine">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Edition liste des Employés / Situation</h4>
            </div>
            <div class="modal-body">
                <fieldset class="col-lg-12" style="margin-bottom: 10px; margin-top: 5px; font-size: 14px;">
                    Presser " F1 <i class="ace-icon fa fa-keyboard-o bigger-110"></i> " ou " double click <i class="ace-icon fa fa-mouse-pointer bigger-110"></i> " dans la zone texte pour charger les motifs de recherche.
                </fieldset>
                <fieldset class="col-lg-6">
                    <h11><label><i>Situation administrative</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input id="idsituation" readonly="true" type="text" style="width: 45px" onkeydown="chargersituation(event)">
                            </td>
                            <td>
                                <input id="libellesituation" type="text" style="width: 55px" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Position administrative</i></label></h11>
                    <table>
                        <tr>
                            <td>
                                <input id="idposition" readonly="true" type="text" style="width: 45px" onkeydown="chargerpositio(event)">
                            </td>
                            <td>
                                <input id="libelleposition" type="text" style="width: 55px" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Lieu afféctation</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input id="idlieu" readonly="true" type="text" style="width: 45px" onkeydown="chargeelieu(event)">
                            </td>
                            <td>
                                <input id="lieu" type="text" style="width: 55px" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Prime</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input id="idprime" readonly="true" type="text" style="width: 45px" onkeydown="chargerprime(event)">
                            </td>
                            <td>
                                <input id="prime" type="text" style="width: 55px" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset class="col-lg-6">
                    <h11><label><i>Corps</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input id="idcorps" readonly="true" type="text" style="width: 45px" onkeydown="chargerecorps(event)">
                            </td>
                            <td>
                                <input id="corps" type="text" style="width: 55px" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Echelle</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input id="idechelle" readonly="true" type="text" style="width: 45px" onkeydown="chargerechelle(event)">
                            </td>
                            <td>
                                <input id="echelle" type="text" style="width: 55px" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Echelon</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input id="idechelon" readonly="true" type="text" style="width: 45px" onkeydown="chargerechelon(event)">
                            </td>
                            <td>
                                <input id="echelon" type="text" style="width: 55px" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Catégorie</i></label></h11>
                    <table> 
                        <tr>
                            <td>
                                <input id="idcategorie" readonly="true" type="text" style="width: 45px" onkeydown="chargerecat(event)">
                            </td>
                            <td>
                                <input id="categorie" type="text" style="width: 55px" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                    <h11><label><i>Grade</i></label></h11>
                    <table style="margin-bottom: 20px;"> 
                        <tr>
                            <td>
                                <input id="idgrade" readonly="true" type="text" style="width: 45px" onkeydown="chargeregrade(event)">
                            </td>
                            <td>
                                <input id="grade" type="text" style="width: 55px" class="disabledbutton">
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <div class="row"></div>
                <div class="modal-footer">
                    <button type="button" value="Filtrer" class="btn btn-primary pull-left" onclick="filtrer1()">
                        Filtrer</button>
                    <button type="button" value="Initialiser" class="btn btn-primary pull-left" onclick="Initilaiser1()">
                        Initialiser</button>
                    <button id="btnfermer" class="btn pull-right" data-dismiss="modal" onclick="fermer()">
                        Fermer</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="my-modalsituation" class="modal fade" tabindex="-1"> 
    <?php include_partial('posterh/situation', array()); ?>
</div>
<div id="my-modalposition" class="modal fade" tabindex="-1"> 
    <?php include_partial('posterh/position', array()); ?>
</div>
<div id="my-modalechelle" class="modal fade" tabindex="-1"> 
    <?php include_partial('echelle/echelle', array()); ?>
</div>
<div id="my-modalechelon" class="modal fade" tabindex="-1"> 
    <?php include_partial('echelon/echelon', array()); ?>
</div>
<div id="my-modalCat" class="modal fade" tabindex="-1"> 
    <?php include_partial('categorierh/cat', array()); ?>
</div>
<div id="my-modalGrade" class="modal fade" tabindex="-1"> 
    <?php include_partial('grade/grade', array()); ?>
</div>
<div id="my-modalLieu" class="modal fade" tabindex="-1"> 
    <?php include_partial('posterh/lieu', array()); ?>
</div>
<div id="my-modalprime" class="modal fade" tabindex="-1"> 
    <?php include_partial('primes/prime', array()); ?>
</div>
<div id="my-modalcorps" class="modal fade" tabindex="-1"> 
    <?php include_partial('corps/corps', array()); ?>
</div>
<div id="zone_modal2"> 
</div>

<script  type="text/javascript">

    function chargersituation(e)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112) {
            $('#my-modalsituation').addClass('in');
            $('#my-modalsituation').css('display', 'block');
        }
    }

    function chargerpositio(e)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112) {
            $('#my-modalposition').addClass('in');
            $('#my-modalposition').css('display', 'block');
        }
    }

    function chargerechelle(e)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112) {
            $('#my-modalechelle').addClass('in');
            $('#my-modalechelle').css('display', 'block');
        }
    }

    function  chargerprojet(e)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112) {
            $('#my-modalcorps').addClass('in');
            $('#my-modalcorps').css('display', 'block');
        }
    }

    function chargerecorps(e)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112) {
            $('#my-modalcorps').addClass('in');
            $('#my-modalcorps').css('display', 'block');
        }
    }
    function chargerechelon(e)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112) {
            $('#my-modalechelon').addClass('in');
            $('#my-modalechelon').css('display', 'block');
        }
    }

    function chargerecat(e)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112) {

            if ($('#idcorps').val() != "")
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargercatparcorps()') ?>',
                    data: 'idd=' + $('#idcorps').val(),
                    success: function (data) {

                        $('#zone_modal2').html(data);
                        $('#my-modalcatparcorps').addClass('in');
                        $('#my-modalcatparcorps').css('display', 'block');
                    }
                });
            }
            else {
                $('#my-modalCat').addClass('in');
                $('#my-modalCat').css('display', 'block');
            }
        }
    }
    function chargeregrade(e)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112) {
            if ($('#idcategorie').val() != "")
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargergradeparcat()') ?>',
                    data: 'idd=' + $('#idcategorie').val(),
                    success: function (data) {

                        $('#zone_modal2').html(data);
                        $('#my-modalgradeparcat').addClass('in');
                        $('#my-modalgradeparcat').css('display', 'block');
                    }
                });
            }
            else if ($('#idcorps').val() != "")
            {
                $.ajax({
                    url: '<?php echo url_for('agents/chargergradeparcorps()') ?>',
                    data: 'idd=' + $('#idcorps').val(),
                    success: function (data) {

                        $('#zone_modal2').html(data);
                        $('#my-modalgradeparcorps').addClass('in');
                        $('#my-modalgradeparcorps').css('display', 'block');
                    }
                });
            }
            else {
                $('#my-modalGrade').addClass('in');
                $('#my-modalGrade').css('display', 'block');
            }
        }
    }

    function chargeelieu(e)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112) {
            $('#my-modalLieu').addClass('in');
            $('#my-modalLieu').css('display', 'block');
        }
    }

    function chargerprime(e)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112) {
            $('#my-modalprime').addClass('in');
            $('#my-modalprime').css('display', 'block');
        }
    }
    function fermer()
    {
        $('#my-modal1 ').removeClass('in');
        $('#my-modal1 ').css('display', 'none');
        Initilaiser1();
    }
    function Initilaiser1()
    {
        $('#idsituation').val('');
        $('#libellesituation').val('');
        $('#idposition').val('');
        $('#libelleposition').val('');
        $('#idechelle').val('');
        $('#echelle').val('');
        $('#idechelon').val('');
        $('#echelon').val('');
        $('#idcategorie').val('');
        $('#categorie').val('');
        $('#idgrade').val('');
        $('#grade').val('');
        $('#idlieu').val('');
        $('#lieu').val('');
        $('#idprime').val('');
        $('#prime').val('');
        $('#idcorps').val('');
        $('#corps').val('');
    }
    function filtrer1() {
        if (($('#idcorps').val() != "") && ($('#idechelle').val() != "") && ($('#idechelon').val() != "") && ($('#idcategorie').val() != "") && ($('#idgrade').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetechelleechelonetcatgrade()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idechelle').val() + '&id3=' + $('#idechelon').val() + '&id4=' + $('#idcategorie').val() + '&id5=' + $('#idgrade').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetechelleetechelonetcategorigrade').addClass('in');
                    $('#my-modalfiltragecorpsetechelleetechelonetcategorigrade').css('display', 'block');
                }
            });
        }
        else if (($('#idcorps').val() != "") && ($('#idechelle').val() != "") && ($('#idechelon').val() != "") && ($('#idcategorie').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetechelleechelonetcat()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idechelle').val() + '&id3=' + $('#idechelon').val() + '&id4=' + $('#idcategorie').val(),
                success: function (data) {

                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetechelleetechelonetcategori').addClass('in');
                    $('#my-modalfiltragecorpsetechelleetechelonetcategori').css('display', 'block');
                }

            });
        }
        else if (($('#idcorps').val() != "") && ($('#idechelle').val() != "") && ($('#idcategorie').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetechellecat()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idechelle').val() + '&id3=' + $('#idcategorie').val(),
                success: function (data) {

                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetechelleetcat').addClass('in');
                    $('#my-modalfiltragecorpsetechelleetcat').css('display', 'block');
                }
            });
        }
        else if (($('#idcorps').val() != "") && ($('#idechelle').val() != "") && ($('#idgrade').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetechellegrade()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idechelle').val() + '&id3=' + $('#idgrade').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetechelleetgrade').addClass('in');
                    $('#my-modalfiltragecorpsetechelleetgrade').css('display', 'block');
                }

            });
        }
        else if (($('#idcorps').val() != "") && ($('#idechelon').val() != "") && ($('#idgrade').val() != "")) {

            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetechelongrade()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idechelon').val() + '&id3=' + $('#idgrade').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetechelonetgrade').addClass('in');
                    $('#my-modalfiltragecorpsetechelonetgrade').css('display', 'block');
                }
            });
        }
        else if (($('#idcorps').val() != "") && ($('#idechelon').val() != "") && ($('#idcategorie').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetecheloncat()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idechelon').val() + '&id3=' + $('#idcategorie').val(),
                success: function (data) {

                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetechelonetcat').addClass('in');
                    $('#my-modalfiltragecorpsetechelonetcat').css('display', 'block');
                }
            });
        }
        else if (($('#idgrade').val() != "") && ($('#idechelon').val() != "") && ($('#idcategorie').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrpargradeetecheloncat()') ?>',
                data: 'id1=' + $('#idgrade').val() + '&id2=' + $('#idechelon').val() + '&id3=' + $('#idcategorie').val(),
                success: function (data) {

                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecatetechelonetcat').addClass('in');
                    $('#my-modalfiltragecatetechelonetcat').css('display', 'block');
                }
            });
        }
        else if (($('#idcorps').val() != "") && ($('#idgrade').val() != "") && ($('#idcategorie').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetgradecat()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idgrade').val() + '&id3=' + $('#idcategorie').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetgradeetcat').addClass('in');
                    $('#my-modalfiltragecorpsetgradeetcat').css('display', 'block');
                }
            });
        }
        else if (($('#idcorps').val() != "") && ($('#idechelle').val() != "") && ($('#idechelon').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetechelleechelon()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idechelle').val() + '&id3=' + $('#idechelon').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetechelleetechelon').addClass('in');
                    $('#my-modalfiltragecorpsetechelleetechelon').css('display', 'block');
                }
            });
        }
        else if (($('#idcategorie').val() != "") && ($('#idechelle').val() != "") && ($('#idechelon').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcatetechelleechelon()') ?>',
                data: 'id1=' + $('#idcategorie').val() + '&id2=' + $('#idechelle').val() + '&id3=' + $('#idechelon').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecatetechelleetechelon').addClass('in');
                    $('#my-modalfiltragecatetechelleetechelon').css('display', 'block');
                }
            });
        }
        else if (($('#idgrade').val() != "") && ($('#idechelle').val() != "") && ($('#idechelon').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrpargradeetechelleechelon()') ?>',
                data: 'id1=' + $('#idgrade').val() + '&id2=' + $('#idechelle').val() + '&id3=' + $('#idechelon').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragegradeetechelleetechelon').addClass('in');
                    $('#my-modalfiltragegradeetechelleetechelon').css('display', 'block');
                }
            });
        }
        else if (($('#idcorps').val() != "") && ($('#idechelon').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetechelon()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idechelon').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetechelon').addClass('in');
                    $('#my-modalfiltragecorpsetechelon').css('display', 'block');
                }
            });
        }
        else if (($('#idcorps').val() != "") && ($('#idechelle').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetechelle()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idechelle').val(),
                success: function (data) {

                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetechelle').addClass('in');
                    $('#my-modalfiltragecorpsetechelle').css('display', 'block');
                }
            });
        }
        else if (($('#idcorps').val() != "") && ($('#idgrade').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetgrade()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idgrade').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetgrade').addClass('in');
                    $('#my-modalfiltragecorpsetgrade').css('display', 'block');
                }
            });
        }
        else if (($('#idgrade').val() != "") && ($('#idcategorie').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegregradecat()') ?>',
                data: 'id1=' + $('#idgrade').val() + '&id2=' + $('#idcategorie').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragegrdaecat').addClass('in');
                    $('#my-modalfiltragegrdaecat').css('display', 'block');
                }
            });
        }
        else if (($('#idcorps').val() != "") && ($('#idcategorie').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetcategorie()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idcategorie').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetcat').addClass('in');
                    $('#my-modalfiltragecorpsetcat').css('display', 'block');
                }
            });
        }
        else if (($('#idechelle').val() != "") && ($('#idechelon').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparechelleechelon()') ?>',
                data: 'id1=' + $('#idechelle').val() + '&id2=' + $('#idechelon').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltrageechellechelon').addClass('in');
                    $('#my-modalfiltrageechellechelon').css('display', 'block');
                }
            });
        }
        else if (($('#idechelle').val() != "") && ($('#idcategorie').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparechellecat()') ?>',
                data: 'id1=' + $('#idechelle').val() + '&id2=' + $('#idcategorie').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltrageechellecat').addClass('in');
                    $('#my-modalfiltrageechellecat').css('display', 'block');
                }
            });
        }
        else if (($('#idechelle').val() != "") && ($('#idgrade').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparechellegrade()') ?>',
                data: 'id1=' + $('#idechelle').val() + '&id2=' + $('#idgrade').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltrageechellegrade').addClass('in');
                    $('#my-modalfiltrageechellegrade').css('display', 'block');
                }
            });
        }
        else if (($('#idechelon').val() != "") && ($('#idcategorie').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparecheloncat()') ?>',
                data: 'id1=' + $('#idechelon').val() + '&id2=' + $('#idcategorie').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltrageecheloncat').addClass('in');
                    $('#my-modalfiltrageecheloncat').css('display', 'block');
                }
            });
        }
        else if (($('#idechelon').val() != "") && ($('#idgrade').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparechelongrade()') ?>',
                data: 'id1=' + $('#idechelon').val() + '&id2=' + $('#idgrade').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltrageechelongrade').addClass('in');
                    $('#my-modalfiltrageechelongrade').css('display', 'block');
                }
            });
        }
        else if (($('#idcategorie').val() != "") && ($('#idgrade').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcategoriegrade()') ?>',
                data: 'id1=' + $('#idcategorie').val() + '&id2=' + $('#idgrade').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecategoriegrade').addClass('in');
                    $('#my-modalfiltragecategoriegrade').css('display', 'block');
                }
            });
        }

        else if (($('#idcorps').val() != "") && ($('#idsituation').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetsituation()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idsituation').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetsituation').addClass('in');
                    $('#my-modalfiltragecorpsetsituation').css('display', 'block');
                }
            });
        }
        else if (($('#idcorps').val() != "") && ($('#idlieu').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetlieu()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idlieu').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetlieu').addClass('in');
                    $('#my-modalfiltragecorpsetlieu').css('display', 'block');
                }
            });
        }
        else if (($('#idcorps').val() != "") && ($('#idposition').val() != "")) {

            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetposition()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idposition').val(),
                success: function (data) {

                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetposition').addClass('in');
                    $('#my-modalfiltragecorpsetposition').css('display', 'block');
                }

            });
        }
        else if (($('#idcorps').val() != "") && ($('#idprime').val() != "")) {
            $.ajax({
                url: '<?php echo url_for('agents/charegrparcorpsetprime()') ?>',
                data: 'id1=' + $('#idcorps').val() + '&id2=' + $('#idprime').val(),
                success: function (data) {
                    $('#zone_modal2').html(data);
                    $('#my-modalfiltragecorpsetprime').addClass('in');
                    $('#my-modalfiltragecorpsetprime').css('display', 'block');
                }
            });
        }
        else
        {
            if ($('#idcorps').val() != "") {
                $.ajax({
                    url: '<?php echo url_for('agents/charegrparcorps()') ?>',
                    data: 'id1=' + $('#idcorps').val(),
                    success: function (data) {
                        $('#zone_modal2').html(data);
                        $('#my-modalfiltragecorps1').addClass('in');
                        $('#my-modalfiltragecorps1').css('display', 'block');
                    }
                });
            }
            else if (($('#idechelle').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('agents/charegrechelle()') ?>',
                    data: 'id1=' + $('#idechelle').val(),
                    success: function (data) {
                        $('#zone_modal2').html(data);
                        $('#my-modalfiltrageechele').addClass('in');
                        $('#my-modalfiltrageechele').css('display', 'block');
                    }
                });
            }
            else if (($('#idechelon').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('agents/charegrechelon()') ?>',
                    data: 'id1=' + $('#idechelon').val(),
                    success: function (data) {
                        $('#zone_modal2').html(data);
                        $('#my-modalfiltrageechelon').addClass('in');
                        $('#my-modalfiltrageechelon').css('display', 'block');
                    }
                });
            }
            else if (($('#idgrade').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('agents/charegregrade()') ?>',
                    data: 'id1=' + $('#idgrade').val(),
                    success: function (data) {
                        $('#zone_modal2').html(data);
                        $('#my-modalfiltragegrade').addClass('in');
                        $('#my-modalfiltragegrade').css('display', 'block');
                    }
                });
            }
            else if (($('#idcategorie').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('agents/charegrecat()') ?>',
                    data: 'id1=' + $('#idcategorie').val(),
                    success: function (data) {
                        $('#zone_modal2').html(data);
                        $('#my-modalfiltragecat').addClass('in');
                        $('#my-modalfiltragecat').css('display', 'block');
                    }
                });
            }
            else if (($('#idsituation').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('agents/charegrsituation()') ?>',
                    data: 'id1=' + $('#idsituation').val(),
                    success: function (data) {

                        $('#zone_modal2').html(data);
                        $('#my-modalfiltragesituation').addClass('in');
                        $('#my-modalfiltragesituation').css('display', 'block');
                    }
                });
            }
            else if (($('#idposition').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('agents/charegrposition()') ?>',
                    data: 'id1=' + $('#idposition').val(),
                    success: function (data) {

                        $('#zone_modal2').html(data);
                        $('#my-modalfiltrageposition').addClass('in');
                        $('#my-modalfiltrageposition').css('display', 'block');
                    }
                });
            }
            else if (($('#idlieu').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('agents/chargerllieu()') ?>',
                    data: 'id1=' + $('#idlieu').val(),
                    success: function (data) {

                        $('#zone_modal2').html(data);
                        $('#my-modalfiltragelieutravail').addClass('in');
                        $('#my-modalfiltragelieutravail').css('display', 'block');
                    }
                });
            }
            else if (($('#idprime').val() != "")) {
                $.ajax({
                    url: '<?php echo url_for('agents/charegreprimes()') ?>',
                    data: 'id1=' + $('#idprime').val(),
                    success: function (data) {
                        $('#zone_modal2').html(data);
                        $('#my-modalfiltrageprime').addClass('in');
                        $('#my-modalfiltrageprime').css('display', 'block');
                    }
                });
            }
        }
    }

</script>

<style>
    .table{margin-bottom: 0px;}
</style>