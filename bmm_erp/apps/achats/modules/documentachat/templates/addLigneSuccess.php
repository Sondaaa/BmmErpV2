<?php
$types_piece = Doctrine_Query::create()
        ->select("id,libelle")
        ->from('typepiececontrat')
        ->orderBy('id')
        ->execute();
?>
<tr id="ligne_0" index_ligne="0">
<input type="text" value="<?php echo $id_ligne; ?>" >

<input type="text" value="<?php echo $nordre; ?>">
<td></td>
<td name="col_number" style="text-align:center">0</td>

<td colspan="3" >
    <input type="text" value=""  id="designation_0" name="designation" class="form-control" placeholder="DESIGNATION" >

</td>
<td colspan="2" style="width: 100%"> <input type="hidden" id="id_typepiece_0" name="id_typepiece">
    <select id="typepiece_0" name="typepiece" onchange="selecttypepiece('#typepiece_0', '#id_typepiece_0')">
        <option id="0"></option>
        <?php foreach ($types_piece as $type): ?>
            <option value="<?php echo $type->getId() ?>"><?php echo $type->getLibelle() ?></option>
        <?php endforeach; ?>
    </select>
</td>
<td colspan="2"> 
    <select id="valeur_pourcetage_0" name="valeur_pourcetage" >
        <option id="0"></option>
        <option value="5">5%</option>
        <option value="10">10%</option>
        <option value="15">15%</option>
        <option value="20">20%</option>
        <option value="25">25%</option>
        <option value="30">30%</option>
        <option value="35">35%</option>
        <option value="40">40%</option>
        <option value="45">45%</option>
        <option value="50">50%</option>
        <option value="55">55%</option>
        <option value="60">60%</option>
        <option value="65">65%</option>
        <option value="70">70%</option>
        <option value="75">75%</option>
        <option value="80">80%</option>
        <option value="85">85%</option>
        <option value="90">90%</option>
        <option value="95">95%</option>
        <option value="100">100%</option>
    </select>
</td>
<td style="display:  none">
    <input type="text" id="taux_pourcentage_0" name="taux_pourcentage" value="">
</td>
<td colspan="3">
</td>
<td  colspan="2">
    <!--    <a class="btn  btn-xs  btn-primary" ng-click="AddDetailContrat()">
            <i class="fa fa-plus"></i>
        </a> -->
    <button type="button" class="btn   btn-xs  btn-danger" onclick="supprimerLigne()"><i class="fa fa-minus"></i></button>
</td>


</tr>

<script  type="text/javascript">
    function selecttypepiece(id1, id2) {
        if ($('#typepiece_0').val() != '') {
//            alert('ok');
//            $('#id_typepiece_0').val($('#typepiece_0').val());
            $(id1).after($('#typepiece_0').val());

        }
    }
    $('#ligne_compte_0').focus();
    $('input:text').not('[id="z_journal"]').attr('style', 'width: 100%;');
    ligneNumber('<?php echo $id_ligne; ?>', '<?php echo $nordre; ?>');
    function supprimerLigne() {
        $('#ligne_' + index_ligne).remove();
        $(this).remove();
        ligneNumber();

        formatLigne(0);
    }
    function ligneNumber() {
        //id_ligne, nordre
        var i = 1;
        $('#liste_ligne tbody tr').each(function () {
            var id = 'ligne_' + i;
            $(this).attr('id', id);
            $(this).attr('index_ligne', i);
            var format = 'formatLigne("' + i + '")';
            $(this).attr('onclick', format);
            i++;
        });
        var i = 1;
        $('[name="col_number"]').each(function () {
            $(this).text(i);
            i++;
        });

        var i = 1;
        $('[name="designation"]').each(function () {
            var id = 'designation_' + i;
            $(this).attr('id', id);
            var format = 'formatLigne("' + i + '")';
            $(this).attr('onclick', format);
            format = 'moveToNext(event, "ligne_compte", ' + i + ')';
            $(this).attr('onkeydown', format);
            i++;
        });
        var i = 1;
        $('[name="id_typepiece"]').each(function () {
            var id = 'id_typepiece_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="valeur_pourcetage"]').each(function () {
            var id = 'valeur_pourcetage_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="typepiece"]').each(function () {
            var id = 'typepiece_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="taux_pourcentage"]').each(function () {
            var id = 'taux_pourcentage_' + i;
            $(this).attr('id', id);
            i++;
        });


    }

    function formatLigne(index) {
        console.log('index=' + index);
        $('#liste_ligne tbody tr').each(function () {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });

        $('#ligne_' + index).css('background', '#E7E7E7');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
        index_ligne = $('#ligne_' + index).attr('index_ligne');



    }
</script>