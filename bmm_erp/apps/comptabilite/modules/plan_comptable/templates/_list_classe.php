<select id="classe_compte" class="mws-select2 large" style="width: 85%">
    <option value="-1"></option>
    <?php foreach ($classes as $classe): ?>
        <option value="<?php echo $classe->getId() ?>"><?php echo $classe->getLibelle() ?></option>
    <?php endforeach; ?>
</select>

<script  type="text/javascript">
    $('#classe_compte').select2({placeholder: 'Classe'});
     $("#classe_compte").change(function() {
        var classe_id = $(this).val();
        getComptesClasse(classe_id);
        var compte_id = $("#compte_classe").val();
        updateNumeroCompte(classe_id, compte_id);
    });
</script>