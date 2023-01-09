<table id="myTable01">
    <thead>
        <tr>
            <th style="width: 7%;">Numéro</th>
            <th style="width: 60%;">Intitulé du Compte Comptable</th>
            <th style="width: 7%; text-align: center;">Standard</th>
            <th style="width: 13%;">Classe</th>
            <th style="width: 13%; text-align: center;">Opérations</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($comptes as $compte): ?>
            <tr class="ligne_compte" data_libelle="<?php echo $compte->getLibelle(); ?>" data_number="<?php echo $compte->getNumerocompte(); ?>" data_class="<?php echo $compte->getIdClasse(); ?>">
                <td><b><?php echo $compte->getNumerocompte(); ?></b></td>
                <td><a style="cursor: pointer" href="<?php echo url_for('plan_comptable/extraitCompte?id=' . $compte->getId()) ?>" target="_blank" ><?php echo $compte->getLibelle(); ?></a></td>
                <td style="text-align: center" id="standard_<?php echo $compte->getId() ?>">
                    <?php if ($compte->getStandard()): ?><i class="ace-icon fa fa-check bigger-110"></i><?php endif; ?>
                </td>
                <td><?php echo $compte->getClassecompte()->getLibelle(); ?></td>
                <td style="text-align: center;">
                    <button type="button" class="btn btn-white btn-default btn-sm" onclick="show('<?php echo $compte->getId() ?>')" style="text-align: center;">
                        <i class="ace-icon fa fa-search bigger-110 icon-only"></i>
                    </button>
                    <button type="button" class="btn btn-white btn-info btn-sm" onclick="edit('<?php echo $compte->getId() ?>')" style="text-align: center;">
                        <i class="ace-icon fa fa-edit bigger-110 icon-only"></i>
                    </button>
                    <button type="button" class="btn btn-white btn-danger btn-sm" onclick="supprimer('<?php echo $compte->getId() ?>', '<?php echo $compte->getNumerocompte(); ?>')" style="text-align: center;">
                        <i class="ace-icon fa fa-remove bigger-110 icon-only"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script  type="text/javascript">

    $("table").addClass("table table-bordered table-hover");

</script>