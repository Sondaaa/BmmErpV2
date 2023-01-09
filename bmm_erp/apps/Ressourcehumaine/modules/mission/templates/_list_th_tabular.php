<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_mission">
  <?php if ('mission' == $sort[0]): ?>
    <?php echo link_to(__('Mission', array(), 'messages'), '@mission', array('query_string' => 'sort=mission&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Mission', array(), 'messages'), '@mission', array('query_string' => 'sort=mission&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_agents">
  <?php echo __('Agents/Ouvrier', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_lieutravail">
  <?php echo __('Lieu ', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_datesortie">
  <?php if ('datesortie' == $sort[0]): ?>
    <?php echo link_to(__('Date de sortie ', array(), 'messages'), '@mission', array('query_string' => 'sort=datesortie&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Date de sortie ', array(), 'messages'), '@mission', array('query_string' => 'sort=datesortie&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_duree">
  <?php if ('duree' == $sort[0]): ?>
    <?php echo link_to(__('Nbr.Jour ', array(), 'messages'), '@mission', array('query_string' => 'sort=duree&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Nbr.Jour ', array(), 'messages'), '@mission', array('query_string' => 'sort=duree&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>
