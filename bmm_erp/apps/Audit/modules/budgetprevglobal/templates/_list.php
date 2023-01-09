<?php
$origines=SourcesbudgetTable::getInstance()->findAll();
$directions=DirectionTable::getInstance()->findAll();

?>
<div class="sf_admin_list">
  <?php if (!$pager->getNbResults()): ?>
  <p><?php echo __('No result', array(), 'sf_admin') ?></p>
  <?php else: ?>
  <table cellspacing="0">
    <thead>
      <tr>
                <?php include_partial('budgetprevglobal/list_th_tabular', array('sort' => $sort,'origines'=>$origines,'directions'=>$directions)) ?>
                  <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
              </tr>
    </thead>
   
    <tbody>
      <?php $mnt=0; foreach ($pager->getResults() as $i => $titrebudjet): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
      <tr class="sf_admin_row <?php echo $odd ?>">
      <?php $mnt+=$titrebudjet->getMntglobal() ?>
                <?php include_partial('budgetprevglobal/list_td_tabular', array('titrebudjet' => $titrebudjet,'origines'=>$origines,'directions'=>$directions)) ?>
                  <?php include_partial('budgetprevglobal/list_td_actions', array('titrebudjet' => $titrebudjet, 'helper' => $helper)) ?>
              </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
    <td colspan="4">
      <div class="bg bg-danger" style="float: right;padding:1% 20%;font-weight: bold;">

     <span>Total:</span>  <?php echo number_format($mnt,3);?>
      </div>
  </td>
</tr>
      <tr>

        <td colspan="4">
          <div class="row">


            <div class="col-md-4">
              <ul class="sf_admin_actions">
                <?php include_partial('budgetprevglobal/list_batch_actions', array('helper' => $helper)) ?>

              </ul>
            </div>
            <div class="col-md-8" style="text-align: right;">
              <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('budgetprevglobal/pagination', array('pager' => $pager,'helper' => $helper)) ?>
              <?php endif; ?>
              <div>
                <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
                <?php if ($pager->haveToPaginate()): ?>
                <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
                <?php endif; ?>
              </div>
            </div>




          </div>
        </td>
      </tr>
    </tfoot>
  </table>
  <?php endif; ?>
</div>
<script type="text/javascript">
  /* <![CDATA[ */
  function checkAll() {
    var boxes = document.getElementsByTagName('input');
    for (var index = 0; index < boxes.length; index++) {
      box = boxes[index];
      if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked
    }
    return true;
  }
  /* ]]> */
</script>