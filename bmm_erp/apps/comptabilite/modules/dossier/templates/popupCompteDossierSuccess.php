<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
    <span id="ui-dialog-title-mws-jui-dialog" class="ui-dialog-title" id="title_compte_dossier">Compte comptable de <?php echo $type ?></span>
    <a class="ui-dialog-titlebar-close ui-corner-all" href="#" role="button">
        <span class="ui-icon ui-icon-closethick bClose">close</span>
    </a>
</div>
<div class="content">
    <div class="mws-form-inline">
        <div class="mws-form-row">
            <label class="mws-form-label" style="width: 100%">Compte Comptable * :</label>
        </div>
    </div>
    <div class="mws-form-inline" style="margin-bottom: 15px;">
        <div class="mws-form-row" style="width: 100%">
            <select id="compte_edit" class="mws-select2 large" style="width: 85%">
                <option value="-1"></option>
                <?php foreach ($comptes as $compte): ?>
                    <option value="<?php echo $compte->getId() ?>" <?php if ($compte_id == $compte->getId()): ?>selected="selected"<?php endif; ?>><?php echo $compte->getNumeroCompte() . ' - ' . $compte->getLibelle() ?></option>
                <?php endforeach; ?>
            </select> 
        </div>
    </div>
    <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix" style="text-align: right">
        <input class="mws-button black mws-i-24 i-cross large" type="button" value="Annuler" onclick="annulerCompteDossier();" />
        <input class="mws-button red mws-i-24 i-check large" type="button" value="Modifier" onclick="saveCompteDossier();" />
    </div>
</div>

<script  type="text/javascript">

    $('#compte_edit').select2({placeholder: 'Compte Comptable'});

</script>