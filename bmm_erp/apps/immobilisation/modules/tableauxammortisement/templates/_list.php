<div class="sf_admin_list">
    <?php if (!$pager->getNbResults()): ?>
        <p><?php echo __('No result', array(), 'sf_admin') ?></p>
    <?php else: ?>
        <table cellspacing="0">
            <thead>
                <tr>
                    <!--<th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>-->
                    <?php include_partial('tableauxammortisement/list_th_tabular', array('sort' => $sort)) ?>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="10">
                        <?php if ($pager->haveToPaginate()): ?>
                            <?php include_partial('tableauxammortisement/pagination', array('pager' => $pager)) ?>
                        <?php endif; ?>

                        <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
                        <?php if ($pager->haveToPaginate()): ?>
                            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
                        <?php endif; ?>
                    </th>
                </tr>
            </tfoot>
            <tbody ng-controller="myCtrlImmo">
                <?php foreach ($pager->getResults() as $i => $tableauxammortisement): $odd = fmod( ++$i, 2) ? 'odd' : 'even' ?>
                    <tr class="sf_admin_row <?php echo $odd ?>">
                        <?php // include_partial('tableauxammortisement/list_td_batch_actions', array('tableauxammortisement' => $tableauxammortisement, 'helper' => $helper)) ?>
                        <?php include_partial('tableauxammortisement/list_td_tabular', array('tableauxammortisement' => $tableauxammortisement)) ?>
                        <?php include_partial('tableauxammortisement/list_td_actions', array('tableauxammortisement' => $tableauxammortisement, 'helper' => $helper)) ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script type="text/javascript">
    /* <![CDATA[ */
    function checkAll()
    {
        var boxes = document.getElementsByTagName('input');
        for (var index = 0; index < boxes.length; index++) {
            box = boxes[index];
            if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox')
                box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked
        }
        return true;
    }
    /* ]]> */
</script>

<script  type="text/javascript">

//    var app = angular.module('myApp', []);
//    app.controller('myCtrl', function ($scope, $http) {
//
//        $scope.Renialisertable = function (id) {
//
//            var id_immob = $("#" + "idimmob_" + id).val();
//
//            var varcontenu = $("#" + "amrtint_" + id).val();
//            var url = "<?php // echo sfconfig::get('sf_appdir') ?>immobilisation.php/tableauxammortisement/Calcultimmob/id/" + id_immob + "/contenu/" + varcontenu+'/idtable/'+id;
//            document.location.href = url;
//        };
//        $scope.Modifier = function (id) {
//            if (document.getElementById('div_' + id).style.display == "none")
//                document.getElementById('div_' + id).style.display = "";
//            else
//                document.getElementById('div_' + id).style.display = "none";
//        };
//    });

</script>