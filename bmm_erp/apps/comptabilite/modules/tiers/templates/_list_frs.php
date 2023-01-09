<table class="mws-datatable-fn mws-table">
    <thead>
        <tr>
             <th style="width: 10%;">Code</th>
            <th style="width: 30%; text-align: left; padding-left: 1%;">Raison Sociale</th>
            <th style="width: 40%;">Compte Comptable</th>
            <th style="width: 20%;">Opérations</th>
        </tr>
<!--        <tr>
            <th><input onkeyup="goPage(1)" type="text" id="code_fournisseur"/></th>
            <th style="text-align: left; padding-left: 1%;"><input onkeyup="goPage(1)" type="text" id="Raison_Sociale_fournisseur"/></th>
            <th><input onkeyup="goPage(1)" type="text" id="compte_fournisseur"/></th>
            <th></th>
        </tr>-->
    </thead>
    <tbody id="list_fournisseur"  >
    <?php if ($pager->getResults()->count() == 0): ?>
        <tr>
            <td class="empty_list" colspan="4">Liste des fournisseurs vide</td>
        </tr>
    <?php endif; ?>
    <?php foreach ($pager->getResults() as $fournisseur): ?>
        <tr>
            <td class="td_center"><?php echo $fournisseur->getCodefrs() ?></td>
            <td><?php echo $fournisseur->getRs() ?></td>
            <td>
                <?php if ($fournisseur->getPlancomptable() != null): ?>
                    <?php echo $fournisseur->getPlancomptable()->getNumerocompte() . ' - ' . $fournisseur->getPlancomptable()->getLibelle(); ?>
                    <button type="button" class="btn btn-white btn-info btn-sm pull-right" onclick="edit('<?php echo $fournisseur->getId() ?>')" style="text-align: center;">
                            Modifier compte comptable
                            <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
                        </button>             
                <?php else: ?>
                    <button type="button" class="btn btn-white btn-info btn-sm" onclick="edit('<?php echo $fournisseur->getId() ?>')" style="text-align: center;">
                        Ajouter compte comptable
                        <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
                    </button>
                <?php endif; ?>
            </td>

            <td class="td_center">

                <button type="button" class="btn btn-white btn-default btn-sm" onclick="show('<?php echo $fournisseur->getId() ?>')" style="text-align: center;">

                    <i class="ace-icon fa fa-eye icon-on-right bigger-110"></i>
                </button>
                <a type="button" class="btn btn-white btn-info btn-sm" href="<?php echo url_for('@showEditFournisseur?id=' . $fournisseur->getId()) ?>"><i class="ace-icon fa fa-edit bigger-110 icon-only"></i></a>


                <!-- <button type="button" class="btn btn-white btn-danger btn-sm" onclick="deleteFournisseur('<?php //echo $fournisseur->getId() ?>')" style="text-align: center;">

                    <i class="ace-icon fa fa-remove icon-on-right bigger-110"></i>
                </button> -->
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


<style>

    .empty_list{text-align:center; font-weight: bold; font-size: 20px !important; padding: 90px !important;}
    .td_center{text-align: center;}
    #code_fournisseur{text-align: center;}
    #list_fournisseur tbody tr td{vertical-align: middle;}

</style>
<script  type="text/javascript">

    $("table").addClass("table table-bordered table-hover");

</script>