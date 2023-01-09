<select id="compte_classe" class="mws-select2 large" style="width: 85%">
    <option value="-1"></option>
    <?php foreach ($comptesclasse as $compteclass): ?>
         <option value="<?php echo $compteclass->getNumeroCompte() ?>"><?php echo $compteclass->getNumeroCompte() . ' - ' . $compteclass->getLibelle(); ?></option>
    <?php endforeach; ?>
</select>

<script  type="text/javascript">
    $('#compte_classe').select2({placeholder: 'Compte'});
    $("#compte_classe").change(function() {
        var compte_id = $(this).val();
        var classe_id = $("#classe_compte").val();
        updateNumeroCompte(classe_id, compte_id);

    });
</script>