<div class="mws-panel grid_8" id="form_ajout_compte">
    <div class="mws-panel-body no-padding">
        <form>
            <div class="mws-form-inline" >
                <div class="mws-panel-header">
                    <span class="mws-i-24 i-list">Type de Compte</span>
                </div>
                <div id="ui-tabs-8">
                    <?php include_partial('parametre/listeCompte', array('pager8' => $pager8)) ?> 
                </div>
            </div>
        </form>
    </div>
</div>

<div class="bpopup ui-dialog" id="suppression_compte" style="left: 30%; position: absolute; z-index: 9999; display: none;">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
        <span id="ui-dialog-title-mws-jui-dialog" class="ui-dialog-title">Suppression</span>
    </div>
    <div align="center" style="padding: 40px 0px;font-size: 20px">
        <input type="hidden" id="element_supp_id_compte" />
        Voulez vous supprimer ce type Compte ?
    </div>
    <div  class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix" style="text-align: right">
        <input class="mws-button green mws-i-24 i-check large" type="button" value="Valider" onclick="validerSuppressionCompte()" />
        <input class="mws-button black mws-i-24 i-cross large" type="button" value="Annuler" onclick="annulerSupprissionCompte()" />
    </div>
</div>
<div class="bpopup ui-dialog" id="libelleexiste" style="left: 30%; position: absolute; z-index: 9999; display: none;">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
        <span id="ui-dialog-title-mws-jui-dialog" class="ui-dialog-title">Libéllé existe déjà</span>
    </div>
    <div align="center" style="padding: 40px 0px;font-size: 20px; color: red;">
        <input type="hidden" id="element_supp_id" />
        Libellé existe déjà, veuillez saisir un autre libellé!
    </div>
    <div style="text-align: right" class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
        <input class="mws-button green mws-i-24 i-check large" type="button" value="Femrer" onclick="fermererreurlibelle()" />
    </div>
</div>

<div class="bpopup ui-dialog" id="libellevide" style="left: 30%; position: absolute; z-index: 9999; display: none;">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
        <span id="ui-dialog-title-mws-jui-dialog" class="ui-dialog-title">Champs vides</span>
    </div>
    <div align="center" style="padding: 40px 0px;font-size: 20px; color: red;">
        <input type="hidden" id="element_supp_id" />
        Veuillez remplir tous les champs!
    </div>
    <div style="text-align: right" class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
        <input class="mws-button green mws-i-24 i-check large" type="button" value="Fermer" onclick="fermererreurlibellevide()" />
    </div>
</div>

<script  type="text/javascript">
    function goPageCompte(page) {
        $('#image_loading').css('display', 'block');
        $.ajax({
            url: '<?php echo url_for('@goPageCompte') ?>',
            data: 'page=' + page,
            success: function(data) {
                $('#ui-tabs-8').html(data);
                $("table.mws-table tbody tr:even").addClass("even");
                $("table.mws-table tbody tr:odd").addClass("odd");
                $('#image_loading').css('display', 'none');
            }
        });
    }
    var libtempcompte;
    var codetempcompte;
    function ModifierCompte(id, page) {
    $('#libelleCompte').css('border', '');
        if (id != '') {

            $("#button_enregistrer_compte").val("Modifier");
            libtempcompte = $("#libCompte" + id).html();
            codetempcompte = $("#codCompte" + id).html();
            $("#pageCompte").val(page);
            $("#libelleCompte").val(libtempcompte);
            $("#codeCompte").val(codetempcompte);
            $("#idCompte").val(id);
        }
        else {
            $("#ModifCompte").show();
        }
    }

    function AnnulerResetCompte() {
        $('#libelleCompte').css('border', '');
        $('#codeCompte').css('border', '');
        $("#idCompte").val('');
        $("#libelleCompte").val('');
        $("#codeCompte").val('');
        $("#button_enregistrer_compte").val("Enregistrer");
    }

    function AjoutCompte() {
        id = $("#idCompte").val();
        lib = $("#libelleCompte").val();
        code = $("#codeCompte").val();
        page = $("#pageCompte").val();
        if (lib == '' || code == '') {
            verifierFormCompte();
        } else {
            $.ajax({
                url: '<?php echo url_for('parametre/VerifierExistanceCompte') ?>',
                data: 'lib=' + $('#libelleCompte').val(),
                success: function(data) {
                    if (data != '0') {
                        $('#libelleexiste').bPopup();
                        return false;
                    }
                    else
                    {
                        if (id != '') {
                            $.ajax({
                                dataType: 'json',
                                url: '<?php echo url_for('@modifCompte') ?>',
                                data: 'id=' + id + '&lib=' + lib + '&code=' + code + '&page=' + page,
                                success: function(data) {
                                    $("#libCompte" + id).html(data.lib);
                                    $("#codCompte" + id).html(data.cod);
                                    AnnulerResetCompte();
                                }
                            });
                        } else
                        {

                            $.ajax({
                                url: '<?php echo url_for('@ajoutCompte') ?>',
                                data: 'lib=' + lib+'&code=' + code,
                                success: function(data) {
                                    $('#image_loading').css('display', 'none');
                                    $('#ui-tabs-8').html(data);
                                }
                            });
                        }
                    }
                }

            });

        }
    }

     function fermererreurlibelle() {
        $('#libelleexiste').bPopup().close();
    }
    function fermererreurlibellevide() {
        $('#libellevide').bPopup().close();
    }
    
    function verifierFormCompte() {
        if ($('#libelleCompte').val() != '') {
            $('#libelleCompte').css('border', '');
        }
        else {
            $('#libelleCompte').css('border', '3px solid red');
        }
        
        if ($('#codeCompte').val() != '') {
            $('#codeCompte').css('border', '');
        }
        else {
            $('#codeCompte').css('border', '3px solid red');
        }
    }
</script>