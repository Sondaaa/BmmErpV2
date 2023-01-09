<span class="bigger-120 blue">Déterminer les comptes comptables pour la section note :</span>

<div class="row" style="padding-left: 30px; padding-top: 20px; color: #c42b2b;">Veuillez <b>décaucher</b> les comptes comptables destinés au section <b>note</b></div>

<div class="col-md-8">
    <fieldset style="border:solid 1px #003300;padding: 1%">
        <legend>Regroupement!</legend>
        <table border="1" >
            <tr>
                <td><input  type="text" id="next_lettre"></td>
                <td>
                    <button style="cursor:pointer;" onclick="regrouper()" class="btn btn-sm btn-default">
                        <span class="bigger-110 no-text-shadow">Regrouper</span>
                    </button>
                    <button style="cursor:pointer;" onclick="deletelibelle()" class="btn btn-sm btn-default">
                        <span class="bigger-110 no-text-shadow">Annuler</span>
                    </button>
                </td>
            </tr>
        </table>
    </fieldset>
</div><table class="table table-bordered table-hover" style="margin-bottom: 0px;" id="myTable_<?php echo $index; ?>">
    <thead>
        <tr>
            <th colspan="6" style="text-align: center; vertical-align: middle;">
                Du compte N° <?php echo $compte_min; ?> jusqu'au compte N° <?php echo $compte_max; ?>
                <button class="btn btn-xs btn-primary" style="float: right; margin-top: -5px; margin-bottom: -5px;" onclick="chargerToutCompte('R')"><i class="ace-icon fa fa-repeat"></i> Charger Tout</button>
            </th>
        </tr>
    <div class="row">

        <tr>
            <th style="width: 5%; text-align: center;">
                <input id="check_input" type="checkbox" idientifiant="" onchange="setCheckAll()"/>
            </th>
            <th style="width: 10%;">Numéro</th>
            <th style="width: 40%;">Intitulé du Compte</th>
            <th style="width: 20%;">Regroupement Note</th>
            <th style="width: 20%;">Classe</th>
            <th style="width: 5%;"></th>
        </tr>
        </thead>
</table>
<div style="height: 300px; overflow: auto;">
    <table class="table table-bordered table-hover" id="myTable_<?php echo $index; ?>">
        <tbody>
            <?php foreach ($comptes as $i => $compte): ?>
                <?php
                $checked = true;
                $regr='';
                if ($parametre_id != '') {
                    $Parametrebilancompte = ParametrebilancompteTable::getInstance()->findByIdCompteAndIdParametrebilan($compte->getId(), $parametre_id)->getFirst();
                    if ($Parametrebilancompte) {
                        if ($Parametrebilancompte->getType() == 0)
                            $checked = false;
                         if($Parametrebilancompte->getRegrouppement()&& $Parametrebilancompte->getRegrouppement()!='')
                            $regr=$Parametrebilancompte->getRegrouppement();
                    }else {
                        $checked = false;
                    }
                }
                ?>
                <tr id="tr_<?php echo $i; ?>" class="ligne_compte">
                    <td style="width: 5%; text-align: center;"> <input <?php if ($checked): ?>checked="checked"<?php endif; ?> id="check_input_<?php echo $compte->getId(); ?>" class="list_checbox_compte" value="<?php echo $compte->getId(); ?>" type="checkbox" idientifiant="<?php echo $compte->getId() ?>" onclick="addId()"/> </td>
                    <td style="width: 10%;"><b><?php echo $compte->getNumerocompte(); ?></b>
                        <input type="hidden" name="compte_dossier" value="<?php echo $compte->getId(); ?>"/>
                    </td>
                    <td style="width: 40%;"><?php echo $compte->getLibelle(); ?></td>
                    <td style="width: 20%;">
                        <input type="text" value="<?php echo $regr; ?>" name="regrouppement" id="regrouppement_<?php echo $compte->getId(); ?>">
                    </td>
                    <td style="width: 20%;"><?php echo $compte->getPlancomptable()->getClassecompte()->getLibelle(); ?></td>
                    <td style="width: 5%; text-align: center;">
                        <button onclick="deleteCompte('<?php echo $i; ?>')" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-close"></i></button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<input type="text" id="array_regroupement">

