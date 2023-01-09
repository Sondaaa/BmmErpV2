<fieldset id="sf_fieldset_none">
    <div class="col-lg-4">
        <div>
            <label for="carnetcheque_daterecu">Date reçu du carnet</label>
            <div class="content">
                <input type="date" name="carnetcheque[daterecu]" id="carnetcheque_daterecu">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div>
            <label for="carnetcheque_refdepart">Référence 1èr chèque</label>
            <div class="content">
                <input type="text" name="carnetcheque[refdepart]" id="carnetcheque_refdepart" onchange="setLastReference()">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div>
            <label for="carnetcheque_reffin">Référence dernier chèque</label>
            <div class="content">
                <input type="text" name="carnetcheque[reffin]" id="carnetcheque_reffin" class="disabledbutton">
            </div>
        </div>
    </div>
    <?php $comptes = CaissesbanquesTable::getInstance()->getAllBanque(); ?>
    <div class="col-lg-4">
        <div>
            <label for="carnetcheque_id_banque">Banque / CCP</label>
            <div class="content">
                <select name="carnetcheque[id_banque]" id="carnetcheque_id_banque" class="chosen-select form-control">
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
            <label for="carnetcheque_nbrepapier">Nombre de chèques</label>
            <div class="content">
                <input data-type="nombre" type="text" name="carnetcheque[nbrepapier]" id="carnetcheque_nbrepapier" onchange="setLastReference()">
            </div>
        </div>
    </div>
</fieldset>

<script>

    function setLastReference() {
        if ($('#carnetcheque_refdepart').val() != '' && $('#carnetcheque_nbrepapier').val() != '') {
            var last_reference = parseFloat($('#carnetcheque_refdepart').val()) + parseFloat($('#carnetcheque_nbrepapier').val()) - 1;
            last_reference = padDigits(last_reference, String($('#carnetcheque_refdepart').val()).length);
            $('#carnetcheque_reffin').val(last_reference);
        }
    }

    function padDigits(number, digits) {
        return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
    }

</script>