
<?php
$conge = Doctrine_Core::getTable('conge')->findOneByIdAgents($iddoc);
?>
<div id="sf_admin_container">
    <h1>Suivi Individuel des congés de "<?php echo $conge->getAgents()->getNomcomplet() . "  " . $conge->getAgents()->getPrenom(); ?>"</h1>
</div>

<fieldset>
    <table>

    </table>
</fieldset>
<fieldset id="liste_suivi"  >
    <table style="width: 100%; margin-bottom: 10px">
        <td>Choisir le Type Congé</td>
        <td>
            <select id="type_conge" class="chosen-select form-control" data-placeholder="Déterminez le type congé" onchange="afffichelisteindivudielle()" >
                <option value=""></option>                     
                <?php
                $type_conge = Doctrine_Core::getTable('typeconge')->findAll();
                ?>
                <?php foreach ($type_conge as $ty) { ?>
                    <option value="<?php echo $ty->getId(); ?>"><?php echo $ty->getLibelle(); ?></option>
                <?php } ?>
            </select>
            <input type="hidden" id="id_agents1" value="<?php echo $conge->getAgents()->getId(); ?>">
        </td>
        <td>Choisir l'Année</td>
        <td>
            <select id="annee_conge" class="chosen-select form-control" data-placeholder="Déterminez l'année" onchange="afffichelisteindivudielle()" >
                <option value=""></option>                  
                <?php for ($i = 2010; $i <= date('Y'); $i++): ?>
                    <option value="<?php echo $i; ?>" id="annee_<?php echo $i; ?>" ><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </td>
    </table>

</fieldset>
<fieldset id="liste_suiviindivudielle">
    <?php include_partial("liste_suiviindivudielle", array("typeconge" => $typeconge, "iddoc" => $iddoc,"annee_conge"=>$annee_conge)); ?>
</fieldset>
<script  type="text/javascript">

    function afffichelisteindivudielle() {
        $.ajax({
            url: '<?php echo url_for('conge/afficheSuiviListeParType') ?>',
            data: 'typeconge=' + $('#type_conge').val() + '&idagents=' + $('#id_agents1').val()+ '&annee_conge=' + $('#annee_conge').val(),
            success: function (data) {
                $('#liste_suiviindivudielle').html(data);
            }
        });
    }
</script>