
<table class="mws-datatable-fn mws-table">
    <thead>
        <tr>
            <th style="width: 10%;">Code</th>
            <th style="width: 30%; text-align: left; padding-left: 1%;">Raison Sociale</th>
            <th style="width: 40%;">Compte Comptable</th>
            <th style="width: 20%;">Opérations</th>
        </tr>
<!--        <tr>
            <th><input onkeyup="goPage(1)" type="text" id="code_client"/></th>
            <th style="text-align: left; padding-left: 1%;">
                <input onkeyup="goPage(1)" type="text" id="Raison_Sociale_client"/></th>
            <th><input onkeyup="goPage(1)" type="text" id="compte_client"/></th>
            <th></th>
        </tr>-->
    </thead>
    <tbody id="list_client" >
        <?php if (sizeof($pager->getResults()) == 0): ?>
            <tr>
                <td class="empty_list" colspan="4">Liste des clients vide</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($pager->getResults() as $client): ?>
            <tr>
                <td class="td_center"><?php echo $client->getCodeclt() ?></td>
                <td><?php echo $client->getRs() ?></td>
                <td>
                    <?php if ($client->getPlancomptable()!= null): ?>
                        <?php echo $client->getPlancomptable()->getNumerocompte() . ' - ' . $client->getPlancomptable()->getLibelle(); ?>

                        <button type="button" class="btn btn-white btn-info btn-sm pull-right" onclick="edit('<?php echo $client->getId() ?>')" style="text-align: center;">
                            Modifier compte comptable
                            <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
                        </button>
                    <?php else: ?>
                        <button type="button" class="btn btn-white btn-info btn-sm" onclick="edit('<?php echo $client->getId() ?>')" style="text-align: center;">
                            Ajouter compte comptable
                            <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
                        </button>
                    <?php endif; ?>
                </td>
                <td class="td_center">

                    <button type="button" class="btn btn-white btn-default btn-sm" onclick="show('<?php echo $client->getId() ?>')" style="text-align: center;">

                        <i class="ace-icon fa fa-eye icon-on-right bigger-110"></i>
                    </button>
                    <a type="button" class="btn btn-white btn-info btn-sm" href="<?php echo url_for('@showEditClient?id=' . $client->getId()) ?>"><i class="ace-icon fa fa-edit bigger-110 icon-only"></i></a>


                    <button type="button" class="btn btn-white btn-danger btn-sm" onclick="deleteClient('<?php echo $client->getId() ?>')" style="text-align: center;">

                        <i class="ace-icon fa fa-remove icon-on-right bigger-110"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
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