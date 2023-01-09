<div class="sf_admin_list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result', array(), 'sf_admin') ?></p>
  <?php else: ?>
  
    <table cellspacing="0">
      <thead>
        <tr>
          <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
          <?php include_partial('parcourcourier/list_th_tabular', array('sort' => $sort)) ?>
          <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
            <th colspan="8" >
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('parcourcourier/pagination', array('pager' => $pager)) ?>
            <?php endif; ?>

            <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
            <?php if ($pager->haveToPaginate()): ?>
              <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
            <?php endif; ?>
          </th>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($pager->getResults() as $i => $parcourcourier): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <?php // $courrier=Doctrine_Core::getTable('courrier')->findOneById($parcourcourier->getIdCourrierdest());  ?>
          <tr style="<?php echo $parcourcourier->getTypecourrier()->getCoul();  ?>" >
            <?php include_partial('parcourcourier/list_td_batch_actions', array('parcourcourier' => $parcourcourier, 'helper' => $helper)) ?>
            <?php include_partial('parcourcourier/list_td_tabular', array('parcourcourier' => $parcourcourier)) ?>
            <?php include_partial('parcourcourier/list_td_actions', array('parcourcourier' => $parcourcourier, 'helper' => $helper)) ?>
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
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
