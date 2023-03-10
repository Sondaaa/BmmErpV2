<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_matricule">
  <?php if ('matricule' == $sort[0]): ?>
    <?php echo link_to(__('Matricule', array(), 'messages'), '@ouvrier', array('query_string' => 'sort=matricule&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Matricule', array(), 'messages'), '@ouvrier', array('query_string' => 'sort=matricule&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_nom">
  <?php if ('nom' == $sort[0]): ?>
    <?php echo link_to(__('Nom ', array(), 'messages'), '@ouvrier', array('query_string' => 'sort=nom&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Nom ', array(), 'messages'), '@ouvrier', array('query_string' => 'sort=nom&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_prenom">
  <?php if ('prenom' == $sort[0]): ?>
    <?php echo link_to(__('Prénom', array(), 'messages'), '@ouvrier', array('query_string' => 'sort=prenom&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Prénom', array(), 'messages'), '@ouvrier', array('query_string' => 'sort=prenom&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_cin">
  <?php if ('cin' == $sort[0]): ?>
    <?php echo link_to(__('CIN', array(), 'messages'), '@ouvrier', array('query_string' => 'sort=cin&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('CIN', array(), 'messages'), '@ouvrier', array('query_string' => 'sort=cin&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>