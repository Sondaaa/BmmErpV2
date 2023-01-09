<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_agents">
  <?php echo __('Agents', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_typediscipline">
  <?php echo __('Type Discipline', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_naturediscipline">
  <?php echo __('Nature Discipline', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>

<th class="sf_admin_text sf_admin_list_th_explication">
  <?php if ('explication' == $sort[0]): ?>
    <?php echo link_to(__('Motif', array(), 'messages'), '@discipline', array('query_string' => 'sort=explication&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Motif', array(), 'messages'), '@discipline', array('query_string' => 'sort=explication&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_nbrejour">
  <?php if ('nbrejour' == $sort[0]): ?>
    <?php echo link_to(__('Nbr Jour', array(), 'messages'), '@discipline', array('query_string' => 'sort=nbrejour&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Nbr Jour', array(), 'messages'), '@discipline', array('query_string' => 'sort=nbrejour&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>