<div id="ModifCompte" style="position: relative; top:10px; display: block">
    <table style="width:100%">
        <tr>
            <td style="width:30%">
                <div class="mws-form-row">
                    <label>Code : <font color="red" title="Ce champ est requis.">*</font></label>
                    <div class="mws-form-item small">
                        <input id="codeCompte" class="mws-textinput required valid " type="text" style="width:100%">
                    </div>
                </div>
            </td>

            <td style="width:40%">
                <div class="mws-form-row">
                    <label>Libellé : <font color="red" title="Ce champ est requis.">*</font></label>
                    <div class="mws-form-item small">
                        <input id="libelleCompte" class="mws-textinput required valid " type="text" style="width:100%">
                    </div>
                </div>
            </td>
            <td>
                <a id="button_enregistrer_compte" class="btn" style="float: right; cursor:pointer; margin-right: 1%;" onclick="AjoutCompte()"><i class="icol-add"></i> Enregistrer </a>

            </td>
            <td>
                <a id="button_Annuler_compte" class="btn" style="float: left; margin-right: 3%; cursor:pointer;" onclick="AnnulerResetCompte()"><i class="icol-cross"></i> Annuler </a>

            </td>

        </tr>
    </table>
    <input id="idCompte" type="hidden">
    <input id="pageCompte" type="hidden">
</div>

<div class="mws-panel grid_8" style="margin-top:20px;">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-list">Liste des types de Compte </span>
    </div>
    <div class="mws-panel-body">
        <table id="" class="mws-datatable-fn mws-table">
            <thead>
                <tr>
                    <th style="width: 30%;">Code</th>
                    <th style="width: 50%;">Libellé</th>
                    <th style="width: 10%; text-align: center;">Opérations</th>
                </tr>

            </thead>
            <tfoot>
                <tr>
                    <td style="width: 100%;padding: 0" colspan="3">
                        <div id="list_pager_compte" style="background: none repeat scroll 0 0 #444444;width: 100%;float: left">

                        </div>
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php include_partial('parametre/laListeCompte', array('pager8' => $pager8)) ?>
                </tfoot>
        </table>
    </div>
</div>
<script  type="text/javascript">

    function deleteCompte(id) {
        $("#element_supp_id_compte").val(id);
        $('#suppression_compte').bPopup();
    }
    function validerSuppressionCompte() {

        $.ajax({
            url: '<?php echo url_for('@deleteCompte') ?>',
            data: 'id=' + $("#element_supp_id_compte").val(),
            success: function(data) {
                $('#ui-tabs-8').html(data);
                annulerSupprissionCompte();
            }
        });

    }
    function annulerSupprissionCompte() {
        $('#suppression_compte').bPopup().close();
        $("#element_supp_id_compte").val('');
        $('#suppression_compte').fadeOut();
    }

</script>