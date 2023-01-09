<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_datecreation">
  <?php if ('datecreation' == $sort[0]) : ?>
    <?php echo link_to(__('Date de Création', array(), 'messages'), '@budgetprevglobal', array('query_string' => 'sort=datecreation&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else : ?>
    <?php echo link_to(__('Date de Création', array(), 'messages'), '@budgetprevglobal', array('query_string' => 'sort=datecreation&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_categorietitre">
  <?php echo __('Catégorie du budget', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>


<th class="sf_admin_text sf_admin_list_th_mntglobal">
  <?php if ('mntglobal' == $sort[0]) : ?>
    <?php echo link_to(__('Mnt. global', array(), 'messages'), '@budgetprevglobal', array('query_string' => 'sort=mntglobal&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else : ?>
    <?php echo link_to(__('Mnt. global', array(), 'messages'), '@budgetprevglobal', array('query_string' => 'sort=mntglobal&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>