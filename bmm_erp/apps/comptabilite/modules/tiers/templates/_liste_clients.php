<!--<div class="row">
    <div class="col-xs-12">-->
<!--        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Liste des clients
        </div>

        <div>-->
            <table id="list_client" class="mws-datatable-fn mws-table">
                <thead>
                    <tr>
                        <th style="width: 10%;">Code</th>
                        <th style="width: 30%; text-align: left; padding-left: 1%;">Raison Sociale</th>
                        <th style="width: 40%;">Compte Comptable</th>
                        <th style="width: 20%;">Opérations</th>
                    </tr>
                    <tr>
                        <th><input onkeyup="goPage(1)" type="text" id="code_client"/></th>
                        <th style="text-align: left; padding-left: 1%;">
                            <input onkeyup="goPage(1)" type="text" id="Raison_Sociale_client"/></th>
                        <th><input onkeyup="goPage(1)" type="text" id="compte_client"/></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php include_partial('list', array('pager' => $pager)) ?>
                </tbody>
            </table>
<!--        </div>-->
<!--    </div>
</div>-->
<script  type="text/javascript">

    $("table").addClass("table table-bordered table-hover");

</script>