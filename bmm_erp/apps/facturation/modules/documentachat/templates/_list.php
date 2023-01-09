<div class="sf_admin_list">
    <?php if (!$pager->getNbResults()): ?>
        <p><?php echo __('No result', array(), 'sf_admin') ?></p>
    <?php else: ?>
        <table cellspacing="0">
            <thead>
                <tr>
                    <?php include_partial('documentachat/list_th_tabular', array('sort' => $sort,'idtype' => $idtype)) ?>
                    <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="8">
                        <?php if ($pager->haveToPaginate()): ?>
                            <?php include_partial('documentachat/pagination', array('pager' => $pager, 'idtype' => $idtype)) ?>
                        <?php endif; ?>
                        <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
                        <?php if ($pager->haveToPaginate()): ?>
                            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
                        <?php endif; ?>
                    </th>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($pager->getResults() as $i => $documentachat): $odd = fmod( ++$i, 2) ? 'odd' : 'even' ?>
                <tr class="sf_admin_row <?php echo $odd ?>" style="width:  50%">
                        <?php include_partial('documentachat/list_td_tabular', array('documentachat' => $documentachat,'idtype' => $idtype)) ?>
                        <?php include_partial('documentachat/list_td_actions', array('documentachat' => $documentachat, 'helper' => $helper ,'idtype' => $idtype)) ?>
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
