<table id="myTable01">
    <thead>
        <tr>
            <th style="width: 10%;">Numéro</th>
            <th style="width: 58%;">Intitulé du Compte Comptable</th>
<!--            <th style="width: 7%; text-align: center;">Standard</th>-->
            <th style="width: 19%;">Classe</th>
            <th style="width: 13%; text-align: center;">Opérations</th>
        </tr>
    </thead>
    <tbody>
        <?php if (sizeof($comptes) == 0): ?>
            <tr>
                <td class="empty_list" colspan="4">Liste des comptes comptables vide</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($comptes as $compte): ?>
            <tr class="ligne_compte" data_libelle="<?php echo trim($compte->getLibelle()); ?>" data_number="<?php echo trim($compte->getNumerocompte()); ?>" data_class="<?php echo $compte->getPlancomptable()->getIdClasse(); ?>">
                <td><?php echo $compte->getNumerocompte(); ?></td>
                <td><a style="cursor: pointer" href="<?php echo url_for('plan_comptable/extraitCompte?id=' . $compte->getId()) ?>" target="_blank" ><?php echo $compte->getLibelle(); ?></a></td>
    <!--                <td style="text-align: center" id="standard_<?php // echo $compte->getId()  ?>">
                <?php // if ($compte->getStandard()): ?><i class="ace-icon fa fa-check bigger-110"></i><?php // endif; ?>
                </td>-->
                <td><?php echo $compte->getPlancomptable()->getClassecompte()->getLibelle(); ?></td>
                <td style="text-align: center;">
                    <button type="button" class="btn btn-white btn-default btn-sm" onclick="show('<?php echo $compte->getId() ?>')">
                        <i class="ace-icon fa fa-eye bigger-110 icon-only"></i>
                    </button>
                      <a type="button" class="btn btn-white btn-info btn-sm"
                       href="<?php echo url_for('plan_comptable/showEditComptecomptable?id=' . $compte->getId()) ?>">
                        <i class="ace-icon fa fa-edit bigger-110 icon-only"></i></a>
<!--                    <button type="button" class="btn btn-white btn-info btn-sm" onclick="edit('<?php // echo $compte->getId() ?>')">
                        <i class="ace-icon fa fa-edit bigger-110 icon-only"></i>
                    </button>-->
                    <button type="button" class="btn btn-white btn-danger btn-sm" onclick="supprimer('<?php echo $compte->getId() ?>', '<?php echo $compte->getNumerocompte(); ?>')">
                        <i class="ace-icon fa fa-remove bigger-110 icon-only"></i>
                    </button>
                </td>
            </tr>
        <?php  endforeach; ?>
    </tbody>
</table>
<style>

    .empty_list{text-align:center; font-weight: bold; font-size: 20px !important; padding: 90px !important;}
    .td_center{text-align: center;}
    #code_client{text-align: center;}
    #list_client tbody tr td{vertical-align: middle;}

</style>
<script  type="text/javascript">

    $("table").addClass("table table-bordered table-hover");

</script>