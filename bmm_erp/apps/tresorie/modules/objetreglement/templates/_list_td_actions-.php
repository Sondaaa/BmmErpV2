<?php if ($objetreglement->getId() > 6) { ?>
  <td>
    <ul class="sf_admin_td_actions">
      <?php echo $helper->linkToEdit($objetreglement, array('params' =>   array(),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    </ul>
  </td>

<?php } ?>