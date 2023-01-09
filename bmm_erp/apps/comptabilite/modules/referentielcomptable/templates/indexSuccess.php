<div id="parametre">
    <ul>
        <!--        <li><a href="javascript:referentiel()" style="font-size: 14px;"> Rèfeèrentiel Comptable</a></li>-->
        <!--        <li><a href="javascript:activite()" style="font-size: 14px;">  Activité </a></li>
                <li><a href="javascript:nature()" style="font-size: 14px;"> Nature Pièce </a></li>-->

    </ul>


    <div id="ui-tabs-1">
        <?php include_partial('referentielcomptable/listeReferentiel', array('pager' => $pager)) ?> 
    </div>
    <div id="ui-tabs-2">
        <?php include_partial('referentielcomptable/listeDossierutilie', array('pager2' => $pager2)) ?> 
    </div>
    <div id="ui-tabs-3">
        <?php // include_partial('parametre_comptabilite/listeNature', array('pager3' => $pager3)) ?> 
    </div>
</div>

<div class="bpopup ui-dialog" id="suppression_referentiel" style="left: 30%; position: absolute; z-index: 9999; ">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
        <span id="ui-dialog-title-mws-jui-dialog" class="ui-dialog-title">Suppression</span>
    </div>
    <div align="center" style="padding: 40px 0px;font-size: 20px">
        <input type="hidden" id="element_supp_id_secteur" />
        Voulez vous supprimer ce Referentiel?
    </div>
    <div style="text-align: right" class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
        <input class="mws-button green mws-i-24 i-check large" type="button" value="Valider" onclick="validerSuppressionSecteur()" />
        <input class="mws-button black mws-i-24 i-cross large" type="button" value="Annuler" onclick="annulerSupprissionSecteur()" />
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
//    $("#parametre").tabs();
    function goPageReferentiel(page) {
        $('#image_loading').css('display', 'block');
        $.ajax({
            url: '<?php echo url_for('@goPageReferentiel') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#ui-tabs-1').html(data);
                $("table.mws-table tbody tr:even").addClass("even");
                $("table.mws-table tbody tr:odd").addClass("odd");
                $('#image_loading').css('display', 'none');
            }
        });
    }


    var libtempsecteur;
    function ModifierReferentiel(id, page) {
        if (id != '') {

            $("#button_enregistrer_secteur").val("Modifier");
            libtempsecteur = $("#libSecteur" + id).html();
            $("#pageSecteur").val(page);
            $("#libelleSecteur").val(libtempsecteur);
            $("#idSecteur").val(id);
        }
        else {
            $("#ModifSecteur").show();
        }
    }
//
    function AnnulerResetSecteur() {
        $("#idSecteur").val('');
        $("#libelleSecteur").val('');
        $("#button_enregistrer_secteur").val("Enregistrer");
    }
    function AjoutSecteur() {
        id = $("#idSecteur").val();
        lib = $("#libelleSecteur").val();
        page = $("#pageSecteur").val();
        if (lib == '') {
            $('#libellevide').bPopup();
        } else {
            $.ajax({
                url: '<?php echo url_for('referentiel/VerifierExistanceSecteur') ?>',
                data: 'lib=' + $('#libelleSecteur').val(),
                success: function (data) {
                    if (data != '0') {
                        $('#libelleexiste').bPopup();
                        return false;
                    }
                    else
                    {
                        if (id != '') {
                            $.ajax({
                                url: '<?php echo url_for('@modifSecteur') ?>',
                                data: 'id=' + id + '&lib=' + lib + '&page=' + page,
                                success: function (data) {
                                    $("#libSecteur" + id).html(data);
                                    AnnulerResetSecteur();
                                }
                            });
                        } else
                        {
//
                            $.ajax({
                                url: '<?php echo url_for('@ajoutSecteur') ?>',
                                data: 'lib=' + lib,
                                success: function (data) {
                                    $('#image_loading').css('display', 'none');
                                    $('#ui-tabs-1').html(data);
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



</script>