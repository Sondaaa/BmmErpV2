<td style="text-align: center;">
  <ul class="sf_admin_td_actions">
    <?php // echo $helper->linkToEdit($transfertbudget, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php // echo $helper->linkToDelete($transfertbudget, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
    <a target="_blank" class="btn btn-outline btn_new btn-success" href="<?php echo url_for('transfertbudget/imprimer?id=' . $transfertbudget->getId()) ?>" style="text-align: center; font-size: 14px !important; margin-top: 5px;">Imprimer</a>
</td>
