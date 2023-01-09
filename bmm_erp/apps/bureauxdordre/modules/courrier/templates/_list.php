<div class="sf_admin_list">
    <?php if (!$pager->getNbResults()): ?>
        <p><?php echo __('No result', array(), 'sf_admin') ?></p>
    <?php else: ?>
        <table cellspacing="0">
            <thead>
                <tr>
                    <?php include_partial('courrier/list_th_tabular', array('sort' => $sort)) ?>
                    <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="9">
                        <?php if ($pager->haveToPaginate()): ?>
                            <?php include_partial('courrier/pagination', array('pager' => $pager)) ?>
                        <?php endif; ?>

                        <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
                        <?php if ($pager->haveToPaginate()): ?>
                            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
                        <?php endif; ?>
                    </th>
                </tr>
            </tfoot>
            <tbody>
                <?php $rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u'; ?>
                <?php foreach ($pager->getResults() as $i => $courrier): $odd = fmod( ++$i, 2) ? 'odd' : 'even' ?>
                    <tr class="sf_admin_row <?php echo $odd ?>">
                        <?php $user = $sf_user->getAttribute('userB2m'); ?>
                        <?php include_partial('courrier/list_td_tabular', array('courrier' => $courrier, 'rtl_chars_pattern' => $rtl_chars_pattern)) ?>
                        <?php include_partial('courrier/list_td_actions', array('courrier' => $courrier, 'helper' => $helper, 'user' => $user)) ?>
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

<style>
    .list_destinateur{
        list-style: disc !important;
        margin: 0 0 0 10px;
    }
</style>