<?php if ($parametre_id != ''): ?>
    <?php $parametre = ParametrebilanTable::getInstance()->find($parametre_id); ?>
    <?php if ($parametre->getType() == 0): ?>
        <script  type="text/javascript">
            getComptesDecocheActif('<?php echo $index; ?>');
        </script>
    <?php elseif ($parametre->getType() == 1): ?>
        <script  type="text/javascript">
            getComptesDecochePassif('<?php echo $index; ?>');
        </script>
    <?php elseif ($parametre->getType() == 2): ?>
        <script  type="text/javascript">
            getComptesDecocheResultat('<?php echo $index; ?>');
        </script>
    <?php elseif ($parametre->getType() == 3): ?>
        <script  type="text/javascript">
            getComptesDecocheFlux('<?php echo $index; ?>');
        </script>
    <?php elseif ($parametre->getType() == 4): ?>
        <script  type="text/javascript">
            getComptesDecocheSig('<?php echo $index; ?>');
        </script>
    <?php endif; ?>
<?php endif; ?>

<script  type="text/javascript">
    var comptes_decoche = '';
    $('.list_checbox_compte[type=checkbox]').each(function () {
        $('#' + $(this).attr('id')).prop("checked", "checked");
        if (comptes_decoche != '')
            comptes_decoche += ',' + $(this).val();
        else
            comptes_decoche += $(this).val();
        $('#array_regroupement').val(comptes_decoche);
    });


    function deleteCompte(id) {
        $('#tr_' + id).remove();
    }
    function chargerToutCompte(actiondetail) {
        $.ajax({
            url: '<?php echo url_for('fiche_Bilan/rechargerComptesParametreBilan') ?>',
            data: 'compte_debut=' + '<?php echo $compte_min; ?>' +
                    '&compte_fin=' + '<?php echo $compte_max; ?>' +
                    '&parametre_id=' + <?php echo $parametre_id; ?> +
                    '&index=' + '<?php echo $index; ?>' +
                    '&actiondetail=' + actiondetail,
            success: function (data) {
                $('#myTable_<?php echo $index; ?> tbody').html(data);
            }
        });
    }

    function setCheckAll() {

        if ($("#check_input").is(":checked")) {
            $('.list_checbox_compte[type=checkbox]').each(function () {
                $(this).prop("checked", "checked");

            });
        } else {
            $('.list_checbox_compte[type=checkbox]').each(function () {
                $(this).removeProp("checked");
                $(this).removeAttr("checked");
            });
        }
        addId();
    }
    function addId() {
        reg = '';
        $('input[type=checkbox]').each(function () {
            var sThisVal = (this.checked ? "1" : "0");
            if (sThisVal == '1') {
                identifient = $(this).attr('idientifiant');
                if (reg == '')
                    reg = $(this).attr('idientifiant');
                else
                    reg += ',' + $(this).attr('idientifiant');
                console.log(identifient + '=' + reg);

            }

        });
        $('#array_regroupement').val(reg);
    }
    function regrouper() {

        if ($('#array_regroupement').val() != '') {
            $.ajax({
//            typedata: json,
                url: '<?php echo url_for('fiche_Bilan/Regroupercompte') ?>',
                data: 'arrayid=' + $('#array_regroupement').val()
                        + '&libelle=' + $('#next_lettre').val(),
                success: function (data) {
                    var data = JSON.parse(data);
                    for (var i = 0; i < data.length; i++) {
                        $('#regrouppement_' + data[i]).val($('#next_lettre').val());


                    }
                    
                    if ($('#array_regroupement').val() != '') {
                        old_value = $('#allarray_regroupement').val() + $('#array_regroupement').val() + '-----' + $('#next_lettre').val() + '*****';
                        $('#array_regroupement').val('');
                        $('#allarray_regroupement').val(old_value);
                    }
                    $('.list_checbox_compte[type=checkbox]').each(function () {
                        $(this).removeProp("checked", "checked");
                        $(this).removeAttr("checked");
                    });
                    $('#next_lettre').val('');

                }



            });

        }
    }

    function deletelibelle() {
        $('#next_lettre').val('');
    }
</script>

<style>

    .modal-dialog {width: 900px;}

</style>