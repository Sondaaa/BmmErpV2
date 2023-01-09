<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_fournisseur">
  <?php echo __('Fournisseur', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_lignemouvementfacturation">
  <?php echo __('Lignemouvementfacturation', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_etatfrs">
  <?php if ('etatfrs' == $sort[0]): ?>
    <?php echo link_to(__('Situation Fiscale', array(), 'messages'), '@historiquemouvement', array('query_string' => 'sort=etatfrs&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Situation Fiscale', array(), 'messages'), '@historiquemouvement', array('query_string' => 'sort=etatfrs&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_datecreation">
  <?php if ('datecreation' == $sort[0]): ?>
    <?php echo link_to(__('Date Création', array(), 'messages'), '@historiquemouvement', array('query_string' => 'sort=datecreation&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Date Création', array(), 'messages'), '@historiquemouvement', array('query_string' => 'sort=datecreation&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>