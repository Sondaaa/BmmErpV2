<div class="mws-panel grid_8" id="form_ajout_compte">
    <div class="mws-panel-body no-padding">
        <form>
            <div class="mws-form-inline" >
                <div class="mws-panel-header">
                    <span class="mws-i-24 i-list">Devise</span>
                </div>
                <div id="ui-tabs-5" class="ui-tabs-panel ui-widget-content ui-corner-bottom">
               <?php include_partial('devise/frmDevisFinale', array('pager5' => $pager5, 'UniterMonitaire' => $UniterMonitaire)) ?>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="bpopup ui-dialog" id="suppression_secteur" style="left: 30%; position: absolute; z-index: 9999; display: none;">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
        <span id="ui-dialog-title-mws-jui-dialog" class="ui-dialog-title">Suppression</span>
    </div>
    <div align="center" style="padding: 40px 0px;font-size: 20px">
        <input type="hidden" id="element_supp_id_secteur" />
        Voulez vous supprimer ce secteur d'activité ?
    </div>
    <div  class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix" style="text-align: right">
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
    function devise() {
        $('#image_loading').css('display', 'block');
        $.ajax({
            url: '<?php echo url_for('@listeDevise') ?>',
            success: function(data) {
                $('#image_loading').css('display', 'none');
                $("#generaleParam").html(data);
                $('#menuParamSousSte').hide();
            }
        });
    }
    function PaginationDevise(page) {
        $('#image_loading').css('display', 'block');
        $.ajax({
            url: '<?php echo url_for('@paginationDevise') ?>',
            data: 'page=' + page,
            success: function(data) {
                $('#ui-tabs-5').html(data);
                $("table.mws-table tbody tr:even").addClass("even");
                $("table.mws-table tbody tr:odd").addClass("odd");
                $('#image_loading').css('display', 'none');
                $('#menuParamSousSte').hide();
            }
        });
    }


    function AjouterDevise() {

        $('#image_loading').css('display', 'block');
        $.ajax({
            url: '<?php echo url_for('@ajouterDevise') ?>',
            success: function(data) {
                $('#image_loading').css('display', 'none');
                $("#listeDevi").html(data);

            }
        });
    }
    function EditDevise(id) {

        $('#image_loading').css('display', 'block');
        $.ajax({
            url: '<?php echo url_for('@editDevise') ?>',
            data: 'id=' + id,
            success: function(data) {
                $('#image_loading').css('display', 'none');
                $("#ui-tabs-5").html(data);
            }
        });

    }
    function SupDevise(id) {
        if (confirm("Vous désirez vraiment supprimer?")) {
            $('#image_loading').css('display', 'block');
            $.ajax({
                url: '<?php echo url_for('@supDevise') ?>',
                data: 'id=' + id,
                success: function(data) {
                    $('#image_loading').css('display', 'none');
                    $("#ui-tabs-5").html(data);
                }
            });
        }
    }
</script>