<div id="sf_admin_container">
    <h1 id="replacediv">  
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
          Liste des  Agents
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
       


        <div class="modal-body">
            <table style="width: 50px">

                <tr>
<!--                    <td><label>Recherche par matricule </label></td>-->
                    <td><label>Matricule </label></td>
                    <td>
                        <input id="iddebut" type="text" style="width: 45px">
                    </td>
                </tr>
                <tr>
                    <td><label>Matricule</label></td>
                    <td>
                        <input id="idfin" type="text" style="width: 45px">
                    </td>
                </tr>
            </table>

        </div>

    
   
        <div class="modal-footer" style="width: 200px">
            <button class="btn  pull-left" data-dismiss="modal" ng-click="filtrer()">
                
                Filtrer
            </button>
            <button class="btn  pull-left" data-dismiss="modal">
                
                Effacer
            </button>
        </div>
        <div class="table-header">
            Liste du Personnelle
        </div>
        <div></div>
        <div>
            <table id="list_agents" class="mws-datatable-fn mws-table">
                <thead><tr></tr>
                    <tr>
                        <th style="width: 10%;">Matricule</th>
                        <th style="width: 35%; text-align: left; padding-left: 4%;">Nom Complet</th>
                        <th style="width: 20%;"> CIN </th>
                        <th style="width: 30%;">Opérations</th>
                    </tr>
                    <tr>
                        <th><input onkeyup="goPage(1)" type="text" id="idrh"/></th>
                        <th style="text-align: left; padding-left: 4%;">
                            <input onkeyup="goPage(1)" type="text" id="nomcomplet"/></th>
                        <th><input onkeyup="goPage(1)" type="text" id="cin"/></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php include_partial('listagents', array('pager' => $pager)) ?>
                </tbody>

            </table>
        </div>
   
 </div>
    </div>
</div>
           
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<script  type="text/javascript">
function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('agents/listeagents') ?>',
            data: 'page=' + page +
                    '&idrh=' + $('#idrh').val() +
                    '&nomcomplet=' + $('#nomcomplet').val() +
                    '&cin=' + $('#cin').val(),
            success: function (data) {
                $('#list_agents tbody').html(data);
            }
        });
    }
     function show(id) {
        $.ajax({
            url: '<?php //echo url_for('@showAgents') ?>',
            data: 'id=' + id,
            success: function (data) {
                bootbox.dialog({
                    message: data,
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                            }
                });
            }
        });
    }
</script>