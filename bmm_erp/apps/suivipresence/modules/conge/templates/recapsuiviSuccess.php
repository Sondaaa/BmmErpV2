<div id="sf_admin_container">
    <h1>Suivi  Congé </h1>
</div>
<fieldset>
    <table>
        <tr>
            <td>Choisir l'Année</td>
            <td>
                <select id="conge_annee" class="chosen-select form-control" data-placeholder="Déterminez l'année" onchange="affficheliste()" >
                    <option value=""></option>                  
                    <?php for ($i = 2015; $i <= date('Y'); $i++): ?>
                        <option value="<?php echo $i; ?>" id="annee_<?php echo $i; ?>" ><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </td>
            <td>Choisir le Type Congé</td>
            <td>
                <select id="type_conge" class="chosen-select form-control" data-placeholder="Déterminez le type conge" onchange="affficheliste()" >
                    <option value=""></option>                     
                    <?php
                    $typeconge = Doctrine_Core::getTable('typeconge')->findAll();
                    ?>
                    <?php foreach ($typeconge as $ty) { ?>
                        <option value="<?php echo $ty->getId(); ?>"><?php echo $ty->getLibelle(); ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
    </table>
</fieldset>
<fieldset id="liste_suivi" >
<?php include_partial("liste_suivi", array("liste" => $liste)); ?>
</fieldset>

<script>

      function affficheliste() {
            $.ajax({
                url: '<?php echo url_for('conge/afficheSuiviListeParAnnee') ?>',
                data: 'anneconge=' + $('#conge_annee').val() +'&typeconge=' + $('#type_conge').val(),
                success: function (data) {
                    $('#liste_suivi').html(data);
                }
            });
    }

</script>
