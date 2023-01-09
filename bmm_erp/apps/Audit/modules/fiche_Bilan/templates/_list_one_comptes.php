<script  type="text/javascript">
    $(".chosen-select1").chosen({ width:"80%" });
    $('.chosen-container').trigger("chosen:updated");




</script>
<span class="bigger-120 blue">Déterminer les comptes comptables pour la section note :</span>

<div class="row" style="padding-left: 30px; padding-top: 20px; color: #c42b2b;">Veuillez <b>décaucher</b> les comptes comptables destinés au section <b>note</b></div>
<table class="table table-bordered table-hover" style="margin-bottom: 0px;" id="myTable_<?php echo $index; ?>">
    <thead>
        <tr>
            <th colspan="6" style="text-align: center; vertical-align: middle;">
                Du compte N° <?php echo $compte_min; ?> jusqu'au compte N° <?php echo $compte_max; ?>
                <button class="btn btn-xs btn-primary" style="float: right; margin-top: -5px; margin-bottom: -5px;" onclick="chargerToutCompte()"><i class="ace-icon fa fa-repeat"></i> Charger Tout</button>
            </th>
        </tr>
        <tr>
            <th colspan="5">
                <?php
                $dossier_id = $_SESSION['dossier_id'];
                $choix_comptes = PlandossiercomptableTable::getInstance()->loadByInterval($compte_min, $compte_max, $dossier_id, $_SESSION['exercice_id']);
                ?>
                <select id="compte_choice"  class="chosen-select1" >
                    <option value=""></option>
                    <?php foreach ($choix_comptes as $compte): ?>
                        <option value="<?php echo $compte->getId(); ?>" id="op_<?php echo $compte->getId(); ?>" numero="<?php echo trim($compte->getNumerocompte()); ?>" libelle="<?php echo trim($compte->getLibelle()); ?>" classcompte="<?php echo trim($compte->getPlancomptable()->getClassecompte()->getLibelle()); ?>"><?php echo trim($compte->getNumerocompte()) . ' - ' . trim($compte->getLibelle()); ?></option>
                    <?php endforeach; ?>
                </select>
            </th>
            <th>
                <button class="btn btn-xs btn-warning" style="float: right; margin-top: -5px; margin-bottom: -5px;" onclick="ajouterCompteTable()"><i class="ace-icon fa fa-arrow-down"></i> Ajouter</button>
            </th>
        </tr>
        <tr>
            <th style="width: 5%; text-align: center;">
                <input id="check_input" type="checkbox" onchange="setCheckAll()"/>
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
            <?php foreach ($comptes as $compte): ?>
                <?php
                $checked = true;
                if ($parametre_id != ''):
                    $Parametrebilancompte = ParametrebilancompteTable::getInstance()->findByIdCompteAndIdParametrebilan($compte->getId(), $parametre_id)->getFirst();
                    if ($Parametrebilancompte) {
                        if ($Parametrebilancompte->getType() == 0)
                            $checked = false;
                    }else {
                        $checked = false;
                    }
                    ?>
                    <tr id="tr_<?php echo $compte->getId(); ?>" class="ligne_compte">
                        <td style="width: 5%; text-align: center;"> <input <?php if ($checked): ?>checked="checked"<?php endif; ?> id="check_input_<?php echo $compte->getId(); ?>" class="list_checbox_compte" value="<?php echo $compte->getId(); ?>" type="checkbox"/> </td>
                        <td style="width: 10%;"><b><?php echo trim($compte->getNumerocompte()); ?></b>
                            <input type="hidden" name="compte_dossier" value="<?php echo $compte->getId(); ?>"/>
                        </td>
                        <td style="width: 40%;"><?php echo trim($compte->getLibelle()); ?></td>
                        <td style="width: 20%;"><?php echo $Parametrebilancompte->getRegrouppement(); ?>
                        </td>
                        <td style="width: 20%;"><?php echo trim($compte->getPlancomptable()->getClassecompte()->getLibelle()); ?></td>
                        <td style="width: 5%; text-align: center;"><button onclick="deleteCompte('<?php echo $compte->getId(); ?>')" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash"></i></button></td>
                    </tr>
                <script  type="text/javascript">
                    $("#op_<?php echo $compte->getId(); ?>").css("display", "none");
                </script>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

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


    function ajouterCompteTable() {
        if ($("#compte_choice").val() != '') {
            var id = parseInt($('#compte_choice').val());
            var tr_html = '<tr id="tr_' + id + '">';
            tr_html = tr_html + '<td style="width: 5%; text-align: center;"> <input checked="checked" id="check_input_' + id + '" class="list_checbox_compte" value="' + id + '" type="checkbox"/> </td>';
            tr_html = tr_html + '<td style="width: 10%;"><b>' + $("#op_" + id).attr("numero") + '</b><input type="hidden" name="compte_dossier" value="' + id + '"/></td>';
            tr_html = tr_html + '<td style="width: 40%; text-align: justify;">' + $("#op_" + id).attr("libelle") + '</td>';
            tr_html = tr_html + '<td style="width: 20%; text-align: justify;"><input type="text" id="regrouppemnt_' + id + '"  value=""/>' + '</td>';
            tr_html = tr_html + '<td style="width: 20%;">' + $("#op_" + id).attr("classcompte") + '</td>';
            tr_html = tr_html + '<td style="width: 5%; text-align: center;"><button class="btn btn-xs btn-danger" onclick="deleteCompte(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
            tr_html = tr_html + '</tr>';
            $("#myTable_<?php echo $index; ?> tbody").append(tr_html);

            $("#op_" + id).css("display", "none");

            $("#compte_choice").val('').trigger("liszt:updated");
            $("#compte_choice").trigger("chosen:updated");
        }
    }

    function deleteCompte(id) {
        $('#tr_' + id).remove();
        $("#op_" + id).css("display", "block");

        $("#compte_choice").val('').trigger("liszt:updated");
        $("#compte_choice").trigger("chosen:updated");
    }

    function chargerToutCompte(id) {

        $.ajax({
            url: '<?php echo url_for('fiche_Bilan/rechargerComptesParametreBilan') ?>',
            data: 'compte_debut=' + '<?php echo $compte_min; ?>' +
                    '&compte_fin=' + '<?php echo $compte_max; ?>' +
                    '&parametre_id=' + <?php echo $parametre_id; ?> +
                    '&index=' + '<?php echo $index; ?>',
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
    }

</script>



<style>

    .modal-dialog {width: 1080px;}

</style>