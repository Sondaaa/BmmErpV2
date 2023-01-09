<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>
    <?php $entete = SocieteTable::getInstance()->find(1)->getRs(); ?>
</fieldset>
<div class="row">
    <div class="col-xs-12">
        <div class="widget-box" >
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Informations sur la Société</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px;">
                    <h4 style="text-align: center; font-weight: bold;"><?php echo $entete ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="details_declaration">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Entête Déclaration</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px;">
                    <table id="idformulaire" style="margin-bottom: 12px;">
                        <tr>
                            <td style="width: 30%;">
                                <label for="declaration_libelle">Libellé</label>
                                <input type="text" name="declaration[libelle]" id="declaration_libelle" maxlength="30">
                            </td>
                            <td style="width: 20%;">
                                <label for="declaration_datedebut">Date Début</label><br>
                                <input type="date" onchange="setAffiche()" value="<?php echo date('Y-m') . '-01' ?>" name="declaration[datedebut]" id="declaration_datedebut">
                            </td>
                            <td style="width: 20%;">
                                <label for="declaration_datefin">Date Fin</label><br>
                                <input type="date" onchange="setAffiche()" value="<?php echo date('Y-m-t') ?>" name="declaration[datefin]" id="declaration_datefin">
                            </td>
                            <td style="width: 15%;" class="disabledbutton">
                                <label for="declaration_montant">Montant Total</label>
                                <input type="text" name="declaration[montant]" id="declaration_montant" class="align_right">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <label for="declaration_libelle">Compte Bancaire / CCP</label>
                                <?php $banques = Doctrine_Core::getTable('caissesbanques')->findByIdTypecb(2); ?>
                                <select id="id_caissebanque" onchange="setAffiche()">
                                    <option value="0"></option>
                                    <?php foreach ($banques as $bn) { ?>
                                        <option value="<?php echo $bn->getId() ?>"><?php echo $bn ?></option>
                                    <?php } ?> 
                                </select>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <button onclick="chargerOrdonnance()" class="btn btn-sm btn-primary">
                                    <span class="bigger-110 no-text-shadow">Charger Ordonnances</span>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="ligne_declaration" style="display: none;">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Choix des Ordonnances de Paiement</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px;" id="liste_ordonnance">

                </div>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function setAffiche() {
        $('#liste_ordonnance').html('');
        $('#ligne_declaration').hide();
    }

    function chargerOrdonnance() {
        if ($('#declaration_datedebut').val() != '' && $('#declaration_datefin').val() != '' && $('#id_caissebanque').val() != '0') {
            $.ajax({
                url: '<?php echo url_for('declaration/chargerOrdonnance') ?>',
                data: 'date_debut=' + $('#declaration_datedebut').val() +
                        '&date_fin=' + $('#declaration_datefin').val() +
                        '&id_caissebanque=' + $('#id_caissebanque').val(),
                success: function (data) {
                    $('#liste_ordonnance').html(data);
                    $('#ligne_declaration').show();
                    $('#declaration_montant').val('0.000');
                }
            });
        } else {
            bootbox.dialog({
                message: "Veuillez vérifier les dates (début et fin) et le compte bancaire / CCP pour charger les ordonnances de paiement !",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                        }
            });
        }
    }

    var ids = '';
    function passerOrdonnance() {
        if ($('.list_checbox_ordonnance[type=checkbox]:checked').length != 0) {
            ids = '';
            $('.list_checbox_ordonnance[type=checkbox]:checked').each(function () {
                ids = ids + $(this).val() + ',';
            });
            $.ajax({
                url: '<?php echo url_for('declaration/chargerOrdonnanceChoisi') ?>',
                data: 'ids=' + ids,
                success: function (data) {
                    $('#liste_ordonnance').html(data);
                }
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir au moins une ordonnance de paiement !",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                        }
            });
        }
    }

    function saveOrdonnance() {
        if ($('#declaration_libelle').val() != '') {
            $.ajax({
                url: '<?php echo url_for('declaration/saveDeclaration') ?>',
                data: 'ids=' + ids +
                        '&libelle=' + $('#declaration_libelle').val() +
                        '&date_debut=' + $('#declaration_datedebut').val() +
                        '&date_fin=' + $('#declaration_datefin').val() +
                        '&id_caissebanque=' + $('#id_caissebanque').val() +
                        '&montant=' + $('#declaration_montant').val(),
                success: function (data) {
                    setAffiche();
                    bootbox.dialog({
                        message: "Déclaration enregistrée avec succès!",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                }
            });
        } else {
            bootbox.dialog({
                message: "Veuillez saisir le libellé du déclaration !",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                        }
            });
        }
    }

</script>