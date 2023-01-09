<fieldset id="sf_fieldset_none">

    <div class="col-lg-4">
        <div>
            <label for="carnetordrepostal_daterecu">Date reçu du carnet</label>
            <div class="content"><input type="date" name="carnetordrepostal[daterecu]" id="carnetordrepostal_daterecu"></div>

        </div>
    </div>
    <div class="col-lg-4">
        <div>
            <label for="carnetordrepostal_refdepart">Référence 1èr ordre</label>
            <div class="content"><input type="text" name="carnetordrepostal[refdepart]" id="carnetordrepostal_refdepart" onchange="setLastReference()"></div>

        </div>
    </div>
    <div class="col-lg-4">
        <div>
            <label for="carnetordrepostal_reffin">Référence dernier ordre</label>
            <div class="content"><input type="text" name="carnetordrepostal[reffin]" id="carnetordrepostal_reffin" class="disabledbutton"></div>

        </div>
    </div>
    <?php $comptes = CaissesbanquesTable::getInstance()->getAllPoste(); ?>
    <div class="col-lg-4">
        <div>
            <label for="carnetordrepostal_id_compte">Compte CCP</label>
            <div class="content">
                <select name="carnetordrepostal[id_compte]" id="carnetordrepostal_id_compte" class="chosen-select form-control">
                    <option value="0"></option>
                    <?php foreach ($comptes as $compte): ?>
                        <option value="<?php echo $compte->getId(); ?>"><?php echo $compte->getLibelle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div>
            <label for="carnetordrepostal_nbrepapier">Nombre d'ordres</label>
            <div class="content"><input type="text" name="carnetordrepostal[nbrepapier]" id="carnetordrepostal_nbrepapier" onchange="setLastReference()"></div>

        </div>
    </div>
</fieldset>

<script  type="text/javascript">

    function setLastReference() {
        if ($('#carnetordrepostal_refdepart').val() != '' && $('#carnetordrepostal_nbrepapier').val() != '') {
            var last_reference = parseFloat($('#carnetordrepostal_refdepart').val()) + parseFloat($('#carnetordrepostal_nbrepapier').val()) - 1;
            last_reference = padDigits(last_reference, String($('#carnetordrepostal_refdepart').val()).length);
            $('#carnetordrepostal_reffin').val(last_reference);
        }
    }

    function padDigits(number, digits) {
        return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
    }

</script>