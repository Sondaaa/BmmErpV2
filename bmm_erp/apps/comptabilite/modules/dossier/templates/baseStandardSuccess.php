<div id="sf_admin_container">
    <h1 id="replacediv"> Dossier Comptable 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Base Standard
        </small>
    </h1>
</div>

<table>
    <tr>
        <td style="width: 30%">
            <label class="mws-form-label">Numéro du Compte Comptable :</label>
            <div class="mws-form-item">
                <input class="large" type="text" id="search_numero" onkeyup="searchByNumeroAndLibelle()">
            </div>
        </td>
        <td style="width: 40%">
            <label class="mws-form-label">Intitulé du Compte Comptable :</label>
            <div class="mws-form-item">
                <input class="large" type="text" id="search_libelle" onkeyup="searchByNumeroAndLibelle()">
            </div>
        </td>
        <td style="width: 20%">
            <label class="mws-form-label">Classe comptable :</label>
            <div class="mws-form-item">
                <select id="class_comptable" onchange="searchByNumeroAndLibelle()">
                    <option value="">Tous les classes</option>
                    <?php foreach ($classe_compte as $cc): ?>
                        <option value="<?php echo $cc->getId(); ?>"><?php echo $cc->getLibelle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </td>
    </tr>
</table>

<div class="mws-panel-body no-padding" style="margin-bottom: 15px;">
    <div style="height: 360px; overflow: auto;" id="liste_compte">
        <table class="fancyTable" id="myTable01">
            <thead>
                <tr>
                    <th style="width: 8%;">Numéro</th>
                    <th style="width: 60%;">Intitulé du Compte</th>
                    <th style="width: 8%; text-align: center;">Standard</th>
                    <th style="width: 14%;">Classe</th>
                    <th style="width: 10%; text-align: center;">Date de Création</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comptes as $compte): ?>
                    <tr class="ligne_compte" data_libelle="<?php echo $compte->getLibelle(); ?>" data_number="<?php echo $compte->getNumerocompte(); ?>" data_class="<?php echo $compte->getIdClasse(); ?>">
                        <td><b><?php echo $compte->getNumeroCompte(); ?></b>
                            <input type="hidden" name="compte_dossier" value="<?php echo $compte->getId(); ?>"/>
                        </td>
                        <td><?php echo $compte->getLibelle(); ?></td>
                        <td style="text-align: center" id="standard_<?php echo $compte->getId() ?>">
                            <input type="checkbox" <?php if ($compte->getStandard()): ?>checked="true"<?php endif; ?> onchange="checkStandard('<?php echo $compte->getId() ?>', '<?php echo $compte->getStandard() ?>')" /> 
                        </td>
                        <td><?php echo $compte->getClassecompte()->getLibelle(); ?></td>
                        <td style="text-align: center;">
                            <?php if ($compte->getDate() != '' && $compte->getDate() != null): ?>
                                <?php echo date('d/m/Y', strtotime($compte->getDate())); ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <hr>
</div>

<script  type="text/javascript">

    function searchByNumeroAndLibelle() {
        var libelle = '';
        var numero = '';
        var class_compte = '';
        var motiflib = $('#search_libelle').val();
        var motifnum = $('#search_numero').val();
        var motifclass = $('#class_comptable').val();
        motiflib = motiflib.toUpperCase();
        $('#myTable01 tbody tr').each(function () {
            libelle = $(this).attr('data_libelle');
            numero = $(this).attr('data_number');
            class_compte = $(this).attr('data_class');
            var indexlib = libelle.indexOf(motiflib);
            var indexnum = numero.indexOf(motifnum);
            var indexclass = class_compte.indexOf(motifclass);
            if (indexlib >= 0 && indexnum >= 0 && indexclass >= 0) {
                $(this).css('display', '');
            }
            else {
                $(this).css('display', 'none');
            }
        });
    }

    function checkStandard(compte_id, check) {

        $.ajax({
            url: '<?php echo url_for('@checkPlanStandard') ?>',
            data: 'id=' + compte_id + '&check=' + check,
            success: function (data) {
                if (data == 1)
                    $('#standard_' + compte_id).html('<input type="checkbox" checked="true" onchange="checkStandard(' + compte_id + ', ' + data + ')" /> ');
                else
                    $('#standard_' + compte_id).html('<input type="checkbox" onchange="checkStandard(' + compte_id + ', ' + data + ')" /> ');
            }
        });
    }

</script>

<style>

    .ligne_compte {cursor: pointer;}
    #myTable01 tr td{vertical-align: middle;}

</style>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Base Standard");
</script>