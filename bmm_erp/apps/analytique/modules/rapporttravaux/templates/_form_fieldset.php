<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>

    <div class="col-lg-4" style="display: none;">
        <div>
            <label for="rapporttravaux_date">Date Création :</label>
            <div class="content">
                <input type="date" value="<?php if (!$form->isNew()): ?><?php echo $rapporttravaux->getAnnee(); ?><?php else: ?><?php echo date('Y-m-d'); ?><?php endif; ?>" readonly="true" name="rapporttravaux[date]" id="rapporttravaux_date">
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div>
            <label for="rapporttravaux_annee">Année :</label>
            <div class="content">
                <input type="text" value="<?php if (!$form->isNew()): ?><?php echo $rapporttravaux->getAnnee(); ?><?php endif; ?>" name="rapporttravaux[annee]" id="rapporttravaux_annee">
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div>
            <label for="rapporttravaux_id_type">Service :</label>
            <div class="content">
                <?php $types = TyperapportTable::getInstance()->findAll(); ?>
                <select name="rapporttravaux[id_type]" id="rapporttravaux_id_type">
                    <option value="0" selected="selected"></option>
                    <?php foreach ($types as $type): ?>
                        <option value="<?php echo $type->getId(); ?>"><?php echo $type; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div>
            <label for="rapporttravaux_libelle">Libellé</label>
            <div class="content">
                <textarea rows="2" cols="30" name="rapporttravaux[libelle]" id="rapporttravaux_libelle" class="form-control"><?php if (!$form->isNew()): ?><?php echo $rapporttravaux->getLibelle(); ?><?php endif; ?></textarea>
            </div>
        </div>
    </div>
</fieldset>

<script  type="text/javascript">

    $("#rapporttravaux_annee").mask('9999');
<?php if (!$form->isNew()): ?>
        $('#rapporttravaux_id_type').val('<?php echo $rapporttravaux->getIdType(); ?>').trigger("liszt:updated");
        $('#rapporttravaux_id_type').trigger("chosen:updated");
<?php endif; ?>

</script>